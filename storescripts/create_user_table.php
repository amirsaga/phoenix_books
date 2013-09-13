 <?php  
// Connect to the file above here  
require "connect_to_mysql.php"; 

$sqlCommand = "CREATE TABLE users(
				id bigint(20)NOT NULL auto_increment,
				first_name varchar(255) NOT NULL,
				last_name varchar(255) NOT NULL,
				username varchar(255) NOT NULL,
				password varchar(255) NOT NULL,
				email varchar(255) NOT NULL,
				phone bigint(20)NOT NULL,
				house_no int(10) NOT NULL,
				ward_no int(10) NOT NULL,
				city varchar(255) NOT NULL,
				PRIMARY KEY(id),
				UNIQUE KEY username(username)
			)";
			
	if(mysql_query($sqlCommand)){
		echo"your admin table has been created!!!!";
	}
	else{
		echo"there is error!!";
		}
?>