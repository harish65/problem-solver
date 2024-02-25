@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')

<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center title-min-h ">
                        <h2>Feed Back Identification</h2>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>  
    
    
    <div class="relationshipContent">
            <div class="container">
                <div class="row ">
                    <div class="col-sm-4">
                        <button class="btn btn-success" id="feed-back" data-toggle="modal" data-target="#exampleModal">+ Identify Feedback</button>
                    </div>  
                    <div class="col-sm-8 ">
                        <a href="{{ URL::previous() }}" class="btn btn-success float-end">Back</a>
                    </div>                    
                </div>

                <div class="row mt-3">
                    <table class="table slp-tbl text-center">
                        <thead>
                            <th>Actual Error</th>
                            <th>Actual Feedback</th>
                            <th>Feedback Date</th>
                            <th>From Person</th>
                        </thead>
                        <tbody>
                            @if($feedBack)
                                    @foreach($feedBack as $data)
                                    <tr>
                                        <td>{{ $data->error_name }}</td>
                                        <td>{{ $data->feedback }}</td>
                                        <td>{{ date('d/m/Y' , strtotime($data->feedback_date)) }} </td>
                                        <td>{{ $data->user_id }}</td>
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
    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="form-group">
                <label for="compensator">Select Error</label>
                <select class="form-control" name="error">
                    <option value="">Please Select ...</option>
                        @foreach($problemDevelopment as $error)
                            <option value="{{ $error->id }}">{{ $error->error_name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="feedback">Feedback</label>
                <input type="text" class="form-control" name="feedback" id="feedback">
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" name="date" id="date">
            </div>
            <div class="form-group">
                <label for="from-person">From Person</label>
                <input type="text" class="form-control" name="from-person" id="from-person">
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

<style>
.title-min-h{
    relationshipContent: 300px;
}
</style>
@endsection

@section('scripts')
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
</script>

@endsection


