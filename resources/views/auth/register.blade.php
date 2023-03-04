@extends('layouts.new.auth')
@section('title', 'Register')

@section('content')

<div class='register'>
    <div class="container">
      <div class="register-form">
        <h2>Welcome to Speak Logic Problem Solver</h2>
        <form class="defform" id="rj-form" method="POST">
          <div class="row">
            <div class="col-5">
              <div class="image-upload text-center">
                <div class="upload-img">
                    <img src="{{ URL::to('/') }}/assets-new/images/profile.png" alt="" id="image" style="border: 2px solid black; width: 218px; height: 220px;" />
                   
                </div>
                <div class="upload-btn">
                  <button type="button">
                  
                    <span>Upload File</span>
                  </button>
                </div>
                <input accept="image/*" name="avatar" type="file" id="files" class="d-none"/>
              </div>
            </div>
            <div class="col-7">
              <div class="form-group">
                <input type="text" class="form-control name" placeholder="First Name" name="first_name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control name" placeholder="Last name" name="last_name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control phone" placeholder="Phone Number" name="phone_number">
              </div>
              <div class="form-group">
                <input type="email" class="form-control email" placeholder="Enter email" name="email">
              </div>
            </div>
          </div>
          <div class="form-group">
            <select class="form-control select" name="role" id="role">
              <option>Select Type</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
            </select>
          </div>
          <div class="form-group">
            <input type="password" class="form-control password" id="pwd" placeholder="Password" name="password">
            <button class="eye">
              <img src="{{ URL::to('/') }}assets-new/images/eye.png" alt="" />
            </button>
          </div>
          <div class="form-group">
            <input type="password" class="form-control password" id="pwd" placeholder="Re type password" name="password_confirmation">
            <button class="eye">
              <img src="{{ URL::to('/') }}assets-new/images/eye.png" alt="" />
            </button>
          </div>
          <div class="btns-wrap d-flex justify-content-center mt-5 mb-5">
            <button type="button" class="btn btn-primary login-btn"><a href="{{ route('login') }}">Login</a></button>
            <button type="button" class="btn btn-primary login-btn reagister">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('scripts')

<script>
    $('.upload-btn').click(function(){
      $('#files').trigger('click');
    })
    $('#files').on('change',function(){
      var src = URL.createObjectURL(this.files[0])
        $('#image').attr('src' , src);
      })
    


  $(document).on('click','.reagister', function(e){
    
   e.preventDefault();   
    var fd = new FormData($('#rj-form')[0]); 
        $.ajaxSetup({
              headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
         });
         $.ajax({
            url: "{{ route('register')}}", 
            data: fd,          
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
         beforeSend: function(){
         $('.reagistern').attr('disabled',true);
         $('.reagister').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
         },
         error: function (xhr, status, error) {          
          $('.reagistern').attr('disabled',false);
          $('.reagister').html('Sign Up');
            $.each(xhr.responseJSON.data, function (key, item) {
               toastr.error(item);
            });
                
            
         },
         success: function (response){  
          $('.reagistern').attr('disabled',false);
          $('.reagister').html('Sign Up');                               
            if(response.success == false){
                  var errors = response.data;
                    $.each( errors, function( key, value ) {
                    toastr.error(value)
                });  
              
                                          
            }else{               
               toastr.success(response.message);
               window.location.href='{{ route("login") }}';
            }
         }
         
      })
      
})
</script>
@endsection
