<?php
require_once('../includes/connection_inner.php');

if (empty($_SESSION['bareid'])) {
	header("Location: ./");
}

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

	<!-- Title -->
	<title>Barefoot | Manage Contact</title>

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
							<h2 class="main-content-title tx-24 mg-b-5">Manage Contact</h2>
						</div>
					</div>
					<!-- End Page Header -->

					<!-- Row -->
					<div class="row row-sm">
						<div class="col-lg-12">
							<div class="card custom-card overflow-hidden">
								<div class="card-body">

									<div class="table-responsive">
										<table class="table table-bordered text-nowrap" id="example1">
											<thead>
												<tr>
													<th>ID#</th>
													<th>Name</th>
													<th>Email</th>
													<th>Message</th>
													<th>Date</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$rsData = $Q_obj->Contact_List();
												if (count($rsData) > 0) {
													foreach ($rsData as $record) {
												?>
														<tr>
															<td><?= $record['id']; ?></td>
															<td><?php echo $record['name']; ?></td>
															<td><?php echo $record['email']; ?></td>
															<td><?php echo wordwrap(limitDescription(strip_tags($record['message']), 1000), 100, "<br>"); ?></td>
															<td><?= date("d M, Y", strtotime($record['created_at'])); ?></td>
															<td>
																<div class="btn-icon-list">
																	<a style="cursor:pointer;" onclick="return deleteconfig('<?= $record['id']; ?>','contacts')" class="btn btn-danger btn-icon"><i class="fa fa-trash"></i></a>
																</div>
															</td>
														</tr>
												<?php }
												} ?>


											</tbody>
										</table>
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

		<?php include "lib/footer.php"; ?>

	</div>
	<!-- End Page -->

	<!-- Back-to-top -->

	<?php include "lib/footer_link.php"; ?>

</body>

</html>