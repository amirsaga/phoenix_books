<?php
session_start();

$toplinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];
	$toplinks = '<a href="user_profile.php?id=' . $userid . '"><img src="storeuser/user_images/' . $userid . '.jpg"  width="40" height="40" border="1" /><a href="storeuser/user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="storeuser/user_account.php">Account</a> &bull; 
	<a href="storeuser/user_logout.php">Log Out</a>';
} else {
	$toplinks = ' <a href="storeuser/user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="join.php">Register</a>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Page</title>
<link rel="stylesheet" href="style/style_modified.css" type="text/css" media="screen" />
<script type="text/javascript" src="javascripts/script.js"></script>

</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("main_header.php");?>
  <div id="pageContent">
    <table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <div id="sidebar" style="width:150px;height:auto;float:left;">
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
  <div><br /><br /><br /><br /><fieldset><legend><strong>SEARCH RESULTS</strong></legend>
    <br/><?php 

function get_construct($table_name, $field_name, $search_word) {
	$search_exploded = explode(" ",$search_word);
	foreach($search_exploded as $search_each) {
		@$x++;
		if ($x==1)
		@$construct .= $field_name . " LIKE '%$search_each%'";
		//else
		//$construct .=" OR product_name LIKE '%$search_each%'";
	}
	$construct ="SELECT * FROM {$table_name} WHERE {$construct}";
	return $construct;
}

$button = $_GET['submit'];
$search = $_GET['search'];
if(!$button) {
	echo "Give a keyword.";
} else if (strlen($search)<=3){
	echo "keyword too short";
} else {
	echo"You seached for <b>$search</b><hr size='1'>";
	include "storescripts/connect_to_mysql.php"; 
	echo "<strong>Uploaded by Admin:</strong> <br>";
	$construct = get_construct("products", 'product_name', $search);
	$run = mysql_query($construct);
	$foundnum = mysql_num_rows($run);
	if($foundnum==0){
		echo"No results found .";
	}else {
		while($runrows = mysql_fetch_assoc($run)) {
			$product_name=$runrows['product_name'];
			$id=$runrows['id'];
			$price=$runrows['price'];
			$details=$runrows['details'];
			echo '<br/>';
			echo '<a href="product.php?id='.$id.'">'.$product_name. '</a>&nbsp;';
			echo'Rs:'. $price;
		}
	}
echo '<hr/>'; echo "<strong>Uploaded by Users:</strong><br>";
	// search from user_products
	//include "storescripts/connect_to_mysql.php"; 
	$construct2 = get_construct("us_products", 'user_product_name', $search);

	$run = mysql_query($construct2) or die('error in query');
	$foundnum = mysql_num_rows($run);
	if($foundnum==0){
		echo"No results found .";
	}
	else {
		while($runrows = mysql_fetch_assoc($run)) {
			$product_name=$runrows['user_product_name'];
			$id=$runrows['id'];
			$price=$runrows['reduced_price'];
			echo '<br/>';
			echo '<a href="user_product.php?id='.$id.'">'.$product_name. '</a>&nbsp;';
			echo 'Rs:'. $price;
		}
	}
}

?>

    <br /></fieldset></td>
      </tr>
    </table>
 
  <?php include_once("template_footer.php");?>
</div>
</div>
<script src="javascripts/script.js"></script>
</body>

</html>