 <?php  
// Connect to the file above here  
require "connect_to_mysql.php"; 

$sqlCommand = "CREATE TABLE products(
				id int(11)NOT NULL auto_increment,
				product_name varchar(255) NOT NULL,
				price varchar(16) NOT NULL,
				details text NOT NULL,
				category varchar(24) NOT NULL,
				subcategory varchar(24) NOT NULL,
				date_added date NOT NULL,
				PRIMARY KEY(id),
				UNIQUE KEY product_name(product_name)
			)";
			
	if(mysql_query($sqlCommand)){
		echo"your admin table has been created!!!!";
	}
	else{
		echo"there is error!!";
		}
?>