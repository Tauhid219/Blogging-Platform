<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $allPermissions = Permission::pluck('name')->all();

        $roles = [
            'super_admin' => $allPermissions,
            'admin' => $allPermissions,
            'editor' => [
                'dashboard.view',
                'posts.view',
                'posts.create',
                'posts.update',
                'posts.publish',
                'categories.view',
                'categories.create',
                'categories.update',
                'tags.view',
                'tags.create',
                'tags.update',
                'comments.view',
                'comments.update',
                'pages.view',
                'pages.create',
                'pages.update',
                'media.view',
                'media.create',
            ],
            'author' => [
                'dashboard.view',
                'posts.view',
                'posts.create',
                'posts.update',
                'media.view',
                'media.create',
            ],
            'moderator' => [
                'dashboard.view',
                'comments.view',
                'comments.update',
                'comments.delete',
            ],
        ];

        foreach ($roles as $name => $permissions) {
            $role = Role::findOrCreate($name, 'web');
            $role->syncPermissions($permissions);
        }
    }
}
