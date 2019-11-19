<?php
	$db = mysqli_connect("localhost", "root", "", "online_shopping");
	$id = $_REQUEST['id'];
	$sql = "DELETE from product where tbl_image_id='$id'";
	mysqli_query($db, $sql);
	header('location:view.php');

?>