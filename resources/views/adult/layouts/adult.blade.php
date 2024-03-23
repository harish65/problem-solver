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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
    
    @yield('css')
</head>
<body>
    <div class="pageWrapper">            
        @include('adult.layouts.partials.navbar')
            @yield("content")
        @include('adult.layouts.partials.footer')    
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ asset('assets-new/js/popper.min.js') }}"></script>
<script src="{{ asset('assets-new/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets-new/toastar/toastr.min.js') }}"></script>
<script src="{{asset('assets-new/js/sweetalert.min.js')}}"></script>
<script src="{{ asset('assets-new/js/main.js') }}"></script>
    
        <script>
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
        </script>
@yield('scripts')
<script>
    // $('.modal').on('hidden.bs.modal', function (e) {
    // $(this)
    // .find("input,textarea,select")
    //    .val('')
    //    .end()
    // .find("input[type=checkbox], input[type=radio]")
    //    .prop("checked", "")
    //    .end();
    //     })

</script>
</body>
</html>