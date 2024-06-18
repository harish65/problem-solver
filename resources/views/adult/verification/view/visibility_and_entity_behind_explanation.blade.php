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
                <a id="problem_nav" href="{{ route('adult.problem',@$parameter) }}"></a>
                <a id="solution_nav" href="{{ route('adult.solution',@$parameter) }}"></a>
                <a id="solution_fun_nav" href="{{ route('adult.solution-func',@$parameter) }}"></a>
                <a id="verification" href="{{ route('adult.varification',@$parameter) }}"></a>

                <div class="col-sm-12">
                    <div class="d-flex align-items-center">
                        <h2>Verification</h2>
                        <select class="form-control form-select" id="verification_types">
                            <option value=''>Select Verification Type..</option>
                            @foreach(@$types as $type)
                            <option {{ (@$verificationType->id == $type->id) ? 'selected' : '' }} value='{{ $type->id
                                }}'>{{ $type->name }}</option>
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
                    <p>{{ @$verificationType->explanation }}</p>
                    <div class="relationImage text-center">
                        <img src="{{ asset('assets-new/verification_types/'.@$verificationType->banner)}}"
                        alt="relationImage" />
                    </div>
                    <h1 class="mt-5">Entity Behind Approach</h1>
                    <p>Since the solution of a problem does not take outside element, to solve a problem we concern only
                        about entities that enable us to solve that problem. Anything that does not enable us to solve
                        that problem, are putting behind us. In other words, we simply left them, since they don’t help
                        us solve the underlying problem.</p>
                    <p>Since the solution of a problem is natural, anything or item that can act as a disturbance to
                        prevent us from solving that problem is not part of the solution. In this case, we put such item
                        behind us or think such item is not visible to us or does not exist. In other words, we don’t
                        put such item in front, we put it behind since it does not help us solving the problem. </p>
                    <p>Since the solution of a problem is natural and the solution of that problem is separate from us,
                        it is always good for us to think only about entities that can be used to help us solve that
                        problem, not entities that cannot help us solve that problem. In this case, any other entities
                        that does not help us solve that problem must be put behind</p>

                </div>
                <!-- start -->
                @if($entiesBehind->count() > 0)
                <div class="principleRelation mt-3">
                    <div class="conditionBlock justify-content-center">
                        <div class="projectBlock text-center">
                            <h2>Entity Behind</h2>
                            <div class="projectList text-center">
                                <div class="imgWrap container">
                                    <img class="mx-auto" src="{{ asset('assets-new/verification/t-shirt.png')}}" width="100%" height="300px">
                                    <div class="centered" id="list_">
                                        <ol id="items">
                                            @foreach($entiesBehind as $key=>$data)
                                            <li>{{ $data->entity_name }}</li>
                                            @endforeach
                                        </ol>
                                        <div class="d-none" id="black_img">
                                            <img class="mx-auto" src="{{ asset('assets-new/verification/black_.png')}}" width="80%" height="200px">
                                        </div>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="" for="flexCheckDefault" style="color:#000;">
                                            Show/Hide
                                          </label>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <h2>Identified Entities</h2>
                            
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#entityModal"
                             id="">+ Identify Entity Behind</button>
                        </div>
                    </div>
                        <div class="row mt-3">

                            <table class="table slp-tbl text-center">
                                <thead>
                                    <th>Entity Count</th>
                                    <th>Entity Name</th>
                                    <th>Put Behind</th>
                                    <th>Action</th>
                                    
                                </thead>
                                <tbody>
                                   @foreach($entiesBehind as $key=>$data)
                                    
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $data->entity_name }}</td>
                                            <td>{{ ($data->put_behind) ? 'No' : 'Yes'  }}</td>
                                            <td>
                                                <a href="javaScript:Void(0)" class="deleteEntityAvailable" data-id="{{ $data->id }}">
                                                    <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                </a>
                                                <a href="javaScript:Void(0)" class="editEnityTable" data-name="{{ $data->entity_name  }}" data-put-behind="{{ $data->put_behind }}" data-id="{{ $data->id }}"  >
                                                    <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="" >
                                                </a>
                                            </td>
                                        </tr>
                                  
                                   @endforeach     
                                </tbody>
                            </table>
                        </div>    
                    
                    <div class="questionWrap">
                        <h2>Validation Question</h2>
                        <form id="validation_form">
                            <input type="hidden" name="id" value="{{ @$verification->id }}">
                            <input type="hidden" name="verification_type_id" value="{{ @$verificationType->id }}">
                            <input type="hidden" name="problem_id" value="{{ @$problem->id }}">
                            <input type="hidden" name="solution_id" value="{{ @$solution->id }}">
                            <input type="hidden" name="solution_fun_id" value="{{ @$Solution_function->id }}">
                            <input type="hidden" name="name" value="entity_usage">
                            <ul style="list-style:none;">
                                <h5>To solve the problem, do you feel you have something you want to put behind you that
                                    will not help you in solving the problem? </h5>
                                <li><label><input type="radio" name="validation_1" value="1" {{
                                            (@$verification->validations->validation_1 == 1) ? 'checked' : '' }} >Yes, I
                                        do have things I want to put behind me that will not help solve the
                                        problem</label></li>
                                <li><label><input type="radio" name="validation_1" value="2" {{
                                            (@$verification->validations->validation_1 == 2) ? 'checked' : '' }} >No, I
                                        have nothing to put behind that will not help me solve the problem.</label></li>
                            </ul>
                            <ul style="list-style:none;">
                                <h5>Do you understand that the solution of a problem is given for that problem and does
                                    not include any outside entity that is not needed to solve that problem? </h5>
                                <li><label><input type="radio" name="validation_2" value="1" {{
                                            (@$verification->validations->validation_2 == 1) ? 'checked' : '' }} >Yes, I
                                        understand that the solution of a problem is given for that problem and does not
                                        include any outside entity that is not needed to solve that problem</label></li>
                                <li><label><input type="radio" name="validation_2" value="2" {{
                                            (@$verification->validations->validation_2 == 2) ? 'checked' : '' }} >No, I
                                        do not understand that the solution of a problem is given for that problem and
                                        does not include any outside entity that is not needed to solve that
                                        problem</label></li>
                            </ul>
                            <button type="button" class="btn btn-success" id="saveValidations">Save Validations</button>
                        </form>
                    </div>
                </div>
                <!-- End -->
                @else
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#entityModal"
                     id="">+ Identify Entity Behind</button>
                </div>
                
                @endif

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
                        <h4 class="modal-title">Identify Entity Behind</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <?php 
           
                        $problem_id =  Crypt::encrypt($problem_id);
                        $project_id =  Crypt::encrypt($project_id);
                        $solution_id =  Crypt::encrypt($solution_id);
                    ?>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" value="{{ $project_id }}">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="entity_name">Item name</label>
                            <input name="entity_name" class="form-control" id="entity_name" placeholder="Item Name">
                        </div>
                        <div class="form-group">
                            <label for="put_behind">Put Behind</label>
                            <select name="put_behind"  class="form-control" id="put_behind">
                                <option value="0">Yes</option>
                                <option value="1">No</option>
                            </select>
                        </div>
                       

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btnSave" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- Modal End -->

    
</div>

@endsection
@section('css')


<style>
.centered {
        position: absolute;
        top: 50%;
        left: 45%;
        transform: translate(-50%, -50%);
}
.imgWrap.container {
  position: relative;
  text-align: center;
  color: white;
}
.imgWrap.container ol{
    color: #000;
    font-size: 25px;
}
#black_img img{
    position: relative;
    left:15px;
}
</style>
@endsection
@section('scripts')

<script>

    $('#verification_types').on('change', function () {
        var id = $(this).val();
        window.location.href = "{{ route('adult.varification',@$parameter) }}" + '/' + id;
    })
    


</script>
<script>
    $('.nav-problem').click(function () {
        $(this).attr('href', '');
        localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));
        $(this).attr('href', $('#problem_nav').attr('href'))
    })
    $('.nav-solution').click(function () {
        $(this).attr('href', '');
        localStorage.setItem("sol", $('#solution_nav').attr('href'));
        $(this).attr('href', $('#solution_nav').attr('href'))
    })
    $('.nav-solution-func').click(function () {
        $(this).attr('href', '');
        localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));
        $(this).attr('href', $('#solution_fun_nav').attr('href'))
    })
    $('.verification').click(function () {
        $(this).attr('href', '');
        localStorage.setItem("varification", $('#verification').attr('href'));
        $(this).attr('href', $('#verification').attr('href'))
    })


    $('.dashboard').click(function () {
        //Solution
        $('.nav-solution').attr('href', '');
        localStorage.setItem("sol", $('#solution_nav').attr('href'));
        $('.nav-solution').attr('href', $('#solution_nav').attr('href'))
        //Problem
        $('.nav-problem').attr('href', '');
        localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));
        $('.nav-problem').attr('href', $('#problem_nav').attr('href'))
        //Sol fun
        $('.nav-solution-func').attr('href', '');
        localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));
        $('.nav-solution-func').attr('href', $('#solution_fun_nav').attr('href'))
        //verification
        $('.nav-varification').attr('href', '');
        localStorage.setItem("varification", $('#verification').attr('href'));
        $('.nav-varification').attr('href', $('#solution_fun_nav').attr('href'))

    })

    

    
    $(document).on('click', '#btnSave', function (e) {
        e.preventDefault();
        var fd = new FormData($('#entityForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('adult.visibility_entity_behind_explanation')}}",
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
                $('#btnSave').html('Submit');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {
                if (response.success == false) {
                    $('#btnSave').attr('disabled', false);
                    $('#btnSave').html('Login');
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
    
    $('.editEnityTable').click(function () {
        $('#id').val($(this).data("id"));
        $('#entity_name').val($(this).data("name"));
        $('#put_behind').val($(this).data("put-behind"));
        $('#entityModal').modal('toggle')
    })


    
$(document).ready(function() {
    //set initial state.
    $('#flexCheckDefault').prop('checked', true)
    $('#flexCheckDefault').change(function() {
        if(this.checked) {
           
            $('#items').show();
            $('#black_img').addClass('d-none');
        }else{
            $('#items').hide();
            $('#black_img').removeClass('d-none');
        }
       
    });
});


$(document).on('click', '.deleteEntityAvailable', function (e) {
        e.preventDefault();

        var r = confirm("Are you sure to delete this records");
            if (r == false) {
                return false;
            } 
        var id = $(this).data('id');
        console
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('adult.del_visibility_entity_behind_explanation')}}",
            data: {'id' : id},
            type: 'POST',
            beforeSend: function () {
                $('#btnSave').attr('disabled', true);
                $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSave').attr('disabled', false);
                $('#btnSave').html('Submit');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {
                if (response.success == false) {
                    $('#btnSave').attr('disabled', false);
                    $('#btnSave').html('Login');
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


</script>

@endsection