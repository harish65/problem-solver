@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
@php $showMessage = true;
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
                <!-- start -->
                <div class="principleRelation">                    
                    <div class="questionWrap">
                            <div class="row">
                            <div class="title d-flex">
                                <div class="text-left w-50">
                                    <h2>Time Verification</h2>
                                </div>
                                @if($VerificationPermission)
                                <div class="text-right w-50 pt-3">
                                    <button type="button" class="btn btn-success addVocabularyBtn" id="add-new-variant">+ Add New</button>
                                </div>
                                
                                    
                                @endif
                            </div>
                            <div class="entity">
                            <?php $lastDate = null ?>
                                @if($timeVerifications->count() > 0)
                                <?php $showMessage =  false; ?>
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Date</th>
                                        <th>Solution hold</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($timeVerifications as $varification)
                                        <tr>
                                            <td>{{ date('m/d/Y' , strtotime($varification->date))}}</td>
                                            <td>{{ ($varification->solution_hold) ? 'Yes' : 'No' }}</td>
                                            <td>
                                            @if($VerificationPermission)
                                                <a href="javaScript:Void(0)" class="deleteVoucablaryBtn" data-id="{{  $varification->id }}">
                                                    <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                </a>
                                                <a href="javaScript:Void(0)" class="editVocabularyBtn" data-id="{{  $varification->id }}" data-key="{{ date('Y-m-d' ,  strtotime($varification->date) )}}" data-val="{{ $varification->solution_hold }}">
                                                    <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                </a>
                                                @else
                                                <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">

                                            @endif
                                            </td>
                                        </tr>
                                        <?php $lastDate = date('Y-m-d H:i:s' ,  strtotime($varification->date)) ; ?>
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                      
                        <?php  $lastDate =  date('Y,m,d' , strtotime($lastDate . '+ 1 day'));?>
                        <h2>Validation Question</h2>
                        <br>       
                        <input type="hidden" value="{{ $lastDate }}" id="last_date"> 
                        <form id="validation_form">
                                <input type="hidden" name="id" value="{{ @$verification->id }}"> 
                        <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}"> 
                        <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                        <input type="hidden" name="project_id" value="{{ $project_id }}">
                        <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                        <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                        <input type="hidden" name="name" id="name" value="People_in_Project">   
                        <ul style="list-style:none;">
                            <h5>Does the solution of the problem hold related to time?</h5>
                            <li><label><input type="radio"  name="validation_1" value="1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}  {{ (!$VerificationPermission) ? 'disabled':'' }}>Yes, the solution of the problem holds related to time</label></li>
                            <li><label><input type="radio"  name="validation_1" value="2" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}  {{ (!$VerificationPermission) ? 'disabled':'' }}>No, the solution of the problem does not hold related to time</label></li>
                        </ul>
                        @if($VerificationPermission)
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        @endif
                        </form>
                    </div>
                </div>
                <!-- End -->
                
            </div>
           
        </div>
    </div>
    <!-- Content Section End -->


    
    
    <!-- Modal start -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Time Verification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formTimeVerification">
        <div class="modal-body">
         
          <div class="form-group">
              <label for="exampleInputEmail1">Date</label>
              <input type="hidden" name="problem_id"  value="{{ $problem_id }}">
              <input type="hidden" name="verification_type_id" value="{{ $verificationType->id }}">
              <input type="hidden" name="solution_id" value="{{ $solution_id }}">
              <input type="hidden" name="solution_function_id" value="{{ $Solution_function->id }}">
              <input type="hidden" name="id" id="id" value="">
              
              <input type="hidden" name="project_id" id="project_id" value="{{ $project_id}}">
              <input type="hidden" id="date_edit" name="date"  class="form-control"  id="name" placeholder="Enter Date">
              <input type="text" id="date" name="date"  class="form-control"  id="name" placeholder="Enter Date" autocomplete='off'>
          </div>
          <div class="form-group ">
            <label class="radio-inline">Solution Hold</label>
            <label class="radio-inline">
                <input type="radio" value="1" class="solution-hold ml-3" id="solution_hold_y" name="solution_hold" checked>  Yes
              </label>
              <label class="radio-inline">
                <input type="radio" value="0"   class="solution-hold ml-3" id="solution_hold_n" name="solution_hold">  No
              </label>
          </div>
          
         
          </form>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="saveBtn">Save</button>
        </div>
      </div>
      </div>
    </div>
  </div>
    <!-- Modal End -->
</div>

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
   
$('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
});
$('#verification_users').on('change', function () { 
        var verification_type_id = $('#verification_types').val();
        var id = $(this).val();
        window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + verification_type_id + '/' + id;
    });
$('.dropify').dropify();
$(function(){
    // $( "#date" ).datepicker();
})

</script>
<script>
routes();
$('.dashboard').click(function(){
   routes();

})


   $(document).on('click','#saveBtn',function(e){
       e.preventDefault();
       var fd = new FormData($('#formTimeVerification')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.store-time-verification')}}",
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
                 location.reload()
              }
           }
       });
   });

   $('.editVocabularyBtn').click(function(){
       $('#id').val($(this).data('id')) 
        $('#date').val($(this).data('key')).attr('disabled' , true)
        $('#date_edit').val($(this).data('key'))
       if($(this).data('val') === 1){
        $('#solution_hold_y').prop('checked' , true)  
       }else{
        $('#solution_hold_n').prop('checked' , true)  
       }

      $('#exampleModal').modal('toggle'); 
   })

$('.deleteVoucablaryBtn').click(function(e){
        e.preventDefault();
         var r = confirm("Are you sure to delete");
         if (r == false) {
             return false;
         }
         
    var id =  $(this).data('id')
    $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
    $.ajax({
           url: "{{route('adult.delete-time-verification')}}" ,
           
           data: { 'id' : id},
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
                 location.reload()
              }
           }
       });
})



$(document).ready(function () {
    var lastDate = $('#last_date').val()
    $("#date").datepicker({ minDate: new Date(lastDate) });
});

$('.addVocabularyBtn').click(function(){

    // $('#addVocabularyForm').trigger('reset');
    $('#formTimeVerification')[0].reset();  
    $('#date').attr('disabled' , false)
    $('#exampleModal').modal('toggle')
})
var showMessage = "{{$showMessage}}"
    var text_ = 'In order for the solution of a problem to be valid, it must hold related to time.  In this case, the solution of the problem must be first identified at a time, then later at another time it must hold.  If the solution of the problem has not been identified, it is not possible to show the time hold relationship.  Please, go back to identify the solution before showing that it holds related to time.'
    // if(showMessage){
    //     swal({
    //         title: "Time Verification",
    //         text: text_,
    //         type: "Error",
    //         showCancelButton: true,
    //         confirmButtonColor: '#00A14C',
    //     });
    // }
</script>
@endsection