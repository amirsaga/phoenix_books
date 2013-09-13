<?php 
session_start();

// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Connect to the MySQL database  
include "storescripts/connect_to_mysql.php"; 
$toplinks = "";
if (isset($_SESSION['id'])) {
	$userid = $_SESSION['id'];
   $username = $_SESSION['username'];
	$toplinks = '<a href="storeuser/user_profile.php?id=' . $userid . '"><img src="storeuser/user_images/' . $userid . '.jpg" 
	 width="40" height="40" border="1" /><a href="storeuser/user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="storeuser/user_account.php">Account</a> &bull; 
	<a href="storeuser/user_logout.php">Log Out</a>';
} else {
	$toplinks = '  <a href="storeuser/user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="join.php">Register</a>';
}

@$has_password= preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
$password=md5($has_password);
?>
<?php



  @$first_name = ucfirst($_POST['first_name']);
  @$last_name= ucfirst($_POST['last_name']);
  @$password=md5($has_password);
  @$email = ($_POST['email']);
  @$phone = ($_POST['phone']);
  @$house_no= ($_POST['house_no']);
  @$ward_no = ($_POST['ward_no']);
  @$city = ($_POST['city']);

if(isset($_POST['submit'])) 
{

  		      mysql_query("INSERT INTO user_orders(first_name,last_name,email,phone,house_no,ward_no,city
  					) VALUES ('{$first_name}','{$last_name}','{$email}','{$phone}','{$house_no}','{$ward_no}','{$city}'
  					)"); 


} ?>
<?php if (isset($_SESSION['id'])) {
$sql=mysql_query("SELECT * FROM users WHERE id='$userid' AND username='$username' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount >1){
	while($row = mysql_fetch_array($sql)){
		$first_name= $row["first_name"];
		$last_name= $row["last_name"];
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
<title>Check Out</title>
<link rel="shortcut icon" href="images/logo.png">
<link href="css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<link rel="stylesheet" href="style/style_modified.css" type="text/css" media="screen" />
<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui-1.9.2.custom.js"></script>
	<script>
	$(function() {
		
		
	   $( "#accordion" ).accordion({
       
	collapsible: true, 
    autoHeight: true, 
    active: false 
		
    })});
</script>

</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("main_header.php");?>
  <div id="pageContent">
  <fieldset >
<div  id="accordion">
	<h3>Step 1:Account Details</h3>
	<div style="height:80px;"><form action="checkout.php" enctype="multipart/form-data" name="join" id="join" method="post">
   
            <legend><strong>Personal Information</strong></legend><br/>
            <div id="warning">Try again.</div><hr/>
    		
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
       <td width="40%" align="right">First Name</td>
        <td width="60%"><label>
          <input name="first_name" type="text" id="first_name" maxlength="
          15" size="48" placeholder="Name" value="<?php  echo @$first_name; ?>"/>
        </label><div class="error" id="first_error">U forgot your first name!</div><br /></td>
      </tr>
      <tr>
        <td width="20%" align="right">Last Name</td>
        <td width="80%"><label>
          <input name="last_name" type="text" id="last_name" maxlength="
          15" size="48" placeholder="Surname" value="<?php  echo @$last_name; ?>"/>
        </label><div class="error" id="last_error">Put your last name! </div><br /></td>
      </tr>
      <tr>
        <td width="20%" align="right">E-mail</td>
        <td width="80%"><label>
          <input name="email" type="text"  id="email" maxlength="
          30"   size="48" placeholder="Put valid email id" value="<?php echo @$email; ?>"/>
        </label><div class="error" id="un_error">You forgot ur email address</div><br /></td>
      </tr>
       <tr>
       <td width="20%" align="right">Phone no.</td>
        <td width="80%"><label>
          <input name="phone" type="number" id="phone" size="48" placeholder="Phone number" value="<?php  echo @$phone; ?>"/>
        </label><div class="error" id="phone_error">You forgot to put phone no!</div><br />
      </td>
      </tr>
      <tr>
        <td width="20%" align="right">House no.</td>
        <td width="80%"><label>
          <input name="house_no" type="number" id="house_no" maxlength="
          15" size="48" placeholder="House number" value="<?php  echo @$house_no; ?>"/>
        </label><div class="error" id="house_error">You forgot to put house no!</div><br />
      </td>
        
      </tr>
     
      <tr>
        <td width="20%" align="right">Ward no.</td>
        <td width="80%"><label>
          <input name="ward_no" type="number" id="ward_no" maxlength="
          15"  size="48" placeholder="Ward number"value="<?php  echo @$ward_no; ?>"/>
        </label><div class="error" id="ward_error">You forgot to put ward no!</div><br />
      </td>
      </tr>
      <tr>
        <td width="20%" align="right">City</td>
        <td width="80%"><label>
          <input name="city" type="text" id="city" maxlength="
          15"  size="48" placeholder="Your city"value="<?php  echo @$city; ?>"/>
        </label><div class="error" id="city_error">You forgot to put ur city!</div><br />
      </td>
      </tr>
      
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><label>
          <input type="submit" name="submit" id="submit" value="Continue" class="button"/>
        </label></td>
      </tr>
    </table>
    

   
    </form></div>
	<h3>Step 2:Payment Method</h3>
	<div><h4>Choose your mode of payment!!!</h4>
    <form action="checkout.php" name="join" id="join" method="post">
    <table>
    <tr><td> <input name="bank" value="boa" type="radio" /><img src="images/boasia.png" alt="logo" /><br /></td><td>&nbsp;</td><td> <input name="bank" value="nrb" type="radio" /><img src="images/nrb.gif" alt="logo" />
    </td>
    </td></tr>
     <tr><td> <input name="bank" value="kumari" type="radio" /><img src="images/kumari.gif" alt="logo" /><br />
    </td></tr>
    <tr><td> <input name="bank" value="nibl" type="radio" /><img src="images/nibl.png" alt="logo" />
    </td></tr>
     <tr><td> <input name="bank" value="nabil" type="radio" /><img src="images/nabil.jpg" alt="logo" />
    </td></tr>
    <tr><td> <input name="bank" value="banijiya"type="radio" /><img src="images/rastriya-banijya-bank.jpg" alt="logo" />
    </td></tr>
     <tr><td> <input name="bank" value="std"type="radio" /><img src="images/standard-chartered.jpg" alt="logo" />
    </td></tr>
    <tr><td> <input name="bank" value="everest" type="radio" /><img src="images/everest.png" alt="logo" /></tr><tr></tr><tr></tr><tr></tr>
     <tr><td> <input name="bank" type="radio" />On Delivery
    </td></tr>
    <td colspan="2"><label>
          <input type="submit" name="submit" id="submit" value="Continue" class="button"/>
        </label></td>
    </table>
   </form>
    </div>
	<h3>Step 3:Confirm Order</h3>
	<div><h4>Revalue you order and press the button. </h4>
    You Orders:
    <hr />

	 <input type="submit" name="submit" id="submit" class="button" value="Confirm Order">
    </div>

</div>
 <?php include_once("template_footer.php");?>
 
 
 <script>
$("#join").submit(function(){
		
	// Assume there are no error on the form
	var errors = false;
	
	// hide all the error messages
	$(".error").hide();
	
	// Check each field to make sure they're not blank
	
	if($("#first_name").val() == ""){
		$("#first_error").show("slow").fadeOut(5000);
		errors = true;
	}
	
	if($("#last_name").val() == ""){
		$("#last_error").show("slow").fadeOut(5200);
		errors = true;
	}
	
	if($("#email").val() == ""){
		$("#un_error").show("slow").fadeOut(5400);
		errors = true;
	}
	
	
	if($("#city").val() == ""){
		$("#city_error").show("slow").fadeOut(5900);
		errors = true;
	}
	if($("#ward_no").val() == ""){
		$("#ward_error").show("slow").fadeOut(6000);
		errors = true;
	}
	if($("#house_no").val() == ""){
		$("#house_error").show("slow").fadeOut(6200);
		errors = true;
	}
	if($("#phone").val() == ""){
		$("#phone_error").show("slow").fadeOut(6400);
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