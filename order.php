<?php
	session_start();

	$db = mysqli_connect("localhost", "root", "", "online_shopping");
	$id = $_REQUEST['id'];
	$username = $_SESSION['username']; 

	$sql = "SELECT * from product where tbl_image_id ='$id'";
	$product = mysqli_query($db, $sql);
	$fetch = mysqli_fetch_assoc($product);

	$stmt = "SELECT * from users where username ='$username' ";
	$user = mysqli_query($db, $stmt);
	$row = mysqli_fetch_assoc($user);
?>

<!DOCTYPE html>
<head>
	<title>Order Product</title>
	<style>
	nav {
  border-bottom: #e8491d 3px solid;
  background-color: #35424d;
}
li {
    display:inline;
    text-decoration: none;
    padding: 0 20px 0 20px;
  }
  a {
    text-decoration: none;
    font-size: 16px;
}
#header {
		width: 100%;
	}

</style>
</head>
<body>
	 <nav>
    <img  id="header" src="./images/logo2.jpg"  width="100%" height=" 100px" alt="Web Site logo"/>
    <a href="welcome.php"><button style="margin-bottom: 0.5%;margin-left: 2%">Home</button></a>
     <a href="Logout.php"><button style="margin-bottom: 0.5%;margin-left: 2%">Log Out</button></a>
  </nav>
	<br/><br/><table cellpadding="1%" cellspacing="1%" style="border:1px solid gray;width:75%;position: relative;top:5%;left:10%"><caption style="text-align: center;font-family: sans-serif;font-size:18px">Make Order</caption>
		<tr>
			<th>Username</th>
			<th>Phone</th>
			<th>email</th>
			<th>Address</th>
			<th>Product Name</th>
			<th>Quantity</th>
			<th>Price/Unit</th>
			<th>Total</th>
			<th>Action</th>
		</tr>

		<tr style="text-align: center;font-family: sans-serif;">
			<td><?php echo $row['username']?></td>
			<td><?php echo $row['phone']?></td>
			<td><?php echo $row['email']?></td>
			<td><?php echo $row['address']?></td>
			<td><?php echo $fetch['first_name']?></td>
			<td><form method="post">
			<input type="number" name="quantity"><input type="submit" name="submit" value="OK"/>
			</form></td>
			<td><?php echo $fetch['price']?></td>
			<td><?php if(isset($_POST['submit'])){ $_SESSION['qty'] = $_POST['quantity']; if($_SESSION['qty']<0){
				echo "Quantity cannot less be than zero";}else{$_SESSION['total'] = $_SESSION['qty'] * $fetch['price']; echo $_SESSION['total']; }} ?></td>
			<!--<td><a href="delete_item.php?id=<?php echo $id?>">Delete</a></td>-->
			<td><form method="post"><input type="submit" value="Delete" name="delete"/></form><form method="post">
				<input type="submit" value="confirm" name="confirm"/></form></a></td>
		</tr>
		<tr style="text-align: center;font-family: sans-serif;">
			<td colspan="9"><span style="background-color:#35424a;color:white ;font-size: 24px;text-align: center;font-family: sans-serif;">Be Carefull !! Once Confirm is DONE, DELETION is not POSSIBLE</span></td>
		</tr>

	</table>
	<?php
		if(isset($_POST['confirm'])){
			$username = $row['username'];
			$phone = $row['phone'];
			$email = $row['email'];
			$address = $row['address'];
			$productname = $fetch['first_name'];

			$qty = $_SESSION['qty'];
			$total = $_SESSION['total'];

			$db = mysqli_connect("localhost", "root", "", "online_shopping");

			$sql2 = "INSERT INTO order_list (username,phone,email,address,productname,quantity,total) VALUES ('$username','$phone','$email','$address','$productname','$qty','$total')";
			mysqli_query($db, $sql2);
		}
	?>
	<?php
		if(isset($_POST['delete'])){
	?>
		<script>
			alert ("order deleted successfully");
		</script>
	
	<?php
	}
	?>

	<div id="view_all_record">
		<table cellpadding="1%" cellspacing="1%" style="border:1px solid gray;width:75%;position: relative;top:5%;left:10%;margin-bottom: 10%;margin-top: 5%">
			<caption style="text-align: center;font-family: sans-serif;font-size:18px">Total Ordered Made</caption>
			<tr>
				<th>Username</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Address</th>
				<th>Product Name</th>
				<th>Quantity Ordered</th>
				<th>Total Price</th>
				<th>Ordered Time</th>
			</tr>

				<?php
					$username = $row['username'];
					$phone = $row['phone'];
					$email = $row['email'];
					$sql3 = "SELECT * from order_list where username = '$username' AND phone = '$phone' AND email = '$email'";
					$item = mysqli_query($db, $sql3);
					while($get = mysqli_fetch_assoc($item)){
				?>
				<tr style="text-align: center;font-family: sans-serif;">
					<td><?php echo $get['username']?> </td>
					<td><?php echo $get['phone']?></td>
					<td><?php echo $get['email']?></td>
					<td><?php echo $get['address']?></td>
					<td><?php echo $get['productname']?></td>
					<td><?php echo $get['quantity']?></td>
					<td><?php echo $get['total']?></td>
					<td><?php echo $get['created_at']?></td>
				</tr>

				<?php
					}
				?>

		</table>
	</div>
<?php 
	require_once 'footer.php';
?>
</body>
</html>