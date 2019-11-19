

<!DOCTYPE html>
<html>
<style>
	#header {
		width: 100%;
	}
	nav{
		 border-bottom: #e8491d 3px solid;
	}
</style>
</head>
<body>
	<nav>
		<img id="header" src="./images/online.jpg"  width="60%" height=" 100px" alt="Web Site logo"/>
		<a href="welcome1.php"><button style="margin-bottom: 0.5%;">Home</button></a>
	</nav>
	<table cellpadding="1%" cellspacing="1%" style="border:1px solid gray;width:95%;position: relative;top:3%;left:5%;margin-top:3%">
			<caption style="text-align: center;font-family: sans-serif;">Total Order List </caption>
			<tr>
				<th>Username</th>
				<!--<th>Phone</th>-->
				<th>Email</th>
				<th>Address</th>
				<!--<th>Product Name</th>-->
				<th>Quantity Ordered</th>
				<th>Total Price</th>
				<th>Ordered Time</th>
				<th><pre style="font-size: 18px">Phone Number	Product Name 	   Action</pre></th>
			</tr>
			<?php
			$db = mysqli_connect("localhost", "root", "", "online_shopping");
			$sql = "SELECT * from order_list";
			$user = mysqli_query($db, $sql);
			while($row = mysqli_fetch_assoc($user)){
			?>
				<tr style="text-align: center;font-family: sans-serif;">
					<td><?php echo $row['username']?> </td>
					<!--<td><?php echo $row['phone']?></td>-->
					<td><?php echo $row['email']?></td>
					<td><?php echo $row['address']?></td>
					<!--<td><?php echo $row['productname']?></td>-->
					<td><?php echo $row['quantity']?></td>
					<td><?php echo $row['total']?></td>
					<td><?php echo $row['created_at']?></td>
					<td><form method="post">
						<input type="text" name="productname" value="<?php echo $row['phone']?>"/>
						<input type="text"  name="upload" value="<?php echo $row['productname']?>"/>
						<input type="submit"  name="submit" value="Delivered"></form></td>
				</tr>

				<?php
					}
				?>
	</table>
			<?php
				if(isset($_POST['submit'])){
					$phone = $_POST['productname'];
					$productname = $_POST['upload'];
					$db = mysqli_connect("localhost", "root", "", "online_shopping");
					$sql1 = "SELECT * from order_list where phone = '$phone' AND productname = '$productname'";
					$user1 = mysqli_query($db, $sql1);
					$row1 = mysqli_fetch_assoc($user1);

					$username = $row1['username'];
					$email = $row1['email'];
					$address = $row1['address'];
					$quantity = $row1['quantity'];
					$total = $row1['total'];

					$sql2 = "INSERT INTO deliver_list (username,phone,email,address,productname,quantity,total) values('$username','$phone','$email','$address','$productname','$quantity','$total')";
					mysqli_query($db, $sql2);

			?>


	<table cellpadding="1%" cellspacing="1%" style="border:1px solid gray;width:95%;position: relative;top:3%;left:5%;margin-top:5%;margin-bottom:2%">
		<caption style="text-align: center;font-family: sans-serif;">Total Order Delivered</caption>
		<tr>
				<th>Username</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Address</th>
				<th>Product Name</th>
				<th>Quantity Delivered</th>
				<th>Total Price</th>
				<th>Delivered Time</th>
				<th>Clear List</th>
			</tr>

			<?php
			$db = mysqli_connect("localhost", "root", "", "online_shopping");
			$sql3 = "SELECT * from deliver_list";
			$user3 = mysqli_query($db, $sql3);
			while($row3 = mysqli_fetch_assoc($user3)){
			?>

			<tr style="text-align: center;font-family: sans-serif;">
					<td><?php echo $row3['username']?> </td>
					<td><?php echo $row3['phone']?></td>
					<td><?php echo $row3['email']?></td>
					<td><?php echo $row3['address']?></td>
					<td><?php echo $row3['productname']?>
					<td><?php echo $row3['quantity']?></td>
					<td><?php echo $row3['total']?></td>
					<td><?php echo $row3['created_at']?></td>
					<td><form method="post"><input type="submit" name="clear" Value="Clear"/></form></td>
			</tr>
			<?php
				}
					$sql4 = "DELETE FROM order_list WHERE phone ='$phone' AND productname = '$productname' AND total='$total' AND username = '$username'";
					mysqli_query($db,$sql4);


			}
			?>
	</table>
	<?php
		require_once 'footer.php'
	?>
</body>
</html>