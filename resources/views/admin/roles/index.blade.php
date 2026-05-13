@extends('admin.layouts.app')

@php
    $title = 'Roles Management';
@endphp

@section('content')
    @php
        $canEditRoles = auth()->user()->can('edit roles');
    @endphp

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Roles</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                @php
                                    $displayLimit = 3;
                                    $allPermissions = $role->permissions->pluck('name')->implode(', ');
                                    $roleBadgeClass = $role->name === 'super-admin'
                                        ? 'badge-success'
                                        : ($role->name === 'admin' ? 'badge-info' : 'badge-warning');
                                @endphp
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>
                                        <span class="badge {{ $roleBadgeClass }}">
                                            {{ $role->name }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach ($role->permissions->take($displayLimit) as $permission)
                                            <span class="badge badge-secondary small">{{ $permission->name }}</span>
                                        @endforeach

                                        @if ($role->permissions->count() > $displayLimit)
                                            <span class="badge badge-info small" title="{{ $allPermissions }}">
                                                +{{ $role->permissions->count() - $displayLimit }} more
                                            </span>
                                        @endif

                                        @if ($role->name === 'super-admin')
                                            <span class="badge badge-success">All Permissions</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($canEditRoles)
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-xs">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted p-4">No roles found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
