<?php

if (!class_exists('Clubs')) {
    class Clubs extends WEOC_post_types_parent2 {
        public $cpt_name = "Club";
        public $cpt_id = "caucasus-barometer";
        public $cpt_id1 = "caucasus-barometer";
        public $cpt_id2 = "caucasus-barometer";
        public $cpt_dashicon = "dashicons-dashboard";
        public $taxonomy = "SportClube";
        public $taxonomy_url = "SportClube";

        public $taxonomy1 = "Trainers";
        public $taxonomy_url1 = "Trainers";
        public $taxonomy2 = "Gym";
        public $taxonomy_url2 = "Gym";
public function __construct(){


    $taxonomy= "Trainer";
    $taxonomy_url = "Trainer";

    $this->meta_boxes = array(
    );
    $this->cpt_init();

    add_action('init', array($this, 'add_taxonomy'));
    // add_action( 'init', 'wpdocs_register_private_taxonomy', 0 );
    add_shortcode( 'ClubRegister', array($this,'Register_shortcode') );
    add_shortcode( 'ClubLogin', array($this,'login_shortcode') );
    add_shortcode( 'ClubChangePassword', array($this,'change_password_shortcode') );
    add_shortcode( 'club_manage_data', array($this,'club_manage_data') );
   // add_shortcode( 'jobsfrontend', array($this,'jobs') );
   // add_shortcode( 'JobListing', array($this,'job-listing') );
    add_shortcode( 'HomeSearch', array($this,'home_search_shortcode') );
    add_shortcode( 'gymownerbooking', array($this,'gymownerbooking') );


}

function change_password_shortcode() {
      ob_start();
      if (is_user_logged_in()) {
        echo "<div><h3>Change Password</h3></div>";

          global $changePasswordError, $changePasswordSuccess;

          if (!empty($changePasswordError)) {
              ?>
              <p class="alert alert-danger validation_message">
                  <?php echo $changePasswordError; ?>
              </p>
          <?php } ?>

          <?php if (!empty($changePasswordSuccess)) { ?>
                  <?php echo $changePasswordSuccess; ?>
          <?php } ?>

          <form method="post" class="wc-change-pwd-form">

              <div class="change_pwd_form">
                  

                  <div class="log_pass">
                      <label for="user_oldpassword">Old Password</label>
                      <input type="password" name="user_opassword" id="user_oldpassword" />
                  </div>

                  <div class="log_pass">
                      <label for="user_password">New Password</label>
                      <input type="password" name="user_password" id="user_password" />
                  </div>

                  <div class="log_pass">
                      <label for="user_cpassword">Confirm Password</label>
                      <input type="password" name="user_cpassword" id="user_cpassword" />
                  </div>

                  <div class="log_pass">
                      <?php
                      ob_start();
                      do_action('password_reset');
                      echo ob_get_clean();
                      ?>
                  </div>

                  <div class="log_user">
                      <?php wp_nonce_field('changePassword', 'formType'); ?>
                      <!-- <button type="submit" class="register_user button">Submit</button> -->
                      <input type="submit" name="Submit" value="Submit" class="register_user button">
                  </div>

              </div>
          </form>
          <?php
      }
      else{
        $link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }
      $change_pwd_form = ob_get_clean();
      return $change_pwd_form;
  }
function registration_validation( $username, $email, $password )  {
    global $reg_errors;
    $reg_errors = new WP_Error;
    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Required form field is missing.');
    }
    else if(is_numeric($username)){
    	$reg_errors->add('user_name', 'Name should contain only letters.');
    }   
    // else if ( username_exists( $username ) )
    // $reg_errors->add('user_name', 'Sorry, that username already exists.');
    else if ( !empty( $email ) && !is_email( $email ) ) {
        $reg_errors->add( 'email_invalid', 'Email is not valid.' );
    }
    else if ( email_exists( $email ) ) {
        $reg_errors->add( 'email', 'Email already exist.' );
    }
    else if (strlen( $password ) < 8 ){
		$reg_errors->add( 'field', 'Password should be at least 8 characters.' );
	}
    if ( is_wp_error( $reg_errors ) ) {
      $errMsg ='';
        foreach ( $reg_errors->get_error_messages() as $error ) {
            $errMsg .= '<p class="validation_message">'.$error.'</p>';   
        }
        return $errMsg;
    }
}





function Register_shortcode() 
{
  if (!is_user_logged_in()){
   $field =  '<div><h3>Register</h3></div>';
   if ( isset($_POST['submit'] ) ) {
        $field .= $this->registration_validation(
            $_POST['username'],
            $_POST['email'],
            $_POST['password']
        );
         
        // sanitize user form input
        global $username, $email, $password;
        $username   =   sanitize_user( $_POST['username'] );
        $email      =   sanitize_email( $_POST['email'] );
        $password   =   esc_attr( $_POST['password'] );
        // $login   =   sanitize_text_field( $_POST['login'] );
 
        // call @function complete_registration to create the user
        // only when no WP_error is found
        global $reg_errors, $username, $email, $password,$wpdb;
    $url = site_url();
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $email,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'user_url'      =>   $url,
        'first_name'    =>   $username,
       // 'last_name'     =>   $username,
        'nickname'      =>   $username,
        'description'   =>   'club',
        'role'   =>   'club',
        );
        $user = wp_insert_user( $userdata );
        /*if($user){
          $user_login = $userdata['user_login'];
              wp_set_current_user($user, $user_login);
              wp_set_auth_cookie( $user );
              do_action('wp_login', $user_login);
        }*/
        $_POST = '';
        $field .= '<p class="success_message">Registration complete. Please log in.</p>';   
    }
    }
    $field .= '
    <form class = "registration_form" action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    
    <div>
    <label for="username">Name <strong>*</strong></label>
    <input type="text" name="username" >
    </div>
     
    <div>
    <label for="email">Email <strong>*</strong></label>
    <input type="text" name="email" >
    </div>

    <div>
    <label for="password">Password <strong>*</strong></label>
    <input type="password" name="password" >
    </div>

    <input type="submit" name="submit" value="Register"/>
    </form>
    ';
    return $field;
  }else{
  }
    
}
function login_shortcode() {
    if (is_user_logged_in()){
        global $wpdb;
         $url = site_url();
    $user = wp_get_current_user();
    $loginContent = '<div id="content" class="content" role="main">';

    $loginContent .= "Hi <span>".$user->user_nicename."</span>";

      $loginContent .=  '<div class="collapse navbar-collapse" id="navbarsExample02">
                <form class="form-inline my-2 my-md-0"> </form>
            </div>
        </nav>
        <div id="wrapper" class="toggled">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
            <ul>
    <!-- <li>
        <pre></pre>
        <h5><a href="#"></a></h5> </li> -->
    <li> <a href="' .esc_url( get_page_link( get_option('club_dashboard_link') ) ).'">Dashboard</a> </li>
    <li> <a href="' .esc_url( get_page_link( get_option('trainer_link') ) ).'">Add Trainer</a></li>
    <li> <a href="' .esc_url( get_page_link( get_option('manage_club_link') ) ).'">Change Data of Club
        </a> </li>
    <li> <a href="' .esc_url( get_page_link( get_option('change_password_link') ) ).'">Change Password
        </a> </li>
    <li> <a href="' .esc_url( get_page_link( get_option('courses_link') ) ).'">Manage Courses
        </a> </li>
    <li> <a href="' .esc_url( get_page_link( get_option('gym_link') ) ).'">Manage Gym
        </a> </li>
    <li> <a href="' .esc_url( get_page_link( get_option('jobs_link') ) ).'">Manage Jobs
        </a> </li>
    <li> <a href="' .esc_url( get_page_link( get_option('csv_link') ) ).'">CSV Download
        </a> </li>
    <li> <a href="' .esc_url( get_page_link( get_option('gym_booking_link') ) ).'">Gym Booking
        </a> </li>
        <li><a href="'.wp_logout_url( get_permalink() ).'">Logout
        </a></li></li>
</ul>
            </div> <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                </div>
            </div> <!-- /#page-content-wrapper -->
        </div> <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->  
    </div>
        </html>'; ?>
        <?php
        return $loginContent;
    
      // $link = get_permalink().'/clubaccount/';
      // echo "<script>window.location = '".$link."'</script>";
    } else{   
    $logintext =  "<div><h3>Login</h3></div>";
       $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
       if ($login === "failed") {
            $logintext.= '<p class="validation_message">Invalid email or password.</p>';
        } elseif ($login === "empty") {
            $logintext .= '<p class="validation_message">Email or Password is missing.</p>';
        } elseif ($login === "false") {
            $logintext.= '<p class="success_message"> You are logged out now.</p>';
        }    

         $logintext .= wp_login_form( 
                        array( 
                            'echo' => false ,
                            'label_username' => __( 'Email ' ),
                            'label_password' => __( 'Password' ),
                            'label_remember' => __( 'Remember Me' ),
                            'redirect'       => site_url('/clubaccount'),
                            'id_submit'      => 'wp-submit',
                      )
        ); 
         return $logintext;
     }
        
}
}
}

new Clubs;











