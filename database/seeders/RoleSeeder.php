<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $allPermissions = Permission::pluck('name')->all();
        $authorPermissions = [
            'access dashboard',
            'manage posts',
            'create posts',
            'edit posts',
            'manage media',
            'create media',
            'edit media',
        ];

        $roles = [
            'super-admin' => $allPermissions,
            'admin' => $allPermissions,
            'author' => $authorPermissions,
        ];

        foreach ($roles as $name => $permissions) {
            $role = Role::findOrCreate($name, 'web');
            $role->syncPermissions($permissions);
        }

        Role::whereNotIn('name', array_keys($roles))->get()->each->delete();
    }
}
