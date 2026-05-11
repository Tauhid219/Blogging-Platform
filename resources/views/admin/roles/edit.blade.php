@extends('admin.layouts.app')

@php($title = 'Edit role permissions')

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                @php($assigned = collect(old('permissions', $role->permissions->pluck('name')->all())))
                @foreach ($permissions as $group => $items)
                    <div class="mb-4">
                        <h4 class="text-uppercase text-muted">{{ $group }}</h4>
                        <div class="row">
                            @foreach ($items as $permission)
                                <div class="col-md-4">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission_{{ $permission->id }}" @checked($assigned->contains($permission->name))>
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer"><button class="btn btn-primary">Save permissions</button></div>
        </form>
    </div>
@endsection
