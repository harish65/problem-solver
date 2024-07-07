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
                @if($solutionTimeLocationTwo)
                <!-- start -->
                <div class="principleRelation">
                    <div class="conditionBlock-solution">
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
                        <p class="transitionPhrase">{{ $transitionPhrase->name }}</p>
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                        </div>
                       
                        <div class="solutioone-card">
                            <div class="location-card" style="min-height: 368px;">
                                <div class="location-head text-center">
                                    <h2>Destination</h2>
                                </div>
                                <div class="left-side float-left mt-4">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/solution/'.$solution->file)}}"
                                            width="100%" height="128px">
                                    </div>
                                    <div class="projectList text-center">
                                        <p class="redText" style="color: #00A14C;">{{ $solution->name }}</p>
                                        <p class="date">{{ date('d/m/Y', strtotime($solution->created_at))}}</p>
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="right-side float-right mt-4">
                                    <div class="imgWrp">
                                            <div id="myCarousel" class="carousel slide " data-ride="carousel">
                                                       
                                                       <div class="carousel-inner" role="listbox">
                                                           @php $index = 1; @endphp
                                                           @foreach($custommers as $entity)
                                                               <div class="carousel-item {{ ($index == 1) ? 'active':'' }} ">
                                                                   <img src="{{ asset('assets-new/users/'.$entity->file)}}" alt="Chania" width="80%" height="128px">                                                                        
                                                                   <div class="carousel-caption">
                                                                   <ul style="display:block;list-style:none;">
                                                                            <li>{{ $entity->name }}</li>
                                                                            <li style="color:red">{{ $entity->type }}</li>
                                                                    </ul>
                                                                   </div>
                                                               </div>                                                                  
                                                               @php $index++; @endphp
                                                           @endforeach 
                                                       </div>                                                  
                                                       <ol class="carousel-indicators">
                                                           @php $index = 0; @endphp
                                                               @foreach($custommers as $entity)
                                                                       <li data-target="#myCarousel" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                               @php $index++; @endphp
                                                           @endforeach 
                                                       </ol>
                                                      
                                                      
                                                   </div>
                                    </div>
                                    <div class="projectList text-center">
                                        <p class="redText" style="color: red;"></p>
                                        <p class="date"></p>
                                        <ul>
                                            
                                        </ul>
                                    </div>
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
                            <div class="title">
                                <h2>Solution time location2 Identification</h2>

                            </div>
                            <div class="entity">
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Problem</th>
                                        <th>Date</th>
                                        <th>Solution Function</th>
                                        <th>Date</th>
                                        <th>People</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="color: red;">{{ $problem->name }}</td>
                                            <td style="color: red;">{{ date('d/m/Y', strtotime($problem->created_at))}}</td>
                                            <td style="color: rgba(0, 161, 76, 0.5)">{{ $Solution_function->name }}</td>
                                            <td style="color: rgba(0, 161, 76, 0.5)">{{ date('d/m/Y', strtotime($Solution_function->created_at))}}</td>
                                            <td style="color: rgba(0, 161, 76, 0.5)">
                                                <ul>
                                                    @foreach($custommers as $user)
                                                    <li>{{ $user->name }}</li>
                                                    @endforeach    
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h2>Validation Question</h2>
                        <br>
                        <form id="validation_form">
                                <input type="hidden" name="id" value="{{ @$verification->id }}"> 
                        <h5>Do you start solving the problem with people?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} value="1">&nbsp;&nbsp;Yes, I start solving the problem with people </label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}  value="2">&nbsp;&nbsp;No, I don’t start solving the problem with people</label></li>
                           
                        </ul>

                        <h5>Do you finish solving the problem with the same people?</h5>
                        <ul class="validate_que" style="list-style:none;">
                            
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2"  {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} value="1">&nbsp;&nbsp;Yes, I finish solving the problem with the same people</label></li>
                            <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2"  {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }} value="2">&nbsp;&nbsp;No, I don’t finish solving the problem with the same people</label></li>
                           
                        </ul>
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                        
                    </div>
                </div>
                <!-- End -->
                @else
                <div class="col-sm-4">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#commonSolutionModal" id="">+ Identify</button>
                    </div>
                @endif   
            </div>
        </div>
    </div>
    <!-- Content Section End -->

    
    
    
    <!-- Modal End -->
</div>
@php $verificationName = ($verificationType->id  == 9) ? 'Solution Time Location Two' : 'Functions Belong to People Explanation';
  
  @endphp
  @include('adult.verification.view.component.cards' , [$verificationName , $verificationType->id])
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .carousel{
        height: 128px;
        /* overflow: hidden; */
        width: 200px;
        text-align:center;
    }
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
   
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
})
$('.dropify').dropify();


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


$(document).on('click', '#btnSave', function (e) {
        e.preventDefault();
        var fd = new FormData($('#entityForm')[0]);
        fd.append('table_name', 'solution_time_locations');
        fd.append('type', 2);
        fd.app
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('adult.store-sep-steps')}}",
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
                $('#btnSave').html('Apply');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {
                if (response.success == false) {
                    $('#btnSave').attr('disabled', false);
                    $('#btnSave').html('Apply');
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

    $('#solutio_functio_div').addClass('d-none');
    $('#solution_div').removeClass('d-none')

</script>
@endsection