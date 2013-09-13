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
	$toplinks = '<a href="storeuser/user_profile.php?id=' . $userid . '">' . $username . '</a> &bull; 
	<a href="storeuser/user_account.php">Account</a> &bull; 
	<a href="storeuser/user_logout.php">Log Out</a>';
} else {
	$toplinks = '  <a href="storeuser/user_login.php">Login</a>&nbsp;&bull;&nbsp;<a href="join.php">Register</a>';
}
  ?>

<?php 
  include "storescripts/connect_to_mysql.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Store Home Page</title>
<!--<link rel="stylesheet" href="style/style.css" type="text/css" 
media="screen" /> -->
<script type="text/javascript" src="javascripts/script.js"></script>
</head>

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
	background:#AD9B7F;
	color:white;
	padding:.2em 0 .2em 1em;
	line-height:2em;
	border-bottom:.125em solid white;
	border-radius:.3em .3em 0 0;
	
}
#sidebar li a:hover, li a:focus{
	background:#D5973C;
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
	//background: #916A31;
	height: 2.9em;
}

#mainbar ul {
	background:#AD9B7F;
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
	background: #D5973C;
	height:3em;
	padding-top:.3em;
	position:relative;
	top:-.1em;
	border-radius:.3em .3em 0 0;
	}

#mainbar a.current,a:hover.current{
	
	background:#916a31;
	color:#eee;
	padding-top:.3em;
	position:relative;
	top:-.2em;
	border-radius:.3em .3em 0 0;
	border-bottom:.1em solid #917F63;
	cursor:default;
	}
.button{
	background:rgb(2,99,174);
	color:white;
	padding:0 1em;
	height:2.4em;
	display:table;
	border:1px solid rgb(32,124,202);
	font-family: Helvetica, sans-serif;
	font-weight:100;
	font-size:1em;
	text-transform:uppercase;
	letter-spacing: 0.045em;
	line-height:2.4em;
	text-decoration:none;
	text-align:center;
	white-space:nowrap;
	cursor:pointer;
	border-radius:.4em ;
	box-shadow:inset 0px 1px 3px rgb(162,200,229);
	
}	
.button:hover{
	}	 
</style>
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

 <a href="cart.php" style="float:right"><?php if (isset($_SESSION["username"])) {echo "Cart";}?></a>

 <div id="mainbar" >
 <nav class="cf">
      <ul>
   <li> <a href="test.php" class="current">HOME</a>&nbsp; &nbsp; &nbsp;</li>
    <li><a href="test2.php">ALL BOOKS</a>&nbsp; &nbsp;&nbsp; </li>
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
    <div id="sidebar" style="width:150px;height:auto;float:left;">
      <h2>MENU LIST</h2>
        
    <ul style="text-align:left;">
      <li><a href="category.php?cat=NOBLE">NOBLE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    <li><a href="category.php?cat=NOBLE">NOBLE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    <li><a href="category.php?cat=NOBLE">NOBLE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    <li><a href="category.php?cat=NOBLE">NOBLE</a></li>
      <li><a href="category.php?cat=FICTION">FICTION</a></li>
        <li><a href="category.php?cat=STORY">STORY</a></li>
    <li><a href="category.php?cat=TEXT-BOOKS">TEXT-BOOKS</a></li>
    
</ul>
    </div>
    <div id="rightDiv"><h2>FEATURED BOOKS</h2><br/>
      <?php
        //display the contents
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 12";
        $result = mysql_query($sql);
        while($row = mysql_fetch_array($result)) :
            $id = $row["id"];
            $product_name = $row["product_name"];
            $price = $row["price"];
            $src = "inventory_images/".$id.".jpg";
      ?>
      <div style="float:left;margin:10px;">
        <a href="product.php?id=<?php echo $id; ?>">
          <img style="border:#666 1px solid;width:100px;height:120px;" src="<?php echo $src; ?>" alt="<?php echo $product_name; ?>" />
        </a><br />
        <?php echo $product_name; ?><br />
        <?php echo "Rs.".$price; ?><br />
        <a href="product.php?id=<?php echo $id; ?>">View Product Details</a>
      </div>
    <?php endwhile; ?>
    </div>
    <div style="clear:both;"></div>
     <?php include_once("template_footer.php");?>
  </div>
 
</div>
</body>
</html>