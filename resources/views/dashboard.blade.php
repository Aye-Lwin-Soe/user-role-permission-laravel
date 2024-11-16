@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mt-4">
    <div class="col-4 col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary">Total Active Users</h5>
                <p class="card-text display-6 text-success">{{ $userActiveCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-4 col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary">Total InActive Users</h5>
                <p class="card-text text-danger display-6">{{ $userInActiveCount }}</p>
            </div>
        </div>
    </div>
</div>
@endsection