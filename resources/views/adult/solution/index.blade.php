@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
<div class="container">

    <div class="row spl-row">
        <h4>Solution</h4>
    </div>
    <div class="row spl-row-second">
        <h4>TITLE FOR EXPLANTION</h4>
    </div>
    <div class="banner text-center">
        <img src="{{ asset('/assets-new/images/solution-banner.png') }}" width="666px" height="213px" >
    </div>
    
        <div class="row pt-5">
            <p>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit
            </p>
        </div>
                        <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                        ?>
                            <a id="problem_nav" href="{{ route("adult.problem",@$parameter) }}"></a>
                            <a id="solution_nav" href="{{ route("adult.solution",@$parameter) }}"></a>
                            <a id="solution_fun_nav" href="{{ route("adult.solution-func",@$parameter) }}"></a>
@if(isset($problem->id))
 <!-- Start card main div -->
    <div class="solutionconditionBlock">
        <div class="blockProblem">
            <div class="projectBlock text-center">
              <h2>Problem</h2>
              <div class="projectList text-center"> 
                <div class="imgWrp">
                        
                
                            @if($problem -> problem_type == 0)
                                    @if(strlen($problem -> problem_file) < 15)
									    <img class="mx-auto aaa" src="{{ asset("assets-new/problem/" . $problem -> problem_file) }}" width="100%" height="128px">
                                    @endif
                            @elseif($problem -> problem_type == 1)
									<video class="mx-auto" controls="controls" preload="metadata" width="300" height="320" preload="metadata">
										<source src="{{ asset("assets-new/problem/" . $problem -> problem_file) }}#t=0.1" type="video/mp4">
									</video>
                            @elseif($problem -> problem_type == 2)
									    <iframe class="mx-auto" src="{{ $problem -> problem_file }}"width="300" height="320"> </iframe>
                            @endif
                    </div>
                <p class="redText">{{ $problem->problem_name }}</p>
              </div>
              <div class="projectList">
                <p class="date">{{ date('d/m/Y' , strtotime($problem->problem_created_at))}}</p>
                <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
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
										<img class="mx-auto" src="{{ asset("assets-new/solution/" . $problem -> file) }}" width="100%" height="128px">
									@endif
								@elseif($problem -> type == 1)
									<video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
										<source src="{{ asset("assets-new/solution/" . $problem -> file) }}#t=0.1" type="video/mp4">
									</video>
								@elseif($problem -> type == 2)
									    <iframe class="mx-auto" src="{{ $problem -> file }}" width="100%" height="128px"> </iframe>
								@endif 
              </div>
                <p class="redText">{{ $problem->name }}</p>
              </div>
              <div class="projectList">
                <p class="date">{{ date('d/m/Y' , strtotime($problem->created_at)) }}</p>
                <ul>
                  <li>
                        <a href="javaScript:Void(0)"  class="editProblemBtn"
                                                                            data-id="{{ $problem -> id }}"
                                                                            data-name="{{ $problem -> name }}"
                                                                            data-problem="{{ $problem -> problem_name }}"
                                                                            data-type="{{ $problem -> type }}"
                                                                            data-file="{{ $problem -> file }}"                                                                            
                                                                            data-type-id ="{{ $problem -> solution_type_id }}"
                                                                                    
                        >
                            <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt=""/>
                        </a>
                </li>
                  <li><a data-id="{{ $problem -> id }}" class="delProblemBtn" title="Delete" ><img src="{{ asset('/assets-new/images/deleteIcon.png') }}" alt=""/></a></li>
                  <li><a href="#"><img src="{{ asset('/assets-new/images/uploadIcon.png') }}" alt=""/></a></li>
                </ul>
              </div>
            </div>
          </div>

    </div>
    <!-- End card main div -->
    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit
        </p>
    </div>
    <div class="row">
        <div class="row-title">
            <h5>Problem and Solution Identification</h5>
        </div>
        <div class="row-table">
            <table class="table slp-tbl text-center">
                <thead>
                    <th>Problem</th>
                    <th>Solution</th>
                </thead>
                <tbody>
                   
                    <tr>
                        <td style="color: red;">{{ (isset($problem->problem_name)) ? $problem->problem_name : 'NA'}}</td>
                        <td style="color: #00A14C;">{{ (isset($problem->name)) ? $problem->name : 'NA'}}</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>



    <div class="row pt-5">
        <h5>Validation Questions</h5>
        <p>Does the solution of the actual problem replace the actual problem?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                <?php 
                            // $parameters = ['problem_id'=> $problem->id , 'project_id' => $problem->project_id];
                            // $parameter =  Crypt::encrypt($parameters);
                        ?>
                <input type="radio" {{ ($problem->validation_first == '0') ? 'checked' : '' }} value="0" data-id="{{ $problem->id }}" class="form-check-input validation" name="optradio_firts">Yes, the solution of the actual problem replaces the actual problem
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="radio" class="form-check-input validation" {{ ($problem->validation_first == '1') ? 'checked' : '' }} value="1" data-id="{{ $problem->id }}" name="optradio_firts">No, the solution of the actual problem does not replace the actual problem
                </label>
            </div>
            
        </div>
    </div>
    <div class="row pt-5">
        <p>Does the (solution name pull from the database) solve the (problem name pull from the database)?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                
                <input type="radio" {{ ($problem->validation_second == '0') ? 'checked' : '' }} value="0" data-id="{{ $problem->id }}" class="form-check-input validation" name="optradio">Yes, (solution name form database) solves (problem name from database)
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                <input type="radio" class="form-check-input validation" {{ ($problem->validation_second == '1') ? 'checked' : '' }} value="1" data-id="{{ $problem->id }}" name="optradio">No, (solution name form database) does not solve (problem name from database)
                </label>
            </div>
            
        </div>
    </div>




@else
    <div class="row" style="margin-bottom: 10%;">
            <div class="col-md-6 align-middle">
                <button class="btn btn-success" data-toggle="modal" data-target="#add-sol-modal" type="button" id="add-solution">Add Solution</button>
            </div>
    </div>
@endif 





 </div>   
@include('adult.solution.model.add-sol' , [$problem_id , $solutionTypes])

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .delProblemBtn{
        cursor: pointer;
    }
    .long-arrow cross-text.{
        position: relative;
        top:20px;
   }
</style>
@endsection

@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

<script>
    $('.dropify').dropify();
    $(".solutionType").change(function(){
            var type = $(this).val();
            if(type == 0){
                $("#solutionFileType").val("0");
                $("#solutionFileType").css("display", "block");
                $("#solutionLinkType").css("display", "none");
                $('#solutionLinkTypeFile').val('')
            }else if(type == 2){
                $("#solutionFileType").val("2");
                $("#solutionFileType").css("display", "none");
                $("#solutionLinkType").css("display", "block");
                $('#solutionFile').val('')
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
           url: "{{route('adult.store-solution')}}",
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
                    window.location.href = "{{ route('adult.solution', )}}" + '/' + response.data.params 
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
               url: "{{route('adult.delete-solution')}}",
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
      
       $("#id").val($(this).data("id"));
       $("#problem").val($(this).data("problem"));
       $("#solutionName").val($(this).data("name"));
       $("#solution_type").val($(this).attr("data-type-id"));
       if($(this).data("type") == 2){

           $("#solutionLinkRadio").val("2");
           $("#solutionFileType").css("display", "none");
           $("#solutionLinkType").css("display", "block");
           
           $("#solutionLinkRadio").attr("checked", false);
           $("#solutionLinkRadio").attr("checked", true);

           $("#solutionLinkTypeFile").val($(this).data("file"));
       }else{
           $("#updateProblemType").val("0");
           $("#solutionFileType").css("display", "block");
           $("#solutionLinkType").css("display", "none");
           

           $("#solFileRadio").attr("checked", true);
           $("#solutionLinkRadio").attr("checked", false);
           if($(this).file != ""){
               var file = $(this).data("file");
               var drEvent = $('#solutionFile').dropify(
               {
                   defaultFile: "/assets-new/solution/" + file
               });
               drEvent = drEvent.data('dropify');
               drEvent.resetPreview();
               drEvent.clearElement();
               drEvent.settings.defaultFile = "/assets-new/solution/" + file;
               drEvent.destroy();
               drEvent.init();	
           }
           
       }

       $("#add-sol-modal").modal("show");
   });
   //Update Validations

   
   
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

$('.validation').on('change',function(){
        var problem = $(this).attr('data-id');
        var validation  = $(this).val();
        var name = $(this).attr('name')
        $.ajaxSetup({
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
               }); 
        $.ajax({
           url: "{{route('adult.sol-validation')}}",
           data: {data : problem , value : validation , name : name},
           type: 'POST',
           success: function (response){                
               console.log(response)
            }

        })



   })
</script>
@endsection