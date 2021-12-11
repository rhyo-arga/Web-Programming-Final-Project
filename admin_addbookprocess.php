<?php
include "connect.php";
session_start();
include 'admin_checksession.php';
if (isset($_POST['submit'])) {
	$admin = $_SESSION['id'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$category = $_POST['category'];
	$publisher = $_POST['publisher'];
	$isbn = $_POST['isbn'];
	$stock = $_POST['stock'];
	date_default_timezone_set('Asia/Jakarta');
	$date = date("Y-m-d");
	if (!empty($_FILES['image']['name'])) {
		if ($_FILES['image']['type']=='image/png' || $_FILES['image']['type']=='image/jpg' || $_FILES['image']['type']=='image/jpeg') {
			$date = date("Y-m-d H:i:s");
			$date = md5($date);
			$image = 'photo/book/'.$date.'.png';
			move_uploaded_file($_FILES["image"]["tmp_name"], $image);

			$sql = "INSERT INTO books VALUES('', '$category', '$publisher', '$isbn', '$title', '$author', '$stock', '$image')";
			$data = mysqli_query($link, $sql);
		}
		else {
			header("location: admin_addbook.php?msg=f");
		}
	}
	else {
		$sql = "INSERT INTO books VALUES('', '$category', '$publisher', '$isbn', '$title', '$author', '$stock', DEFAULT)";
		$data = mysqli_query($link, $sql);
	}
	if ($stock != 0) {
		$sql = "SELECT * FROM books WHERE BookTitle = '$title' AND Isbn = '$isbn'";
		$data = mysqli_query($link, $sql);
		$row = mysqli_fetch_object($data);
		$sql2 = "INSERT INTO inputs VALUES('$admin', '$row->BookId', '$date', '$stock')";
		$data2 = mysqli_query($link, $sql2);
	}
	header("location: admin_book.php");
	
}
 ?>