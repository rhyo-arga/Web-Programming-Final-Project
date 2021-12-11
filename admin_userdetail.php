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

	<main class="bg-white p-5">
		<div class="container">
			<div class="row justify-content-md-center">
				<?php 
					$nim = $_GET['nim'];
					$sql = "SELECT * FROM members WHERE Nim = '$nim'";
					$data = mysqli_query($link, $sql);
					$row = mysqli_fetch_object($data);
				 ?>
				<div class="col-5 mb-5 center">
					<img src="<?=$row->Image?>" style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
				</div>
			</div>
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
				<a href="admin_useredit.php?nim=<?=$nim?>"class="mt-3 mb-3 btn btn-success rounded-0">Edit</a>
				<a href="admin_userdelete.php?nim=<?=$nim?>"class="mt-3 mb-3 btn btn-danger rounded-0">Delete</a>
			</div>

			<h2 class="text-dark mt-5">Borrowing Book</h2>
			<table class="table table-hover table-striped">
			  <thead class="thead-dark">
			    <tr>
			    	<th scope="col"></th>
			      <th scope="col">Name</th>
			      <th scope="col">Author</th>
			      <th scope="col">Category</th>
			      <th scope="col">Status</th>
			      <th scope="col"></th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$sql = "SELECT * FROM ((transactions LEFT JOIN books ON books.BookId=transactions.BookId) LEFT JOIN categories ON categories.CategoryId = books.CategoryId) WHERE Nim = '$nim' AND (Status = 'booked' OR Status = 'borrowed') ORDER BY Status, TransactionId DESC";
			  	$data = mysqli_query($link,$sql);
			  	while ($row = mysqli_fetch_object($data)) {
			  		?>
					    <tr>
					    	<td><img src="<?=$row->Image?>" style="float: left; object-fit: cover" width="75px"></td>
					      <th class="align-middle"><?=$row->BookTitle?></th>
					      <td class="align-middle font-italic"><?=$row->Author?></td>
					      <td class="align-middle"><?=$row->CategoryName?></td>
					      <td class="align-middle" style="text-decoration: underline;"><?=$row->Status?></td>
					    	<td class="align-middle">
					    		<?php 
					    			if ($row->Status == "booked") {
					    				echo "<a href='admin_borrowingprocess.php?tid=$row->TransactionId&f=us&nim=$nim' class='btn btn-success float-right ml-1'>Process</a>";
					    			}else if ($row->Status == 'borrowed') {
					    				echo "<a href='admin_returningprocess.php?tid=$row->TransactionId&f=us&nim=$nim' class='btn btn-warning float-right ml-1'>Process</a>";
					    			}
					    		 ?>
					    	</td>
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

			<h2 class="text-dark mt-5">History</h2>
			<table class="table table-hover">
			  <thead class="thead-dark">
			    <tr>
			    	<th scope="col"></th>
			      <th scope="col">Name</th>
			      <th scope="col">Author</th>
			      <th scope="col">Category</th>
			      <th scope="col">Returning Date</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$sql = "SELECT * FROM ((transactions LEFT JOIN books ON books.BookId=transactions.BookId) LEFT JOIN categories ON categories.CategoryId = books.CategoryId) WHERE Nim = '$nim' AND (Status = 'canceled' OR Status = 'returned') ORDER BY Status DESC, TransactionId DESC";
			  	$data = mysqli_query($link,$sql);
			  	while ($row = mysqli_fetch_object($data)) {
			  		$sql2 = "SELECT * FROM returnings WHERE TransactionId = '$row->TransactionId'";
			  		$data2 = mysqli_query($link, $sql2);
			  		$row2 = mysqli_fetch_assoc($data2);
			  		$returning_date = $row2['MemberReturningDate'];
			  		if ($row->Status == "canceled"){
			  			$cancel = "bg-light";
			  			$returning_date = "None";
			  		}
			  		?>
					    <tr class="<?=$cancel?>">
					    	<td><img src="<?=$row->Image?>" style="float: left; object-fit: cover" width="75px"></td>
					      <th class="align-middle"><?=$row->BookTitle?></th>
					      <td class="align-middle font-italic"><?=$row->Author?></td>
					      <td class="align-middle"><?=$row->CategoryName?></td>
					      <td class="align-middle"><?=$returning_date=date('Y-m-d')?></td>
					    </tr>
			  		<?php
			  		$cancel = "";
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