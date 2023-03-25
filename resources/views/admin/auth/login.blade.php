@extends('layouts.auth')

@section('title', 'Login')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Login</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.login.perform') }}">
            @csrf
            <x-text-input
                name="username"
                label="Username"
            />

            <x-text-input
                name="password"
                label="Password"
                type="password"
            />

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Login
                </button>
            </div>
        </form>
        <div class="mt-4 mb-3 text-center">
            <a href="/">Login sebagai Mahasiswa</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->

<!-- Page Specific JS File -->
@endpush