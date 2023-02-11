@extends('admin.layouts.master')
@section('title', 'Solution Manage | Admin')

@section('content')
<div class="container">

    <div class="row spl-row">
        <h4>Solution Manage</h4>
    </div>

    <div class="row spl-row">
        <table class="table slp-tbl" id="myTable">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Name</th>
                    <th>Problem</th>
                    <th>Solution Type</th>
                    <th>Creator</th>
                    <th>Opertaion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solutions as $solution)
                <tr>
                    <td>
                    @if($solution -> type == 0)
									@if(strlen($solution -> file) < 15)
										<img src="{{ asset("assets-new/solution/" . $solution -> file) }}" width="420" height="315">
									@endif
                        @elseif($solution -> type == 1)
									<video controls="controls" preload="metadata" width="420" height="315" preload="metadata">
										<source src="{{ asset("assets-new/solution/" . $solution -> file) }}#t=0.1" type="video/mp4">
									</video>
								@elseif($solution -> type == 2)
                                <iframe width="420" height="315" src="https://www.youtube.com/watch?v=Vhn2RkoWTgw" frameborder="0" allowfullscreen></iframe>

								@endif
                    </td>
                    <td>{{ $solution->solution }}</td>
                    <td>{{ $solution->problem }}</td>
                    <td>{{ $solution->solution_type }}</td>
                    <td>{{ $solution->creator }}</td>
                    <td>
                        <a href="javaScript:Void(0)" class="delSolBtn"  data-solution="{{ $solution->solutions_id }}" title="Delete" ><img src="{{ url('/')}}/assets-new/images/deleteIcon.png" width="15" height="20"></a>
                        &nbsp;
                        <a href="javaScript:Void(0)" class="edit" data-solution="{{ $solution->solutions_id }}" 
                                                                data-name="{{ $solution->solution }}" 
                                                                data-problem ="{{ $solution -> problem_id }}" 
                                                                data-type ="{{ $solution -> type }}" 
                                                                data-sol-type ="{{ $solution -> solution_type_id }}" 
                                                                data-file="{{ $solution -> file }}"                                                                
                                                                title="Edit"><img src="{{ url('/') }}/assets-new/images/editIcon.png" width="15" height="20"></a>
                    </td>
                </tr>
                
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.solution.modal.update-solution')
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    
</style>
@endsection
@section('scripts')

<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

<script>
     $(document).on('click','#updateSolution',function(e){
        e.preventDefault();
        var fd = new FormData($('#updateSolutionModal')[0]);
        $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        
        $.ajax({
            url: "{{route('solution.update')}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function(){
              $('#updateSolution').attr('disabled',true);
              $('#updateSolution').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#updateSolution').attr('disabled',false);
                $('#updateSolution').html('Submit');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
              if(response.success == false)
              {
                  $('#updateSolution').attr('disabled',false);
                  $('#updateSolution').html('Login');
                  var errors = response.data;
                  $.each( errors, function( key, value ) {
                      toastr.error(value)
                  });
              } else {
                  toastr.success('Problem updated successfully!');
                  window.location.href = "{{route('solution.index')}}";
              }
            }
        });
    });
</script>
<script>
$('.edit').on('click',function(){
    var solution   = $(this).attr('data-solution');
    if(solution !=''){
        
            $('#updateSolutionModal #updateSolutionId').val(solution);
            $('#updateSolutionProblemId').val($(this).attr('data-problem'));
            $('#updateSolutionName').val($(this).attr('data-name'));
           $('#updateSolutionTypeId').val($(this).attr('data-sol-type'))
            if($(this).attr('data-type') == 0){
                $('#updateSolutionFileRadio').attr('checked', 'checked');
                $("#updateSolutionType").val("0");
                $("#updateSolutionFileType").css("display", "block");
                $("#updateSolutionLinkType").css("display", "none");
                if($(this).file != ""){                    
                        var file = $(this).data("file");
                        var drEvent = $('#updateSolutionFileFile').dropify(
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
                    
                }else{
                    $('#updateSolutionLinkRadio').attr('checked', 'checked');
                    $('#updateSolutionLinkFile').val($(this).attr('data-file'))
                    $("#updateSolutionType").val("2");                
                    $("#updateSolutionFileType").css("display", "none");
                    $("#updateSolutionLinkType").css("display", "block");
                }
                $('#updateSolutionModal').modal('toggle');
        }else{
        toastr.error('Something is wrong!')
    }

})

    $(".updateSolutionType").change(function(){
            var type = $(this).val();

            if(type == 0){
                $("#updateSolutionType").val("0");
                $("#updateSolutionFileType").css("display", "block");
                $("#updateSolutionLinkType").css("display", "none");
            }else if(type == 2){
                $("#updateSolutionType").val("2");
                
                $("#updateSolutionFileType").css("display", "none");
                $("#updateSolutionLinkType").css("display", "block");
            }
        });
        $('.dropify').dropify();


        $(document).ready( function () {
            $('#myTable').DataTable({
                "bLengthChange" : false, //thought this line could hide the LengthMenu
                "bInfo":false,    
                    language: {
                    paginate: {
                    next: '>',
                    previous: '<'  
                    }
                }
            });
        });
</script>
<script>
    $('#myTable').on('click', '.delSolBtn', function(e){
          e.preventDefault();
          var r = confirm("Are you sure to delete");
          if (r == false) {
              return false;
          }
          var id = $(this).attr('data-solution')
          $.ajaxSetup({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });      
          $.ajax({
                url: "{{route('solution.delete')}}",
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
                        toastr.success('Solution deleted successfully!');
                        window.location.href = "{{route('solution.index')}}";
                    }
                }
            });
      });
</script>
@endsection