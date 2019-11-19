<?php
  $db = mysqli_connect("localhost", "root", "", "online_shopping");
   $result = mysqli_query($db, "SELECT * FROM product_list");
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
   	width: 100%;
   	margin: 20px auto;
   
    padding:1%;
   }
   div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 40%;
   	padding: 3px;
   	margin: 10px auto;
   	
   }
   #img_div{
    float:left;
    width: 30%;

   }
   img{
    float:left;
   	margin: 2%;
   	width: 50%;
   	height: 50%;
   }
   #footer  {
    clear :both;

   }
   p {
    font-size: 16px;
   }
</style>
</head>
<body>
<div id="content">
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
        echo "<img src='images/".$row['image']."' >";
        echo "Id:".$row['id']."<br/>";
        echo "<p><b>Product Name: ".$row['productname']."</b></p>";
        echo "<p>Description: ".$row['image_text']."</p>";
        echo "<p>Market Price Rs: <del>".$row['marketprice']."</del>";
        echo "<p>Offered Price Rs: ".$row['price']."<br/>";
        echo "<p><a href='update_product.php?id= ".$row['id']."'>[Update]</a>||<a href='delete_product.php?id= $row[id]'>[Delete]</a></p>";
      echo "</div>";
    }
  ?>
</div>
<div id="footer">
<?php
  require_once 'footer.php';
?>

</div>

</body>
</html>
