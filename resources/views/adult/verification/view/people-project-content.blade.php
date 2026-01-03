@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
<?php $ShowMessage =  false; ?>
@php
$VerificationPermission = \App\Models\Verification::CheckVerificationPermission($project_id);
@endphp
<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                      <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                      ?>
                      

                      @include('adult.verification.view.component.common_routes')
                      @include('adult.verification.view.component.verification_types')
            </div>
        </div>
    </div>
   
    <!-- Content Section Start -->
    <div class="relationshipContent">
        
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>
                    <div class="relationImage text-center">
                        <img src="{{ asset('assets-new/verification_types/' . @$verificationType->banner)}}" alt="relationImage" />
                        
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                <!-- start -->
                @foreach ($custommers as $user)
                <div class="blockProblem">
                    <div class="projectBlock text-center">
                      <h2>People</h2>
                      <div class="projectList text-center">          
                        <div class="imgWrp">
                            <img class="mx-auto" src="{{ asset('assets-new/users/'.$user->file) }}" width="100%" height="128px">
                        </div>
                        <p class="redText">{{ ucfirst($user->name) }}</p>
                        <p>{{ ucfirst($user->type) }}</p>
                      </div>
                      
                    </div>
                  </div>
                  @endforeach
                <!-- End -->
                
            </div>
            <div class="row">
                @if($VerificationPermission)
                    <div class="modal-btn">
                        <a type="button" href="#" class="btn btn-success float-right mb-3"  id="add_people">+ Add New User</a>
                    </div>
                @endif
                @if($custommers->count() > 0)
                <?php $ShowMessage =  true; ?>
                <table class="table slp-tbl text-center">
                    <thead>
                        <tr>
                            <td>Person Name</td>
                            <td>Person Title</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($custommers as $user)
                        <tr>
                            <td>
                                {{ ucfirst($user->name) }}
                            </td>
                            <td>
                                {{ ucfirst($user->type) }}
                            </td>
                            <td>
                            @if($VerificationPermission)
                                <a href="javaScript:Void(0)"  data-href="{{ route('problem.delete') }}" data-id = "{{ $user->id }}" class="delProblemBtn" title="Delete" ><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" width="15" height="20"></a>
                                &nbsp;
                                <a href="javaScript:Void(0)"  class="editProblemBtn"
                                                                                        data-id = {{ $user->id }}
                                                                                        data-name = {{ $user->name }}
                                                                                        data-type = {{ $user->type }}
                                                                                        data-file = {{ $user->file }}><img src="{{ url('/') }}/assets-new/images/editIcon.png" width="15" height="20"></a>

                                @else
                                <img src="{{ url('/') }}/assets-new/images/deleteIcon.png" width="15" height="20">
                                <img src="{{ url('/') }}/assets-new/images/editIcon.png" width="15" height="20">
                            
                                                                                        @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @if($custommers->count() > 0)
            <div class="questionWrap">
        

                <h2>Validation Question</h2>
                <br>
                <form id="validation_form">
                        <input type="hidden" name="id" value="{{ @$verification->id }}"> 
                        <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}"> 
                        <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                        <input type="hidden" name="project_id" value="{{ $project_id }}">
                        <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                        <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                        <input type="hidden" name="name" id="People_in_Project" value="People_in_Project">     
                            
                            

                        
                        <h5>Are you part of that project?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}  value="1" {{ (!$VerificationPermission) ? 'disabled':'' }}>&nbsp;&nbsp;Yes, I am part of that project</label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}  value="2" {{ (!$VerificationPermission) ? 'disabled':'' }}>&nbsp;&nbsp;No, I am not part of that project</label></li>
                        
                        </ul>
        
                        <h5>Do you have a function in that project?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }}  value="1" {{ (!$VerificationPermission) ? 'disabled':'' }}>&nbsp;&nbsp;Yes, I do have a function in that project</label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}  value="2" {{ (!$VerificationPermission) ? 'disabled':'' }}>&nbsp;&nbsp;No, I do not have a function in that project</label></li>
                        
                        </ul>
                        <h5>Do you involve in that project?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_3" {{ (@$verification->validations->validation_3 == 1) ? 'checked' : '' }}  value="1" {{ (!$VerificationPermission) ? 'disabled':'' }}>&nbsp;&nbsp;Yes, I involve in that project</label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_3" {{ (@$verification->validations->validation_3 == 2) ? 'checked' : '' }}  value="2" {{ (!$VerificationPermission) ? 'disabled':'' }}>&nbsp;&nbsp;No, I don’t involve in that project</label></li>
                        
                        </ul>
                        @if($VerificationPermission)
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        @endif
                </form>
                
            </div>
            @endif
            
        </div>
        
    </div>
    <!-- Content Section End -->
    
    
    
    
    <!-- Modal End -->
</div>
<!-- Modal start -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add People</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formUsers">
        <div class="modal-body">
          <div class="form-group" id="userPic">
              <label for="exampleInputEmail1">Upload Image</label>
              <input type="file" name="file" data-height="150" id="file" class="dropify" accept="image/*, video/*">
              <input type="hidden" id="user_id" name="id" value="">
              <input type="hidden" name="project_id" value="{{ $project_id }}">
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1">People</label>
              <input type="text" name="name"  class="form-control"  id="name" placeholder="Enter name">
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1">Title</label>
              <input type="text" name="type" id="type" class="form-control" placeholder="Title">
          </div>
          
         
          </form>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="saveBtn">Save</button>
        </div>
      </div>
      </div>
    </div>
  </div>
  <!-- Modal End -->
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
   
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
});
$('#verification_users').on('change', function () { 
        var verification_type_id = $('#verification_types').val();
        var id = $(this).val();
        window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + verification_type_id + '/' + id;
    });
$('.dropify').dropify();


</script>
<script>
routes();


$('.dashboard').click(function(){
    routes();
})

$('.validation').on('change',function(){
        var problem = $(this).attr('data-id');
        var validation  = $(this).val();
        var name = $(this).attr('name')
        $.ajaxSetup({
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
               }); 
        $.ajax({
           url: "{{route('adult.sol-validation')}}",
           data: {data : problem , value : validation , name : name},
           type: 'POST',
           success: function (response){                
               console.log(response)
            }

        })



   })


   $('#add-varification-button').click(function(){
   
        if($('#verification_types').val() == ''){
            toastr.error('Please select verification type first');
            return false;
        }
        $('#createVerification').modal('toggle')
   })
//.editSolFunBtn

$('.editverBtn').click(function(){
   $('#createVerification').modal('toggle')
})



   $('.filetypeRadio').change(function(){
        var type = $(this).val()
        if(type == 0){
            $('#fileType').val('0')
            $('#imageFile').css("display", "block");
            $('#youtubeLink').css("display", "none");
        }if(type == 2){
            $('#fileType').val('2')
            $('#imageFile').css("display", "none");
            $('#youtubeLink').css("display", "block");
        }
   })




   $(document).on('click','#btnSave',function(e){
       e.preventDefault();
       var fd = new FormData($('#createVerificationForm')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.store-verification')}}",
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
                
                 toastr.success(response.message);
                 location.reload()
                //  if(response.data.params != '' && typeof response.data.params  != 'undefined'){
                //     window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params 
                //  }else{


                    
                    // window.location.href = "{{ route('adult.dashboard')}}"
                //  }
                 
              }
           }
       });
   });


</script>
<script>    
   
    $(document).on('click','#saveBtn',function(e){
       e.preventDefault();
       var fd = new FormData($('#formUsers')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.create-user')}}",
           data: fd,
           processData: false,
           contentType: false,
           dataType: 'json',
           type: 'POST',
           beforeSend: function(){
             $('#saveBtn').attr('disabled',true);
             $('#saveBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
           },
           error: function (xhr, status, error) {
               $('#saveBtn').attr('disabled',false);
               $('#saveBtn').html('Submit');
               $.each(xhr.responseJSON.data, function (key, item) {
                   toastr.error(item);
               });
           },
           success: function (response){
             if(response.success == false)
             {
                $('#saveBtn').attr('disabled',false);
                $('#saveBtn').html('Login');
                var errors = response.data;
                $.each( errors, function( key, value ) {
                     toastr.error(value)
                });
             } else {
                toastr.success(response.message);
                window.location.reload();
              }
           }
       });
   });
</script>
<script>
    $('.editProblemBtn').click(function(){
        
        $('#name').val($(this).data('name'))   
        $('#exampleModalLabel').text('Edit People') 
        if($(this).file != ""){
            var file = $(this).data("file");
            var drEvent = $('#file').dropify({
                defaultFile: "/assets-new/users/" + file
            });
            drEvent = drEvent.data('dropify');
               drEvent.resetPreview();
               drEvent.clearElement();
               drEvent.settings.defaultFile = "/assets-new/users/" + file;
               drEvent.destroy();
               drEvent.init();	
           }
           $('#type').val($(this).attr('data-type'))       
           $('#user_id').val($(this).attr('data-id'))       
       
        $('#exampleModal').modal('toggle')
    })
    $('#add_people').on('click',function(){
        $('#formUsers')[0].reset();  
        $(".dropify-clear").trigger("click");
        $('#exampleModalLabel').text('Add People') 
        $('#exampleModal').modal('toggle')
    })


$('.delProblemBtn').click(function(e){

        e.preventDefault();
       var r = confirm("Are you sure to delete this records");
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
           url: "{{route('adult.delete-user')}}",
           data: {'id': id},
           dataType: 'json',
           type: 'POST',
           success: function (response){
             if(response.success == false)
             {
                 var errors = response.data;
                 $.each( errors, function( key, value ) {
                     toastr.error(value)
                 });
             } else {
                
                 toastr.success(response.message);
                 location.reload()  
              }
           }
       });
    })
    var ShowMessage =  "{{$ShowMessage}}";
        if(!ShowMessage){
            
        // swal({
        //     title: "People in Project",
        //     text: 'To solve a problem, the problem must be identified, the solution of that problem, as well as people who are working to solve that problem.  In terms of identification, it is good to show the people who are working in that project to solve that problem.  If the people have not been identified, then it is not possible for them to be identified in a project to work to solve the underlying problem.  Please, refer to the Person/People page to first identify the people before showing them the project.',
        //     type: "Error",
        //     showCancelButton: true,
        //     confirmButtonColor: '#00A14C',
        // });
    
        }
</script>
@endsection