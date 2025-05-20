
@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
<?php $showMsg = false; ?>
@php
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
                @if($principle_identifications)
                <!-- start -->
                 @if($entity_used)
                <div class="principleRelation">

                    <div class="conditionBlock">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>People</h2>
                                <div class="projectList text-center">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @php $index = 0; @endphp
                                                @foreach($custommers as $user)
                                                        <li data-target="#myCarousel" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                @php $index++; @endphp
                                            @endforeach 
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            @php $index = 1; @endphp
                                                @foreach($custommers as $user)
                                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} " data-entity_id="{{$user->id}}" data-file="{{ $user->file }}" >
                                                        <img  src="{{ asset('assets-new/users/'.$user->file)}}" alt="Chania" width="80%" height="128px">
                                                    </div>
                                                @php $index++; @endphp
                                            @endforeach    
                                               
                                        </div>
                                    </div>
                                    <p class="redText" style="color:red">People</p>
                                </div>
                                <div class="projectList">
                                    
                                    <ul>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <!-- <p style="position:relative; top:35px;left:23px;">is replaced by</p> -->
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Available</h2>
                                <div class="projectList text-center">
                                    @if($entities->count() > 0)
                                    <div id="available_slider" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @php $index = 0; @endphp
                                                @foreach($entities as $entity)
                                                        <li data-target="#available_slider" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                @php $index++; @endphp
                                            @endforeach 
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            @php $index = 1; @endphp
                                                @foreach($entities as $entity)
                                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} " data-entity_id="{{$entity->id}}" data-file="{{ $entity->media }}" data-name="{{ $entity->entity }}" data-actualname="{{ $entity->actual_entity }}">
                                                        <img  src="{{ asset('assets-new/verification_types/entity-available/'.$entity->media)}}" alt="Chania" width="80%" height="128px">
                                                    </div>
                                                @php $index++; @endphp
                                            @endforeach    
                                               
                                        </div>
                                    </div>
                                    @else
                                    <p>No Entity Available</p>
                                    <?php $showMessage = true; ?>
                                    @endif
                                    <p class="redText" style="color:red">Available</p>
                                </div>
                                <div class="projectList">
                                    
                                    <ul>
                                        <li>
                                            <!-- <a href="javaScript:Void(0)" class="editverBtn" data-file="1680525564.png" data-file="1680525564.png">
                                                <img src="{{ asset('assets-new/images//editIcon.png') }}" alt="">
                                            </a> -->
                                        </li>
                                        <li>
                                            <!-- <a data-id="1" class="deleteverBtn" title="Delete">
                                                <img src="{{ asset('assets-new/images/deleteIcon.png') }}"
                                                    alt=""></a> -->
                                        </li>
                                        <li>
                                            <!-- <a href="javascript:void(0)"  class="btn btn-success add-entity" id="add-entity"><i class="fa fa-plus"></i></a>
                                            <a href="javascript:void(0)"  class="btn btn-primary editButton"><i class="fa fa-pencil"></i></a> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="long-arrow">
                            <!-- <p style="position:relative; top:35px;left:25px;">through</p> -->
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/problem/'.$problem->file)}}" width="100%" height="128px">
                                    </div>
                                    <p class="redText">{{ $problem->name }}</p>
                                </div>
                                <div class="projectList">
                                   
                                    
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
                            <div class="title">
                                <h2>Entity Available</h2>

                            </div>
                            <div class="entity">
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Entity</th>
                                        <th>Actual Entity</th>
                                        <th>Entity Fucntion</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>

                                    @foreach($entities as $entity)
                                        <tr>
                                            <td>{{ $entity->entity}}</td>
                                            <td>{{ $entity->actual_entity}}</td>
                                            <td>
                                                {{ $Solution_function->name}}
                                            </td>
                                            <td>
                                            @if($VerificationPermission)
                                                <a  href=""><img src="{{ url('/assets-new/images/deleteIcon.png') }}" width="15" height="20"></a>
                                                <a  href=""><img src="{{ url('/assets-new/images/editicon.png') }}" width="15" height="20"></a>
                                            @else
                                            <img src="{{ url('/assets-new/images/deleteIcon.png') }}" width="15" height="20">
                                            <img src="{{ url('/assets-new/images/editicon.png') }}" width="15" height="20">
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach    
                                    </tbody>
                                </table>
    
                                        

                                       
                            </div>
                        </div>

                        

                        <h2>Validation Question</h2>
                       

                        <form id="validation_form">
                                <input type="hidden" name="id" value="{{ @$verification->id }}">        
                                <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}">        
                                <input type="hidden" name="problem_id" value="{{ @$problem->id }}">        
                                <input type="hidden" name="solution_id" value="{{ @$solution->id }}">        
                                <input type="hidden" name="solution_fun_id" value="{{ @$Solution_function->id }}">        
                                <input type="hidden" name="name" value="entity_usage">        
                        <ul style="list-style:none;">
                            <h5>Have you used the entities to solve the underlying problem?</h5>
                            <li><label><input type="radio"  name="validation_1" value="1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}>Yes, I have used the entities to solve the problem</label></li>
                            <li><label><input type="radio"  name="validation_1" value="2" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}>No, I haven’t used the entities to solve the problem.</label></li>
                        </ul>
                        <ul style="list-style:none;">
                            <h5>Do the entities that are used can be substituted for the problem?</h5>
                            <li><label><input type="radio"  name="validation_2" value="1" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}>Yes, the entities that are used can be substituted for the problem</label></li>
                            <li><label><input type="radio"  name="validation_2" value="2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }} {{ (!$VerificationPermission) ? 'disabled':'' }}>No, the entities that are used cannot be substituted for the problem.</label></li>
                        </ul>
                        @if($VerificationPermission)
                        <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        @endif
                        </form>
                    </div>
                </div>
                @else
                    @if($VerificationPermission)
                            <div class="col-md-12">
                                <button type="button"  class="btn btn-success add-entity" data-toggle="modal" data-target="#EntityUsageModal" >Add <i class="fa fa-plus"></i></button>
                            </div>  
                    @endif
                @endif
                @else
                <?php $showMsg = true ?>
                @endif
                <!-- End -->
                
            </div>
            <div class="row pt-5">
                @include('adult.quiz.quiz-component' , [$project->id , $pageId , $pageType])
            </div>
        </div>
    </div>
    <!-- Content Section End -->
<!-- Modal start -->
<div class="modal fade" id="EntityUsageModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" enctype="multipart/form-data">
        <form method="POST" id="entityForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Entity Usage</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                        <input type="hidden" name="project_id" value="{{ $project_id }}">
                        <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">


                       
                        <div class="form-group">
                            <label>People In Project</label>
                        </div>
                        @foreach($custommers as $entity)
                        <div class="form-group">
                           <input type="text" value="{{  $entity->name .':'. $entity->type }}" class="form-control" disabled>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <label>Entity Usage</label>
                        </div>
                        @foreach($entities as $entity)
                        <div class="form-group">
                           <input type="text" value="{{  $entity->entity }}" class="form-control" disabled>
                        </div>
                        @endforeach
                        <div class="form-group">
                            <input type="text" class="form-control" name="" disabled
                                value="Problem : {{@$problem->name}}">
                        </div>
                        


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="btnSave" class="btn btn-success">Apply</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<!-- Modal End -->

</div>

@endsection
@section('css')

<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .carousel-item img{
        border-radius:15px;
    }
</style>
@endsection
@section('scripts')

<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

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


</script>
<script>
routes();

$('.dashboard').click(function(){
    routes();
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
//.editSolFunBtn

$('.filetypeRadio').change(function(){
    var type = $(this).val()
    if(type == 0){
        $('#fileType').val('0')
        $('#imageFile').css("display", "block");
        $('#youtubeLink').css("display", "none");
    }if(type == 2){
        $('#fileType').val('2')
        $('#imageFile').css("display", "none");
        $('#youtubeLink').css("display", "block");
    }
})
$(document).on('click','#btnSave',function(e){
    e.preventDefault();
    var fd = new FormData($('#entityForm')[0]);
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    $.ajax({
        url: "{{route('adult.entity-usage')}}",
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
            
                toastr.success(response.message);
                location.reload()
            //  if(response.data.params != '' && typeof response.data.params  != 'undefined'){
            //     window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params 
            //  }else{


                
                // window.location.href = "{{ route('adult.dashboard')}}"
            //  }
                
            }
        }
    });
});
$('#btnUpdate').click(function(e){
e.preventDefault();
    var fd = new FormData($('#VerificationeditForm')[0]);
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
$.ajax({
        type: 'POST',
        url: "{{route('adult.updateVerification')}}",
        data: fd,
        processData: false,
        contentType: false,
        dataType: 'json',
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
                
                toastr.success(response.message);
                location.reload()
                //  if(response.data.params != '' && typeof response.data.params  != 'undefined'){
                //     window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params 
                //  }else{


                    
                    // window.location.href = "{{ route('adult.dashboard')}}"
                //  }
                
            }
        }
    });
});

$('#btnSaveEntity').click(function(e){
e.preventDefault();
    var dv = new FormData($('#addVocabularyForm')[0]);
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.ajax({
        type: 'POST',
        url: "",
        data: dv,
        processData: false,
        contentType: false,
        dataType: 'json',
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
                
                toastr.success(response.message);
                location.reload();
            }
        }
    });

});

$('#btnDeleteVocab').click(function(e){
e.preventDefault();
    var dv = new FormData($('#deleteVocabularyForm')[0]);
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
$.ajax({
        type: 'POST',
        url: "{{route('adult.delete-vocabulary')}}",
        data: dv,
        processData: false,
        contentType: false,
        dataType: 'json',
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
                
                toastr.success(response.message);
                location.reload();
            }
        }
    });

});

$('#btnEditSaveEntity').click(function(e){
e.preventDefault();
    var fd = new FormData($('#editVocabularyForm')[0]);
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
$.ajax({
        type: 'POST',
        url: "{{route('adult.updateVocabulary')}}",
        data: fd,
        processData: false,
        contentType: false,
        dataType: 'json',
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
                
                toastr.success(response.message);
                location.reload()
                //  if(response.data.params != '' && typeof response.data.params  != 'undefined'){
                //     window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params 
                //  }else{


                    
                    // window.location.href = "{{ route('adult.dashboard')}}"
                //  }
                
            }
        }
    });
});


$('#saveEntity').click(function(e){
e.preventDefault();
    var fd = new FormData($('#entityTableform')[0]);
    $.ajaxSetup({
    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
$.ajax({
        type: 'POST',
        url: "{{route('adult.create-entity')}}",
        data: fd,
        processData: false,
        contentType: false,
        dataType: 'json',
        beforeSend: function(){
            $('#saveEntity').attr('disabled',true);
            $('#saveEntity').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        },
        error: function (xhr, status, error) {
            $('#saveEntity').attr('disabled',false);
            $('#saveEntity').html('Save changes');
            $.each(xhr.responseJSON.data, function (key, item) {
                toastr.error(item);
            });
        },
        success: function (response){
            if(response.success == false)
            {
                $('#saveEntity').attr('disabled',false);
                $('#saveEntity').html('Login');
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


$(".updateProblemType").change(function(){
    var type = $(this).val();
        
    if(type == 0){
        $("#updateProblemType").val("0");
        $("#updateProblemFileType").css("display", "block");
        $("#updateProblemLinkType").css("display", "none");
        $('#updateProblemLinkFile').val('');
    }else if(type == 2){
        
        $("#updateProblemType").val("2");
        $("#updateProblemFileType").css("display", "none");
        $("#updateProblemLinkType").css("display", "block");
        $(".dropify-clear").trigger("click");
        
    }
});
$('.editButton').click(function(){
    
        var file = $('.active').data("file");
        
        var drEvent = $('#updateProblemFileFile').dropify(
        {
            defaultFile: "/assets-new/verification_types/entity-available/" + file
        });
        drEvent = drEvent.data('dropify');
        drEvent.resetPreview();
        drEvent.clearElement();
        drEvent.settings.defaultFile = "/assets-new/verification_types/entity-available/" + file;
        drEvent.destroy();
        drEvent.init();	
        $('#entity').val($('.active').data("name"));
        $('#actual_entity').val($('.active').data("actualname"));
        $('#entity_id').val($('.active').data("entity_id"));
        $('#entityModal').modal('toggle')
})


$('.editEnityTable').click(function(){
    $('#entity_name').val($(this).attr('data-entity'))
    $('#selection').val($(this).attr('data-selected'))
    $('#actual_enity').val($(this).attr('data-actual-entity'))
    $('#ent_id').val($(this).attr('data-id'))
    $('#exampleModal').modal('toggle')
})
var msg = '{{$showMsg}}';
if(msg) { 
    swal({
        title: "{{@$verificationType->error_title}}",
        text:  "{{@$verificationType->message}}",
        type: "Error",
        showCancelButton: true,
        confirmButtonColor: '#00A14C',
    });
}
</script>

@endsection