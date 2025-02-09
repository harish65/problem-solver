@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
@php $showMessage = true; 
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
                <div class="principleRelation">
                    <ul class="inner-card">
                        @foreach($custommers as $user)
                        <li>
                            <div class="blockProblem">
                                <div class="projectBlock text-center">
                                    <h2>People</h2>
                                    <div class="projectList text-center">
                                        <div class="imgWrp">
                                            <img class="mx-auto"
                                                src="{{ asset('assets-new/users/'.$user->file)}}" width="100%"
                                                height="128px">
                                        </div>
                                        <p class="redText" style="color:red">{{ $user->name }}</p>
                                        
                                        <p class="redText">{{ $user->type }}</p>
                                    </div>
                                    <div class="">
                                    @if($VerificationPermission)
                                        <button class="btn btn-success communicate" data-id="{{ $user->id }}" data-customer_id="{{ $user->id }}" data-name = "{{ $user->name }}"  value="communicate">Communication</button>
                                        <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                        @else
                                            <button class="btn btn-success" disabled>Communication</button>
                                            <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                      </li>
                       @endforeach
                    </ul>
                    <div class="row mt-5">
                    <div class="title d-flex">
                        <h2>People Communation</h2>
                    </div>
                    @if($custommers->count()>0)
                    <?php $showMessage = false; ?>
                    @if($communications->count() > 0)
                            <table class="table slp-tbl text-center">
                            <thead>      
                                <th>From Person</th>
                                <th>To Person</th>
                                <th>Date</th>                            
                                <th>Subject</th>                            
                                <th>Actions</th>
                                
                            </thead>
                                <tbody>
                                    @foreach ($communications as $communication)
                                            <tr>
                                                <td>{{ App\Models\Customer::getCustomerName($communication->customer_id)}}</td>
                                                <td>{{ App\Models\Customer::getCustomerName($communication->person_to)}}</td>
                                                <td>{{ date('d-m-Y' , strtotime($communication->created_at) ) }}</td>
                                                <td>{{ $communication->title }}</td>
                                                
                                                <td>
                                                @if($VerificationPermission)
                                                    <a href="javaScript:void(0)" class="delete_"  data-id="{{ $communication->id }}">
                                                        <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                    </a>
                                                
                                                    <a href="javaScript:void(0)" class="view" data-id="{{ $communication->id }}" data-person_one="{{ $communication->customer_id }}"  data-person_two="{{ $communication->person_to }}" data-title="{{ $communication->title }}" data-comment="{{ $communication->comment }}" >
                                                    <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                    </a>
                                                    @else
                                                        <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                        <a href="javaScript:void(0)" class="view" data-id="{{ $communication->id }}" data-person_one="{{ $communication->customer_id }}"  data-person_two="{{ $communication->person_to }}" data-title="{{ $communication->title }}" data-comment="{{ $communication->comment }}" >
                                                        <i class="fa fa-eye"></i></a>

                                                    @endif

                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        @endif
                    </div>
                    <div class="questionWrap">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                        <h2>Validation Question</h2>
                        <br>
                        <form id="validation_form">
                            <input type="hidden" name="id" value="{{ @$verification->id }}"> 
                            <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}"> 
                            <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                            <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                            <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                            <input type="hidden" name="name" id="name" value="People_in_Project">     
                        <h5>Have you separated the people in the project from their communication?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}  value="1" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;Yes, I have separated the people in the project from their communication</label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} value="2" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;No, I have not separated the people in the project form their communication</label></li>
                           
                        </ul>

                        <h5>Do you understand that separation of people and communication is important in a project?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }}  value="1" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;Yes, I do understand that separation of people and communication is important in a project</label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}  value="2" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;No, I don’t understand that separation of people and communication is important in a project</label></li>
                           
                        </ul>
                        @if($VerificationPermission)
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        @endif
                        </form>
                        
                    </div>
                </div>
                <!-- End -->
                
            </div>
        </div>
    </div>
    <!-- Content Section End -->
    
     <!-- Modal start -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Person Communication</h5>
                <button type="button" class="close close_mdl" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="comm_form" method="post">
                <input type="hidden" id="project_id" name="project_id" value="{{ $project_id}}">
                <input type="hidden" id="problem_id" name="problem_id" value="{{ $problem_id}}">
                <input type="hidden" id="user_id" name="user_id" value="">
                <input type="hidden" id="id" name="id" value="">
                        <div class="from-group mt-2">
                            <label for="person_1">From Person : Person One<span></span></label>
                            <select name="person_one" class="form-control form-select" id="person_1">
                                    <option value=''>Please select</option>
                                        @foreach($custommers as $user)
                                            <option value="{{ $user->id}}">{{ $user->name }}</option>
                                        @endforeach
                            </select>
                        </div>
                        <div class="from-group mt-2">
                            <label for="person_2">To Persone : Person Two<span></span></label>
                            <select name="person_to" class="form-control form-select" id="person_2">
                                    <option value="">Please select</option>
                                        @foreach($custommers as $user)
                                            <option value="{{ $user->id}}">{{ $user->name }}</option>
                                        @endforeach
                            </select>
                        </div>
                        <div class="from-group mt-2">
                            <label for="title_">Subject</label>
                            <input type="text" name="subject" class="form-control" id="title_" placeholder="Subject">
                        </div>
                        <div class="from-group mt-3">
                                <label for="msg">Message</label>
                                <textarea class="form-control " name="comment" id="msg"></textarea>
                        </div>
                      
                 </form>
            </div>
            <div class="modal-footer">
            @if($VerificationPermission)
   
                <button type="button" class="btn btn-secondary close_mdl" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSave">Submit</button>
                @endif
            </div>
            </div>
        </div>
    </div>
  
    <!-- Modal End -->
</div>

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .inner-card{
        margin: 0 30px;
        display: flex;
        gap:50px;
        list-style: none;
    }

    
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.tiny.cloud/1/5f20xhd98muhs1m7cl3eud00r4ugz5hxk5cbblquuo02mfef/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

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




   $(document).on('click','#btnSave',function(e){
       e.preventDefault();
       tinyMCE.triggerSave(true, true);
       var fd = new FormData($('#comm_form')[0]);
       $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });       
       $.ajax({
           url: "{{route('adult.communication_flow')}}",
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
                
              }
           }
       });
   });

$('.communicate').on('click',function(){
    $('#person_1 , #person_2 , #title_').val('')
    tinyMCE.activeEditor.setContent('');
    $('#exampleModal').modal('toggle')
    

})
    $('.edit').on('click',function(){
        $('#person_1').val($(this).data('person_one')).attr('disabled' , true)
        $('#person_2').val($(this).data('person_two')).attr('disabled' , true)
        $('#title_').val($(this).data('title')).attr('disabled' , false)
        $('#id').val($(this).data('id'))
        $('#btnSave').show();
        tinyMCE.activeEditor.setContent($(this).data('comment'));
        
       $('#exampleModal').modal('toggle');
    })
    $('.view').click(function(){
        $('#person_1').val($(this).data('person_one')).attr('disabled' , true)
        $('#person_2').val($(this).data('person_two')).attr('disabled' , true)
        $('#title_').val($(this).data('title')).attr('disabled' , true)
        $('#id').val($(this).data('id'))
        tinyMCE.activeEditor.setContent($(this).data('comment'));
        tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
        
        $('#btnSave').hide();
       $('#exampleModal').modal('toggle');
    })
$(document).on('click','.delete_',function(e){
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
           url: "{{route('adult.del-communication_flow')}}",
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
   });
  
</script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      height : "300"
    });


    var showMessage = "{{$showMessage}}"
    
    if(showMessage){
        swal({
            title: "{{$verificationType->error_title}}",
            text: "{{$verificationType->message}}",
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    }

    $('#solutio_functio_div').addClass('d-none');
    $('#solution_div').removeClass('d-none')

    $('.close_mdl').click(function(){  location.reload()   })
  </script>
@endsection