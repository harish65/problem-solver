@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
@php
    $showMessage =  false; 
    $can_edit = \App\Models\Project::SharedProject($project->id , Auth::user()->id);
@endphp

<div class="container">
    <div class="row spl-row">
        <h4>Solution Function</h4>
    </div>
    <div class="row spl-row-second">
        <h4>TITLE FOR EXPLANTION</h4>
    </div>
    <div class="banner text-center">
        <img src="{{ asset('/assets-new/images/solution-function-banner.png') }}" width="666px" height="213px">
    </div>

    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
            dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
            suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
            vulputate velit
        </p>
        
    </div>
     <div class="row pt-5">
            @include('adult.quiz.quiz-component' , [$project->id , $pageId , $pageType])
        </div>
                <?php
                    $parameters = ['project_id' => $project_id , 'problem_id'=> $problem_id , 'solution_id' => $solution_id];
                    $parameter =  Crypt::encrypt($parameters); 
                ?>
                <a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
                <a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
                <a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
                <a id="verification" href="{{ route('adult.varification',@$parameter) }}"></a>
                <a id="relationship" href="{{ route('adult.rel',@$parameter) }}"></a>      
    <!-- If project shared  -->
    @if(($project->shared == 1 && $can_edit != null && $can_edit->editable_project == 1) || Auth::user()->id == $project->user_id)
        @include('adult.solFunction.Editable_mode' , [$solFunctions , $project , $can_edit])    
    @else
    
        @include('adult.solFunction.Readonly_mode' , [$solFunctions , $project , $can_edit])          
    @endif       
    
</div>
@include('adult.solFunction.modal.add-sol-func',[$project_id , $problem_id , $solution_id])
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
  function saveValidations(){
            toastr.success('Validations Saved');
            location.reload();

        }

$(".dropify").dropify();

</script>
<script>
    // var shoMessage = '{{ $showMessage }}'
    //     if(shoMessage){
    //         var solutionMsg = "The solution function for a problem enabled both the problem and the solution to be identified.  If the problem and the solution have not been identified, then there is no solution function for that problem.  Please, refer to the problem and/or solution pages to identify the problem and/or the solution.  Then return here to identify the solution function for the problem."
    //         swal({
    //         title: "No Solution Function Created",
    //         text: solutionMsg,
    //         type: "info",
    //         showCancelButton: true,
    //         confirmButtonColor: '#00A14C',
    //         })
    //     }
    </script>
<script>
    $(".updateSolFunctionType").change(function(){
        var type = $(this).val();
        if(type == 0){
            $("#updateSolFunctionType").val("0");
            $("#updateSolFunctionFileType").css("display", "block");
            $("#updateSolFunctionLinkType").css("display", "none");
        }else if(type == 2){
            $("#updateSolFunctionType").val("2");
            $("#updateSolFunctionFileType").css("display", "none");
            $("#updateSolFunctionLinkType").css("display", "block");
        }
    });
</script>
<script>
     $(document).on('click','#sol-function',function(e){       
       e.preventDefault();
       var urlSolfunction =  null;
       
            urlSolfunction = "{{route('adult.store-solution-func')}}" 
      
       
       if($('#updateSolFunctionProblemId').val() == ''){
            toastr.error('In order to identify a solution for a problem, the problem must exist.  In order to identify a solution for a problem, the problem must be identified.  Since the problem is not identified, then the solution for that problem cannot be identified.  Please, use the problem identification to identify the problem first before identifying the solution for that problem.');
            return false;
        }
        if($('#updateSolFunctionSolutionSelect').val() == ''){
            toastr.error('In order to identify a solution for a problem, the problem must exist.  In order to identify a solution for a problem, the problem must be identified.  Since the problem is not identified, then the solution for that problem cannot be identified.  Please, use the problem identification to identify the problem first before identifying the solution for that problem.');
            return false;
        }
       var fd = new FormData($('#updateFormSolFunctionModal')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       $.ajax({
           url: urlSolfunction,
           data: fd,
           processData: false,
           contentType: false,
           dataType: 'json',
           type: 'POST',
           beforeSend: function(){
             $('#sol-function').attr('disabled',true);
             $('#sol-function').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
           },
           error: function (xhr, status, error) {
               $('#sol-function').attr('disabled',false);
               $('#sol-function').html('Submit');
               $.each(xhr.responseJSON.data, function (key, item) {
                   toastr.error(item);
               });
           },
           success: function (response){
             if(response.success == false)
             {
                 $('#sol-function').attr('disabled',false);
                 $('#sol-function').html('Login');
                 var errors = response.data;
                 $.each( errors, function( key, value ) {
                     toastr.error(value)
                 });
             } else {
                
                 toastr.success(response.message);
                 if(response.data.params != '' && typeof response.data.params  != 'undefined'){
                    window.location.href = "{{ route('adult.solution-func', )}}" + '/' + response.data.params 
                 }else{
                    window.location.href = "{{ route('adult.dashboard')}}"
                 }
                 
              }
           }
       });
   });
</script>

<script>
$(".editSolFunBtn").click(function(){
                var id = $(this).data("id");
                var problem_id = $(this).data("problem");
                var solution_id = $(this).data("solution");
                var file = $(this).data("file");
                var name = $(this).data("name");
                var type = $(this).data("type");
                var solFunctionType = $(this).data("solution_function_type_id");

                        $("#updateSolFunctionId").val(id);
                        $("#updateSolFunctionProblemId").val(problem_id);
                        $("#updateSolFunctionName").val(name);
                        $("#updateSolFunctionTypeId").val(solFunctionType);
                        $("#updateSolFunctionSolutionSelect").val(solution_id);
                        $("#sol-function").val('update')
                        if(type == 2){
                            $("#updateSolFunctionType").val("2");
                            $("#updateSolFunctionFileType").css("display", "none");
                            $("#updateSolFunctionLinkType").css("display", "block");
                            
                            $("#updateSolFunctionFileRadio").attr("checked", false);
                            $("#updateSolFunctionLinkRadio").attr("checked", true);

                            $("#updateSolFunctionLinkFile").val(file);
                        }else{
                            $("#updateSolFunctionType").val("0");
                            $("#updateSolFunctionFileType").css("display", "block");
                            $("#updateSolFunctionLinkType").css("display", "none");

                            $("#updateSolFunctionFileRadio").attr("checked", true);
                            $("#updateSolFunctionLinkRadio").attr("checked", false);

                            if(file != ""){
                                var drEvent = $('#updateSolFunctionFileFile').dropify(
                                {
                                    defaultFile: "/assets/solFunction/" + file
                                });
                                drEvent = drEvent.data('dropify');
                                drEvent.resetPreview();
                                drEvent.clearElement();
                                drEvent.settings.defaultFile = "/assets-new/solFunction/" + file;
                                drEvent.destroy();
                                drEvent.init();	
                            }
                            
                        }

                        $("#updateSolFunctionModal").modal("show");
                    })
          
        
</script>
<script>    
    $(document).on('click', '.delSolFunBtn', function(e){
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
                url: "{{route('adult.delete-solution-func')}}",
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
                        $('#nav-solution-func').attr('href' , '')
                        localStorage.setItem('sol-fun','')
                        toastr.success(response.message);
                        window.location.href = "{{ route('adult.dashboard')}}"
                    }
                }
            });

           
      });

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
           url: "{{route('adult.solution-func-validation')}}",
           data: {data : problem , value : validation , name : name},
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
$('.verification').click(function(){
    $(this).attr('href' , '');
    localStorage.setItem("varification", $('#verification').attr('href'));   
    $(this).attr('href' ,$('#verification').attr('href'))
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

    //verification
    $('.nav-varification').attr('href' , '');
    localStorage.setItem("varification", $('#verification').attr('href'));   
    $('.nav-varification').attr('href' ,$('#verification').attr('href'))
    //Relation
    $('.nav-relationship').click(function(){
                $(this).attr('href' , '');
                localStorage.setItem("relationship", $('#relationship').attr('href'));   
                $(this).attr('href' ,$('#relationship').attr('href'))
                })
})


    $('#viewsolutionfunction').on('change',function(){ 
        var id = $(this).val();
        window.location.href = "{{ route("adult.solution-func") }}" + '/' + id;
       
    });
    
 </script>
@endsection