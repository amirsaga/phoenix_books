<?php 
  include "storescripts/connect_to_mysql.php";
?>

<?php
  //display the contents
  $sql = "SELECT * FROM products ORDER BY id DESC ";
  $result = mysql_query($sql) or die('error in quering');
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
  <a href="product.php?id=<?php echo $id; ?>">View Book Details</a>
</div>
<?php endwhile; ?>
