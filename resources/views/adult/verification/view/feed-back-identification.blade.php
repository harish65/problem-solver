@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')
@php
$can_edit = \App\Models\Project::SharedProject($project_id, Auth::user()->id);
@endphp

<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center title-min-h ">
                        <h2>FeedBack Identification</h2>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>  
    
    <?php  $parameter =  Crypt::encrypt($params);  ?>
    <div class="relationshipContent">
            <div class="container">
                <div class="row ">
                    <div class="col-sm-4">
                    @if(!is_null($can_edit) && $project->shared == 1 && $project->user_id != Auth::user()->id)
                        <button class="btn btn-success" id="feed-back" >+ Identify Feedback</button>
                       @endif 
                    </div>  
                    <div class="col-sm-8 ">
                        <?php
                            $parameter =  Crypt::decrypt($params);
                        ?>
                        <a href="{{ route('adult.varification' ,  [Crypt::encrypt($parameter) , 16])}}" class="btn btn-success float-end">Back</a>
                    </div>                    
                </div>

                <div class="row mt-3">
                    <table class="table slp-tbl text-center">
                        <thead>
                            <th>Actual Error</th>
                            <th>Actual Feedback</th>
                            <th>Feedback Date</th>
                            <th>From Person</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if($feedBack)
                                    @foreach($feedBack as $data)
                                    <tr>
                                        <td>{{ $data->error_name }}</td>
                                        <td>{{ $data->feedback }}</td>
                                        <td>{{ date('d/m/Y' , strtotime($data->feedback_date)) }} </td>
                                        <td>{{ $data->from_person }}</td>
                                        <td>
                                        
                                                <a href="javaScript:void(0)" data-id ="{{ $data->id }}"  data-error_id="{{$data->error_id}}" data-feedback_date="{{date('d-m-Y' , strtotime($data->feedback_date))}}" data-date="{{$data->feedback_date}}"  data-feedback="{{$data->feedback}}" data-from_person="{{$data->from_person}}"  data-error_name="{{ $data->error_name}}"class="btn btn-success editBtn"><i class="fa fa-pencil"></i></a>
                                                <a href="javaScript:void(0)" data-id ="{{ $data->id }}"  class="btn btn-danger delete-btn"><i class="fa fa-trash"></i></a>
                                                
                                        </td>
                                    </tr>
                                    @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>

<!-- Modal Start -->
    
<div class="modal fade" id="feedback_identification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Feedback Identification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="feedback-identification-form" >
          <input type="hidden"  name="id" id="f_id">
          <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
            <input type="hidden" name="project_id" value="{{ $project_id }}">
            
            <div class="form-group">
                <label for="compensator">Select Error</label>
                <select class="form-control" name="error" id="error_name">
                    <option value="">Please Select ...</option>
                        @foreach($problemDevelopment as $error)
                            <option value="{{ $error->id }}" data-date="{{ $error->error_date }}">{{ $error->error_name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="feedback">Feedback</label>
                <input type="text" class="form-control" name="feedback" id="feedback" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="text" class="form-control" name="date" id="date" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="from-person">From Person</label>
                <input type="text" class="form-control" name="from-person" id="from-person" autocomplete="off">
            </div>
            
          </form>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="btnSave">Save</button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal End -->
@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
.title-min-h{
    relationshipContent: 300px;
}
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>

$(document).on('click' , '#btnSave', function(e){
    e.preventDefault();
    var dv = new FormData($('#feedback-identification-form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       $.ajax({
            type: 'POST',
            url: "{{route('adult.store-feedback-identification')}}",
            data:dv,            
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function(){
                $('#btnSave').attr('disabled',true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSave').attr('disabled',false);
                $('#btnSave').html('Save changes');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
                if(response.success == false)
                {
                    $('#btnSave').attr('disabled',false);
                    $('#btnSave').html('Save changes');
                    var errors = response.data;
                    $.each( errors, function( key, value ) {
                        toastr.error(value)
                    });
                } else {
                    toastr.success(response.message);
                    location.reload();
                }
            }
        });

   });
   
   $('.editBtn').on('click',function(){
    
        $('#f_id').val($(this).data('id'))
        $('#error_name').val($(this).data('error_id'))
        $('#feedback').val($(this).data('feedback'))        
        $('#from-person').val($(this).data('from_person'))
        $('#date').val($(this).data('feedback_date')).attr('disabled',false)
        var date_selected = $('#error_name option:selected').data('date')

        $('#date').datepicker({
            minDate: new Date(date_selected),
            maxDate:0
        })
        $('#feedback_identification_modal').modal('toggle')
        return;
   })

   $('.delete-btn').on('click',function(e){
    e.preventDefault();
    if (!confirm('Are you sure you want to delete this?')) {
        return false;
    }
    var id = $(this).data('id')
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       var route  =  "{{route('adult.delete-feedback-identification' , ':id')}}"
       route = route.replace(':id', id);
       $.ajax({
            type: 'POST',
            url: route,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function(){
                $('#btnSave').attr('disabled',true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSave').attr('disabled',false);
                $('#btnSave').html('Save changes');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
                if(response.success == false)
                {
                    $('#btnSave').attr('disabled',false);
                    $('#btnSave').html('Save changes');
                    var errors = response.data;
                    $.each( errors, function( key, value ) {
                        toastr.error(value)
                    });
                } else {
                    
                    toastr.success(response.message);
                    location.reload();
                }
            }
        });
   })
   $('#feed-back').click(function(){
    $('#feedback-identification-form')[0].reset();  
    $('#feedback_identification_modal').modal('toggle')
})
$('#date').attr('disabled' , true)

var option = null;
$('#error_name').on('change',function(){
    option = $('option:selected', this).data('date');
    $('#date').datepicker({
            minDate:new Date(option),
            maxDate: 0
    });
    $('#date').attr('disabled' , false)
})



</script>

@endsection


