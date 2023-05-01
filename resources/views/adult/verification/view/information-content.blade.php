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
    @if(isset($verification->id))
    <!-- Content Section Start -->
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>
                    <div class="relationImage text-center">
                    <img src="{{ asset("assets-new/images/verification-banners/info_var.png")}}" alt="relationImage" />
                        
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                <!-- start -->
                <div class="principleRelation">
                    <div class="conditionBlock">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Problem</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto"
                                            src="{{ asset('assets-new/problem/'.$problem->file)}}" width="100%"
                                            height="128px">
                                    </div>
                                    <p class="redText" style="color:red">{{ $problem->name }}</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
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
                                <h2>Solution</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto"
                                            src=" {{ asset('assets-new/solution/'.$solution->file)}}" width="100%"
                                            height="128px">
                                    </div>
                                    <p class="redText" style="color:#00A14C">{{ $solution->name }}</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{ date('d/m/Y', strtotime($solution->created_at))}}</p>
                                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
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
                                <h2>Information</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                    @if($verification->file == 1)
                                        <img class="mx-auto" src="{{ asset('assets-new/verification/voucablary/default-001.jpg')}}" width="100%" height="128px">
                                    @else
                                        <img class="mx-auto" src="{{ asset('assets-new/verification/voucablary/default-002.jpg')}}" width="100%" height="128px">
                                    @endif

                                    </div>
                                    <p class="redText">Information</p>
                                </div>
                                <div class="projectList">
                                    <p class="date"{{ date('d/m/Y' , strtotime($verification->created_at)) }}</p>
                                    <ul>
                                        <li>
                                            <a href="javaScript:Void(0)" class="editverBtn" 
                                                data-verification_type_text_id = "{{ @$verification->verification_type_text_id }}"
                                                data-file = "{{ @$verification->file }}"

                                            
                                            >
                                                <img src="{{ asset('assets-new/images/editIcon.png') }}" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $verification->id }}" class="deleteVoucablaryBtn" title="Delete">
                                                <img src="{{ asset('assets-new/images/deleteIcon.png') }}"
                                                    alt="delete-icon"></a>
                                        </li>
                                        <li>
                                            <a href="#"><img
                                                    src="{{ asset('assets-new/images/uploadIcon.png') }}"
                                                    alt=""></a>
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
                            <div class="title">
                                <h2>Information</h2>

                            </div>
                            <div class="entity">
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Identified Information</th>
                                        <th>Given Information</th>                                       
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Wrod</td>
                                            <td>Entity</td>
                                          
                                            <td>
                                                <a href="javaScript:Void(0)" id="addEntity" class="addEntity">
                                                    <img src="{{ asset('assets-new/images/add-verification.png')}}"
                                                        alt="">
                                                </a>
                                                <a href="javaScript:Void(0)" id="deleteEntity" class="deleteEntity">
                                                    <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                </a>
                                                <a href="javaScript:Void(0)" id="editEntity" class="editEntity">
                                                    <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                </a>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h2>Validation Question</h2>
                        <br>    
                        <ul>
                            <h5>Does the identified information match the given information?</h5>
                            <li>Yes, the identified information matches the given information</li>
                            <li>No, the identified information does not match the given information</li>
                        </ul>

                        
                    </div>
                </div>
                <!-- End -->
                
            </div>
        </div>
    </div>
    <!-- Content Section End -->
    @include('adult.verification.modal.information.entity.create')
    @else
    <div class="relationshipContent" style="height: 280px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-success" id="add-info-varification-button"><i class="fa fa-plus"></i>  Create Verificatoin</button>
                    </div>
                    
                </div>
            </div>
    </div>
    @endif
   
    @include('adult.verification.modal.information.create')
   
   

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
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
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
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



$('#add-info-varification-button').click(function(){
        if($('#verification_types').val() == ''){
            toastr.error('Please select verification type first');
            return false;
        }
        $('#createinfoVerification').modal('toggle')
})
//.editSolFunBtn

$('.editverBtn').click(function(){
    $('#btnSave').attr('id' , 'btnUpdate')
    $('#verification_type_text_id').val($(this).data('verification_type_text_id'))
    $('#file').val($(this).data('file'))
    
    var html = "";
    if($(this).data('file') ==  1){
        html += "<img src='{{ asset('assets-new/verification/voucablary/default-001.jpg')}}'  width='200' height='200' >"
    }else{
        html +=  "<img src='{{ asset('assets-new/verification/voucablary/default-002.jpg')}}'  width='200' height='200' >"
    }
    $('#default-image').removeClass('d-none').html(html)
   $('#createinfoVerification').modal('toggle')
})

   $(document).on('click','#btnSave',function(e){
       e.preventDefault();
       var fd = new FormData($('#InformationVerificationForm')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
        type: 'POST',
           url: "{{route('adult.store-verification')}}",
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
               
                 
              }
           }
       });
   });

   $(document).on('click' , '#btnUpdate' , function(e){    
    e.preventDefault();
       var fd = new FormData($('#InformationVerificationForm')[0]);
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
                $('#btnUpdate').attr('disabled',true);
                $('#btnUpdate').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnUpdate').attr('disabled',false);
                $('#btnUpdate').html('Submit');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
                if(response.success == false)
                {
                    $('#btnUpdate').attr('disabled',false);
                    $('#btnUpdate').html('Login');
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

   $(document).on('click', '.deleteVoucablaryBtn', function(e){
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
               url: "{{route('adult.delete-verification')}}",
               data:{id :  id},         
              
               type: 'POST',           
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
                       toastr.success(response.message);
                       location.reload()
                   }
               }
           });
     });

   

$(function(){
    $('#file').change(function(){
        var file = $('option:selected', this).data('src');           
        if(file){
            $('#default-image').removeClass('d-none').html('<img  src='+ file +' width="200" height="200">')
        }else{
            $('#default-image').addClass('d-none').html('')
        }
       
   })
})
$('#addEntity').click(function(){
    $('#informationEntity').modal('toggle')

    })


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
            url: "{{route('adult.add-vocabulary-entity')}}",
            data: dv,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function(){
                $('#btnSaveEntity').attr('disabled',true);
                $('#btnSaveEntity').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSaveEntity').attr('disabled',false);
                $('#btnSaveEntity').html('Save changes');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response){
                if(response.success == false)
                {
                    $('#btnSaveEntity').attr('disabled',false);
                    $('#btnSaveEntity').html('Save changes');
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
</script>
@endsection