<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Platform Admin',
                'username' => 'platform-admin',
                'password' => Hash::make('password'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('super_admin');

        UserProfile::updateOrCreate(
            ['user_id' => $admin->id],
            [
                'headline' => 'Lead editor and platform owner',
                'bio' => 'This seeded administrator can access every area of the blogging platform.',
                'website' => 'https://example.com',
                'location' => 'Dhaka, Bangladesh',
                'social_links' => ['github' => 'https://github.com/Tauhid219'],
            ]
        );

        $engineering = Category::updateOrCreate(
            ['slug' => 'engineering'],
            ['name' => 'Engineering', 'description' => 'Technical articles, architecture notes, and build logs.', 'status' => 'active']
        );

        $product = Category::updateOrCreate(
            ['slug' => 'product'],
            ['name' => 'Product', 'description' => 'Roadmaps, launch notes, and user-facing updates.', 'status' => 'active']
        );

        $laravel = Tag::updateOrCreate(['slug' => 'laravel'], ['name' => 'Laravel']);
        $design = Tag::updateOrCreate(['slug' => 'design-system'], ['name' => 'Design System']);
        $release = Tag::updateOrCreate(['slug' => 'release'], ['name' => 'Release']);

        $firstPost = Post::updateOrCreate(
            ['slug' => 'launching-a-production-minded-blog-platform'],
            [
                'author_id' => $admin->id,
                'editor_id' => $admin->id,
                'category_id' => $engineering->id,
                'title' => 'Launching a production-minded blog platform',
                'excerpt' => 'This post walks through the first principles behind the platform architecture and publishing workflow.',
                'body' => '<p>This seeded article proves the frontend and admin flows are connected to real content.</p><p>From here, editors can create new posts, assign taxonomies, and publish updates.</p>',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDay(),
                'seo_title' => 'Launching a production-minded blog platform',
                'seo_description' => 'Foundations, architecture, and publishing workflow for the new blogging platform.',
            ]
        );

        $firstPost->tags()->syncWithoutDetaching([$laravel->id, $design->id]);

        $secondPost = Post::updateOrCreate(
            ['slug' => 'shipping-the-first-admin-shell'],
            [
                'author_id' => $admin->id,
                'editor_id' => $admin->id,
                'category_id' => $product->id,
                'title' => 'Shipping the first admin shell',
                'excerpt' => 'AdminLTE now powers the management experience while the public side stays focused on readers.',
                'body' => '<p>The admin experience is organized around dashboard, content operations, roles, and settings.</p>',
                'status' => 'published',
                'published_at' => now()->subHours(8),
                'seo_title' => 'Shipping the first admin shell',
                'seo_description' => 'AdminLTE-based control panel setup for the Laravel blogging platform.',
            ]
        );

        $secondPost->tags()->syncWithoutDetaching([$release->id]);

        Page::updateOrCreate(
            ['slug' => 'about-the-platform'],
            [
                'title' => 'About the platform',
                'excerpt' => 'A short introduction to the editorial mission and technical foundation of the platform.',
                'body' => '<p>This platform is built for multi-user blogging with strong editorial controls, clean publishing flows, and scalable content structure.</p>',
                'status' => 'published',
                'published_at' => now()->subDay(),
                'seo_title' => 'About the platform',
                'seo_description' => 'Who we are, what we publish, and how the platform is structured.',
            ]
        );

        foreach ([
            'site_name' => 'Blogging Platform',
            'site_tagline' => 'Build by developers for developers',
            'site_description' => 'A production-minded Laravel blogging platform with a structured publishing workflow.',
            'contact_email' => 'admin@example.com',
        ] as $key => $value) {
            Setting::updateOrCreate(
                ['group' => 'site', 'key' => $key],
                ['value' => [$key => $value], 'type' => 'string', 'autoload' => true]
            );
        }
    }
}
