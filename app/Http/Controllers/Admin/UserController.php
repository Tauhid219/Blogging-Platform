<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit', 'update']),
        ];
    }

    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::with('roles')->latest()->paginate(20),
        ]);
    }

    public function edit(User $user): View
    {
        $rolesQuery = Role::query()->whereIn('name', ['super-admin', 'admin', 'author'])->orderBy('name');

        if (! auth()->user()->hasRole('super-admin')) {
            $rolesQuery->where('name', '!=', 'super-admin');
        }

        return view('admin.users.edit', [
            'user' => $user->load('roles'),
            'roles' => $rolesQuery->get(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username,'.$user->id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'status' => ['required', 'in:active,pending,suspended,banned'],
            'roles' => ['array'],
            'roles.*' => ['in:super-admin,admin,author'],
        ]);

        $incomingRoles = collect($request->input('roles', []))->sort()->values()->all();

        if (! auth()->user()->hasRole('super-admin') && in_array('super-admin', $incomingRoles, true)) {
            return redirect()->route('admin.users.edit', $user)->with('error', 'Only a super-admin can assign the super-admin role.');
        }

        if (! auth()->user()->hasRole('super-admin') && auth()->id() === $user->id) {
            $currentRoles = $user->roles->pluck('name')->sort()->values()->all();

            if ($currentRoles !== $incomingRoles) {
                return redirect()->route('admin.users.edit', $user)->with('error', 'You cannot change your own roles unless you are a super-admin.');
            }
        }

        $user->update($data);
        $user->syncRoles($incomingRoles);

        return redirect()->route('admin.users.edit', $user)->with('status', 'User updated successfully.');
    }
}
