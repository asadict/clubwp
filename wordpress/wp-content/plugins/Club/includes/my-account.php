<?php
function ClubAccount(){
    // if (!session_id()) {
    //     session_start();
    // }
   // session_start();
global $wpdb, $table_prefix;
$url = site_url();
//require_once('wp-config.php');
//require_once('wp-includes/wp-db.php');

if (is_user_logged_in()) {
    global $wpdb;
    $user = wp_get_current_user();
    echo "Hi <span>".$user->user_nicename."</span>";
     ?>
        <div class="collapse navbar-collapse" id="navbarsExample02">
            <form class="form-inline my-2 my-md-0"> </form>
        </div>
        </nav>
        <div id="wrapper" class="toggled">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
            <?php
            include("admin-menu.php");
            ?>
            </div> <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                </div>
            </div> <!-- /#page-content-wrapper -->
        </div> <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->
        </html>
        <?php
    
}else{
    $link = get_permalink().'/login-landing/';
    echo "<script>window.location = '".$link."'</script>";
}
}

add_shortcode( 'ClubAccount', 'ClubAccount' );



