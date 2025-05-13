@extends('adult.layouts.adult')
@section('title', 'Home | Admin')

@section('content')
@php
$showMessage = false;
$can_edit = \App\Models\Project::SharedProject($project->id , Auth::user()->id);
$problems = null;
@endphp
@php

$problems = \App\Models\Problem::GetAllProblemsOfProject($project->id);
@endphp
<div class="container">
    <div class="row spl-row">
        <h4>Problem</h4>
    </div>
    <div class="row spl-row-second">
        <div class="col-md-6">
            <h4>TITLE FOR EXPLANTION</h4>
        </div>
    </div>
    <div class="banner text-center">
        <img src="{{ asset('/assets-new/images/problem.png') }}" width="666px" height="213px">
    </div>
    <div class="row pt-5">
        <p>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit
        </p>
    </div>


    <div class="row pt-5">
        @include('adult.quiz.quiz-component' , [$project->id , 1001 , 'problem'])
    </div>
    @if($project->shared == 1 && $can_edit != null && $can_edit->editable_project == 1)
    @include('adult.problem.Editable_mode' , [$problem , $project , $can_edit])
    @else
    @include('adult.problem.Readonly_mode' , [$problem , $project , $can_edit])
    @endif
</div>
@include('adult.problem.modal.add-problem',[$projectID])
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<style>
    .delProblemBtn {
        cursor: pointer;
    }

    p.redText {
        margin-top: 10px;
    }
</style>
<style>
    .delProblemBtn {
        cursor: pointer;
    }
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>

<script>
    $('.dropify').dropify();
    $(".updateProblemType").change(function() {
        var type = $(this).val();

        if (type == 0) {
            $("#updateProblemType").val("0");
            $("#updateProblemFileType").css("display", "block");
            $("#updateProblemLinkType").css("display", "none");

        } else if (type == 2) {
            $("#updateProblemType").val("2");
            $("#updateProblemFileType").css("display", "none");
            $("#updateProblemLinkType").css("display", "block");

        }
    });
    $(document).on('click', '#btnUpadteProblem', function(e) {
        e.preventDefault();
        var fd = new FormData($('#updateProlemForm')[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('adult.store-problem')}}",
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            type: 'POST',
            beforeSend: function() {
                $('#btnUpadteProblem').attr('disabled', true);
                $('#btnUpadteProblem').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            error: function(xhr, status, error) {
                $('#btnUpadteProblem').attr('disabled', false);
                $('#btnUpadteProblem').html('Submit');
                $.each(xhr.responseJSON.data, function(key, item) {
                    toastr.error(item);
                });
            },
            success: function(response) {
                if (response.success == false) {
                    $('#btnUpadteProblem').attr('disabled', false);
                    $('#btnUpadteProblem').html('Login');
                    var errors = response.data;
                    $.each(errors, function(key, value) {
                        toastr.error(value)
                    });
                } else {

                    toastr.success(response.message);
                    if (response.data.params != '' && typeof response.data.params != 'undefined') {
                        window.location.href = "{{ route('adult.problem', )}}" + '/' + response.data.params
                    } else {
                        window.location.href = "{{ route('adult.dashboard')}}"
                    }

                }
            }
        });
    });
</script>
<script>
    $(document).on('click', '.delProblemBtn', function(e) {
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
            url: "{{route('adult.delete-problem')}}",
            data: {
                id: id
            },

            type: 'POST',
            error: function(xhr, status, error) {
                $.each(xhr.responseJSON.data, function(key, item) {
                    toastr.error(item);
                });
            },
            success: function(response) {

                if (response.success == false) {
                    var errors = response.data;
                    $.each(errors, function(key, value) {
                        toastr.error(value)
                    });
                } else {
                    toastr.success(response.message);
                    window.location.href = "{{ route('adult.dashboard')}}"
                }
            }
        });
    });
</script>
<script>
    $(".editProblemBtn").click(function() {

        $("#updateProblemId").val($(this).data("id"));
        $("#updateProblemName").val($(this).data("name"));
        $('#category_id').val($(this).attr('data-cat'))
        $('#actual_problrm_name').val($(this).data("actual_problrm_name"))
        if ($(this).data("type") == 2) {
            $("#updateProblemType").val("2");
            $("#updateProblemFileType").css("display", "none");
            $("#updateProblemLinkType").css("display", "block");

            $("#updateProblemFileRadio").attr("checked", false);
            $("#updateProblemLinkRadio").attr("checked", true);

            $("#updateProblemLinkFile").val($(this).data("file"));

        } else {
            $("#updateProblemType").val("0");
            $("#updateProblemFileType").css("display", "block");
            $("#updateProblemLinkType").css("display", "none");

            $("#updateProblemFileRadio").attr("checked", true);
            $("#updateProblemLinkRadio").attr("checked", false);

            if ($(this).file != "") {
                var file = $(this).data("file");
                var drEvent = $('#updateProblemFileFile').dropify({
                    defaultFile: "/assets-new/problem/" + file
                });
                drEvent = drEvent.data('dropify');
                drEvent.resetPreview();
                drEvent.clearElement();
                drEvent.settings.defaultFile = "/assets-new/problem/" + file;
                drEvent.destroy();
                drEvent.init();
            }

        }

        $("#add-problem-modal").modal("show");
    });
    //Update Validations

    $('.validation').on('change', function() {
        var problem = $(this).attr('data-id');
        var validation = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('adult.validation')}}",
            data: {
                data: problem,
                value: validation
            },
            type: 'POST',
            success: function(response) {
                console.log(response)
            }

        })
    })

    $('.nav-problem').click(function() {
        $(this).attr('href', '');
        localStorage.setItem("selected_problem", $('#problem_nav').attr('href'));
        $(this).attr('href', $('#problem_nav').attr('href'))
    })
    $('.nav-solution').click(function() {
        $(this).attr('href', '');
        localStorage.setItem("sol", $('#solution_nav').attr('href'));
        $(this).attr('href', $('#solution_nav').attr('href'))
    })
    $('.nav-solution-func').click(function() {
        $(this).attr('href', '');
        localStorage.setItem("sol-fun", $('#solution_fun_nav').attr('href'));
        $(this).attr('href', $('#solution_fun_nav').attr('href'))
    })

    $('.nav-verification').click(function() {
        $(this).attr('href', '');
        localStorage.setItem("varification", $('#verification').attr('href'));
        $(this).attr('href', $('#verification').attr('href'))
    })

    $('.nav-relationship').click(function() {
        $(this).attr('href', '');
        localStorage.setItem("relationship", $('#relationship').attr('href'));
        $(this).attr('href', $('#relationship').attr('href'))
    })


    $('.dashboard').click(function() {
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
        //Relation
        $('.nav-relationship').click(function() {
            $(this).attr('href', '');
            localStorage.setItem("relationship", $('#relationship').attr('href'));
            $(this).attr('href', $('#relationship').attr('href'))
        })
    })

    function saveValidations() {
        toastr.success('Validations Saved');
        location.reload();

    }



    $('#view_problem').on('change', function() {
        var id = $(this).val();
        window.location.href = "{{ route('adult.problem') }}" + '/' + id;
    })
</script>
@endsection