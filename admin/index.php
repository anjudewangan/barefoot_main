<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

	<!-- Favicon -->
	<link rel="icon" href="../assets/images/logo/favicon.webp" type="image/x-icon" />

	<!-- Title -->
	<title>Login | Barefoot</title>

	<!-- Bootstrap css-->
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Style css-->
	<link href="assets/css/style.css" rel="stylesheet">
	<!-- Color css-->
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="assets/css/colors/color.css">

</head>

<body class="main-body leftmenu">

	<!-- Switcher -->


	<!-- Loader -->
	<div id="global-loader">
		<img src="./assets/img/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->


	<!-- Page -->
	<div class="page main-signin-wrapper">

		<!-- Row -->
		<div class="row signpages text-center">
			<div id="loadpost" class="All-loader" style="display:none">
				<div class="loader"><i class="fa fa-spinner fa-pulse fa-1x"></i></div>
			</div>
			<div class="col-md-12 success">
				<div class="card">
					<div class="row row-sm">
						<div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
							<div class="mt-5 pt-5 p-2 pos-absolute">
								<div class="clearfix"></div>
								<img src="../assets/images/logo/logo1.webp" class="mb-0" alt="user">
							</div>
						</div>
						<div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
							<div class="container-fluid">

								<div class="row row-sm">
									<div class="card-body mt-2 mb-2">
										<img src="../assets/images/logo/logo.webp" class=" d-lg-none header-brand-img text-left float-left mb-4" alt="logo" style="width:100px;">
										<div class="clearfix"></div>
										<form class="form-action" method="post" action="query.php">
											<input name="login" type="hidden" value="login">
											<h5 class="text-left mb-2">Signin to Your Account</h5>
											<div class="form-group text-left">
												<label>User name</label>
												<input class="form-control" maxlength="30" name="user" placeholder="Enter your User name" type="text">
												<span style="color:#ff0000;" class="Inpt user"></span>
											</div>
											<div class="form-group text-left">
												<label>Password</label>
												<input class="form-control" maxlength="30" name="password" placeholder="Enter your password" type="password">
												<span style="color:#ff0000;" class="Inpt password"></span>
											</div>
											<button type="submit" class="btn ripple btn-main-primary btn-block">Sign In</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->

	</div>
	<!-- End Page -->

	<!-- Jquery js-->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- Custom js -->
	<script src="assets/js/custom.js"></script>
	<script src="assets/js/login.js"></script>

</body>

</html>