@extends('layout.app')

@section('title', 'Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Roles</h4>
    @if (\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'Role', 'Create'))
    <a href="{{ route('roles.create') }}" class="btn btn-primary">Create Role</a>
    @endif
</div>
@if (\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'Role', 'Read'))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Permissions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>
                @php
                $features = $role->permissions->groupBy('feature.name');
                @endphp

                @forelse($features as $feature_name => $permissions)

                <span class="text-danger">{{ $feature_name ?? 'No Feature' }}:</span>
                @foreach($permissions as $permission)
                <span class="badge bg-info">{{ $permission->name }}</span>
                @endforeach
                <hr>
                @empty
                <span class="badge bg-secondary">No Permissions</span>
                @endforelse
                <!-- @foreach($role->permissions as $permission)
                <span class="badge bg-info">{{ $permission->name }}</span>
                @endforeach -->
            </td>
            <td>
                @if (\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'Role', 'Update'))
                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                @endif
                @if (\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'Role', 'Delete'))
                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?');">Delete</button>
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Data not Found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif
@endsection