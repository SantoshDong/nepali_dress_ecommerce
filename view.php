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
    width: 100%;
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
   button:hover {
    border-color:  red;
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
nav {
  border-bottom: #e8491d 3px solid;
  background-color: #35424a;
}
}
</style>
</head>
<body>
   <nav>
    <img id="header" src="./images/logo2.jpg"  width="60%" height=" 100px" alt="Web Site logo"/>
    <a href="welcome1.php"><button style="margin-bottom: 0.5%;">Home</button></a>
    <a href="logout.php"><button style="margin-bottom: 0.5%;">Log Out</button></a>
  </nav>

<div id="content">

  <?php
    while ($row = mysqli_fetch_array($result)) {
        
        echo "<div id='img_div'>";
        echo "<img  id='img_header' src='images/".$row['image_location']."' >";
        echo "<p><b>First Name: ".$row['first_name']."</b></p>";
        echo "<p>Last Name: ".$row['last_name']."</p>";
        echo "<p>Market Price Rs: <del>".$row['marketprice']."</del>"."</p>";
        echo "Offered Price Rs: ".$row['price'];
        echo "<p><a href='update.php?id= ".$row['tbl_image_id']."'><button>Update</button></a>||<a href='delete_product.php?id= $row[tbl_image_id]'><button>Delete</button></a></p>";
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
