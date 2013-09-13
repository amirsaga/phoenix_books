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
  <div id="pageContent"><br />
    <div align="center"  >
      <h2>Hello store manager, what would you like to do today??<br />
      </h2>
      <table width="300" height="182" border="1" >
        <tr>
          <td ><a href="inventory_list.php"><h2> ~~Manage Inventory~~</h2></a></td>
        </tr>
        <tr>
          <td><a href="user_list.php"><h2>~~Manage users ~~</h2></a></td>
        </tr>
        </table>
     
        
      </p>
    </div>
    <br />
  <br />
  <br />
  
  <?php include_once("../template_footer.php");?>
  </div>
</div>
</body>
</html>