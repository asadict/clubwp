<?php
global $wpdb, $table_prefix;
session_start();

require_once('../../../../wp-config.php');
require_once('../../../../wp-includes/wp-db.php');
global $wpdb, $table_prefix;
require_once('../../../../wp-config.php');
require_once('../../../../wp-includes/wp-db.php');


if(isset($_POST)) {
    $email = $_POST['email'];
    $checkIfExists = $wpdb->get_var("SELECT user_email FROM $wpdb->users WHERE user_email = '$email'");

    if (empty($checkIfExists)) {
        $name = $_POST['name'];
        //$login = $_POST['login'];
        $password = $_POST['password'];
        $url = site_url();
        $today = date("Y-d-m h:i:s");
        global $wpdb;

        $userdata = array(
            'user_login'    =>  $email,
            'user_pass'     =>  $password,
            'user_url'      =>  $url,
            'first_name'    =>  $name,
            'last_name'     =>  $name,
            'nickname'      =>  $name,
            'user_email'      =>  $email,
            'description'   =>  "club",
            'role' => 'club'
        );
        
        $user = wp_insert_user( $userdata );
        //echo "<pre>";
        //print_r($user);die;

    // $url = get_site_url().'/login-landing/';
    // wp_redirect( $url );
    //exit;
        // $_SESSION["email"]=$email;

        // $url = site_url();

        if($user){
            $login_array = array();
            $login_array['user_login'] = $email;
            $login_array['user_password'] = $password;

            $verify_user = wp_signon($login_array,true);
            if(!is_wp_error($verify_user)){
                $dir=$url.'/clubaccount/';
                echo "<script>window.location = '".$dir."'</script>";
                //echo "<script>window.location = '".site_url()."'</script>";
            }else{
                echo "Invalid credentials";
            }
        }

        //$dir=$url.'/clubaccount/';
        //$dir=$url.'/login-landing/';

        //echo "<script>window.location = '".$dir."'</script>";

    } else {
        echo 'This email is registred';
    }

}