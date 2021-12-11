<!DOCTYPE html>
<html>
<head>
	<title>Orhy Book Shelf</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		#icon1{
		  fill: #ff96a3;
		}
		#icon2{
		  fill: #ff2b44;
		}
		#icon1:hover, #icon2:hover{
			fill: #b50015;
		}
	</style>
</head>
<body>
	<?php 
		include "connect.php";
		session_start();

		if (isset($_GET['cat'])) {
			$get_cat = $_GET['cat'];
		}
		else {
			header("location: categories.php?cat=all");
		}
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


	<!-- ================================== CATEGORY ================================== -->

	<main>
		<div class="container-fluid bg-white p-5">


	<!-- ========================================== ATAS ========================================== -->
			<nav>
			  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			  	<?php 
			  		$active1 = "";
			  		$active2 = "";
			  		if ($get_cat == "all") {
			  			$active1 = "active";
			  			$active2 = "show active";
			  		}
			  	 ?>
			    <a class="nav-item nav-link <?=$active1?>" id="nav-home-tab" data-toggle="tab" href="#nav-all" role="tab">All</a>
			    
			    <?php 
			    $active1 = "";
			    $sql = "SELECT * FROM categories";
			    $data = mysqli_query($link,$sql);
			    while ($row = mysqli_fetch_object($data)) {
			    	if ($get_cat == $row->CategoryId) {
			    		$active1 = "active";
			    	}
			    	?>
			    		<a class="nav-item nav-link <?=$active1?>" id="nav-profile-tab" data-toggle="tab" href="#nav-<?=$row->CategoryId?>" role="tab" ><?=$row->CategoryName?></a>
			    	<?php
			    	$active1 = "";
			    }
			     ?>
			  </div>
			</nav>


			<!-- ========================================== BAWAH ========================================== -->

			<div class="tab-content pt-5" id="nav-tabContent">
			  <div class="tab-pane text-dark fade <?=$active2?>" id="nav-all" role="tabpanel">
				  <div class="row">
				  <?php 
				  $i = 0;
				  $sql = "SELECT * FROM books LEFT JOIN categories ON books.CategoryId = categories.CategoryId";
				  $data = mysqli_query($link,$sql);
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
										<div class="card" style="max-width: 610px;">
										  <div class="row no-gutters">
										    <div class="col-md-3">
										      <img src="<?=$row->Image?>" class="card-img" style="object-fit: cover" width="100%" height="100%">
										    </div>
										    <div class="col-md-9">
										      <div class="card-body">
										      	<?php 
										      		$available = "";
										      		if (!empty($_SESSION['nim'])) {
											      		$sql3 = "SELECT * FROM transactions WHERE Nim = '$nim' AND BookId = '$row->BookId' AND (Status = 'booked' OR Status = 'borrowed')";
					  										$data3 = mysqli_query($link,$sql3);
					  										$num3 = mysqli_num_rows($data3);
					  										if ($num3 > 0) {
					  											$available = "disabled";
					  										}
										      		}
										      		if ($row->Stock == 0) {
										      			$available = "disabled";
										      		}
										      	 ?>
										        <h5 class="card-title text-dark m-0"><a href="bookdetail.php?id=<?=$row->BookId?>"><?=$row->BookTitle?></a></h5>
										        <p class="card-text mb-2"><small class="text-muted font-italic"><?=$row->Author?></small></p>
										        <p class="card-text text-dark"><?=$row->CategoryName?></p>
										        <p class="card-text"><small class="text-muted">Stock Available : <?=$row->Stock?></small></p>
														<a href="transaction.php?bid=<?=$row->BookId?>" class="btn btn-success <?=$available?>">Borrow</a>
														<a href="wishlist.php?bid=<?=$row->BookId?>" class="btn px-2" id="link">
															<?php 
																$icon = "icon1";
																if (!empty($_SESSION['nim'])) {
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

			  	<?php 
			  	$active2 = "";
			    $sql = "SELECT * FROM categories";
			    $data = mysqli_query($link,$sql);
			    while ($row = mysqli_fetch_object($data)) {
			    	if ($get_cat == $row->CategoryId) {
			    		$active2 = "show active";
			    	}
			    	?>
			    		<div class="tab-pane text-dark fade <?=$active2?>" id="nav-<?=$row->CategoryId?>" role="tabpanel">
			    			<div class="row">
								  <?php 
								  $i = 0;
								  $sql2 = "SELECT * FROM books WHERE CategoryId = '$row->CategoryId'";
								  $data2 = mysqli_query($link,$sql2);
								  while ($row2 = mysqli_fetch_object($data2)) {			  	
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
														<div class="card" style="max-width: 610px;">
														  <div class="row no-gutters">
														    <div class="col-md-3">
														      <img src="<?=$row2->Image?>" style="object-fit: cover" width="100%" height="100%">
														    </div>
														    <div class="col-md-9">
														      <div class="card-body">
														      	<?php 
														      		$available = "";
														      		if (!empty($_SESSION['nim'])) {
															      		$sql3 = "SELECT * FROM transactions WHERE Nim = '$nim' AND BookId = '$row2->BookId' AND (Status = 'booked' OR Status = 'borrowed')";
									  										$data3 = mysqli_query($link,$sql3);
									  										$num3 = mysqli_num_rows($data3);
									  										if ($num3 > 0) {
									  											$available = "disabled";
									  										}
														      		}
														      		if ($row2->Stock == 0) {
														      			$available = "disabled";
														      		}
														      	 ?>
														        <h5 class="card-title text-dark m-0"><?=$row2->BookTitle?></h5>
														        <p class="card-text mb-2"><small class="text-muted font-italic"><?=$row2->Author?></small></p>
														        <p class="card-text text-dark"><?=$row->CategoryName?></p>
														        <p class="card-text"><small class="text-muted">Stock Available : <?=$row2->Stock?></small></p>
														      	<a href="transaction.php?bid=<?=$row2->BookId?>" class="btn btn-success <?=$available?>">Borrow</a>
														      	<a href="wishlist.php?bid=<?=$row2->BookId?>" class="btn px-2" id="link">
														      		<?php 
																				$icon = "icon1";
																				if (!empty($_SESSION['nim'])) {
																					$nim = $_SESSION['nim'];
																					$sql3 = "SELECT * FROM wishlists WHERE Nim = '$nim' AND BookId = '$row2->BookId'";
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
			    	<?php
			    		$active2 = "";
			    }
			     ?>
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