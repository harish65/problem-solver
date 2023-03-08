@extends('adult.layouts.adult')
@section('title', 'Adult | Verification')

@section('content')
<div class="container">

    <div class="row spl-row">
        <h4>Verification Type</h4>
    </div>

    <div class="row spl-row">
        <div class="modal-btn">
            <button type="button" data-toggle="modal" data-target="#addVerificationTypeModal" class="btn btn-success">Add New Verification Type</button>
        </div>
        <table class="table slp-tbl" id="myTable">
        
            <thead>
                <tr>
                  
                    <th>Name</th>
                    <th>Creator Name</th>
                    <th>1st Field</th>
                    <th>2st Field</th>
                    <th>3rd Field</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if($types)
                    @foreach ($types  as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ Auth::user()->name }} </td>
                        <td>{{ ($type->first_field != '') ? $type->first_field : 'NA' }}</td>
                        <td>{{ ($type->second_field != '') ? $type->second_field : 'NA' }}</td>
                        <td>{{ ($type->third_field != '') ? $type->third_field : 'NA' }}</td>
                        
                        <td>
                            <a href="javaScript:Void(0)"  data-href="{{ route('problem.delete') }}"  data-id="{{ $type-> id }}" class="delProblemBtn" title="Delete" ><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" width="15" height="20"></a>
                            &nbsp;
                            <a href="javaScript:Void(0)"  class="editProblemBtn"  
                                                                            data-id="{{ $type->id }}" 
                                                                            data-name="{{ $type->name }}"
                                                                            data-firts_field ="{{ $type->first_field }}"
                                                                            data-second_field ="{{ $type->second_field }}"
                                                                            data-third_field ="{{ $type->third_field }}"
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
@include('adult.verificationType.modal.add-verification-type')
@endsection
@section('css')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    #myTable_filter{
        text-align:end;
    }

    .modal-btn{
        position: relative;
        top: 33px;
    }
    #myTable_paginate{
        border:none;
        text-align:end;
    }
</style>
@endsection
@section('scripts')
<script src="{{ asset('assets-new/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets-new/js/dataTables.buttons.min.js')}}"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        // buttons: [
        //     {
        //         text: '<i class="fa fa-plus"></i>Add new verification type',
        //         className : 'btn btn-success',
        //         attr:  {
        //                 title: 'Add VerificationType',
        //                 id: 'add-verification-model',
                       
                        
        //         }
        //     }
        // ]
    });
});

$(document).on('click','#add-verification-model',function(){
    $('#addVerificationTypeModal').modal('toggle')
})
</script>
<script>
    $(document).on('click','#btnSave',function(e){
		e.preventDefault();
		var fd = new FormData($('#addVerificationTypeModal')[0]);
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
		$.ajax({
			url: "{{ route('adult.vfrstore')}}",
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
                    window.location.href = "{{route('adult.vfrindex')}}";
				}
			}
		});
	});

    $(document).on('click','.editProblemBtn' , function(){
        var $this = $(this);
        $('#id').val($this.attr('data-id'))
        $('#updateVerificationTypeName').val($this.attr('data-name'))
        $('#first_field').val($this.attr('data-firts_field'))
        $('#second_field').val($this.attr('data-second_field'))
        $('#third_field').val($this.attr('data-third_field'))
        $('#addVerificationTypeModal').modal('toggle')
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
                url: "{{route('adult.vfrdelete')}}",
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
                        window.location.href = "{{route('adult.vfrindex')}}";
                    }
                }
            });
      });

</script>

<script>
   $(document).ready(function() {
    $("body").on("click","#question",function(){ 
        var html = '';
        html = $(".after-add-more").first().clone();
        //   $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
        $(".after-add-more").last().after(html);
       
    });

    $("body").on("click",".remove",function(){ 
        $(this).parents(".after-add-more").remove();
    });
});
</script>
@endsection