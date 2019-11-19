<?php
	session_start();

	if(!isset($_SESSION['adminname'])|| empty($_SESSION['adminname'])){
		header('location: login.php');
		exit;
	}
?>
<?php
	require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome Admin</title>
	<style>
	a{
		text-decoration: none;
		margin-left: 1%;

		font-size: 30px;
		color:white;
		font-family: sans-serif;
	}
	#admin_view {
		background-image: url('./images/adminbg.jpg');
		background-repeat: no-repeat;
		background-size:cover;
		
	}
	a:hover {
		color:red;
	}
	</style>
</head>
<body>

	
   
            <nav id="admin_view">
                
                
                    <br/><br/><a href="view.php">View Products</a><br/><br/><br/>
					<a href="add.php">Add Products</a><br/><br/><br/>
					<a href="view.php">Delete</a><br/><br/><br/>
					<a href="view.php">Update</a><br/><br/><br/>
					<a href="total_orders_list.php">Total orders</a><br/><br/><br/>
					<a href="logout.php">Log Out</a><br/><br/><br/>
            </nav>
   
<?php
	require_once 'footer.php';
?>
</body>
</html>
