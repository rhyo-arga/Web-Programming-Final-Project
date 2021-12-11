<?php
include "connect.php";
session_start();
include 'admin_checksession.php';
if (isset($_POST['submit'])) {
	$admin = $_SESSION['id'];
	foreach ($_POST as $key => $value) {
		${$key} = $value;
	}

	$sql = "INSERT INTO publishers VALUES('$pubid', '$pubname', '$pubadd', '$pubcon')";
	$data = mysqli_query($link, $sql);

	header("location: admin_addbook.php");
}
 ?>