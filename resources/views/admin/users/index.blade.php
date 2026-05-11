@extends('admin.layouts.app')

@php($title = 'Users')

@section('content')
    <div class="card">
        <div class="card-header"><h3 class="card-title">Team members</h3></div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead><tr><th>Name</th><th>Email</th><th>Status</th><th>Roles</th><th></th></tr></thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->status }}</td>
                        <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                        <td class="text-right"><a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $users->links() }}</div>
    </div>
@endsection
