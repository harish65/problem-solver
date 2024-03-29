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

    <!-- Content Section Start -->
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
                
                <div class="principleRelation">
                    <div class="conditionBlock">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Function</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto"
                                            src="{{ asset('assets-new/solFunction/'.$Solution_function->file)}}" width="100%"
                                            height="128px">
                                    </div>
                                    <p class="redText" style="color:red">{{ $Solution_function->name }}</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{ date('d/m/Y', strtotime($Solution_function->created_at))}}</p>
                                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <!-- add arrow Image over here -->
                                <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
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
                            <!-- add arrow Image over here -->
                                <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>People</h2>
                                <div class="projectList text-center min-height-250">
                                    <div class="imgWrp">
                                        <div id="myCarousel" class="carousel slide " data-ride="carousel">
                                        <ol class="carousel-indicators">
                                        @php $index = 0; @endphp
                                            @foreach($custommers as $entity)
                                                    <li data-target="#myCarousel" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                            @php $index++; @endphp
                                        @endforeach 
                                        </ol>
                                            <div class="imgWrp  carousel-inner" role="listbox">
                                                @php $index = 1; @endphp
                                                @foreach($custommers as $entity)
                                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} ">
                                                        <img src="{{ asset('assets-new/users/'.$entity->file)}}" alt="Chania" width="80%" height="128px">
                                                    </div>
                                                    @php $index++; @endphp
                                                @endforeach 
                                            </div>
                                        </div>
                                       
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
                    </div>

                </div>
            </div>
                <!-- End -->
            
        </div>
    </div>



    <div class="relationshipContent">
        <div class="container">
            <div class="row ">
                <div class="col-md-8">
                    <h2>Function and People Identification</h2>
                </div>
                <div class="col-md-4    ">
                    <button type="button"  class="btn btn-success addVocabularyBtn"   data-toggle="modal" data-target="#exampleModal">+ Add </button>
                </div>
                               
            </div>

            <div class="row mt-3">
                <table class="table slp-tbl text-center">
                    <thead>
                        <th>Person Name</th>
                        <th>Function Name</th>
                        
                    </thead>
                    <tbody>
                       @foreach($people as $data)
                       <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $Solution_function->name }}</td>
                       </tr>
                       @endforeach     
                    </tbody>
                </table>
            </div>
        </div>
</div>
</div>
<!-- Content Section End -->

<!-- Modal Start -->
    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <label for="compensator">Function Name</label>
                <input type="text" name="function_name" disabled value="{{ $Solution_function->name }}" class="form-control" id="fun_name">
            </div>
            <div class="form-group">
                <label for="feedback">Problem Name</label>
                <input type="text" disabled name="problem_name" value="{{ $problem->name }}" disabled class="form-control" id="fun_name">
                
            </div>
           
            <div class="form-group">
                <select name="customer" class="form-control" id="customer">
                    <option value="">Please Select....</option>
                    @foreach($custommers as $custommer)
                        <option value="{{ $custommer->id }}">{{ $custommer->name }}</option>
                    @endforeach
                </select>
            </div>
            
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
   .long-border{
        border-left: 3px solid #000;
        height: 320px;
        border-color: #28a745;
    }
    .imgWrp a{
        cursor: pointer;
    }
    .margit-fifty{
        margin-top: 20%;
    }
    .margit-fifty p{
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
            url: "{{route('adult.function-sub-and-people')}}",
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



</script>
@endsection