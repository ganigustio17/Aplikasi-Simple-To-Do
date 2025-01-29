@extends('layout.app')

@section('title', 'Reset Password')

@section('content') 
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card p-4 shadow-lg rounded">
            <h1 class="text-center mb-4">Reset Password</h1>
            <form action="{{ route('resetpassword.post') }}" method="post">
                <input type="hidden" name="token" value="{{ $token }}" />
                @csrf
                @include('layout.notif')

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           value="{{ old('password') }}" name="password" id="password" placeholder="Masukkan password baru">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password baru">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-inline mt-3">
                    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none me-2">Login</a> | 
                    <a href="{{ route('register') }}" class="text-decoration-none ms-2">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
