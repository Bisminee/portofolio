<?php

namespace Tests\Feature;

use App\Models\BeyondSkill;
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
            ->assertSee('Beyond Code')
            ->assertSee('A dedicated space for skills beyond programming.')
            ->assertSee('This panel is intentionally blank.')
            ->assertSee('In progress')
            ->assertDontSee('not started')
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

    public function test_beyond_code_is_empty_and_contains_no_invented_entries(): void
    {
        $this->assertSame(0, BeyondSkill::query()->count());

        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('This panel is intentionally blank.');
        $response->assertDontSee('beyond-card', false);
        $response->assertDontSee('beyond-grid', false);
    }

    public function test_beyond_code_renders_a_real_entry_when_one_is_added(): void
    {
        BeyondSkill::create([
            'name' => 'Mentoring',
            'category' => 'Community',
            'description' => 'A temporary test entry.',
            'icon' => 'users',
            'sort_order' => 1,
            'is_visible' => true,
        ]);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Mentoring')
            ->assertSee('Community')
            ->assertSee('A temporary test entry.')
            ->assertDontSee('This panel is intentionally blank.');
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
            $this->assertStringContainsString('This panel is intentionally blank.', $html);
            $this->assertStringNotContainsString('beyond-card', $html);
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
