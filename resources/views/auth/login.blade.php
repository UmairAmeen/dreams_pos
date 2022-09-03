@extends('layouts.app')
<!-- Start Login -->
@section('login_content')
    <h3>Sign Into Your Account</h3>
    <div class="clearfix"></div>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <!-- <input name="email" type="email" class="form-control" id="first_field" placeholder="Email Address" aria-label="Email Address"> -->
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group clearfix">
            <label for="password" class="form-label">Password</label>
            <!-- <input name="password" type="password" class="form-control" autocomplete="off" id="second_field" placeholder="Password" aria-label="Password"> -->
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="checkbox form-group clearfix">
            <div class="form-check float-start mb-0">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="rememberme">
                Remember me
            </label>

            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="float-end forgot-password">Forgot your password?</a>
            @endif
        </div>
        <div class="form-group clearfix">
            <button type="submit" class="btn btn-primary btn-lg btn-theme">Login</button>
        </div>
    </form>
@endsection
<!-- End Login -->