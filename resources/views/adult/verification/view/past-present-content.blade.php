@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
@php $showMessage = true @endphp
<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                      <?php 
                            $parameters = ['problem_id'=> $problem_id , 'project_id' => $project_id];                            
                            $parameter =  Crypt::encrypt($parameters);
                      ?>
                      <a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
                      <a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
                      <a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
                      <a id="verification" href="{{ route('adult.varification',@$parameter) }}"></a>   

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
                            <div class="text-left w-50 ">
                            <h2>Past Time Present Time</h2>

                            </div>
                                <div class="text-right w-50 pt-3">
                                    <button type="button" class="btn btn-success addVocabularyBtn" id="add-new-variant">+ Add New</button>
                                </div>
                               
                            </div>
                            <div class="entity">
                            <?php $lastDate = null ?>
                                @if($pastAndPresentTime->count() > 0)
                                <?php $showMessage = false; ?>
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <td><input type="checkbox" class="checkbox" id="check_all" value="0"></td>
                                        <th>Date</th>
                                        <th>Problem name</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    
                                        @foreach($pastAndPresentTime as $varification)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox_single" name="_delete[]" data-checkbox_id="{{$varification->id}}" value="0"></td>
                                            <td>{{ date('m/d/Y' , strtotime($varification->time))}}</td>
                                            <td>{{ $problem->name }}</td>
                                            <td>
                                                <a href="javaScript:void(0)" class="delete_ action_single"  data-id="{{  $varification->id }}">
                                                    <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                </a>
                                                <a href="javaScript:void(0)" class="editVocabularyBtn" data-id="{{  $varification->id }}" data-key="{{ date('m/d/Y' ,  strtotime($varification->time) )}}">
                                                    <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                </a>

                                            </td>
                                        </tr>
                                        <?php 
                                        $lastDate = date('Y-m-d' ,  strtotime($varification->time)) ;
                                            
                                        ?>
                                        @endforeach
                                    </tbody>
                                </table>
                               
                                <div class="row">
                                    <div class="col-md-12">
                                    <button type="button" class="btn btn-danger" id="bulk_delete">Delete</button>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ date('Y-m-d' , strtotime($lastDate.' + 1 days')) }}" id="last_date"> 
                                @endif
                            </div>
                        </div>
                        
                        <h2>Validation Question</h2>
                        <br>
                        <form id="validation_form">
                                <input type="hidden" name="id" value="{{ @$verification->id }}">   
                                <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}"> 
                                <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                                <input type="hidden" name="project_id" value="{{ $project_id }}">
                                <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                                <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                                <input type="hidden" name="name" id="name" value="People_in_Project">     
                        <ul style="list-style:none;">
                       
                            <h5>Does the problem exist from past to present?</h5>
                            <li><label><input type="radio"  name="validation_1" value="1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} >Yes, the problem has existed from the past to present</label></li>
                            <li><label><input type="radio"  name="validation_1" value="2" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} >No, the problem has not existed from the past to present</label></li>
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
              <input type="hidden" name="project_id"  value="{{ $project_id }}">
              <input type="hidden" name="verification_type_id" value="{{ $verificationType->id }}">
              <input type="hidden" name="solution_id" value="{{ $solution_id }}">
              <input type="hidden" name="solution_function_id" value="{{ $Solution_function->id }}">
              <input type="hidden" name="update"  value="">
              <input type="hidden" name="id"  id="id" value="">
              <input type="text" id="date" name="past_time"  class="form-control"  id="name" autocomplete="off" readonly placeholder="Enter Date">
          </div>
          <div class="form-group">
          <label class="radio-inline">Problem Name</label>
          <input type="text" id="problem_name" name="problem_name"  class="form-control" disabled value="{{ $problem->name }}"  placeholder="Problem Name" >
          </div>
          <div class="form-group d-none ">
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
})
$('.dropify').dropify();


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



$(document).on('click','#saveBtn',function(e){
  e.preventDefault();
  
  var fd = new FormData($('#formTimeVerification')[0]);
  $.ajaxSetup({
  headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });
  
  $.ajax({
      url: "{{route('adult.store-past-present-time')}}",
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
  $('#date').val($(this).data('key'))
 $('#exampleModal').modal('toggle'); 
})




$(document).ready(function () {

    //If the user did not enter any past time then There will be any time from past till todays date
    var lastDate = $('#last_date').val();
    if(typeof lastDate == 'undefined'){
        $("#date").datepicker({ 
            dateFormat : 'm/d/yy',
            minDate: new Date(2007, 1 - 1, 1) , 
            maxDate:  0
        });
    }else{
        $("#date").datepicker({ 
            dateFormat : 'm/d/yy',
            minDate: new Date(lastDate) , 
            maxDate:  0
        });
    }

    
    
    // $("#date").datepicker({ minDate: new Date()  , maxDate: new Date(lastDate) });
});




   //   bulk check box delete
$('#check_all').on('change',function(){
    if($(this).prop('checked') == true){
        $('.checkbox_single').prop('checked' , true)
    }else{
        $('.checkbox_single').prop('checked' , false).removeAttr('checked')   
    }
})

var checkedRecords =  [];
$('.delete_ ').on('click',function(e){
    e.preventDefault();
            var r = confirm("Are you sure to delete all records");
            if (r == false) {
                return false;
            } 
    checkedRecords = [];
    checkedRecords.push($(this).data('id'));
    deletRecords(checkedRecords);
})

$('#bulk_delete').on('click',function(e){      
    if($(".checkbox_single").filter(':checked').length > 0){
        
        e.preventDefault();
            var r = confirm("Are you sure to delete all records");
            if (r == false) {
                return false;
            } 
            checkedRecords = [];
            $(".checkbox_single").filter(':checked').each(function(){
                checkedRecords.push($(this).attr('data-checkbox_id'))
            })  
           
            deletRecords(checkedRecords);
    }else{
            toastr.error('No record selected'); return false;
    }
})
 

function deletRecords(data){
            $.ajaxSetup({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
            $.ajax({
                url: "{{route('adult.delete-past-present-time')}}" ,
                
                data: { 'data' : checkedRecords},
                dataType: 'json',
                type: 'POST',
                beforeSend: function(){
                    $('.c_delete_').attr('disabled',true);
                    $('.c_delete_').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                },
                error: function (xhr, status, error) {
                    $('.c_delete_').attr('disabled',false);
                    $('.c_delete_').html('Delete');
                    $.each(xhr.responseJSON.data, function (key, item) {
                        toastr.error(item);
                    });
                },
                success: function (response){
                    if(response.success == false)
                    {
                        $('.c_delete_').attr('disabled',false);
                        $('.c_delete_').html('Delete');
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
}

$('.addVocabularyBtn').click(function(){
    // $('#addVocabularyForm').trigger('reset');
    $('#formTimeVerification')[0].reset();  
    $('#exampleModal').modal('toggle')
})

var showMessage = "{{$showMessage}}"
    // var text_ = 'In order to identify a problem properly, it must hod its identity related to time.  For instance, if we identify the problem yesterday and today it changes, then we misidentified the problem.  The past and present time problem identification enables us to identify problem properly related to time.  It is not possible to show past and present problem identification, if the problem has not been identified.  Please, refer to the problem identification page to identify the problem before determining if its identity holds related to time'
    // if(showMessage){
    //     swal({
    //         title: "Past Time Present Time",
    //         text: text_,
    //         type: "Error",
    //         showCancelButton: true,
    //         confirmButtonColor: '#00A14C',
    //     });
    // }
</script>
@endsection