@extends('layouts.app')

@section('login_content')

    <h3>Verify Your Email Address</h3>
    <div class="clearfix"></div>
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <form class="d-inline" action="{{ route('verification.resend') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="first_field" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="first_field" placeholder="Email Address" aria-label="Email Address">
        </div>
        <div class="form-group clearfix">
            <button type="submit" class="btn btn-primary btn-lg btn-theme">Click Here To Request Another</button>
        </div>
    </form>
@endsection
