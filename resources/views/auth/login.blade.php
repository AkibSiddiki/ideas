@extends('layout.layout')
@section('title', 'Login - ')
@section('main')
<div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6">
        @include('shared.successMassage')
        @include('shared.errorMassage')
        <form class="form mt-5" action="{{route('users.loginAction')}}" method="POST">
            @csrf
            <h3 class="text-center text-dark">Login</h3>
            <div class="form-group mt-3">
                <label for="email" class="text-dark">Email:</label><br>
                <input type="email" name="email" id="email" class="form-control">
                @error('email')
                <small class="mt-3 text-small text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="password" class="text-dark">Password:</label><br>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                <small class="mt-3 text-small text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group d-flex justify-content-end mt-3">
                <label for="remember-me" class="text-dark"></label><br>
                <input type="submit" name="submit" class="btn btn-dark btn-md" value="Login">
            </div>
            <div class="text-right mt-2">
                <a href="{{route('auth.create')}}" class="text-dark">Registration here</a>
            </div>
        </form>
    </div>
</div>
@endsection