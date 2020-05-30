<?php include_once "app/db.php"; ?>
<?php include_once "app/function.php"; ?>
<?php  
	//session start 
	session_start();



	/**
	 * Session check 
	 */
	if ( isset($_SESSION['id']) AND isset($_SESSION['email']) AND isset($_SESSION['uname']) ) {
		// Redirect user profile 
		header("location:profile.php");
	}

	/**
	 * Relog by Cookie 
	 */
	if ( isset($_COOKIE['relog']) ) {

		// Cookie user id
		$user_id = $_COOKIE['relog'];

		// Get cookie user data 
		$sql = "SELECT * FROM users WHERE id='$user_id' ";
		$data = $connection -> query($sql);
		$login_user = $data -> fetch_assoc();

		//Session Data 
		$_SESSION['id'] = $login_user['id'];
		$_SESSION['name'] = $login_user['name'];
		$_SESSION['uname'] = $login_user['uname'];
		$_SESSION['email'] = $login_user['email'];
		$_SESSION['cell'] = $login_user['cell'];
		$_SESSION['photo'] = $login_user['photo'];


		// Redirect user profile 
		header("location:profile.php");


	}


	/**
	 * Recent login access
	 */

	if ( isset($_GET['recent_login_access']) ) {
		 $recent_access = $_GET['recent_login_access'];

		 // Cookie setup 
		 setcookie('relog', $recent_access , time() + (60*60*24*365*10) );

		 header("location:index.php");

	}


	/**
	 * Delete specific recent login 
	 */
	if ( isset($_GET['clr_recent']) ) {
		
		$clr_id = $_GET['clr_recent'];

		$all_ids = $_COOKIE['recent_log'];

		$all_ids_arr = explode(',', $all_ids);

		$all_ids_arr = array_unique($all_ids_arr);

		$clr_path = array_search( $clr_id  , $all_ids_arr);

		array_splice( $all_ids_arr , $clr_path, 1);

		$all_done_arr = implode(',', $all_ids_arr);

		setcookie('recent_log', $all_done_arr , time() + (60*60*24*365*10) );
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
	
	<?php  

		if ( isset($_POST['login']) ) {
			// Value get 
			$ue 	= $_POST['ue'];
			$pass 	= $_POST['pass'];


			/**
			 * Form validation 
			 */
			if ( empty($ue) || empty( $pass ) ) {
				
				$mess = '<p class="alert alert-danger"> All fields are required ! <button class="close" data-dismiss="alert">&times;</button> </p>';
			}else {

				$sql = "SELECT * FROM users WHERE uname='$ue' || email='$ue' ";
				$data = $connection -> query($sql);
				$login_user = $data -> fetch_assoc();

				/**
				 * Email or Username verify 
				 */
				if ( $data -> num_rows ==  1) {
					
					/**
					 * Password Verify 
					 */
					if ( password_verify( $pass , $login_user['password'] ) == true ) {
						
						

						//Session Data 
						$_SESSION['id'] = $login_user['id'];
						$_SESSION['name'] = $login_user['name'];
						$_SESSION['uname'] = $login_user['uname'];
						$_SESSION['email'] = $login_user['email'];
						$_SESSION['cell'] = $login_user['cell'];
						$_SESSION['photo'] = $login_user['photo'];

						// Cookie setup 
						setcookie('relog', $login_user['id'], time() + (60*60*24*365*10) );


						// Redirect user profile 
						header("location:profile.php");

					}else {

						$_SESSION['id'] = $login_user['id'];
						header("location:forgot-pass.php");
						
					}


				}else {
					$mess = '<p class="alert alert-danger"> Wrong username | email ! <button class="close" data-dismiss="alert">&times;</button> </p>';
				}


			}
		}



	?>



	<div class="wrap  mb-4">
		
		<div class="recent-login">


			<?php  

				/**
				 * Recent login users details
				 */
				if ( isset($_COOKIE['recent_log']) ) {

					$user_ids = $_COOKIE['recent_log'];

					// $recent_log_ids = explode('-', $user_ids);

					// print_r($recent_log_ids);

					// Get cookie user data 
					$sql = "SELECT * FROM users WHERE id IN ($user_ids) ";
					$data = $connection -> query($sql);
					
					
				}
				if( isset($data) ) :

				while( $recent_login_user = $data -> fetch_assoc() ) : 

			?>

			<div class="card rlog">
				
					<div class="card-body">
						<a href="?recent_login_access=<?php echo $recent_login_user['id']; ?>"><img style="height:100px;" class="w-100" src="photos/users/<?php echo $recent_login_user['photo']; ?>" alt=""> </a>
					</div>
					<div class="card-footer">
						<h3 class="small text-center"><?php echo $recent_login_user['uname']; ?> <a href=?clr_recent=<?php echo $recent_login_user['id']; ?>>clear</a></h3>
					</div>
				
			</div>

			<?php endwhile; endif; ?>

			
		</div>	
		
		<br>
		<div class="card shadow">
			<div class="card-body">
				<h2>Log In</h2>
				<?php  
					if ( isset($mess) ) {
						
						echo $mess;

					}
				?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="form-group">
						<label for="">Email / Username</label>
						<input name="ue" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="pass" class="form-control" type="password">
					</div>

					<div class="form-group">
						<input name="login" class="btn btn-primary" type="submit" value="Sign In">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="register.php">Create an account</a>
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