@extends('layouts.app')

@section('login_content')
    <div class="page-title mb-3">
        <h4>Verify Your Email Address</h4>
    </div>
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
            <label for="email" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="email" placeholder="Email Address" aria-label="Email Address">
        </div>
        <div class="form-group clearfix">
            <button type="submit" class="btn btn-submit">Click Here To Request Another</button>
        </div>
    </form>
@endsection
