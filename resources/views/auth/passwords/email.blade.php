@extends('layouts.new.auth')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class='login'>
    <div class="container">
        <div class="login-form" >
            <div class="logo-wrap">                
                <img src="{{ URL::to('/') }}/assets/img/logos/new-logo-01.svg" width="200" height="200" alt="logo"/>
                <h3>Forgot Password</h3>
            </div>
            <form method="POST" id="login-form" action="{{route('password.email')}}">
                @csrf
                <div class="form-group">
                  <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                
                <button type="submit" class="btn btn-primary login-btn" id="btnLogin">{{ __('Send Password Reset Link') }}</button>
                
              </form>
                <br>
                Or
              <div class="form-group">
                  <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                </div>
             
        </div>


    </div>
</div>

@endsection
