<?php include"../storescripts/connect_to_mysql.php"; ?>
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
	$toplinks = '<a href="user_profile.php?id=' . $userid . '"><img src="user_images/' . $userid . '.jpg"  width="40" height="40" border="1" /><a href="user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="user_account.php">Account</a> &bull; 
	<a href="user_logout.php">Log Out</a>';

}





@$has_password= preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
$password=md5($has_password);

$sql=mysql_query("SELECT * FROM users WHERE id='$userid' AND username='$username' AND password='$password' LIMIT 1");
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
		//$src = "user_images/".$userID.".jpg";
		}

}

?>

         
		 

<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Profile page</title>
<link rel="stylesheet" href="../style/style_modified.css" type="text/css" media="screen"/>
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("user_header.php");?>
  <div id="pageContent" >
  <div style="width:650px">
<fieldset class="section"><h2>Profile Details</h2> <hr /><h4><!--<a href="profile_edit.php?uid=<?php echo $userid; ?>" style="text-align:left">Edit</a></h4> -->
<table width="400" cellspacing="10" cellpadding="10" >
 <tr>
<!--    <td width="24%" valign="top"><?php echo "$src "; ?>   /><br />
  </td> -->
  <td width="95"><strong>Your Image:</strong></td>
   <td width="24%" valign="top"><img src="user_images/<?php echo $userid; ?>.jpg" width="280" height="188" alt="<?php echo $first_name; ?>" /></tr>
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
    <td><strong>Username:</strong></td>
    <td><?php echo $username; ?></td>
  </tr>
  <tr>
    <td><strong>Address:</strong>:</td>
    <td><?php echo" $city"; ?></td>
  </tr>
  <tr>
    <td><strong>House no:</strong></td>
    <td><?php echo" $house_no";?></td>
  </tr>
  <tr>
    <td><strong>Ward no:</strong></td>
    <td><?php echo" $ward_no";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</fieldset>
   
   </div>
  <?php include_once("../template_footer.php");?>
  </div>
  <!-- end of pageContent -->
  
</div>
</body>
</html>