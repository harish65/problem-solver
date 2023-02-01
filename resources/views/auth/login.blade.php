@extends('layouts.new.auth')
@section('title', 'Login')

@section('content')
<div class='login'>
    <div class="container">
        <div class="login-form" >
            <div class="logo-wrap">
                <!-- <img src="{{ URL::to('/') }}/assets-new/images/logo.png" alt="logo"/> -->
                <img src="{{ URL::to('/') }}/assets/img/logos/new-logo-01.svg" width="300" height="300" alt="logo"/>
            </div>
            <form method="POST" id="login-form">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control" id="email" placeholder="Enter user name or email" name="email" autocomplete="off">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="new-password" autocomplete="off">
                  <button class="eye">
                    <img src="{{ URL::to('/') }}/assets-new/images/eye.png" alt=""/>
                  </button>
                  <p class="text-right"><a href="{{ route('password.request') }}" class="forget">Forget password</a></p>
                </div>
                <button type="submit" class="btn btn-primary login-btn" id="btnLogin">Login</button>
              </form>
              <div class="continue">
                <p>Or Continue with </p>
                <ul class="social-media">
                    <li>
                        <a href="#"><img src="{{ URL::to('/') }}/assets-new/images/facebook.png" alt=""/></a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ URL::to('/') }}/assets-new/images/twitter.png" alt=""/></a>
                    </li>
                    <li>
                        <a href="#"><img src="{{ URL::to('/') }}/assets-new/images/google.png" alt=""/></a>
                    </li>
                </ul>
                <a class="signup" href="{{ route("register") }}">Sign up</a>
              </div>
        </div>


    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).on('click','#btnLogin',function(e){
        e.preventDefault();
        var fd = new FormData($('#login-form')[0]);
        $.ajax({
            url: "{{route('user.login')}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function(){
              $('#btnLogin').attr('disabled',true);
              $('#btnLogin').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnLogin').attr('disabled',false);
                $('#btnLogin').html('Login');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
              if(response.success == false)
              {
                  $('#btnLogin').attr('disabled',false);
                  $('#btnLogin').html('Login');
                  var errors = response.data;
                  $.each( errors, function( key, value ) {
                      toastr.error(value)
                  });
              } else {
                  toastr.success('User login successfully!');
                  window.location.href = "{{route('user.dashborad')}}";
              }
            }
        });
    });
</script>
@endsection

