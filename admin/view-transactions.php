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
    <title>Barefoot | Manage Transactions</title>

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
                            <h2 class="main-content-title tx-24 mg-b-5">Manage Transactions</h2>
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
                                                    <th>Age</th>
                                                    <th>Gender</th>
                                                    <th>Course</th>
                                                    <th>Course Plan</th>
                                                    <th>Payment Method</th>
                                                    <th>Amount</th>
                                                    <th>Transaction ID</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Location</th>
                                                    <th>Attended Classes</th>
                                                    <th>Hear About</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $rsData = $Q_obj->Transaction_List();
                                                if (count($rsData) > 0) {
                                                    foreach ($rsData as $record) {
                                                ?>
                                                        <tr>
                                                            <td><?= $record['id']; ?></td>
                                                            <td><?php echo $record['name']; ?></td>
                                                            <td><?php echo $record['age']; ?></td>
                                                            <td><?php echo $record['gender']; ?></td>
                                                            <td><?php echo $record['course']; ?></td>
                                                            <td><?php echo $record['course_plan']; ?></td>
                                                            <td><?php echo $record['payment_method']; ?></td>
                                                            <td>₹<?php echo $record['amount']; ?></td>
                                                            <td class="text-center"><?php echo ($record['payment_id']) ? $record['payment_id'] : '-'; ?></td>
                                                            <td><?php echo $record['email']; ?></td>
                                                            <td><?php echo $record['phone_no']; ?></td>
                                                            <td><?php echo $record['location']; ?></td>
                                                            <td><?php echo $record['attended_classes']; ?></td>
                                                            <td><?php echo $record['hear_about']; ?></td>
                                                            <td><?php echo $record['created_at']; ?></td>
                                                            <td><?php
                                                                if ($record['status'] == 'captured') {
                                                                    echo '<div style="background-color:#19b159;color:#fff;text-align:center">' . ucwords($record['status']) . '</div>';
                                                                } else {
                                                                    echo '<div style="background-color:#f16d75;color:#fff;text-align:center">' . ucwords($record['status']) . '</div>';
                                                                }
                                                                ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
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