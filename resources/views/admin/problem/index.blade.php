@extends('admin.layouts.master')
@section('title', 'Manage Problem | Admin')

@section('content')
<div class="container">

    <div class="row spl-row">
        <h4>Manage Problem</h4>
    </div>

    <div class="row spl-row">
        <table class="table slp-tbl" id="myTable">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Creator</th>
                    <th>Opertaion</th>
                </tr>
            </thead>
            <tbody>
               
                    @foreach ($problems  as $problem)
                    <tr>
                        <td>
                        @if($problem -> type == 0)
									@if(strlen($problem -> file) < 15)
										<img src="{{ asset("assets-new/problem/" . $problem -> file) }}" width="420" height="315">
									@endif
								@elseif($problem -> type == 1)
									<video controls="controls" preload="metadata" width="420" height="315" preload="metadata">
										<source src="{{ asset("assets-new/problem/" . $problem -> file) }}#t=0.1" type="video/mp4">
									</video>
								@elseif($problem -> type == 2)
									    <iframe src="{{ $problem -> file }}" width="420" height="315"> </iframe>
								@endif
                            
                        </td>
                        <td>{{ $problem->name }}</td>
                        <td>{{ $problem->problem_categories_name }}</td>
                        <td>{{ __('Admin')}}</td>
                        <td>
                            <a href="javaScript:Void(0)"  data-href="{{ route('problem.delete') }}"  data-id="{{ $problem -> id }}" class="delProblemBtn" title="Delete" ><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" width="15" height="20"></a>
                            &nbsp;
                            <a href="javaScript:Void(0)" class="editProblemBtn"  data-id="{{ $problem -> id }}"
                                                                                    data-type="{{ $problem -> type }}"
                                                                                    data-file="{{ $problem -> file }}"
                                                                                    data-cat="{{ $problem -> problem_categories_id }}"
                            data-name="{{ $problem -> name }}"  title="Delete"><img src="{{ url('/') }}/assets-new/images/editIcon.png" width="15" height="20"></a>
                        </td>
                    </tr>
                    
                @endforeach
              
            </tbody>
        </table>
    </div>
</div>

@include('admin.problem.modal.update-problem',[$cat])
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('scripts')

<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>
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

        $("#updateProblemModal").modal("show");
    });

    
</script>

<script>
     $(document).on('click','#btnUpadteProblem',function(e){
        e.preventDefault();
        var fd = new FormData($('#updateProlemForm')[0]);
        $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        
        $.ajax({
            url: "{{route('problem.update')}}",
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
                  toastr.success('Problem updated successfully!');
                  window.location.href = "{{route('problem.index')}}";
              }
            }
        });
    });
</script>
<script>    
    $('#myTable').on('click', '.delProblemBtn', function(e){
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
                url: "{{route('problem.delete')}}",
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
                        toastr.success('Problem deleted successfully!');
                        window.location.href = "{{route('problem.index')}}";
                    }
                }
            });
      });
</script>
@endsection