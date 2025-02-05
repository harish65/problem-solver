

@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
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
   
    <!-- Content Section Start -->
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                
                    <div class="col-sm-12">
                        <h1>{{ @$verificationType->page_main_title }}</h1>
                        <p>{{ @$verificationType->explanation }}</p>
                            <div class="relationImage text-center">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <div class="imgWrp carousel-inner" role="listbox">
                                            <div class="carousel-item active"  >
                                                <img  src="{{ asset('assets-new/verification_types/mn/mn1.png')}}" alt="Chania" width="100%">
                                            </div>
                                            <div class="carousel-item "  >
                                                <img  src="{{ asset('assets-new/verification_types/mn/mn2.png')}}" alt="Chania" width="100%">
                                            </div>
                                            <div class="carousel-item "  >
                                                <img  src="{{ asset('assets-new/verification_types/mn/mn3.png')}}" alt="Chania" width="100%">
                                            </div>
                                            <div class="carousel-item "  >
                                                <img  src="{{ asset('assets-new/verification_types/mn/mn4.png')}}" alt="Chania" width="100%">
                                            </div>
                                        </div>
                                        <ol class="carousel-indicators custom">
                                            <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                            <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                                            <li data-target="#myCarousel" data-slide-to="4" class=""></li>
                                        </ol>
                                </div>
                            </div>
                    </div>

            @if(!is_null($principle_identifications))    
                @if($mother_nature)
                    <!-- start -->
                    <div class="principleRelation mt-3">
                        <div class="conditionBlock">
                            <div class="solutionconditionBlock">
                                <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Problem</h2>
                                        <div class="projectList text-center">
                                            <div class="imgWrp">
                                                <img class="mx-auto"
                                                    src="{{ asset('assets-new/problem/'.$problem->file)}}" width="100%"
                                                    height="128px">
                                            </div>
                                            <p class="redText" style="color:red">{{ $problem->name }}</p>
                                        </div>
                                        <div class="projectList">
                                            <p class="date">{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                            <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="long-arrow">
                                    <!-- <p style="position:relative; top:35px;left:23px;">is replaced by</p> -->
                                    <!-- add arrow Image over here -->
                                    <img src="{{ asset('assets-new/images/arrowRight.png')}}" width="100px">
                                    <!-- add arrow Image over here -->
                                </div>
                                <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Solution</h2>
                                        <div class="projectList text-center">
                                            <div class="imgWrp">
                                                <img class="mx-auto"
                                                    src=" {{ asset('assets-new/solution/'.$solution->file)}}" width="100%"
                                                    height="128px">
                                            </div>
                                            <p class="redText" style="color:#00A14C">{{ $solution->name }}</p>
                                        </div>
                                        <div class="projectList">
                                            <p class="date">{{ date('d/m/Y', strtotime($solution->created_at))}}</p>
                                            <ul>
                                                <li>
        
                                                &nbsp;&nbsp;&nbsp;
                                                </li>
                                                <li>
                                                &nbsp;&nbsp;&nbsp;
                                                        
                                                </li>
                                                <li>
                                                &nbsp;&nbsp;&nbsp;
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="long-arrow">
                                    <!-- <p style="position:relative; top:35px;left:23px;">is replaced by</p> -->
                                    <!-- add arrow Image over here -->
                                    <img src="{{ asset('assets-new/images/arrowRight.png')}}" width="100px">
                                    <!-- add arrow Image over here -->
                                </div>
                                <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Solution Function</h2>
                                        <div class="projectList text-center">
                                            <div class="imgWrp">
                                                <img class="mx-auto"
                                                    src=" {{ asset('assets-new/solFunction/'.$Solution_function->file)}}" width="100%"
                                                    height="128px">
                                            </div>
                                            <p class="redText" style="color:#00A14C">{{ $Solution_function->name }}</p>
                                        </div>
                                        <div class="projectList">
                                            <p class="date">{{ date('d/m/Y', strtotime($Solution_function->created_at))}}</p>
                                            <ul>
                                                <li>
        
                                                &nbsp;&nbsp;&nbsp;
                                                </li>
                                                <li>
                                                &nbsp;&nbsp;&nbsp;
                                                        
                                                </li>
                                                <li>
                                                &nbsp;&nbsp;&nbsp;
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="long-arrow">
                                    <!-- <p style="position:relative; top:35px;left:23px;">is replaced by</p> -->
                                    <!-- add arrow Image over here -->
                                    <img src="{{ asset('assets-new/images/arrowRight.png')}}" width="100px">
                                    <!-- add arrow Image over here -->
                                </div>
                                <div class="blockProblem">
                                    <div class="projectBlock text-center">
                                        <h2>Principle</h2>
                                        <div class="projectList text-center">
                                            <div class="imgWrp">
                                                <img class="mx-auto"
                                                src=" {{ asset('assets-new/verification_types/pi/pi-card.jpg')}}" width="100%"
                                                height="250px">
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>


                        </div>
                        <div class="questionWrap">
                            <h2>Validation Question</h2>
                            <form id="validation_form">
                                    <input type="hidden" name="id" value="{{ @$verification->id }}">        
                                    <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}">        
                                    <input type="hidden" name="problem_id" value="{{ @$problem->id }}">        
                                    <input type="hidden" name="solution_id" value="{{ @$solution->id }}">        
                                    <input type="hidden" name="solution_fun_id" value="{{ @$Solution_function->id }}">        
                                    <input type="hidden" name="name" value="entity_usage">        
                                    <ul style="list-style:none;">
                                        <h5>Do you understand the existing of mother nature in your problem solution?</h5>
                                        <li><label><input type="radio"  name="validation_1" value="1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}>Yes, I do understand the existence of mother nature in my problem solution</label></li>
                                        <li><label><input type="radio"  name="validation_1" value="2" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}>No, I do not understand the existence of mother nature in my problem solution.</label></li>
                                    </ul>
                                    <ul style="list-style:none;">
                                        <h5>Do you take mother nature into consideration in your solution? </h5>
                                        <li><label><input type="radio"  name="validation_2" value="1" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}>Yes, I do take mother nature into consideration in my solution</label></li>
                                        <li><label><input type="radio"  name="validation_2" value="2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}>No, I do not take mother nature into consideration in my solution</label></li>
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
                        id="">+ Identify Entity Behind</button>
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
<div class="modal fade" id="entityModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" enctype="multipart/form-data">
    <form method="POST" id="mn_form_" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mother Nature</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php 
           
                        $problem_id =  Crypt::encrypt($problem_id);
                        $project_id =  Crypt::encrypt($project_id);
                        $solution_id =  Crypt::encrypt($solution_id);
                    ?>
                <div class="modal-body">
                <input type="hidden" name="updateProblemType" id="updateProblemType">
                    <input type="hidden" name="id" id="ver_id" value="{{ @$verification->id}}">
                    <input type="hidden" name="problem" id="problem_id" value="{{ $problem_id }}">
                    <input type="hidden" name="project" value="{{ $project_id }}">
                    <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="problem_name" disabled value="Problem : {{@$problem->name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="solution" disabled value="Solution : {{@$solution->name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="Solution_function" disabled value="Solution Function : {{@$Solution_function->name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="principle_identified" disabled value="Principle Identified : {{ (@$principle_identifications->principle_type == 0) ? 'The Given Set' : 'Derived Pricipal' ; }}">
                    </div>
                   

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
   
    
    
    <!-- Modal End -->

    
</div>

@endsection
@section('css')


<style>
.carousel-indicators{
    position:relative;
}
</style>
@endsection
@section('scripts')


<script>
   
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route('adult.varification',@$parameter) }}" + '/' + id;
})
('#verification_users').on('change', function () { 
        var verification_type_id = $('#verification_types').val();
        var id = $(this).val();
        window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + verification_type_id + '/' + id;
    })


</script>
<script>
routes();
$('.dashboard').click(function(){
    routes();
})

$(document).on('click', '#btnSave', function (e) {
        e.preventDefault();
        var fd = new FormData($('#mn_form_')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('adult.mother-nature')}}",
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

    function messageFunction(){
        
        swal({
            title: "Error",
            text: 'Problem , solution , Solution function  And Priciple Identification are not done.',
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    }
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