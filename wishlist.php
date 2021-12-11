<?php
	include "connect.php"; 
	session_start();
	date_default_timezone_set('Asia/Jakarta');
	if (empty($_SESSION['nim'])) {
		header("location: transactionfailed.php");
	}
	else{
		$nim = $_SESSION['nim'];
		$bookid = $_GET['bid'];
		$date = date('Y-m-d');

		$sql = "SELECT * FROM wishlists WHERE Nim = '$nim' AND BookId = '$bookid'";
		$data = mysqli_query($link, $sql);
		$num = mysqli_num_rows($data);

		if ($num == 0) {
			$sql = "INSERT INTO wishlists VALUES('$bookid', '$nim')";
			$data = mysqli_query($link, $sql);
		}else{
			$sql = "DELETE FROM wishlists WHERE Nim = '$nim' AND BookId = '$bookid'";
			$data = mysqli_query($link, $sql);
		}
		if (isset($_GET['f'])) {
			header("location: profilewishlist.php");
		}
		else {
			header("location: categories.php");
		}
	}
	#strtotime("+7 days")
 ?>