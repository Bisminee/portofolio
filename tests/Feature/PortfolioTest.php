<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_home_page_renders_the_portfolio(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Bisma Adhiaksa')
            ->assertSee('Mobile &amp; Web Developer', false)
            ->assertSee('Five files. No filler.')
            ->assertSee('Activities &amp; Involvement', false)
            ->assertSee('Robosarema — Search and Rescue Robotics Team')
            ->assertSee('PL FM — Campus Radio Organization')
            ->assertSee('December 2024 – Present')
            ->assertSee('September 2026')
            ->assertSee('In progress')
            ->assertDontSee('not started')
            ->assertDontSee('This panel is intentionally blank.')
            ->assertSee('github.com/Bisminee');
    }

    public function test_all_seeded_case_files_are_published(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        $this->assertSame(5, Project::query()->published()->count());

        Project::query()->published()->get()->each(function (Project $project) use ($response) {
            $response->assertSee($project->title);
            $response->assertSee($project->repo_url);
        });
    }

    public function test_activities_are_published_in_priority_order(): void
    {
        $this->assertSame(6, Activity::query()->published()->count());

        $response = $this->get('/');
        $response
            ->assertOk()
            ->assertSeeInOrder([
                'Robosarema — Search and Rescue Robotics Team',
                'Steering Committee — Manager Off Air',
                'ROBOTIC UNLIMITED 2026',
                'Polinema Mengajar',
                'Staff Creative Media — PL FM',
                'Product Marketing Team — Kangdjoe (now Keju Artisan)',
            ])
            ->assertSee('https://drive.google.com/drive/folders/1n2fDB7SzVXx_C0fcIGOA8__Puf13-U7U')
            ->assertSee('href="#activity-robosarema-software-division"', false)
            ->assertSee('images/activities/robosarema-arena.webp', false)
            ->assertSee('images/activities/plfm-logo.webp', false)
            ->assertSee('Organization logo');
    }

    public function test_activity_dates_and_scope_are_accurate(): void
    {
        $robosarema = Activity::query()->where('slug', 'robosarema-software-division')->firstOrFail();
        $manager = Activity::query()->where('slug', 'plfm-manager-off-air')->firstOrFail();
        $creative = Activity::query()->where('slug', 'plfm-creative-media')->firstOrFail();
        $polinema = Activity::query()->where('slug', 'polinema-mengajar')->firstOrFail();
        $competition = Activity::query()->where('slug', 'robotic-unlimited-2026')->firstOrFail();

        $this->assertSame('community', $robosarema->type);
        $this->assertSame('December 2024 – Present', $robosarema->period('en'));
        $this->assertSame('Desember 2024 – Sekarang', $robosarema->period('id'));
        $this->assertSame('March 2026 – Present', $manager->period('en'));
        $this->assertSame('March 2025 – January 2026', $creative->period('en'));
        $this->assertSame('December 2025 – November 2026', $polinema->period('en'));
        $this->assertSame('18 September 2026', $competition->period('en'));
        $this->assertSame('2026-09-18', $competition->end_date?->format('Y-m-d'));
    }

    public function test_pending_activities_are_hidden(): void
    {
        $activity = Activity::query()->where('slug', 'polinema-mengajar')->firstOrFail();
        $activity->update(['permission_status' => 'pending']);

        $this->get('/')->assertOk()->assertDontSee($activity->name);
    }

    public function test_unpublished_activities_are_hidden(): void
    {
        $activity = Activity::query()->where('slug', 'robotic-unlimited-2026')->firstOrFail();
        $activity->update(['is_published' => false]);

        $this->get('/')->assertOk()->assertDontSee($activity->name);
    }

    public function test_unpublished_case_files_are_hidden(): void
    {
        $project = Project::query()->firstOrFail();
        $project->update(['published' => false]);

        $this->get('/')->assertOk()->assertDontSee($project->title);
    }

    public function test_custom_404_page_is_rendered(): void
    {
        $this->get('/a-panel-that-does-not-exist')
            ->assertNotFound()
            ->assertSee('This page has vanished into the fog.');
    }

    public function test_static_export_creates_pages_and_assets(): void
    {
        $output = 'site-test';

        try {
            $this->artisan('portfolio:export', [
                '--base-url' => 'https://example.test/portfolio/',
                '--output' => $output,
            ])->assertSuccessful();

            $root = base_path($output);

            $this->assertFileExists($root.'/index.html');
            $this->assertFileExists($root.'/404.html');
            $this->assertFileExists($root.'/favicon.svg');
            $this->assertFileExists($root.'/css/portfolio.css');
            $this->assertFileExists($root.'/js/site.js');
            $this->assertFileExists($root.'/images/hero-portrait.svg');
            $this->assertFileExists($root.'/images/activities/robosarema-arena.webp');
            $this->assertFileExists($root.'/images/activities/keju-artisan-cheese-pull.webp');
            $this->assertFileExists($root.'/fonts/anton-latin.woff2');
            $this->assertFileExists($root.'/.nojekyll');

            $html = File::get($root.'/index.html');
            $notFound = File::get($root.'/404.html');

            $this->assertStringContainsString(
                '<link rel="canonical" href="https://example.test/portfolio/">',
                $html,
            );
            $this->assertStringContainsString(
                'https://example.test/portfolio/css/portfolio.css',
                $html,
            );
            $this->assertStringContainsString('POS Tahu Morojoyo', $html);
            $this->assertStringContainsString('Robosarema — Search and Rescue Robotics Team', $html);
            $this->assertStringContainsString('Activities &amp; Involvement', $html);
            $this->assertStringContainsString('December 2024 – Present', $html);
            $this->assertStringContainsString('id="portfolio-translations"', $html);
            $this->assertStringContainsString('data-lang-switch', $html);
            $this->assertStringContainsString('data-i18n="nav.about"', $html);
            $this->assertStringContainsString('Kegiatan', $html);
            $this->assertStringContainsString('Keterlibatan', $html);
            $this->assertStringContainsString('Sedang dikerjakan', $html);
            $this->assertStringContainsString('images/activities/robosarema-arena.webp', $html);
            $this->assertStringContainsString('This page has vanished into the fog.', $notFound);
        } finally {
            File::deleteDirectory(base_path($output));
        }
    }

    public function test_studio_requires_authentication(): void
    {
        $this->get('/studio')->assertRedirect('/studio/login');
    }

    public function test_a_seeded_admin_can_open_the_studio(): void
    {
        $user = User::query()->where('email', 'studio@example.test')->first();

        if (! $user) {
            $user = User::factory()->create(['email' => 'studio@example.test']);
        }

        $this->actingAs($user)
            ->get('/studio')
            ->assertOk()
            ->assertSee('Dashboard');
    }
}
