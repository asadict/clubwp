<?php
/*
Template Name: Register Page

@refer https://millionclues.com/tutorials/custom-wordpress-register-login-page
*/

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body id="login-page" <?php body_class(); ?>>

<div class="container">

    <div class="row register-page-container p-3 p-lg-5 mt-5 d-flex justify-content-center w-75 mx-auto">

        <?php
        global $wpdb, $user_ID;

        //Check whether the user is already logged in
        if (!$user_ID) {

            // Default page shows register form.
            // To show Login form set query variable action=login
            $action  = (isset($_GET['action']) ) ? $_GET['action'] : 0;

            // Login Page
            if ($action === "login") { ?>

                <?php
                $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

                if ( $login === "failed" ) {
                    echo '<div class="col-12 register-error"><strong>ERROR:</strong> Invalid username and/or password.</div>';
                } elseif ( $login === "empty" ) {
                    echo '<div class="col-12 register-error"><strong>ERROR:</strong> Username and/or Password is empty.</div>';
                } elseif ( $login === "false" ) {
                    echo '<div class="col-12 register-error"><strong>ERROR:</strong> You are logged out.</div>';
                }
                ?>

                <div class="col-md-5 social-login-form">

                    <a class="d-block my-4" href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=wordpress_social_authenticate&mode=login&provider=Facebook">
                        <img src="<?php echo BIM_BASE_PATH ?>assets/img/login-facebook.png" />
                    </a>

                    <a class="d-block my-4" href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=wordpress_social_authenticate&mode=login&provider=Twitter">
                        <img src="<?php echo BIM_BASE_PATH ?>assets/img/login-twitter.png" />
                    </a>

                    <a class="d-block my-4" href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=wordpress_social_authenticate&mode=login&provider=Google">
                        <img src="<?php echo BIM_BASE_PATH ?>assets/img/login-gplus.png" />
                    </a>

                </div>

                <div class="col-md-2 middle-or d-flex align-items-center">
                    <p class="or mx-auto">OR</p>
                </div>

                <div class="col-md-5">

                    <?php
                    $args = array(
                        'redirect' => home_url().'/wp-admin/',
                    );

                    wp_login_form($args); ?>

                    <p class="text-center"><a class="mr-2" href="<?php echo wp_registration_url(); ?>">Register Now</a>
                        <span clas="mx-2">·</span><a class="ml-2" href="<?php echo wp_lostpassword_url( ); ?>" title="Lost Password">Lost Password?</a></p>

                </div>

                <?php

            } else { // Register Page ?>

                <?php
                if ( $_POST ) {

                    $error = 0;

                    $username = esc_sql($_REQUEST['username']);
                    if ( empty($username) ) {

                        echo '<div class="col-12 register-error">User name should not be empty.</div>';
                        $error = 1;
                    }

                    $email = esc_sql($_REQUEST['email']);
                    if ( !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email) ) {

                        echo '<div class="col-12 register-error">Please enter a valid email.</div>';
                        $error = 1;
                    }

                    if ( $error == 0 ) {

                        $random_password = wp_generate_password( 12, false );
                        $status = wp_create_user( $username, $random_password, $email );

                        if ( is_wp_error($status) ) {

                            echo '<div class="col-12 register-error">Username already exists. Please try another one.</div>';
                        } else {

                            $from     = get_option('admin_email');
                            $headers   = 'From: '.$from . "\r\n";
                            $subject   = "Registration successful";
                            $message   = "Registration successful.\nYour login details\nUsername: $username\nPassword: $random_password";

                            // Email password and other details to the user
                            wp_mail( $email, $subject, $message, $headers );

                            echo "Please check your email for login details.";

                            $error = 2; // We will check for this variable before showing the sign up form.
                        }
                    }

                }

                if ( $error != 2 ) { ?>

                    <?php if(get_option('users_can_register')) { ?>

                        <div class="col-md-5 social-register-form">

                            <a class="d-block my-4" href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=wordpress_social_authenticate&mode=login&provider=Facebook">
                                <img src="<?php echo BIM_BASE_PATH ?>assets/img/signup-facebook.png" />
                            </a>

                            <a class="d-block my-4" href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=wordpress_social_authenticate&mode=login&provider=Twitter">
                                <img src="<?php echo BIM_BASE_PATH ?>assets/img/signup-twitter.png" />
                            </a>

                            <a class="d-block my-4" href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=wordpress_social_authenticate&mode=login&provider=Google">
                                <img src="<?php echo BIM_BASE_PATH ?>assets/img/signup-gplus.png" />
                            </a>

                        </div>

                        <div class="col-md-2 middle-or align-items-center d-flex">
                            <p class="or mx-auto">OR</p>
                        </div>

                                <div class="col-md-5 manual-register-form">

                                    <p class="purple-text text-center">Sign Up Manually</p>

                                    <form action="" method="post">
                                        <input type="text" name="username" placeholder="Username" class="register-input mb-4" value="<?php if( ! empty($username) ) echo $username; ?>" /><br />
                                <input type="text" name="email" placeholder="Email" class="register-input mb-4" value="<?php if( ! empty($email) ) echo $email; ?>" /> <br />
                                <input type="submit" id="register-submit-btn" class="mb-4" name="submit" value="SignUp" />
                            </form>

                            <p>Already have an account? <a href="<?php echo get_permalink(); ?>?action=login">Login Here</a></p>

                        </div>

                    <?php } else {

                        echo "Registration is currently disabled. Please try again later.";

                    }

                } ?>

            <?php }

        } else { ?>

            <p>You are logged in. Click <a href="<?php bloginfo('wpurl'); ?>">here to go home</a></p>

        <?php } ?>

    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>