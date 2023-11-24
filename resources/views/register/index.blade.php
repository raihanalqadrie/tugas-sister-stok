@extends('layouts.main')

@section('main-content')
<div class ="container mt-4">
    <div class="row justify-content-center">
        <div class ="col-lg-5">
            <main class ="form-registration">
                <h1 class="h3 mb-3 fw-normal">Form Registrasi</h1>
                <form action="/register" method="POST">
                    @csrf
                    <div class ="form-floating">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class ="form-floating">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class ="form-floating">
                        <label for="floatingInput">Email Address</label>
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    </div>
                    <div class ="form-floating">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control rounded-bottom" id="password" placeholder="Password">
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-3">Already Registerd?<a href="/login">Login</a></small>
            </main>
        </div>
    </div>
</div>
@endsection