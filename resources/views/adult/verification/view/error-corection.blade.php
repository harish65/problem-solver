@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')

<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                <div class="col-sm-4">
                    <div class="d-flex align-items-center title-min-h ">
                        <h2>Error Correctionn</h2>
                        
                    </div>
                        
                </div>
                 <div class="col-sm-8 ">
                        <a href="{{ URL::previous() }}" class="btn btn-success float-end">Back</a>
                    </div>  
                <div class="principleRelation">
                    <div class="conditionBlock problem-development">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Error</h2>
                                <div class="projectList text-center">
                                    @foreach($errorcorrections as $data)
                                    <button class="btn btn-danger  mt-3">
                                        {{$data->error_name}}
                                    </button>
                                    @endforeach
                                </div>
                              
                            </div>
                        </div>
                       
                        <div class="long-arrow">
                            <!-- <p style="position:relative; top:35px;left:23px;">is replaced by</p> -->
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                        </div>
                        
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Compensator</h2>
                                <div class="projectList text-center">
                                    @foreach($errorcorrections as $data)
                                    <button class="btn btn-success mt-3 compensator">
                                        {{($data->compensator == null) ? 'No Compensator' : $data->compensator }}
                                    </button>
                                    

                                    @endforeach
                                </div>
                               
                            </div>
                        </div>
                        <div class="long-arrow">
                            <!-- <p style="position:relative; top:35px;left:23px;">is replaced by</p> -->
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Feedback</h2>
                                <div class="projectList text-center">
                                    @foreach($errorcorrections as $data)
                                    <button class="btn btn-success mt-3 compensator">
                                        {{($data->feedback_applied == 0) ? 'Yes' : 'No' }}
                                    </button>
                                    

                                    @endforeach
                                </div>
                               
                            </div>
                        </div>
                       
                        
                    </div>
                    
            </div>
            </div>
        </div>
    </div>  
   
    
    <div class="relationshipContent">
            <div class="container">
                <div class="row ">
                    <div class="col-sm-4">
                        <button class="btn btn-success" id="feed-back" data-toggle="modal" data-target="#exampleModal">+ Error Correction</button>
                    </div>                    
                </div>

                <div class="row mt-3">
                    <table class="table slp-tbl text-center">
                        <thead>
                            <th>Error Identify</th>
                            <th>Compensator substituted</th>
                            <th>Feedback given (yes/no)</th>
                            <th>Feedback Applied (yes/no)</th>
                        </thead>
                        <tbody>
                                @foreach($errorcorrections as $errorcorrection)
                                <tr>
                                    <td>{{ $errorcorrection->error_name }}</td>
                                    <td>{{ $errorcorrection->compensator }}</td>
                                    <td>{{($errorcorrection->feedback_applied == 0) ? 'Yes' : 'No' }}</td>
                                    <td>{{($errorcorrection->feedback_applied == 0) ? 'Yes' : 'No' }}</td>
                                </tr>
                                @endforeach
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
          <h5 class="modal-title" id="exampleModalLabel">Error correction</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="error-correction-form" >
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
                <select class="form-control" name="compensator">
                    <option value="">Please Select ...</option>
                        @foreach($compensator as $data)
                            <option value="{{ $data->id }}">{{ $data->compensator }}</option>
                        @endforeach
                </select>
                
            </div>
            <div class="form-group">
                <label for="date">Feedback </label>
                <select class="form-control" name="feedback">
                    <option value="">Please Select ...</option>
                        @foreach($feedBack as $feed)
                            <option value="{{ $feed->id }}">{{ $feed->feedback }}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="from-person">From Person</label>
                <select class="form-control" name="feedback_applied">
                    <option value="0">Yes</option>
                    <option value="1">No</option>     
                </select>
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


@section('scripts')
<script>

$(document).on('click' , '#btnSave', function(e){
    e.preventDefault();
    var dv = new FormData($('#error-correction-form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       $.ajax({
            type: 'POST',
            url: "{{route('adult.store-error-correction')}}",
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