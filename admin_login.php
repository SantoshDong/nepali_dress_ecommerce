<?php
	require_once "config.php";
	$adminname = $adminpassword = "";
	$adminname_err = $adminpassword_err = "";

	if($_SERVER["REQUEST_METHOD"] =="POST"){
		//check if username is empty
		if(empty(trim($_POST["adminname"]))){
			$adminname_err = "Please enter username.";
		}else{
			$adminname = trim($_POST['adminname']);
		}
		//check if password is empty
		if(empty(trim($_POST["adminpassword"]))){
			$adminpassword_err = "Please enter your password.";
		}else{
			$adminpassword = trim($_POST['adminpassword']);
		}

		if(empty($adminname_err)&& empty($adminpassword_err)){
			$sql = "SELECT adminname, password FROM admin WHERE adminname=?";
			if($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("s",$param_adminname);
				$param_adminname = $adminname;
				if($stmt->execute()){
					$stmt->store_result();
					if($stmt->num_rows==1){
						$stmt->bind_result($adminname, $password);
						if($stmt->fetch()){
							if($password == $adminpassword){
								session_start();
								$_SESSION['adminname']=$adminname;
								header('location: welcome1.php');
							}else{
								$adminpassword_err ="Invalid password.";
							}

						}
					}else{
						$adminname_err = "Sorry! You are not Admin.";
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
	<title>Admin Login</title>
	<style>
		body{
			font:14px sans-serif;
		}
		.wrapper{
			width: 350px;
			padding: 2opx;
			background-image: url('./images/background.png');
			background-repeat: no-repeat;
			width:100%;
			height: 100%;
			background-size: cover;

		}
	</style>
</head>				
<body>
	<div class="wrapper">
		<fieldset style="width:40%;padding:1%;color:#ffffff;font-size: 18px;border:0px">
				<legend style="text-align:center"></legend><h3 style="position: relative;top:10%;left:10%;">Admin Login</h3>
		<p style="position: relative;top:10%;left:10%;">	  Please fill in your credentials to login.</p>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="position: relative;top:10%;left:10%">
			<div class="form-group<?php echo(!empty($adminname_err)) ? 'has-error' : ''; ?>">
				<label>Admin name</label><br/>
				<input type="text" name="adminname" class="form-control" value="<?php echo $adminname;?>" size="40"/>
				<span class="help-block"><?php echo $adminname_err;?></span>
			</div>

			<div class="form-group <?php echo(!empty($password_err)) ? 'has-error':'';?>">
				<br/><label>Password</label><br/>
				<input type="password" name="adminpassword" class="form-control"  size="40"/>
				<span class="help-block"><?php echo $adminpassword_err;?></span>
			</div>

			<div class="form-group">
				<br/><input type="submit" class="btn btn-primary" value="Login">
			</div>	
		</form>
			
			<p style="position: relative;top:10%;left:10%;">Are you not Admin?<a href="login.php"><button style="height: 5%;background: #e8491d;padding-left: 1%;padding-right: 1%;border:0px;color: #ffffff;margin-left: 1%">Login</button></a></p>
			<p style="position: relative;top:10%;left:10%;">Don't have an account? <a href="register.php"><button style="height: 5%;background: #e8491d;padding-left: 1%;border:0px;padding-right:1%;color: #ffffff;margin-left: 1%">Sign Up Now</button></a></p>
	</fieldset>
	</div>
<?php
	require_once 'footer.php';
?>
</body>
</html>