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
                    <div class="conditionBlock space_rem">
                @if($functionAud)
                        <!-- <div class="long-border"></div> -->
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Improper Function</h2>
                                <div class="projectList text-center min-height-250">
                                    <div class="imgWrp">
                                        @if($Solution_function -> solution_type == 0)
                                                    @if(strlen($Solution_function -> file) < 15)
                                                        <img class="mx-auto" src="{{ asset('assets-new/solFunction/'.$Solution_function->file)}}"  width="100%" height="128px">
                                                    @endif
                                                @elseif($Solution_function -> solution_type == 1)
                                                    <video class="mx-auto" controls="controls" preload="metadata"  width="100%" height="128px" preload="metadata">
                                                        <source src="{{ asset('assets-new/solFunction/' . $Solution_function -> file) }}#t=0.1" type="video/mp4">
                                                    </video>
                                                @elseif($Solution_function -> solution_type == 2)
                                                        <iframe class="mx-auto" src="{{ $Solution_function -> file }}"  width="100%" height="128px"> </iframe>
                                                @endif
                                    </div>
                                    <div class="mt-5">
                                        <div class="margit-fifty">
                                        <p>{{ (@$functionAud->function_name) ? ucfirst(@$functionAud->function_name) : '' }}</p>
                                        </div>
                                    </div>
                                    <ul>
                                    @if($VerificationPermission)
                                        <li>
                                              <a href="javaScript:Void(0)" class="editBtn" data-id="{{$functionAud->id}}" data-sol-fun-id="{{$functionAud->solution_function_id}}" data-function_name="{{$functionAud->function_name}}" data-problem_name="{{$functionAud->problem_name}}" >
                                                  <img src="{{ asset('assets-new/images/editIcon.png') }}" alt="">
                                              </a>
                                        </li>
                                        <li><a data-id="8" class="delProblemBtn" title="Delete"><img src="{{ asset('assets-new/images/deleteIcon.png') }}" alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('assets-new/images/uploadIcon.png') }}" alt=""></a></li>
                                        @else
                                        <li>&nbsp;</li>
                                        <li>&nbsp;</li>
                                        <li>&nbsp;</li>
                                        @endif
                                      </ul>
                                </div>
                               
                            </div>
                        </div>
                        <div class="long-arrow text-center">
                            <!-- add arrow Image over here -->
                                <span>Cause</span>
                                <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center min-height-250">
                                    <div class="imgWrp">
                                        @if($problem -> type == 0)
                                            @if(strlen($problem -> file) < 15)
                                                <img class="mx-auto" src="{{ asset('assets-new/problem/' . $problem -> file) }}" width="100%" height="128px">
                                            @endif
                                        @elseif($problem -> type == 1)
                                            <video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
                                                <source src="{{ asset('assets-new/problem/' . $problem -> file) }}#t=0.1" type="video/mp4">
                                            </video>
                                        @elseif($problem -> type == 2)
                                                <iframe class="mx-auto" src="{{ $problem -> file }}" width="100%" height="128px"> </iframe>
                                        @endif
                                    </div>
                                    <div class="mt-5">
                                        <div class="margit-fifty">
                                            <p>{{ (@$functionAud->problem_name) ? ucfirst(@$functionAud->problem_name) : '' }}</p>
                                         </div>
                                    </div>
                                    <ul>
                                    @if($VerificationPermission)
                                        <li>
                                              <a href="javaScript:Void(0)" class="editBtn" data-id="{{$functionAud->id}}" data-sol-fun-id="{{$functionAud->solution_function_id}}" data-function_name="{{$functionAud->function_name}}" data-problem_name="{{$functionAud->problem_name}}">
                                                  <img src="{{ asset('assets-new/images/editIcon.png') }}" alt="">
                                              </a>
                                        </li>
                                        <li><a data-id="8" class="delProblemBtn" title="Delete"><img src="{{ asset('assets-new/images/deleteIcon.png') }}" alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('assets-new/images/uploadIcon.png') }}" alt=""></a></li>
                                        @else
                                        <li>&nbsp;</li>
                                        <li>&nbsp;</li>
                                        <li>&nbsp;</li>
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
                    </div>
                    @else
                    <div class="col text-center">
                    @if($VerificationPermission)
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#functionAdjutment">Add +</button>
                        @else
                        @include('adult.verification.view.component.shared-message')
                        @endif
                    </div>
                    @endif
                </div>
            </div>
                <!-- End -->
           
        </div>
    </div>
</div>
<!-- Content Section End -->

<!-- Modal Start -->
    
<div class="modal fade" id="functionAdjutment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Function Adjustment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="function-adjustment-form" >
            <input type="hidden" name="id" id="function_ad_id" value="{{ @$functionAud->id }}">
            <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
            <input type="hidden" name="project_id" value="{{ $project_id }}">
            <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
            <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
            <input type="hidden" name="fileType" id="fileType">
            <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
            <div class="form-group">
                <label for="compensator">Solution Function</label>
                <select name="solution_function" class="form-control form-select" id="solution_function">
                    <option value="">Please select..</option>
                    <option value="{{ $Solution_function->id }}">{{ $Solution_function->name }}</option>
                    <option value="0">New Function</option>
                </select>
            </div>
            <div class="form-group">
                <label for="compensator">Function Name</label>
                <input type="text" name="function_name" class="form-control" id="fun_name">
            </div>
            <div class="form-group">
                <label for="feedback">Problem Name</label>
                <input type="text"  name="problem_name" value="" class="form-control" id="problem_name">
                
            </div>
           
            <!-- <div class="form-group">
                <label for="from-person">Actual Problem</label>
                <input type="text" disabled name="problem_name" value="{{ $problem->name }}" class="form-control">
            </div> -->
            
          </form>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="btnSave">Save</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal End -->
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
   .min-height-250{
        min-height: 250px;
   }
   /* .long-border{
        border-left: 3px solid #000;
        height: 320px;
        border-color: #28a745;
    } */
    .imgWrp a{
        cursor: pointer;
    }
    .margit-fifty{
        margin-top: 20%;
    }
    .margit-fifty p{
        color: red;
    }
    .space_rem{
        justify-content:center;
    }
    .long-arrow{
        display: inline-grid;
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
    })

$('.dropify').dropify();


</script>
<script>
routes();
$('.dashboard').click(function(){
    routes();
})


$('#btnSave').click(function(e){
    e.preventDefault();
       var dv = new FormData($('#function-adjustment-form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       $.ajax({
            type: 'POST',
            url: "{{route('adult.store-function-adjustment')}}",
            data: dv,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function(){
                $('#btnSave').attr('disabled',true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSave').attr('disabled',false);
                $('#btnSave').html('Save changes');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
                if(response.success == false)
                {
                    $('#btnSave').attr('disabled',false);
                    $('#btnSave').html('Save changes');
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
   $('.editBtn').click(function(){
        var solutionfunction_id = $(this).data('sol-fun-id')
        var fun_name = $(this).data('function_name')
        var problem_name = $(this).data('problem_name')
        
        if(solutionfunction_id !== 0){
            $('#solution_function').val(solutionfunction_id)
            $('#fun_name').val(fun_name).attr('readonly' , true)
            $('#problem_name').val(problem_name).attr('readonly' , true)
        }else{
           
            $('#solution_function').val(solutionfunction_id).prop('selected', true); 
            $('#fun_name').val(fun_name).removeAttr('readonly')
            $('#problem_name').val(problem_name).removeAttr('readonly')
        }
       
        $('#functionAdjutment').modal('toggle')
   })


   var solutioFunctionName =  '{{$Solution_function->name}}'
   var problemName =  '{{$problem->name}}'

   $('#solution_function').change(function(){
     
        if($(this).val() !== '0'){
            $('#fun_name').val(solutioFunctionName).attr('readonly' , true)
            $('#problem_name').val(problemName).attr('readonly' , true)
        }else{
            $('#fun_name').val('').attr('readonly' , false)
            $('#problem_name').val('').attr('readonly' , false)
        }
   })

</script>
@endsection