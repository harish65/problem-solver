@extends('layouts.new.auth')
@section('title', 'Admin | Login')

@section('content')
<div class='login'>
    <div class="container">
        <div class="login-form">
            <div class="logo-wrap">
                <img src="{{ URL::to('/') }}/assets-new/images/logo.png" alt="logo"/>
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
                 
                </div>
                <button type="submit" class="btn btn-primary login-btn" id="btnLogin">Login</button>
              </form>
           
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
            url: "{{route('admin.login')}}",
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
                  window.location.href = "{{route('admin.index')}}";
              }
            }
        });
    });
</script>
@endsection




