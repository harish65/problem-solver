@extends('admin.layouts.master')
@section('title', 'User Manage | Admin')

@section('content')



<div class="container">

    <div class="row spl-row">
        <h4>Problem Manage</h4>
    </div>

    <div class="row spl-row">
        <table class="table slp-tbl borderless text-center" id="myTable">
            <thead >
                <tr class="text-center">
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Opertaion</th>
                </tr>
            </thead>           
            <tbody>
                 @forelse ($users as $user)
                            <tr>
                                <td>
                                    <span class="user-icon">
                                        @if($user -> avatar !='')
                                            <img class="mCS_img_loaded" src="{{ asset("assets-new/avatar/" . $user -> avatar ) }}" alt="User Image" width="60"  height="60">
                                            @else
                                            <img class="mCS_img_loaded" src="{{ asset("assets/img/person.jpg" ) }}" width="60"  height="60">
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $user -> name }}</td>
                                <td>{{ $user -> email }}</td>
                                <td>
                                
                                <a href="{{ route('user.edit' , $user -> id)}}" class="editUser"  title="Delete" ><img src="http://127.0.0.1:8000/assets-new/images/editIcon.png" width="15" height="20"></a>
                                &nbsp;  
                                <a href="{{ route('user.delete' , $user -> id)}}"  title="Delete" class="delete_user" data-id="{{ $user -> id }}" ><img src="http://127.0.0.1:8000/assets-new/images/deleteIcon.png" width="15" height="20"></a>   
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

