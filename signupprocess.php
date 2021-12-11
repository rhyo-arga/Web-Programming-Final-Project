<?php
include "connect.php";

if (isset($_POST['submit'])) {
	$nim = $_POST['nim'];
	$name = $_POST['name'];
	$name = ucwords($name);
	$address = $_POST['address'];
	$phone = $_POST['phone_number'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM members WHERE Nim = '$nim'";
	$data = mysqli_query($link, $sql);
	$num = mysqli_num_rows($data);
	if ($num > 0) {
		header("location: signup.php?msg=f");
	}
	else{
		$password = md5($password);
		$sql = "INSERT INTO members values ('$nim','$name','$address','$phone','$email','$password', DEFAULT)";
		$data = mysqli_query($link, $sql);
		header("location: signupsuccess.php");
	}
}
 ?>