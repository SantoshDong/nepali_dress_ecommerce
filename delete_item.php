<?php
	$db = mysqli_connect("localhost", "root", "", "online_shopping");
	$id = $_REQUEST['id'];
	echo $id;
	/*$sql = "DELETE from product_list where id='$id'";
	mysqli_query($db, $sql);
	header('location:admin_view.php');*/

?>
<?php 
		if(isset($_POST['confirm'])||isset($_POST['submit'])){
			$username = $row['username'];
			$phone = $row['phone'];
			$email = $row['email'];
			$address = $row['address'];
			$qty = $_POST['quantity'];
			echo $username.$phone.$email.$address.$qty;
		}
	?>