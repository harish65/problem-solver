
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
                    <div class="conditionBlock">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Function</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/solFunction/'.$Solution_function->file)}}" width="100%" height="128px">
                                    </div>
                                    <p class="redText">{{ $Solution_function->name }}</p>
                                </div>
                                <div class="projectList">
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <p style="position:relative; top:35px;left:23px;">To Solve</p>
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src="{{ asset('assets-new/verification/1680525564.png')}}" width="100%" height="128px">
                                    </div>
                                    <p class="redText">{{ $problem->name }}</p>
                                </div>
                                <div class="projectList">
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <p style="position:relative; top:35px;left:25px;">is exicuted By</p>
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
                      

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
                                        <div class="imgWrp carousel-inner" role="listbox">
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
                    </div>
                    <div class="questionWrap">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                        <div class="row">
                            <div class="title">
                                <!-- <h2>Entity Available</h2> -->

                            </div>
                            <div class="entity">
                                <!-- <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Entity</th>
                                        <th>Actual Entity</th>
                                        <th>Entity Fucntion</th>
                                    </thead>
                                    <tbody>

                                    @foreach($entities as $entity)
                                        <tr>
                                            <td>{{ $entity->entity}}</td>
                                            <td>{{ $entity->actual_entity}}</td>
                                            <td>
                                                {{ $Solution_function->name}}
                                            </td>
                                        </tr>
                                    @endforeach    
                                    </tbody>
                                </table>      -->
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
                            <h5>Do you understand that the function to solve the underlying problem is executed by person/people?</h5>
                            <li><label><input type="radio"  name="validation_1" value="1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} >Yes, I understand that the function to solve the underlying problem is executed by person/people.</label></li>
                            <li><label><input type="radio"  name="validation_1" value="2" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} >No, I don’t understand that the function to solve the underlying problem is executed by person/people.</label></li>
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
<div class="modal fade" id="entityModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" enctype="multipart/form-data">
    <form method="POST" id="entityForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Entity Available</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php 
           
                        $problem_id =  Crypt::encrypt($problem_id);
                        $project_id =  Crypt::encrypt($project_id);
                        $solution_id =  Crypt::encrypt($solution_id);
                    ?>
                <div class="modal-body">
                <input type="hidden" name="updateProblemType" id="updateProblemType">
                    <input type="hidden" name="id" id="ver_id" value="{{ @$verification->id}}">
                    <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                    <input type="hidden" name="project_id" value="{{ $project_id }}">
                    <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                    <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                    <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                    <input type="hidden" name="entity_id" id="entity_id" value="">
                    
                    <div class="form-group" id="updateProblemFileType">
                        <input type="file" name="updateProblemFile" data-height="150" id="updateProblemFileFile" class="dropify" accept="image/*, video/*">
                        
                    </div>
                    <div class="form-group" id="updateProblemLinkType" style="display: none">
                        <input type="url" name="updateProblemFileLink" id="updateProblemLinkFile" class="form-control" placeholder="Link">
                    
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="verificationType" disabled value="Verification Type : {{@$verificationType->name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="verificationType" disabled value="Solution : {{@$solution->name}}">
                    </div>
                    <div class="form-group">
                        <input name="entity" class="form-control" id="entity" placeholder="Entity Name">
                    </div>
                    <div class="form-group">
                        <input name="actual_entity" class="form-control" id="actual_entity" placeholder="Actual Entity">
                    </div>
                    <div class="form-group">
                         <input type="text" class="form-control" name="verificationType" disabled value="{{ (@$givenSet->type == 1) ? 'The Given Set' : 'Drived Principle'  }}">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="formula">
                            <option value='0'>Available + Given = Solution</option>
                            <option value='1'>Natural Value + Natural value = Natural Value</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn btn-success">Select</button>
                </div>
            </div>
        </div>
    </form>
</div>
   
    
    
    <!-- Modal End -->

    <!----Modal start----->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Creat Entity</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="entityTableform">
            <input type="hidden" name="verificationID" id="ver_id" value="{{ @$verification->id}}">
            <input type="hidden" name="id" id="ent_id" value="">
            <div class="form-group">
                <label for="email">Entity Name:</label>
                <input type="text" name="entity_name" class="form-control" id="entity_name" placeholder="Entity Name">
            </div>
            <div class="form-group">
                <label for="email">Actual Entity:</label>
                <input type="text" class="form-control" id="actual_enity" name="actual_enity" placeholder="Actual Entity">
            </div>
            <div class="form-group">
                <label for="email">Select:</label>
               <select name="selection" class="form-control form-select" id="selection">
                <option value="yes">YES</option>
                <option value="no">NO</option>
                </select>
            </div> 
           
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" id="saveEntity">Save changes</button>
        </div>
        </div>
    </div>
    </div>
    <!----Modal End----->
</div>

@endsection
@section('css')

<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
@endsection
@section('scripts')

<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.tiny.cloud/1/5f20xhd98muhs1m7cl3eud00r4ugz5hxk5cbblquuo02mfef/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
        url: "{{route('adult.store-entity-verification')}}",
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

</script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>
@endsection