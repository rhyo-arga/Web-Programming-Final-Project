<?php
include "connect.php";
session_start();

if (isset($_POST['submit'])) {
	$nim = $_POST['nim'];
	$password = $_POST['password'];
	$password = md5($password);
	$ok = false;

	$sql = "SELECT * FROM members";
	$data = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_object($data)) {
		if ($row->Nim == $nim && $row->Password == $password) {
			$ok = true;
		}
	}
	if ($ok) {
		$_SESSION["nim"] = $nim;
		header("location: index.php");
	}
	else{
		header("location: signin.php?msg=f");
	}
}
 ?>