@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')

@section('content')
<div class="container">

    <div class="row spl-row">
        <h4>Solution Function Type</h4>
    </div>

    <div class="row spl-row">
        <div class="text-end">
            <button type="button" data-toggle="modal" data-target="#addSolutionTypeModal" class="btn btn-success">Add New Solution Type</button>
        </div>
        <table class="table slp-tbl" id="myTable">
        
            <thead>
                <tr>
                  
                    <th>Name</th>
                    <th>Creator Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if($solutionTypes)
                    @foreach ($solutionTypes  as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ Auth::user()->name }} </td>

                        <td>
                            <a href="javaScript:Void(0)"  data-href="{{ route('problem.delete') }}"  data-id="{{ $type-> id }}" class="delProblemBtn" title="Delete" ><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" width="15" height="20"></a>
                            &nbsp;
                            <a href="javaScript:Void(0)"  class="editProblemBtn"  
                                                                            data-id="{{ $type->id }}" 
                                                                            data-name="{{ $type->name }}"                                                                            
                                                                            title="Edit"><img src="{{ url('/') }}/assets-new/images/editIcon.png" width="15" height="20"></a>
                        </td>
                    </tr>
                    
                @endforeach
                @else
                    <tr>
                        <td>No record found</td>
                        <td>No record found</td>
                        <td>No record found</td>
                        <td>No record found</td>
                    </tr>
              @endif
            </tbody>
            
        </table>
    </div>
</div>
@include('adult.solutionFuntionTypes.modal.add-sol-fun-type')
@endsection
@section('css')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('assets-new/js/dataTables.buttons.min.js')}}"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fa fa-plus"></i>Add new verification type',
                className : 'btn btn-success',
                attr:  {
                        title: 'Add VerificationType',
                        id: 'add-verification-model',
                        
                }
            }
        ]
    });
});

$(document).on('click','#add-verification-model',function(){
    $('#addVerificationTypeModal').modal('toggle')
})
</script>
<script>
    $(document).on('click','#btnSave',function(e){
		e.preventDefault();
		var fd = new FormData($('#addSolutionTypeModal')[0]);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
		$.ajax({
			url: "{{ route('adult.sftstore')}}",
			data: fd,
			processData: false,
			contentType: false,
			dataType: 'json',
			type: 'POST',
			beforeSend: function(){
                $('#btnSave').attr('disabled',true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
			},
			error: function (xhr, status, error) {
                $('#btnSave').attr('disabled',false);
                $('#btnSave').html('Save');
				$.each(xhr.responseJSON.data, function (key, item) {
					toastr.error(item);
				});
			},
			success: function (response){
                if(response.success == false)
                {
					$('#btnSave').attr('disabled',false);
					$('#btnSave').html('Save');
                    var errors = response.data;
                    $.each( errors, function( key, value ) {
						toastr.error(value)
					});
					} else { 
                    toastr.success(response.message);
                    window.location.href = "{{route('adult.sftindex')}}";
				}
			}
		});
	});

    $(document).on('click','.editProblemBtn' , function(){
        var $this = $(this);
        $('#id').val($this.attr('data-id'))
        $('#solutionTypeName').val($this.attr('data-name'))
        $('#addSolutionTypeModal').modal('toggle')
    })
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
                url: "{{route('adult.sftdelete')}}",
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
                        toastr.success('Verification type deleted successfully!');
                        window.location.href = "{{route('adult.sftindex')}}";
                    }
                }
            });
      });
</script>
@endsection