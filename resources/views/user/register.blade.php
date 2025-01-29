@extends('layout.app')

@section('title', 'Register')

@section('content') 
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card p-4 shadow-lg rounded">
            <h1 class="text-center mb-4">Register</h1>
            <form action="{{ route('register.post') }}" method="post">
                @csrf
                @include('layout.notif')
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" value="{{ old('password') }}" placeholder="Masukkan password Anda">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" name="password_confirmation" 
                           value="{{ old('password_confirmation') }}" placeholder="Konfirmasi password Anda">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">Sudah Punya Akun? Login Sekarang</a> |
                    <a href="{{ route('forgotpassword') }}" class="text-decoration-none">Lupa Password?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
