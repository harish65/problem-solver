@extends('adult.layouts.adult')
@section('title', 'Problem | Adult')

@section('content')
<div class="container">
  <div class="bannerSection">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="bannerLeftSide">
          <h1>Welcome to The Speak Logic</h1>
          <h1><span>Problem Solver</span></h1>
          <h5>Think logically to solve problems </h5>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bannerImg">
          <img src="{{ url('/') }}/assets-new/images/banner-adult-dashboard.png" alt="Banner Image" />
        </div>
      </div>
    </div>
    <div class="row">
      
     
    </div>
  </div>
  <div class="row bannerSection mb-5 d-flex">
    <div class="col">
      <div class="">
        <div class="form-check">
        <label class="form-check-label" for="">Project Name :{{  $data->projectDetails->name }}</label>
        </div>
      </div>
      <div class="">
        <div class="form-check">
        <label class="form-check-label" for="">User Name :{{  $data->shareduser->name }}</label>
        </div>
      </div>
      
    </div>
    <div class="col">
      <div class="form-check">
      
      <div class="form-check form-switch">
        <label class="form-check-label" for="stopcompleteProjectShring">Checked switch checkbox input</label>
        <input class="form-check-input" type="checkbox" role="switch" name="stop_sharing" data-id="{{ $data->id }}" data-user="{{ $data->shared_with }}" data-key='stop_sharing' value="1" {{ ($data->stop_sharing == 1) ? 'checked' : '' }} {{ ($data->stop_sharing == 1) ? 'disabled' : '' }}  id="stopcompleteProjectShring"> 
      </div>
      </div>
    </div>
    <div class="table-responsive">
      @if($data->stop_sharing == 0)
      <table class="table slp-tbl text-center">
        <thead>
            <tr>
                <th>Module Name</th>
                <th>Read</th>
                <th>Write</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
        
            @foreach ($data->toArray() as $key => $value)
                
                @if (!in_array($key, ['id', 'project_id', 'shared_with', 'timestamps', 'wasRecentlyCreated', 'exists', 'preventsLazyLoading', 'incrementing' , 'shareduser','project_details' , 'editable_project','editable_verification']))
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                        <td>
                            <span>
                                {{ ($value == 1) ? 'Write' : 'Read' }}
                            </span>
                        </td>
                        <td>
                            <span class="{{ ($value == 1) ? 'btn btn-success' : 'btn btn-danger' }}">
                                {{ ($value == 1) ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td>
                       
                        <form id='stopsharing'>
                            <div class="form-check form-switch">
                              
                              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"  data-id="{{ $data->id }}" data-user="{{ $data->shared_with }}" data-key='{{$key}}' value="{{ (!is_array($value)) ? $value:0 }}" {{ ($value == 1) ? 'checked' : '' }}>
                            </div>
                        </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
      </table>
      @endif
      </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(":checkbox").change(function() {
  
  $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    var fieldValue = null;
    if ($(this).is(':checked')) {
        fieldValue =  1; // Set value to 1 when checked
        } else {
          fieldValue =  0;  // Set value to 0 when unchecked
        }
    $.ajax({
        url: "{{route('adult.stop-share-project')}}",
        data: { 'id':$(this).data('id') , 'field':$(this).data('key') , 'value':fieldValue ,'shared_with':$(this).data('user')},
        type: 'POST',
        beforeSend: function(){
          $('#shareprojectBtn').attr('disabled',true);
          $('#shareprojectBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        },
        error: function (xhr, status, error) {
            $('#shareprojectBtn').attr('disabled',false);
            $('#shareprojectBtn').html('Submit');
            $.each(xhr.responseJSON.data, function (key, item) {
                toastr.error(item);
            });
        },
        success: function (response){
          console.log(response);
          if(response.success == false)
          {
              $('#shareprojectBtn').attr('disabled',false);
              $('#shareprojectBtn').html('Submit');
              var errors = response.data;
              toastr.error(response.message);
          } else {
              toastr.success(response.message);
              // location.reload();
          }
        }
    });
});


  
</script>
@endsection