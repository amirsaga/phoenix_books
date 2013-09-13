 <?php  
// Connect to the file above here  
require "connect_to_mysql.php"; 

$sqlCommand = "CREATE TABLE admin(
				aid int(11)NOT NULL auto_increment,
				admin_name varchar(24) NOT NULL,
				password varchar(24) NOT NULL,
				last_log_date date NOT NULL,
				PRIMARY KEY(aid),
				UNIQUE KEY admin_name(admin_name)
			)";
			
	if(mysql_query($sqlCommand)){
		echo"your admin table has been created!!!!";
	}
	else{
		echo"there is error!!";
		}
?>