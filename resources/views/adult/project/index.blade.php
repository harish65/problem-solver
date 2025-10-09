@extends('adult.layouts.adult')
@section('title', 'Project | Adult')   
 
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
        <div class="col">
          <h4>List of Projects</h4>
        </div>
        <div class="col">          
          <div class="text-end">
            <div class="form-check">
              <label class="form-check-label"> Grid View</label>
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
  @include('adult.project.modal.report-modal')
  
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
  $(document).on('change' , '#form-check-input' , function(){
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
        $('#modal_title').text('Edit Project');
       $('#project_id').val($(this).attr('data-id'))
       $('#name').val($(this).attr('data-title'))
       $('#addprojectModal').modal('toggle')
  })
  $(document).on('click' , '#btnCreate' , function(){
    $('#modal_title').text('Add New Project');
    $('#project-modal').find('input').val('');
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
         var id = $(this).data('id')
         
         $.ajaxSetup({
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
               });      
         $.ajax({
               url: "{{route('adult.delete')}}",
               data:{id:id}, 
               type: 'post',   
               async: false,        
               error: function (xhr, status, error) {
                   $.each(xhr.responseJSON.data, function (key, item) {
                       toastr.error(item);
                   });
               },
               success: function (response){
                console.log(response.success)
                   if(response.success == false)
                   {
                       var errors = response.data;
                       $.each( errors, function( key, value ) {
                           toastr.error(value)
                       });
                   } else {
                       toastr.success(response.message);
                       window.location.href = "{{route('adult.dashboard')}}";
                   }
               }
           });
     });
</script>

  <script>
    $('.project-grid').on('click',function(){
        var url = "{{ route('adult.solution') }}" + "/" + $(this).attr('data-params') ;
        localStorage.setItem("sol",url);
        var href = localStorage.getItem("sol");
        $('.nav-solution').attr('href' , href)

        var url_fun = "{{ route('adult.solution-func') }}" + "/" +$(this).attr('data-params') ;
        localStorage.setItem("sol-fun",url_fun);
        var hrefsolfun = localStorage.getItem("sol-fun");
        $('.nav-solution-func').attr('href' , hrefsolfun)

        var url_ver = "{{ route('adult.varification') }}" + "/" + $(this).attr('data-params') ;
        localStorage.setItem("varification",url_ver);
        var hrefverification = localStorage.getItem("varification");        
        // if (typeof hrefverification !== 'undefined') {
            $('.nav-varification').attr('href', hrefverification)
        // }
    })
</script>

<script>
 

$('input[type=radio]').on('change', function(){
   if($(this).val() == 1){
      $('.project_permission').css('display', 'block')
   }else if($(this).val() == 0){
    $('.project_permission').css('display', 'none')
      if ($('input[type=checkbox]').is(':checked')) {
        $('input[type=checkbox]').val('0').prop('checked' , false);
      }
   }
})


$(document).on('click', '.project-report', function (e) {
    e.preventDefault(); 
    // Get data from clicked link
    var projectId = $(this).data('item');
    var project_name = $(this).data('item_name');
    $('#p_name').val(project_name);
    $('#projectID').val(projectId);

    
  $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.getProjectUsers')}}/" + projectId,
           type: 'GET',
           beforeSend: function(){
             $('#btnUpdate').attr('disabled',true);
             $('#btnUpdate').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
           },
           error: function (xhr, status, error) {
               $('#btnUpdate').attr('disabled',false);
               $('#btnUpdate').html('Save changes');
               $.each(xhr.responseJSON.data, function (key, item) {
                   toastr.error(item);
               });
           },
           success: function (response){
             if(response.success == false)
             {
                 $('#btnUpdate').attr('disabled',false);
                 $('#btnUpdate').html('Save changes');
                 var errors = response.data;
                 $.each( errors, function( key, value ) {
                     toastr.error(value)
                 });
             } else {
                let select = $('#userSelect');
                    select.empty().append('<option selected="true" disabled="disabled">Select User..</option>');
                           data = response;
                    data.forEach(function(user) {
                        select.append(`<option value="${user.id}">${user.name}</option>`);
                    });
                   
              }
           }
       });
    // Show modal
    $('#reportmodal').modal('show');
});

</script>
<script>
$('#getReport').on('click' , function(e){
  e.preventDefault();  
     if(!$('#userSelect').val() || !$('#p_name').val() || !$('#projectID').val()){

      return toastr.error('There is an issue to load report');toastr.error('There is an issue to load report');
      window.location.href = '/adult/dashboard';
      return;
     }
    
    let baseAction = $('#project-report-modal').attr('action');
    let newAction = `${baseAction}?name=${encodeURIComponent($('#p_name').val())}&project_id=${encodeURIComponent($('#projectID').val())}&user_id=${encodeURIComponent($('#userSelect').val())}`;
    $('#project-report-modal').attr('action', newAction);

    $('#project-report-modal').submit();
})


</script>
@endsection


