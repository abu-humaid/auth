<?php include_once "app/db.php"; ?>
<?php include_once "app/function.php"; ?>
<?php  
	//session start 
	session_start();

	/**
	 * Session check 
	 */
	if ( !isset($_SESSION['id']) AND !isset($_SESSION['email']) AND !isset($_SESSION['uname']) ) {
		// Redirect user profile 
		header("location:index.php");
	}
	
	/**
	 * Session check 
	 */
	if ( isset($_SESSION['id']) AND isset($_SESSION['email']) AND isset($_SESSION['uname']) ) {
		// Redirect user profile 
		header("location:profile.php");
	}


	/**
	 * This is not my accounts
	 */
	if ( isset($_GET['not']) AND $_GET['not'] == 'my' ) {
		
		//Session Destroy
		session_destroy();

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
	
	<?php 




		if ( isset($_POST['login']) ) {
			// Value get 
			$pass 	= $_POST['pass'];


			/**
			 * Form validation 
			 */
			if (  empty( $pass ) ) {
				
				$mess = '<p class="alert alert-danger"> All fields are required ! <button class="close" data-dismiss="alert">&times;</button> </p>';
			}else {

				$id = $_SESSION['id'];
				$sql = "SELECT * FROM users WHERE id = '$id' ";
				$data = $connection -> query($sql);
				$login_user = $data -> fetch_assoc();
				

				
					
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
						$mess = '<p class="alert alert-danger"> Wrong pasword ! <button class="close" data-dismiss="alert">&times;</button> </p>';
					}


			
		}

}

	?>



	<div class="wrap  mb-4">
		<div class="card shadow">
			<div class="card-body">
				<h2>Log In</h2>
				<?php  
					if ( isset($mess) ) {
						
						echo $mess;

					}
				?>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					
					<?php  

						if ( isset($_SESSION['id']) ) {
							$id = $_SESSION['id'];
							$sql = "SELECT * FROM users WHERE id = '$id ' ";
							$data = $connection -> query($sql);
							$login_user = $data -> fetch_assoc();
						}

					?>
					<img style="width:100px;height:100px;border-radius: 50%;display:block;margin: auto;border:10px solid #FFF" class="shadow" src="photos/users/<?php echo $login_user['photo']; ?>" alt="">
					<h2 class="lead text-center"><?php echo $login_user['name']; ?></h2>

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
				<a href="?not=my">This is not my account</a>
			</div>
		</div>
		<br>



	</div>
	







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>