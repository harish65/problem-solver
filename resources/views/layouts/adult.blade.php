<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>@yield('title') | {{env('APP_NAME', 'Solver')}}</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="assets/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="assets/src/styles/custom.css">

	<link rel="stylesheet" type="text/css" href="assets/src/styles/custom.css">
	<link rel="stylesheet" type="text/css" href="assets/css/dropify.css">

	<link rel="stylesheet" type="text/css" href="assets/src/plugins/sweetalert2/sweetalert2.css">

	{{-- JQUERY --}}
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 </head>
<body>
    <div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<i class="dw dw-settings2"></i>
					</a>
				</div>
			</div>
			
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src='{{ asset("assets/vendors/images/avatar/" . Auth::user() -> avatar) }}' alt="">
						</span>
						<span class="user-name">{{ Auth::user() -> name }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href='{{ url("profile") }}'><i class="dw dw-user1"></i> Profile</a>
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

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{ url("home") }}">
				<img src="assets/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="assets/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href='{{ url("adultHome") }}' class="dropdown-toggle no-arrow 
										{{ Route::is("adultHome") ? 'active' : '' }}
										
						">
							<span class="micon icon-copy dw dw-home"></span><span class="mtext">Home</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adultAbout") }}" class="dropdown-toggle no-arrow {{ Route::is("adultAbout") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-analytics-11"></span><span class="mtext">About</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adultShare") }}" class="dropdown-toggle no-arrow {{ Route::is("adultShare") ? 'active' : '' }}">
							<span class="micon icon-copy ti-sharethis"></span><span class="mtext">Share</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adultQuiz") }}" class="dropdown-toggle no-arrow {{ Route::is("adultQuiz") ? 'active' : '' }}">
							<span class="micon icon-copy ti-help"></span><span class="mtext">Quiz</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adultSetting") }}" class="dropdown-toggle no-arrow {{ Route::is("adultSetting") ? 'active' : '' }}">
							<span class="micon icon-copy ti-settings"></span><span class="mtext">Setting</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10 pb-10">

		@yield("content")

        
        </div>
		<div class="mt-auto" id="navbar">
			<div class="btn-group w-100" style="border-radius: 0">
				<a href="{{ url("adultProblem") }}" class="btn btn-primary btn-border-none {{ Route::is("adultProblem") ? 'active' : '' }}">	
					<span class="icon-copy ti-target"></span><br><span id="problemTab"></span>
				</a>
				<a href="{{ url("adultSolution") }}" class="btn btn-primary btn-border-none {{ Route::is("adultSolution") ? 'active' : '' }}">	
					<span class="icon-copy ti-thought"></span><br><span id="solutionTab"></span>
				</a>
				<a href="{{ url("adultSolFunction") }}" class="btn btn-primary btn-border-none {{ Route::is("adultSolFunction") ? 'active' : '' }}">	
					<span class="icon-copy dw dw-key3"></span><br><span id="solFunctionTab"></span>
				</a>
				<a href="{{ url("adultVerification?type=1") }}" class="btn btn-primary btn-border-none {{ Route::is("adultVerification") ? 'active' : '' }}">	
					<span class="icon-copy ti-layout-cta-center"></span><br><span id="verificationTab"></span>
				</a>
				<a href="{{ url("adultRelationship") }}" class="btn btn-primary btn-border-none {{ Route::is("adultRelationship") ? 'active' : '' }}">	
					<span class="icon-copy ti-infinite"></span><br><span id="relationshipTab"></span>
				</a>
				<a href="{{ url("adultReport") }}" class="btn btn-primary btn-border-none {{ Route::is("adultReport") ? 'active' : '' }}">	
					<span class="icon-copy ti-pencil-alt"></span><br><span id="reportTab"></span>
				</a>
				<a href="{{ url("adultResult") }}" class="btn btn-primary btn-border-none {{ Route::is("adultResult") ? 'active' : '' }}">	
					<span class="icon-copy ti-save-alt"></span><br><span id="resultTab"></span>
				</a>
			  </div>
		</div>
	</div>

	<!-- js -->
	<script src="assets/vendors/scripts/core.js"></script>
	<script src="assets/vendors/scripts/script.js"></script>
	<script src="assets/vendors/scripts/process.js"></script>
	<script src="assets/vendors/scripts/layout-settings.js"></script>

	{{-- DROPIFY --}}
	<script src = https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js></script>

	{{-- SWEETALERT --}}
	<script src="assets/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<script src="assets/src/plugins/sweetalert2/sweet-alert.init.js"></script>
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

	@if (\Session::has('warning'))
		<script>
			$(document).ready(function(){
				swal({
					icon: 'warning',
					title: 'Warning',
					text: '{!! \Session::get('warning') !!}',
				});
				
			})
		</script>
	@endif
</body>
</html>