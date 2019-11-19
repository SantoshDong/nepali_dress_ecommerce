<?php
	session_start();
	if(!isset($_SESSION['username'])||empty($_SESSION['username'])){
		header('location: login.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php 
require_once 'consumer_view.php';
 ?>
</body>
</html>
<?php
	require_once 'footer.php';
?>