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
                <!-- start -->
                 @if($custommers->count() > 0)
                @if($taking_ad)
                <div class="principleRelation container">
                    <!-- Condition block start -->
                   
                    <div class="solutionconditionBlock justify-content-center">


                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>People</h2>
                                <div class="projectList text-center">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        
                                        <div class="carousel-inner" role="listbox">
                                            @php $index = 1; @endphp
                                                @foreach($custommers as $user)
                                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} " data-entity_id="{{$user->id}}" data-file="{{ $user->file }}" >
                                                        <img  src="{{ asset('assets-new/users/'.$user->file)}}" alt="Chania" width="80%" height="128px">
                                                        <div class="carousel-caption custom">
                                                            <ul style="display:block">
                                                                <li>{{ $user->name }}</li>
                                                                <li style="color:red">{{ $user->type }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @php $index++; @endphp
                                            @endforeach    
                                               
                                        </div>
                                        <ol class="carousel-indicators custom">
                                            @php $index = 0; @endphp
                                                @foreach($custommers as $user)
                                                        <li data-target="#myCarousel" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                @php $index++; @endphp
                                            @endforeach 
                                        </ol>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="long-arrow">
                           
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                        </div>
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
                                                        <source src='{{ asset("assets-new/problem/" . $problem->file) }}#t=0.1' type="video/mp4">
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
                                <p style="position:relative; top:35px;left:10px;">{{ $problem->output_slug }}</p>
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
                            <input type="hidden" name="name" id="name_" value="averaging_approach">
                                
                                <h5>Do you understand that the only advantage that exists is to solve the underlying problem?  </h5>
                                <ul class="validate_que" style="list-style:none;">
                                    
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}  {{ (!$VerificationPermission) ? 'disabled':'' }}   value="1">&nbsp;&nbsp;Yes, I understand that the only advantage that exists is to solve the underlying problem</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}  {{ (!$VerificationPermission) ? 'disabled':'' }}    value="2">&nbsp;&nbsp;No, I do not understand that the only advantage that exists is to solve the underlying problem</label></li>
                                
                                </ul>
                                <h5>Do you understand that the only interest that exists is to solve the underlying problem?</h5>
                                <ul class="validate_que" style="list-style:none;">
                                    
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}  value="1">&nbsp;&nbsp;Yes, I do understand that the only interest that exists is to solve the underlying problem</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}  {{ (!$VerificationPermission) ? 'disabled':'' }} value="2">&nbsp;&nbsp;No, I do not understand that the only interest that exists is to solve the underlying problem</label></li>
                                
                                </ul>
        
                                @if($VerificationPermission)
                                <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                                @endif
                            </form>
                        </div>
                </div>
                <!-- End -->
                @else
                    @if($VerificationPermission)
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#entityModal"
                            id="">+ Identify</button>
                    </div>
                    @endif
                @endif

                @else
                <?php $showMsg = true ?>
                @endif
            </div>
        </div>
    </div>
    <!-- Content Section End -->

</div>
<div class="modal fade" id="entityModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" enctype="multipart/form-data">
        <form method="POST" id="entityForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Me Vs You Approach</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="updateProblemType" id="updateProblemType">
                        <input type="hidden" name="id" id="ver_id" value="{{ @$verification->id}}">
                        <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                        <input type="hidden" name="project_id" value="{{ $project_id }}">
                        <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">




                        <div class="form-group">
                            <input type="text" class="form-control" name="verificationType" disabled
                                value="Problem : {{@$problem->name}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="verificationType" disabled
                                value="Solution : {{@$solution->name}}">
                        </div>
                        @if(@$custommers->count() > 0)
                            @foreach($custommers as $user) 
                            <div class="form-group">
                                
                                <input type="text" class="form-control" name="verificationType" disabled
                                    value="{{ $user->type }} : {{ @$user->name }}">
                            </div>
                            @endforeach
                        @endif


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSave" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
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
    .carousel{
        height :auto;
        min-height: 258px;
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

$(document).on('click', '#btnSave', function (e) {
        e.preventDefault();
        var fd = new FormData($('#entityForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('adult.taking-advantage')}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function () {
                $('#btnSave').attr('disabled', true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSave').attr('disabled', false);
                $('#btnSave').html('Submit');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {
                if (response.success == false) {
                    $('#btnSave').attr('disabled', false);
                    $('#btnSave').html('Login');
                    var errors = response.data;
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    });
                } else {

                    toastr.success(response.message);
                    location.reload()


                }
            }
        });
    });


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