<?php
 session_start();
require_once ('db.php');

 
if (isset($_POST['Submit'])) {
// echo "";
// }else{
// $file=$_FILES['image']['tmp_name'];
// $image = $_FILES["image"] ["name"];
// $image_name= addslashes($_FILES['image']['name']);
// $size = $_FILES["image"] ["size"];
// $error = $_FILES["image"] ["error"];
// 
// if ($error > 0){
// die("Error uploading file! Code $error.");
// }else{
// 	if($size > 10000000) //conditions for the file
// 	{
// 	die("Format is not allowed or file size is too big!");
// 	}
// 	
// else
// 	{
move_uploaded_file($_FILES["image"]["tmp_name"],"images/" . $_FILES["image"]["name"]);		

$location=$_FILES["image"]["name"];
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$marketprice = $_POST['marketprice'];
$price = $_POST['price'];
 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO product (first_name, last_name, image_location,price,marketprice)
VALUES ('$fname', '$lname', '$location','$price','$marketprice')";
 
$conn->exec($sql);
//echo "<script>alert('Successfully Added!!!'); window.location='index.php'</script>";
// }
?>
<script> alert('Successfully Uploaded!!');window.location='view.php'</script><?php
}
// }
?>

<?php
  require_once 'header.php';
?>

<!DOCTYPE html>
<head>
	<style>
	.wrapper{
			width: 350px;
			padding: 2opx;
			background-image: url('./images/dsc.jpg');
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
				<legend style="text-align:center"></legend><h3 style="position: relative;top:10%;left:10%;">Upload an item</h3>
<form method="post"   enctype="multipart/form-data" style="position: relative;top:10%;left:10%;">

		<label style=" font-size:18px;">Select your Image</label><br/>
		<input type="file" name="image"><br/>
	
	
		<br/><label style=" font-size:18px;">ProductName</label><br/>
		
		<input type="text" name="first_name" placeholder="FirstName" size="50" required /><br/>
	

	
		<br/><label style=" font-size:18px;">Description</label><br/>
		
		<input type="text" name="last_name" placeholder="Product Description" size="50" required /><br/>
	
		<br/><label style=" font-size:18px;">Market Price</label><br/>
		
		<input type="number" name="marketprice"><br/>
	
		<br/><label style="font-size:18px;">Offered Price</label><br/>
		
		<input type="number" name="price"><br/>

    
 
    <br/> <button>Reset</button>
	<button type="submit" name="Submit" class="btn btn-primary">Upload</button>
    </form>
    <a href="welcome1.php"><button style="margin-left: 10%">Back</button></a>

</fieldset>
</div>

<?php
  require_once 'footer.php';
?>
</body>
</html>