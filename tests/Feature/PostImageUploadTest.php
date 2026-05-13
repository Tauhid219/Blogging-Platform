<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostImageUploadTest extends TestCase
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

    public function test_author_can_create_a_post_with_an_uploaded_featured_image(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'username' => 'author-user',
            'status' => 'active',
        ]);
        $user->assignRole('author');

        $category = Category::create([
            'name' => 'Engineering',
            'slug' => 'engineering',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('admin.posts.store'), [
                'title' => 'Uploaded image post',
                'slug' => 'uploaded-image-post',
                'category_id' => $category->id,
                'excerpt' => 'Excerpt for the uploaded image test post.',
                'body' => '<p>Post body content.</p>',
                'status' => 'draft',
                'featured_image_upload' => UploadedFile::fake()->image('featured-post.jpg', 1200, 800),
            ]);

        $response->assertRedirect(route('admin.posts.index'));

        $post = Post::query()->firstOrFail();

        $this->assertStringStartsWith('posts/featured-images/', $post->featured_image_path);
        Storage::disk('public')->assertExists($post->featured_image_path);

        $this->assertDatabaseHas('media', [
            'user_id' => $user->id,
            'mediable_type' => Post::class,
            'mediable_id' => $post->id,
            'disk' => 'public',
            'filename' => basename($post->featured_image_path),
        ]);
    }
}
