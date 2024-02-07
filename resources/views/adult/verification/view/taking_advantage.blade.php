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
                <div class="principleRelation container">
                    <!-- Condition block start -->
                   
                    <div class="solutionconditionBlock justify-content-center">


                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>People</h2>
                                <div class="projectList text-center">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @php $index = 0; @endphp
                                                @foreach($custommers as $user)
                                                        <li data-target="#myCarousel" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                @php $index++; @endphp
                                            @endforeach 
                                        </ol>
                                        <div class="imgWrp carousel-inner" role="listbox">
                                            @php $index = 1; @endphp
                                                @foreach($custommers as $user)
                                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} " data-entity_id="{{$user->id}}" data-file="{{ $user->file }}" >
                                                        <img  src="{{ asset('assets-new/users/'.$user->file)}}" alt="Chania" width="80%" height="128px">
                                                    </div>
                                                @php $index++; @endphp
                                            @endforeach    
                                               
                                        </div>
                                    </div>
                                    <p class="redText" style="color:red">People</p>
                                </div>
                                <div class="projectList">
                                    
                                    <ul>
                                        
                                    </ul>
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
                            <input type="hidden" name="id" id="function_ad_id" value="{{ @$problemreplaced->id }}">
                            <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                            <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                            <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                            <input type="hidden" name="fileType" id="fileType">
                            <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                            <input type="hidden" name="verification_type_id" id="verification_type_id" value="{{ @$verificationType->id }}">
                            <input type="hidden" name="name"  value="taking_advantegs">
                                
                                <h5>Do you understand that the only advantage that exists is to solve the underlying problem?  </h5>
                                <ul class="validate_que" style="list-style:none;">
                                    
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}   value="1">&nbsp;&nbsp;Yes, I understand that the only advantage that exists is to solve the underlying problem</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}   value="2">&nbsp;&nbsp;No, I do not understand that the only advantage that exists is to solve the underlying problem</label></li>
                                
                                </ul>
                                <h5>Do you understand that the only interest that exists is to solve the underlying problem?</h5>
                                <ul class="validate_que" style="list-style:none;">
                                    
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }}   value="1">&nbsp;&nbsp;Yes, I do understand that the only interest that exists is to solve the underlying problem</label></li>
                                    <li><label>&nbsp;&nbsp;<input type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}   value="2">&nbsp;&nbsp;No, I do not understand that the only interest that exists is to solve the underlying problem</label></li>
                                
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
<form id="replace-problem">    
    <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
    <input type="hidden" name="project_id" value="{{ $project_id }}">
    <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
    <input type="hidden" name="solution_function_id" id="solution_function_id" value="{{ $Solution_function->id }}">   
    <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
</form>
</div>

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
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
</script>
<script>
function calculte(){
    var solval = $('#sol_val').val();
    var problempart = Math.round(solval/2);
     $('#problem_part_front , #problem_parts').val(problempart);
     $('#result').val(2);

}
//sol-fun-av
$(document).on('click','#replace_sol',function(e){
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