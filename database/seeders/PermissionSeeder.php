<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',
            'posts.view',
            'posts.create',
            'posts.update',
            'posts.publish',
            'posts.delete',
            'categories.view',
            'categories.create',
            'categories.update',
            'categories.delete',
            'tags.view',
            'tags.create',
            'tags.update',
            'tags.delete',
            'comments.view',
            'comments.update',
            'comments.delete',
            'media.view',
            'media.create',
            'media.delete',
            'pages.view',
            'pages.create',
            'pages.update',
            'pages.delete',
            'users.view',
            'users.update',
            'roles.view',
            'roles.update',
            'settings.view',
            'settings.update',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }
    }
}
