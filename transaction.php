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
		$status = "booked";
		
		$sql = "INSERT INTO transactions VALUES('', '$bookid', '$nim', '$date', '$status')";
		$data = mysqli_query($link, $sql);

		$sql = "SELECT * FROM books WHERE BookId = '$bookid'";
		$data = mysqli_query($link, $sql);
		$row = mysqli_fetch_object($data);
		$stock = $row->Stock;
		$stock--;
		
		$sql = "UPDATE books SET Stock = '$stock' WHERE BookId = '$bookid'";
		$data = mysqli_query($link, $sql);

		header("location: profile.php");
	}
	#strtotime("+7 days")
 ?>