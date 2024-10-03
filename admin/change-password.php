<?php
session_start();
if (empty($_SESSION['bareid'])) {
	header("Location: ./");
}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

	<!-- Title -->
	<title>Pinky Princy | Change Password</title>

	<?php include "lib/header_link.php"; ?>

</head>

<body class="main-body leftmenu">

	<!-- Loader -->
	<div id="global-loader">
		<img src="assets/img/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- End Loader -->

	<!-- Page -->
	<div class="page">

		<?php include "lib/sidebar.php"; ?>

		<?php include "lib/header.php"; ?>

		<?php include "lib/mobile_header.php"; ?>

		<!-- Mobile-header closed -->
		<!-- Main Content-->
		<div class="main-content side-content pt-0">
			<div class="container-fluid">
				<div class="inner-body">
					<!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Change Password</h2>
						</div>
					</div>
					<!-- End Page Header -->

					<!-- Row -->
					<div class="row row-sm">
						<div class="col-md-12">
							<div class="card custom-card">
								<div class="card-body">
									<div id="loadpost" class="All-loader" style="display:none">
										<div class="loader"><i class="fa fa-spinner fa-pulse fa-1x"></i></div>
									</div>


									<div class="">
										<div class="row row-sm">
											<div class="col-md-4 form-group">
												<form class="actionForm" method="post" action="query.php">
													<input name="changepass" type="hidden" value="changepass">
													<label>Old Password <sup>*</sup></label>
													<input type="password" maxlength="20" name="cpass" class="form-control" required>
													<p class="Inpt cpass"></p>
													<label>New Password <sup>*</sup></label>
													<input type="password" maxlength="20" name="npass" class="form-control" required>
													<p class="Inpt npass"></p>
													<br />

													<label>Confirm Password <sup>*</sup></label>
													<input type="password" maxlength="20" name="rpass" class="form-control" required>
													<p class="Inpt rpass"></p>
													<button type="submit" class="btn ripple btn-primary pull-right" style="width:137px">Update</button>
												</form>
											</div>
										</div>

									</div>

								</div>
							</div>
						</div>

					</div>
					<!-- End Row -->

				</div>
			</div>
		</div>
		<!-- End Main Content-->

		<?php include "lib/footer.php";  ?>

	</div>
	<!-- End Page -->

	<?php include "lib/footer_link1.php";  ?>

</body>

</html>