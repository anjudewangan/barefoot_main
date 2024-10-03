<?php
session_start();
if (isset($_SESSION['bareuser']) && isset($_SESSION['bareid'])) {
	unset($_SESSION["bareid"]);
	unset($_SESSION['bareuser']);
	header("Location: ./");
} else {
	header("Location: ./");
}
?>