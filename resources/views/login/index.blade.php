@extends('layouts.admin')
@section('main-content')
<div class ="container mt-4">
    <div class="row justify-content-center">
        <div class ="col-lg-4">
            @if (session()->has('sukses'))
            <div clas="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session()->has('loginError'))
            <div class = "alert alert-danger alert-dismissible fade show" role="alret">
                {{ session('loginError') }}
                <button type="button" class ="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <main class ="form-signin">
                <h1 class="h3 mb-3 fw-normal">Form Login</h1>
                <form action="/login" method="POST">
                    @csrf
                    <div class ="form-floating">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class ="form-floating">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required value="{{ old('password') }}">
                        @error ('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <br>
                    <button class="w-100 btn btn-lg" type="submit">Login</button>
                </form>
                <small class="d-block text-center mt-3">Belum Registrasi?<a href="/registrasi">Registrasi Sekarang!</a></small>
            </main>
        </div>
    </div>
</div>
@endsection