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
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete product with ID of ' . $_GET['deleteid'] . '? <a href="inventory_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="inventory_list.php">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysql_query("DELETE FROM products WHERE id='$id_to_delete' LIMIT 1") or die (mysql_error());
	// unlink the image from server
	// Remove The Pic -------------------------------------------
    $pictodelete = ("../inventory_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['product_name'])) {
	
    $product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$category = mysql_real_escape_string($_POST['category']);
	$author = mysql_real_escape_string($_POST['author']);
	$details = mysql_real_escape_string($_POST['details']);
	// See if that product name is an identical match to another product in the system
	$sql = mysql_query("SELECT id FROM products WHERE product_name='$product_name' LIMIT 1");
	$productMatch = mysql_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="inventory_list.php">click here</a>';
		exit();
	}
	// Add this product into the database now
	$sql = mysql_query("INSERT INTO products (product_name, price, details, category, author, date_added) 
        VALUES('$product_name','$price','$details','$category','$author',now())") or die (mysql_error());
     $pid = mysql_insert_id();
	// Place image in the folder 
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	header("location: inventory_list.php"); 
    exit();
}
?>

<?php
// This block grabs the whole list for viewing
$product_list = "";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $category=$row["category"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $product_list .= "<strong>$product_name</strong>-<em>Added $date_added</em>&bull; <a href='inventory_edit.php?pid=$id'>edit</a> &bull; <a href='inventory_list.php?deleteid=$id'>delete</a><br />";
    }
} else {
	$product_list = "You have no products listed in your store yet";
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
    <table width="100%" border="1" cellspacing="10" cellpadding="10">
      <tr>
        <td width="70%" align="left" valign="top">
    <a name="inventoryForm" id="inventoryForm"></a>
    <bolder><h3>
     Add New Book 
    </h3></bolder><hr />
    <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myForm" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Book Name</td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" />
        </label><div class="error" id="name_error">Insert BOOK name</div><br /></td>
      </tr>
      <tr>
        <td align="right">Book Price</td>
        <td><label>
          Rs.
          <input name="price" type="text" id="price" size="12" />
        </label><div class="error" id="price_error">Whats the  price??</div><br /></td>
      </tr>
      <tr>
        <td align="right">Author</td>
        <td><label>
          <input name="author" type="text" id="author" size="12" />
          
        </label><div class="error" id="author_error">You missed the author!</div><br /></td>
      </tr>
      <tr>
        <td align="right">Category</td>
        <td><select name="category" id="category">
        <option value=""></option>
         <option value="NOBLE">NOVEL</option>
          <option value="FICTION">FICTION</option>
          <option value="STORY">STORY</option>
          <option value="TEXT-BOOKS">TEXT-BOOKS</option>
          <option value="COMICS">COMICS</option>
           
          <option value="ADVENTURE">ADVENTURE</option>
          <option value="FOOD">FOOD</option>
          <option value="WAR">WAR</option>
          <option value="POLITICS">POLITICS</option>
          <option value="HISTORY">HISTORY</option>
          <option value="RELIGION">RELIGION</option>
          <option value="CULTURE">CULTURE</option>
          <option value="MAPS">MAPS</option>
          
          </select><div class="error" id="cat_error">Give a category!</div><br /></td>
      </tr>
      <tr>
        <td align="right"> Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"></textarea>
        </label><div class="error" id="des_error">Tell something about the book!</div><br /></td>
      </tr>
      <tr>
        <td align="right">Cover Image</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label><div class="error" id="cover_error">Let me see Cover!!</div><br /></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Upload Now" class="button"/>
        </label></td>
      </tr>
    </table>
    </form>
 </td>
        <td width="30%"><h2>Book list</h2>
      <?php echo $product_list; ?></td>
      </tr>
    </table>
 
  <?php include_once("../template_footer.php");?>
</div>

<script>
 $("#myForm").submit(function(){
	var errors = false;
	$(".error").hide();
	
	// Check each field to make sure they're not blank
	
	if($("#product_name").val() == ""){
		$("#name_error").show("slow").fadeOut(7000);
		errors = true;
	}
	
	if($("#price").val() == ""){
		$("#price_error").show("slow").fadeOut(7200);
		errors = true;
	}
	
	
	if($("#author").val() == ""){
		$("#author_error").show("slow").fadeOut(7600);
		errors = true;
	} 
	if($("#category").val() == ""){
		$("#cat_error").show("slow").fadeOut(7800);
		errors = true;
	}
	
	if($("#details").val() == ""){
		$("#des_error").show("slow").fadeOut(7900);
		errors = true;
	}
	
	if($("#fileField").val() == ""){
		$("#cover_error").show("slow").fadeOut(8300);
		errors = true;
	}
	// If there are errors, then show a general error message
	if(errors){
		$("#warning").show("slow").fadeOut(5000);
	return false;
	}
	
	
});
</script>
</body>
</html>