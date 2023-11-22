@extends('adult.layouts.adult')
@section('title', 'Adult | Users')   
 
@section('content')

<div class="container">
<div class="row spl-row">
        <h4>Users</h4>
    </div>
    <div class="row spl-row">
        <div class="modal-btn">
            <a type="button" href="#" class="btn btn-success float-right mb-3"  data-toggle="modal" data-target="#exampleModal">+ Add New User</a>
        </div>
        <table class="table slp-tbl" id="myTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($users))
                    @foreach ($users  as $user)
                    <tr>
                        <td>{{ ucfirst($user->name) }}</td>  
                        <td>{{ ucfirst($user->type) }}</td>                                    
                        <td><img  src="{{ asset('assets-new/users/'.$user->file) }}" width="50" height="50" /> </td>     
                        <td>
                            <a href="javaScript:Void(0)"  data-href="{{ route('problem.delete') }}" class="delProblemBtn" title="Delete" ><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" width="15" height="20"></a>
                            &nbsp;
                            <a href="javaScript:Void(0)"  class="editProblemBtn"
                                                                                    data-id = {{ $user->id }}
                                                                                    data-name = {{ $user->name }}
                                                                                    data-type = {{ $user->type }}
                                                                                    data-file = {{ $user->file }}><img src="{{ url('/') }}/assets-new/images/editIcon.png" width="15" height="20"></a>
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

<!-- Modal start -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUsers">
      <div class="modal-body">
        <div class="form-group" id="userPic">
            <label for="exampleInputEmail1">Upload Image</label>
            <input type="file" name="file" data-height="150" id="file" class="dropify" accept="image/*, video/*">
            <input type="hidden" id="user_id" name="id" value="">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name"  class="form-control"  id="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="">Choose User Type</option>
                <option value="customer">Customer</option>
                <option value="adult">Adult</option>
                <option value="child">Child</option>
            </select>
        </div>
        
       
        </form>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveBtn">Save</button>
      </div>
    </div>
    </div>
  </div>
</div>
<!-- Modal End -->



@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style></style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>    
    $('.dropify').dropify();
    $(document).on('click','#saveBtn',function(e){
       e.preventDefault();
       var fd = new FormData($('#formUsers')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.create-user')}}",
           data: fd,
           processData: false,
           contentType: false,
           dataType: 'json',
           type: 'POST',
           beforeSend: function(){
             $('#saveBtn').attr('disabled',true);
             $('#saveBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
           },
           error: function (xhr, status, error) {
               $('#saveBtn').attr('disabled',false);
               $('#saveBtn').html('Submit');
               $.each(xhr.responseJSON.data, function (key, item) {
                   toastr.error(item);
               });
           },
           success: function (response){
             if(response.success == false)
             {
                $('#saveBtn').attr('disabled',false);
                $('#saveBtn').html('Login');
                var errors = response.data;
                $.each( errors, function( key, value ) {
                     toastr.error(value)
                });
             } else {
                toastr.success(response.message);
                window.location.reload();
              }
           }
       });
   });
</script>
<script>
    $('.editProblemBtn').click(function(){
        $('#name').val($(this).attr('data-name'))    
        if($(this).file != ""){
            var file = $(this).data("file");
            var drEvent = $('#file').dropify({
                defaultFile: "/assets-new/users/" + file
            });
            drEvent = drEvent.data('dropify');
               drEvent.resetPreview();
               drEvent.clearElement();
               drEvent.settings.defaultFile = "/assets-new/users/" + file;
               drEvent.destroy();
               drEvent.init();	
           }
           $('#type').val($(this).attr('data-type'))       
           $('#user_id').val($(this).attr('data-id'))       
       
        $('#exampleModal').modal('toggle')
    })
</script>
@endsection
