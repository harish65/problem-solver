@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')

<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                      <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                      ?>
                      <a id="problem_nav" href="{{ route("adult.problem",@$parameter) }}"></a>
                      <a id="solution_nav" href="{{ route("adult.solution",@$parameter) }}"></a>
                      <a id="solution_fun_nav" href="{{ route("adult.solution-func",@$parameter) }}"></a>
                      <a id="verification" href="{{ route("adult.varification",@$parameter) }}"></a>   

                <div class="col-sm-12">
                    <div class="d-flex align-items-center">
                        <h2>Verification</h2>
                        <select class="form-control form-select" id="verification_types">
                                <option value=''>Select Verification Type..</option>
                            @foreach(@$types as $type)
                                <option {{  (@$verificationType->id  == $type->id) ? 'selected' : '' }} value='{{ $type->id }}'>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(@$verification->id)
    <!-- Content Section Start -->
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>
                  
                    <div class="relationImage text-center">
                    <img src="{{ asset("assets-new/verification_types/" . @$verificationType->banner)}}" alt="relationImage" />                        
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                <!-- start -->
                <div class="principleRelation">
                    <div class="conditionBlock problem-development">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Error</h2>
                                <div class="projectList text-center">
                                    @foreach($problemDevelopment as $data)
                                    <button class="btn btn-danger  mt-3">
                                        {{$data->error_name}}
                                    </button>

                                    @endforeach
                                </div>
                              
                            </div>
                        </div>
                       
                        <div class="long-arrow">
                            <!-- <p style="position:relative; top:35px;left:23px;">is replaced by</p> -->
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                        </div>
                        
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center">
                                    @foreach($problemDevelopment as $data)
                                    <button class="btn btn-success mt-3">
                                        {{$data->problem_name}}
                                    </button>
                                    

                                    @endforeach
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
                                    <button type="button"  class="btn btn-success addVocabularyBtn" data-toggle="modal" data-target="#exampleModal">+ Add Problem Development</button>
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
                                                <a href="" class="btn btn-success"><i class="fa fa-pencil"></i></a>
                                                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                  @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <h2>Validation Question</h2>
                    <form id="validation_form">
                      
                    <ul class="validate_que">                        
                        <br>
                        <h5>Do you understand that errors or errors in communication develop problems?</h5>
                        <input type="hidden" name="id" value="{{ $verification->id }}">
                        <li><label><input  type="radio" data-id="{{ $verification->id  }}" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} name="validation_1" class="form-check-input validation" value="1">Yes, I do understand that errors or errors in communication develop problems</label> </li>
                        <li><label><input  type="radio" data-id="{{ $verification->id  }}" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} name="validation_1" class="form-check-input validation" value="2">No, I do not understand that errors or errors in communication develop problems</label> </li>
                        
                    </ul>
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                </div>
            </div>
            <!-- End -->
            
        </div>
    </div>
</div>
<!-- Content Section End -->


@else
<div class="relationshipContent" style="height: 280px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-success" id="add-varification-button"><i class="fa fa-plus"></i>  Create Verificatoin</button>
                </div>
                
            </div>
        </div>
    </div>
@include('adult.verification.modal.voucablary.create-problem-development-verification')
@endif
    <!-- Modal Start -->
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="form-group">
                    <label for="error_name">Error Name</label>
                    <input type="text" class="form-control" name="error_name" id="error_name">
                </div>
                <div class="form-group">
                    <label for="error_date">Error Date</label>
                    <input type="text" class="form-control" name="error_date" id="error_date">
                </div>
                <div class="form-group">
                    <label for="problem_name">Problem Name</label>
                    <input type="text" class="form-control" name="problem_name" id="problem_name">
                </div>
                <div class="form-group">
                    <label for="problem_date">Problem date</label>
                    <input type="text" class="form-control" name="problem_date" id="problem_date">
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
    <!-- Modal End -->
</div>

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
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
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
   
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
})
$('.dropify').dropify();
$("#error_date , #problem_date").datepicker();
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


   

   
</script>
@endsection