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
                        <img src='{{ asset("assets-new/verification_types/" . @$verificationType->banner)}}' alt="relationImage" />
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                <!-- start -->
                @if($beforeAfter)
                <div class="principleRelation">
                    <div class="solutionconditionBlock">
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
                                    <ul>
                                        <li>

                                        &nbsp;&nbsp;&nbsp;
                                        </li>
                                        <li>
                                        &nbsp;&nbsp;&nbsp;
                                                
                                        </li>
                                        <li>
                                        &nbsp;&nbsp;&nbsp;
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
                            <div class="title d-flex">
                            <div class="text-left w-50 ">
                                <h2>Before And After Verification</h2>
                            </div>
                            
                           
                                <div class="text-right w-50 pt-3">
                                    <button type="button"  class="btn btn-success addEntity" id="add-new-variant">+ Add New</button>
                                </div>
                           
                            </div>

                            </div>
                           @if($beforeAfter)
                            <div class="entity">
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Before</th>
                                       
                                        <th>After</th>    
                                        <th>Problem Existed After</th>                                    
                                        <th>Action</th>
                                    </thead>
                                    
                                    
                                        <tr>
                                            <td>{{ $problem->name }}</td>
                                            <td>{{ $solution->name }}</td>
                                            <td><span>{{ ( $beforeAfter->existing_after == 1) ? 'Yes' : 'No'}}</span></td>
                                           
                                            <td><a href="javascript:void(0)" class="">
                                                    <img src="{{ asset('assets-new/images/add-verification.png')}}" alt="">
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $beforeAfter->id }}" class="deleteEntity">
                                                    <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                </a>

                                                <a href="javascript:void(0)" class="editEntity"  >
                                                    <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                </a>

                                            </td>
                                            
                                        </tr>
                                       
                                        
                                </table>
                            </div>
                            @endif
                            
                        </div>

                        <h2>Validation Question</h2>
                        <br>
                        
                            <form id="validation_form">
                                
                                <input type="hidden" name="beforeafter_id" value="{{ @$beforeAfter->id }}">        
                                <input type="hidden" name="id" value="{{ @$verification->id }}">        
                                <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}">        
                                <input type="hidden" name="problem_id" value="{{ @$problem->id }}">        
                                <input type="hidden" name="solution_id" value="{{ @$solution->id }}">        
                                <input type="hidden" name="solution_fun_id" value="{{ @$Solution_function->id }}">
                                <input type="hidden" name="name" id="name" value="before_and_after">   
                                <ul>
                                    <h5>The problem existed before, is the problem solved after?</h5>
                                    <li><label><input  type="radio"  {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} name="validation_1" class="form-check-input validation" value="1">Yes, the problem existed before and after the problem is solved</label></li>
                                    <li><label><input  type="radio"  {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} name="validation_1" class="form-check-input validation" value="2">No, the problem existed before and after the problem is not solved</label></li>
                                    <br>
                                    <h5>The problem existed before, is the problem solved after function execution?</h5>
                                    <li><label><input  type="radio"  {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} name="validation_2" class="form-check-input validation" value="1">Yes, the problem is solved after function execution</label></li>
                                    <li><label><input  type="radio"  {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }} name="validation_2" class="form-check-input validation" value="2">No, the problem is not solved after function execution</label></li>
                                </ul>
                                <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>    
                    </div>
                </div>
                @else

                <div class="text-right w-50 pt-3">
                    <button type="button"  class="btn btn-success addEntity" id="add-new-variant">+ Add New</button>
                </div>

                @endif
                <!-- End -->
                
            </div>
        </div>
    </div>
    <!-- Content Section End -->

<!-- edit and delete solution -->

    <!-- Modal End -->
</div>
@include('adult.verification.modal.before-after.entity.create')
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
    routes();
$('.dashboard').click(function(){
    routes();
})

$('#btnSaveEntity').on('click',function(e){ 
    e.preventDefault();
       var dv = new FormData($('#beforeAfterEntityForm')[0]);
       $.ajaxSetup({
       headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
       });
       $.ajax({
            type: 'POST',
            url: "{{route('adult.before-after')}}",
            data: dv,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function(){
                $('#btnSaveEntity').attr('disabled',true);
                $('#btnSaveEntity').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                console.log(xhr);
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

   $(document).on('click', '.deleteEntity', function(e){
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
               url: "{{route('adult.delete-before-after')}}",
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




</script>

<script>
    $(document).on('click' , '.editEntity , #add-new-variant' , function(){
        $('#beforeAfterEntity').modal('toggle')
    })
</script>
@endsection