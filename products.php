<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "online_shopping");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    $image_text = mysqli_real_escape_string($db, $_POST['image_text']);
    $price = $_POST['price'];
    $marketprice = $_POST['market'];
    $productname = $_POST['productname'];
    // image file directory
    $target = "images/".basename($image);

    $sql = "INSERT INTO product_list (image, image_text,price,marketprice,productname) VALUES ('$image', '$image_text','$price','$marketprice','$productname')";
    // execute query
    mysqli_query($db, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Product has been Uploaded successfully!!!";
    }else{
      $msg = "Failed to upload image";
    }
  }
  echo $msg;
 // $result = mysqli_query($db, "SELECT * FROM product_list");
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
 <!-- <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
        echo "<img src='images/".$row['image']."' >";
        echo "Product Name:".$row['productname']."<br/>";
        echo "Description: ".$row['image_text']."</p>";
        echo "Market Price Rs: ".$row['marketprice']."<br/>";
        echo "Offered Price Rs: ".$row['price']."<br/>";
      echo "</div>";
    }
  ?>-->
  <form method="POST" action="products.php" enctype="multipart/form-data">
    <input type="hidden" name="size" value="1000000">
    <div>
     Product Name:<br/>
     <input type="text" name="productname" size="38">
    </div>
    <div>
     <br/> <input type="file" name="image">
    </div>
    <div>
      <br/><textarea 
        id="text" 
        cols="40" 
        rows="4" 
        name="image_text" 
        placeholder="Say something about this image..."></textarea>
    </div>
    <div>
    Market Price:<br/>
    <input type="number" name="market"/>
    </div>

    <div>
     Offered Price:<br/>
     <input type="number" name="price"/>
    </div>

    <div>
      <button type="submit" name="upload">POST</button>
      <button>Reset</button>
      <button><a href="welcome1.php">Back</a></button>
    </div>

  </form>
</div>
<?php
 require_once 'footer.php';
 ?>

</body>
</html>
