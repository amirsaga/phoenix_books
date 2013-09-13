<?php 

session_start();
if (isset($_SESSION["manager"])) {
    header("location: index.php"); 
    exit();
}
@$toplinks = "";
if(isset($_SESSION["manager"])){
$managerID = preg_replace('#[^0-9]#i','',$_SESSION["aid"]);
$manager= preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["manager"]);
$password= preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
$toplinks = '<a href="#">' . $manager . '</a> &bull; 
			<a href="admin_logout.php">Log Out</a>';
}

?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["admin_name"]) && isset($_POST["password"])) {

	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["admin_name"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
    // Connect to the MySQL database  
    include "../storescripts/connect_to_mysql.php"; 
    $sql = mysql_query("SELECT aid FROM admin WHERE admin_name='$manager' AND password='$password' LIMIT 1"); // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysql_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql)){ 
             $id = $row["aid"];
		 }
		 $_SESSION["aid"] = $id;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["password"] = $password;
		 header("location: index.php");
         exit();
    } else {
		echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Log In </title>
<link rel="stylesheet" href="../style/style_modified.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
  <?php include_once("admin_header.php");?>
  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px;width:400px">
      <h2>Please Log In To Manage the Store</h2>
      <form id="form1" name="form1" method="post" action="admin_login.php">
       <fieldset class="section"> <legend><strong>Admin Log In</strong></legend>
       User Name:<br />
          <input name="admin_name" type="text" id="admin_name" size="40" />
        <br /><br />
        Password:<br />
       <input name="password" type="password" id="password" size="40" />
       <br />
       <br />
       <br />
       
         <input type="submit" name="button" id="button" value="Log In" class="button"/>
       
      </fieldset></form>
      <p>&nbsp; </p>
    </div>
    <br />
  <br />
  <br />
 
  <?php include_once("../template_footer.php");?>
 </div>
</div>
</body>
</html>