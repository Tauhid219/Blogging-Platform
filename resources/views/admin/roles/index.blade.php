@extends('admin.layouts.app')

@php($title = 'Roles')

@section('content')
    <div class="row">
        @foreach ($roles as $role)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">{{ $role->name }}</h3>
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-primary">Configure</a>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">{{ $role->permissions->count() }} permissions assigned.</p>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach ($role->permissions->take(8) as $permission)
                                <span class="badge badge-light border">{{ $permission->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
