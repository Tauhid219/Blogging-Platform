@extends('admin.layouts.app')

@php
    $title = 'Edit user';
@endphp

@section('content')
    @php
        $currentRoles = collect(old('roles', $user->roles->pluck('name')->all()));
    @endphp

    <div class="card">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"></div>
                    <div class="col-md-6 form-group"><label>Username</label><input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group"><label>Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"></div>
                    <div class="col-md-6 form-group"><label>Status</label><select name="status" class="form-control">@foreach(['active','pending','suspended','banned'] as $status)<option value="{{ $status }}" @selected(old('status', $user->status) === $status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
                </div>
                <div class="form-group">
                    <label>Roles</label>
                    <select name="roles[]" class="form-control" multiple size="6">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected($currentRoles->contains($role->name))>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer"><button class="btn btn-primary">Save changes</button></div>
        </form>
    </div>
@endsection
