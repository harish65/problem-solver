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
                @if($steps)
                <div class="principleRelation">
                    <div class="container">
                        <div class="row justify-content-center">
                            @if($custommers->count() > 0)
                                <?php $showMessage = false; ?>
                                  
                                        <div class="blockProblem col-sm-3">
                                            <div class="projectBlock text-center">
                                                <h2>People</h2>
                                                <div class="projectList text-center sepration-step">
                                                    <div class="imgWrp">
                                                        <div id="myCarousel" class="carousel slide " data-ride="carousel">
                                                       
                                                            <div class="carousel-inner" role="listbox">
                                                                @php $index = 1; @endphp
                                                                @foreach($custommers as $entity)
                                                                    <div class="carousel-item {{ ($index == 1) ? 'active':'' }} ">
                                                                        <img src="{{ asset('assets-new/users/'.$entity->file)}}" alt="Chania" width="80%" height="128px">                                                                        
                                                                        <div class="carousel-caption custom">
                                                                            <ul style="display:block">
                                                                                <li>{{ $entity->name }}</li>
                                                                                <li style="color:red">{{ $entity->type }}</li>
                                                                            </ul>


                                                                        </div>
                                                                    </div>                                                                  
                                                                    @php $index++; @endphp
                                                                @endforeach 
                                                            </div>
                                                            <ol class="carousel-indicators custom">
                                                                @php $index = 0; @endphp
                                                                    @foreach($custommers as $entity)
                                                                            <li data-target="#myCarousel" data-slide-to="{{ $index  }}" class="{{ ($index == 0) ? 'active':'' }}"></li>
                                                                    @php $index++; @endphp
                                                                @endforeach 
                                                            </ol>
                                                           
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                               
                                            </div>
                                        </div>
                                  
                                    
                                    <div class="line-border "></div>
                                @endif

                                
                                <div class="blockProblem col-sm-3">
                                    <div class="projectBlock text-center">
                                        <h2>Problem</h2>
                                        <div class="projectList text-center">
                                            <div class="imgWrp">
                                                <img class="mx-auto"
                                                    src="{{ asset('assets-new/problem/'.$problem->file)}}" width="100%"
                                                    height="128px">
                                            </div>
                                            
                                            <p class="redText" title='{{  $problem->name }}' style="color:red">{{ $problem->name }}</p>
                                        </div>
                                        <div class="projectList">
                                            <p class="date" >{{ date('d/m/Y', strtotime($problem->created_at))}}</p>
                                            <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-border"></div>
                                <div class="blockProblem col-sm-3">
                                    <div class="projectBlock text-center">
                                        <h2>Solution</h2>
                                        <div class="projectList text-center">
                                            <div class="imgWrp">
                                                <img class="mx-auto"
                                                src=" {{ asset('assets-new/solution/'.$solution->file)}}" width="100%"
                                                height="128px">
                                            </div>
                                            
                                            <p class="redText" title='{{  $solution->name }}' style="color:#00A14C">{{ $solution->name }}</p>
                                        </div>
                                        <div class="projectList">
                                            <p class="date">{{ date('d/m/Y', strtotime($solution->created_at))}}</p>
                                            <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="questionWrap">
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit</p>
                        

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
                                        <ul class="validate_que">
                                            <h5>Have you separated the problem from yourself?</h5>
                                            <li><label><input  type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} value="1">Yes, I have separated the problem from myself</label></li>
                                            <li><label><input  type="radio" name="validation_1" {{ (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} value="2">No, I haven't separated the problem from myself</label></li>
                                            <br>
                                            <h5>Have you separated the problem from the people?</h5>
                                            <li><label><input  type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} value="1" >Yes, I have separated the problem from the people</label></li>
                                            <li><label><input  type="radio" name="validation_2" {{ (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}  value="2">No, I haven’t separated the problem from the people</label></li>
                                        </ul>
                                <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                            </form>
                        
                    </div>
                </div>
                <!-- End -->
                @else
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#commonSolutionModal" id="">+ Identify</button>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
    <!-- Content Section End -->
   
</div>

@php $verificationName = ($verificationType->id  == 4) ? 'Separation Step' : 'Functions Belong to People Explanation';
  
  @endphp
  @include('adult.verification.view.component.cards' , [$verificationName , $verificationType->id])


@endsection
@section('css')
<style>
    .line-border{
        border-left: 2px dashed black;
        height: 338px;
        border-right: 2px dashed black;
        height: 358px;
        padding : 1px;
        width: 0px !important;
    }
    .validate_que{
        list-style:none;
    }
    .col-sm-3{
        flex:0 0 23%;
    }
    .carousel{
        height :auto;
        min-height: 258px;
    }
</style>
@endsection
@section('scripts')
<script>
    $('#verification_types').on('change',function(){
    var id = $(this).val();
    window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
})


$(document).on('click', '#btnSave', function (e) {
        e.preventDefault();
        var fd = new FormData($('#entityForm')[0]);
        fd.append('table_name', 'sepration_steps');
        fd.app
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('adult.store-sep-steps')}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function () {
                $('#btnSave').attr('disabled', true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSave').attr('disabled', false);
                $('#btnSave').html('Apply');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {
                if (response.success == false) {
                    $('#btnSave').attr('disabled', false);
                    $('#btnSave').html('Apply');
                    var errors = response.data;
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    });
                } else {

                    toastr.success(response.message);
                    location.reload()


                }
            }
        });
    });
    var showMessage = "{{$showMessage}}"
    var text_ = 'In order to solve a problem, we identify three entities: first we identify the problem; second, we identify the solution for that problem, and third we identify people who are working to solve that problem.  In this case, we identify and separate those 3 entities.  If all those 3 entities have not been identified, it is not possible to show the separation of those entities.  Please, refer to the appropriate page to identify the problem, the solution, and people who are working to solve the problem, before showing them as separate entities'
    if(showMessage){
        swal({
            title: "Separtion Step Verification",
            text: text_,
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    }

    $('#solutio_functio_div').addClass('d-none');
    $('#solution_div').removeClass('d-none')
</script>
@endsection