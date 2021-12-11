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
		      <li class="nav-item active dropdown">
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

		    <?php 
		    	if (!empty($_SESSION["nim"])) {
		    		$nim = $_SESSION["nim"];
		    		$sql = "SELECT * FROM members WHERE Nim = '$nim'";
		    		$data = mysqli_query($link, $sql);
		    		$row = mysqli_fetch_object($data);
		    		?>
		    		<a href="profile.php" class="text-warning" id="link">
		    			Hello, <?=$row->Name?>
				  	</a>
		    		<?php
		    	}
		    	else{
		    		?>
		    		<a href="signin.php">
		    			<button class="btn btn-outline-success my-2 my-sm-0 mr-1 rounded-0" type="submit">Sign in</button>
				  	</a>
		    		<?php
		    	}
		     ?>

		  </div>
		</nav>

		<div class="jumbotron jumbotron-fluid transparent m-0">
		  <div class="container">
		    <h1 class="display-4">Our Collections</h1>
		  </div>
		</div>
	
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
				<a href="transaction.php?bid=<?=$row->BookId?>"class="mt-3 mb-3 btn btn-success <?=$available?>">Borrow</a>
				<a href="wishlist.php?bid=<?=$row->BookId?>" class="btn px-2" id="link">
					<?php 
						$icon = "icon1";
						if (!empty($_SESSION['nim'])){
							$nim = $_SESSION['nim'];
							$sql3 = "SELECT * FROM wishlists WHERE Nim = '$nim' AND BookId = '$row->BookId'";
							$data3 = mysqli_query($link, $sql3);
							$num3 = mysqli_num_rows($data3);
							if ($num3 == 0)
								$icon = "icon1";
							else
								$icon = "icon2";
						}
					?>
					<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 176.104 176.104" style="enable-background:new 0 0 176.104 176.104;" xml:space="preserve">
						<path id="<?=$icon?>" d="M150.383,18.301c-7.13-3.928-15.308-6.187-24.033-6.187c-15.394,0-29.18,7.015-38.283,18.015
						c-9.146-11-22.919-18.015-38.334-18.015c-8.704,0-16.867,2.259-24.013,6.187C10.388,26.792,0,43.117,0,61.878
						C0,67.249,0.874,72.4,2.457,77.219c8.537,38.374,85.61,86.771,85.61,86.771s77.022-48.396,85.571-86.771
						c1.583-4.819,2.466-9.977,2.466-15.341C176.104,43.124,165.716,26.804,150.383,18.301z"/>
					</svg>
				</a>
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