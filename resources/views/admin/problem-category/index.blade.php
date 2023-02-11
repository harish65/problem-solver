@extends('admin.layouts.master')
@section('title', 'Manage Problem Categories | Admin')

@section('content')
<div class="container">

    <div class="row spl-row">
        <h4>Manage Problem Categories</h4>
    </div>
    <div class="row spl-row">
        <table class="table slp-tbl" id="myTable">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Opertaion</th>
                </tr>
            </thead>
            <tbody>
                @if(count($categories) > 0)               
                    @foreach ($categories  as $category)
                        <tr>
                            
                            <td>{{ $category->name }}</td>
                            <td>{{ __('Admin')}}</td>
                            <td>{{ date('d-m-Y' , strtotime($category->created_at)) }}</td>
                            <td>
                                <a href="javaScript:Void(0)"  data-href="{{ route('category.delete', [$category -> id]) }}"  data-id="{{ $category -> id }}" class="delProblemBtn" title="Delete" ><img src="{{ url('/') }}/assets-new/images/deleteIcon.png" width="15" height="20"></a>
                                    &nbsp;
                                <a href="javaScript:Void(0)" class="edicategory"  data-id="{{ $category -> id }}" data-name="{{ $category -> name }}"  title="Delete">
                                    <img src="{{ url('/') }}/assets-new/images/editIcon.png" width="15" height="20">
                                </a>
                            </td>
                        </tr>
                        
                    @endforeach
                    @else
                    <td>No records found</td>
                    <td></td>
                    <td></td>
                    <td></td>
                @endif  
            </tbody>
        </table>
    </div>
</div>
@include('admin.problem-category.modal.add-modal')
@endsection
@section('scripts')
<script src="{{ asset('assets-new/js/dataTables.buttons.min.js')}}"></script>
<script>
    $(document).on('click','#btnSave',function(e){
       e.preventDefault();
       var fd = new FormData($('#add-problem-category')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('category.add')}}",
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
               $('#btnSave').html('Submit');
               $.each(xhr.responseJSON.data, function (key, item) {
                   toastr.error(item);
               });
           },
           success: function (response){
             if(response.success == false)
             {
                 $('#btnSave').attr('disabled',false);
                 $('#btnSave').html('Login');
                 var errors = response.data;
                 $.each( errors, function( key, value ) {
                     toastr.error(value)
                 });
             } else {
                 toastr.success('Record saved successfully!');
                 window.location.href = "{{route('category.index')}}";
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
               url: "{{route('category.delete')}}",
               data:{id :  id},         
              
               type: 'get',           
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
                       window.location.href = "{{route('category.index')}}";
                   }
               }
           });
     });
</script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    text: '<i class="fa fa-plus"></i>Add Category',
                    className : 'btn btn-success',
                    attr:  {
                            title: 'Add Category',
                            id: 'addcategory',
                            
                    }
                }
            ],
            "bLengthChange" : true, //thought this line could hide the LengthMenu
            "bInfo":true,    
                language: {
                paginate: {
                next: '>',
                previous: '<'  
                }
            },
            
        });
    });
    </script>
    <script>
        $('body').on('click','#addcategory',function(){
            $('#addCategoryModal').modal('toggle')
        })
        $('body').on('click','.edicategory',function(){
                $('#cat_id').val($(this).attr('data-id'))
                $('#name').val($(this).attr('data-name'))
                $('#addCategoryModal').modal('toggle')
        })


    </script>
@endsection

