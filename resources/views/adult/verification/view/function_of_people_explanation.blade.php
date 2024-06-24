
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
                 @if($functionOfPeople)
                <div class="principleRelation">
                    <div class="conditionBlock">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Function</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/solFunction/'.$Solution_function->file)}}" width="100%" height="128px">
                                    </div>
                                    <p class="redText">{{ $Solution_function->name }}</p>
                                </div>
                                <div class="projectList">
                                <ul>
                                        <li><p>&nbsp;&nbsp;&nbsp;&nbsp;</p></li>
                                        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                                        <li>&nbsp;&nbsp;&nbsp;</li>
                                       
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <p style="position:relative; top:35px;left:23px;">To Solve</p>
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/verification/1680525564.png')}}" width="100%" height="128px">
                                    </div>
                                    <p class="redText">{{ $problem->name }}</p>
                                </div>
                                <div class="projectList">
                                    <ul>
                                        <li><p>&nbsp;&nbsp;&nbsp;&nbsp;</p></li>
                                        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                                        <li>&nbsp;&nbsp;&nbsp;</li>
                                    </ul>
                                
                                    
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <p style="position:relative; top:35px;left:25px;">is exicuted By</p>
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
                      

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
                                                        <div class="carousel-caption custom">{{ $user->name }}</div>
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
                                    <p class="redText" style="color:red">People</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="questionWrap">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                        
                        

                        <h2>Validation Question</h2>
                       

                        <form id="validation_form">
                                <input type="hidden" name="id" value="{{ @$verification->id }}">        
                                <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}">        
                                <input type="hidden" name="problem_id" value="{{ @$problem->id }}">        
                                <input type="hidden" name="solution_id" value="{{ @$solution->id }}">        
                                <input type="hidden" name="solution_fun_id" value="{{ @$Solution_function->id }}">        
                                <input type="hidden" name="name" value="entity_usage">        
                        <ul style="list-style:none;">
                            <h5>Do you understand that the function to solve the underlying problem is executed by person/people?</h5>
                            <li><label><input type="radio"  name="validation_1" value="1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} >Yes, I understand that the function to solve the underlying problem is executed by person/people.</label></li>
                            <li><label><input type="radio"  name="validation_1" value="2" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} >No, I don’t understand that the function to solve the underlying problem is executed by person/people.</label></li>
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

    <!----Modal start----->
    <div class="modal fade" id="commonSolutionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" enctype="multipart/form-data">
        <form method="POST" id="entityForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Function of People Explanation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                        <input type="hidden" name="project_id" value="{{ $project_id }}">
                        <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                        <input type="hidden" name="verification_type" id="verification_type" value="{{ $verificationType->id }}">
                        <div class="form-group" id="solutio_functio_div">
                            <input type="text" class="form-control" name="" disabled
                                value="Solution Function : {{@$Solution_function->name}}">
                        </div>
                       
                        <div class="form-group">
                            <input type="text" class="form-control" name="" disabled
                                value="Problem : {{@$problem->name}}">
                        </div>
                        <div class="form-group">
                            <label>People In Project</label>
                        </div>
                        @foreach($custommers as $entity)
                        <div class="form-group">
                           <input type="text" value="{{  $entity->name .':'. $entity->type }}" class="form-control" disabled>
                        </div>
                        @endforeach


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="btnSave" class="btn btn-success">Apply</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!----Modal End----->
</div>

@endsection
@section('css')

<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
     .carousel{
        height :auto;
        min-height: 258px;
    }
</style>
@endsection
@section('scripts')

<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.tiny.cloud/1/5f20xhd98muhs1m7cl3eud00r4ugz5hxk5cbblquuo02mfef/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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



$(document).on('click','#btnSave',function(e){
    e.preventDefault();
    var fd = new FormData($('#entityForm')[0]);
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    fd.append('table_name', 'function_of_people_explanations');
        fd.app
    $.ajax({
        url: "{{route('adult.store-sep-steps')}}",
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
            //  if(response.data.params != '' && typeof response.data.params  != 'undefined'){
            //     window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params 
            //  }else{


                
                // window.location.href = "{{ route('adult.dashboard')}}"
            //  }
                
            }
        }
    });
});
</script>
@endsection