<?php 
  include "storescripts/connect_to_mysql.php";
?>
<?php
        //display the contents
        $sql = "SELECT * FROM us_products ORDER BY id DESC LIMIT 12";
        $result = mysql_query($sql);
        while($row = mysql_fetch_array($result)) :
            $id = $row["id"];
            $user_product_name = $row["user_product_name"];
            $original_price = $row["original_price"];
			$reduced_price = $row["reduced_price"];
			$author= $row["author"];
			$description = $row["description"];
			$condition = $row["status"];
			$category = $row["category"];
			$date_added = $row["date_added"];
            $src = "storeuser/user_products_images/".$id.".jpg";
      ?>
      <div style="float:left;margin:10px;">
        <a href="user_product.php?id=<?php echo $id; ?>">
          <img style="border:#666 1px solid;width:100px;height:120px;" src="<?php echo $src; ?>" alt="<?php echo $user_product_name; ?>" />
        </a><br />
        <?php echo $user_product_name; ?><br />
        <?php echo "Rs.".$original_price; ?><br />
        <a href="user_product.php?id=<?php echo $id; ?>">View Book Details</a>
      </div>
    <?php endwhile; ?>
