<?php  include "../storescripts/connect_to_mysql.php"; ?>
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
	$toplinks = '<a href="user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="user_account.php">Account</a> &bull; 
	<a href="user_logout.php">Log Out</a>';
} 
		else {
				$toplinks = '<a href="user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="../join.php">Register</a>';
	}
?>


<?php 
if (isset($_POST['submit'])) {
@$submit = ($_POST['submit']);	
@$uid = mysql_real_escape_string($_POST['thisID']);
@$first_name =mysql_real_escape_string ($_POST['first_name']);
@$last_name=mysql_real_escape_string ($_POST['last_name']);
@$username =mysql_real_escape_string ($_POST['username']);
@$has_password =mysql_real_escape_string($_POST['has_password']);
$password=md5(@$has_password);
@$email = mysql_real_escape_string($_POST['email']);
@$phone =mysql_real_escape_string ($_POST['phone']);
@$house_no= mysql_real_escape_string($_POST['house_no']);
@$ward_no =mysql_real_escape_string($_POST['ward_no']);
@$city = mysql_real_escape_string($_POST['city']);
	
	
 $sql=mysql_query("UPDATE  users SET first_name = '$first_name' , last_name = '$last_name' , username = '$username' , password = '$password' , email = '$email' , phone = '$phone' , house_no = '$house_no' , ward_no ='$ward_no' , city = '$city' WHERE id='$uid'"); 

			
if ($_FILES['fileField']['tmp_name'] != "") {
// Place image in the folder 
		$newname = "$uid.jpg";
		move_uploaded_file($_FILES['fileField']['tmp_name'], "user_images/$newname");
}
		header("location: user_profile.php"); 
		exit();	
	}
?>
<?php
if (isset($_GET['uid'])) {
	$targetID = $_GET['uid'];
    $sql = mysql_query("SELECT * FROM users WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		while($row = mysql_fetch_array($sql)){
			$first_name= $row["first_name"];
			$last_name= $row["last_name"];
			$username= $row["username"];
			$password= $row["password"];
			$has_password= md5($password);
			$phone= $row["phone"];
			$email= $row["email"];
			$city= $row["city"];
			$house_no= $row["house_no"];
			$ward_no= $row["ward_no"];
		}
	
	}
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Profile Page</title>
<link rel="stylesheet" href="../style/style_modified.css" type="text/css" media="screen" />
<script type="text/javascript" src="javascripts/script.js"></script>

</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("user_header.php");?>
  <div id="pageContent">
 
<form action="profile_edit.php" enctype="multipart/form-data" name="profile_edit.php" id="profile_edit.php" method="post">
    
               <legend><strong>Personal Information</strong></legend><br/><hr/>
    
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">First Name</td>
        <td width="80%"><label>
          <input name="first_name" type="text" id="first_name" maxlength="15" value="<?php echo $first_name; ?>"size="64" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Last Name</td>
        <td width="80%"><label>
          <input name="last_name" type="text" id="last_name" maxlength="15" value="<?php echo $last_name; ?>" size="64" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">Username</td>
        <td width="80%"><label>
          <input name="username" type="text" id="username" maxlength="15" value="<?php echo $username; ?>"size="64" />
        </label></td>
      </tr>
       <tr>
        <td align="right">Image</td>
        <td><label>
       
          <input type="file" name="fileField" id="fileField" />
        </label></td>
        
      <tr>
        <td width="20%" align="right">Password</td>
      <td > <label>
          <input name="has_password" type="password" id="has_password" maxlength="15"  value="<?php echo $has_password; ?>"size="64" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">E-mail</td>
        <td width="80%"><label>
          <input name="email" type="text" class="text" id="email" maxlength="30"  value="<?php echo $email; ?>" size="64" />
        </label></td>
      </tr>
       <tr>
       <td width="20%" align="right">Phone no.</td>
        <td width="80%"><label>
          <input name="phone" type="number" id="phone" value="<?php echo $phone; ?>" size="64" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">House no.</td>
        <td width="80%"><label>
          <input name="house_no" type="number" id="house_no" maxlength="15" value="<?php echo $house_no; ?>" size="64" />
        </label></td>
        
      </tr>
     
      <tr>
        <td width="20%" align="right">Ward no.</td>
        <td width="80%"><label>
          <input name="ward_no" type="number" id="ward_no" maxlength="15"  value="<?php echo $ward_no; ?>"size="64" />
        </label></td>
      </tr>
      <tr>
        <td width="20%" align="right">City</td>
        <td width="80%"><label>
          <input name="city" type="text" id="city" maxlength="15"  value="<?php echo $city; ?>" size="64" />
        </label></td>
      </tr>
      
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><label>
        	<input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="submit" id="submit" value="Make changes" />
        </label></td>
      </tr>
    </table>
    </>
    </form>
    <br />



 
 

  <?php include_once("template_footer.php");?>
  </div>
 </div>
</div>
</body>

</html>