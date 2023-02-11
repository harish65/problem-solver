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
    @yield('css')
</head>
<body>
    <div class="pageWrapper">
        @include('adult.layouts.partials.navbar')
            @yield("content")
        @include('adult.layouts.partials.footer')    
    </div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{ asset('assets-new/js/popper.min.js') }}"></script>
<script src="{{ asset('assets-new/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets-new/toastar/toastr.min.js') }}"></script>
@yield('scripts')
</body>
</html>