<?php 
include "storescripts/connect_to_mysql.php"; 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
include "storescripts/connect_to_mysql.php"; 
	
session_start();
$toplinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];
	$toplinks = '<a href="storeuser/user_profile.php?id=' . $userid . '"><img src="storeuser/user_images/' . $userid . '.jpg"  width="40" height="40" border="1" /><a href="storeuser/user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="storeuser/user_account.php">Account</a> &bull; 
	<a href="storeuser/user_logout.php">Log Out</a>';
} else {
	$toplinks = '<a href="storeuser/user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="join.php">Register</a>';
}
?>

<?php
if(isset($_GET['cat'])){
		$cat_name=$_GET['cat'];
		}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "$cat_name"; ?></title>
<link rel="shortcut icon" href="images/logo.png">

<link rel="stylesheet" href="style/style_modified.css" type="text/css" 
media="screen" />
<script type="text/javascript" src="javascripts/script.js"></script>

</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("main_header.php");?>
  <div id="pageContent">
    <div id="sidebar" style="width:200px;height:auto;float:left;">
      <h2>MENU LIST</h2>
        
    <ul style="text-align:left;">
      <li><a href="category.php?cat=NOBLE">NOVEL</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    <li><a href="category.php?cat=COMICS">COMICS</a></li>
      <li><a href="category.php?cat=HISTORY">HISTORY</a></li>
        <li><a href="category.php?cat=ADVENTURE">ADVENTURE</a></li>
    <li><a href="category.php?cat=WAR">WAR</a></li>
    <li><a href="category.php?cat=FOOD">FOOD</a></li>
      <li><a href="category.php?cat=MAPS">MAPS</a></li>
        <li><a href="category.php?cat=POLITICS">POLITICS</a></li>
    <li><a href="category.php?cat=RELIGION">RELIGION</a></li>
    <li><a href="category.php?cat=CULTURE">CULTURE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    
</ul>
    </div>
    <div id="rightDiv"> <h3 align="center" ><h3><?php echo  "$cat_name"; ?></h3><hr />
     <div> 
    <?php
        //display the contents
		
        $sql = ("SELECT * FROM products WHERE category='$cat_name' LIMIT 5");
        $result = mysql_query($sql);
        while($row = mysql_fetch_array($result)) :
            $id = $row["id"];
            $product_name = $row["product_name"];
            $price = $row["price"];
			$details = $row["details"];
			$category = $row["category"];
		  	$author = $row["author"];
            $src = "inventory_images/".$id.".jpg";
			
      ?>
     
      <div style="float:left;margin:10px;">
        <a href="product.php?id=<?php echo $id; ?>">
          <img style="border:#666 1px solid;width:100px;height:120px;" src="<?php echo $src; ?>" alt="<?php echo $product_name; ?>" />
        </a><br />
        <?php echo $product_name; ?><br />
        <?php echo "Rs".$price; ?><br />
       <h5> <a href="product.php?id=<?php echo $id; ?>">View Book Details</a></h5>
      </div>
    <?php endwhile; ?>
   
    
<!--     <?php
        //display the contents
		
        $sql = ("SELECT * FROM user_products WHERE category='$cat_name' LIMIT 5");
        $result = mysql_query($sql);
        while($row = mysql_fetch_array($result)) :
            $id = $row["id"];
            $user_product_name = $row["user_product_name"];
            $reduced_price = $row["reduced_price"];
			$category = $row["category"];
		  	$author = $row["author"];
            $src = "storeuser/user_products_images/".$id.".jpg";
			
      ?>
      -->
      <!-- <div style="float:left;margin:10px;">
        <a href="user_product.php?id=<?php echo $id; ?>">
          <img style="border:#666 1px solid;width:100px;height:120px;" src="<?php echo $src; ?>" alt="<?php echo $user_product_name; ?>" />
        </a><br />
        <?php echo $user_product_name; ?><br />
       Uploaded by user
       <h5> <a href="user_product.php?id=<?php echo $id; ?>">View Book Details</a></h5>
      </div>
    <?php endwhile; ?>
    </div>
    <div style="clear:both;"></div> -->
     <?php include_once("template_footer.php");?>
  </div>
  <!-- end of pageContent -->
 
</div>
</body>
</html>