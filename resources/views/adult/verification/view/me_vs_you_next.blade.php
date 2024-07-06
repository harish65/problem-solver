@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')

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
                <div class="col-sm-2">
                    <a href="{{ route('adult.varification',[@$parameter , 28]) }}" class="btn btn-success">Back</a>
                </div>
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
                @if($mevsyou)
                <!-- start -->

                <div class="conditionBlock">
                        <div class="inner_conditionblock d-flex">
                            <ul class="custom_height">
                                @foreach($custommers as $k=>$user)
                                <li class="d-flex customer_li">
                                    <div class="blockProblem">
                                        <div class="projectBlock text-center">
                                            <h2>Person</h2>
                                            <div class="projectList text-center">
                                                <div class="imgWrp">
                                                    <img class="mx-auto"
                                                        src="{{ asset('assets-new/users/'.$user->file)}}" width="100%"
                                                        height="128px">
                                                </div>
                                                <div class="person_name">
                                                    <span>{{ $user->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="long-arrow"><img src="{{ asset('assets-new/images/arrowRight.png')}}" width="100"></div>
                                </li>
                                @endforeach
                              
                            </ul>
                            <div class="blockProblem">
                                <div class="projectBlock text-center" style="height: 95%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="100px" y="10px" width="100"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M 11 2 L 11 11 L 2 11 L 2 13 L 11 13 L 11 22 L 13 22 L 13 13 L 22 13 L 22 11 L 13 11 L 13 2 Z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            
                        </div>
                        <div class="long-arrow">
                            <p>Work Together</p>
                            <p>To Execute</p>
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}" width="100">
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                            <h2>Solution Function</h2>
                            <div class="projectList text-center"> 
                            <div class="imgWrp">
                                @if($Solution_function -> type == 0)
                                            @if(strlen($Solution_function -> file) < 15)
                                                <img class="mx-auto" src="{{ asset('assets-new/solFunction/'.$Solution_function->file) }}" width="100%" height="128px">
                                            @endif
                                            @elseif($Solution_function -> type == 1)
                                            <video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
                                                <source src="{{ asset('assets-new/solFunction/'.$Solution_function->file) }}#t=0.1" type="video/mp4">
                                            </video>
                                            @elseif($Solution_function -> type == 2)
                                                <iframe class="mx-auto" src="{{ $Solution_function->file }}" width="100%" height="128px"> </iframe>
                                            @endif 
                            </div>
                                <p class="redText">{{ $Solution_function->name }}</p>
                            </div>
                            <div class="projectList">
                                <p class="date">{{ date('d/m/Y' , strtotime($Solution_function->created_at)) }}</p>
                                <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                            </div>
                            </div>
                      </div>
                      <div class="long-arrow">
                        <p>To Solve</p>
                        <img src="{{ asset('assets-new/images/arrowRight.png')}}" width="100">
                    </div>
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
                                <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                            </div>
                        </div>
                    </div>
                    </div><!-- End condition block -->
                @else
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#commonSolutionModal"
                        id="">+ Identify</button>
                </div>
                @endif

            </div>
        </div>
    </div>
    <!-- Content Section End -->

    @php $verificationName ='Me Vs. You Approach';
  
  @endphp
  @include('adult.verification.view.component.cards' , [$verificationName , $verificationType->id])
</div>
@endsection
@section('css')


<style>
    .carousel-indicators {
        position: relative;
    }

    .long-arrow p {
        position: relative;
        top: 40px;
        left: 45px;
    }

    .conditionBlock ul li {
        list-style: none;
    }

    .projectBlock svg {
        position: relative;
        top: 40%;
    }

    .conditionBlock {
        justify-content: center !important;
    }
    .customer_li{
        align-items: center;
    }
    .long-arrow p{
        position: relative;
        top: 30px;
        left: 10px;
        font-size: 15px;
    }
</style>
@endsection
@section('scripts')


<script>

    $('#verification_types').on('change', function () {
        var id = $(this).val();
        window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
    })
   


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
            url: "{{route('adult.me-and-you-next-store')}}",
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
    $(function () {
        $('#solutio_functio_div').removeClass('d-none');
        $('#solution_div').addClass('d-none')

       var ul_height = $('.custom_height').height();

    })

</script>
@endsection