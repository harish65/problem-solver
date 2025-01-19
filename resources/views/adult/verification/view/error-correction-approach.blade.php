@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')
@php $showMessage = false;
$VerificationPermission = \App\Models\Verification::CheckVerificationPermission($project_id);
@endphp
<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                      <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                      ?>
                      @include('adult.verification.view.component.common_routes')
                      @include('adult.verification.view.component.verification_types')
            </div>
        </div>
    </div>
    
    <!-- Content Section Start -->
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>
                  
                    <div class="relationImage text-center">
                    <img src="{{ asset('assets-new/verification_types/' . @$verificationType->banner)}}" alt="relationImage" />                        
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                @if($problemDevelopment->count() > 0)
                    @php $showMessage = true; @endphp
                <!-- start -->
                    <div class="principleRelation">
                        <div class="conditionBlock problem-development">
                            <div class="blockProblem">
                                <div class="projectBlock text-center">
                                    <h2>Error</h2>
                                    <div class="projectList text-center">
                                        @foreach($problemDevelopment as $data)
                                        <button class="btn btn-danger  mt-3">
                                            {{$data->error_name}}
                                        </button>
                                        @endforeach
                                    </div>
                                
                                </div>
                            </div>
                        
                            
                            <div class="arrow">
                                <ul>
                                    @foreach($problemDevelopment as $entity)
                                    <li class="top"><img src="{{ asset('assets-new/images/arrow_sm.png')}}"></li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <div class="blockProblem">
                                <div class="projectBlock text-center">
                                    <h2>Compensator</h2>
                                    <div class="projectList text-center">
                                        @foreach($problemDevelopment as $data)

                                        <button class="btn btn-success mt-3 compensator" data-error-id="{{ $data->id }}">
                                            {{($data->compensator == null) ? 'Identify Compensator' : $data->compensator }}
                                        </button>
                                        

                                        @endforeach
                                    </div>
                                
                                </div>
                            </div>
                        
                            
                        </div>
                        <div class="questionWrap">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                                tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                                nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                                Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                            <div class="row">
                                <div class="title d-flex">
                                    <div class="text-left w-50 ">
                                        <h2>Error Identification and Compensator</h2>
                                    </div>
                                    <div class="text-right w-50 pt-3">
                                        <!-- <button type="button"  class="btn btn-success addVocabularyBtn" >+ Add Problem Development</button> -->
                                    </div>
                                </div>

                                <div class="entity">
                                    <div class="row">
                                        <div class="col text-end">
                                        
                                            <!-- <button class="btn btn-success mt-3 compensator"  >
                                                + Identify Compensator
                                            </button> -->
                                        
                                        </div>
                                    </div>
                                    <table class="table slp-tbl text-center">
                                        <thead>
                                            <th>Error Identified</th>
                                            <th>Compensator Identified</th>
                                            <th>Date</th>  
                                            <th>Action</th>                                      
                                        </thead>
                                        <tbody>
                                    @foreach($problemDevelopment as $data)
                                    
                                            <tr>
                                                <td>
                                                    {{$data->error_name}}
                                                </td>
                                                
                                                <td>
                                                    {{($data->compensator == null) ? 'Not Identified' : $data->compensator}}
                                                </td>
                                                <td>
                                                    {{($data->compensator_date != '') ?  date('d-m-Y' , strtotime($data->compensator_date)) : 'Not Identified' }}
                                                </td>
                                                <td>
                                                    <a href="javaScript:void(0)" data-id ="{{ $data->error_correction_id }}"  
                                                                                data-error_id="{{ $data->id }}" data-error_name="{{$data->compensator}}" 
                                                                                data-error_date="{{ ($data->compensator_date != '') ? date('d-m-Y' , strtotime($data->compensator_date)) : ''}}" 
                                                                                data-problem="{{$data->problem_name}}" data-problem_date="{{date('d-m-Y' , strtotime($data->problem_date))}} " 
                                                                                class="btn btn-success editBtn"><i class="fa fa-pencil"></i></a>
                                                    @if($VerificationPermission)                            
                                                    <a href="javaScript:void(0)" data-id ="{{ $data->error_correction_id }}"  class="btn btn-danger deleteBtn"><i class="fa fa-trash"></i></a>
                                                    @else
                                                    <a href="javaScript:void(0)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        
                                    @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="paginate" style="float:right;">
                                <nav class="navbar navbar-expand-lg ">
                                <div class="collapse navbar-collapse" id="navbarNav">
                                @if(isset($data->id))
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="btn btn-success"  href="{{ route('adult.feedback-identification' , $parameters) }}">2. Feedback identification<span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="btn btn-success" href="{{ route('adult.error-correction' ,  $parameters) }}">3. Continue With Error Correction<span class="sr-only">(current)</span></a>
                                    </li>
                                </ul>
                                @endif
                                </div>
                                </nav>
                            </div>
                    
                    </div>
                    @else

                    <!-- @include('adult.verification.view.component.shared-message') -->
                @endif
            </div>
            <!-- End -->
            
        </div>
    </div>
</div>
<!-- Content Section End -->



    <!-- Modal Start -->
    @if($VerificationPermission)
    <div class="modal fade" id="error_correction_modal" tabindex="-1" role="dialog" aria-labelledby="error_correction_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Compensator</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="error-correction-dev-form" >
                <input type="hidden" name="prob_dev_id" id="ver_id" value="">
                <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                <input type="hidden" name="solution_function_id" id="solution_function_id" value="{{ $problem_id }}">
                <input type="hidden" name="project_id" value="{{ $project_id }}">
                <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                <input type="hidden" name="error_id" id="error_id" value="">
                <input type="hidden" name="id" id="id" value="">
                <div class="form-group">
                    <label for="compensator">Actual Compensator</label>
                    <input type="text" class="form-control" name="compensator" id="compensator">
                </div>
                <div class="form-group">
                    <label for="compensator">Compensator Date</label>
                    <input type="text" class="form-control" name="compensator_date" autocomplete="off" id="compensator_date_">
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
@endif

@endsection
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    .image{
        margin: 20px;
        text-align: center;
        border: 2px solid;
        padding: 14px;
        border-radius: 5px;
        background: #eee;
        }
    .image img{
        border-radius : 5px;
    }     
    .validate_que{
        list-style:none;
    }
    .conditionBlock.problem-development{
        justify-content: center;
    }
    .arrow ul {
        margin-top: 40%;
        position: relative;
        right: 20px;
    }
    .arrow ul li {
        margin-top: 17%;
        list-style: none;
    }
    
</style>
@endsection
@section('scripts')


  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
 
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
})


</script>
<script>
routes();
$('.dashboard').click(function(){
    routes();
})

$(document).on('click' , '#btnSave', function(e){
    e.preventDefault();
    var dv = new FormData($('#error-correction-dev-form')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       $.ajax({
            type: 'POST',
            url: "{{route('adult.create-error-correction-type')}}",
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

   $('.compensator').click(function(){
        var errorID = $(this).attr('data-error-id');
        $('#error_id').val(errorID);
   })

   $(function() {

    $("#compensator_date_").datepicker();
});
    


   $(".editBtn").on('click' , function(){
    
       
        $('#compensator_date_').val($(this).data('error_date'))
        $('#compensator').val($(this).data('error_name'))
        $('#id').val($(this).data('id'))
        $('#error_id').val($(this).data('error_id'))
        $('#error_correction_modal').modal('toggle')
   })


   $(".deleteBtn").on('click',function(){
        if(!confirm('Are you sure to delete this record')){
            return false;
        }
        var _id = $(this).data('id');
        if(_id == '' || !$.isNumeric(_id)){
            toastr.error('Something wrong record can not delete')
        }
        $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('adult.delete-error-correction')}}",
            data: {'id': _id , 'table_name':'error_correction'},            
           
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
   $('.compensator').click(function(){
    $('#error-correction-dev-form')[0].reset();  
    $('#error_correction_modal').modal('toggle')
})



var showMessage = "{{$showMessage}}"
    
    if (!showMessage) {
        //   function showMessage (){  
        swal({
            title: "{{$verificationType->error_title}}",
            text: "{{$verificationType->message}}",
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    }
</script>
@endsection