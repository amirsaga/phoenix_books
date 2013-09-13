<!--This page is for view all book items -->

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
	$toplinks = '  <a href="storeuser/user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="join.php">Register</a>';
}
?>


 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NEW BOOKS</title>
<link rel="stylesheet" href="style/style_modified.css" type="text/css" 
media="screen" />
<script type="text/javascript" src="javascripts/script.js"></script>

</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("main_header.php");?>
  <div id="pageContent">
  <h3> NeW BooKS </h3> <hr />
  <?php 
		
  //display the contents
  $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 12";
  $result = mysql_query($sql) or die('error in quering');
  while($row = mysql_fetch_array($result)) :
  
      $id = $row["id"];
      $product_name = $row["product_name"];
      $price = $row["price"];
      $src = "inventory_images/".$id.".jpg";
?>
<div style="float:left;margin:10px;">
  <a href="product.php?id=<?php echo $id; ?>">
    <img style="border:#666 1px solid;width:100px;height:120px;" src="<?php echo $src; ?>" alt="<?php echo $product_name; ?>" />
  </a><br />
  <?php echo $product_name; ?><br />
  <?php echo "Rs.".$price; ?><br />
  <a href="product.php?id=<?php echo $id; ?>">View Book Details</a>
</div>
<?php endwhile; ?>    
<?php include_once("template_footer.php");?>
  </div>
  
</div>
</body>
</html>
<?php ?>