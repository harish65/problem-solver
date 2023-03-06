@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
<div class="container">

    <div class="row spl-row">
        <h4>Problem</h4>
    </div>
    <div class="row spl-row-second">
        <h4>TITLE FOR EXPLANTION</h4>
    </div>
     <div class="banner text-center">
        <img src="{{ asset('/assets-new/problem/problem.png') }}" width="666px" height="213px" >
    </div>

    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit
        </p>
    </div>
    @if($problem != null)
    <div class="conditionBlock">
        <div class="blockProblem">
            <div class="projectBlock text-center">
              <h2>Problem</h2>
              <div class="projectList text-center"> 

                        <?php 
                            $parameters = ['problem_id'=> $problem->id , 'project_id' => $projectID];
                            $parameter =  Crypt::encrypt($parameters);
                        ?>
                <a id="problem_nav" href="{{ route("adult.problem",@$parameter) }}"></a>
                <a id="solution_nav" href="{{ route("adult.solution",@$parameter) }}"></a>
                <a id="solution_fun_nav" href="{{ route("adult.solution-func",@$parameter) }}"></a>
                <div class="imgWrp">
                                @if($problem -> type == 0)
									@if(strlen($problem -> file) < 15)
										<img class="mx-auto" src="{{ asset("assets-new/problem/" . $problem -> file) }}" width="100%" height="128px">
									@endif
								@elseif($problem -> type == 1)
									<video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
										<source src="{{ asset("assets-new/problem/" . $problem -> file) }}#t=0.1" type="video/mp4">
									</video>
								@elseif($problem -> type == 2)
									    <iframe class="mx-auto" src="{{ $problem -> file }}" width="100%" height="128px"> </iframe>
								@endif
                </div>
                <p class="redText">{{ $problem->name }}</p>
              </div>
              <div class="projectList">
                <p class="date">{{ date('d/m/Y' , strtotime($problem->created_at))}}</p>
                <ul>
                  <li>
                        <a href="javaScript:Void(0)"  class="editProblemBtn"
                                                                                    data-id="{{ $problem -> id }}"
                                                                                    data-name="{{ $problem -> name }}"
                                                                                    data-type="{{ $problem -> type }}"
                                                                                    data-file="{{ $problem -> file }}"
                                                                                    data-cat="{{ $problem -> category_id }}"
                        >
                            <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt=""/>
                        </a>
                </li>
                  <li><a data-id="{{ $problem -> id }}" class="delProblemBtn" title="Delete" ><img src="{{ asset('/assets-new/images/deleteIcon.png')}}" alt=""/></a></li>
                  <li><a href="#"><img src="{{ asset('/assets-new/images/uploadIcon.png')}}" alt=""/></a></li>
                </ul>
              </div>
            </div>
          </div>
    </div>
    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit
        </p>
    </div>
    <div class="row pt-5">
        <h5>Validation Questions</h5>
        <p>Have you performed analysis to identify the problem correctly?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                <?php 
                    $parameters = ['problem_id'=> $problem->id , 'project_id' => $problem->project_id];
                    $parameter =  Crypt::encrypt($parameters);
                ?>
                <input type="radio" {{ ($problem->validation == '0') ? 'checked' : ''}} value="0" data-id="{{ $parameter  }}" class="form-check-input validation" name="optradio">Yes, I have performed analysis to identify the problem correctly
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="radio" class="form-check-input validation" {{ ($problem->validation == '1') ? 'checked' : ''}} value="1" data-id="{{ $parameter  }}" name="optradio">No, I have not performed analysis to identify the problem correctly
                </label>
            </div>
            
        </div>
    </div>
@else
    <div class="row" style="margin-bottom: 10%;">
            <div class="col-md-6">
                        <button class="btn btn-success" data-toggle="modal" data-target="#add-problem-modal" type="button" id="add-problem">Add Problem</button>
            </div>
    </div>

@endif
 </div>   

@include('adult.problem.modal.add-problem',[$projectID])
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .delProblemBtn{
        cursor: pointer;
    }
    p.redText {
        margin-top: 10px;
    }
</style>
<style>
    .delProblemBtn{
        cursor: pointer;
    }    
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

<script>
    
    $('.dropify').dropify();
    $(".updateProblemType").change(function(){
            var type = $(this).val();

            if(type == 0){
                $("#updateProblemType").val("0");
                $("#updateProblemFileType").css("display", "block");
                $("#updateProblemLinkType").css("display", "none");
               
            }else if(type == 2){
                $("#updateProblemType").val("2");
                $("#updateProblemFileType").css("display", "none");
                $("#updateProblemLinkType").css("display", "block");
                
            }
        });
    $(document).on('click','#btnUpadteProblem',function(e){
       e.preventDefault();
       var fd = new FormData($('#updateProlemForm')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.store-problem')}}",
           data: fd,
           processData: false,
           contentType: false,
           dataType: 'json',
           type: 'POST',
           beforeSend: function(){
             $('#btnUpadteProblem').attr('disabled',true);
             $('#btnUpadteProblem').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
           },
           error: function (xhr, status, error) {
               $('#btnUpadteProblem').attr('disabled',false);
               $('#btnUpadteProblem').html('Submit');
               $.each(xhr.responseJSON.data, function (key, item) {
                   toastr.error(item);
               });
           },
           success: function (response){
             if(response.success == false)
             {
                 $('#btnUpadteProblem').attr('disabled',false);
                 $('#btnUpadteProblem').html('Login');
                 var errors = response.data;
                 $.each( errors, function( key, value ) {
                     toastr.error(value)
                 });
             } else {
                
                 toastr.success(response.message);
                 if(response.data.params != '' && typeof response.data.params  != 'undefined'){
                    window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params 
                 }else{
                    window.location.href = "{{ route('adult.dashboard')}}"
                 }
                 
              }
           }
       });
   });
</script>
<script>    
   $(document).on('click', '.delProblemBtn', function(e){
         e.preventDefault();
         var r = confirm("Are you sure to delete");
         if (r == false) {
             return false;
         }
         var id = $(this).attr('data-id')
         $.ajaxSetup({
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
               });      
         $.ajax({
               url: "{{route('adult.delete-problem')}}",
               data:{id :  id},         
              
               type: 'POST',           
               error: function (xhr, status, error) {
                   $.each(xhr.responseJSON.data, function (key, item) {
                       toastr.error(item);
                   });
               },
               success: function (response){
                
                   if(response.success == false)
                   {
                       var errors = response.data;
                       $.each( errors, function( key, value ) {
                           toastr.error(value)
                       });
                   } else {
                       toastr.success(response.message);
                       window.location.href = "{{ route('adult.dashboard')}}"
                   }
               }
           });
     });
</script>
<script>
    $(".editProblemBtn").click(function(){
        
       $("#updateProblemId").val($(this).data("id"));
       $("#updateProblemName").val($(this).data("name"));
       $('#category_id').val($(this).attr('data-cat'))

       if($(this).data("type") == 2){
           $("#updateProblemType").val("2");
           $("#updateProblemFileType").css("display", "none");
           $("#updateProblemLinkType").css("display", "block");
           
           $("#updateProblemFileRadio").attr("checked", false);
           $("#updateProblemLinkRadio").attr("checked", true);

           $("#updateProblemLinkFile").val($(this).data("file"));
       }else{
           $("#updateProblemType").val("0");
           $("#updateProblemFileType").css("display", "block");
           $("#updateProblemLinkType").css("display", "none");

           $("#updateProblemFileRadio").attr("checked", true);
           $("#updateProblemLinkRadio").attr("checked", false);

           if($(this).file != ""){
               var file = $(this).data("file");
               var drEvent = $('#updateProblemFileFile').dropify(
               {
                   defaultFile: "/assets-new/problem/" + file
               });
               drEvent = drEvent.data('dropify');
               drEvent.resetPreview();
               drEvent.clearElement();
               drEvent.settings.defaultFile = "/assets-new/problem/" + file;
               drEvent.destroy();
               drEvent.init();	
           }
           
       }

       $("#add-problem-modal").modal("show");
   });
   //Update Validations

   $('.validation').on('change',function(){
        var problem = $(this).attr('data-id');
        var validation  = $(this).val();
        $.ajaxSetup({
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
               }); 
        $.ajax({
           url: "{{route('adult.validation')}}",
           data: {data : problem , value : validation},
           type: 'POST',
           success: function (response){                
               console.log(response)
            }

        })
   })
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

})

</script>
@endsection