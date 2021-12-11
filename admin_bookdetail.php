<!DOCTYPE html>
<html>
<head>
	<title>Orhy Book Shelf</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
	<?php 
		include "connect.php";
		session_start();
		include 'admin_checksession.php';
	 ?>

	<!-- ================================== NAVBAR & JUMBOTRON ================================== -->
	<img src="img/blackbg.jpg" class="bg-us">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2d3e50;">
		  <a class="navbar-brand" href="admin_home.php">Orhy Admin Page</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="admin_home.php">User</a>
		      </li>
		      <li class="nav-item active">
		        <a class="nav-link" href="admin_book.php">Book</a>
		      </li>     
		      <li class="nav-item">
		        <a class="nav-link" href="admin_transaction.php">Transaction</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="admin_list.php">Admins</a>
		      </li>
		    </ul>

		    <?php 
		    	if (!empty($_SESSION["id"])) {
		    		$id = $_SESSION["id"];
		    		$sql = "SELECT * FROM admins WHERE AdminId = '$id'";
		    		$data = mysqli_query($link, $sql);
		    		$row = mysqli_fetch_object($data);
		    		?>
		    		<label class="text-warning my-auto mx-4">
		    			Hello, <?=$row->Name?>
				  	</label>
		    		<a href="signoutprocess.php">
		    			<button class="btn btn-outline-success my-2 my-sm-0 mr-1 rounded-0" type="submit">Sign out</button>
				  	</a>
		    		<?php
		    	}
		     ?>
		  </div>
		</nav>
	</header>

	<!-- ================================== CONTENT ================================== -->

	<main class="bg-white p-5">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-8 border">
					<?php 
						$book_id = $_GET['id'];
						$sql = "SELECT * FROM ((books b LEFT JOIN categories c ON c.CategoryId = b.CategoryId) LEFT JOIN publishers p ON p.PublisherId = b.PublisherId) WHERE BookId = '$book_id'";
						$data = mysqli_query($link, $sql);
						$row = mysqli_fetch_object($data);
					 ?>
					<h2 class="text-dark mt-4 text-center">Book Detail</h2>
					<div class="m-5" align="center">
						<img src="<?=$row->Image?>" width="200px">
					</div>
					<table class="table">
						<tr>
							<td>Title</td>
							<td><?=$row->BookTitle?></td>
						</tr>
						<tr>
							<td>Author</td>
							<td><?=$row->Author?></td>
						</tr>
						<tr>
							<td>Category</td>
							<td><?=$row->CategoryName?></td>
						</tr>
						<tr>
							<td>Publisher</td>
							<td><?=$row->Name?></td>
						</tr>
						<tr>
							<td>ISBN</td>
							<td><?=$row->Isbn?></td>
						</tr>
						<tr>
							<td>Stock</td>
							<td><?=$row->Stock?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="center py-4">
				<a href="admin_bookedit.php?id=<?=$row->BookId?>"class="mt-3 mb-3 btn btn-success rounded-0">Update</a>
				<a href="admin_bookdelete.php?id=<?=$row->BookId?>"class="mt-3 mb-3 btn btn-danger rounded-0">Delete</a>
			</div>
		</div>
	</main>
	
	<!-- ================================== FOOTER ================================== -->

	<footer class="py-4" style="background-color: #2d3e50;">
		<div class="text-center">Copyright &copy; 2021 All Rights Reserved</div>
	</footer>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>