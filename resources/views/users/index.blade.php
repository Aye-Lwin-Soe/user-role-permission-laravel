@extends('layout.app')
@section('title', 'Users')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Users</h4>
    @if (\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'User', 'Create'))
    <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
    @endif
</div>
@if (\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'User', 'Read'))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->role?->name }}</td>
            <td>
                @if($user->is_active)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
            </td>
            <td>
                @if (\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'User', 'Update'))
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                @endif
                @if (\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'User', 'Delete'))
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Data not Found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif
@endsection