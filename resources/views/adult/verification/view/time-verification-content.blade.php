@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')

<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                      <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                      ?>
                      <a id="problem_nav" href="{{ route("adult.problem",@$parameter) }}"></a>
                      <a id="solution_nav" href="{{ route("adult.solution",@$parameter) }}"></a>
                      <a id="solution_fun_nav" href="{{ route("adult.solution-func",@$parameter) }}"></a>
                      <a id="verification" href="{{ route("adult.varification",@$parameter) }}"></a>   

                <div class="col-sm-12">
                    <div class="d-flex align-items-center">
                        <h2>Verification</h2>
                        <select class="form-control form-select" id="verification_types">
                                <option value=''>Select Verification Type..</option>
                            @foreach(@$types as $type)
                                <option {{  (@$verificationType->id  == $type->id) ? 'selected' : '' }} value='{{ $type->id }}'>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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
                        <img src="{{ asset("assets-new/verification_types/" . @$verificationType->banner)}}" alt="relationImage" />
                        
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                <!-- start -->
                <div class="principleRelation">
                    
                    <div class="questionWrap">
                            <div class="row">
                            <div class="title d-flex">
                                <div class="text-left w-50 ">
                                    <h2>Time Verification</h2>
                                </div>
                                <div class="text-right w-50 pt-3">
                                    <button type="button" class="btn btn-success addVocabularyBtn" id="add-new-variant">+ Add New</button>
                                </div>
                            </div>
                            <div class="entity">
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Date</th>
                                        <th>Solution hold</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $lastDate = null ?>
                                        @foreach($allVarifications as $varification)
                                        <tr>
                                            <td>{{ date('d/m/Y' , $varification->key)}}</td>
                                            <td>{{ ($varification->val == 'n') ? 'NO' : 'YES' }}</td>
                                            <td>
                                               
                                                <a href="javaScript:Void(0)" class="deleteVoucablaryBtn" data-id="{{  $varification->id }}">
                                                    <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                </a>
                                                <a href="javaScript:Void(0)" class="editVocabularyBtn" data-id="{{  $varification->id }}" data-key="{{ date('d/m/Y' ,  $varification->key )}}" data-val="{{ $varification->val }}">
                                                    <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                </a>

                                            </td>
                                        </tr>
                                        <?php $lastDate = date('Y-m-d H:i:0' ,  $varification->key) ;
                                            
                                        ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php  $lastDate =  date('Y,m,d' , strtotime($lastDate . '+1 day'));?>
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
                            <li><label><input type="radio"  name="validation_1" value="1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} >Yes, the solution of the problem holds related to time</label></li>
                            <li><label><input type="radio"  name="validation_1" value="2" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} >No, the solution of the problem does not hold related to time</label></li>
                        </ul>
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
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
              <input type="hidden" name="verification_id" id="verification_id" value="">
              
              <input type="text" id="date" name="date"  class="form-control"  id="name" placeholder="Enter Date">
          </div>
          <div class="form-group ">
            <label class="radio-inline">Solution Hold</label>
            <label class="radio-inline">
                <input type="radio" value="y" class="solution-hold ml-3" id="solution_hold_y" name="solution_hold" checked>  Yes
              </label>
              <label class="radio-inline">
                <input type="radio" value="n"   class="solution-hold ml-3" id="solution_hold_n" name="solution_hold">  No
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
})
$('.dropify').dropify();
$(function(){
    // $( "#date" ).datepicker();
})

</script>
<script>
$('.nav-problem').click(function(){
    $(this).attr('href' , ''); 
    localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));   
    $(this).attr('href' ,$('#problem_nav').attr('href'))
})
$('.nav-solution').click(function(){
    $(this).attr('href' , ''); 
    localStorage.setItem("sol", $('#solution_nav').attr('href'));   
    $(this).attr('href' ,$('#solution_nav').attr('href'))
})
$('.nav-solution-func').click(function(){
    $(this).attr('href' , '');
    localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
    $(this).attr('href' ,$('#solution_fun_nav').attr('href'))
})
$('.verification').click(function(){
    $(this).attr('href' , '');
    localStorage.setItem("varification", $('#verification').attr('href'));   
    $(this).attr('href' ,$('#verification').attr('href'))
})


$('.dashboard').click(function(){
    //Solution
    $('.nav-solution').attr('href' , '');
    localStorage.setItem("sol", $('#solution_nav').attr('href'));   
    $('.nav-solution').attr('href' ,$('#solution_nav').attr('href'))
    //Problem
    $('.nav-problem').attr('href' , '');
    localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));       
    $('.nav-problem').attr('href' ,$('#problem_nav').attr('href'))
    //Sol fun
    $('.nav-solution-func').attr('href' , '');
    localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));   
    $('.nav-solution-func').attr('href' ,$('#solution_fun_nav').attr('href'))
    //verification
    $('.nav-varification').attr('href' , '');
    localStorage.setItem("varification", $('#verification').attr('href'));   
    $('.nav-varification').attr('href' ,$('#solution_fun_nav').attr('href'))

})

$('.validation').on('change',function(){
        var problem = $(this).attr('data-id');
        var validation  = $(this).val();
        var name = $(this).attr('name')
        $.ajaxSetup({
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
               }); 
        $.ajax({
           url: "{{route('adult.sol-validation')}}",
           data: {data : problem , value : validation , name : name},
           type: 'POST',
           success: function (response){                
               console.log(response)
            }

        })

   })


   $('#add-varification-button').click(function(){
   
        if($('#verification_types').val() == ''){
            toastr.error('Please select verification type first');
            return false;
        }

        $('#createVerification').modal('toggle')
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
       $('#verification_id').val($(this).data('id')) 
            $('#date').val($(this).data('key')).attr('disabled' , true)  
       if($(this).data('val') === 'y'){
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
    $("#date").datepicker({ minDate: new Date(lastDate)  });
});

$('.addVocabularyBtn').click(function(){

    // $('#addVocabularyForm').trigger('reset');
    $('#formTimeVerification')[0].reset();  
    $('#date').attr('disabled' , false)
    $('#exampleModal').modal('toggle')
})

</script>
@endsection