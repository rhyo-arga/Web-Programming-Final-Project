<?php
include "connect.php";
if (isset($_POST['submit'])) {
	$nim = $_POST['nim'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$phone = $_POST['phone_number'];
	$email = $_POST['email'];
	
	if (!empty($_FILES['image']['name'])) {
		if ($_FILES['image']['type']=='image/png' || $_FILES['image']['type']=='image/jpg' || $_FILES['image']['type']=='image/jpeg') {
			$image = 'photo/user/'.$nim.'.png';
			echo "$image";
			move_uploaded_file($_FILES["image"]["tmp_name"], $image);
			$sql = "UPDATE members SET Name = '$name', Address = '$address', ContactNumber = '$phone', Email = '$email', Image = '$image' WHERE Nim = '$nim'";

			$data = mysqli_query($link, $sql);
		}
		else {
			header("location: profileedit.php?msg=f");
		}
	}
	else {
		$sql = "UPDATE members SET Name = '$name', Address = '$address', ContactNumber = '$phone', Email = '$email' WHERE Nim = '$nim'";
		$data = mysqli_query($link, $sql);
	}
	header("location: profile.php");
		
}
 ?>