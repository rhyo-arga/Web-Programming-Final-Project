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
	 ?>

	<!-- ================================== NAVBAR & JUMBOTRON ================================== -->
	<img src="img/blackbg.jpg" class="bg-us">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2d3e50;">
		  <a class="navbar-brand" href="index.php">Orhy Book Shelf</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="index.php">Home</a>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" style="cursor: pointer;" id="navbarDropdown" data-toggle="dropdown">
		          Categories
		        </a>
		        <div class="dropdown-menu">
		        	<a class="dropdown-item" href="categories.php?cat=all">All</a>
		        	<?php 
		        		$sql = "SELECT * FROM categories";
		        		$data = mysqli_query($link, $sql);

		        		while ($row = mysqli_fetch_object($data)) {
		        			?>
		        				<a class="dropdown-item" href="categories.php?cat=<?=$row->CategoryId?>"><?=$row->CategoryName?></a>
		        			<?php
		        		}
		        	 ?>
		        </div>
		      </li>		      
		      <li class="nav-item">
		        <a class="nav-link" href="about.php">About</a>
		      </li>
		    </ul>
		    	<a href="signin.php">
	    			<button class="btn btn-outline-success my-2 my-sm-0 mr-1 rounded-0" type="submit">Sign in</button>
			  	</a>
		  </div>
		</nav>
	</header>

	<!-- ================================== CONTENT ================================== -->

	<main class="container-fluid p-5">
		<div class="row justify-content-md-center">
			<div class="col-5 transparent3 p-5">
				<h1 class="text-center mb-4">SIGN IN</h1>
				<form method="post" action="admin_signinprocess.php">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Admin Id</label>
				    <input type="text" class="form-control bg-transparent text-white rounded-0" name="id" id="exampleInputEmail1" placeholder="Admin Id">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control bg-transparent text-white rounded-0" name="password" id="exampleInputPassword1" placeholder="Password">
				  </div>
				  <div class="form-group py-1">
				  	<?php 
							if (isset($_GET['msg'])) {
								if ($_GET['msg'] == 'f') {
									?>
									<label class="text-warning">Sign in failed, please input correctly</label>
									<?php
								}
							}
						 ?>
				  	<button type="submit" class="mt-3 mb-3 btn btn-success btn-block rounded-0" name="submit">Sign In</button>
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