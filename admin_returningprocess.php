<?php
	include "connect.php";
	session_start();
	include 'admin_checksession.php';
	date_default_timezone_set('Asia/Jakarta');
	$from = $_GET['f'];
	if (isset($_GET['nim'])) {
		$nim = $_GET['nim']; 
	}
	$tid = $_GET['tid'];
	$status = "returned";
	$fine = 0;

	$sql = "SELECT * FROM transactions LEFT JOIN books ON books.BookId = transactions.BookId WHERE TransactionId = '$tid'";
	$data = mysqli_query($link, $sql);
	$row = mysqli_fetch_object($data);
	$stock = $row->Stock;
	$stock++;

	$sql2 = "SELECT * FROM returnings WHERE TransactionId = '$tid'";
	$data2 = mysqli_query($link, $sql2);
	$row2 = mysqli_fetch_object($data2);

	$determined_date = strtotime($row2->DeterminedReturningDate);
	$member_date = date('Y-m-d', strtotime($row2->MemberReturningDate));
	if ($member_date > $determined_date) {
		$sec =  $determined_date - $member_date;
		$day = $sec / 86400;
		$fine = 5000 * $day;
	}
	
	$sql = "UPDATE books SET Stock = '$stock' WHERE BookId = '$row->BookId'";
	$data = mysqli_query($link, $sql);

	$sql = "UPDATE transactions SET Status = '$status' WHERE TransactionId = '$tid'";
	$data = mysqli_query($link, $sql);

	$sql = "UPDATE returnings SET MemberReturningDate = '$date', Fine = '$fine' WHERE TransactionId = '$tid'";
	$data = mysqli_query($link, $sql);

	if ($from == "tr")
		header("location: admin_transaction.php");
	else if ($from == "us")
		header("location: admin_userdetail.php?nim=$nim");
 ?>