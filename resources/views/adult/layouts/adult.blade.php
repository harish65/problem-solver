<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>@yield('title') | {{env('APP_NAME', 'Solver')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-new/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-new/toastar/toastr.min.css') }}">
    <link href="{{ asset('assets-new/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-new/css/sweetalert.css') }}" rel="stylesheet" />
    
    @yield('css')
</head>
<body>

    <div class="pageWrapper">            
        @include('adult.layouts.partials.navbar')
        
            @yield("content")
           
        @include('adult.layouts.partials.footer')    
    </div>
    <script src="{{ asset('assets-new/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-new/toastar/toastr.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/sweetalert.min.js')}}"></script>
    <script src="{{ asset('assets-new/js/main.js') }}"></script>
        <script>
            //verification
            $('#saveValidations').on('click',function(){
                var fd = new FormData($('#validation_form')[0]);
                $.ajaxSetup({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    }); 
                $.ajax({
                url: "{{route('adult.update_validations')}}",
                data: fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function(){
                    $('#validation').attr('disabled',true);
                    $('#validation').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                },
                error: function (xhr, status, error) {
                    $('#validation').attr('disabled',false);
                    $('#validation').html('Save Validations');
                    $.each(xhr.responseJSON.data, function (key, item) {
                        toastr.error(item);
                    });
                },
                success: function (response){
                    if(response.success == false)
                    {
                        $('#validation').attr('disabled',false);
                        $('#validation').html('Save Validations');
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
        })
        //Relationships
        $('#btn_save_validations').on('click',function(){
                var fdat = new FormData($('#rel_val_form')[0]);
                
                $.ajaxSetup({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    }); 
                $.ajax({
                url: "{{route('adult.save-rel-validations')}}",
                data: fdat,
                processData: false,
                contentType: false,
                dataType: 'json',
                type: 'POST',
                beforeSend: function(){
                    $('#btn_save_validations').attr('disabled',true);
                    $('#btn_save_validations').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                },
                error: function (xhr, status, error) {
                    $('#btn_save_validations').attr('disabled',false);
                    $('#btn_save_validations').html('Save Validations');
                    $.each(xhr.responseJSON.data, function (key, item) {
                        toastr.error(item);
                    });
                },
                success: function (response){
                    if(response.success == false)
                    {
                        $('#btn_save_validations').attr('disabled',false);
                        $('#btn_save_validations').html('Save Validations');
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
        })
       
        </script>
        <script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
    };

    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if (session('info'))
        toastr.info("{{ session('info') }}");
    @endif

    @if (session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
    
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
      
@yield('scripts')
<script>
let currentQuestionIndex = 0;

function showQuestion(index) {
    $('.question-block_student').removeClass('active');
    $(`.question-block_student[data-index="${index}"]`).addClass('active');
}

$(document).ready(function () {
    showQuestion(currentQuestionIndex);

    $('#nextBtnMcq').click(function () {
        let total = $('.question-block_student').length;
        if (currentQuestionIndex < total - 1) {
            currentQuestionIndex++;
            showQuestion(currentQuestionIndex);
        }
    });

    $('#prevBtnMcq').click(function () {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            showQuestion(currentQuestionIndex);
        }
    });
});
function validateQuestions() {
    let isValid = true;
    $('.question-block_student').each(function (index) {
        const selected = $(this).find(`input[type="radio"]:checked`).length;
        if (!selected) {
            isValid = false;
            $(this).addClass('border border-danger');
        } else {
            $(this).removeClass('border border-danger');
        }
    });
    return isValid;
}
$('#submitBtnMcq').on('click', function (e) {
    e.preventDefault(); // Prevent default form submission
    if (!validateQuestions()) {
        toastr.error("Please answer all questions before submitting.");
        return;
    }
    // Optional: Submit form via AJAX or let native form submission handle it
    $('form').submit(); // Adjust if your form has a different structure
});
</script>

</body>
</html>