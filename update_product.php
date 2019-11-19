<?php
	$db = mysqli_connect("localhost", "root", "", "online_shopping");
	$id = $_REQUEST['id'];

  $sql = "SELECT * from product_list where id='$id'";
	$product = mysqli_query($db, $sql);
	$fetch = mysqli_fetch_assoc($product);

	if(isset($_POST['update'])){
    require_once 'config.php';
    $obj = new product();
	  $price = $_POST['price'];
    $marketprice = $_POST['market'];
    $productname = $_POST['productname'];
    $stmt = "UPDATE product_list SET
	price = '".$price."',
	marketprice = '".$marketprice."' , productname = '".$productname."',

	) WHERE id = '".$_REQUEST['id']."'";
	
  $obj->update_query($stmt);
  header('location:admin_view.php');
	
	
}

?>
<?php
	require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<style type="text/css">
   #content{
    width: 40%;
    margin: 20px auto;
    border: 1px solid #cbcbcb;
    height: 60%;
    background-color: gray;
   }
   form{
    width: 50%;
    margin: 20px auto;
   }
   form div{
    margin-top: 5px;
   }
   #img_div{
    width: 80%;
    padding: 5px;
    margin: 15px auto;
    border: 1px solid #cbcbcb;
   }
   #img_div:after{
    content: "";
    display: block;
    clear: both;
   }
   img{
    float: left;
    margin: 5px;
    width: 300px;
    height: 140px;
   }
</style>
</head>
<body>
<div id="content">
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="size" value="1000000"/>

    <div>
     Product Name:<br/>
     <input type="text" name="productname" size="38" value="<?php echo $fetch['productname']?>"/>
    </div>

    <div>
    Market Price:<br/>
    <input type="number" name="market" value="<?php echo $fetch['marketprice']?>"/>
    </div>

    <div>
     Offered Price:<br/>
     <input type="number" name="price" value="<?php echo $fetch['price']?>"/>
    </div>

    <div>
      <input  type="submit" name="update" value="update"/>
      <button>Reset</button>
      <button><a href="admin_view.php">Back</a></button>
    </div>

  </form>
</div>
<?php
	require_once 'footer.php';
?>
</body>
</html>