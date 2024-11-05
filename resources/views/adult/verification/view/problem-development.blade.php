@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')
<?php $showMsg = false ?>
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
                @if($problem_id == '' ||  $Solution_function->id == '' && $solution_id == '')
                    <?php $showMsg = true; ?>
                @else
                @if($problemDevelopment->count() > 0)
                <!-- start -->
                <div class="principleRelation">
                    <div class="conditionBlock problem-development">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Error</h2>
                                <div class="problem-list">
                                    <ul class="text-center p-2">
                                        @foreach($problemDevelopment as $entity)
                                        <li class="form-control btn btn-danger mt-3">
                                            {{ $entity->error_name}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="arrow">
                            <ul>
                                @foreach($problemDevelopment as $entity)
                                <li class="top"><img src="{{ asset('assets-new/images/arrow_sm.png')}}"></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Compensator</h2>
                                <div class="problem-list">
                                    <ul class="text-center p-2">
                                        @foreach($problemDevelopment as $entity)
                                        <li class="form-control btn btn-success mt-3">
                                            {{ $entity->problem_name}}
                                        </li>
                                        @endforeach
                                    </ul>
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
                            <div class="title d-flex">
                            <div class="text-left w-50 ">
                                <h2>Problem Development</h2>
                            </div>
                                <div class="text-right w-50 pt-3">
                                    <button type="button"  class="btn btn-success addVocabularyBtn" >+ Add Problem Development</button>
                                </div>
                            </div>

                            <div class="entity">
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Error Name</th>
                                        <th>Error Date</th>
                                        <th>Problem</th>
                                        <th>Problem Date</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                  @foreach($problemDevelopment as $data)
                                        <tr>
                                            <td>
                                                {{$data->error_name}}
                                            </td>
                                            <td>
                                                {{date('d-m-Y' , strtotime($data->error_date))}}
                                            </td>
                                            <td>
                                                {{$data->problem_name}}
                                            </td>
                                            <td>
                                                {{date('d-m-Y' , strtotime($data->problem_date))}}
                                            </td>
                                            <td>
                                                <a href="javaScript:void(0)" data-id ="{{ $data->id }}"  data-error_name="{{$data->error_name}}" data-error_date="{{date('d-m-Y' , strtotime($data->error_date))}}" data-problem="{{$data->problem_name}}" data-problem_date="{{date('d-m-Y' , strtotime($data->problem_date))}} " class="btn btn-success editBtn"><i class="fa fa-pencil"></i></a>
                                                <a href="javaScript:void(0)" data-id ="{{ $data->id }}"  class="btn btn-danger delete-btn"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                  @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <h2>Validation Question</h2>
                    <form id="validation_form">
                            <input type="hidden" name="id" value="{{ @$verification->id }}"> 
                            <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}"> 
                            <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                            <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                            <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                            <input type="hidden" name="name" id="name_" value="problem_development">
                            <ul class="validate_que">                        
                                <br>
                                <h5>Do you understand that errors or errors in communication develop problems?</h5>
                                <input type="hidden" name="id" value="{{ @$verification->id }}">
                                <li><label><input  type="radio"  {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} name="validation_1" class="form-check-input validation" value="1">Yes, I do understand that errors or errors in communication develop problems</label> </li>
                                <li><label><input  type="radio"  {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} name="validation_1" class="form-check-input validation" value="2">No, I do not understand that errors or errors in communication develop problems</label> </li>
                                
                            </ul>
                            <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                </div>
            </div>
            <!-- End -->
            @else
            <div class="row text-end">
                <div class="text-right">
                    <button type="button"  class="btn btn-success addVocabularyBtn" >+ Add Problem Development</button>
                </div>
            </div>

            @endif
           
            
            @endif
            
        </div>
    </div>
</div>
<!-- Content Section End -->



    <!-- Modal Start -->
    
    
    <!-- Modal End -->
</div>
<div class="modal fade" id="problem_development_" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Problem Development</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="prob-dev-form" >
            <input type="hidden" name="prob_dev_id" id="ver_id" value="">
            <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
            <input type="hidden" name="project_id" value="{{ $project_id }}">
            <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
            <input type="hidden" name="id" id="id" value="">
            
            
            <div class="form-group">
                <label for="error_name">Error Name</label>
                <input type="text" class="form-control" name="error_name" id="error_name" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="error_date">Error Date</label>
                <input type="text" class="form-control" name="error_date" id="error_date_" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="problem_name">Problem Name</label>
                <input type="text" class="form-control" name="problem_name" id="problem_name" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="problem_date">Problem date</label>
                <input type="text" class="form-control" name="problem_date" id="problem_date" autocomplete="off">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="btnSave">Save changes</button>
        </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<style>
    .image{
        margin: 20px;
        text-align: center;
        border: 2px solid;
        padding: 14px;
        border-radius: 5px;
        background: #eee;
        }
    .image img{
        border-radius : 5px;
    }     
    .validate_que{
        list-style:none;
    }
    .conditionBlock.problem-development{
        justify-content: center;
    }
    .arrow ul {
        margin-top: 40%;
        position: relative;
        right: 20px;
    }
    .arrow ul li {
        margin-top: 17%;
        list-style: none;
    }
    

    
</style>
@endsection
@section('scripts')

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
   
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
})


</script>
<script>
routes();

$('.dashboard').click(function(){
    routes();
})

$('#btnSave').click(function(e){
    e.preventDefault();

    var problemDate =  $('#problem_date').val();
    var errorDate =  $('#error_date').val();
    console.log(problemDate , errorDate)
    if(new Date(problemDate) < new Date(errorDate)){
        alert('Problem Date can not less than Error Date!')
        return;
    }
       

       var dv = new FormData($('#prob-dev-form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       $.ajax({
            type: 'POST',
            url: "{{route('adult.add-problem-development')}}",
            data: dv,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function(){
                $('#btnSaveEntity').attr('disabled',true);
                $('#btnSaveEntity').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSaveEntity').attr('disabled',false);
                $('#btnSaveEntity').html('Save changes');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
                if(response.success == false)
                {
                    $('#btnSaveEntity').attr('disabled',false);
                    $('#btnSaveEntity').html('Save changes');
                    var errors = response.data;
                    $.each( errors, function( key, value ) {
                        toastr.error(value)
                    });
                } else {
                    
                    toastr.success(response.message);
                    location.reload();
                }
            }
        });

   });

   $(".editBtn").on('click' , function(){
        $('#error_name').val($(this).data('error_name'))
        $('#error_date_').val($(this).data('error_date'))
        $('#problem_name').val($(this).data('problem'))
        $('#problem_date').val($(this).data('problem_date'))
        $('#problem_date').val($(this).data('problem_date'))
        $('#id').val($(this).data('id'))
        $('#problem_development_').modal('toggle')
   })

   /////Delete 



   $('.delete-btn').click(function(e){
    e.preventDefault();

    var id =  $(this).data('id');
      
    if (confirm('Are you sure you want to delete this?')) {
       
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       var route  =  "{{route('adult.del-problem-development')}}"
    //    route = route.replace(':id', id);
       $.ajax({
            type: 'POST',
            url: route,
            data: {'id':id},
            // processData: false,
            // contentType: false,
            // dataType: 'json',            
            success: function (response){
                if(response.success == false)
                {
                    $('#delete-btn').attr('disabled',false);
                    $('#delete-btn').html('Save changes');
                    var errors = response.data;
                    $.each( errors, function( key, value ) {
                        toastr.error(value)
                    });
                } else {
                    
                    toastr.success(response.message);
                    location.reload();
                }
            }
        });
    }else{
        return false
    }

   });

   $(document).ready(function () {
    $('#error_date_').datepicker();
    $('#problem_date').datepicker();
});

$('.addVocabularyBtn').click(function(){
    // $('#addVocabularyForm').trigger('reset');
    $('#prob-dev-form')[0].reset();  
    $('#problem_development_').modal('toggle')
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