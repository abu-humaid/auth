
<?php include_once "app/db.php"; ?>
<?php include_once "app/function.php"; ?>

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

		$mess[] = '';
		if ( isset( $_POST['register'] ) ) {
			
			// get value 
			$name = $_POST['name'];
			$email = $_POST['email'];
			$uname = $_POST['uname'];
			$cell = $_POST['cell'];


			// Username check
			$user_name_check = unique($connection, 'users', 'uname', $uname);

			// Email check
			$email_check = unique($connection, 'users', 'email', $email);

			// Cell check
			$cell_check = unique($connection, 'users', 'cell', $cell);

			// Pass Hash
			$pass = $_POST['pass'];
			$pass_hash = password_hash( $pass , PASSWORD_DEFAULT);

			// Confirm password
			$cpass = $_POST['cpass'];
			if ( $pass == $cpass ) {
				$password_check = true;
			}else {
				$password_check = false;
			}
			


			// Value check 
			if($user_name_check == false){
				$mess[] = '<p class="alert alert-warning">Username already exists ! <button class="close" data-dismiss="alert">&times;</button> </p>';
			}else{
				$mess[] = '';
			}

			if($email_check == false){
				$mess[] = '<p class="alert alert-warning">Email already exists ! <button class="close" data-dismiss="alert">&times;</button> </p>';
			}else{
				$mess[] = '';
			}

			if($cell_check == false){
				$mess[] = '<p class="alert alert-warning">Cell already exists ! <button class="close" data-dismiss="alert">&times;</button> </p>';
			}else{
				$mess[] = '';
			}






			if ( empty($name) || empty($uname) || empty($email) || empty($cell) || empty($pass) ) {
				$mess[] = '<p class="alert alert-danger"> All fields are required ! <button class="close" data-dismiss="alert">&times;</button> </p>';
			}elseif( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){
				$mess[] = '<p class="alert alert-danger">Invalid Email Address ! <button class="close" data-dismiss="alert">&times;</button> </p>';
			}elseif( $password_check == false ){
				$mess[] = '<p class="alert alert-warning">Password not match ! <button class="close" data-dismiss="alert">&times;</button> </p>';
			}else {


				if ( $email_check == true AND $cell_check == true AND $user_name_check == true ) {

					$data = fileUp($_FILES['photo'], 'photos/users/');
					$photo_name = $data['file_name'];

					if ( $data['status'] == 'yes' ) {


						$sql = "INSERT INTO users ( name, uname, email, cell, password, photo ) VALUES ( '$name','$uname','$email','$cell','$pass_hash','$photo_name' )";
						$connection -> query($sql);

						setMsg('User registration successful !');

						header("location:register.php");
					}else {

						$mess[] = '<p class="alert alert-danger">Invalid File format ! <button class="close" data-dismiss="alert">&times;</button> </p>';

					}
					
				}

				

				

			}

		}

	?>
	

	<div class="wrap shadow">

		<div class="card">
			<div class="card-body">
				<h2>Create an account</h2>

				<?php  

					if ( count($mess) > 0 ) {
						
						foreach ( $mess as $m ) {
							echo $m;
						}

					}

					getMsg();

				?>


				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" value="<?php echo old('name'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Username</label>
						<input name="uname" class="form-control" value="<?php echo old('uname'); ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" value="<?php echo old('email'); ?>" type="text">
					</div>
					
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" value="<?php echo old('cell'); ?>" type="text">
					</div>

					<div class="form-group">
						<label for="">Password</label>
						<input name="pass" class="form-control"  type="password">
					</div>

					<div class="form-group">
						<label for="">Confirm Password</label>
						<input name="cpass" class="form-control"  type="password">
					</div>

					<div class="form-group">
						<label for="">Photo</label>
						<input name="photo" class="form-control" type="file">
					</div>
					
					<div class="form-group">
						<input name="register" class="btn btn-primary" type="submit" value="Sign Up">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<a href="index.php">Log in now</a>
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