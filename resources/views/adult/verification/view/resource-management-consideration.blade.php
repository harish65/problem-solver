@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')
<?php $showMsg = false ?>
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
                @if ($entity_used)
                <!-- start -->
                <div class="principleRelation container">
                    <!-- Condition block start -->
                   
                    <div class="solutionconditionBlock justify-content-center">
                        @if($resources)
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Solution</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/verification/1680525564.png')}}"
                                            width="100%" height="128px">
                                    </div>
                                    <p class="redText">{{ $solution->name }}</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{   date('d/m/Y', strtotime($solution->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <!-- <p style="position:relative; top:35px;left:25px;">through</p> -->
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/problem/'.$problem->file)}}"
                                            width="100%" height="128px">
                                    </div>
                                    <p class="redText" style="color:red">{{ $problem->name }}</p>
                                </div>
                                <div class="projectList">
                                <p class="date">{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <!-- <p style="position:relative; top:35px;left:25px;">through</p> -->
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
                        @if($resources->entity_usage == 1)
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Available</h2>
                                <div class="projectList text-center">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @php $index = 0; @endphp
                                                @foreach($entities as $entity)
                                                        <li data-target="#myCarousel" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                @php $index++; @endphp
                                            @endforeach 
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            @php $index = 1; @endphp
                                                @foreach($entities as $entity)
                                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} " data-entity_id="{{$entity->id}}" data-file="{{ $entity->media }}" data-name="{{ $entity->entity }}" data-actualname="{{ $entity->actual_entity }}">
                                                        <img  src="{{ asset('assets-new/verification_types/entity-available/'.$entity->media)}}" alt="Chania" width="80%" height="128px">
                                                    </div>
                                                @php $index++; @endphp
                                            @endforeach    
                                               
                                        </div>
                                    </div>
                                    <p class="redText" style="color:red">Available</p>
                                </div>
                                <div class="projectList">
                                    
                                    <ul>
                                        <li>
                                            <!-- <a href="javaScript:Void(0)" class="editverBtn" data-file="1680525564.png" data-file="1680525564.png">
                                                <img src="{{ asset('assets-new/images//editIcon.png') }}" alt="">
                                            </a> -->
                                        </li>
                                        <li>
                                            <!-- <a data-id="1" class="deleteverBtn" title="Delete">
                                                <img src="{{ asset('assets-new/images/deleteIcon.png') }}"
                                                    alt=""></a> -->
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)"  class="btn btn-success add-entity" id="add-entity"><i class="fa fa-plus"></i></a>
                                            <a href="javascript:void(0)"  class="btn btn-primary editButton"><i class="fa fa-pencil"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Natural Resources</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/verification_types/resource-managment/'.$resources->file)}}"
                                            width="100%" height="128px">
                                    </div>
                                    <p class="redText" style="color:red">{{ date('d/m/Y', strtotime($resources->created_at))}}</p>
                                </div>
                                <div class="projectList">
                                <p class="date"> &nbsp;&nbsp;&nbsp;</p>
                                    
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @else
                            @if($VerificationPermission)
                            <div class="col-md-12">
                                <button type="button"  class="btn btn-success add-entity" data-toggle="modal" data-target="#resource_management_model" >+ Add </button>
                            </div>
                            @endif
                        @endif
                    </div>
                    
                    <!-- Condition block end -->
                        <div class="questionWrap">
                            
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
                            <input type="hidden" name="name" id="name_" value="averaging_approach">
                                
                                <h5>Do you use resources or physical entities to solve the problem?</h5>
                                <ul class="validate_que" style="list-style:none;">
                                    
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="1">&nbsp;&nbsp;Yes, I use resources or natural entities to solve that problem</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="2">&nbsp;&nbsp;No, I do not use resources or natural entities to solve that problem</label></li>
                                
                                </ul>
                                <h5>Are usage of resources or physical entities required to solve that problem?</h5>
                                <ul class="validate_que" style="list-style:none;">
                                    
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="1">&nbsp;&nbsp;Yes, usage of resources or physical entities required to solve that problem</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="2">&nbsp;&nbsp;No, usage of resources or physical entities required to solve that problem</label></li>
                                
                                </ul>
                                <h5>Do you use resources or physical entities to solve ProblemName?</h5>
                                <ul class="validate_que" style="list-style:none;">
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_3" {{ (@$verification->validations->validation_3 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="1">&nbsp;&nbsp;Yes, I use resources or natural entities to solve ProblemName</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_3" {{ (@$verification->validations->validation_3 == 2) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="2">&nbsp;&nbsp;No, I do not use resources or natural entities to solve ProblemName</label></li>
                                </ul>
                                <h5>Are usage of resources or physical entities required to solve ProblemName?</h5>
                                <ul class="validate_que" style="list-style:none;">
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_4" {{ (@$verification->validations->validation_4 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="1">&nbsp;&nbsp;Yes, usage of resources or physical entities required to solve ProblemName</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_4" {{ (@$verification->validations->validation_4 == 2) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="2">&nbsp;&nbsp;No, usage of resources or physical entities required to solve ProblemName</label></li>
                                
                                </ul>
                                @if($VerificationPermission)
                                <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                                @endif
                            </form>
                        </div>
                </div>
                <!-- End -->
                @else

                <?php $showMsg = true ?>
                @endif
            </div>
            <div class="row pt-5">
                    @include('adult.quiz.quiz-component' , [$project->id , $pageId , $pageType])
                </div>
        </div>
    </div>
    <!-- Content Section End -->
    <form id="replace-problem">    
        <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
        <input type="hidden" name="project_id" value="{{ $project_id }}">
        <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
        <input type="hidden" name="solution_function_id" id="solution_function_id" value="{{ $Solution_function->id }}">   
        <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
    </form>
</div>

<!----Model Start-->
<div class="modal fade" id="resource_management_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Resource Managment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="resource_management-form">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="project_id" value="{{ $project_id }}">
            <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">   
            <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" value="0" id="entity_usage" name="entity_usage">
                <label class="form-check-label" for="entity_usage">Use Entity Usage</label>
            </div>
            <div class="form-group" id="upload_file">
                <label for="compensator">Upload File</label>
                <input type="file" name="file" data-height="150" id="file" class="dropify" accept="image/*, video/*">
            </div>
            <div class="form-group">
                <label for="compensator">Problem</label>
               <input type="text" class="form-control" value="{{ $problem->name}}" disabled>
            </div>
            <div class="form-group">
                <label for="feedback">Solution</label>
                <input type="text" class="form-control" value="{{ $solution->name}}" disabled>
                
            </div>
            <div class="form-group" id="available" style="display:none;">
                <label for="date">Entity Usage</label>
                <input type="text" class="form-control"  value="{{ @$entities[0]->entity}}" disabled>
            </div>
            
            
          </form>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="btnSave">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!--Model End-->



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
    .redText{
        color: red;
    }
    .form-check-label{
        right: 0px !important;
       
    }
    .form-check{
        padding-left:1.50rem !important;
    }
</style>
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
</script>
<script>
function calculte(){
    var solval = $('#sol_val').val();
    var problempart = Math.round(solval/2);
     $('#problem_part_front , #problem_parts').val(problempart);
     $('#result').val(2);

}
//sol-fun-av
$(document).on('click','#btnSave',function(e){
       e.preventDefault();
       var fd = new FormData($('#resource_management-form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
       
       $.ajax({
           url: "{{route('adult.resource-managment')}}",
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
$('#entity_usage').click(function(){
    if($(this).is(":checked")){
        $(this).val(1);
        $("#upload_file").hide();
        $("#available").show();
    }else{
        $(this).val(0);
        $("#upload_file").show();
        $("#available").hide();
    }
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