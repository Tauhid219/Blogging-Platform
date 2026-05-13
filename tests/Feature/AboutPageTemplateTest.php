<?php

namespace Tests\Feature;

use App\Http\Controllers\Frontend\PageController;
use App\Models\Page;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTemplateTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_route_uses_the_published_about_template_page(): void
    {
        Page::create([
            'title' => 'Dynamic About',
            'slug' => 'company-story',
            'excerpt' => 'Editable intro copy.',
            'body' => '<p>Editable body copy.</p>',
            'template' => 'about',
            'status' => 'published',
            'published_at' => now()->subMinute(),
            'seo_title' => 'About SEO',
            'seo_description' => 'About SEO Description',
        ]);

        $response = app(PageController::class)->about();

        $this->assertSame('pages.about', $response->name());
        $this->assertSame('Dynamic About', $response->getData()['page']->title);
        $this->assertSame('company-story', $response->getData()['page']->slug);
        $this->assertSame('About SEO', $response->getData()['title']);
        $this->assertSame('About SEO Description', $response->getData()['metaDescription']);
    }

    public function test_about_route_falls_back_to_the_legacy_about_slug(): void
    {
        Page::create([
            'title' => 'Legacy About',
            'slug' => 'about-the-platform',
            'body' => '<p>Legacy body copy.</p>',
            'status' => 'published',
            'published_at' => now()->subMinute(),
        ]);

        $response = app(PageController::class)->about();

        $this->assertSame('Legacy About', $response->getData()['page']->title);
    }

    public function test_about_route_returns_not_found_when_no_published_source_exists(): void
    {
        Page::create([
            'title' => 'Draft About',
            'slug' => 'about-the-platform',
            'template' => 'about',
            'body' => '<p>Draft body copy.</p>',
            'status' => 'draft',
        ]);

        $this->expectException(ModelNotFoundException::class);

        app(PageController::class)->about();
    }

    public function test_about_route_falls_back_to_the_only_published_page_when_no_about_mapping_exists(): void
    {
        Page::create([
            'title' => 'Only Published Page',
            'slug' => 'empowering-voices',
            'body' => '<p>Only page body.</p>',
            'status' => 'published',
            'published_at' => now()->subMinute(),
        ]);

        $response = app(PageController::class)->about();

        $this->assertSame('Only Published Page', $response->getData()['page']->title);
        $this->assertSame('empowering-voices', $response->getData()['page']->slug);
    }
}
