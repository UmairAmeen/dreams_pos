@extends('layouts.app')
<!-- Start Register -->
@section('login_content')
    <div class="page-title mb-3">
        <h4>Create An Account</h4>
    </div>
    
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Enter Your Name">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Enter Your Email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group clearfix">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="Enter Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group clearfix">
            <label for="password-confirm" class="form-label">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Your Password">
        </div>
        <div class="form-group checkbox clearfix">
            <div class="clearfix float-start">
                <label class="checkboxs" for="rememberme">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberme">
                    <span class="checkmarks"></span>
                    I Agree To The Terms Of Service
                </label>
            </div>
        </div>
        <div class="form-group clearfix">
            <button type="submit" class="btn btn-submit">Register</button>
        </div>
    </form>
@endsection
<!-- End Register -->