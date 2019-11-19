<?php
	require_once "config.php";
	$username = $password = $confirm_password = $email =$address= $phone = "";
	$username_err = $password_err = $confirm_password_err =$email_err = $address_err=$phone_err ="";

	if($_SERVER["REQUEST_METHOD"] =="POST"){
		//validate username
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter a username.";
		}
		else {
			$sql = "SELECT id from users WHERE username = ?";
			if($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("s",$param_username);
				$param_username = trim($_POST['username']);
				if($stmt->execute()){
					$stmt->store_result();

					if($stmt->num_rows ==1){
						$username_err = "This username is alreadytaken";
					}
					else{
						$username = trim($_POST['username']);
					}
				}else{
					echo"Oops! Something went wrong. Please try again later.";

				}
			}
			$stmt->close();
		}

		//validate user email
		if(empty(trim($_POST['email']))){
			$email_err = "Please enter email address.";
		}else{
			$email = trim($_POST['email']);
		}

		//validate user address
		if(empty(trim($_POST['address']))){
			$address_err = "Please enter address.";
		}else{
			$address = trim($_POST['address']);
		}


		//validate user password
		if(empty(trim($_POST['password']))){
			$password_err = "Please enter a password.";
		}elseif(strlen(trim($_POST['password']))<8){
			$password_err = "Password must have at least 8 characters.";
		}else{
			$password = trim($_POST['password']);
		}

		//validate user phone number
		if(empty(trim($_POST['phone']))){
			$phone_err = "Please enter phone number.";
		}elseif(!preg_match("/(98|97|96)[0-9]{8}$/",$_POST['phone'])){
			$phone_err = "Invalid phone number.";
		}else{
			$phone = trim($_POST['phone']);
		}

		//validate confirm password
		if(empty(trim($_POST['confirm_password']))){
			$confirm_password_err ="Please confirm password.";
		}else{
			$confirm_password = trim($_POST['confirm_password']);
			if($password != $confirm_password){
				$confirm_password_err = "Password did not match.";
			}
		}

		if(empty($username_err)&& empty($password_err)&&empty($confirm_password_err) && empty($emial_err)&& empty($address_err)&& empty($phone_err)){
			$sql = "INSERT INTO users (username,email,password,address,phone) VALUES(?,?,?,?,?)";

			if($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("sssss",$param_username,$param_email,$param_password,$param_address,$param_phone);
				$param_username = $username;
				$param_email = $email;
				$param_address = $address;
				$param_phone = $phone;
				$param_password = password_hash($password,PASSWORD_DEFAULT);
				if($stmt->execute()){
					header("location: login.php");
				}else{
					echo"Something went wrong. Please try again later.";
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
	<title>Sign Up</title>
	<style>
		body{
			font:14px sans-serif;
		}
		.wrapper{
			width: 350px;
			padding: 2opx;
			background-image: url('./images/back1.jpg');
			background-repeat: no-repeat;
			width:100%;
			height: 100%;
			background-size: cover;

		}
	</style>
</head>
<body>
	<div class="wrapper">
		<fieldset style="width:50%;padding:1%;color:#ffffff;font-size: 18px;border:0px">
				<legend style="text-align:center"></legend><h3 style="position: relative;top:10%;left:10%;">Sign Up</h3>
		<p style="position: relative;top:10%;left:10%;">Please fill this form to create an account.</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="position: relative;top:10%;left:10%;">
			<!--user name-->
			<div class="form-group<?php echo(!empty($username_err)) ? 'has-error' : ''; ?>">
				<label>Username/Full name</label><br/>
				<input type="text" name="username" class="form-control" value="<?php echo $username;?>" size="50"/>
				<span class="help-block"><?php echo $username_err;?></span>
			</div>
				<!--user address-->
					<div class="form-group<?php echo(!empty($gender_err)) ? 'has-error' : ''; ?>" style="font:sans-serif">
						<br/><label style="font:sans-serif">Address:</label>
						<br/><input type="text" name="address" class="form-control" value="<?php echo $address;?>" size="50"/>
						<span class="help-block"><?php echo $address_err;?></span>
					</div>
				<div class="form-group<?php echo(!empty($email_err)) ? 'has-error' : ''; ?>" style="font:sans-serif">
						<br/><label style="font:sans-serif">Email Id:</label><br/>
						<input type="email" name="email" class="form-control" value="<?php echo $email;?>" size="50"/>
						<span class="help-block"><?php echo $email_err;?></span>
					</div>

					<!--user phone number-->
					<div class="form-group<?php echo(!empty($username_err)) ? 'has-error' : ''; ?>" style="font:sans-serif">
						<br/><label style="font:sans-serif">Phone No:</label><br/>
						<input type="text" name="phone" class="form-control" value="<?php echo $phone;?>" size="50"/>
						<span class="help-block"><?php echo $phone_err;?></span>
					</div>

			<div class="form-group <?php echo(!empty($password_err)) ? 'has-error':'';?>">
				<br/><label>Password</label><br/>
				<input type="password" name="password" class="form-control" value="<?php echo $password;?>" size="50"/>
				<span class="help-block"><?php echo $password_err;?></span>
			</div>

			<div class="form-group <?php echo(!empty($confirm_password_err)) ? 'has-error' : '' ; ?>">
				<br/><label>Confirm Password</label><br/>
				<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password;?>" size="50"/>
				<span class="help-block"><?php echo $confirm_password_err;?></span>
			</div>

			<div class="form-group">
				<br/><input type="submit" class="btn btn-primary" value="Submit">
				<input type="reset" class="btn btn-default" value="Reset">
			</div></form>

			<p style="position: relative;top:10%;left:10%;">Already have an account?<a href="login.php"><button style="height: 5%;background: #e8491d;padding-left: 1%;padding-right: 1%;color: #ffffff;border:0px;margin-left: 1%;">Login here</button> </a>
				<a href="index.php"><button style="height: 5%;background: #e8491d;padding-left: 1%;padding-right: 1%;color: #ffffff;border:0px;margin-left: 1%;">Home</button> </a></p>
		
	</fieldset>
	</div>
<?php
	require_once 'footer.php';
?>
</body>
</html>
