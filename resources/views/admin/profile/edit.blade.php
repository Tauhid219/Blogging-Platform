@extends('admin.layouts.app')

@php
    $title = 'My Profile';
@endphp

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img
                            class="profile-user-img img-fluid img-circle"
                            src="{{ asset('vendor/adminlte/dist/img/user2-160x160.jpg') }}"
                            alt="{{ $user->name }}"
                        >
                    </div>

                    <h3 class="profile-username text-center mb-1">{{ $user->name }}</h3>
                    <p class="text-muted text-center mb-3">
                        {{ $user->roles->pluck('name')->implode(', ') ?: 'Team member' }}
                    </p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Username</b>
                            <span class="float-right">{{ $user->username ?: 'Not set yet' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b>
                            <span class="float-right">{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b>
                            <span class="float-right text-capitalize">{{ $user->status }}</span>
                        </li>
                    </ul>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="alert alert-warning mb-0">
                            Your email address is unverified. Check your inbox after updating it.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Profile Information</h3>
                </div>
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Full Name</label>
                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}"
                                    required
                                >
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="username">Username</label>
                                <input
                                    id="username"
                                    type="text"
                                    name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username', $user->username) }}"
                                >
                                @error('username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label for="email">Email Address</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}"
                                required
                            >
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Profile</button>
                    </div>
                </form>
            </div>

            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <form method="POST" action="{{ route('admin.profile.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input
                                id="current_password"
                                type="password"
                                name="current_password"
                                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                                autocomplete="current-password"
                            >
                            @error('current_password', 'updatePassword')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="password">New Password</label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                                    autocomplete="new-password"
                                >
                                @error('password', 'updatePassword')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-0">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                                    autocomplete="new-password"
                                >
                                @error('password_confirmation', 'updatePassword')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">Update Password</button>
                    </div>
                </form>
            </div>

            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title">Delete Account</h3>
                </div>
                <form method="POST" action="{{ route('admin.profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="card-body">
                        <p class="text-muted">
                            Permanently remove your account and all associated access. This action cannot be undone.
                        </p>

                        <div class="form-group mb-0">
                            <label for="delete_password">Confirm Password</label>
                            <input
                                id="delete_password"
                                type="password"
                                name="password"
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                                autocomplete="current-password"
                            >
                            @error('password', 'userDeletion')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button
                            type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to permanently delete your account?');"
                        >
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
