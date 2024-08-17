@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
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
                    <p>{{ @$verificationType->explanation }}</p>
                    <div class="relationImage text-center">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">

                            <div class="imgWrp carousel-inner" role="listbox">

                                <div class="carousel-item active">
                                    <img src="{{ asset('assets-new/verification_types/meu/mu1.png')}}" alt="Chania"
                                        width="100%">
                                </div>
                                <div class="carousel-item ">
                                    <img src="{{ asset('assets-new/verification_types/meu/mu2.png')}}" alt="Chania"
                                        width="100%">
                                </div>
                                <div class="carousel-item ">
                                    <img src="{{ asset('assets-new/verification_types/meu/mu3.png')}}" alt="Chania"
                                        width="100%">
                                </div>
                                <div class="carousel-item ">
                                    <img src="{{ asset('assets-new/verification_types/meu/mu4.png')}}" alt="Chania"
                                        width="100%">
                                </div>
                                <div class="carousel-item ">
                                    <img src="{{ asset('assets-new/verification_types/meu/mu4.png')}}" alt="Chania"
                                        width="100%">
                                </div>
                                <div class="carousel-item ">
                                    <img src="{{ asset('assets-new/verification_types/meu/mu4.png')}}" alt="Chania"
                                        width="100%">
                                </div>
                                <div class="carousel-item ">
                                    <img src="{{ asset('assets-new/verification_types/meu/mu4.png')}}" alt="Chania"
                                        width="100%">
                                </div>



                            </div>
                            <ol class="carousel-indicators custom">
                                <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                                <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                                <li data-target="#myCarousel" data-slide-to="4" class=""></li>
                                <li data-target="#myCarousel" data-slide-to="5" class=""></li>
                                <li data-target="#myCarousel" data-slide-to="6" class=""></li>
                                <li data-target="#myCarousel" data-slide-to="7" class=""></li>
                            </ol>
                        </div>

                    </div>
                   

                </div>
                @if($custommers->count() > 0 )
                @if($mevsyou)
                <!-- start -->
                <div class="principleRelation mt-3">
                    <div class="conditionBlock justify-content-center">

                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        @if($problem->problem_type == 0)
                                        @if(strlen($problem->problem_file) < 15) <img class="mx-auto aaa"
                                            src="{{ asset('assets-new/problem/'.$problem->file) }}"
                                            width="100%" height="128px">
                                            @endif
                                            @elseif($problem->problem_type == 1)
                                            <video class="mx-auto" controls="controls" preload="metadata" width="300"
                                                height="320" preload="metadata">
                                                <source
                                                    src="{{ asset('assets-new/problem/' . $problem -> problem_file) }}#t=0.1"
                                                    type="video/mp4">
                                            </video>
                                            @elseif($problem -> problem_type == 2)
                                            <iframe class="mx-auto" src="{{ $problem->problem_file }}" width="300"
                                                height="320"> </iframe>
                                            @endif
                                    </div>
                                    <p class="redText">{{ $problem->name }}</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{ date('d/m/Y' , strtotime($problem->created_at))}}</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">            
                            <p>Need</p>
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                        <!-- add arrow Image over here -->
                      </div>
                      <div class="blockProblem">
                        <div class="projectBlock text-center">
                          <h2>Solution</h2>
                          <div class="projectList text-center"> 
                          <div class="imgWrp">
                            @if($solution -> type == 0)
                                                @if(strlen($solution -> file) < 15)
                                                    <img class="mx-auto" src="{{ asset('assets-new/solution/'.$solution->file) }}" width="100%" height="128px">
                                                @endif
                                                @elseif($solution -> type == 1)
                                                <video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
                                                    <source src="{{ asset('assets-new/solution/'.$solution->file) }}#t=0.1" type="video/mp4">
                                                </video>
                                                @elseif($solution -> type == 2)
                                                    <iframe class="mx-auto" src="{{ $solution->file }}" width="100%" height="128px"> </iframe>
                                                @endif 
                          </div>
                            <p class="redText">{{ $solution->name }}</p>
                          </div>
                          <div class="projectList">
                            <p class="date">{{ date('d/m/Y' , strtotime($solution->created_at)) }}</p>
                            
                          </div>
                        </div>
                      </div>
                              
                    </div>
                    <div class="row">
                            <div class="col-md-12 text-end">
                                    <a href="{{ route('adult.me-and-you-next' , @$parameter) }}" class="btn btn-success" >Next Page<i class="fa fa-angle-double-right"></i></a>
                                   
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
                                <h5>Do I approach the solution of a problem one vs. another or people vs. people? </h5>
                                <li><label><input type="radio" name="validation_1" value="1" {{
                                            (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} >No, I
                                        approach the solution of a problem like I work with you and people work
                                        together?</label></li>
                                <li><label><input type="radio" name="validation_1" value="2" {{
                                            (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} >Yes, I
                                        approach the solution of a problem like me vs. you and people vs.
                                        people.</label></li>
                            </ul>
                            <ul style="list-style:none;">
                                <h5>Do I understand that to solve a problem is I work with and I don’t go against? </h5>
                                <li><label><input type="radio" name="validation_2" value="1" {{
                                            (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} >Yes, I
                                        understand the solution of a problem is I work with and I don’t go
                                        against</label></li>
                                <li><label><input type="radio" name="validation_2" value="2" {{
                                            (@$verification->validations->validation_2 == 2) ? 'checked' : '' }} >No, I
                                        do not understand the solution of a problem is I work with and I don’t go
                                        against</label></li>
                            </ul>
                            <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                    </div>
                </div>
                <!-- End -->
                @else
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#entityModal"
                        id="">+ Identify</button>
                </div>
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



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSave" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>




</div>

@endsection
@section('css')


<style>
    .carousel-indicators {
        position: relative;
    }
    .long-arrow p{
        position: relative;
        top:40px;
        left:45px;
    }
</style>
@endsection
@section('scripts')


<script>

    $('#verification_types').on('change', function () {
        var id = $(this).val();
        window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
    })
    $('.dropify').dropify();


</script>
<script>
    $('.nav-problem').click(function () {
        $(this).attr('href', '');
        localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));
        $(this).attr('href', $('#problem_nav').attr('href'))
    })
    $('.nav-solution').click(function () {
        $(this).attr('href', '');
        localStorage.setItem("sol", $('#solution_nav').attr('href'));
        $(this).attr('href', $('#solution_nav').attr('href'))
    })
    $('.nav-solution-func').click(function () {
        $(this).attr('href', '');
        localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));
        $(this).attr('href', $('#solution_fun_nav').attr('href'))
    })
    $('.verification').click(function () {
        $(this).attr('href', '');
        localStorage.setItem("varification", $('#verification').attr('href'));
        $(this).attr('href', $('#verification').attr('href'))
    })


    $('.dashboard').click(function () {
        //Solution
        $('.nav-solution').attr('href', '');
        localStorage.setItem("sol", $('#solution_nav').attr('href'));
        $('.nav-solution').attr('href', $('#solution_nav').attr('href'))
        //Problem
        $('.nav-problem').attr('href', '');
        localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));
        $('.nav-problem').attr('href', $('#problem_nav').attr('href'))
        //Sol fun
        $('.nav-solution-func').attr('href', '');
        localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));
        $('.nav-solution-func').attr('href', $('#solution_fun_nav').attr('href'))
        //verification
        $('.nav-varification').attr('href', '');
        localStorage.setItem("varification", $('#verification').attr('href'));
        $('.nav-varification').attr('href', $('#solution_fun_nav').attr('href'))

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
            url: "{{route('adult.me-and-you')}}",
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