@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
@section('content')

<div class='relationshipPage'>
    <div class="container">
        <div class="mainTitle">
            <div class="row">
                <div class="col-sm-4">
                    <div class="d-flex align-items-center title-min-h ">
                        <h2>Error Correction</h2>
                    </div>
                </div>
                <?php  $parameter =  Crypt::encrypt($params);  ?>
                 <div class="col-sm-8 ">

                 <a href="{{ route('adult.varification' , [$parameter , 16])}}" class="btn btn-success float-end">Back</a>
                    </div>  
                <div class="principleRelation">
                    <div class="conditionBlock problem-development">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Error</h2>
                                <div class="projectList text-center">
                                    @foreach($errors as $data)
                                    <button class="btn btn-danger  mt-3">
                                        {{ $data['error_name'] }}
                                    </button>
                                    @endforeach
                                </div>
                              
                            </div>
                        </div>
                       
                        <div class="arrow">
                                <ul>
                                    @foreach($compensator as $entity)
                                        <li><img src="{{ asset('assets-new/images/arrow_sm.png')}}"></li>
                                    @endforeach
                                </ul>
                        </div>
                        
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Compensator</h2>
                                <div class="projectList text-center">
                                    @foreach($compensator as $data)
                                    <button class="btn btn-success mt-3 compensator">
                                        {{($data['compensator'] == null) ? 'No Compensator' : $data['compensator'] }}
                                    </button>
                                    

                                    @endforeach
                                </div>
                               
                            </div>
                        </div>
                        <div class="arrow">
                                    <ul>
                                        @foreach($compensator as $entity)
                                            <li><img src="{{ asset('assets-new/images/arrow_sm.png')}}"></li>
                                        @endforeach
                                    </ul>
                            </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Feedback</h2>
                                <div class="projectList text-center">
                                    @foreach($compensator as $data)
                                    <button class="btn btn-success mt-3 compensator">
                                        {{($data['feedback_applied'] == 0) ? 'Yes' : 'No' }}
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
                        <button class="btn btn-success" id="feed-back">+ Error Correction</button>
                    </div>                    
                </div>

                <div class="row mt-3">
                    <table class="table slp-tbl text-center">
                        <thead>
                            <th>Error Identify</th>
                            <th>Compensator substituted</th>
                            <th>Feedback given (yes/no)</th>
                            <th>Feedback Applied (yes/no)</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                                @foreach($errorcorrections as $errorcorrection)
                                @php
                                    $errors = json_decode($errorcorrection->error);
                                    $errors_ =  DB::table('problem_development')->whereIn('id' , $errors)->get();
                                    $comp = json_decode($errorcorrection->compensator);
                                    $compensators_ = DB::table('error_correction')->whereIn('id' , $comp)->get();
                                    
                                @endphp
                                <tr>
                                    <td>
                                        <ul>
                                            @foreach ($errors_ as $error_)
                                                <li>
                                                    {{ $error_->error_name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        </td>
                                    <td>
                                        <ul>
                                            @foreach ($compensators_ as $compensator_)
                                                <li>
                                                    {{ $compensator_->compensator }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        {{-- @php
                                            $feedBack_ = DB::table('feedback_identifications')->where('id' , $errorcorrection->feedback)->select('feedback')->first();
                                        @endphp --}}
                                        {{ ($errorcorrection->feedback == 0) ? 'Yes' : 'No' }}
                                    </td>
                                    <td>{{($errorcorrection->feedback_applied == 0) ? 'Yes' : 'No' }}</td>
                                    <td>
                                         <a href="javaScript:void(0)" class="btn btn-success editBtn" data-id ="{{ $errorcorrection->id }}" data-error_ids="{{ $errorcorrection->error }}" data-compensator_ids="{{ $errorcorrection->compensator }}" data-feedback="{{$errorcorrection->feedback }}" data-feedback_applied="{{$errorcorrection->feedback_applied }}" ><i class="fa fa-pencil"></i></a>
                                            <a href="javaScript:void(0)" data-id ="{{ $errorcorrection->id }}"   class="btn btn-danger deleteBtn"><i class="fa fa-trash"></i></a>
                                        </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>


<!-- Modal Start -->
    
<div class="modal fade" id="error_correction_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="hidden" name="id" id="id" value="">
            <div class="form-group">
                <label for="compensator">Select Error</label>
                <select class="form-control" name="error[]" id="error_ara" multiple>
                    
                        @foreach($problemDevelopment as $error)
                            <option value="{{ $error->id }}">{{ $error->error_name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="feedback">Compensator</label>
                <select class="form-control" name="compensator[]" id="compensator_ara" multiple>
                    
                        @foreach($compensators as $data)
                            <option value="{{ $data->id }}">{{ $data->compensator }}</option>
                        @endforeach
                </select>
                
            </div>
            <div class="form-group">
                <label for="date">Feedback Given</label>
                <select class="form-control" name="feedback">
                    
                    <option value="0">Yes</option>
                    <option value="1">No</option>     
                </select>
            </div>
            <div class="form-group">
                <label for="from-person">Feedback Applied</label>
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
@section('css')
<style>
    .arrow ul{
        margin-top: 40%;
        position: relative;
        right: 20px;
        list-style: none;
    }
    .arrow ul li{
        margin-top: 17%;
    }
    li .actions{
        display: inline;
        float: right;
        font-size: 14px;
        margin: 2%;
        padding: 0;
    }
</style>
@endsection
@section('scripts')
<script>

$(document).on('click' , '#btnSave', function(e){
    var compensator = $(":selected" , '#compensator_ara').length
    var error = $(":selected" , '#error_ara').length
    if(compensator != error){
        toastr.error('Error and Compenstor must be eqaul')
        return false;
    }

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
   $('.editBtn').click(function(){
    $(document).find('#error-correction-form')[0].reset();  
    $("input[name='id']").val($(this).data('id'))
    var _errors = $(this).data('error_ids')
    var _compensators = $(this).data('compensator_ids')
        $(_errors).each(function(key,val){
            $("#error_ara option[value='" + val + "']").prop("selected", true);
        })
        $(_compensators).each(function(key,val){
            $("#compensator_ara option[value='" + val + "']").prop("selected", true);
        })

        var _feedback = $(this).data('feedback')
        var _feedback_applied = $(this).data('feedback_applied')
        
        $("select[name='feedback'] option[value='" + _feedback + "'] ").prop("selected", true);
        $("select[name='feedback_applied'] option[value='" + _feedback_applied + "'] ").prop("selected", true);
        
      $('#error_correction_modal').modal('toggle')
   })
   $(".deleteBtn").on('click',function(){
        if(!confirm('Are you sure to delete this record')){
            return false;
        }
        var _id = $(this).data('id');
        if(_id == '' || !$.isNumeric(_id)){
            toastr.error('Something wrong can not delete')
        }
        $.ajaxSetup({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('adult.delete-error-correction')}}",
            data: {'id': _id , 'table_name':'error_correction_type'},            
           
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

   $('#feed-back').click(function(){
    $('#error-correction-form')[0].reset();  
    $('#error_correction_modal').modal('toggle')
})
</script>

@endsection