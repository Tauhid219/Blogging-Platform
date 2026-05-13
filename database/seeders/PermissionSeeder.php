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

        $modules = ['users', 'roles', 'categories', 'tags', 'posts', 'comments', 'media', 'pages', 'settings'];
        $actions = ['manage', 'create', 'edit', 'delete'];

        $permissions = [];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permissions[] = "{$action} {$module}";
            }
        }

        $permissions[] = 'access dashboard';

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        Permission::whereNotIn('name', $permissions)->get()->each->delete();
    }
}
