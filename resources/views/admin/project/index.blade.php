@extends('admin.layouts.master')
@section('title', 'Home | Admin')

@section('content')
<!-- Banner section start -->
  
<div class="container">
    <div class="bannerSection">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="bannerLeftSide">
            <h1>Welcome Back <span>Admin</span></h1>
            <h5>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad</h5>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bannerImg">
            <img src="{{ url('/') }}/assets-new/images/bannerImage.png" alt="Banner Image"/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h4>List of Projects</h4>
        </div>
        <div class="col-md-6">
          
          <div class="gridCheck text-right">
            <div class="form-check">
              <label class="form-check-label">Grid View
                <input type="checkbox" class="form-check-input" value="">
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
   <div class="projectlist lower-section">
        <div class="container">
            <div class="row">
                
                    <div class="col-xs-12">
                        <div class="solver-text text-center">
                            <p>Solver By <span>{{ 'Mr:'.Auth::user()->name}}</span></p> 
                        </div>
                    </div>
               
            </div>
        
        </div>
</div>  
  
   
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('assets-new/css/style.css') }}">
@endsection
@section('scripts')
<script type="text/javascript">
	
	$(document).on('click','#btnSave',function(e){
		e.preventDefault();
		var fd = new FormData($('#add-project')[0]);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
		$.ajax({
			url: "{{ route('project.store')}}",
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
                    window.location.href = "{{route('dashboard.index')}}";
				}
			}
		});
	});
</script>
@endsection


