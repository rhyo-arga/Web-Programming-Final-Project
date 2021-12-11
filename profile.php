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
		      <li class="nav-item ">
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
		     ?>

		  </div>
		</nav>

		<div class="jumbotron jumbotron-fluid transparent m-0">
		  <div class="container center">
		  	<img src="<?=$row->Image?>" style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
		  	<?php  
			  	$string = $row->Name; 
					$first_name = explode(" ", $string);
					$last_array = count($first_name)- 1;
		    ?>
		    <h1 class="display-4 mt-4"><?=$first_name[$last_array]?></h1>
		  </div>
		</div>

	</header>

	<!-- ================================== CONTENT ================================== -->

	<main class="bg-white p-5">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="col-8 border">
					<h2 class="text-dark mt-4">Profile</h2>
					<table class="table">
						<tr>
							<td>Nim</td>
							<td><?=$row->Nim?></td>
						</tr>
						<tr>
							<td>Name</td>
							<td><?=$row->Name?></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><?=$row->Address?></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td><?=$row->ContactNumber?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?=$row->Email?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="center py-4">
				<a href="profilewishlist.php"class="mt-3 mb-3 btn btn-primary rounded-0">Wishlist</a>
				<a href="profileedit.php"class="mt-3 mb-3 btn btn-success rounded-0">Edit</a>
				<a href="signoutprocess.php"class="mt-3 mb-3 btn btn-danger rounded-0">Sign Out</a>
			</div>

			<h2 class="text-dark mt-5">On Book</h2>
			<table class="table table-hover table-striped">
			  <thead class="thead-dark">
			    <tr>
			    	<th scope="col"></th>
			      <th scope="col">Name</th>
			      <th scope="col">Author</th>
			      <th scope="col">Category</th>
			      <th scope="col">Taken Before</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$sql = "SELECT * FROM ((transactions LEFT JOIN books ON books.BookId=transactions.BookId) LEFT JOIN categories ON categories.CategoryId = books.CategoryId) WHERE nim = '$nim' AND Status = 'booked' ORDER BY TransactionId DESC";
			  	$data = mysqli_query($link,$sql);
			  	while ($row = mysqli_fetch_object($data)) {
					    
			  			$borrowing_date = $row->BorrowingDate;
			  			$borrowing_date = date('Y-m-d', strtotime($borrowing_date.'+1 days'));
					    ?>
					    <tr>
					    	<td><img src="<?=$row->Image?>" style="float: left; object-fit: cover" width="75px"></td>
					      <th class="align-middle"><?=$row->BookTitle?></th>
					      <td class="align-middle font-italic"><?=$row->Author?></td>
					      <td class="align-middle"><?=$row->CategoryName?></td>
					      <td class="align-middle"><?=$borrowing_date?></td>
					    </tr>
			  		<?php
			  	}
			  	 ?>
			  </tbody>
			</table>
			<?php 
				$num = mysqli_num_rows($data);
		  	if ($num == 0) {
		  		echo "<h4 class='text-center text-black-50'>NONE</h4>";
		  	}
		  	?>

		  <h2 class="text-dark mt-5">On Borrow <span class="text-muted" style="font-size: 12px;">(penalty fee IDR 5,000 per day if late)</span></h2>
			<table class="table table-hover table-striped">
			  <thead class="thead-dark">
			    <tr>
			    	<th scope="col"></th>
			      <th scope="col">Name</th>
			      <th scope="col">Author</th>
			      <th scope="col">Category</th>
			      <th scope="col">Returned Before</th>
			      <th scope="col">Fine</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$sql = "SELECT * FROM ((transactions LEFT JOIN books ON books.BookId=transactions.BookId) LEFT JOIN categories ON categories.CategoryId = books.CategoryId) WHERE nim = '$nim' AND Status = 'borrowed' ORDER BY TransactionId DESC";
			  	$data = mysqli_query($link,$sql);
			  	while ($row = mysqli_fetch_object($data)) {
					    $sql2 = "SELECT * FROM returnings WHERE TransactionId = '$row->TransactionId'";
					    $data2 = mysqli_query($link, $sql2);
					    $row2 = mysqli_fetch_object($data2);
					    date_default_timezone_set('Asia/Jakarta');

					    $date = date('Y-m-d');

					    $determined_date = strtotime($row2->DeterminedReturningDate);
							$member_date = strtotime($date);
							$fine1 = ($member_date - $determined_date)/86400;
							$fine2 = 0;
							if ($fine1 > 0) {
								$fine2 = 5000 * $fine1;
							}

					    ?>
					    <tr>
					    	<td><img src="<?=$row->Image?>" style="float: left; object-fit: cover" width="75px"></td>
					      <th class="align-middle"><?=$row->BookTitle?></th>
					      <td class="align-middle font-italic"><?=$row->Author?></td>
					      <td class="align-middle"><?=$row->CategoryName?></td>
					      <td class="align-middle"><?=$row2->DeterminedReturningDate?></td>
					      <td class="align-middle"><?=$fine2?></td>
					    </tr>
			  		<?php
			  	}
			  	 ?>
			  </tbody>
			</table>
			<?php 
				$num = mysqli_num_rows($data);
		  	if ($num == 0) {
		  		echo "<h4 class='text-center text-black-50'>NONE</h4>";
		  	}
		  	?>
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