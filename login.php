<?php
	require_once "config.php";
	$username = $password = "";
	$username_err = $password_err = "";

	if($_SERVER["REQUEST_METHOD"] =="POST"){
		//check if username is empty
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username.";
		}else{
			$username = trim($_POST['username']);
		}
		//check if password is empty
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter your password.";
		}else{
			$password = trim($_POST['password']);
		}

		if(empty($username_err)&& empty($password_err)){
			$sql = "SELECT username, password FROM users WHERE username=?";
			if($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("s",$param_username);
				$param_username = $username;
				if($stmt->execute()){
					$stmt->store_result();
					if($stmt->num_rows==1){
						$stmt->bind_result($username, $hashed_password);
						if($stmt->fetch()){

							if(password_verify($password,$hashed_password)){
							
								session_start();
								$_SESSION['username']=$username;
								header('location: welcome.php');
							}else{
								$password_err ="Invalid password.";
							}

						}
					}else{
						$username_err = "No account found with that username.";
					}
				}else{
					echo"Oops! something went wrong. Please try again later.";
				}
			}
			$stmt->close();
		}
		$mysqli->close();
	}
?>
<?php
	require_once 'header.php';
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style >
		body{
			font:14px sans-serif;
		}
		.wrapper{
			width: 350px;
			padding: 2opx;
			background-image: url('./images/bgimage.jpg');
			background-repeat: no-repeat;
			width:100%;
			height: 100%;
			background-size: cover;

		}
	</style>
</head>
<body>
	<div class="wrapper">
		<fieldset style="width:40%;padding:1%;color:#ffffff;font-size: 18px;border:0px;">
				<legend style="text-align:center"></legend><h3 style="position: relative;top:10%;left:10%;">Login</h3>
		<p style="position: relative;top:10%;left:10%;">Please fill in your credentials to login.</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="position: relative;top:10%;left:10%;">
			<div class="form-group<?php echo(!empty($username_err)) ? 'has-error' : ''; ?>">
				<label>Username</label><br/>
				<input type="text" name="username" class="form-control" value="<?php echo $username;?>" size="40"/>
				<span class="help-block"><?php echo $username_err;?></span>
			</div>

			<div class="form-group <?php echo(!empty($password_err)) ? 'has-error':'';?>">
				<br/><label>Password</label><br/>
				<input type="password" name="password" class="form-control"  size="40"/>
				<span class="help-block"><?php echo $password_err;?></span>
			</div>

			<div class="form-group">
				<br/><input type="submit" class="btn btn-primary" value="Login">
			</div>
			</form>	
			<p style="position: relative;top:10%;left:10%;">Are you Admin?<a href="admin_login.php"><button style="height: 5%;background: #e8491d;padding-left: 1%;padding-right: 1%;color: #ffffff;border:0px;margin-left: 1%;">Admin</button></a></p>
			<p style="position: relative;top:10%;left:10%;">Don't have an account? <a href="register.php"><button style="height: 5%;background: #e8491d;padding-left: 1%;padding-right: 1%;color: #ffffff;border:0px;margin-left: 1%;">Sign Up Now</button></a></p>
		
	</fieldset>
	</div>
	<?php
		require_once 'footer.php';
	?>
</body>
</html>


				