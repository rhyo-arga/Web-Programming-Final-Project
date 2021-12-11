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
		      <li class="nav-item active">
		        <a class="nav-link" href="admin_home.php">User</a>
		      </li>
		      <li class="nav-item">
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
					if (isset($_GET['nim'])) {
						$nim = $_GET['nim'];
						$sql = "SELECT * FROM members WHERE Nim = '$nim'";
						$data = mysqli_query($link, $sql);
						$row = mysqli_fetch_object($data);
					}
				 ?>
				<h1 class="text-center mb-4">Edit Profile</h1>
				<form method="post" action="admin_usereditprocess.php">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Nim</label>
				    <input type="text" class="form-control bg-transparent text-white-50 rounded-0" name="nim" placeholder="Nim" value="<?=$row->Nim?>" readonly>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Name</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="name" placeholder="Name" value="<?=$row->Name?>" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Address</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="address"  placeholder="Address" value="<?=$row->Address?>" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Phone Number</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="phone_number" placeholder="Phone Number" value="<?=$row->ContactNumber?>" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email</label>
				    <input type="email" class="form-control bg-transparent text-white rounded-0" name="email" placeholder="Email" value="<?=$row->Email?>" required>
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