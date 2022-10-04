<?php
/**
 * @package CRRC
 */
/**
 * Plugin Name:Club
 * Plugin URI:#
 * Description: Club
 * Version: 0.1
 * Author: Club
 * Author URI:#
 */
/*
$cat = get_term_by( 'Trainers', $cat_name, 'category' );*/
/*if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}*/
include(plugin_dir_path( __FILE__ ) . 'includes/posttypes_post_types_parent.php');
include(plugin_dir_path( __FILE__ ) . 'includes/posttypes-Clubs.php');
include(plugin_dir_path( __FILE__ ) . 'includes/my-account.php');
//include(plugin_dir_path( __FILE__ ) . 'includes/create_Trainer.php');
include(plugin_dir_path( __FILE__ ) . 'includes/addClub.php');
include(plugin_dir_path( __FILE__ ) . 'includes/manage-data.php');
include(plugin_dir_path( __FILE__ ) . 'includes/change-password.php');
include(plugin_dir_path( __FILE__ ) . 'includes/jobs.php');
include(plugin_dir_path( __FILE__ ) . 'includes/trainer.php');
include(plugin_dir_path( __FILE__ ) . 'includes/quicksearch-home.php');
include(plugin_dir_path( __FILE__ ) . 'includes/club_listing.php');
include(plugin_dir_path( __FILE__ ) . 'includes/gym.php');
include(plugin_dir_path( __FILE__ ) . 'includes/course.php');
include(plugin_dir_path( __FILE__ ) . 'includes/course_listing.php');
include(plugin_dir_path( __FILE__ ) . 'includes/trainer-listing.php');
include(plugin_dir_path( __FILE__ ) . 'includes/job-listing.php');
include(plugin_dir_path( __FILE__ ) . 'includes/gym-listing.php');
include(plugin_dir_path( __FILE__ ) . 'includes/home-search.php');
include(plugin_dir_path( __FILE__ ) . 'includes/gymSlotBooking.php');
include(plugin_dir_path( __FILE__ ) . 'includes/gymownerbooking.php');
include(plugin_dir_path( __FILE__ ) . 'includes/csvdownload.php');


add_action('wp_logout','user_logout');
function user_logout(){
    $url = site_url().'/login-landing/';
    wp_redirect($url);
    exit;
}
function add_plugin_link( $plugin_actions, $plugin_file ) {

    $new_actions = array();


        $new_actions['cl_settings'] = sprintf( __( '<a href="options-general.php?page=settings">Settings</a>', '' ) );


    return array_merge( $new_actions, $plugin_actions );
}
add_filter( 'plugin_action_links', 'add_plugin_link', 10, 2 );

//hide sidebar for user
add_action('after_setup_theme', 'remove_admin_bar');
    function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
}


add_action('admin_menu', 'club_plugin_setup_menu');
function club_plugin_setup_menu(){
    add_menu_page( 'Club settings', 'Club Settings', 'manage_options', 'club-setting', 'club_setting' );
    add_submenu_page("club-setting", "Booking List", "Booking List", 0, "booking-list", "options_page");
}
function club_setting(){
     include(plugin_dir_path( __FILE__ ) . 'club_settings.php');
}

function custom_plugin_register_settings() {
 
register_setting('custom_plugin_options_group', 'club_dashboard_link');
 
register_setting('custom_plugin_options_group', 'trainer_link');
 
register_setting('custom_plugin_options_group', 'manage_club_link');

register_setting('custom_plugin_options_group', 'change_password_link');

register_setting('custom_plugin_options_group', 'courses_link');

register_setting('custom_plugin_options_group', 'gym_link');

register_setting('custom_plugin_options_group', 'gym_booking_link');

register_setting('custom_plugin_options_group', 'jobs_link');
 
register_setting('custom_plugin_options_group', 'csv_link');
}
add_action('admin_init', 'custom_plugin_register_settings');

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_ajax_customerdata', 'get_ajax_customerdata');
add_action('wp_ajax_nopriv_get_ajax_customerdata', 'get_ajax_customerdata');


function options_page()
{
    include(plugin_dir_path( __FILE__ ) . 'settings.php');
}

function tatwerat_startSession() {
    if(!session_id()) {
       // session_start();
    }
}
add_action('init', 'tatwerat_startSession', 1);


add_role(
    'club', //  System name of the role.
    __( 'User Club'  ), // Display name of the role.
    array(
        'read'  => true,
        'delete_posts'  => false,
        'delete_published_posts' => false,
        'edit_posts'   => false,
        'publish_posts' => false,
        'upload_files'  => false,
        'edit_pages'  => false,
        'edit_published_pages'  =>  false,
        'publish_pages'  => false,
        'list_users' => true,
        'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
    )
);

//If User Roll is club, It can not login in Dashboard 
function wpse23007_redirect()
{
    if( is_admin() && !defined('DOING_AJAX') && current_user_can('club') )
    {
        wp_logout();
        wp_redirect(home_url());
        exit;
    }
}
add_action('init','wpse23007_redirect');



add_role(
    'trainer', //  System name of the role.
    __( 'trainer'  ), // Display name of the role.
    array(
        'read'  => true,
        'delete_posts'  => false,
        'delete_published_posts' => false,
        'edit_posts'   => false,
        'publish_posts' => false,
        'upload_files'  => false,
        'edit_pages'  => false,
        'edit_published_pages'  =>  false,
        'publish_pages'  => false,
        'delete_published_pages' => false, // This user will NOT be able to  delete published pages.
    )
);
add_action('admin_enqueue_scripts', 'scripts_styles');



function scripts_styles() {
    
   
    wp_enqueue_style(  'select2-style', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css');
    wp_enqueue_style(  'club_web_css_admin', 'https://cdn.syncfusion.com/19.2.0.44/js/web/flat-azure/ej.web.all.min.css' );
    wp_enqueue_style(  'mystyle', plugin_dir_url( __FILE__ ).'css/custom.css' );
    wp_enqueue_style(  'club_admin', plugin_dir_url( __FILE__ ).'css/club.css' );
    wp_enqueue_script(  'club_admin_js', 'https://cdn.syncfusion.com/js/assets/external/jquery-1.10.2.min.js' );
    wp_enqueue_script(  'club_web_admin', 'https://cdn.syncfusion.com/19.2.0.44/js/web/ej.web.all.min.js' );
    
    wp_enqueue_script(  'select2_script','https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js' );
    wp_enqueue_script(  'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js' );
    wp_enqueue_script(  'myscript', plugin_dir_url( __FILE__ ) .'/js/image-upload.js' );
    wp_enqueue_script(  'validation1', plugin_dir_url( __FILE__ ).'js/jquery.validate.js' );
    wp_enqueue_script(  'crrc_scripts', plugin_dir_url( __FILE__ ) .'/js/scripts.js' );
    
   
   // wp_enqueue_style(  'modal-popup-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');

}
function add_theme_scripts() {
    //wp_enqueue_script(  'custom_map_front', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap' );
    
    wp_enqueue_style(  'club_web_css_front', 'https://cdn.syncfusion.com/19.2.0.44/js/web/flat-azure/ej.web.all.min.css' );
    wp_enqueue_style(  'club', plugin_dir_url( __FILE__ ).'css/club.css' );
    wp_enqueue_style(  'schedulebookingstyle', plugin_dir_url( __FILE__ ).'includes/js/jQuery-Schedule/dist/jquery.schedule.css' );
    wp_enqueue_style(  'datepicker-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css');
    wp_enqueue_style(  'select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');

    wp_enqueue_script(  'club_front_js', 'https://cdn.syncfusion.com/js/assets/external/jquery-1.10.2.min.js');
    wp_enqueue_script(  'club_web_front', 'https://cdn.syncfusion.com/19.2.0.44/js/web/ej.web.all.min.js');
    wp_enqueue_script(  'validation', plugin_dir_url( __FILE__ ).'js/jquery.validate.js');
    wp_enqueue_script(  'select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js');
    wp_enqueue_script(  'schedulebookingscript', plugin_dir_url( __FILE__ ).'includes/js/jQuery-Schedule/dist/jquery.schedule.js');
    wp_enqueue_script(  'datepicker', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
    
    wp_enqueue_script(  'myclubjs', plugin_dir_url( __FILE__ ).'js/scripts.js' );
    

}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts',999 );
add_action( 'wp_footer', 'my_footer_scripts' );

function my_footer_scripts(){
  ?>

 <script type="text/javascript">
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
    jQuery(document).ready(function($){
         var now = new Date();
        var month = (now.getMonth() + 1);               
        var day = now.getDate();
        if (month < 10) 
        month = "0" + month;
        if (day < 10) 
         day = "0" + day;
        var today = now.getFullYear() + '-' + month + '-' + day; 
      });

     jQuery( function() {
    jQuery( "#my_date_picker" ).datepicker({minDate: 0,dateFormat: "yy-mm-dd"});
    
    

    jQuery("#starting_date").on("click", function(){
        jQuery(this).siblings("input").datepicker("show");    
    });
    
  } );   
  jQuery( function() {
    jQuery( "#my_date_picker_to" ).datepicker({minDate: 0,dateFormat: "yy-mm-dd"});
    

    jQuery("#ending_date").on("click", function(){
        jQuery(this).siblings("input").datepicker("show");    
    });
    
  } );    
  
</script>
  <?php
}
register_activation_hook( __FILE__, 'myplugin_activate' );

function myplugin_activate(){

    global $wpdb, $wnm_db_version;

    $wordpress_page = array(
        'post_title' => 'ClubAccount',
        'post_content' => '[ClubAccount]',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'page'
    );
    wp_insert_post($wordpress_page);
    // $wordpress_page_login = array(
    //     'post_title' => 'login',
    //     'post_content' => '[ClubLogin]',
    //     'post_status' => 'publish',
    //     'post_author' => 1,
    //     'post_type' => 'page'
    // );
    // wp_insert_post($wordpress_page_login);

    // $wordpress_page_reg = array(
    //     'post_title' => 'Registration',
    //     'post_content' => '[ClubRegister]',
    //     'post_status' => 'publish',
    //     'post_author' => 1,
    //     'post_type' => 'page'
    // );
    // wp_insert_post($wordpress_page_reg);
	///////////////////////////
    $wordpress_page_add_trainer = array(
        'post_title' => 'addTrainer',
        'post_content' => '[addTrainer]',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'page'
    );
   $wordpress_page_add_club = array(
        'post_title' => 'addClub',
        'post_content' => '[addClub]',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'page'
    );
    wp_insert_post($wordpress_page_add_club);
   	//our pages
   	$wordpress_page_login_register = array(
        'post_title' => 'Login Landing',
        'post_content' => '[ClubRegister][ClubLogin]',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'page'
    );
    wp_insert_post($wordpress_page_login_register);
    $wordpress_page_template = array(
        'post_title' => 'Provider Detail',
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'page'
    );
    wp_insert_post($wordpress_page_template);
    $wordpress_page_template_offer = array(
        'post_title' => 'Sports Offer',
        'rewrite' => array('slug' => 'sports-offer'),
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_type' => 'page'
    );
    wp_insert_post($wordpress_page_template_offer);

        $sql = array();

        //gym booking table
        $gym_booking_table = $wpdb->prefix . "gym_booking";

        if( $wpdb->get_var("show tables like '". $gym_booking_table . "'") !== $gym_booking_table ) { 

        $sql[] = "CREATE TABLE ". $gym_booking_table . " (
              `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `user_id` int(11) NOT NULL,
              `g_id` int(11) NOT NULL,
              `g_startdate` date NOT NULL,
              `g_enddate` date NOT NULL,
              `g_targetgroup` varchar(50) NOT NULL,
              `g_gender` varchar(20) NOT NULL,
              `gym_parts` varchar(20) NOT NULL,
              INDEX (g_id)
            )";

        }


        $csv_download = $wpdb->prefix . "csv_download";

        if( $wpdb->get_var("show tables like '". $csv_download . "'") !== $csv_download ) { 

        $sql[] = "CREATE TABLE ". $csv_download . " (
              `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `user_id` int(11) NOT NULL,
              `file_name` varchar(20) NOT NULL,
                INDEX (user_id)
            )";

        }

        //gym booking days table
        $gym_booking_days_table = $wpdb->prefix . "gym_booking_days";
        
        if( $wpdb->get_var("show tables like '". $gym_booking_days_table . "'") !== $gym_booking_days_table ) { 

            $sql[] = "CREATE TABLE " . $gym_booking_days_table . " (
              `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `gb_id` int(11) NOT NULL,
              `gb_monday_start` varchar(20) DEFAULT NULL,
              `gb_monday_end` varchar(20) DEFAULT NULL,
              `gb_tuesday_start` varchar(20) DEFAULT NULL,
              `gb_tuesday_end` varchar(20) DEFAULT NULL,
              `gb_wednesday_start` varchar(20) DEFAULT NULL,
              `gb_wednesday_end` varchar(20) DEFAULT NULL,
              `gb_thursday_start` varchar(20) DEFAULT NULL,
              `gb_thursday_end` varchar(20) DEFAULT NULL,
              `gb_friday_start` varchar(20) DEFAULT NULL,
              `gb_friday_end` varchar(20) DEFAULT NULL,
              `gb_saturday_start` varchar(20) DEFAULT NULL,
              `gb_saturday_end` varchar(20) DEFAULT NULL,
              `gb_sunday_start` varchar(20) DEFAULT NULL,
              `gb_sunday_end` varchar(20) DEFAULT NULL,
              INDEX (gb_id)
            )"; 

        }


    if ( !empty($sql) ) {

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($sql);
        add_option("wnm_db_version", $wnm_db_version);
        
    }

}
add_filter('authenticate', 'verify_username_password', 1, 3);
function verify_username_password($user, $username, $password) {
  $referrer = strtok(@$_SERVER['HTTP_REFERER'], '?');
    if(!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')){
    $login_page = strtok($_SERVER['HTTP_REFERER'], '?');
    if ($username == "" || $password == "") {
        wp_redirect($login_page . "?login=empty");
        exit;
    }
  }
}
add_action('wp_login_failed', 'my_front_end_login_fail'); 
function my_front_end_login_fail($username){
    $referrer = strtok($_SERVER['HTTP_REFERER'], '?');
    if(!empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')){
          if(!strstr($referrer,'?login=failed'))
           {
             wp_redirect($referrer . '?login=failed'); 
           }
          else
           {
             wp_redirect($referrer); 
           }

    exit;
    }

}

//Remove "Wordpress" when receiving email 
function remove_from_wordpress($name){
$wpfrom = get_option('blogname');
return $wpfrom;
}
add_filter('wp_mail_from_name', 'remove_from_wordpress');


add_action('wp', 'wc_user_change_pwd_callback');

  function wc_user_change_pwd_callback() {

      if (isset($_POST['formType']) && wp_verify_nonce($_POST['formType'], 'changePassword')) {
          global $changePasswordError, $changePasswordSuccess;

          $user = wp_get_current_user();

          $changePasswordError = '';
          $changePasswordSuccess = '';
          $u_opwd = trim($_POST['user_opassword']);
          $u_pwd = trim($_POST['user_password']);
          $u_cpwd = trim($_POST['user_cpassword']);
         // echo '<p class="validation_message">';
          if ($u_opwd == '' || $u_pwd == '' || $u_cpwd == '') {
              $changePasswordError .= 'Enter password.,';
          }

          else if (!wp_check_password($u_opwd, $user->data->user_pass, $user->ID)) {
              $changePasswordError .= 'Old Password wrong.,';
          }

          else if ($u_pwd != $u_cpwd) {
              $changePasswordError .= 'Password are not matching.,';
          }

          else if (strlen($u_pwd) < 8) {
              $changePasswordError .= 'Password should be at least 8 characters.,';
          }
       //   echo '</p>';

          $changePasswordError = trim($changePasswordError, ',');
          $changePasswordError = str_replace(",", "<br/>", $changePasswordError);

          if (empty($changePasswordError)) {
              wp_set_password($u_pwd, $user->ID);

              wp_set_current_user($user->ID, $user->user_login);
              wp_set_auth_cookie($user->ID);
              do_action('wp_login', $user->user_login);
              $changePasswordSuccess = '<p class="success_message">Password is successfully updated.</p>';
          }
      }
  }
  
add_filter( 'page_template', 'wpa3396_page_template' );
function wpa3396_page_template( $page_template )
{
    if ( is_page( 'provider-detail' ) ) {
        $page_template = plugin_dir_path( __FILE__ ) . 'templates/single-jobs-provider.php';
    }
    return $page_template;
}

add_filter( 'page_template', 'sport_offer_page_template' );
function sport_offer_page_template( $page_template )
{
    if ( is_page( 'sports-offer' ) ) {
        $page_template = plugin_dir_path( __FILE__ ) . 'templates/single-sports-offer.php';
    }
    return $page_template;
}

add_filter( 'page_template', 'csv_export_page_template' );
function csv_export_page_template( $page_template )
{
    if ( is_page( 'csv-download' ) ) {
        $page_template = plugin_dir_path( __FILE__ ) . 'templates/single-csv-download.php';
    }
    return $page_template;
}

add_filter( 'theme_page_templates', 'wpse_288589_add_template_to_select', 10, 4 );
function wpse_288589_add_template_to_select( $post_templates, $wp_theme, $post, $post_type ) {

    // Add custom template named template-custom.php to select dropdown 
    $post_templates['template-configurator.php'] = __('Configurator');

    return $post_templates;
}


function get_ajax_customerdata() 
    {
        global $wp,$wpdb;
        global $post;
      
 
        $gymID = ($_POST['gymID']);
        $gymCustomerData = $wpdb->prefix . "gym_booking";
        $gymBookingData = $wpdb->prefix . "gym_booking_days";

                    $query_sql = $wpdb->prepare("SELECT $gymCustomerData.user_id,$gymCustomerData.g_id,$gymCustomerData.gym_parts,$gymCustomerData.g_startdate,$gymCustomerData.g_enddate, $gymBookingData.gb_monday_start,$gymBookingData.gb_monday_end,$gymBookingData.gb_tuesday_start,$gymBookingData.gb_tuesday_end,$gymBookingData.gb_wednesday_start,$gymBookingData.gb_wednesday_end,$gymBookingData.gb_thursday_start,$gymBookingData.gb_thursday_end,$gymBookingData.gb_friday_start,$gymBookingData.gb_friday_end,$gymBookingData.gb_saturday_start,$gymBookingData.gb_saturday_end,$gymBookingData.gb_sunday_start,$gymBookingData.gb_sunday_end,$gymCustomerData.g_targetgroup,$gymCustomerData.g_gender FROM $gymCustomerData JOIN $gymBookingData ON $gymBookingData.gb_id = $gymCustomerData.id WHERE $gymCustomerData.id = $gymID");
                    $data = $wpdb->get_results($query_sql);

                    foreach ($data as $getdata) 
                            {
                                $gymID = $getdata->g_id;
                                  
                                $author_obj = get_user_by('id', $getdata->user_id);
                                $customerName = $author_obj->user_login;
                                $gymName = get_the_title( $gymID );
                                $gymParts = $getdata->gym_parts;

                                $startDate = $getdata->g_startdate;
                                $endDate = $getdata->g_enddate;

                                $monStart = $getdata->gb_monday_start;
                                $monEnd = $getdata->gb_monday_end;
                                $tueStart = $getdata->gb_tuesday_start;
                                $tueEnd = $getdata->gb_tuesday_end;
                                $wedStart = $getdata->gb_wednesday_start;
                                $wedEnd = $getdata->gb_wednesday_end;
                                $thuStart = $getdata->gb_thursday_start;
                                $thuEnd = $getdata->gb_thursday_end;
                                $friStart = $getdata->gb_friday_start;
                                $friEnd = $getdata->gb_friday_end;
                                $satStart = $getdata->gb_saturday_start;
                                $satEnd = $getdata->gb_saturday_end;
                                $sunstart = $getdata->gb_sunday_start;
                                $sunEnd = $getdata->gb_sunday_start;

                                $targetgroup = $getdata->g_targetgroup;
                                $gender = $getdata->g_gender;
                                       

      ?>

        <div class="Booking-list-details">
                <p class="booking-name"><b>Customer Name : </b><?php echo  $customerName; ?> </p>
                <p class="gym-book-name"><b>Gym Name : </b><?php echo  $gymName;?></p>
                <p class="gym-book-name"><b>Gym Parts : </b><?php if($gymParts){echo  $gymParts;}else{echo "Whole GYM";}?></p>
                <div class="custom-row">
                   <div class="custom-col custom-col-md-6">
                       <p class="start-date"><b>Start-Date : </b><?php echo  $startDate; ?></p> 
                    </div> 
                    <div class="custom-col custom-col-md-6">
                       <p class="end-date"><b>End-Date : </b><?php echo  $endDate; ?></p> 
                    </div> 
                </div>
                <h2>Booking Info</h2>
                <div class="booking-listing-table responsive-table">
                  <table>
                        <tbody>
                        <tr>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        <tr>
                            <td>Monday</td>
                            <td><?php if (empty($monStart)) {
                                echo "-";
                             }echo $monStart;?></td>
                            <td><?php if(empty($monEnd)){echo "-";}echo $monEnd;?></td>
                        </tr>
                         <tr>
                            <td>Tuesday</td>
                            <td><?php if(empty($tueStart)){echo "-";}echo $tueStart; ?></td>
                            <td><?php if(empty($tueEnd)){echo "-";}echo $tueEnd; ?></td>
                        </tr>
                        <tr>
                            <td>Wednesday</td>
                            <td><?php if(empty($wedStart)){echo "-";}echo $wedStart; ?></td>
                            <td><?php if(empty($wedEnd)){echo "-";} echo $wedEnd; ?></td>
                        </tr>
                         <tr>
                            <td>Thursday</td>
                            <td><?php if(empty($thuStart)){echo "-";} echo $thuStart; ?></td>
                            <td><?php if(empty($thuEnd)){echo "-";} echo $thuEnd; ?></td>
                        </tr>
                        <tr>
                            <td>Friday</td>
                            <td><?php if(empty($friStart)){echo "-";} echo $friStart; ?></td>
                            <td><?php if(empty($friEnd)){echo "-";} echo $friEnd; ?></td>
                        </tr>
                        <tr>
                            <td>Saturday</td>
                            <td><?php if(empty($satStart)){echo "-";} echo $satStart; ?></td>
                            <td><?php if(empty($satEnd)){echo "-";} echo $satEnd; ?></td>
                        </tr>
                        <tr>
                            <td>Sunday</td>
                            <td><?php if(empty($sunstart)){echo "-";} echo $sunstart; ?></td>
                            <td><?php if(empty($sunstart)){echo "-";} echo $sunEnd; ?></td>
                        </tr>
                    </tbody>
                   </table>
                </div>
                <div class="custom-row">
                   <div class="custom-col custom-col-md-6">
                       <p class="start-date"><b>Target Group : </b><?php echo $targetgroup;?></p> 
                    </div> 
                    <div class="custom-col custom-col-md-6">
                       <p class="end-date"><b>Gender : </b><?php echo $gender;?></p> 
                    </div> 
                </div>
            </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
            
<?php
}
die();
}

?>
