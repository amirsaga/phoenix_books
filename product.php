<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
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


<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
     include "storescripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$sql = mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($sql)){ 
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["category"];
			 $author = $row["author"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $product_name; ?></title>
<link rel="shortcut icon" href="images/logo.png">

<link rel="stylesheet" href="style/style_modified.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("main_header.php");?>
  <div id="pageContent">
 	<div id="sidebar" style="width:180px;height:900px;float:left;">
      <h2>MENU LIST</h2>
        
    <ul style="text-align:left;">
      <li><a href="category.php?cat=NOBLE">NOBLE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    <li><a href="category.php?cat=NOBLE">NOBLE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    <li><a href="category.php?cat=NOBLE">NOBLE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    <li><a href="category.php?cat=NOBLE">NOBLE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    
</ul>
    </div>
      <div id="rightDiv">
   <h2>BOOK'S DETAILS</h2><hr />
        <br/>
          <img src="inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $product_name; ?>" /><br />
        
        <table width="350px" align="center" cellpadding="5" cellspacing="5">
          <tr>
            <td>Book Name:</td>
            <td><h2><?php echo $product_name; ?></h2></td>
          </tr>
          <tr>
            <td>Price</td>
            <td><?php echo "Rs.".$price; ?></td>
          </tr>
          <tr>
            <td>Author: </td>
            <td> <?php echo $author; ?></td>
          </tr>
          <tr>
            <td>Category:</td>
            <td><?php echo $category; ?> </td>
          </tr>
          <tr>
            <td height="45">Description:</td>
            <td>   <?php echo $details; ?></td>
          </tr>
        </table>
      
     
<br />
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="Add to Bucket" class="button" />
      </form>
  <hr />
    <div><h2>Related BOOKS:<?php echo "&nbsp;" .$category; ?></h2><br/>
      <?php
        //display the related products
        $sql= "SELECT * FROM products WHERE category='".$category."' LIMIT 15";
        $result = mysql_query($sql);
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
        <a href="product.php?id=<?php echo $id; ?>">View Product Details</a>
      </div>
    <?php endwhile; ?>
    </div>
    </div>
    <div style="clear:both;"></div>
       
<br />
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>