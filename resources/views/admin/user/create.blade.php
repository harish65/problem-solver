@extends('admin.layouts.master')
@section('title', 'Home | Admin')

@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>User Manage</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url(" adminHome") }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Manage</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <form method="post" id="create-user-info">
            <div class="pd-20 mb-30 row">

                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" class="form-control"  id="name" name="name" placeholder="User name">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control"  id="first_name" name="first_name"
                                placeholder="First name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Last Name</label>
                            <input type="text" class="form-control"  id="last_name" name="last_name"
                                placeholder="Last name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" id="email"   name="email" placeholder="Email">
                        <input type="file" class="file hide" name="avatar" id="files" class="d-none">
                    </div>

                    <div class="footer text-right">
                        <button type="button" class="btn btn-primary" id="btnSave">Save changes</button>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <img src="{{ url('/') }}/assets/img/person.jpg" class="mCS_img_loaded" id="profilePic" style="border-radius: 50%;" width="200" height="250">
                        <div class="row">
                            <button class="btn btn-primary upload-btn" style="margin-top: 4%;margin-left: 9%;"
                                type="button">Upload Picture</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	
	$(document).on('click','#btnSave',function(e){
		e.preventDefault();
		var fd = new FormData($('#create-user-info')[0]);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
		$.ajax({
			url: "{{ route('user.store')}}",
			data: fd,
			processData: false,
			contentType: false,
			dataType: 'json',
			type: 'POST',
			beforeSend: function(){
                $('#btnSave').attr('disabled',true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
			},
			error: function (xhr, status, error) {
                $('#btnSave').attr('disabled',false);
                $('#btnSave').html('Submit');
				$.each(xhr.responseJSON.data, function (key, item) {
					toastr.error(item);
				});
			},
			success: function (response){
                if(response.success == false)
                {
					$('#btnSave').attr('disabled',false);
					$('#btnSave').html('Submit');
                    var errors = response.data;
                    $.each( errors, function( key, value ) {
						toastr.error(value)
					});
					} else { 
                    toastr.success(response.message);
                    window.location.href = "{{route('adminUser')}}";
				}
			}
		});
	});
</script>
<script>
    $('.upload-btn').click(function(){
      $('#files').trigger('click');
    })
    $('#files').on('change',function(){
      var src = URL.createObjectURL(this.files[0])
        $('#profilePic').attr('src' , src);
      })
</script>

@endsection
