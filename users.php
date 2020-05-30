
<?php include_once "app/db.php"; ?>
<?php include_once "app/function.php"; ?>
<?php  
	// Session start 
	session_start();

	/**
	 * Session check 
	 */
	if ( !isset($_SESSION['id']) AND !isset($_SESSION['email']) AND !isset($_SESSION['uname']) ) {
		// Redirect user profile 
		header("location:index.php");
	}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap-table shadow">
		<div class="card">
			<div class="card-body">
				<h2>All Data <a class="btn btn-primary btn-sm ml-auto d-table" href="profile.php">Your Profile</a></h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
						<?php  

							// Get cookie user data 
							$sql = "SELECT * FROM users";
							$data = $connection -> query($sql);
							

							while($all_user = $data -> fetch_object()) :
						?>

						<tr>
							<td>1</td>
							<td><?php echo $all_user -> name ; ?></td>
							<td><?php echo $all_user -> email ; ?></td>
							<td><?php echo $all_user -> uname ; ?></td>
							<td><?php echo $all_user -> cell ; ?></td>
							<td><img src="photos/users/<?php echo $all_user -> photo ; ?>" alt=""></td>
							<td>

								<?php if( $all_user -> id == $_SESSION['id'] ) : ?>
								<a class="btn btn-sm btn-info" href="#">View</a>
								<a class="btn btn-sm btn-warning" href="#">Edit</a>
								<a class="btn btn-sm btn-danger" href="#">Delete</a>
								<?php else : ?>
									<a class="btn btn-sm btn-info" href="#">View</a>
								<?php endif; ?>


							</td>
						</tr>
						<?php endwhile; ?>
						

					</tbody>
				</table>
			</div>
		</div>
	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>