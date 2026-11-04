<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class ExportStatic extends Command
{
    protected $signature = 'portfolio:export
        {--base-url= : Public base URL of the static site, including the repository path}
        {--output=site : Output directory, relative to the project root}';

    protected $description = 'Render the portfolio and its 404 page into a static folder for GitHub Pages or Netlify.';

    public function handle(): int
    {
        $baseUrl = rtrim($this->option('base-url') ?: config('app.url'), '/').'/';
        $output = base_path($this->option('output'));

        config([
            'app.url' => $baseUrl,
            'app.asset_url' => $baseUrl,
        ]);

        URL::forceRootUrl($baseUrl);
        URL::forceScheme(str_starts_with($baseUrl, 'https://') ? 'https' : 'http');

        $projects = Project::query()->published()->ordered()->get();
        $activities = Activity::query()->published()->ordered()->get();

        if (File::exists($output)) {
            File::deleteDirectory($output);
        }

        File::ensureDirectoryExists($output);

        $html = view('home', [
            'projects' => $projects,
            'activities' => $activities,
        ])->render();

        $notFound = view('errors.404')->render();

        // GitHub Pages project sites use a trailing slash. Make canonical and
        // Open Graph URLs match the address visitors actually land on.
        $bareBase = rtrim($baseUrl, '/');
        $html = str_replace('"'.$bareBase.'"', '"'.$baseUrl.'"', $html);
        $notFound = str_replace('"'.$bareBase.'"', '"'.$baseUrl.'"', $notFound);

        File::put($output.'/index.html', $html);
        File::put($output.'/404.html', $notFound);
        File::put($output.'/.nojekyll', '');

        $this->copyAssets($output);

        $this->info("Static portfolio exported to {$output}");
        $this->line("Base URL: {$baseUrl}");

        if ($projects->isEmpty()) {
            $this->warn('No published case files were exported.');
        }

        if ($activities->isEmpty()) {
            $this->warn('No published activities were exported.');
        }

        return self::SUCCESS;
    }

    private function copyAssets(string $output): void
    {
        foreach (['favicon.svg', 'robots.txt'] as $file) {
            File::copy(public_path($file), $output.'/'.$file);
        }

        foreach (['css', 'js'] as $directory) {
            File::ensureDirectoryExists($output.'/'.$directory);
        }

        File::copy(public_path('css/portfolio.css'), $output.'/css/portfolio.css');
        File::copy(public_path('js/site.js'), $output.'/js/site.js');

        foreach (File::allFiles(public_path('images')) as $image) {
            if (! in_array($image->getExtension(), ['svg', 'png', 'webp', 'avif', 'jpg', 'jpeg'], true)) {
                continue;
            }

            $relative = str_replace(
                public_path('images').DIRECTORY_SEPARATOR,
                '',
                $image->getPathname(),
            );

            File::ensureDirectoryExists(dirname($output.'/images/'.$relative));
            File::copy($image->getPathname(), $output.'/images/'.$relative);
        }

        File::ensureDirectoryExists($output.'/fonts');
        foreach (File::files(public_path('fonts')) as $font) {
            File::copy($font->getPathname(), $output.'/fonts/'.$font->getFilename());
        }
    }
}
