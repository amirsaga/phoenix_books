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
			<a href="admin_logout.php">Log out</a>';

include"../storescripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM admin WHERE aid='$managerID' AND admin_name='$manager' AND password='$password' LIMIT 1");

$existCount=mysql_num_rows($sql);
if($existCount== 0){
	echo "You login session data is not on record in db";
	exit();
}
?>
<script type="text/javascript">
  function cnfrm_delete(productid)
        {
          var answer = confirm("Are you sure you want to delete?")
            
          if (answer){
          
                window.location="user_list.php?yesdelete=" +productid;
          }
          
        }
</script>

<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Delete Item Question to Admin, 
if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysql_query("DELETE FROM users WHERE id='$id_to_delete' LIMIT 1") or die (mysql_error());
	// unlink the image from server
	// Remove The Pic -------------------------------------------
    $pictodelete = ("../storeuser/user_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: user_list.php"); 
    exit();
}
?>
<?php
// This block grabs the whole list for viewing
$user_list = "";
$sql=mysql_query("SELECT * FROM users ORDER BY id ");
$existCount=mysql_num_rows($sql);
if($existCount== 0){
	echo "You login session data is not on record in db";
	exit();
}
elseif($existCount=1){
	while($row = mysql_fetch_array($sql)){
		$id =$row["id"];
		$first_name= $row["first_name"];
		$last_name= $row["last_name"];
		$username= $row["username"];
		$password= $row["password"];
		$has_pass=md5($password);
		$phone= $row["phone"];
		$email= $row["email"];
		$city= $row["city"];
		$house_no= $row["house_no"];
		$ward_no= $row["ward_no"];
		//$date_added =$row['date_added'];
		//$src = "user_images/".$userID.".jpg";
		$user_list .= "<tr><td><a href='user_details.php?detail_id=$id'> $id </td><td><strong>$first_name &nbsp;$last_name</strong></td><td><strong>$username</strong></td></td><td><strong>$email</strong></td><td><strong>$phone</strong></td><td><a  onclick=\"cnfrm_delete('.$id.')\">delete</a></td> </tr>";
    }
} else {
	$product_list = "NO users listed in the store yet";
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
  <h3> USERS' ACCOUNT</h3>
  <a href="index.php" style="text-align:right;">Return to prevoius page</a>
   <hr />
   <table border="1" cellpadding="5" cellspacing="1">
  	<tr> <td>UserId</td><td> Name </td><td>Username</td><td>Email</td><td>Phone no.</td><td>Delete</td></tr>
      <?php echo $user_list; ?>
       
       </table>
       <a href="index.php" style="text-align:right;">Return to prevoius page</a>
        <?php include_once("../template_footer.php");?>
</div>
</div>

</body>
</html>