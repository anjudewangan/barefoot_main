<?php
session_start();
if(empty($_SESSION['bareid'])){
	header("Location: ./");
}

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

        <!-- Favicon -->
		<link rel="icon" href="./assets/img/logo.png" type="image/x-icon"/>

		<!-- Title -->
		<title>Barefoot | Dashboard</title>

		<?php include "lib/header_link.php"; ?>

	</head>

	<body class="main-body leftmenu">

		<!-- Switcher -->
		
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
								<h2 class="main-content-title tx-24 mg-b-5">Welcome to Dashboard</h2>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Barefoot</li>
								</ol>
							</div>
						</div>
						<!-- End Page Header -->

						<!--Row-->
						<div class="row row-sm">
							<div class="col-sm-12 col-lg-12 col-xl-12">

								
								<!--Row-->
								<div class="row row-sm text">
								
									<div class="col-xl-12">
										<div class="card custom-card">
											<div class="card-body">
												<div class="card-item">
													<div class="card-item-title mb-2 text-center">
														<label class="main-content-label tx-16 font-weight-bold mb-1">Welcome to BAREFOOT Admin</label>
													</div>
													
												</div>
											</div>
										</div>
									</div>
									
									
									
								</div>
								<!--End row-->

								<!--row-->
								
							</div><!-- col end -->
							
						</div><!-- Row end -->

					</div>
				</div>
			</div>
			<!-- End Main Content-->

		<!-- Main Footer-->
			<?php include "lib/footer.php";  ?>
			<!--End Footer-->				<!-- Sidebar -->
			
			<!-- End Sidebar -->		
		</div>
        <!-- End Page -->
		
         <?php include "lib/footer_link1.php";  ?>
	</body>


</html>