<?php

require_once(dirname(__DIR__) . '/includes/connection_inner.php');

$today = date("Y-m-d");

//-------Login------------
if (isset($_POST['login'])) {

	if (empty($_POST["user"])) {

		echo json_encode(array("class_name" => 'user', "error" => "Please enter username"));
		exit;
	} elseif (empty($_POST["password"])) {

		echo json_encode(array("class_name" => 'password', "error" => "Please enter password"));
		exit;
	} else {

		$admin_log = $Q_obj->AdminLogin($_POST);

		if (count($admin_log) > 0) {
			$_SESSION['bareid'] = $admin_log[0]['id'];
			$_SESSION['bareuser'] = $admin_log[0]['username'];

			$msg = 'Logging success into admin site, wait for one moment please...';
			echo json_encode(array("class_name" => 'success', "msg" => $msg, "urlpg" => 'dashboard.php'));
			exit;
		} else {
			echo json_encode(array("class_name" => 'user', "error" => "Invalid Username and Password"));
			exit;
		}
	}
}

//-------Login------------
if (isset($_POST['changepass'])) {
	if (empty($_POST["cpass"])) {

		echo json_encode(array("class_name" => 'cpass', "error" => "Please enter current password"));
		exit;
	} elseif (empty($_POST["npass"])) {

		echo json_encode(array("class_name" => 'npass', "error" => "Please enter new password"));
		exit;
	} elseif (empty($_POST["rpass"])) {

		echo json_encode(array("class_name" => 'rpass', "error" => "Please enter confirm password"));
		exit;
	} else {

		$CheckPass = $Q_obj->CurrentPassword($_POST['cpass']);

		if ($CheckPass > 0) {

			if (strlen($_POST['npass']) < 6) {
				echo json_encode(array("class_name" => 'npass', "error" => "Password can not be less than 6 charecters"));
				exit;
			} elseif ($_POST['npass'] != $_POST['rpass']) {
				echo json_encode(array("class_name" => 'rpass', "error" => "New Password does not match"));
				exit;
			} else {
				$Q_obj->AdminPasswordEdit($_POST);
				$msg = 'Password Successfully Updated!';
				echo json_encode(array("class_name" => 'successaccess', "msg" => $msg, "purl" => ''));
				exit;
			}
		} else {
			echo json_encode(array("class_name" => 'cpass', "error" => "Please enter correct old password"));
			exit;
		}
	}
}

//----------Delete--records----------------------
if ($_POST["action"] == "delete" && !empty($_POST["tablname"]) && !empty($_POST["id"])) {
	$response = $Q_obj->getRecords($_POST["tablname"], $_POST["id"]);
	if (count($response) > 0) {
		// Delete the Data file
		$Q_obj->DeleteRecords($_POST["tablname"], $_POST["id"]);
		echo "Deleted Successfully!";
	} else {
		echo 'Something Went Wrong!';
	}
	exit;
}
