@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
<?php $part = 1;
 $showMsg = false ?>
<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                      <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                      ?>
                      <a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
                      <a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
                      <a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
                      <a id="verification" href="{{ route('adult.varification',@$parameter) }}"></a>   

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
                 @if($entities->count() > 0)
                <div class="principleRelation container">
                            <div class="add-entity mb-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">+ Add New</button>
                            </div>
                    <div class="partitionApp">

                            <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Problem</h2>
                                       <div class="problem-list">
                                        <ul class="text-center p-2">
                                            @foreach($entities as $entity)
                                            <li class="form-control btn btn-success">{{ $entity->word}}
                                                <div class="actions">
                                                    <a class="text-white editAction" data-id="{{ $entity->id }}" data-part="{{ $entity->part }}" data-problem="{{ $entity->word }}"  data-solution="{{ $entity->given }}"><i class="fa fa-pencil"></i></a>
                                                    <a class="text-white removeAction" data-id="{{ $entity->id }}" ><i class="fa fa-trash"></i></a>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                       </div>
                                            <div class="list-part">
                                                <p style="color:red;">{{ $problem->name }}</p>
                                            </div>
                                    </div>
                                </div>

                                <div class="arrow">
                                    <ul>
                                        @foreach($entities as $entity)
                                        <li><img src="{{ asset('assets-new/images/arrow_sm.png')}}"></li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Solution</h2>
                                        <div class="problem-list">
                                            <ul class="text-center p-2">
                                                @foreach($entities as $entity)
                                                <li class="form-control btn-success">{{ $entity->given}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="list-part">
                                                <p style="color:#1e7e34;">{{ $solution->name }}</p>
                                            </div>
                                    </div>
                                </div>
                            </div>

                       
                        <div class="questionWrap">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                                nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                            <div class="row">
                            </div>

                            <h2>Validation Question</h2>
                        <br>
                        <form id="validation_form">
                            <input type="hidden" name="id" value="{{ @$verification->id }}"> 
                            <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}"> 
                            <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                            <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                            <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                            <input type="hidden" name="name" id="name_" value="partition_aproach">
                            
                        <h5>Have you replaced each part of the problem to specific part of the solution?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}   value="1">&nbsp;&nbsp;Yes, I have replaced each part of the problem to specific part of the solution</label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}   value="2">&nbsp;&nbsp;No, I haven’t not replaced each part of the problem to specific part of the solution</label></li>
                           
                        </ul>
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                        </div>
                </div>
                @else
                <div class="add-entity mb-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">+ Add New</button>
                            </div>
                @php $showMsg =  true;@endphp
                @endif
                <!-- End -->
                
            </div>
        </div>
    </div>
    <!-- Content Section End -->

    <!-- Modal Start -->
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Part: {{ $part }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                 <form id="entity_form" method="post">
                    <div class="row">
                        <div class="from-group">
                            <label for="problem">Problem Part : {{ $part }}</label>
                            <input type="text" disabled value="{{$problem->name}}" class="form-control">
                            <input type="hidden" name="problem_id" value="{{$problem->id}}">
                            <input type="hidden" name="part" value="{{$part}}" id="part">
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                            
                        </div>
                        <div class="from-group">
                            <label for="problem">Solution Part : {{ $part }}</label>
                            <input type="text" disabled value="{{$solution->name}}" class="form-control">
                            <input type="hidden" name="solution_id" value="{{$solution->id}}">
                        </div>
                        <div class="from-group">
                            <label for="word">Add Problem Part:</label>
                            <input type="text" name="word" class="form-control">
                        </div>
                        <div class="from-group">
                            <label for="word">Add Solution Part:</label>
                            <input type="text" name="given" class="form-control">
                        </div>
                    </div>
                 </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" id="btnSave">Submit</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal End -->
    <div class="modal fade" id="problemModal" tabindex="-1" role="dialog" aria-labelledby="problemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Part: {{ $part }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                 <form id="entity_form_update" method="post">
                    <div class="row">
                    <input type="hidden" name="id" id="part_id">
                        <div class="from-group">
                            <label for="word">Edit Problem Part:</label>
                            <input type="text" name="word" id="problem_part" class="form-control">
                            <input type="hidden" name="problem_id" value="{{$problem->id}}">
                            <input type="hidden" name="part" value="" id="part_update">
                            <input type="hidden" name="solution_id" value="{{$solution->id}}">
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                        </div>
                        <div class="from-group">
                            <label for="word">Edit Solution Part:</label>
                            <input type="text" name="given" id="solution_part" class="form-control">
                        </div>
                    </div>
                 </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" id="btnUpdate">Update</button>
            </div>
          </div>
        </div>
      </div>
</div>

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .entity{
        display: flex;
        list-style: none;
        justify-content: center;
    }
   li {
    list-style: none;
   }
    li input{
        text-align: center;
        color: #000000 !important;
        border: 1px solid #00A14C !important;
        background: #fff !important;
        font-weight: 500;
        text-decoration: solid;
        
    }
    .inner-section{
        padding-bottom: 20px;
    }
    .inner-section input{

        height: 50px;
        font-size: 22px;
        font-weight: 100;
        width: 50% !important;
        /* border-radius: 20px; */
    }
    .partionapproach{
        justify-content:center !important;
    }
    .partitionApp{
        display: flex;
        justify-content:center;
    }
    .problem-list ul li{
        margin-top: 10%;
        border: 1px solid rgba(0, 161, 76, 0.5);
    }
    .arrow ul{
        margin-top: 40%;
        position: relative;
        right: 20px;
    }
    .arrow ul li{
        margin-top: 17%;
    }
    li .actions{
        display: inline;
        float: right;
        font-size: 14px;
        margin: 2%;
        padding: 0;
    }
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
   
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
})
$('.dropify').dropify();


</script>
<script>
$('.nav-problem').click(function(){
    $(this).attr('href' , ''); 
    localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));   
    $(this).attr('href' ,$('#problem_nav').attr('href'))
})
$('.nav-solution').click(function(){
    $(this).attr('href' , ''); 
    localStorage.setItem("sol", $('#solution_nav').attr('href'));   
    $(this).attr('href' ,$('#solution_nav').attr('href'))
})
$('.nav-solution-func').click(function(){
    $(this).attr('href' , '');
    localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
    $(this).attr('href' ,$('#solution_fun_nav').attr('href'))
})
$('.verification').click(function(){
    $(this).attr('href' , '');
    localStorage.setItem("varification", $('#verification').attr('href'));   
    $(this).attr('href' ,$('#verification').attr('href'))
})


$('.dashboard').click(function(){
    //Solution
    $('.nav-solution').attr('href' , '');
    localStorage.setItem("sol", $('#solution_nav').attr('href'));   
    $('.nav-solution').attr('href' ,$('#solution_nav').attr('href'))
    //Problem
    $('.nav-problem').attr('href' , '');
    localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));       
    $('.nav-problem').attr('href' ,$('#problem_nav').attr('href'))
    //Sol fun
    $('.nav-solution-func').attr('href' , '');
    localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
    $('.nav-solution-func').attr('href' ,$('#solution_fun_nav').attr('href'))
    //verification
    $('.nav-varification').attr('href' , '');
    localStorage.setItem("varification", $('#verification').attr('href'));   
    $('.nav-varification').attr('href' ,$('#solution_fun_nav').attr('href'))

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


   $(document).on('click','#btnSave',function(e){
       e.preventDefault();
       var fd = new FormData($('#entity_form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.add-entity-word')}}",
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
   $(document).on('click','.editAction',function(e){
    $('#part_id').val($(this).data('id'))
    $('#problem_part').val($(this).data('problem'))
    $('#solution_part').val($(this).data('solution'))
    $('#part_update').val($(this).data('part'))
    $('#problemModal').modal('toggle');
   })

   $(document).on('click','#btnUpdate',function(e){
    e.preventDefault();
       var fd = new FormData($('#entity_form_update')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.add-entity-word')}}",
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
   })
   var msg = '{{$showMsg}}';
if(msg) { 
    swal({
        title: "{{@$verificationType->error_title}}",
        text:  "{{@$verificationType->message}}",
        type: "Error",
        showCancelButton: true,
        confirmButtonColor: '#00A14C',
    });
}
</script>
@endsection