@extends('layout.app')

@section('title', 'Reset Password')

@section('content') 
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card p-4 shadow-lg rounded">
            <h1 class="text-center mb-4">Reset Password</h1>
            <form action="{{ route('forgotpassword.post') }}" method="post">
                @csrf
                @include('layout.notif')

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}" id="email" name="email" aria-describedby="emailHelp" placeholder="Masukkan alamat email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-inline mt-3">
                    <button type="submit" class="btn btn-primary w-100">Kirim Link Reset Password</button>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none me-2">Login</a> | 
                    <a href="{{ route('register') }}" class="text-decoration-none ms-2">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
