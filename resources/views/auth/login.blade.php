@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="registration-form">
    <form class="form-horizontal" method="post" action="{{ route('login') }}" autocomplete="off">
        @csrf
        <div class="form-icon">
            <span><i class="fa fa-user"></i></span>
        </div>
        <div class="text-center">
            <h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
        </div>

        @include('partials.alert', ['name' => 'login', 'forced_alert' => ($errors->has('email')) ? ['status' => 'danger', 'message' => $errors->first('email')] : null])
        <div class="form-group">
            <input type="text" class="form-control item{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
            @if($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            @endif
        </div>
        <div class="form-group">
            <input type="password" class="form-control item {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
        </div>

        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn btn-block create-account">Login</button>
        </div>
    </form>
    <div class="social-media">
        <div class="text-muted form-group"><span>Don't have an account?</span></div>
        <a href="{{ route('register') }}" class="btn btn-default btn-block content-group">Create Account</a>
    </div>
</div>


@endsection


