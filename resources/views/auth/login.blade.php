@extends('layouts.app')
<!-- Start Login -->
@section('login_content')
    <div class="page-title mb-3">
        <h4>Sign Into Your Account</h4>
    </div>
    
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Enter Your Email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Enter Your Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="checkbox form-group clearfix">
            <div class="float-start">
            <label class="checkboxs" for="rememberme">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberme" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmarks"></span>
                Remember Me
            </label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="float-end forgot-password link">Forgot your password?</a>
            @endif
        </div>
        <div class="form-group clearfix">
            <button type="submit" class="btn btn-submit">Login</button>
        </div>
    </form>
@endsection
<!-- End Login -->