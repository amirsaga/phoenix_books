 <?php  
// Connect to the file above here  
require "connect_to_mysql.php"; 

$sqlCommand = "CREATE TABLE user_products(
				id bigint(20)NOT NULL auto_increment,
				user_product_name varchar(255) NOT NULL,
				original_price float(11) NOT NULL,
				reduced_price float(11) NOT NULL,
				author varchar(24) NOT NULL,
				category varchar(24) NOT NULL,
				date_added date NOT NULL,
				condition text NOT NULL,
				description text NOT NULL,
				
				PRIMARY KEY(id)
				)";
			
	if(mysql_query($sqlCommand)){
		echo"your table has been created!!!!";
	}
	else{
		echo"there is error!!";
		}
?>