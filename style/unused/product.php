<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php   include "storescripts/connect_to_mysql.php"; 
// Check to see the URL variable is set and that it exists in the database
/*if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "storescripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$query = mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
	$productCount = mysql_num_rows($query); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysql_fetch_array($query)){ 
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}*/
mysql_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $product_name; ?></title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php");?>
  <div id="pageContent">
  <table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
         
        
<?php      
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
 //   include "storescripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	  $query=mysql_query("SELECT * FROM products WHERE id='$id' LIMIT 1");
$prod_array=array();
while($result=mysql_fetch_array($query)){
	$prod_array[]=$result;
	}
$count_prod=count($prod_array);
echo '<table>
<tr><td>Image</td> &nbsp; &nbsp;<td>Details</td></tr>';
for($i=0;$i<$count_prod;$i++){
	extract($prod_array[$i]);
echo'<tr><td height="120px" >'; 
echo '<img src="inventory_images/'.$id.'.jpg"></td><td>'.$product_name.'<br />
            $' . $price . '<br />
            <a href="product.php?id=' . $id . '">View Product Details</a></td></tr>';
?>
<br />
        </p>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="Add to Shopping Cart" />
      </form>
      </td>
    </tr>
</table>
  </div>
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>