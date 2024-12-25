@extends('adult.layouts.adult')
@section('title', 'Home | Admin')
@section('content')
@php
    $showMessage =  false; 
    $project->id;
    $can_edit = \App\Models\Project::SharedProject($project->id,Auth::user()->id);
@endphp

<?php 
        
$parameters = ['problem_id'=> $problem_id , 'project_id' => $project->id];                            
$parameter =  Crypt::encrypt($parameters);
?>

<a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
<a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
<a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
<a id="relationship" href="{{ route('adult.rel',@$parameter) }}"></a>
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
            @if($project->shared == 1 && $can_edit != null && $can_edit->editable_project == 1)
                    @include('adult.solution.Editable_mode' , [$solution , $project , $can_edit])
                    @else
                    @include('adult.solution.Readonly_mode' , [$solution , $project , $can_edit])
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

    $('#viewsolution').on('change',function(){
        var id = $(this).val();
        window.location.href = "{{ route("adult.solution") }}" + '/' + id;
    })
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
$('.nav-relationship').click(function(){
    $(this).attr('href' , '');
    localStorage.setItem("relationship", $('#relationship').attr('href'));   
    $(this).attr('href' ,$('#relationship').attr('href'))
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
    //Relation
    $('.nav-relationship').click(function(){
        $(this).attr('href' , '');
        localStorage.setItem("relationship", $('#relationship').attr('href'));   
        $(this).attr('href' ,$('#relationship').attr('href'))
    })
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
   function saveValidations(){
            toastr.success('Validations Saved');
            location.reload();

        }
</script>
@endsection