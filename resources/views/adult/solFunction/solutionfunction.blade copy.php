@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
@php
    $showMessage =  false; 
    $can_edit = \App\Models\Project::SharedProject($project->id , $project->shared_with);
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
                    
    @if(isset($solFunctions->id))
                        <?php
                            $parameters = ['project_id' => $project_id , 'problem_id'=> $problem_id , 'solution_id' => $solution_id];
                            $parameter =  Crypt::encrypt($parameters); 
                        ?>

                <a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
                <a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
                <a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
                <a id="verification" href="{{ route('adult.varification',@$parameter) }}"></a>
                <a id="relationship" href="{{ route('adult.rel',@$parameter) }}"></a>
    <div class="conditionBlock">
        <div class="blockProblem">
            <div class="projectBlock text-center">
                <h2>Problem</h2>
                <div class="projectList text-center">
                <div class="imgWrp">
                                @if($solFunctions -> problem_type == 0)
									@if(strlen($solFunctions -> problem_file) < 15)
                                            <img class="mx-auto" src="{{ asset('assets-new/problem/'.$solFunctions->problem_file)}}"  width="100%" height="128px">
									@endif
                                    @elseif($solFunctions -> problem_type == 1)
                                        <video class="mx-auto" controls="controls" preload="metadata"  width="100%" height="128px" preload="metadata">
                                            <source src="{{ asset('assets-new/problem/' . $solFunctions -> problem_file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solFunctions -> problem_type == 2)
                                            <iframe class="mx-auto" src="{{ $solFunctions -> problem_file }}" width="100%" height="128px"> </iframe>
                                    @endif
                    </div>
                    <p class="redText">{{ $solFunctions->problem_name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->problem_created_at)) }}</p>
                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                </div>
            </div>
        </div>
        <div class="long-arrow">
        <p style="position:relative; top:35px;left:23px;">{{ $solFunctions->first_arr }}</p>
            <!-- add arrow Image over here -->
            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
            <!-- add arrow Image over here -->
          </div>
        <div class="blockProblem">
            <div class="projectBlock text-center">
                <h2>Solution</h2>
                <div class="projectList text-center">
                        <div class="imgWrp">
                            @if($solFunctions -> solution_type == 0)
                                        @if(strlen($solFunctions -> solution_file) < 15)
                                            <img class="mx-auto" src="{{ asset('assets-new/solution/'.$solFunctions->solution_file)}}"  width="100%" height="128px">
                                        @endif
                                    @elseif($solFunctions -> solution_type == 1)
                                        <video class="mx-auto" controls="controls" preload="metadata"  width="100%" height="128px" preload="metadata">
                                            <source src="{{ asset('assets-new/problem/' . $solFunctions -> solution_file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solFunctions -> solution_type == 2)
                                            <iframe class="mx-auto" src="{{ $solFunctions -> solution_file }}"  width="100%" height="128px"> </iframe>
                                    @endif
                        </div>
                    <p class="redText">{{ $solFunctions ->solution_name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->solution_created)) }}</p>
                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                </div>
            </div>
        </div>
        <div class="long-arrow">
        <p style="position:relative; top:35px;left:25px;">{{ $solFunctions->second_arr }}</p>
            <!-- add arrow Image over here -->
            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
            <!-- add arrow Image over here -->
          </div>
        <div class="blockProblem">
            <div class="projectBlock text-center">
                <h2>Solution Function</h2>
                <div class="projectList text-center">
                    <div class="imgWrp">
                        @if($solFunctions -> type == 0)
                                @if(strlen($solFunctions -> file) < 15)
                                    <img class="mx-auto" src="{{ asset('assets-new/solFunction/'.$solFunctions->file)}}"  width="100%" height="128px">
                                @endif
                            @elseif($solFunctions -> type == 1)
                                <video class="mx-auto" controls="controls" preload="metadata"  width="100%" height="128px" preload="metadata">
                                    <source src="{{ asset('assets-new/solFunction/' . $solFunctions -> file) }}#t=0.1" type="video/mp4">
                                </video>
                            @elseif($solFunctions -> file == 2)
                                    <iframe class="mx-auto" src="{{ $solFunctions -> file }}" width="100%" height="128px"> </iframe>
                            @endif
                    </div>
                    <p class="redText">{{ $solFunctions->name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->created_at)) }}</p>
                    @if(!is_null($can_edit) && $can_edit->editable_project)
                    @if(($can_edit->editable_solution_func && Auth::user()->id == $can_edit->shared_with) || (!$can_edit->editable_solution_func && Auth::user()->id == $project->user_id))
                    <ul>
                        <li>
                            <a href="javaScript:Void(0)" class="editSolFunBtn"
                            
                             data-id="{{ $solFunctions->id }}"
                             data-problem="{{ $solFunctions->problem_id }}"
                             data-solution="{{ $solFunctions->solution_id }}"
                             data-file ="{{ $solFunctions->file }}"
                             data-name ="{{ $solFunctions->name }}"
                             data-solution_function_type_id ="{{ $solFunctions->solution_function_type_id }}"
                            >
                                <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt="">
                            </a>
                        </li>
                        <li>
                            <a data-id="{{ $solFunctions->id }}"  class="delSolFunBtn" title="Delete">
                            <img src="{{ asset('/assets-new/images/deleteIcon.png') }}" alt=""></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('/assets-new/images/uploadIcon.png') }}" alt=""></a>
                        </li>
                    </ul>

                        @else
                        <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                        @endif
                @endif
                </div>
            </div>
        </div>
    </div>
   
    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
            dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
            suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
            vulputate velit
        </p>
    </div>
    <div class="row">
        <div class="row-title">
            <h5>Problem and Solution Function Identification</h5>
        </div>
        <div class="row-table">
            <table class="table slp-tbl text-center">
                <thead>
                    <th>Problem</th>
                    <th>Solution</th>
                    <th>Solution Function</th>
                </thead>
                <tbody>
                    <tr>
                        <td style="color: red;">{{ $solFunctions->problem_name}}</td>
                        <td style="color: #00A14C;">{{ $solFunctions->solution_name}}</td>
                        <td style="color: #00A14C;">{{ $solFunctions->name}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row pt-5">
        <h5>Validation Questions</h5>
        <p>Does the solution function enable the replacement of the problem?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio"  value="1" data-id="{{ $solFunctions->id }}" class="form-check-input validation" {{ ($solFunctions->validation_first == '1') ? 'checked' : '' }}
                        name="optradio_firts">Yes, the solution function enables the replacement of the problem
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input validation" value="2" data-id="{{ $solFunctions->id }}" {{ ($solFunctions->validation_first == '2') ? 'checked' : '' }}
                        name="optradio_firts">Yes, the solution function enables the replacement of the problem
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input validation" value="3" data-id="{{ $solFunctions->id }}" {{ ($solFunctions->validation_first == '3') ? 'checked' : '' }}
                        name="optradio_firts">Yes, the solution function enables the substitution of the problem
                </label>
            </div>
            

        </div>
    </div>
    <div class="row">
        <p>Does the solution function enable the solving of the ProblemName?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" value="1" {{ ($solFunctions->validation_second == '1') ? 'checked' : '' }} data-id="{{ $solFunctions->id }}" class="form-check-input validation"
                        name="optradio_second">Yes, the solution function enables the solving of the ProblemName
                </label>
            </div>
        </div>
        <div class=" col-sm-3 mb-3">
            <button type="button" class="btn btn-success" id="saveValidations" onclick='saveValidations()'>Save Validations</button>
        </div>
    </div>

    @else
    
    <div class="row" style="margin-bottom: 10%;">
        <div class="col-md-6 align-middle">
            <button class="btn btn-success" data-toggle="modal" data-target="#updateSolFunctionModal" type="button" id="add-solution-function">+ Identify Solution Function</button>
        </div>
    </div>
    <?php $showMessage =  true; ?>
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
 </script>
@endsection