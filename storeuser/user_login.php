<?php 

session_start();
if (isset($_SESSION["username"])) {
    header("location: ../index.php"); 
    exit();
}

$toplinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
   $username = $_SESSION['username'];
	$toplinks = '<a href="user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="user_account.php">Account</a> &bull; 
	<a href="user_logout.php">Log Out</a>';
} else {
	$toplinks = '  <a href="user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="../join.php">Register</a>';
}



?>
<?php // Connect to the MySQL database  
    include "../storescripts/connect_to_mysql.php"; 
	
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    @$has_password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
    $password = md5($has_password);
    $sql = mysql_query("SELECT id FROM users WHERE username='$username' AND password='$password' LIMIT 1"); // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysql_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
		 }
		 $_SESSION["id"] = $id;
		 $_SESSION["username"] = $username;
		 $_SESSION["password"] = $has_password;
		 header("location: ../index.php");
         exit();
    } else 
	{
		header("Location: user_login.php?error=1");
	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Log In </title>
<script type="text/javascript" src="../scripts/jquery_1_6_1.js"></script>
<link rel="stylesheet" href="../style/style_modified.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
  <?php include_once("user_header.php");?>
  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px; width:400px;" >
 
       <h2>Please Log In to buy items</h2>
      <form id="form" name="form" method="post" action="user_login.php">
      		<fieldset class="section"><legend><strong>Log In</strong></legend>
      <br />
    <p style="color:red; ">     <?php 
	@$error=$_GET["error"];
	if($error==1){
			echo 'Either Username or Password is incorrect. <br> Please try again.';
		}
	?></p><br/>
        User Name:<br />
          <input name="username" type="text" id="username" placeholder="Type your username" size="40" /><div class="error" id="username_error"">Put username!</div><br />
          
        <br /><br />
        Password:<br />
       <input name="password" type="password" id="password" placeholder="Type password" size="40" /><div class="error" id="pass_error"">Put password!</div><br />
       <br />
       <br />
       <br />
       
       <input type="submit" name="button" id="button" value="Log In"   class="button" /><br /><br />
      	 
      </fieldset></form>
     <form id="form2" name="form2" method="post" action="../join.php" style="text-align:center">
         	<input type="submit" name="register" id="button" value="Register"  class="button"/>
            </form>
      <p>&nbsp; </p>
    </div>
    <br />
  <br />
    <?php include_once("../template_footer.php");?>

  <br />
  </div>
</div>
<script>

	$("#form").submit(function(){
		var errors = false;
		$(".error").hide();

		if($("#username").val() == ""){
			$("#username_error").show("slow").fadeOut(5000);
			errors = true;
		}
		if($("#password").val() == ""){
			$("#pass_error").show("slow").fadeOut(5000);
			errors = true;
		}
		if(errors){
			$("#warning").show("slow").fadeOut(5000);
			return false;
		}
		
			});

</script>

</body>
</html>