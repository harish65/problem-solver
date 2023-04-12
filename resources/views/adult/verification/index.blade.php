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
            @switch(!is_null($verificationType) && $verificationType->id)
                @case(1)
                    @include('adult.verification.view.verification-content')
                    @break
                @case(2)
                    case 2
                    @include('adult.verification.view.information-content')
                    @break
                @case(3)
                    case 3
                    @include('adult.verification.view.before-after-content')
                    @break
                @case(4)
                    case 4
                    @include('adult.verification.view.separation-step-content')
                    @break
                @case(5)
                    case 5
                    @include('adult.verification.view.time-verification-content')
                    @break
                @case(6)
                    case 6
                    @include('adult.verification.view.past-present-content')
                    @break
                @case(7)
                    case 7
                    @include('adult.verification.view.entity-content')
                    @break
                @case(8)
                    case 8
                    @include('adult.verification.view.solution-time-location1-content')
                    @break
                @case(9)
                    case 9
                    @include('adult.verification.view.solution-time-location2-content')
                    @break
                @case(10)
                    case 10
                    @include('adult.verification.view.people-project-content')
                    @break
                @case(11)
                    case 11
                    @include('adult.verification.view.people-communication-content')
                    @break
                @case(12)
                    case 12
                    @include('adult.verification.view.communication-flow-content')
                    @break
                @case(13)
                    case 13
                    @include('adult.verification.view.partition-approch-content')
                    @break
                @case(14)
                    case 14
                    @include('adult.verification.view.principle-identification-content')
                    @break
                @default
            @endswitch

        </div>
    </div>
    <!-- Content Section End -->

    @if(!@$verification->id)
    <div class="relationshipContent" style="height: 280px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-success" id="add-varification-button"><i class="fa fa-plus"></i>  Create Verificatoin</button>
                </div>
                
            </div>
        </div>
    </div>
    @endif
   
    @include('adult.verification.modal.add-verification')
    
    
    <!-- Modal End -->
</div>

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
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

// $('.editverBtn').click(function(){
//    $('#createVerification').modal('toggle')
// })



   $('.filetypeRadio').change(function(){
        var type = $(this).val()
        if(type == 0){
            $('#fileType').val('0')
            $('#imageFileDiv').css("display", "block");
            $('#youtubeLinkUrl').val('');
            $('#youtubeLink').css("display", "none");
        }if(type == 2){
            $('#fileType').val('2')
            $('#imageFileDiv').css("display", "none");
            $('#imageFile').val('');
            $('#youtubeLink').css("display", "block");
        }
   })

// /imageFile
   $('.editverBtn').click(function(){
    $('.dropify').dropify();
    var type = $(this).data('type')
    
            $('#verification_name').val($(this).data('name'))
            $('#id').val($(this).data('id'));
            $('#verification_type_text_id').val($(this).data('verification_type_text_id'));
            if(type == 0){
                $('#imageFile').css('display' , 'block')
                $('#youtubeLink').css("display", "none");
                $('#file').prop("checked", true);
                $('#fileType').val('0')
                $('#imageFile').css("display", "block");
            }else if(type == 2){
                $('#imageFileDiv').css('display' , 'none')
                $('#link').prop("checked", true);
                $('#youtubeLinkUrl').val($(this).data('file'))
                $('#fileType').val('2')
                $('#youtubeLink').css("display", "block");
            }
            if($(this).file != ""){
               var file = $(this).data("file");
               var drEvent = $('#imageFile').dropify(
               {
                   defaultFile: "/assets-new/verifications/" + file
               });
               drEvent = drEvent.data('dropify');
               drEvent.resetPreview();
               drEvent.clearElement();
               drEvent.settings.defaultFile = "/assets-new/verifications/" + file;
               drEvent.destroy();
               drEvent.init();	
           }
    $('#createVerification').modal('toggle')

   })



   $(document).on('click','#btnSave',function(e){
       e.preventDefault();
       var fd = new FormData($('#createVerificationForm')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       
       $.ajax({
           url: "{{route('adult.store-verification')}}",
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
@endsection