@extends('layout.app')

@section('title', 'Update Data')

@section('nav')
@include('layout.nav')
@endsection

@section('content') 
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card p-4 shadow-lg rounded">
            <h1 class="text-center mb-4">Update Data</h1>
            <form action="{{ route('user.update-data.post') }}" method="post">
                @csrf
                @include('layout.notif')

                <h3>Informasi Profile</h3>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" disabled class="form-control" id="email" value="{{ Auth::user()->email }}" name="email" aria-describedby="emailHelp">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" value="{{ old('name') ? old('name') : Auth::user()->name }}" name="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h3>Password</h3>
                <div class="form-text mb-3">Silahkan masukkan password jika akan melakukan pergantian password</div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           value="{{ old('password') }}" name="password" id="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           value="{{ old('password_confirmation') }}" name="password_confirmation" id="password_confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-inline">
                    <button type="submit" class="btn btn-primary w-100">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
