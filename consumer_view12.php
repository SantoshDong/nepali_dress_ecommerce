<?php
  $db = mysqli_connect("localhost", "root", "", "online_shopping");
   $result = mysqli_query($db, "SELECT * FROM product");
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
#header {
    float:left;
    width: 100%;
    position: relative;
    top: 10%;
    left: 20%;
    clear:both;
  }

  #img_div{
    
    padding: 3px;
    margin: 10px auto;
    width:30%;
   }

   #img_div{
    float:left;
    width: 30%;
    height: 30%;
  }
  div{
    margin-top: 5px;
   }
  #img_header {
    float:left;
    height: 50%;
    width: 45%;

  }
  #footer  {
    clear :both;

   }
   #header {
    width: 100%;
    position: relative;
    top: 10%;
    left: 20%;
  }
  nav{
     border-bottom: #e8491d 3px solid;
  }
</style>
</head>
<body>
<div id="content">

  <?php
    while ($row = mysqli_fetch_array($result)) {
        
        echo "<div id='img_div'>";
        echo "<img  id='img_header' src='images/".$row['image_location']."' >";
        echo "<p><b>First Name: ".$row['first_name']."</b></p>";
        echo "<p>Last Name: ".$row['last_name']."</p>";
        echo "<p>Market Price Rs: <del>".$row['marketprice']."</del>"."</p>";
        echo "Offered Price Rs: ".$row['price'];
  ?>

        <form method="post">
          <input type="submit" name="submit" value="BUY"/>
        </form>
        <?php
        if(isset($_POST['submit'])){
        ?>
        <script>alert("Oops!! Seems Like You Don't have an Account");</script>
        <?php
        }
        echo "</div>";
      }
  ?>
</div>
<div id="footer">
</div>
</body>
</html>
