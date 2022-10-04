<?php

global $wpdb, $table_prefix;
//session_start();

require_once('../../../../wp-config.php');
require_once('../../../../wp-includes/wp-db.php');


if (!session_id()) {
    session_start();
}
if (isset( $_SESSION["email"])) {



    $urll = site_url();    //echo "ssssssssssssssss";die();
    $dir=$urll.'/addClub';
    global $wpdb;
    $email = $_SESSION['email'];
    $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}users  WHERE `user_email`='$email'", OBJECT);
    $phone=$_POST['phone'];
    $mobile=$_POST['mobile'];
    $name = $_POST['name'];
    $fax=$_POST['fax'];
    $internal_adress=$_POST['hompage'];
    $login = $_POST['name'];
    $contact=$_POST['contact'];
    $contact_time=$_POST['contact_time'];
    $role = 'club';
$description="Internal Adderss ".$internal_adress."\n"."Contact Pareson ".$contact."\n"."Conatc time ".$contact_time."\n";
    $email = $_POST['email'];
    $url = $_POST['hompage'];
    $today = date("Y-d-m h:i:s");

    foreach ($results as $res) {
        if ($res->user_email != $_POST['email']) {
                $password=$res->user_pass;
            $userdata = array(
                'user_login'    =>  $login,
                'user_pass'     =>  $password,
                'user_url'      =>  $url,
                'first_name'    =>  $name,
                'last_name'     =>  $name,
                'nickname'      =>  $name,
                'user_email'      =>  $email,
                'description'   =>  $description,
                'role' => $role,
            );

            $user = wp_insert_user( $userdata );
            $url = site_url();

            $dir=$url.'/clubaccount';

            // header("Location: $dir");
            echo "<script>window.location = '".$dir."'</script>";
        }else{echo "Error";}
    }

}

