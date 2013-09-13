<?php 
include "storescripts/connect_to_mysql.php"; 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
include "storescripts/connect_to_mysql.php"; 
	
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
	$toplinks = '  <a href="storeuser/user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="join.php">Register</a>';
}
?>


<?php 
		
 $dynamicList="";
	$sql = mysql_query("SELECT * FROM products WHERE category='NOBLE' LIMIT 6");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
	while($row = mysql_fetch_array($sql)){ 
		$id= $row["id"];
		$product_name = $row["product_name"];
		$price = $row["price"];
		$details = $row["details"];
		$category = $row["category"];
		$author= $row["author"];
		$dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id .'.jpg" alt="' . $product_name . '" width="100" height="120" border="1" /></a></td></tr>
  <tr><td width="83%" valign="top">' . $product_name . '<br />Rs.&nbsp;' . $price . '<br />
  <a href="product.php?id=' . $id . '">View Product Details</a></td>
  </tr>
  </table>';
			
         }
		 
} 
	
 $dynamicList_1="";
	$sql = mysql_query("SELECT * FROM products WHERE category='FICTION' LIMIT 6");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
	while($row = mysql_fetch_array($sql)){ 
		$id= $row["id"];
		$product_name = $row["product_name"];
		$price = $row["price"];
		$details = $row["details"];
		$category = $row["category"];
		$author = $row["author"];
		$dynamicList_1 .= '<table width="100%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id .'.jpg" alt="' . $product_name . '" width="100" height="120" border="1" /></a></td></tr>
  <tr><td width="83%" valign="top">' . $product_name . '<br />Rs.&nbsp;' . $price . '<br />
  <a href="product.php?id=' . $id . '">View Product Details</a></td>
  </tr>
  </table>';
			
         }
		 
} 

	
 $dynamicList_2="";
	$sql = mysql_query("SELECT * FROM products WHERE category='STORY' LIMIT 6");
	$productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
	while($row = mysql_fetch_array($sql)){ 
		$id= $row["id"];
		$product_name = $row["product_name"];
		$price = $row["price"];
		$details = $row["details"];
		$category = $row["category"];
		$author= $row["author"];
		$dynamicList_2 .= '<table width="100%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><img style="border:#666 1px solid;" src="inventory_images/' . $id .'.jpg" alt="' . $product_name . '" width="100" height="120" border="1" /></a></td></tr>
  <tr><td width="83%" valign="top">' . $product_name . '<br />Rs.&nbsp;' . $price . '<br />
  <a href="product.php?id=' . $id . '">View Product Details</a></td>
  </tr>
  </table>';
			
         }
		 
} 



mysql_close();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ALL BOOKS</title>
<style>
@font-face {
    font-family: 'Modern';
    src: url('_fonts/modernpics-webfont.eot');
    src: url('_fonts/modernpics-webfont.eot?#iefix') format('embedded-opentype'),
         url('_fonts/modernpics-webfont.woff') format('woff'),
         url('_fonts/modernpics-webfont.ttf') format('truetype'),
         url('_fonts/modernpics-webfont.svg#ModernPictogramsNormal') format('svg');
    font-weight: normal;
    font-style: normal;
}
a[href^="cart"]:before{
	content:" .";
	font-family: Modern, sans-serif;
	font-size: 1.5em;
	position: relative;
	//top: -.2em;
}
html {
	background-image:url(images/bg.jpg);
	background-repeat:repeat;
	}
#pageHeader{
	border:#999 1px solid;
	border-bottom:none;
	background:#e6e3d4;	
	width:1000px;}
	
#pageContent{
	border:#999 1px solid;
	border-bottom:none;
	width:1000px;
	background:#e6e3d4;	
}
	
#pageaFooter{
	border:#999 1px solid;
	border-bottom:none;
	width:1000px;
	background:#e6e3d4;	

	}
body {
	font: 100% Georgia, "Times New Roman", Times, serif;
	line-height: 1.4;
	width: 70%;
	margin: 0 auto;
}
h1, h2, h3 {
	font-size: 2.4em;
	font-weight: normal;
	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.75);
	color: #575451;
}
h2 {
	font-size: 1.4em;
}
a {
	font-size: 14px;
	color: #03F;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #06F;
}
a:hover {
	text-decoration: none;
	color: #000;
}
a:active {
	text-decoration: none;
	color: #03F;
}



img{
	border:1px solid white;
	}
a:hover img  {
border:1px solid black;
}



/*vertical menu styles*/
ul, li {
	margin: 0;
	padding: 0;
	list-style: none;
	float: left;
}

#sidebar li a {
	display: block;
	width: 8em;
	height: 2em;
	text-decoration:none;
	font-size:1em;
	background:#D5973C;
	color:white;
	padding:.2em 0 .2em 1em;
	line-height:2em;
	border-bottom:.125em solid white;
	border-radius:.3em .3em 0 0;
}
#sidebar li a:hover, li a:focus{
	background:#87492F;
	border-left:.4em solid white;
	width:8.0em;
	border-radius:0 .3em .3em 0 ;
	}
li:last-child a{
	border-bottom:none;
	}
	
/*micro-clearfix by Nicolas Gallagher http://nicolasgallagher.com/micro-clearfix-hack/*/
/* For modern browsers */
.cf:before,
.cf:after {
    content:"";
    display:table;
}
.cf:after {
    clear:both;
}
/* For IE 6/7 (trigger hasLayout) */
.cf {
    zoom:1;
}
/*horizontal menu styles*/	
#mainbar nav {
//	background: #916A31;
	height: 2.9em;
}

#mainbar ul {
	background: #D5973C;
	height: 3em;
	width:100%;

}
#mainbar li a {
	display: block;
	line-height: 3em;
	padding: 0 1em;
	color: white;
	text-decoration: none;
}
#mainbar li a:hover{
	background:#916a31;
	height:3em;
	padding-top:.3em;
	position:relative;
	top:-.3em;
	border-radius:.3em .3em 0 0;
	}

.current,a:hover.current{
	
	background:#AD9B7F;
	color:#eee;
	padding-top:.3em;
	position:relative;
	top:-.1em;
	border-radius:.3em .3em 0 0;
	border-bottom:.1em solid #917F63;
	cursor:default;
	
	} 
</style>
</head>
<body>
<div align="center" id="mainWrapper">
<div id="pageHeader"><table width="100%" border="0" cellpadding="12">
  <tr>
    <td width="77%"><a href="index.php"><img src="style/logo.png" width="340" height="91" alt="logo" /></a></td>
   
   <a style="float:right"> <td width="23%">  <?php echo $toplinks; ?><br/> 
    <form action='search_page.php' method="get">
	<font face="Tahoma, Geneva, sans-serif" size="5">
       <br>
        <input type="text" size="15" name="search" placeholder="Insert keyword"/>
        <input type="submit" name="submit" value="Search" />
        
        </font>
        </form></td></a>
  </tr>
 </table>

 <a href="cart.php" style="float:right"><?php if (isset($_SESSION["username"])); ?>Cart</a>

 <div id="mainbar" >
 <nav class="cf">
      <ul>
   <li> <a href="test.php" >HOME</a>&nbsp; &nbsp; &nbsp;</li>
    <li><a href="test2.php"class="current">ALL BOOKS</a>&nbsp; &nbsp;&nbsp; </li>
    <li><a href="#">ABOUT US</a>&nbsp; &nbsp; &nbsp;</li>
  	<li>   <a href="#">CONTACT US</a> </li>
    </ul>
    </nav>
     <!-- 
       <!-- <a style="float:right">
	</a>&bull;  &nbsp; &nbsp;
    </a>-->
</div>
</div>
  <div id="pageContent">
  <table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    
    
    <td width="33%" valign="top" align="center"><?php echo $dynamicList; ?></td>
    <td width="37%" valign="top" align="center"><?php echo $dynamicList_1; ?></td>
    <td width="30%" valign="top" align="center"><?php echo $dynamicList_2; ?></td>
</tr>
  </table>
<?php include_once("template_footer.php");?>
  </div>
  
</div>
</body>
</html>
<?php ?>