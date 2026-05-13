<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EditorMediaUploadTest extends TestCase
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

    public function test_author_can_upload_editor_images(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'username' => 'editor-author',
            'status' => 'active',
        ]);
        $user->assignRole('author');

        $response = $this
            ->actingAs($user)
            ->post(route('admin.media.editor-upload'), [
                'image' => UploadedFile::fake()->image('inline-editor-image.png', 800, 500),
            ]);

        $response->assertOk();
        $response->assertJsonStructure(['id', 'url', 'alt_text']);

        $this->assertDatabaseCount('media', 1);
        Storage::disk('public')->assertExists('editor-images/'.basename(parse_url($response->json('url'), PHP_URL_PATH)));
    }
}
