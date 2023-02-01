@extends('layouts.new.auth')
@section('title', 'Login')

@section('content')

<div class="col-md-6 col-lg-7">
    <img src="assets/vendors/images/login-page-img.png" alt="">
</div>
<div class="col-md-6 col-lg-5">
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Login</h2>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg @error('email') form-control-danger @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-email-1"></i></span>
                </div>
                @error('email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group custom">
                <input type="password" class="form-control form-control-lg @error('password') form-control-danger @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
                @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row pb-30">
                <div class="col-6">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheck1">Remember</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="forgot-password">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Forgot Password
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">            
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Login">
                    </div>
                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
                    <div class="input-group mb-0">
                        <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route("register") }}">Register To Create Account</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
