@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
<div class="container">
    <div class="row spl-row">
        <h4>Solution Fuction</h4>
    </div>
    <div class="row spl-row-second">
        <h4>TITLE FOR EXPLANTION</h4>
    </div>
    <div class="row banner">
        <img src="{{ asset('/assets-new/images/solution-function-banner.png') }}" width="666px" height="250px">
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
    <div class="row">
        <div class="col-md-4">
            <div class="projectBlock text-center">
                <h2>Problem</h2>
                <div class="projectList text-center">
                    @if($solFunctions -> problem_type == 0)
									@if(strlen($solFunctions -> problem_file) < 15)
                                            <img class="mx-auto" src="{{ asset('assets-new/problem/'.$solFunctions->problem_file)}}" width="300" height="320">
									@endif
                                    @elseif($solFunctions -> problem_type == 1)
                                        <video class="mx-auto" controls="controls" preload="metadata" width="300" height="320" preload="metadata">
                                            <source src="{{ asset("assets-new/problem/" . $solFunctions -> problem_file) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @elseif($solFunctions -> problem_type == 2)
                                            <iframe class="mx-auto" src="{{ $solFunctions -> problem_file }}"width="300" height="320"> </iframe>
                                    @endif
                    
                    <p class="redText">{{ $solFunctions->problem_name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->problem_created_at)) }}</p>
                    <!-- <ul>
                        <li>
                            <a href="javaScript:Void(0)" class="editProblemBtn" data-id="9" data-name="Roof problem"
                                data-type="0" data-file="1677330282.png" data-cat="3">
                                <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt="">
                            </a>
                        </li>
                        <li><a data-id="9" class="delProblemBtn" title="Delete"><img
                                    src="{{ asset('/assets-new/images/deleteIcon.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('/assets-new/images/uploadIcon.png') }}" alt=""></a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="projectBlock text-center">
                <h2>Solution</h2>
                <div class="projectList text-center">
                    @if($solFunctions -> solution_type == 0)
                                    @if(strlen($solFunctions -> solution_file) < 15)
                                        <img class="mx-auto" src="{{ asset('assets-new/solution/'.$solFunctions->solution_file)}}" width="300" height="320">
                                    @endif
                                @elseif($solFunctions -> solution_type == 1)
                                    <video class="mx-auto" controls="controls" preload="metadata" width="300" height="320" preload="metadata">
                                        <source src="{{ asset("assets-new/problem/" . $solFunctions -> solution_file) }}#t=0.1" type="video/mp4">
                                    </video>
                                @elseif($solFunctions -> solution_type == 2)
                                        <iframe class="mx-auto" src="{{ $solFunctions -> solution_file }}"width="300" height="320"> </iframe>
                                @endif
                    <p class="redText">{{ $solFunctions ->solution_name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->solution_created)) }}</p>
                    <!-- <ul>
                        <li>
                            <a href="javaScript:Void(0)" class="editProblemBtn" data-id="9" data-name="Roof problem"
                                data-type="0" data-file="1677330282.png" data-cat="3">
                                <img src="{{ asset('/assets-new/images/editIcon.png')}}" alt="">
                            </a>
                        </li>
                        <li><a data-id="9" class="delProblemBtn" title="Delete"><img src="{{ asset('/assets-new/images/deleteIcon.png') }}" alt=""></a></li>
                        <li><a href="#"><img src="{{ asset('/assets-new/images/uploadIcon.png') }}" alt=""></a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="projectBlock text-center">
                <h2>Solution Function</h2>
                <div class="projectList text-center">
                    @if($solFunctions -> type == 0)
                                    @if(strlen($solFunctions -> file) < 15)
                                        <img class="mx-auto" src="{{ asset('assets-new/solFunction/'.$solFunctions->file)}}" width="300" height="320">
                                    @endif
                                @elseif($solFunctions -> type == 1)
                                    <video class="mx-auto" controls="controls" preload="metadata" width="300" height="320" preload="metadata">
                                        <source src="{{ asset("assets-new/solFunction/" . $solFunctions -> file) }}#t=0.1" type="video/mp4">
                                    </video>
                                @elseif($solFunctions -> file == 2)
                                        <iframe class="mx-auto" src="{{ $solFunctions -> file }}"width="300" height="320"> </iframe>
                                @endif
                    <p class="redText">{{ $solFunctions->name }}</p>
                </div>
                <div class="projectList">
                    <p class="date">{{ date('d/m/Y' , strtotime($solFunctions->created_at)) }}</p>
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

    <div class="row pt-5">
        <h5>Validation Questions</h5>
        <p>Does the solution function enable the replacement of the problem?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" value="0" data-id="#" class="form-check-input validation"
                        name="optradio_firts">Yes, the solution function enables the replacement of the problem
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input validation" value="1" data-id="#"
                        name="optradio_firts">Yes, the solution function enables the replacement of the problem
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input validation" value="1" data-id="#"
                        name="optradio_firts">Yes, the solution function enables the substitution of the problem
                </label>
            </div>
            

        </div>
    </div>
    <div class="row pt-5">
        <p>Does the solution function enable the solving of the ProblemName?</p>
        <div class="form-group pl-5 pb-5">
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" value="0" data-id="#" class="form-check-input validation"
                        name="optradio_firts">Yes, the solution function enables the solving of the ProblemName
                </label>
            </div>
        </div>
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
    @else
    <div class="row" style="margin-bottom: 10%;">
        <div class="col-md-6 align-middle">
            <button class="btn btn-success" data-toggle="modal" data-target="#updateSolFunctionModal" type="button" id="add-solution-function">Add Solution Function</button>
        </div>
    </div>
    @endif
    
</div>
@include('adult.solFunction.modal.add-sol-func')
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>


$(".dropify").dropify();

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
        if($(this).val() == 'update'){
             urlSolfunction = "{{route('adult.update-solution-func')}}" 
        }else{
            urlSolfunction = "{{route('adult.store-solution-func')}}" 
        }
       
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
 </script>
@endsection