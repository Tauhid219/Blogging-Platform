<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    private const ALLOWED_ROLES = ['super-admin', 'admin', 'author'];

    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit', 'update']),
        ];
    }

    public function index(Request $request): View|JsonResponse
    {
        $rolesQuery = Role::with('permissions')->whereIn('name', self::ALLOWED_ROLES)->orderBy('id');

        if (! auth()->user()->hasRole('super-admin')) {
            $rolesQuery->where('name', '!=', 'super-admin');
        }

        $roles = $rolesQuery->get();

        if ($request->expectsJson()) {
            return response()->json([
                'roles' => $roles->map(fn (Role $role) => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'permissions' => $role->permissions->pluck('name')->values(),
                ])->values(),
            ]);
        }

        return view('admin.roles.index', [
            'roles' => $roles,
        ]);
    }

    public function edit(Role $role): View
    {
        abort_unless(in_array($role->name, self::ALLOWED_ROLES, true), 404);
        abort_if($role->name === 'super-admin' && ! auth()->user()->hasRole('super-admin'), 404);

        return view('admin.roles.edit', [
            'role' => $role->load('permissions'),
            'permissions' => Permission::orderBy('name')->get(),
            'rolePermissions' => $role->permissions->pluck('id')->toArray(),
        ]);
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        abort_unless(in_array($role->name, self::ALLOWED_ROLES, true), 404);
        abort_if($role->name === 'super-admin' && ! auth()->user()->hasRole('super-admin'), 404);

        $data = $request->validate([
            'name' => ['required', 'in:'.$role->name],
            'permissions' => ['array'],
            'permissions.*' => ['exists:permissions,name'],
        ]);

        if ($role->name === 'super-admin') {
            return redirect()->route('admin.roles.index')->with('error', 'Permissions for the super-admin role are fixed and cannot be modified.');
        }

        $role->syncPermissions($data['permissions'] ?? []);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }
}
