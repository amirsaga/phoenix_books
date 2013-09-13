<div id="pageHeader" style="background:#e6e3d4"><table width="100%" border="0" cellpadding="12">
  <tr>
    <td width="29%"><td> <h3 style="font:'Lucida Sans Unicode', 'Lucida Grande', sans-serif">PHOENIX BOOKS </h3><p style="font-style:italic">An online Store Book Store</p></td>
    <td width="23%"><div style="float:right">  <?php echo $toplinks; ?><br/> 
  </tr>
  
  </table>
  
<p style="float:right;"><?php if (isset($_SESSION["manager"])) { echo "ADMIN:&nbsp;&nbsp;".$_SESSION["manager"]; }?></p>
 <div id="mainbar" >
 <nav class="cf">
      <ul>
   <li> <a href="index.php" >HOME</a></li>
    <li><a href="inventory_list.php">INVENTORY</a></li>
     <li><a href="user_list.php">USERS</a></li>
  	<li><a href="#">CONTACT US</a> </li>
    </ul>
    </nav>
    
</div>
</div>