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

	<link rel="stylesheet" type="text/css" href="assets/src/plugins/sweetalert2/sweetalert2.css">
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="/">
					<img src="assets/vendors/images/deskapp-logo.svg" alt="">
				</a>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				@yield("content")
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="assets/vendors/scripts/core.js"></script>
	<script src="assets/vendors/scripts/script.min.js"></script>
	<script src="assets/vendors/scripts/process.js"></script>
	<script src="assets/vendors/scripts/layout-settings.js"></script>

    <script src="assets/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<script src="assets/src/plugins/sweetalert2/sweet-alert.init.js"></script>

    @if (\Session::has('success'))
        <script>
            $(document).ready(function(){
                swal({
                    icon: 'success',
                    title: 'Success',
                    text: {!! \Session::get('success') !!},
                });
                
            })
        </script>
    @endif
</body>
</html>