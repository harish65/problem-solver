@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
<?php $showMessage = null;?>
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
                @if(!empty($users[0]->comment) )
                <?php $showMessage = false;?>
                <div class="principleRelation ">
                    <div class="heading_comm">
                        <div class="md-col-6">

                        </div>
                        <div class="md-col-6">
                            <h4>Communication Flow</h4>
                        </div>
                        
                    </div>
                    <div class="d-flex">
                        <ul class="">
                            @foreach($users as $k=>$user)
                            <div class="d-flex ">
                                
                                <li>
                                    <div class="blockProblem">
                                        <div class="projectBlock text-center">
                                            <h2>Person</h2>
                                            <div class="projectList text-center">
                                                <div class="imgWrp">
                                                    <img class="mx-auto" src="{{ asset('assets-new/users/'.$user->file)}}" width="100%" height="128px">
                                                </div>  
                                                <div class="person_name">
                                                    <span>{{ $user->name }}</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>
                                <li class="communication_process">
                                    <div>
                                        <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                                        <!-- add arrow Image over here  -->
                                    </div>
                                </li>
                                
                                
                            </div>
                            @endforeach
                        
                        </ul>
                       
                        <ul class="custom_ul">
                                    <li><h6><strong>Communication Mixture</strong></h6></li>
                                            @foreach($users as $k=>$user)
                                                <li class="custom_li">
                                                    <div class="person_name_ ">
                                                        <button class="btn btn-success _communication" data-com-date="{{ date('m/d/Y' , strtotime($user->created_at) ) }}" data-comment="{{ $user->comment }}" data-title="{{ $user->title }}" data-id="{{ $user->id }}" data-person_one="{{ $user->customer_id }}"  data-person_two="{{ $user->person_to }}"  > {{ $user->name }} : Communication</button>
                                                    </div>
                                    </li>  
                                    @endforeach      
                        </ul>
                        
                    </div>
                    <div class="questionWrap">
                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
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
                        <h5>Do I communicate with others to solve the underlying problem?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} value="1" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;Yes, I communicate with others to solve the problem</label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} value="2" {{ (!$VerificationPermission) ? 'disabled':'' }} >&nbsp;&nbsp;No, I do not communicate with others to solve the problem</label></li>
                           
                        </ul>
                        @if($VerificationPermission)
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        @endif
                        </form>
                    </div>
                </div>
                <!-- End -->

                @endif
            </div>
            <div class="row pt-5">
                @include('adult.quiz.quiz-component' , [$project->id , $pageId , $pageType])
            </div>
        </div>
    </div>
    <!-- Content Section End -->
</div>
<!-- Modal start -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Person Communication</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                            <label for="person_1">From Person : Person 1<span></span></label>
                            <select name="person_one" class="form-control form-select" id="person_1" disabled>
                                    <option value="">Please select</option>
                                        @foreach($custommers as $user)
                                            <option value="{{ $user->id}}">{{ $user->name }}</option>
                                        @endforeach
                            </select>
                        </div>
                        <div class="from-group mt-2">
                            <label for="person_2">To Persone : Person 2<span></span></label>
                            <select name="person_to" class="form-control form-select" id="person_2" disabled>
                                    <option value="">Please select</option>
                                        @foreach($custommers as $user)
                                            <option value="{{ $user->id}}">{{ $user->name }}</option>
                                        @endforeach
                            </select>
                        </div>
                        <div class="from-group mt-2">
                            <label for="title_">Communication Date</label>
                            <input type="text" name="communication_date" class="form-control" id="communication_date" value="" placeholder="mm/dd/YY" disabled>
                        </div> 
                        <div class="from-group mt-2">
                            <label for="title_">Subject</label>
                            <input type="text" name="subject" class="form-control" id="title_" placeholder="Subject" disabled>
                        </div> 
                        <div class="from-group mt-3">
                                <label for="msg">Message</label>
                                <textarea class="form-control " name="comment" id="msg"></textarea>
                        </div>
                      
                 </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
            </div>
        </div>
    </div>
    
    <!-- Modal End -->
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    ul{
        list-style: none;
    }
    .long-arrow-flow{
        position: relative;
        top:45%;
        padding-top: 75%;
    }
    .li_com{
        margin-top: 100%;
    }
    .communication_process{
        margin-top: 25%;
        padding: 2%;
    }
    .communication_mixture{
        margin-top: 50%;
    }
    .custom_ul{
        background: #FFFFFF;
        border: 1px solid rgba(0, 161, 76, 0.5);
        border-radius: 10px;
        margin: 10px 0;
        padding: 2%;
        margin-left: 2%;
        width: 215px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .custom_li{
        min-height: 220px;
        margin-top: 15%;
       
    }
    .person_name_{
        padding-top: 30%;
    }
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.tiny.cloud/1/5f20xhd98muhs1m7cl3eud00r4ugz5hxk5cbblquuo02mfef/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                
              }
           }
       });
   });

   $('._communication').on('click',function(){
        $('#person_1').val($(this).data('person_one'));       
        $('#person_2').val($(this).data('person_two'))
        $('#title_').val($(this).data('title'))
        $('#id').val($(this).data('id'))
        $('#communication_date').val($(this).data('com-date'))
        tinyMCE.activeEditor.setContent($(this).data('comment'));
        tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
       
        $('#exampleModal').modal('toggle');
   })
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
  </script>
@endsection