@extends('layouts.auth')

@section('title', 'Create new Account')

@section('content')
    @php $params =  (isset($user_data['code'])) ? ['code' => $user_data['code']] : []; @endphp
    <div class="registration-form">
        <form class="form-horizontal" method="post" action="{{ route('register', $params) }}" autocomplete="off">
            @csrf
            <div class="form-icon">
                <span><i class="fa fa-user"></i></span>
            </div>
            <div class="text-center">
                <h5 class="content-group">Create an account <small class="display-block">All fields are required</small></h5>
            </div>

            <div class="form-group">
                <input type="text" class="form-control item{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autofocus>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control item{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" placeholder="First Name" value="{{ old('last_name') }}" required autofocus>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
            </div>
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
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control item {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" class="btn btn-block create-account">SignUp</button>
            </div>
        </form>
        <div class="social-media">
            <div class="text-muted form-group"><span>Have an account already?</span></div>
            <a href="{{ route('login') }}" class="btn btn-default btn-block content-group">Login</a>
        </div>
    </div>
@endsection

