<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminRbacTest extends TestCase
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

    public function test_super_admin_can_view_roles_index(): void
    {
        $superAdmin = $this->makeUserWithRole('super-admin');

        $response = $this
            ->actingAs($superAdmin)
            ->getJson(route('admin.roles.index'));

        $response->assertOk();
        $response->assertJsonPath('roles.0.name', 'super-admin');
        $response->assertJsonPath('roles.1.name', 'admin');
        $response->assertJsonPath('roles.2.name', 'author');
    }

    public function test_admin_roles_index_hides_super_admin_role(): void
    {
        $admin = $this->makeUserWithRole('admin');

        $response = $this
            ->actingAs($admin)
            ->getJson(route('admin.roles.index'));

        $response->assertOk();
        $response->assertJsonMissing(['name' => 'super-admin']);
        $response->assertJsonPath('roles.0.name', 'admin');
        $response->assertJsonPath('roles.1.name', 'author');
    }

    public function test_admin_cannot_open_super_admin_role_edit_page(): void
    {
        $admin = $this->makeUserWithRole('admin');
        $superAdminRole = Role::findByName('super-admin', 'web');

        $response = $this
            ->actingAs($admin)
            ->getJson(route('admin.roles.edit', $superAdminRole));

        $response->assertNotFound();
    }

    public function test_non_super_admin_cannot_partially_update_user_when_assigning_super_admin_role(): void
    {
        $admin = $this->makeUserWithRole('admin');
        $author = $this->makeUserWithRole('author', [
            'name' => 'Original Author',
            'email' => 'author@example.com',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($admin)
            ->from(route('admin.users.edit', $author))
            ->put(route('admin.users.update', $author), [
                'name' => 'Changed Name',
                'username' => 'changed-name',
                'email' => 'changed@example.com',
                'status' => 'suspended',
                'roles' => ['super-admin'],
            ]);

        $response->assertRedirect(route('admin.users.edit', $author));
        $response->assertSessionHas('error', 'Only a super-admin can assign the super-admin role.');

        $author->refresh();

        $this->assertSame('Original Author', $author->name);
        $this->assertSame('author@example.com', $author->email);
        $this->assertSame('active', $author->status);
        $this->assertSame(['author'], $author->roles->pluck('name')->all());
    }

    private function makeUserWithRole(string $role, array $attributes = []): User
    {
        $defaults = [
            'username' => fake()->unique()->userName(),
            'status' => 'active',
        ];

        $user = User::factory()->create(array_merge($defaults, $attributes));
        $user->assignRole($role);

        return $user;
    }
}
