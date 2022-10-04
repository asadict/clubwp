<?php
global $wpdb, $table_prefix;

require_once('../../../../wp-config.php');
require_once('../../../../wp-includes/wp-db.php');

if(isset($_POST)) {


    $name=$_POST['name'];
    $login=$_POST['login'];
    $password= md5($_POST['password']);
    $email=$_POST['email'];
    $url = site_url();
    $today = date("Y-d-m h:i:s");


    global $wpdb;
   /* echo "<pre>"; print_r($wpdb);    echo "</pre>";*/

    $table_name = $wpdb->prefix.'users';
    $wpdb->insert(
        $table_name,
        array(

            'user_login'     => $login,
            'user_pass'    => $password,
            'user_nicename'   => 'club',
            'user_email'   => $email,
            'user_url'        => $url,
            'user_registered'  => $today,
            'user_activation_key'       => '',
            'user_status' => '0',
            'display_name'    => $name,
        ));
}

?>