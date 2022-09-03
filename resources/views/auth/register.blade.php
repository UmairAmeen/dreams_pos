@extends('layouts.app')
<!-- Start Register -->
@section('login_content')
    <h3>Create An Cccount</h3>
        <div class="clearfix"></div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group clearfix">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group clearfix">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="form-group checkbox clearfix">
                <div class="clearfix float-start">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" id="rememberme">
                        <label class="form-check-label" for="rememberme">
                        I agree to the terms of service
                    </label>
                    </div>
                </div>
            </div>
            <div class="form-group clearfix">
                <button type="submit" class="btn btn-primary btn-lg btn-theme">Register</button>
            </div>
        </form>
@endsection
<!-- End Register -->