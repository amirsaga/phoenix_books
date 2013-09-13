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
	$sql = mysql_query("SELECT * FROM user_products WHERE id='$id' LIMIT 1");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($sql)){ 
			 $id = $row["id"];
			 $userid=$row["user_id"];
            $user_product_name = $row["user_product_name"];
            $original_price = $row["original_price"];
			$reduced_price = $row["reduced_price"];
			$author= $row["author"];
			$description = $row["description"];
			$condition = $row["status"];
			$category = $row["category"];
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

<?php
 $sql=mysql_query("SELECT * FROM users WHERE id='$userid' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount== 0){
	echo "You login session data is not on record in db";
	exit();
}
elseif($existCount=1){
	while($row = mysql_fetch_array($sql)){
		
		
		$first_name= $row["first_name"];
		$last_name= $row["last_name"];
		$username= $row["username"];
		$password= $row["password"];
		$phone= $row["phone"];
		$email= $row["email"];
		$city= $row["city"];
		$house_no= $row["house_no"];
		$ward_no= $row["ward_no"];
		}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $user_product_name; ?></title>
<link rel="shortcut icon" href="images/logo.png">
<link rel="stylesheet" href="style/style_modified.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("main_header.php");?>
  <div id="pageContent">
 
 
  <table width="500px" align="center" border="" cellspacing="5" cellpadding="5" style="text-wrap:normal;">
  <tr>
   
    <td width="24%" valign="baseline"><img src="storeuser/user_products_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $user_product_name; ?>" /><br />
     <strong style="text-align:center;"><?php echo $user_product_name; ?> </strong>
     <br />
     <br />
     <a href="user_uploaded.php" class="button">Old Books </a>
     </td>
    <td width="52%" valign="top">
    <h2><?php echo $user_product_name; ?></h2>
        <table> <tr><td><strong> MARKET PRICE:</strong> </td><td><?php echo " &nbsp;Rs.".$original_price; ?></td></tr>
       <tr><td><strong>PRICE HERE:</strong></td><td><?php echo "&nbsp; Rs.".$reduced_price; ?></td></tr>
       <tr><td> <strong>AUTHOR:</strong></td><td><?php echo "&nbsp;".$author; ?> </td></tr>
       <tr><td> <strong>CATEGORY:</strong></td><td><?php echo "&nbsp;".$category; ?></td></tr>
   
      <tr><td>  <strong>CONDITION:</strong></td><td> <?php echo "&nbsp;".$condition;; ?></td></tr>
      <tr><td>  <strong>DESCRIPTION:</strong></td><td><?php echo "&nbsp;".$description; ?></td></tr>
      <tr><td>  <strong>ADDED DATE:</strong></td><td><?php echo "&nbsp;".$date_added; ?></td></tr>
      </table>
    <hr />
    <br />
       <div style="width:500px; text-align:justify; ">
<fieldset ><h2 style="color:brown;"> Uploaded by:</h2> <hr />
<table width="400" cellspacing="0" cellpadding="0" >
 
<tr>
  
    <td width="95"><strong>Name:</strong></td>
    <td width="233"><?php echo" $first_name &nbsp; $last_name"; ?></td>
  </tr>
  <tr>
    <td><strong>E-mail:</strong></td>
    <td><?php echo" $email"; ?></td>
  </tr>
  <tr>
    <td><strong>Phone-no:</strong></td>
    <td><?php echo $phone; ?></td>
  </tr>
  
  <tr>
    <td><strong>Address:</strong></td>
    <td><?php echo" $city"; ?></td>
  </tr>
   
</table>
</fieldset>
</div>
</td>
  </tr>
  </table> </fieldset>
<div>
  
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>