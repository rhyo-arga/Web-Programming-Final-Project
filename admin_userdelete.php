<?php 
	include "connect.php";
	session_start();
	include 'admin_checksession.php';
	if (isset($_GET['nim'])) {
		$nim = $_GET['nim'];
		$sql = "DELETE FROM members WHERE Nim = '$nim'";
		$data = mysqli_query($link, $sql);
	}
	header("location: admin_home.php");

 ?>