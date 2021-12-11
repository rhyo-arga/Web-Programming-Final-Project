<?php
include "connect.php";
session_start();

if (isset($_POST['submit'])) {
	$id = $_POST['id'];
	$password = $_POST['password'];
	$password = md5($password);
	$ok = false;

	$sql = "SELECT * FROM admins";
	$data = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_object($data)) {
		if ($row->AdminId == $id && $row->Password == $password) {
			$ok = true;
		}
	}
	if ($ok) {
		$_SESSION["id"] = $id;
		header("location: admin_home.php");
	}
	else{
		header("location: admin_signin.php?msg=f");
	}
}
 ?>