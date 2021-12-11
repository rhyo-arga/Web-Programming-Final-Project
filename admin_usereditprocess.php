<?php
include "connect.php";
session_start();
include 'admin_checksession.php';
if (isset($_POST['submit'])) {
	$nim = $_POST['nim'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$phone = $_POST['phone_number'];
	$email = $_POST['email'];
	$sql = "UPDATE members SET Name = '$name', Address = '$address', ContactNumber = '$phone', Email = '$email' WHERE Nim = '$nim'";
	$data = mysqli_query($link, $sql);
	header("location: admin_userdetail.php?nim=$nim");
}
 ?>