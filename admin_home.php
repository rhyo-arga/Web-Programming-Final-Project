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
		if (isset($_GET['sort'])) {
			$sort = $_GET['sort'];
		}
		else{
			header("location: admin_home.php?sort=nim");
		}
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


	<!-- ================================== MAIN ================================== -->

	<main>
		<div class="container-fluid bg-white p-5">
			<h1 class="text-dark text-center m-5">User</h1>
			<p class="text-dark">Sort by : 
				<?php 
					$active = "";
					$active2 = "";
					if ($sort == "nim"){
						$active = "active";
						$what = "Nim";
					}	
					else{
						$active2 = "active";
						$what = "Name";
					}
				 ?>
				<a href="admin_home.php?sort=nim" class="btn btn-primary btn-sm <?=$active?>">Nim</a>
				<a href="admin_home.php?sort=name" class="btn btn-primary btn-sm <?=$active2?>">Name</a>
			</p>
			<table class="table table-hover">
			  <thead class="thead-dark">
			    <tr>
			      <th class="align-middle">Nim</th>
			      <th class="align-middle">Name</th>
			      <th class="align-middle">Address</th>
			      <th class="align-middle">Contact Number</th>
			      <th class="align-middle">Email</th>
			      <th class="align-middle"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$sql = "SELECT * FROM members ORDER BY $what";
			  	$data = mysqli_query($link,$sql);

			  	while ($row = mysqli_fetch_object($data)) {
			  		?>
					    <tr>
					      <td class="align-middle"><?=$row->Nim?></td>
					      <td class="align-middle"><?=$row->Name?></td>
					      <td class="align-middle"><?=$row->Address?></td>
					      <td class="align-middle"><?=$row->ContactNumber?></td>
					      <td class="align-middle"><?=$row->Email?></td>
					      <td class="align-middle">
					      		<a href="admin_userdetail.php?nim=<?=$row->Nim?>" class="btn btn-dark float-right ml-1">Detail</a>
					   		</td>
					    </tr>
			  		<?php
			  	}
			  	 ?>
			  </tbody>
			</table>
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