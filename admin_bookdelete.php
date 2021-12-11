<?php 
	include "connect.php";
	session_start();
	include 'admin_checksession.php';
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "DELETE FROM books WHERE BookId = '$id'";
		$data = mysqli_query($link, $sql);
	}
	header("location: admin_book.php");

 ?>