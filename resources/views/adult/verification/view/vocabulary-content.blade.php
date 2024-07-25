@extends('adult.layouts.adult')
@section('title', 'Adult | Solution Type')
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
    @if(@$verification->id)

    <!-- Content Section Start -->
    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>

                    <div class="relationImage text-center">
                        <img src="{{asset('assets-new/verification_types/'.$verificationType->banner)}}" alt="relationImage" />
                    </div>
                    <p>{{ @$verificationType->explanation }}</p>
                </div>
                <!-- start -->
                <div class="principleRelation">
                    <div class="conditionBlock">
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Solution</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        <img class="mx-auto" src=" {{ asset('assets-new/solution/'.$solution->file)}}"
                                            width="100%" height="128px">
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
                            <p class="transitionPhrase">of</p>
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png')}}">
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
                                    <ul class="space">&nbsp;&nbsp;&nbsp;&nbsp;</ul>
                                </div>
                            </div>
                        </div>
                        <div class="long-arrow">
                            <p class="transitionPhrase">{{ $transitionPhrase->name }}</p>
                            <!-- add arrow Image over here -->
                            <img src="{{ asset('assets-new/images/arrowRight.png') }}">
                            <!-- add arrow Image over here -->
                        </div>
                        <div class="blockProblem">
                            <div class="projectBlock text-center">
                                <h2>Verification</h2>
                                <div class="projectList text-center">
                                    <div class="imgWrp">
                                        @if($verification -> type == 0)
                                        @if(strlen($verification -> file) < 15) @if($verification->file == 1)
                                            <img class="mx-auto"
                                                src="{{ asset('assets-new/verification/voucablary/1vocabulary.png')}}"
                                                width="100%" height="128px">
                                            @else
                                            <img class="mx-auto"
                                                src="{{ asset('assets-new/verification/voucablary/2vocabulary.png')}}"
                                                width="100%" height="128px">
                                            @endif

                                            @endif
                                            @elseif($verification -> type == 1)
                                            <video class="mx-auto" controls="controls" preload="metadata" width="100%"
                                                height="128px" preload="metadata">
                                                <source src="{{ asset(" assets-new/verification/" . $verification ->
                                                file) }}#t=0.1" type="video/mp4">
                                            </video>
                                            @elseif($verification -> type == 2)
                                            <iframe class="mx-auto" src="{{ $verification -> file }}" width="100%"
                                                height="128px"> </iframe>
                                            @endif
                                    </div>
                                    <p class="redText">{{ $verification->name }}</p>
                                </div>
                                <div class="projectList">
                                    <p class="date">{{ date('d/m/Y' , strtotime($verification->created_at)) }}</p>
                                    <ul>
                                        <li>
                                            <a href="javaScript:Void(0)" class="editverBtn">
                                                <img src="{{ asset('assets-new/images/editIcon.png') }}" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $verification->id }}" class="deleteverBtn" title="Delete">
                                                <img src="{{ asset('assets-new/images/deleteIcon.png') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="{{ asset('assets-new/images/uploadIcon.png') }}"
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
                            <div class="title d-flex">
                                <div class="text-left w-50 ">
                                    <h2>Vacabulary</h2>
                                </div>
                                <div class="text-right w-50 pt-3">
                                    <button type="button" class="btn btn-success addVocabularyBtn"
                                        id="add-new-variant">+ Add New</button>
                                </div>
                            </div>

                            <div class="entity">
                                <table class="table slp-tbl text-center">
                                    <thead>
                                        <th>Word</th>
                                        <th> </th>
                                        <th>Actual Entity</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($entity as $ent)
                                        <tr>

                                            <td>{{ $ent->verification_key }}</td>
                                            <td>
                                                <span>{{ ($ent->point_to == 'to') ? 'Point to' : 'Not Point to'}}</span>
                                                <br>
                                                <img src="{{ asset('assets-new/images/arrowRight.png') }}" width="80"
                                                    height="25">
                                            </td>
                                            <td>{{ $ent->verification_value }}</td>
                                            <td>
                                                <a href="javaScript:Void(0)" class="addVocabularyBtn">
                                                    <img src="{{ asset('assets-new/images/add-verification.png')}}"
                                                        alt="">
                                                </a>
                                                <a href="javaScript:Void(0)" data-id="{{ $ent->id }}"
                                                    class="deleteVoucablaryBtn">
                                                    <img src="{{ asset('assets-new/images/deleteIcon.png')}}" alt="">
                                                </a>
                                                <a href="javaScript:Void(0)" class="editVocabularyBtn"
                                                    data-id="{{ $ent->id }}" data-key="{{ $ent->verification_key }}"
                                                    data-value="{{ $ent->verification_value }}""
                                                        data-point_to="{{ $ent->point_to }}"
                                                    >
                                                    <img src="{{ asset('assets-new/images/editIcon.png')}}" alt="">
                                                </a>

                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h2>Validation Question</h2>
                        <form id="validation_form">
                            <ul class="validate_que">

                                <br>
                                <h5>Do I use any word that does not me solve the identified problem?</h5>
                                <input type="hidden" name="id" value="{{ $verification->id }}">
                                <li><label><input type="radio" data-id="{{ $verification->id  }}" {{
                                            (@$verification->validations->validation_1 == 1) ? 'checked' : '' }}
                                        name="validation_1" class="form-check-input validation" value="1">Yes, I use
                                        words that does not help me solve the problem</label> </li>
                                <li><label><input type="radio" data-id="{{ $verification->id  }}" {{
                                            (@$verification->validations->validation_1 == 2) ? 'checked' : '' }}
                                        name="validation_1" class="form-check-input validation" value="2">No, I don't
                                        use any word that does not help me solve the problem</label> </li>
                                <br>
                                <h5>Does each word from the vocabulary match to actual entity that enables solving the
                                    problem?</h5>
                                <li><label><input type="radio" data-id="{{ $verification->id  }}" {{
                                            (@$verification->validations->validation_2 == 1) ? 'checked' : '' }}
                                        name="validation_2" class="form-check-input validation" value="1"> Yes, each
                                        word from the vocabulary matches to actual entity that enables me to solve the
                                        problem</label></li>
                                <li><label><input type="radio" data-id="{{ $verification->id  }}" {{
                                            (@$verification->validations->validation_2 == 2) ? 'checked' : '' }}
                                        name="validation_2" class="form-check-input validation" value="2"> No, some
                                        words I used in my vocabulary does not match to actual entity that enables me to
                                        solve the problem</label></li>
                                <br>
                                <h5> Do you understand that the solution of a problem is given with its own vocabulary
                                    and does not include any word that does not help solve the problem?</h5>
                                <li><label><input type="radio" data-id="{{ $verification->id  }}" {{
                                            (@$verification->validations->validation_3 == 1) ? 'checked' : '' }}
                                        name="validation_3" class="form-check-input validation" value="1"> Yes, I
                                        understand that the solution of a problem is given with its own vocabulary and
                                        does not include any word that does not help me solve the problem</label></li>
                                <li><label><input type="radio" data-id="{{ $verification->id  }}" {{
                                            (@$verification->validations->validation_3 == 2) ? 'checked' : '' }}
                                        name="validation_3" class="form-check-input validation" value="2"> No, I do not
                                        understand that the solution of a problem is given with its own vocabulary and
                                        does not include any word that does not help me solve the problem</label></li>
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
    @include('adult.verification.modal.voucablary.entity.create')
    @include('adult.verification.modal.voucablary.delete-verification')
    @include('adult.verification.modal.voucablary.edit-verification')
    <?php $showMessage =  false; ?>
    @else

    <div class="relationshipContent">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ @$verificationType->page_main_title }}</h1>
                    <div class="relationImage text-center">
                        <img src="{{ asset('assets-new/verification_types/' . @$verificationType->banner)}}"
                        alt="relationImage" />
                    </div>

                </div>
                <div class="col-sm-12">
                    <button class="btn btn-success" id="add-varification-button"><i class="fa fa-plus"></i> Create
                        Verificatoin</button>
                </div>
            </div>
        </div>

    </div>


    @include('adult.verification.modal.voucablary.add-verification')
    @endif
    <!-- Modal End -->
</div>

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .image {
        margin: 20px;
        text-align: center;
        border: 2px solid;
        padding: 14px;
        border-radius: 5px;
        background: #eee;
    }

    .image img {
        border-radius: 5px;
    }

    .validate_que {
        list-style: none;
    }
</style>
@endsection
@section('scripts')

<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<script>

    $('#verification_types').on('change', function () {
        var id = $(this).val();
        window.location.href = "{{ route("adult.varification",@$parameter) }}" + '/' + id;
    })
    $('.dropify').dropify();


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

    //Update Validations

    $('#saveValidations').on('click', function () {
        var problem = $(this).attr('data-id');
        var fd = new FormData($('#validation_form')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('adult.add-vocabulary-validations')}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function () {
                $('#validation').attr('disabled', true);
                $('#validation').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#validation').attr('disabled', false);
                $('#validation').html('Save Validations');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {
                if (response.success == false) {
                    $('#validation').attr('disabled', false);
                    $('#validation').html('Save Validations');
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
    })

    $('#add-varification-button').click(function () {
        if ($('#verification_types').val() == '') {
            toastr.error('Please select verification type first');
            return false;
        }

        $('#createVerification').modal('toggle')
    })



    //onchange File
    $('#file').change(function () {
        var file = $('option:selected', this).data('src');

        if (file) {
            $('#default-image').removeClass('d-none').html('<img  src=' + file + ' width="200" height="200">')
        } else {
            $('#default-image').addClass('d-none').html('')
        }

    })

    //.editSolFunBtn

    $('.editverBtn').click(function () {

        $('#editVerification').modal('toggle')
    })

    // .deleteverBtn
    $('.deleteverBtn').click(function () {
        $('#deleteVerification').modal('toggle')
    })

    // .addVocabularyBtn
    $('.addVocabularyBtn').click(function () {
        // $('#addVocabularyForm').trigger('reset');
        $('#addVocabularyForm')[0].reset();
        $('#addVocabulary').modal('toggle')
    })



    // .editVocabularyBtn
    $('.editVocabularyBtn').click(function () {
        $('#key').val($(this).attr('data-key'))
        $('#value').val($(this).attr('data-value'))
        $('#point_to').val($(this).attr('data-point_to'))
        $('#id').val($(this).attr('data-id'))
        $('#addVocabulary').modal('toggle')
    })
    $(document).on('click', '#btnSave', function (e) {
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


    ////////////////////////////////////////////


    $('#btnUpdate').click(function (e) {
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
                    //  if(response.data.params != '' && typeof response.data.params  != 'undefined'){
                    //     window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params 
                    //  }else{



                    // window.location.href = "{{ route('adult.dashboard')}}"
                    //  }

                }
            }
        });
    });

    $('#btnDelete').click(function (e) {
        e.preventDefault();
        var dv = new FormData($('#deleteVerificationForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('adult.delete-verification')}}",
            data: dv,
            processData: false,
            contentType: false,
            dataType: 'json',
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
                    location.reload();
                }
            }
        });

    });

    $('#btnSaveEntity').click(function (e) {
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
            beforeSend: function () {
                $('#btnSaveEntity').attr('disabled', true);
                $('#btnSaveEntity').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function (xhr, status, error) {
                $('#btnSaveEntity').attr('disabled', false);
                $('#btnSaveEntity').html('Save changes');
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {
                if (response.success == false) {
                    $('#btnSaveEntity').attr('disabled', false);
                    $('#btnSaveEntity').html('Save changes');
                    var errors = response.data;
                    $.each(errors, function (key, value) {
                        toastr.error(value)
                    });
                } else {

                    toastr.success(response.message);
                    location.reload();
                }
            }
        });

    });


    $('#btnDeleteVocab').click(function (e) {
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
                    location.reload();
                }
            }
        });

    });

    $('#btnEditSaveEntity').click(function (e) {
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
                    //  if(response.data.params != '' && typeof response.data.params  != 'undefined'){
                    //     window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params 
                    //  }else{



                    // window.location.href = "{{ route('adult.dashboard')}}"
                    //  }

                }
            }
        });
    });
    $(document).on('click', '.deleteVoucablaryBtn', function (e) {
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
            url: "{{route('adult.delete-vocabulary')}}",
            data: { id: id },

            type: 'POST',
            error: function (xhr, status, error) {
                $.each(xhr.responseJSON.data, function (key, item) {
                    toastr.error(item);
                });
            },
            success: function (response) {

                if (response.success == false) {
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
    var text_ = 'The solution of a problem is given with its own vocabulary.  If the problem has not been identified as well as its solution, then the vocabulary of that solution is not present.  Please, identify the problem ant the solution in order to verify the vocabulary for the solution.'
    if (showMessage) {
        //   function showMessage (){  
        swal({
            title: "Vocabulary",
            text: text_,
            type: "Error",
            showCancelButton: true,
            confirmButtonColor: '#00A14C',
        });
    }
    // }
</script>

@endsection