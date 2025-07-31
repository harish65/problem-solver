@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')
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
                <!-- start -->
                <div class="principleRelation container">
                    <!-- Condition block start -->
                    @if(isset($problemreplaced) && !empty($problemreplaced->id))
                    <div class="solutionconditionBlock justify-content-center">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                              <h2>Problem</h2>
                              <div class="projectList text-center"> 
                                <div class="imgWrp">
                                        
                                
                                            @if($problem->problem_type == 0)
                                                    @if(strlen($problem -> problem_file) < 15)
                                                        <img class="mx-auto aaa" src='{{ asset("assets-new/problem/" . $problem->file) }}' width="100%" height="128px">
                                                    @endif
                                            @elseif($problem->problem_type == 1)
                                                    <video class="mx-auto" controls="controls" preload="metadata" width="300" height="320" preload="metadata">
                                                        <source src="{{ asset("assets-new/problem/" . $problem->file) }}#t=0.1" type="video/mp4">
                                                    </video>
                                            @elseif($problem -> problem_type == 2)
                                                        <iframe class="mx-auto" src="{{ $problem->file }}"width="300" height="320"> </iframe>
                                            @endif
                                    </div>
                                <p class="redText" style="color:red" >{{ $problem->name }}</p>
                              </div>
                              <div class="projectList">
                                <p class="date">{{ date('d/m/Y' , strtotime($problem->created_at))}}</p>
                                
                              </div>
                            </div>
                          </div>
                          <div class="long-arrow">            
                                <p class="transitionPhrase">{{ _('is replaced by') }}</p>
                                <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                          </div>
                          <div class="blockProblem">
                            <div class="projectBlock text-center">
                              <h2>Solution</h2>
                              <div class="projectList text-center"> 
                              <div class="imgWrp">
                                                @if($problem -> type == 0)
                                                    @if(strlen($problem -> file) < 15)
                                                        <img class="mx-auto" src="{{ asset("assets-new/solution/" . $solution -> file) }}" width="100%" height="128px">
                                                    @endif
                                                @elseif($problem -> type == 1)
                                                    <video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
                                                        <source src="{{ asset("assets-new/solution/" . $solution -> file) }}#t=0.1" type="video/mp4">
                                                    </video>
                                                @elseif($problem -> type == 2)
                                                        <iframe class="mx-auto" src="{{ $solution -> file }}" width="100%" height="128px"> </iframe>
                                                @endif 
                              </div>
                                <p class="redText" style="color:red">{{ $solution->name }}</p>
                              </div>
                              <div class="projectList">
                                <p class="date">{{ date('d/m/Y' , strtotime($solution->created_at)) }}</p>
                                
                              </div>
                            </div>
                          </div>
                
                    </div>
                    
                    <!-- Condition block end -->
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
                            <input type="hidden" name="name" id="name_" value="replace_problem_by_problem">
                                
                                <h5>Do you understand that a problem needs to be solved?</h5>
                                <ul class="validate_que" style="list-style:none;">
                                    
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}   value="1" {{ (!$VerificationPermission) ? 'disabled':'' }}>&nbsp;&nbsp;Yes, I understand that a problem needs to be solved</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}   value="2" {{ (!$VerificationPermission) ? 'disabled':'' }}>&nbsp;&nbsp;No, I do not understand that a problem needs to be solved</label></li>
                                
                                </ul>
        
                                @if($VerificationPermission)
                                <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                                @endif
                            </form>
                        </div>
                        @else
                        @if($VerificationPermission)
                            <div class="add-entity mb-3">
                                <button type="button" class="btn btn-success" class="cursor" id="replace_sol" data-toggle="modal" data-target="#replace_problem_model" >+ Add</button>
                            </div>
                        @endif
                    @endif
                </div>
                <!-- End -->
                
            </div>
           
        </div>
    </div>
    <!-- Content Section End -->
    <!--Modal Start-->


    <!--Modal End-->
    <div class="modal fade" id="replace_problem_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="replace-problem">    
                    <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                    <input type="hidden" name="project_id" value="{{ $project_id }}">
                    <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                    <input type="hidden" name="solution_function_id" id="solution_function_id" value="{{ $Solution_function->id }}">   
                    <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                    <div class="form-group">
                        <label for="compensator">Problem Name</label>
                        <input type="text" name="problem_name" class="form-control" id="problem_name" value="{{ $problem->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="compensator">Solution Name</label>
                        <input type="text" name="solution_name" class="form-control" id="solution_name" value="{{ $solution->name }}" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" id="replace_sol_form">Save changes</button>
            </div>
          </div>
        </div>
      </div>

    
</div>

@endsection
@section('css')

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
</style>
@endsection
@section('scripts')

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
$(document).on('click','#replace_sol',function(e){

})
//sol-fun-av
$(document).on('click','#replace_sol_form',function(e){
       e.preventDefault();
       var fd = new FormData($('#replace-problem')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.replace-problem-by-problem')}}",
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





</script>




@endsection