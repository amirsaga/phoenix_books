<div id="pageHeader"><table width="100%" border="0" cellpadding="12">
  <tr>
    <td width="70%"></td>
     <td width="23%"><div style="float:right">  <?php echo $toplinks; ?><br/> 
    <form action='../search_page.php' method="get">
	<font face="Tahoma, Geneva, sans-serif" size="5">
    	
       <br>
        <input type="text" size="15" name="search" placeholder="Insert keyword"/>
        <input type="submit" name="submit" value="Search" />
        
        </font>
        </form></div></td>
  </tr>
  </table>
   <a href="../cart.php" style="float:right"><?php if (isset($_SESSION["username"])); ?>Bucket</a>
<br />
<br />
<br />
 <div id="mainbar" >
 <nav class="cf">
      <ul>
   <li> <a href="../index.php" >HOME</a></li>
    <li><a href="../product_list.php">ALL NEW BOOKS</a></li>
    <li><a href="../user_uploaded.php">SECOND HAND BOOKS</a> </li>
    <li><a href="#contact">ABOUT US</a></li>
  	
    </ul>
    </nav>
     <div id="contact" class="modalDialog" >
	<div>
		<a href="#close" title="Close" class="close" style="color:#666;">X</a>
		<h2 >ABOUT US</h2>
		<p>This is a website we build as a part of our cirriculum project. If you further want to know about the site you can contact us </p>
		<div id="develop" > <fieldset ><legend><H2 align="center"> DEVELOPED BY </H2></legend>
        <div style="width:400; float:left;" >
        <p>Name: Nimesh Mishra <br />
		Phone: 9803467913<br />
        Address: Kathmandu<br />
        Email:nimeshmishra@live.com
        </p></div>
        <div >
        <p>Name: Amir Shrestha <br />
		Phone: 9841007011<br />
        Address: BANEPA</br/>
        Email:mrshrsth007@gmail.com
        </p>
        </div>
	</div></fieldset>
</div>
    
</div>
</div>