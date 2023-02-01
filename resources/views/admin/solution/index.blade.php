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
                    <td><img src="{{ url('/')}}/assets-new/images/Frame 20.png" width="241"  height="152"></td>
                    <td>{{ $solution->solution }}</td>
                    <td>{{ $solution->problem }}</td>
                    <td>{{ $solution->solution_type }}</td>
                    <td>{{ $solution->creator }}</td>
                    <td>
                        <a href="javaScript:Void(0)"  title="Delete" ><img src="{{ url('/')}}/assets-new/images/deleteIcon.png" width="15" height="20"></a>
                        &nbsp;
                        <a href="javaScript:Void(0)" data-toggle="modal" data-target="#updateSolutionModal" title="Delete"><img src="http://127.0.0.1:8000/assets-new/images/editIcon.png" width="15" height="20"></a>
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
            url: "{{route('adminSolution.update')}}",
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
                  window.location.href = "{{route('adminSolution.index')}}";
              }
            }
        });
    });
</script>
<script>
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

@endsection