@extends('admin.layouts.master')
@section('title', 'User Manage | Admin')

@section('content')



<div class="container">

    <div class="row spl-row">
        <h4>User Manage</h4>
    </div>

    <div class="row spl-row">
        <table class="table slp-tbl borderless text-center" id="myTable">
            <thead >
                <tr class="text-center">
                    <th>File</th>
                    <th>Name</th>
                    <th>Problem</th>
                    <th>Solution</th>
                    <th>Creator</th>
                    <th>Opertaion</th>
                </tr>
            </thead>           
            <tbody>
                 @forelse ($users as $user)
                            <tr>
                               <td><img src="{{ asset('/assets-new/problem/1675559201.jpg') }}" width="241"  height="152"></td>
                               <td>Project 1</td>
                               <td style="color:red">Dirty Oil</td>
                               <td style="color:#00A14C">New Oil</td>
                               <td>New Oil</td>
                                <td>
                                        <a href="#" class="editUser"  title="Delete" ><img src="{{url('/')}}/assets-new/images/editIcon.png" width="15" height="20"></a>
                                        &nbsp;  
                                        <a href="#"  title="Delete" class="delete_user" ><img src="{{url('/')}}/assets-new/images/deleteIcon.png" width="15" height="20"></a>  
                                </td> 
                            </tr>
                            
                        @empty
                            <tr style="text-align: center">
                                <td colspan="4">There is no data to show</td>
                            </tr>
                        @endforelse
                    </tbody>
            
        </table>
    </div>
</div>



@include('admin.user.models.view-modal')

@endsection
@section('css')
<style>
    .mCS_img_loaded{
        border-radius:50%;
    }
    .table thead tr th, .table tbody tr td {
            border: none;
    }
    .table thead tr th {
            text-align: center;   
    }

</style>
@endsection
@section('scripts')  
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
    
    $('#myTable').on('click', '.delete_user', function(e){
          e.preventDefault();
          var r = confirm("Are you sure to delete");
          if (r == false) {
              return false;
          }
          var href = $(this).attr('href');
          $.get( href, function( data ) {
              toastr.success(data.message);
              window.location.href = "{{route('adminUser')}}";
              // $('#dataTableExample').DataTable().ajax.reload();
          });
      });
</script>
@endsection

