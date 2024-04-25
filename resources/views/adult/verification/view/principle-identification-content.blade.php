@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Types')
@section('content')
<?php $ShowMessage =  true; ?>
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
                @if($users->count() > 0)
                <?php $ShowMessage =  false; ?>
                <div class="principleRelation">
                    <div class="conditionBlock">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>People</h2>
                                <div class="projectList text-center">
                                <div class="imgWrp">
                                        <div id="myCarousel" class="carousel slide " data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                @php $index = 1; @endphp
                                                @foreach($users as $entity)
                                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} ">
                                                        <img src="{{ asset('assets-new/users/'.$entity->file)}}" alt="Chania" width="80%" height="128px">
                                                        <div class="carousel-caption custom">{{ $entity->name }}</div>
                                                    </div>
                                                    @php $index++; @endphp
                                                @endforeach 
                                            </div>
                                            <ol class="carousel-indicators custom">
                                                @php $index = 0; @endphp
                                                    @foreach($users as $entity)
                                                            <li data-target="#myCarousel" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                    @php $index++; @endphp
                                                @endforeach 
                                            </ol>
                                        </div>
                                    
                                </div>
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
                            <div class="projectBlock text-center">
                                <h2>Principles</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto"
                                            src=" {{ asset('assets-new/verification_types/pi/pi-card.jpg')}}" width="100%"
                                            height="250px">
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
                                        <img class="mx-auto" src="{{ asset('assets-new/problem/'.$problem->file)}}"
                                            width="100%" height="128px">
                                    </div>
                                    <p class="redText" style="color:red">{{ $problem->name }}</p>
                                </div>
                                <div class="projectList">
                                <p class="date">{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                    <ul>
                                        <li>
                                            <!-- <a href="javaScript:Void(0)" class="editverBtn" data-file="1680525564.png" data-file="1680525564.png">
                                                <img src="{{ asset('assets-new/images//editIcon.png') }}" alt="">
                                            </a> -->
                                        </li>
                                        <li>
                                            <!-- <a data-id="1" class="editverBtn" title="Delete">
                                                <img src="{{ asset('assets-new/images/deleteIcon.png') }}"
                                                    alt=""></a> -->
                                        </li>
                                        <li>
                                            <!-- <a href="#"><img
                                                    src="{{ asset('assets-new/images/uploadIcon.png') }}"
                                                    alt=""></a> -->
                                        </li>
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
                          
                            <div class="title d-flex">
                            <div class="text-left w-50 ">
                                <h2>Principle Identification</h2>
                            </div>
                                <div class="text-right w-50 pt-3">
                                    <button type="button"  class="btn btn-success addVocabularyBtn" id="add-new-variant">Select</button>
                                </div>
                            </div>
                            </div>
                            <div class="entity">
                                <table class="table slp-tbl text-center">
                                    <thead>
                                    <td>Principle Count</td>
                                    <td>Actual Principle</td>
                                    <td>Applicable</td>
                                    <td>Action</td>
                                    </thead>
                                    <tbody>
                                    @php $index = 1 @endphp
                                           @foreach($allVarifications as $data)
                                                @if($data->type == 1)
                                                <tr class="given-set {{ ($verification->type == 0) ? 'show':'d-none' }}">
                                                    <td>{{ $data->number }}</td>
                                                    <td>{{ $data->text }}</td>
                                                    <td> {{ ($data->applicable == 0) ? 'YES' :'NO'   }}</td>
                                                    <td> <a href="javaScript:Void(0)" class="editEntity"
                                                        data-id="{{ $data->id }}"
                                                        data-priciple="{{ $data->text }}"
                                                        data-applicable="{{ $data->applicable }}"
                                                        data-index="{{ $index }}"
                                                        >
                                                                <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php $index++ @endphp
                                                @endif
                                                @endforeach
                                        @php $index = 1 @endphp
                                           @foreach($allVarifications as $data)
                                                @if($data->type == 2)
                                                <tr class="derived-principle {{ ($verification->type == 1) ? 'show':'d-none' }}">
                                                    <td>{{ $data->number }}</td>
                                                    <td>{{ $data->text }}</td>
                                                    <td> {{ ($data->applicable == 0) ? 'YES' :'NO'   }}</td>
                                                    <td> <a href="javascript:void(0)" class="editEntity"
                                                                    data-id="{{ $data->id }}"
                                                                    data-priciple="{{ $data->text }}"
                                                                    data-applicable="{{ $data->applicable }}"
                                                                    data-number="{{ $data->number }}"
                                                                    >
                                                                <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php $index++ @endphp
                                                @endif
                                           @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if($verification->type == 1)
                        <div class="title">
                        <h2>Derived Principle</h2>
                        </div>
                        
                        <form id="content" action="{{ url('adult/store-priciple-identification')}}" method="post">
                            @csrf
                            <input type="hidden" name="content_id" value="{{ @$content->id}}">
                            <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                            <input type="hidden" name="project_id" value="{{ $project_id }}">
                            <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                            <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                            
                                <div class="row">
                                    <textarea name="content">{{ @$content->content }}</textarea>
                                </div>
                                
                                <div class="row mt-3 text-right">
                                    <div class="form-group">
                                            <button class="btn btn-success" id="update-content"  type="submit">Update Content</button>
                                    </div>
                                </div>
                        </form>
                        @endif
                        <div class="row">
                            <h2>Validation Question</h2>
                            <form id="validation_form">
                                <input type="hidden" name="id" value="{{ @$verification->id }}"> 
                            <ul style="list-style:none;">
                            <h5>Do you use principles to solve the underlying problem?</h5>
                                <li><label><input  type="radio"  {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} name="validation_1" class="validation" value="1">Ye, I use principles to solve the underlying problem.</label></li>
                                <li><label><input  type="radio"  {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} name="validation_1" class="validation" value="2">No, I don’t use principles to solve the underlying problem.</label></li>
                            <h5>Do people use principles to solve the problem?</h5>    
                            <li><label><input  type="radio"  {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} name="validation_2" class="validation" value="1">Yes, people user principles to solve the problem</label></li>
                                <li><label><input  type="radio"  {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }} name="validation_2" class="validation" value="2">No, people don’t use principles to solve the problem</label></li>
                            </ul>
                            <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                        </div>
                        
                </div>
                @endif
                <!-- End principleRelation-->
            </div>
                <!-- End row-->
                
            </div>
        </div>
    </div>
    <!-- Content Section End -->

    
    
    @include('adult.verification.modal.principle-identification.add')
    <!-- Modal End -->
    <div class="modal fade" id="pricipleIdentfyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" enctype="multipart/form-data">

    <form method="POST" id="pricipleIdentfy" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Principle dentification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?php 
           
                        $problem_id =  Crypt::encrypt($problem_id);
                        $project_id =  Crypt::encrypt($project_id);
                        $solution_id =  Crypt::encrypt($solution_id);
                    ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="ver_id" value="{{ @$verification->id}}">
                    <input type="hidden" name="problem_id" id="problem_id" value="{{ $problem_id }}">
                    <input type="hidden" name="project_id" value="{{ $project_id }}">
                    <input type="hidden" name="solution_id" id="solution_id" value="{{ $solution_id }}">
                    <input type="hidden" name="solution_fun_id" id="solution_fun_id" value="{{ $Solution_function->id }}">
                    <input type="hidden" name="verificationType" id="verificationType" value="{{ @$verificationType->id }}">
                    <div class="form-group">
                        <select class="form-control" name="applicable">
                            <option value='0'>THE GIVEN SET</option>
                            <option value='1'>DERIVED PRINCIPLE</option>
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
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .title h2{
        font-family: 'Inter-Bold';
        margin-top: 30px;
        font-style: normal;
        font-weight: 700;
        font-size: 24px;
        line-height: 29px;
        color: #000000;
    }
    .carousel{
        height :auto;
        min-height: 258px;
    }
</style>
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

$('.editEntity').click(function(){
    
    $('#pricple_identify_id').val($(this).data('id'))
    var counter = $(this).attr('data-number') + '.  ' + $(this).attr('data-priciple')
    $('#principle').val(counter)
    if($(this).attr('data-applicable')){
        $('#applicable').val($(this).attr('data-applicable'))
    }else{
        $('#applicable').val('0')
    }
    
   $('#createVerification').modal('toggle')
})
   $('.addVocabularyBtn').click(function(){
    $('#pricipleIdentfyModal').modal('toggle')
})


   $(document).on('click','#btnSave',function(e){
       e.preventDefault();
       var fd = new FormData($('#pricipleIdentfy')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.store-priciple-verification')}}",
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
               
                 
              }
           }
       });
   });



   $(document).on('click','#btnSavePriciple',function(e){
       e.preventDefault();
       var fd = new FormData($('#createVerificationForm')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.store-priciple-identification')}}",
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


  


</script>
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });

    var ShowMessage =  "{{$ShowMessage}}";
        if(ShowMessage){
            
        swal({
            title: "Information",
            text: 'People in project are must be identified before Identification of principle.Pricnciple ',
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    
        }
  </script>
@endsection