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
                
                @if(isset($problemPart->problem_part)  && !is_null($problemPart->problem_part))
                
                <div class="principleRelation container">
                            <div class="add-entity mb-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">+ Calculate</button>
                            </div>
                            <?php $solutionParts = \App\Models\AverageApproach::getSolutionParts($problemPart->project_id, $problemPart->id);?>
                    <div class="partitionApp">
                            <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Problem</h2>
                                       <div class="problem-list">
                                        <ul class="text-center p-2">
                                                @foreach(@$solutionParts as $key => $solutionPart)
                                                    <li class="form-control btn btn-success">
                                                        <span>{{ __('Part ') . ++$key}}</span>
                                                    </li>
                                                @endforeach  
                                        </ul>
                                       </div>
                                            
                                    </div>
                                </div>
                                <div class="arrow">
                                    <ul>
                                        @foreach(@$solutionParts as $solutionPart)
                                            <li><img src="{{ asset('assets-new/images/arrow_sm.png')}}"></li>
                                        @endforeach 
                                    </ul>
                                </div>
                                <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Solution</h2>
                                        <div class="problem-list">
                                            <ul class="text-center p-2">
                                                @if(isset($problemPart->problem_part)  && !is_null($problemPart->problem_part))
                                                        @foreach (@$solutionParts as $key => $solutionPart)
                                                            <li class="form-control btn btn-success">
                                                                <span class="text-part-val float-left">
                                                                    {{ $solutionPart->solution_part_value  }}
                                                                </span>
                                                                <span>{{ __('Part ') . ++$key}}</span>
                                                                <span class="text-part-val float-right edit-part" title="Edit" data-id="{{ $solutionPart->id }}" data-value="{{ $solutionPart->solution_part_value }}">
                                                                    <i class="fa fa-pencil"></i>
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                @endif       
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
                            
                            <h5>Does the solution of that problem require averaging?</h5>
                            <ul class="validate_que" style="list-style:none;">
                                
                                <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}   value="1">&nbsp;&nbsp;Yes, the solution of that problem requires averaging</label></li>
                                <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}   value="2">&nbsp;&nbsp;No, the solution of that problem does not require averaging</label></li>
                               
                            </ul>
    
                            <h5>Is each part of the problem substituted by a part of the solution?</h5>
                            <ul class="validate_que" style="list-style:none;">
                                
                                <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }}   value="1">&nbsp;&nbsp;Is each part of the problem substituted by a part of the solution?</label></li>
                                <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}   value="2">&nbsp;&nbsp;No, each part of the problem is not  substituted by a part of the solution</label></li>
                               
                            </ul>
                            <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                        </div>
                </div>
                <!-- End -->
                @else
                    @if($countPartionAproach)
                        <div class="add-entity mb-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">+ Calculate</button>
                        </div>
                    @else
                        <?php $showMsg  = true ?>
                    @endif    
                    
                @endif
            </div>
        </div>
    </div>
    <!-- Content Section End -->
<!-- Modal Start -->
    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Solution Function Average</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <form id="sol-fun-av-form" method="post">
                <input type="hidden" name="id" id="function_ad_id" value="{{ @$problemPart->id }}">
                <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                <input type="hidden" name="project_id" value="{{ $project_id }}">
                <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                <input type="hidden" name="fileType" id="fileType">
                <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                <div class="row">
                    <div class="from-group">
                        <label for="problem">Solution Value</label>
                        <input type="text" value="10" id="sol_val"  name="solution_value" class="form-control" placeholder="Solution Value">
                        <input type="hidden" id="parts_count" value="{{$countPartionAproach}}">
                    </div>
                    <div class="from-group">
                        <label for="problem">Number of Part of Problem</label>
                        <input type="text"  value="" disabled id="problem_part_front" class="form-control">
                        <input type="hidden"  value="" name="problem_part"  id="problem_parts" class="form-control">
                    </div>

                    <div class="from-group">
                        <label for="problem">Result</label>
                        <input type="text" id="result" name="result_value"  value="" readonly class="form-control">
                        
                    </div>
                  
                    <div class="from-group mt-5 text-center">
                        <button type="button" class="btn btn-secondary" onclick="calculte()" id="calculation">Calculate</button>
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
<!---Start Update Solution Val-->
<div class="modal fade" id="soulutionpartModels" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Solution Part</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="sol-form" method="post">
                <input type="hidden" name="id" id="averagin_aproach_parts" value="{{ @$problemPart->id }}">
                
                <input type="hidden" name="project_id" value="{{ $project_id }}">
               
                
                <div class="row">
                    <div class="from-group">
                        <label for="problem">Solution Part</label>
                        <input type="text" value="" id="sol_part_val" name="solution_part" class="form-control" placeholder="Solution Value">
                    </div>
                  
                </div>
             </form>                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="btnUpdate">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--- End Solution Va-->
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
</style>
@endsection
@section('scripts')

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
</script>
<script>
    function calculte(){
        var solval = $('#sol_val').val();
        var parts = '{{$countPartionAproach}}';
        console.log(solval)
        var problempart = Math.round(solval/parts);
            $('#problem_part_front , #problem_parts').val(parts);
            $('#result').val(problempart);
    }
//sol-fun-av
$(document).on('click','#btnSave',function(e){
       e.preventDefault();
       var fd = new FormData($('#sol-fun-av-form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.sol-fun-av')}}",
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
$('.edit-part').on('click',function(){
        var row_id = $(this).data('id')
        if(row_id){
            $('#sol_part_val').val($(this).data('value'))
            $('#averagin_aproach_parts').val(row_id)
            $('#soulutionpartModels').modal('toggle')
        }
})

$(document).on('click' , '#btnUpdate', function(e){
   
    e.preventDefault();
       var fd = new FormData($('#sol-form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.update-solution-part')}}",
           data: fd,
           processData: false,
           contentType: false,
           dataType: 'json',
           type: 'POST',
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