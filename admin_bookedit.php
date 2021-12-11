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

	<main class="container-fluid p-5">
		<div class="row justify-content-md-center">
			<div class="col-7 transparent3 p-5">
				<?php 
					if (isset($_GET['id'])) {
						$id = $_GET['id'];
						$sql = "SELECT * FROM books WHERE BookId = '$id'";
						$data = mysqli_query($link, $sql);
						$row = mysqli_fetch_object($data);
					}
				 ?>
				<h1 class="text-center mb-4">Edit Book</h1>
				<form method="post" action="admin_bookeditprocess.php?id=<?=$row->BookId?>">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Title</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="title" placeholder="Title" value="<?=$row->BookTitle?>" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Author</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="author" placeholder="Author" value="<?=$row->Author?>" required>
				  </div>
				  <div class="form-group">
					    <label for="exampleFormControlSelect1">Category</label>
					    <select class="rounded-0 form-control bg-transparent text-white" name="category" id="exampleFormControlSelect1">
					      <?php 
					      	$sql2 = "SELECT * FROM categories";
					      	$data2 = mysqli_query($link, $sql2);
					      	$selected = "";
					      	while ($row2 = mysqli_fetch_object($data2)) {
					      		if ($row2->CategoryId == $row->CategoryId) {
					      			$selected = "selected";
					      		}
					      		echo "<option $selected class='text-dark' value='$row2->CategoryId'>$row2->CategoryName</option>";
					      		$selected = "";
					      	}
					       ?>
					    </select>
					</div>
				  <div class="form-group">
					    <label for="exampleFormControlSelect1">Publisher</label>
					    <select class="rounded-0 form-control bg-transparent text-white" name="publisher" id="exampleFormControlSelect1">
					      <?php 
					      	$sql3 = "SELECT * FROM publishers";
					      	$data3 = mysqli_query($link, $sql3);
					      	$selected = "";
					      	while ($row2 = mysqli_fetch_object($data3)) {
					      		if ($row2->PublisherId == $row->PublisherId) {
					      			$selected = "selected";
					      		}
					      		echo "<option $selected class='text-dark' value='$row2->PublisherId'>$row2->Name</option>";
					      		$selected = "";
					      	}
					       ?>
					    </select>
					</div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Add Stock</label>
				    <input type="number" class="form-control bg-transparent text-white rounded-0" name="stock" placeholder="Password" value="0" required>
				    <label><small class="font-italic">Available Stock : <?=$row->Stock?></small></label>
				  </div>
				  <div class="form-group py-1">
				  	<button type="submit" class="mt-4 btn btn-success btn-block rounded-0" name="submit">Save</button>
				  </div>
				</form>
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