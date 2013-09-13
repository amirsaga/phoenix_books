<?php  include "storescripts/connect_to_mysql.php"; ?>
<?php 
session_start();
$toplinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
   $username = $_SESSION['username'];
	$toplinks = '<a href="storeuser/user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="storeuser/user_account.php">Account</a> &bull; 
	<a href="storeuser/user_logout.php">Log Out</a>';
} else {
	$toplinks = '<a href="storeuser/user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="join.php">Register</a>';
}
  ?>


<?php

  @$first_name = ucfirst($_POST['first_name']);
  @$last_name= ucfirst($_POST['last_name']);
  @$username = ($_POST['username']);
  @$has_password =($_POST['has_password']);
  @$password=md5($has_password);
  @$email = ($_POST['email']);
  @$phone = ($_POST['phone']);
  @$house_no= ($_POST['house_no']);
  @$ward_no = ($_POST['ward_no']);
  @$city = ($_POST['city']);
// initialize user_exist 
@$user_exist = 1;
if(isset($_POST['submit'])) 
{


 
  	//check for existance
 	$user_exist = mysql_result(mysql_query("SELECT COUNT(1) username FROM users WHERE username='$username'"), 0); 
  	// If the user doesn't exist yet, insert it
  		
    if($user_exist == 0) 
	{
  		      mysql_query("INSERT INTO users(first_name,last_name,username,password,email,phone,house_no,ward_no,city
  					) VALUES ('{$first_name}','{$last_name}','{$username}', '{$password}','{$email}','{$phone}','{$house_no}','{$ward_no}','{$city}'
  					)"); 
  					
  	  $pid = mysql_insert_id();
      // Place image in the folder 
      $newname = "$pid.jpg";
      move_uploaded_file( $_FILES['fileField']['tmp_name'], "storeuser/user_images/$newname");
      header("location: join.php?success=1"); 
  	}
	 else
  		 
       echo '<script type="text/javascript"> 
                             alert("Username already exists.  Please choose another username") 
                             </script>'; 
       
 }  
	  
	  



		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Page</title>
<link rel="stylesheet" href="style/style_modified.css" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/jquery_1_6_1.js"></script>

</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("main_header.php");?>
  <div id="pageContent">
  
 <div style="width:600px;" >
<p style="color:red; ">     <?php 
	@$success=$_GET["success"];
	if($success==1){
			echo 'REGISTRATION COMPLETE!!. YOU NOW LOGIN !!! .';
		}
	?></p><br/>
<form action="join.php" enctype="multipart/form-data" name="join" id="join" method="post">
    <fieldset class="section" >
            <legend><strong>Personal Information</strong></legend><br/>
            <div id="warning">Try again.</div><hr/>
    		
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
       <td width="40%" align="right">First Name</td>
        <td width="60%"><label>
          <input name="first_name" type="text" id="first_name" maxlength="
          15" size="48" placeholder="Name" />
        </label><div class="error" id="first_error">U forgot your first name!</div><br /></td>
      </tr>
      <tr>
        <td width="20%" align="right">Last Name</td>
        <td width="80%"><label>
          <input name="last_name" type="text" id="last_name" maxlength="
          15" size="48" placeholder="Surname"/>
        </label><div class="error" id="last_error">Put your last name! </div><br /></td>
      </tr>
      <tr>
        <td width="20%" align="right">Username</td>
        <td width="80%"><label>
          <input name="username" type="text" id="username" maxlength="
          15" size="48" placeholder="username"/>
        </label>
        <div class="error" id="username_error" >
          insert username!</div><br/>
      </td>
      </tr>
       <tr>
        <td align="right">Image</td>
         <td><label>
          <input type="file" name="fileField" id="fileField" placeholder="Image"/>
        </label><div class="error" id="file_error">You forgot to upload image!</div><br />
      </td>
         
        
      <tr>
        <td width="20%" align="right">Password</td>
      <td > <label>
          <input name="has_password" type="password" id="has_password" maxlength="
          15"  size="48" placeholder="Password"/>
        </label><div class="error" id="pass_error">You forgot to put password!</div><br />
      </td></tr>
      <tr>
        <td width="20%" align="right">E-mail</td>
        <td width="80%"><label>
          <input name="email" type="text"  id="email" maxlength="
          30"   size="48" placeholder="Put valid email id"/>
        </label><div class="error" id="un_error">You forgot ur email address</div><br /></td>
      </tr>
       <tr>
       <td width="20%" align="right">Phone no.</td>
        <td width="80%"><label>
          <input name="phone" type="number" id="phone" size="48" placeholder="Phone number"/>
        </label><div class="error" id="phone_error">You forgot to put phone no!</div><br />
      </td>
      </tr>
      <tr>
        <td width="20%" align="right">House no.</td>
        <td width="80%"><label>
          <input name="house_no" type="number" id="house_no" maxlength="
          15" size="48" placeholder="House number"/>
        </label><div class="error" id="house_error">You forgot to put house no!</div><br />
      </td>
        
      </tr>
     
      <tr>
        <td width="20%" align="right">Ward no.</td>
        <td width="80%"><label>
          <input name="ward_no" type="number" id="ward_no" maxlength="
          15"  size="48" placeholder="Ward number"/>
        </label><div class="error" id="ward_error">You forgot to put ward no!</div><br />
      </td>
      </tr>
      <tr>
        <td width="20%" align="right">City</td>
        <td width="80%"><label>
          <input name="city" type="text" id="city" maxlength="
          15"  size="48" placeholder="Your city"/>
        </label><div class="error" id="city_error">You forgot to put ur city!</div><br />
      </td>
      </tr>
      
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><label>
          <input type="submit" name="submit" id="submit" value="Register" class="button"/>
        </label></td>
      </tr>
    </table>
    <p>By signing up you agree to our <a href="#">Terms & Conditions</a></p>

    </fieldset>
    </form>
    <br />
</div>

  <?php include_once("template_footer.php");?>
  <br />
  <br />
</div>
</div>
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
	
	if($("#has_password").val() == ""){
		$("#pass_error").show("slow").fadeOut(5600);
		errors = true;
	} 
	if($("#username").val() == ""){
		$("#username_error").show("slow").fadeOut(5800);
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
	if($("#fileField").val() == ""){
		$("#file_error").show("slow").fadeOut(6600);
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