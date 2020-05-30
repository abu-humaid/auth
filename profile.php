
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



	/**
	  * Logout System
	  */ 
	if ( isset($_GET['logout']) AND $_GET['logout'] == 'user_logout' ) {
		
		// Cookie disable
		setcookie('relog', '' , time() - (60*60*24*365*10) );

		// Recent Login cokie set
		if ( isset($_COOKIE['recent_log']) ) {

			$all_recent_log_id = $_COOKIE['recent_log'];

			$old_ids = explode(',', $all_recent_log_id);

			array_push( $old_ids ,  $_SESSION['id']);

			$all_ids = implode(',', $old_ids);

			setcookie('recent_log', $all_ids , time() + (60*60*24*365*10) );

		}else {
			setcookie('recent_log', $_SESSION['id'] , time() + (60*60*24*365*10) );
		}


		//Session Destory
		session_destroy();

		// Redirect 
		header("location:index.php");
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION['name']; ?></title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap shadow">
		<div class="card">
			<div class="card-header">
				<h2><?php echo $_SESSION['name']; ?> <a class="btn btn-primary btn-sm" href="users.php">All users</a></h2>

			</div>
			<div class="card-body">
				<img style="width:200px; height:200px; border-radius:50%;display:block;margin:auto;border: 10px solid #FFF" class="shadow" src="photos/users/<?php echo $_SESSION['photo']; ?>" alt="">
				
				<br>
				<br>
				<br>
				<table class="table table-bordered ">
					<tr>
						<td>Name</td>
						<td><?php echo $_SESSION['name']; ?></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><?php echo $_SESSION['uname']; ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $_SESSION['email']; ?></td>
					</tr>
					<tr>
						<td>Cell</td>
						<td><?php echo $_SESSION['cell']; ?></td>
					</tr>
					
				</table>
			</div>
			<div class="card-footer">
				<a href="?logout=user_logout">Logout</a>
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>