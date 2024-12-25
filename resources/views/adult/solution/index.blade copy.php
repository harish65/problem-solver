@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
@php
    $showMessage =  false; 
    $can_edit = \App\Models\Project::SharedProject($project->id , $project->shared_with);
@endphp
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
                       

@if($solutions->count() > 0)
@if($project->user_id == Auth::user()->id)
    @include('adult.solution.solutions_dd' , [$solutions])
@endif

@if((!is_null($can_edit) && $can_edit->shared_with == Auth::user()->id && isset($solution) && $solution->user_id == Auth::user()->id))
 <!-- Start card main div -->
    <div class="solutionconditionBlock">
        <div class="blockProblem">
            <div class="projectBlock text-center">
              <h2>Problem</h2>
              <div class="projectList text-center"> 
                <div class="imgWrp">                      
                
                            @if($solution -> problem_type == 0)
                                    @if(strlen($solution -> problem_file) < 15)
									    <img class="mx-auto aaa" src="{{ asset('assets-new/problem/' . $solution -> problem_file) }}" width="100%" height="128px">
                                    @endif
                            @elseif($solution -> problem_type == 1)
									<video class="mx-auto" controls="controls" preload="metadata" width="300" height="320" preload="metadata">
										<source src="{{ asset('assets-new/problem/' . $solution -> problem_file) }}#t=0.1" type="video/mp4">
									</video>
                            @elseif($solution -> problem_type == 2)
									    <iframe class="mx-auto" src="{{ $solution -> problem_file }}"width="300" height="320"> </iframe>
                            @endif
                    </div>
                <p class="redText">{{ $solution->problem_name }}</p>
              </div>
              <div class="projectList">
                <p class="date">{{ date('d/m/Y' , strtotime($solution->problem_created_at))}}</p>
                <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
              </div>
            </div>
          </div>
          <div class="long-arrow">            
                <p style="position:relative; top:35px;left:10px;">{{ $solution->output_slug }}</p>
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
										<img class="mx-auto" src="{{ asset('assets-new/solution/'.$solution -> file) }}" width="100%" height="128px">
									@endif
								    @elseif($solution -> type == 1)
									<video class="mx-auto" controls="controls" preload="metadata" width="100%" height="128px" preload="metadata">
										<source src="{{ asset('assets-new/solution/'.$solution -> file) }}#t=0.1" type="video/mp4">
									</video>
								    @elseif($solution -> type == 2)
									    <iframe class="mx-auto" src="{{ $solution -> file }}" width="100%" height="128px"> </iframe>
								    @endif 
              </div>
                <p class="redText">{{ $solution->name }}</p>
              </div>
              <div class="projectList">
                <p class="date">{{ date('d/m/Y' , strtotime($solution->created_at)) }}</p>
                @if($can_edit->editable_project)
                    @if(($can_edit->editable_solution && Auth::user()->id == $can_edit->shared_with) || (!$can_edit->editable_solution && Auth::user()->id == $project->user_id) || $solution->user_id == Auth::user()->id)
                    
                        <ul>
                            <li>
                                    <a href="javaScript:Void(0)"  class="editProblemBtn"
                                                                                        data-id="{{ $solution -> id }}"
                                                                                        data-name="{{ $solution -> name }}"
                                                                                        data-problem="{{ $solution -> problem_name }}"
                                                                                        data-type="{{ $solution -> type }}"
                                                                                        data-file="{{ $solution -> file }}"                                                                            
                                                                                        data-type-id ="{{ $solution -> solution_type_id }}"
                                                                                                
                                    >
                                        <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt=""/>
                                    </a>
                                </li>
                            <li><a data-id="{{ $solution -> id }}" class="delProblemBtn" title="Delete" ><img src="{{ asset('/assets-new/images/deleteIcon.png') }}" alt=""/></a></li>
                            <!-- <li><a href="#"><img src="{{ asset('/assets-new/images/uploadIcon.png') }}" alt=""/></a></li> -->
                        </ul>
                        @else
                        <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                        @endif
                    
                @endif
              </div>
            </div>
          </div>
    </div>
    @endif
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
    
    @else
        @if((!is_null($can_edit) && $can_edit->editable_project == 1 && $can_edit->editable_solution == 1 &&  $can_edit->shared_with == Auth::user()->id) || $project->shared_with == 0)
        <div class="row" style="margin-bottom: 10%;">
            <div class="col-md-6 align-middle">
                <button class="btn btn-success" data-toggle="modal" data-target="#add-sol-modal" type="button" id="add-solution">Add Solution</button>
            </div>
        </div>       
        @else

        @include('adult.solution.solutions_dd' , [$solutions])
        @endif 
    
    <?php $showMessage =  true; ?>
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
    // var shoMessage = '{{ $showMessage }}'
    //     if(shoMessage){
    //         var solutionMsg = "It is impossible to identify the solution to a problem that does not exist.  Please refer to the problem page to identify the problem first before identifying the solution for that problem."
    //         swal({
    //         title: "No Solution Created",
    //         text: solutionMsg,
    //         type: "info",
    //         showCancelButton: true,
    //         confirmButtonColor: '#00A14C',
    //         })
    //     }
    </script>
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
// $('.nav-problem').click(function(){
//     $(this).attr('href' , ''); 
//     localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));   
//     $(this).attr('href' ,$('#problem_nav').attr('href'))
// })
// $('.nav-solution').click(function(){
//     $(this).attr('href' , ''); 
//     localStorage.setItem("sol", $('#solution_nav').attr('href'));   
//     $(this).attr('href' ,$('#solution_nav').attr('href'))
// })
// $('.nav-solution-func').click(function(){
//     $(this).attr('href' , '');
//     localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
//     $(this).attr('href' ,$('#solution_fun_nav').attr('href'))
// })
// $('.nav-relationship').click(function(){
//     $(this).attr('href' , '');
//     localStorage.setItem("relationship", $('#relationship').attr('href'));   
//     $(this).attr('href' ,$('#relationship').attr('href'))
// })

// $('.dashboard').click(function(){
//     //Solution
//     $('.nav-solution').attr('href' , '');
//     localStorage.setItem("sol", $('#solution_nav').attr('href'));   
//     $('.nav-solution').attr('href' ,$('#solution_nav').attr('href'))
//     //Problem
//     $('.nav-problem').attr('href' , '');
//     localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));       
//     $('.nav-problem').attr('href' ,$('#problem_nav').attr('href'))
//     //Sol fun
//     $('.nav-solution-func').attr('href' , '');
//     localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
//     $('.nav-solution-func').attr('href' ,$('#solution_fun_nav').attr('href'))
//     //Relation
//     $('.nav-relationship').click(function(){
//         $(this).attr('href' , '');
//         localStorage.setItem("relationship", $('#relationship').attr('href'));   
//         $(this).attr('href' ,$('#relationship').attr('href'))
//     })
// })

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
   function saveValidations(){
            toastr.success('Validations Saved');
            location.reload();

        }
</script>
@endsection