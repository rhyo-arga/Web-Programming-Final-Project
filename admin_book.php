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
			header("location: admin_book.php?sort=latest");
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


	<!-- ================================== MAIN ================================== -->

	<main>
		<div class="container-fluid bg-white p-5">
			<h1 class="text-dark text-center m-5">Book</h1>
			<div class="container-fluid">
				<div class="row justify-content-between">
			    <div class="col-3">
						<ul class="list-group list-group-horizontal-sm mb-2">
				      <li class="list-group-item px-1 border-0">
				        <p class="text-dark">Sort by : </p>
				      </li>
				      <li class="list-group-item px-1 border-0">
				        <div class="btn-group">
								  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <?= ucfirst($sort);?>
								  </button>
								  <div class="dropdown-menu">
								  	<?php
								  		$active = ""; 
								  		$arr_sort = array("latest", "title", "category", "publisher", "stock");
								  		for ($i=0; $i < 5; $i++) { 
								  			if ($sort == $arr_sort[$i]) {
								  				$active = "active";
								  			}
								  			$name_sort = ucfirst($arr_sort[$i]);
								  			echo "<a class='dropdown-item $active' href='admin_book.php?sort=$arr_sort[$i]'>$name_sort</a>";
								  			$active = "";
								  		}
								  	 ?>
								  </div>
								</div>
				      </li>
				    </ul>
			    </div>
			    <div class="col-3">
			    	<a class="btn btn-outline-dark btn-block btn-lg" href="admin_addbook.php" role="button">Add New Book</a>
			    </div>
			    <div class="col-3">
						<!-- Filter (optional) -->
			    </div>
			  </div>
			</div>

			<div class="container-fluid">
				<hr class="bg-dark mt-0" style="height: 30px;">
			  	<?php 
			  	if ($sort == 'latest')
			  		$what = "BookId DESC";
			  	else if ($sort == 'title')
			  		$what = "BookTitle";
			  	else if ($sort == 'category')
			  		$what = "c.CategoryName";
			  	else if ($sort == 'publisher')
			  		$what = "p.Name";
			  	else if ($sort == 'stock')
			  		$what = "Stock";
			  	else
			  		header("location: admin_book.php?sort=latest");

			  	$sql = "SELECT * FROM ((books b LEFT JOIN categories c ON c.CategoryId = b.CategoryId) LEFT JOIN publishers p ON p.PublisherId = b.PublisherId) ORDER BY $what";
			  	$data = mysqli_query($link,$sql);
			  	?>
			  	<div class="row">
			  	<?php 
			  	$i = 0;
			  	while ($row = mysqli_fetch_object($data)) {
			  		if ($i == 2) {
			  			?>
			  			</div>
							<div class="row">
			  			<?php
			  			$i = 0;
			  		}
			  		?>
			  		<div class="col-6 p-0">
						<div class="p-3">
		      	<div class="card" style="max-width: 610px;" >
						  <div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="<?=$row->Image?>" class="card-img" style="object-fit: cover; width: 100%; height: 225px;">
						    </div>
						    <div class="col-md-9">
						      <div class="card-body">
						        <h5 class="card-title text-dark mb-0"><?=$row->BookTitle?></h5>
						        <p class="card-text"><small class="text-muted font-italic"><?=$row->Author?></small></p>
						        <p class="card-text text-dark my-1"><?=$row->CategoryName?></p>
						        <p class="card-text text-dark my-1 font-italic"><?=$row->Name?></p>
						        <p class="card-text"><small class="text-muted">Stock : <?=$row->Stock?></small></p>
						        <a class="btn btn-success" href="admin_bookdetail.php?id=<?=$row->BookId?>" role="button" style="position: absolute; right: 40px; bottom: 20px;">Detail</a>
						      </div>
						    </div>
						  </div>
						</div>
						</div>
						</div>
			  		<?php
			  		$i++;
			  	}
			  	 ?>
			  	</div>
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