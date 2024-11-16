@extends('layout.app')
@section('title', 'Roles')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Create Role</h4>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Go Back</a>
</div>
<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Role Name:</label>
        <input type="text" name="name" id="name" class="form-control mt-2" required>
    </div>

    <div class="form-group mt-3">
        <label for="permissions" class="mb-2">Features & Permissions:</label>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Feature</th>
                    <th>Permissions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feature_permissions as $feature_permission)
                <tr>
                    <td>{{ $feature_permission->name }}</td>
                    <td>
                        @foreach($feature_permission->permissions as $permission)
                        <div class="form-check-inline">
                            <input
                                type="checkbox"
                                name="permissions[{{ $feature_permission->id }}][]"
                                value="{{ $permission->id }}"
                                id="permission{{ $permission->id }}"
                                class="form-check-input">
                            <label for="permission{{ $permission->id }}" class="form-check-label">
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Save</button>
</form>
@endsection