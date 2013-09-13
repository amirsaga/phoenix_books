<?php 
  include "storescripts/connect_to_mysql.php"; ?>

<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
session_start();
$toplinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
  $userid = $_SESSION['id'];
  $username = $_SESSION['username'];
	$toplinks = '<a href="storeuser/user_profile.php?id=' . $userid . '"><img src="storeuser/user_images/' . $userid . '.jpg"  width="40" height="40" border="1" /><b><a href="storeuser/user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="storeuser/user_account.php">Account</a> &bull; 
	<a href="storeuser/user_logout.php">Log Out</a></b>';
} else {
	$toplinks = '  <a href="storeuser/user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="join.php">Register</a>';
}
  ?>

  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Home Page</title>
<link rel="shortcut icon" href="images/logo.png">
<link rel="stylesheet" href="style/style_modified.css" type="text/css" 
media="screen" />
<script type="text/javascript" src="scripts/jquery_1_6_1.js"></script>
<script type="text/javascript" src="scripts/autoUpdate.js"></script>
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("main_header.php");?>
  <div id="pageContent">
       <div id="sidebar" style="width:180px;height:auto;float:left;">
      <h2>MENU LIST</h2>
        
    <ul style="text-align:left;">
      <li><a href="category.php?cat=NOBLE">NOVEL</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    <li><a href="category.php?cat=COMICS">COMICS</a></li>
      <li><a href="category.php?cat=ADVENTURE">ADVENTURE</a></li>
        <li><a href="category.php?cat=HISTORY">HISTORY</a></li>
    <li><a href="category.php?cat=WAR">WAR</a></li>
    <li><a href="category.php?cat=FOOD">FOOD</a></li>
      <li><a href="category.php?cat=RELIGION">RELIGION</a></li>
        <li><a href="category.php?cat=POLITICS">POLITICS</a></li>
    <li><a href="category.php?cat=MAPS">MAPS</a></li>
    <li><a href="category.php?cat=CULTURE">CULTURE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    
</ul>
    </div>
    <div id="rightDiv"><h2>FEATURED BOOKS</h2><br/>
      <div id="ajaxContent">
        <!-- Auto Update Contents here -->
      </div>
    </div>
    <div style="clear:both;"></div>
     <?php include_once("template_footer.php");?>
  
  </div>
  </div>
</body>
</html>
<script type="text/javascript">
  function autoUpdate() {
    $.ajax({
      url: 'auto_update.php',
      type: 'POST',
      complete: function(ajaxObject, status) {
        $('#ajaxContent').html(ajaxObject.responseText);
      }
    });
  }
  autoUpdate();
  setInterval('autoUpdate()', 15000);
</script>
