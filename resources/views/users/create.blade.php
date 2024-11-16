@extends('layout.app')
@section('title', 'Users')
@section('content')
@if ($errors->any())
<div class="alert alert-danger mb-3">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Create User</h4>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Go Back</a>
</div>
<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <div class="form-group mb-2">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control mt-2" required>
    </div>

    <div class="form-group mb-2">
        <label for="name">User Name:</label>
        <input type="text" name="username" id="username" class="form-control mt-2" required>
    </div>

    <div class="form-group mb-2">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control mt-2 @error('email') is-invalid @enderror" required>
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>

        @enderror
    </div>

    <div class="form-group mb-2">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Please Enter Number At least 6 number" class="form-control mt-2 @error('password') is-invalid @enderror"
            required>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>

        @enderror
    </div>

    <div class="form-group mt-3 mb-2">
        <label for="address">Address:</label>
        <textarea name="address" id="address" class="form-control mt-2"></textarea>
    </div>

    <div class="form-group mt-3 mb-2">
        <label for="phone">Phone Number:</label>
        <input type="number" min="0" name="phone" id="phone" class="form-control mt-2">
    </div>

    <div class="form-group mt-3 mb-2">
        <label>Gender:</label><br />
        <input type="radio" name="gender" value="0" id="male" class="form-check-input @error('gender') is-invalid @enderror">
        <label for="male" class="form-check-label">Male</label>

        <input type="radio" name="gender" value="1" id="female" class="form-check-input ml-3 @error('gender') is-invalid @enderror">
        <label for="female" class="form-check-label">Female</label>

        <input type="radio" name="gender" value="2" id="other" class="form-check-input ml-3 @error('gender') is-invalid @enderror">
        <label for="other" class="form-check-label">Other</label>
        @error('gender')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-2">
        <label for="role_id">Role:</label>
        <select name="role_id" id="role_id" class="form-control mt-2" required>
            @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-2">
        <label for="is_active">Status:</label><br />
        <input type="hidden" name="is_active" value="0">

        <input type="checkbox" name="is_active" value="1" id="is_active" checked>
        <label for="is_active" id="status-label" class="form-check-label mt-2">Active</label>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Save</button>
</form>
<script>
    const isActiveCheckbox = document.getElementById('is_active');
    const statusLabel = document.getElementById('status-label');

    function updateStatusLabel() {
        if (isActiveCheckbox.checked) {
            statusLabel.textContent = "Active";
        } else {
            statusLabel.textContent = "Inactive";
        }
    }

    updateStatusLabel();

    isActiveCheckbox.addEventListener('change', updateStatusLabel);
</script>
@endsection