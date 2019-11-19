<?php
	$id= $_REQUEST['id'];
	$db = mysqli_connect("localhost", "root", "", "online_shopping");
	$sql = "SELECT * from product where tbl_image_id ='$id'";
	$product = mysqli_query($db, $sql);
	$fetch = mysqli_fetch_assoc($product);
	$location =  $fetch['image_location'];
?>
<?php
	require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<style>
	.wrapper{
			width: 350px;
			padding: 2opx;
			background-image: url('./images/digital.jpg');
			background-repeat: no-repeat;
			width:100%;
			height: 100%;
			background-size: cover;

		}
	</style>
</head>
<body><div class="wrapper">
		<fieldset style="width:50%;padding:1%;color:#ffffff;font-size: 18px;border:0px">
		<h3 id="myModalLabel" style="margin-left: 20%;text-transform: uppercase;">Update</h3>
<form method="post" enctype="multipart/form-data" style="width:30%;position: relative;top:10%;left:10%;margin-top:1%;margin-bottom: 1%">
<?php if( $location != ""): ?>
<img src="images/<?php echo $fetch['image_location']; ?>" width="200px" height="200px" >
<?php else: ?>
<img src="images/default.png" width="100px" height="100px" >
<?php endif; ?>

	<br/><input type="file" name="image" style="margin-top:-115px;"><br/>
	
    <br/>Product Name:<br/>
     <input type="text" name="productname"  value="<?php echo $fetch['first_name']?>"/><br/>
    

   
    <br/>Market Price:<br/>
    <input type="number" name="market" value="<?php echo $fetch['marketprice']?>" size="40"/><br/>
   

   
     <br/>Offered Price:<br/>
     <input type="number" name="price" value="<?php echo $fetch['price']?>" size="40"/><br/>
   
<br/><button type="submit" name="submit" class="btn btn-danger">Yes</button>
</form>
<a href="welcome1.php"><button style="margin-left: 10%;">No</button></a>
</fieldset>
</div>
<?php
 
require_once ('db.php');
if(isset($_POST['submit'])){
move_uploaded_file($_FILES["image"]["tmp_name"],"images/" . $_FILES["image"]["name"]);			
$location1=$_FILES["image"]["name"];
if( $location1 == ""){
	$location12 = $fetch['image_location'];
}
else{
$location12 = $location1;
}
$fname = $_POST['productname'];
$marketprice = $_POST['market'];
$price = $_POST['price'];
  

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE product SET image_location ='$location12', first_name = '$fname', price = '$price', marketprice = '$marketprice' WHERE tbl_image_id = '$id'  ";
 
$conn->exec($sql);
echo "<script>alert('Successfully Updated!!!');window.location='view.php'</script>";
}
?>
<?php 
	require_once 'footer.php';
?>
</body>
</html>

