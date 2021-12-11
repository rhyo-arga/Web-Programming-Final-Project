<?php
include "connect.php";
session_start();
include 'admin_checksession.php';
if (isset($_POST['submit'])) {
	$admin = $_SESSION['id'];
	$id = $_GET['id'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$category = $_POST['category'];
	$publisher = $_POST['publisher'];
	$stock = $_POST['stock'];
	$date = date('Y-m-d');

	$sql = "UPDATE books SET BookTitle = '$title', Author = '$author', CategoryId = '$category', PublisherId = '$publisher', Stock = Stock + '$stock' WHERE BookId = '$id'";
	$data = mysqli_query($link, $sql);

	if ($stock != 0) {
		$sql = "INSERT INTO inputs VALUES('$admin', '$id', '$date', '$stock')";
		$data = mysqli_query($link, $sql);
	}
	

	header("location: admin_bookdetail.php?id=$id");
}
 ?>