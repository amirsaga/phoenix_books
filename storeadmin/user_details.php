<?php 
session_start();
if(!isset($_SESSION["manager"])){
header("location: admin_login.php");
exit();
}
$managerID = preg_replace('#[^0-9]#i','',$_SESSION["aid"]);
$manager= preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["manager"]);
$password= preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
@$toplinks = "";
$toplinks = '<a href="#">' . $manager . '</a> &bull; 
		<a href="admin_logout.php">Log Out</a>';

include"../storescripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM admin WHERE aid='$managerID' AND admin_name='$manager' AND password='$password' LIMIT 1");

$existCount=mysql_num_rows($sql);
if($existCount== 0){
echo "You login session data is not on record in db";
exit();
}
?>
<?php
if(isset($_GET['detail_id'])){
	@$user_id=$_GET['detail_id'];
	}
?>

<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
$sql=mysql_query("SELECT * FROM users WHERE id='$user_id' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount=1){
while($row = mysql_fetch_array($sql)){
	$uid =$row["id"];
	$first_name= $row["first_name"];
	$last_name= $row["last_name"];
}
}
?>
<?php
// This block grabs the whole list for viewing
$user_product_list = "";
$sql = mysql_query("SELECT * FROM user_products WHERE user_id='$user_id'");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
while($row = mysql_fetch_array($sql)){ 
		 $id = $row["id"];
		 $user_product_name = $row["user_product_name"];
		 $original_price = $row["original_price"];
		 $reduced_price = $row["reduced_price"];
		 $author = $row["author"];
		 $category=$row["category"];
		 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
		 $user_product_list .= "<tr><td> $id </td><td><strong>$user_product_name </strong></td><td>$original_price</td><td>$reduced_price</td><td><strong>$author</strong></td><td><strong>$category</strong></td><td>$date_added</td> <td><a href='#'>delete</a></td> </tr>";
}
} else {
$user_product_list = " <h3>NO items listed in this account yet!!! </h3>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin page</title>
<link rel="stylesheet" href="../style/style_modified.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
<?php include_once("admin_header.php");?>
<div id="pageContent">
<h3> Uploaded by: <?php echo @$first_name. "&nbsp;" .@$last_name;  ?></h3>
<a href="user_list.php" style="text-align-last:right;">Return to prevoius page</a>
<hr />
<table border="1" cellpadding="5" cellspacing="1">
<tr> <td>ItemId</td><td>Book Name </td><td> Mprice</td><td>Rprice</td><td>Author</td><td>Category</td><td>Added</td><td>Delete</td></tr>
  <?php echo $user_product_list; ?>
   
   </table>
	<?php include_once("../template_footer.php");?>
</div>
</div>
</body>
</html>