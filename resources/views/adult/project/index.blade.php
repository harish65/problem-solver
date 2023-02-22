@extends('adult.layouts.adult')
@section('title', 'Problem | Adult')   
 
@section('content')
<div class="container">
      <div class="bannerSection">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="bannerLeftSide">
            <h1>Welcome to The Speak Logic</h1>
            <h1><span>Problem Solver</span></h1>
            <h5>Think logically to solve problems </h5>
          </div>
        </div>
        <div class="col-md-6">
          <div class="bannerImg">
            <img src="{{ url('/') }}/assets-new/images/banner-adult-dashboard.png" alt="Banner Image"/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h4>List of Projects</h4>
        </div>
        <div class="col-md-6">
          
          <div class="text-end">
            <div class="form-check">
              <label class="form-check-label">  Grid View</label>
                <input type="checkbox" class="form-check-input" id="form-check-input" value="">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner section End -->
  
  @include('adult.project.grid', [$project])
  @include('adult.project.table', [$project])      
      
  @include('adult.project.modal.add-project')
@endsection

@section('scripts')
<script>
  $(document).on('click','#btnSave',function(e){
        e.preventDefault();
        var fd = new FormData($('#project-modal')[0]);
        $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        
        $.ajax({
            url: "{{route('adult.store')}}",
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
                  $('#btnSave').html('Login');
                  var errors = response.data;
                  $.each( errors, function( key, value ) {
                      toastr.error(value)
                  });
              } else {
                  toastr.success('Record saved successfully!');
                  window.location.href = "{{route('adult.dashboard')}}";
              }
            }
        });
    });
</script>
<script>
  $(document).on('change' , '.form-check-input' , function(){
      if($(this).is(':checked')){
        // alert('table view')
        $('#table-view').removeClass('d-none')
        $('#grid-view').addClass('d-none')
      }else{
        $('#grid-view').removeClass('d-none')
        $('#table-view').addClass('d-none')
      }
  })
</script>

<script>
  $(document).on('click' , '.editBtn' , function(){
       $('#project_id').val($(this).attr('data-id'))
       $('#name').val($(this).attr('data-title'))
       $('#addprojectModal').modal('toggle')
  })
</script>
<script>
  $(document).on('click', '.deleteBtn', function(e){
         e.preventDefault();
         var r = confirm("Are you sure to delete");
         if (r == false) {
             return false;
         }
         var id = $(this).attr('data-id')
         $.ajaxSetup({
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
               });      
         $.ajax({
               url: "{{route('adult.delete')}}",
               data:{id :  id},         
              
               type: 'post',           
               error: function (xhr, status, error) {
                   $.each(xhr.responseJSON.data, function (key, item) {
                       toastr.error(item);
                   });
               },
               success: function (response){
                   if(response.success == false)
                   {
                       var errors = response.data;
                       $.each( errors, function( key, value ) {
                           toastr.error(value)
                       });
                   } else {
                       toastr.success('Problem deleted successfully!');
                       window.location.href = "{{route('adult.dashboard')}}";
                   }
               }
           });
     });
</script>

@endsection


