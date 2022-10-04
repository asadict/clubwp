<?php

session_start();
global $wpdb, $table_prefix, $user_ID;

require_once('../../../../wp-config.php');
require_once('../../../../wp-includes/wp-db.php');

	if ( isset($_POST["user_email"]) && isset($_POST["user_password"]) ) {
		$user_login     = $_POST["user_email"];
		$user_password  = $_POST["user_password"];

		$creds = array();
		$creds['user_login'] = $user_login;
		$creds['user_password'] = $user_password;
		$creds['remember'] = true;

		$verify_user = wp_signon( $creds, false );
				
		
		if(!is_wp_error($verify_user)){
				$url = site_url();
				$dir=$url.'/clubaccount/';
                echo "<script>window.location = '".$dir."'</script>";
		}else{
			// echo $verify_user->get_error_message();
			echo "Invalid credentials";?>
			<!-- <input type="hidden" name="error" value="<?php $verify_user->get_error_message(); ?>"> -->
			<?php
			// $url = site_url();
			// $dir=$url.'/login-landing/';
			// echo "<script>window.location = '".$dir."'</script>";
			// echo $verify_user->get_error_message();
			// echo "<p class='error'>Invalid credentials</p>";
   //         exit();
		}
	}
	else{
		echo "logged in";
	}
