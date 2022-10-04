<?php

/**
 * Redirect To Custom Login Page
 *
 * @since  1.0
 * @refer  http://www.hongkiat.com/blog/wordpress-custom-loginpage/
 */
function redirect_login_page() {

    $register_page  = home_url( '/register' );
    $login_page    = home_url( '/register?action=login' );
    $page_viewed   = basename($_SERVER['REQUEST_URI']);

    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }

    if( $page_viewed == "wp-login.php?action=register" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($register_page);
        exit;
    }
}
add_action('init','redirect_login_page');

// Redirect For Login Failed
function login_failed() {

    wp_redirect( home_url( '/register?action=login&login=failed' ) );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' );

// Redirect For Empty Username Or Password
function verify_username_password( $user, $username, $password ) {
    if ( $username == "" || $password == "" ) {

        wp_redirect( home_url( '/register?action=login&login=empty' ) );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);