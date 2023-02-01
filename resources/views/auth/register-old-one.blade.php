@extends('layouts.auth')
@section('title', 'Register')

@section('content')

<div class="col-md-6 col-lg-7">
    <img src="assets/vendors/images/register-page-img.png" alt="">
</div>
<div class="col-md-6 col-lg-5">
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Register</h2>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="select-role">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn active">
                        <input type="radio" name="role" value="1" id="adult" checked>
                        <div class="icon"><i class="icon-copy dw dw-user1"></i></div>
                        <span>I'm</span>
                        Adult
                    </label>
                    <label class="btn">
                        <input type="radio" name="role" value="2" id="parent">
                        <div class="icon"><i class="icon-copy dw dw-user"></i></i></div>
                        <span>I'm</span>
                        parent
                    </label>
                    <label class="btn">
                        <input type="radio" name="role" value="3" id="child">
                        <div class="icon"><i class="icon-copy dw dw-user"></i></i></div>
                        <span>I'm</span>
                        Child
                    </label>
                    <label class="btn">
                        <input type="radio" name="role" value="4" id="teacher">
                        <div class="icon"><i class="icon-copy dw dw-user"></i></i></div>
                        <span>I'm</span>
                        Teacher
                    </label>
                    <label class="btn">
                        <input type="radio" name="role" value="5" id="student">
                        <div class="icon"><i class="icon-copy dw dw-user"></i></i></div>
                        <span>I'm</span>
                        Student
                    </label>
                </div>
            </div>
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg @error('name') form-control-danger @enderror" placeholder="Full Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>            
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
                @error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
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
            <div class="input-group custom">
                <input type="password" class="form-control form-control-lg" placeholder="Password again" name="password_confirmation" required autocomplete="new-password">
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-key1"></i></span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Register">
                    </div>
                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
                    <div class="input-group mb-0">
                        <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route("login") }}">Login</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
