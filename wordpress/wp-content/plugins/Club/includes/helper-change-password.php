<?php
session_start();
global $wpdb, $table_prefix;

require_once('../../../../wp-config.php');
require_once('../../../../wp-includes/wp-db.php');

?>
<h3>change password</h3>

<?php
$user = wp_get_current_user();
//print_r($user);
if(!isset($_POST)) {
	//echo "string";
	die;
    $email = $_SESSION['email'];
    $currentpassword = $_POST['currentPassword'];
    $newpassword = $_POST['newPassword']; 
    $newConfirmPassword = $_POST['retypePassword'];

	$empty_new_pw = empty($newpassword) || empty($newConfirmPassword);
	require_once ABSPATH . 'wp-includes/class-phpass.php';
	$wp_hasher = new PasswordHash( 8, true );
	$password_changed_ok = false;
	$invalid_password = false;
	$passwords_dont_match = ($newpassword != $newConfirmPassword);
	echo $passwords_dont_match;
	echo "<br>";
	echo $empty_new_pw;

	if ($passwords_dont_match || $empty_new_pw) {
  	// empty on purpose
	} else if ( wp_check_password( $currentpassword, $user->user_pass, $user->ID ) ) {
	echo "matched";
	die;
  	wp_set_password($newpassword, $user->ID);

 	 $userid=$user->ID;

//  $user = wp_signon(array('user_login' => $user->user_login, 'user_password' => $newpassword));

	  // $userdata['ID'] = $userid; //user ID
	  // $userdata['user_pass'] = $newpassword;
	  // print_r($newpassword);
	  // die;
	  // wp_update_user( $userdata );

	  $password_changed_ok = true;
	  $url = site_url();
	  $dir=$url.'/login-landing/';
      echo "<script>window.location = '".$dir."'</script>";
	} else {
		echo "Invalid password";
	  $invalid_password = true;
	}

	}
	else{
		echo"test";
	}

		// $empty_new_pw = empty($newpassword) || empty($confirmpassword);
	 //    $oldpss = $wpdb->get_var("SELECT user_pass FROM $wpdb->users WHERE user_email = '$email'");
	 //    print_r($oldpss);die;
	//}
