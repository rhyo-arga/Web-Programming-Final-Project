<?php
	include "connect.php"; 
	session_start();
	include 'admin_checksession.php';
	date_default_timezone_set('Asia/Jakarta');
	$date_return = date('Y-m-d', strtotime("+7 days"));
	$from = $_GET['f'];
	$nim = $_GET['nim'];
	$tid = $_GET['tid'];
	$date = date('Y-m-d');
	$status = "borrowed";
	
	$sql = "UPDATE transactions SET Status = '$status', BorrowingDate = '$date' WHERE TransactionId = '$tid'";
	$data = mysqli_query($link, $sql);

	$sql = "INSERT INTO returnings VALUES('', '$tid', DEFAULT, '$date_return', DEFAULT)";
	$data = mysqli_query($link, $sql);

	if ($from == "tr")
		header("location: admin_transaction.php");
	else if ($from == "us")
		header("location: admin_userdetail.php?nim=$nim");
 ?>