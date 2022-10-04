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
        $dir=$urll.'/addTrainer';
        global $wpdb;
        $email = $_SESSION['email'];
        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}users  WHERE `user_email`='$email'", OBJECT);

        $name = $_POST['name_trainer'];
        $login = $_POST['name_trainer'];
        $role = $_POST['type'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $url = $_POST['hompage'];
        $today = date("Y-d-m h:i:s");
      /*  echo $name."<br>";
        echo $login."<br>";
        echo $role."<br>";
        echo $password."<br>";
        echo $email."<br>";
        echo $url."<br>";
        echo $today."<br>";*/
        foreach ($results as $res) {
            if ($res->user_email != $_POST['email']) {

               /* $table_name = $wpdb->prefix . 'users';
                $wpdb->insert(
                    $table_name,
                    array(
                        'user_login' => $login,
                        'user_pass' => $password,
                        'user_nicename' => $name,
                        'user_email' => $email,
                        'user_url' => $url,
                        'user_registered' => $today,
                        'user_activation_key' => '',
                        'user_status' => '0',
                        'display_name' => $name,
                        'role' => $role,
                    ));*/

                $userdata = array(
                    'user_login'    =>  $login,
                    'user_pass'     =>  $password,
                    'user_url'      =>  $url,
                    'first_name'    =>  $name,
                    'last_name'     =>  $name,
                    'nickname'      =>  $name,
                    'user_email'      =>  $email,
                    'description'   =>  $role,
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

