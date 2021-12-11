<?php 
	include 'connect.php';
	date_default_timezone_set('Asia/Jakarta');
	$date = date('Y-m-d', strtotime('-1 days'));
	$status = "canceled";
	$sql = "SELECT * FROM transactions WHERE Status = 'booked'";
	$data = mysqli_query($link, $sql);
	while ($row = mysqli_fetch_object($data)) {
		$date_booked = $row->BorrowingDate; 
		if ($date > $date_booked){
			$sql2 = "SELECT * FROM books WHERE BookId = '$row->BookId'";
			$data2 = mysqli_query($link, $sql2);
			$row2 = mysqli_fetch_object($data2);
			$stock = $row2->Stock;
			$stock++;

			$sql2 = "UPDATE books SET Stock = '$stock' WHERE BookId = '$row2->BookId'";
			$data2 = mysqli_query($link, $sql2);

			$sql2 = "UPDATE transactions SET Status = '$status' WHERE TransactionId = '$row->TransactionId'";
			$data2 = mysqli_query($link, $sql2);
		}
	}
 ?>