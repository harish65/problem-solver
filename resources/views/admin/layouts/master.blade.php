<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>@yield('title') | {{env('APP_NAME', 'Solver')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('assets-new/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/css/style.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-new/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets-new/toastar/toastr.min.css') }}">
    @yield('css')
</head>
<body>
    <div class="pageWrapper">
    @include('admin.layouts.partials.navbar')
        @yield("content")

		@include('admin.layouts.partials.footer')	
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ asset('assets-new/js/popper.min.js') }}"></script>
<script src="{{ asset('assets-new/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets-new/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets-new/toastar/toastr.min.js') }}"></script>

@yield('scripts')
</body>
</html>