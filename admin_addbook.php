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
		  <a class="navbar-brand" href="admin_home.php">Orhy Admin Side</a>
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
				<h1 class="text-center mb-4">Add New Book</h1>
				<form method="post" action="admin_addbookprocess.php" enctype="multipart/form-data">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Title</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="title" placeholder="Title" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Author</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="author" placeholder="Author" required>
				  </div>
				  <label for="exampleFormControlSelect1">Category</label>
				  <div class="form-row">

				  	<div class="form-group col-md-8">
					    <select class="rounded-0 form-control bg-transparent text-white" name="category" id="exampleFormControlSelect1" required>
					      <?php 
					      	$sql2 = "SELECT * FROM categories";
					      	$data2 = mysqli_query($link, $sql2);
					      	while ($row2 = mysqli_fetch_object($data2)) {
					      		echo "<option  class='text-dark' value='$row2->CategoryId'>$row2->CategoryName</option>";
					      	}
					       ?>
					    </select>
						</div>
						<div class="form-group col-md-4">
							<a class="btn btn-outline-light btn-block rounded-0" href="admin_addcategory.php" role="button">Add Category</a>
						</div>
				  </div>
				  <label for="exampleFormControlSelect1">Publisher</label>
				  <div class="form-row">
				  	<div class="form-group col-md-8">
					    <select class="rounded-0 form-control bg-transparent text-white" name="publisher" id="exampleFormControlSelect1" required>
					      <?php 
					      	$sql3 = "SELECT * FROM publishers";
					      	$data3 = mysqli_query($link, $sql3);
					      	while ($row2 = mysqli_fetch_object($data3)) {
					      		echo "<option class='text-dark' value='$row2->PublisherId'>$row2->Name</option>";
					      	}
					       ?>
					    </select>
						</div>
						<div class="form-group col-md-4">
							<a class="btn btn-outline-light btn-block rounded-0" href="admin_addpublisher.php" role="button">Add Publisher</a>
						</div>
				  </div>
					<div class="form-group">
				    <label for="exampleInputEmail1">Isbn</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="isbn" placeholder="Isbn" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Stock</label>
				    <input type="number" class="form-control bg-transparent text-white rounded-0" name="stock" placeholder="Stock" value="1" required>
				  </div>
				  <label for="exampleInputEmail1">Photo</label>
				  <div class="form-group">
					  <input type="file" name="image" id="customFile" accept="image/*" style="display: block; border: 0.1px solid white; border-radius: 0; width: 100%; padding: 4px;">
					</div>
					<?php 
							if (isset($_GET['msg'])) {
								if ($_GET['msg'] == 'f') {
									?>
									<label class="text-warning">Image format is wrong!</label>
									<?php
								}
							}
						 ?>
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