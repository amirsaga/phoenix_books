<?php function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed: " . mysql_error());
		}
	}
?>

<?php
		session_start();// 1. Find the session
		
		$_SESSION = array();// 2. Unset all the session variables	
		
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}// 3. Destroy the session cookie
		
		session_destroy();// 4. Destroy the session
		
		redirect_to("admin_login.php?logout=1");
?>