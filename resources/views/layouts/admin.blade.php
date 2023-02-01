<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>@yield('title') | {{env('APP_NAME', 'Solver')}}</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/vendors/images/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/vendors/images/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/vendors/images/favicon-16x16.png') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/styles/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropify.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/styles/custom.css') }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/sweetalert2/sweetalert2.css') }}">

	{{-- JQUERY --}}
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
</head>
<body>
    <div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="{{ asset("assets/vendors/images/avatar/" . Auth::user() -> avatar) }}" alt="">
						</span>
						<span class="user-name">{{ Auth::user() -> name }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="{{ url("profile") }}"><i class="dw dw-user1"></i> Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="dw dw-logout"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>

	

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{ url("home") }}">
				<img src="{{ url("/") }}/assets/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="{{ url("/") }}/assets/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="{{ url("adminHome") }}" class="dropdown-toggle no-arrow {{ Route::is("adminHome") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-home"></span><span class="mtext">Home</span>
						</a>
					</li>
					<li>
						<a href="{{ url("project") }}" class="dropdown-toggle no-arrow {{ Route::is("project") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-list"></span><span class="mtext">Projects</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminUser") }}" class="dropdown-toggle no-arrow {{ Route::is("adminUser") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-user"></span><span class="mtext">User Manage</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminProblem") }}" class="dropdown-toggle no-arrow {{ Route::is("adminProblem") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-analytics-6"></span><span class="mtext">Problem Manage</span>
						</a>
					</li>
					{{-- <li>
						<a href="{{ url("adminSolutionType") }}" class="dropdown-toggle no-arrow {{ Route::is("adminSolutionType") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-analytics-14"></span><span class="mtext">Solution Type Manage</span>
						</a>
					</li> --}}
					<li>
						<a href="{{ url("adminSolution") }}" class="dropdown-toggle no-arrow {{ Route::is("adminSolution") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-shopping-bag"></span><span class="mtext">Solution Manage</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminSolFunction") }}" class="dropdown-toggle no-arrow {{ Route::is("adminSolFunction") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-key3"></span><span class="mtext">Sol Function Manage</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminVerificationType") }}" class="dropdown-toggle no-arrow {{ Route::is("adminVerificationType") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-key3"></span><span class="mtext">Verification Type</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminVerificationTypeText") }}" class="dropdown-toggle no-arrow {{ Route::is("adminVerificationTypeText") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-key3"></span><span class="mtext">Verification Type Text</span>
						</a>
					</li>

					
					<li>
						<a href="#submenu2" data-bs-toggle="collapse" class="dropdown-toggle">
							<span class="micon icon-copy dw dw-key3"></span><span class="mtext">Permissions</span>
						</a>
						<ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu" style="padding-left:30%">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="fa fa-circle"> &nbsp; Roles</span></a>
                            </li>
                            <li>
                                <a href="{{ route("admin.permission.index") }}" > <span class="fa fa-circle"> &nbsp; Permissions</span></a>
                            </li>
                        </ul>
					</li>
					
					
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">

		@yield("content")

          {{--  <div class="footer-wrap pd-20 mb-20 card-box">
                {{env('APP_NAME', 'Solver')}} by <a href="https://google.com" target="_blank">Mikhail Letov</a>
            </div> --}}
        </div>
	</div>
	
	<!-- js -->
	<script src="{{ asset('assets/vendors/scripts/core.js')}}"></script>
	<script src="{{ asset('assets/vendors/scripts/script.min.js')}}"></script>
	<script src="{{ asset('assets/vendors/scripts/process.js')}}"></script>
	<script src="{{ asset('assets/vendors/scripts/layout-settings.js')}}"></script>

	{{-- DROPIFY --}}
	<script src = https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js></script>
	
	{{-- SWEETALERT --}}
	<script src="{{ asset('assets/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
	<script src="{{ asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>
	@if (\Session::has('success'))
		<script>
			$(document).ready(function(){
				swal({
					icon: 'success',
					title: 'Success',
					text: '{!! \Session::get('success') !!}',
				});
				
			})
		</script>
	@endif
</body>
</html>