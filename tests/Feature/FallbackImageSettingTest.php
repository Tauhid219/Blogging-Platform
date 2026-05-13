<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FallbackImageSettingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);
    }

    public function test_admin_can_upload_a_changeable_fallback_post_image(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'username' => 'settings-admin',
            'status' => 'active',
        ]);
        $admin->assignRole('admin');

        $response = $this
            ->actingAs($admin)
            ->put(route('admin.settings.update'), [
                'site_name' => 'Blogging Platform',
                'site_tagline' => 'Build by developers for developers',
                'site_description' => 'A production-minded Laravel blogging platform with a structured publishing workflow.',
                'contact_email' => 'admin@example.com',
                'fallback_post_image_upload' => UploadedFile::fake()->image('fallback-cover.png', 1200, 800),
            ]);

        $response->assertRedirect(route('admin.settings.edit'));

        $setting = Setting::where('group', 'site')->where('key', 'fallback_post_image_path')->firstOrFail();
        $path = data_get($setting->value, 'fallback_post_image_path');

        $this->assertNotEmpty($path);
        $this->assertStringStartsWith('settings/fallback-images/', $path);
        Storage::disk('public')->assertExists($path);
    }
}
