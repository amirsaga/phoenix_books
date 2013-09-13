<?php include"../storescripts/connect_to_mysql.php"; ?>
<script type="text/javascript">
  function cnfrm_delete(productid)
        {
          var answer = confirm("Are you sure you want to delete?")
            
          if (answer){
          
                window.location="user_account.php?yesdelete=" +productid;
          }
          
        }
</script>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
	session_start();
	if(!isset($_SESSION["username"])){
	header("location: user_login.php");
	exit();
}

$toplinks = "";
if (isset($_SESSION['username'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
   	$username = $_SESSION['username'];
	$toplinks = '<a href="user_profile.php?id=' . $userid . '"><img src="user_images/' . $userid . '.jpg" width="40" height="40" border="1" /><a href="user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="user_account.php">Account</a> &bull; 
	<a href="user_logout.php">Log Out</a>';

}

@$has_password= preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
$password=md5($has_password);

?>
<?php 
// Delete Item Question to Admin, and Delete Product if they choose

if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysql_query("DELETE FROM user_products WHERE id='$id_to_delete' LIMIT 1") or die (mysql_error());
    $pictodelete = ("../user_product_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: user_account.php"); 
    exit();
}
?>



<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['user_product_name'])) {
	$userid = $_SESSION['id'];
   $user_product_name = ucfirst($_POST['user_product_name']);
	$original_price = ($_POST['original_price']);
	$reduced_price = ($_POST['reduced_price']);
	$category = ($_POST['category']);
	$author = ucfirst($_POST['author']);
	$description= ($_POST['description']);
	$condition = ($_POST['condition']);
	
	// Add this product into the database now
	$sql = mysql_query("INSERT INTO user_products (user_product_name,user_id,original_price,reduced_price,author,category,description,date_added,status) 
        VALUES('$user_product_name','$userid','$original_price','$reduced_price','$author','$category','$description',now(), '$condition')") or die (mysql_error());
	
	$pid = mysql_insert_id();
	// Place image in the folder 
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "user_products_images/$newname");
	header("location: user_account.php"); 
    exit();
}
?>

<?php
// This block grabs the whole list for viewing
$user_product_list = "";
$sql = mysql_query("SELECT * FROM us_products WHERE id='$userid' "); // here user_id has been changed to id
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
			 $user_product_list .= "&bull;<strong>$user_product_name</strong> &bull;&nbsp;&nbsp;<a href='user_account_edit.php?pid=$id'></a>  <a   onclick=\"cnfrm_delete('.$id.')\">delete</a><br /><hr/>";
    }
} else {
	$user_product_list = "You have no products listed in your account yet";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User A/C Page</title>
<script type="text/javascript" src="../scripts/jquery_1_6_1.js"></script>
<link rel="stylesheet" href="../style/style_modified.css" type="text/css" media="screen"/>
</head>

<body>
<div align="center" id="mainWrapper">
  <?php include_once("user_header.php");?>
  <div id="pageContent">
    <table width="100%" border=".1" cellpadding="10" cellspacing="10">
      <tr>
        <td width="47%" valign="top"><div align="left" style="margin-left:24px;">
     <fieldset style="height:600px" class="section"> <h2>UPLOAD$</h2>
      <?php echo @$user_product_list; ?>
     </fieldset>
        <td width="53%"><a name="inventoryForm" id="inventoryForm"></a>
    <h1 align="center">
    Add BOOK Details 
    </h1>
     <div id="warning">Try again.</div><hr />
    <form action="user_account.php" enctype="multipart/form-data" name="userForm" id="userForm" method="post" >
    <table width="90%" border="0" cellspacing="0" cellpadding="6" border-radius=".5em">
      <tr>
        <td width="20%" align="right">Book Name</td>
        <td width="80%"><label>
          <input name="user_product_name" type="text" id="user_product_name" size="64" />
        </label><div class="error" id="name_error">Insert BOOK name</div><br /></td>
      </tr>
      <tr>
        <td align="right">Original Price</td>
        <td><label>
          Rs.
          <input name="original_price" type="number" id="original_price" size="12" />
        </label><div class="error" id="origin_error">Whats the original price??</div><br /></td>
      <tr>
        <td align="right">Reduced Price</td>
        <td><label>
          Rs.
          <input name="reduced_price" type="number" id="reduced_price" size="12" />
        </label><div class="error" id="red_error">Whats the depriciated price??</div><br /></td>
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
        <td align="right">Book Description</td>
        <td><label>
          <textarea name="description" id="description" cols="64" rows="5"></textarea>
        </label><div class="error" id="des_error">Tell something about the book!</div><br /></td>
      </tr>
      <tr>
        <td align="right">Book Condition</td>
        <td><label>
          <textarea name="condition" id="condition" cols="64" rows="5" ></textarea>
        </label><div class="error" id="con_error">Whats the status??</div><br /></td>
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
          <input type="submit" name="button" id="button" value="Add Book Now" class="button"/>
        </label></td>
      </tr>
    </table>
    </form></td>
      </tr>
    </table>
<?php include_once("../template_footer.php");?>
 </div>
 </div>
 <script>
 $("#userForm").submit(function(){
		
	// Assume there are no error on the form
	var errors = false;
	
	// hide all the error messages
	$(".error").hide();
	
	// Check each field to make sure they're not blank
	
	if($("#user_product_name").val() == ""){
		$("#name_error").show("slow").fadeOut(7000);
		errors = true;
	}
	
	if($("#original_price").val() == ""){
		$("#origin_error").show("slow").fadeOut(7200);
		errors = true;
	}
	
	if($("#reduced_price").val() == ""){
		$("#red_error").show("slow").fadeOut(7400);
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
	
	if($("#description").val() == ""){
		$("#des_error").show("slow").fadeOut(7900);
		errors = true;
	}
	if($("#condition").val() == ""){
		$("#con_error").show("slow").fadeOut(8000);
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