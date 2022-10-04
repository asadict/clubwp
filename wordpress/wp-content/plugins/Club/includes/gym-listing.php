<?php
function gym_listing(){
if (is_user_logged_in()) {
    $current_user_id = get_current_user_id();  
    global $wp,$wpdb;
    $gymCustomerData = $wpdb->prefix . "gym_booking";
    $gymBookingData = $wpdb->prefix . "gym_booking_days";


    $id = get_the_ID();
    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $protocol = 'https://';
    } else {
        $protocol = 'http://';
    }
    $current_url=$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $addform = get_permalink().'?addgym';
    $link = get_permalink();
    if(isset($_POST['gym-submit']))
    {
        // Create post object
        $my_post = array();
        $my_post['post_title']    = $_POST['gym_name'];
        $my_post['post_content']  = $_POST['gym_description'];
        $my_post['post_status']   = 'publish';
        $my_post['post_type'] = 'clubgym';
        $my_post['post_category'] = array(0);
        // Insert the post into the database
        $post_id = wp_insert_post( $my_post );
        if($_FILES['image']['name']){
           $upload = wp_upload_bits($_FILES["image"]["name"], null, file_get_contents($_FILES["image"]["tmp_name"]));   
            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
 
            $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id);

            if ( ! is_wp_error( $attachment_id ) ) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
 
                $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
                wp_update_attachment_metadata( $attachment_id, $attachment_data );
                set_post_thumbnail( $post_id, $attachment_id );
            }
         
        }
        echo "<script>window.location = '".$link."'</script>";   
}
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        $current_url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
        $deletepost = get_permalink().'?delete_id='.$delete_id;
        if($current_url == $deletepost){ 
            wp_delete_post( $delete_id);
            $gymDelete = $wpdb->query("DELETE $gymCustomerData,$gymBookingData FROM $gymCustomerData INNER JOIN $gymBookingData ON $gymBookingData.gb_id = $gymCustomerData.id WHERE $gymCustomerData.g_id = $delete_id");

            echo "<script>window.location = '".$link."'</script>";
        }
    }

    if(isset($_GET['edit_id'])){
        $edit_id = $_GET['edit_id'];
        $editform = get_permalink().'?edit_id='.$edit_id;

        if(isset($_POST['gym-edit'])){
            $post_update = array(
                    'ID'         => $edit_id,
                    'post_title' => $_POST['gym_name'],
                    'post_content' => $_POST['gym_description'],
                  );
                wp_update_post( $post_update );
    if (array_key_exists('gym_hide', $_POST)) {
        update_post_meta($edit_id, 'gym_hide', $_POST['gym_hide']);
    }else{
         update_post_meta($edit_id, 'gym_hide', 0);
    }
    if (array_key_exists('gym_show_timetable', $_POST)) {
        update_post_meta($edit_id, 'gym_show_timetable', $_POST['gym_show_timetable']);
    }else{
         update_post_meta($edit_id, 'gym_show_timetable', 0);
    }
    if (array_key_exists('gym_sport_facility', $_POST)) {
        update_post_meta($edit_id, 'gym_sport_facility', $_POST['gym_sport_facility']);
    }
    if (array_key_exists('gym_parts', $_POST)) {
        update_post_meta($edit_id, 'gym_parts', $_POST['gym_parts']);
    }
    if (array_key_exists('gym_district', $_POST)) {
        update_post_meta($edit_id, 'gym_district', $_POST['gym_district']);
    }
    if (array_key_exists('gym_surname', $_POST)) {
        update_post_meta($edit_id, 'gym_surname', $_POST['gym_surname']);
    }
    if (array_key_exists('gym_street', $_POST)) {
        update_post_meta($edit_id, 'gym_street', $_POST['gym_street']);
    }
    if (array_key_exists('gym_postcode', $_POST)) {
        update_post_meta($edit_id, 'gym_postcode', $_POST['gym_postcode']);
    }
    if (array_key_exists('gym_city', $_POST)) {
        update_post_meta($edit_id, 'gym_city', $_POST['gym_city']);
    }
    if (array_key_exists('gym_latitude', $_POST)) {
        update_post_meta($edit_id, 'gym_latitude', $_POST['gym_latitude']);
    }
    if (array_key_exists('gym_longitude', $_POST)) {
        update_post_meta($edit_id, 'gym_longitude', $_POST['gym_longitude']);
    }
    if (array_key_exists('gym_monday_to', $_POST)) {
        update_post_meta($edit_id, 'gym_monday_to', $_POST['gym_monday_to']);
    }
    if (array_key_exists('gym_monday_from', $_POST)) {
        update_post_meta($edit_id, 'gym_monday_from', $_POST['gym_monday_from']);
    }
    if (array_key_exists('gym_tuesday_to', $_POST)) {
        update_post_meta($edit_id, 'gym_tuesday_to', $_POST['gym_tuesday_to']);
    }
    if (array_key_exists('gym_tuesday_from', $_POST)) {
        update_post_meta($edit_id, 'gym_tuesday_from', $_POST['gym_tuesday_from']);
    }
    if (array_key_exists('gym_wednesday_to', $_POST)) {
        update_post_meta($edit_id, 'gym_wednesday_to', $_POST['gym_wednesday_to']);
    }
    if (array_key_exists('gym_wednesday_from', $_POST)) {
        update_post_meta($edit_id, 'gym_wednesday_from', $_POST['gym_wednesday_from']);
    }
    if (array_key_exists('gym_thursday_to', $_POST)) {
        update_post_meta($edit_id, 'gym_thursday_to', $_POST['gym_thursday_to']);
    }
    if (array_key_exists('gym_thursday_from', $_POST)) {
        update_post_meta($edit_id, 'gym_thursday_from', $_POST['gym_thursday_from']);
    }
    if (array_key_exists('gym_friday_to', $_POST)) {
        update_post_meta($edit_id, 'gym_friday_to', $_POST['gym_friday_to']);
    }
    if (array_key_exists('gym_friday_from', $_POST)) {
        update_post_meta($edit_id, 'gym_friday_from', $_POST['gym_friday_from']);
    }
    if (array_key_exists('gym_saturday_to', $_POST)) {
        update_post_meta($edit_id, 'gym_saturday_to', $_POST['gym_saturday_to']);
    }
    if (array_key_exists('gym_saturday_from', $_POST)) {
        update_post_meta($edit_id, 'gym_saturday_from', $_POST['gym_saturday_from']);
    }
    if (array_key_exists('gym_sunday_to', $_POST)) {
        update_post_meta($edit_id, 'gym_sunday_to', $_POST['gym_sunday_to']);
    }
    if (array_key_exists('gym_sunday_from', $_POST)) {
        update_post_meta($edit_id, 'gym_sunday_from', $_POST['gym_sunday_from']);
    }
    if (array_key_exists('gym_club_school', $_POST)) {
        update_post_meta($edit_id, 'gym_club_school', $_POST['gym_club_school']);
    }
    if (array_key_exists('gym_contact_name', $_POST)) {
        update_post_meta($edit_id, 'gym_contact_name', $_POST['gym_contact_name']);
    }
    if (array_key_exists('gym_mail', $_POST)) {
        update_post_meta($edit_id, 'gym_mail', $_POST['gym_mail']);
    }
    if (array_key_exists('gym_address', $_POST)) {
        update_post_meta($edit_id, 'gym_address', $_POST['gym_address']);
    }
    if (array_key_exists('gym_phone', $_POST)) {
        update_post_meta($edit_id, 'gym_phone', $_POST['gym_phone']);
    }
    if (array_key_exists('gym_fax', $_POST)) {
        update_post_meta($edit_id, 'gym_fax', $_POST['gym_fax']);
    }
    if (array_key_exists('gym_home_page', $_POST)) {
        update_post_meta($edit_id, 'gym_home_page', $_POST['gym_home_page']);
    }
    if (array_key_exists('gym_barrier_free', $_POST)) {
        update_post_meta($edit_id, 'gym_barrier_free', $_POST['gym_barrier_free']);
    }
    if (array_key_exists('gym_shower', $_POST)) {
        update_post_meta($edit_id, 'gym_shower', $_POST['gym_shower']);
    }
    if (array_key_exists('gym_toilets', $_POST)) {
        update_post_meta($edit_id, 'gym_toilets', $_POST['gym_toilets']);
    }
    if (array_key_exists('gym_gastranomy', $_POST)) {
        update_post_meta($edit_id, 'gym_gastranomy', $_POST['gym_gastranomy']);
    }
    if (array_key_exists('gym_chargeble', $_POST)) {
        update_post_meta($edit_id, 'gym_chargeble', $_POST['gym_chargeble']);
    }
    if (array_key_exists('gym_outdoor', $_POST)) {
        update_post_meta($edit_id, 'gym_outdoor', $_POST['gym_outdoor']);
    }
    if (array_key_exists('gym_start_time', $_POST)) {
        update_post_meta($edit_id, 'gym_start_time', $_POST['gym_start_time']);
    }
    if (array_key_exists('gym_frequency', $_POST)) {
        update_post_meta($edit_id, 'gym_frequency', $_POST['gym_frequency']);
    }
    echo "<script>window.location = '".$link."'</script>";
}
   
        if($current_url == $editform){ 
            global $post;
            $gym_name = get_post_meta($edit_id,'gym_name', true);
            $gym_surname = get_post_meta($edit_id,'gym_surname', true);
            $gym_hide = get_post_meta($edit_id, 'gym_hide', true);
            $gym_show_timetable = get_post_meta($edit_id, 'gym_show_timetable', true);
            $gym_sport_facility = get_post_meta($edit_id,'gym_sport_facility', true);
            $gym_parts = get_post_meta($edit_id,'gym_parts', true);
            $gym_description = get_post_meta($edit_id,'gym_description', true);
            $gym_district = get_post_meta($edit_id,'gym_district', true);
            $gym_street = get_post_meta($edit_id,'gym_street', true);
            $gym_postcode = get_post_meta($edit_id,'gym_postcode', true);
            $gym_city = get_post_meta($edit_id,'gym_city', true);
            $gym_latitude = get_post_meta($edit_id,'gym_latitude', true);
            $gym_longitude = get_post_meta($edit_id,'gym_longitude', true);
            $gym_monday_to = get_post_meta($edit_id,'gym_monday_to', true);
            $gym_monday_from = get_post_meta($edit_id,'gym_monday_from', true);
            $gym_tuesday_to = get_post_meta($edit_id,'gym_tuesday_to', true);
            $gym_tuesday_from = get_post_meta($edit_id,'gym_tuesday_from', true);
            $gym_wednesday_to = get_post_meta($edit_id,'gym_wednesday_to', true);
            $gym_wednesday_from = get_post_meta($edit_id,'gym_wednesday_from', true);
            $gym_thursday_to = get_post_meta($edit_id,'gym_thursday_to', true);
            $gym_thursday_from = get_post_meta($edit_id,'gym_thursday_from', true);
            $gym_friday_to = get_post_meta($edit_id,'gym_friday_to', true);
            $gym_friday_from = get_post_meta($edit_id,'gym_friday_from', true);
            $gym_saturday_to = get_post_meta($edit_id,'gym_saturday_to', true);
            $gym_saturday_from = get_post_meta($edit_id,'gym_saturday_from', true);
            $gym_sunday_to = get_post_meta($edit_id,'gym_sunday_to', true);
            $gym_sunday_from = get_post_meta($edit_id,'gym_sunday_from', true);
            $gym_club_school = get_post_meta($edit_id,'gym_club_school', true);
            $gym_contact_name = get_post_meta($edit_id,'gym_contact_name', true);
            $gym_mail = get_post_meta($edit_id,'gym_mail', true);
            $gym_address = get_post_meta($edit_id,'gym_address', true);
            $gym_phone = get_post_meta($edit_id,'gym_phone', true);
            $gym_fax = get_post_meta($edit_id,'gym_fax', true);
            $gym_home_page = get_post_meta($edit_id,'gym_home_page', true);
            $gym_barrier_free = get_post_meta($edit_id,'gym_barrier_free', true);
            $gym_shower = get_post_meta($edit_id,'gym_shower', true);
            $gym_toilets = get_post_meta($edit_id,'gym_toilets', true);
            $gym_gastranomy = get_post_meta($edit_id,'gym_gastranomy', true);
            $gym_chargeble = get_post_meta($edit_id,'gym_chargeble', true);
            $gym_outdoor = get_post_meta($edit_id,'gym_outdoor', true);
            $url = wp_get_attachment_url( get_post_thumbnail_id($edit_id), 'thumbnail' );
            $gym_start_time =get_post_meta($edit_id,'gym_start_time', true);
	        $gym_frequency = get_post_meta($edit_id, 'gym_frequency', true);
?>
        <form method="post" enctype="multipart/form-data" name="gym_edit_form">
            <div class="manage-data-section gym-form-edit">
                <div class="manage-data-form-main custom-row">
                    <h4 class="form-title">Create GYM</h4>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <input type="checkbox" name="gym_hide" class="custom-form-control" value="1" <?php if ($gym_hide == 1) {echo "checked";}?>>
                            <?php //esc_attr_e( 'Hide', 'mytheme' ); ?>
                            <label for="gym_hide"><?php _e('Hidden'); ?></label>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <input type="checkbox" name="gym_show_timetable" class="custom-form-control" value="1" <?php if ($gym_show_timetable == 1) {echo "checked";} else{echo ""; } ?>>
                            <?php //esc_attr_e( 'Hide', 'mytheme' ); ?>
                            <label for="gym_show_timetable"><?php _e('Show In Time Table'); ?></label>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Name'); ?></label><span>*</span>
                            <input type="text" name="gym_name" class="custom-form-control" value="<?php echo get_the_title($edit_id); ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_surname"><?php _e('Surname'); ?></label>
                            <input type="text" name="gym_surname" class="custom-form-control" value="<?php echo $gym_surname; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_sport_facility"><?php _e('GYM Parts'); ?></label>
                            <select name="gym_parts" id="gym_parts" class="custom-form-control">
                                <option value="1" <?php selected( $gym_parts, '1' ); ?>>1</option>
                                <option value="2" <?php selected( $gym_parts, '2' ); ?>>2</option>
                                <option value="3" <?php selected( $gym_parts, '3' ); ?>>3</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_sport_facility"><?php _e('Sport Facility'); ?></label>
                            <select name="gym_sport_facility" id="gym_sport_facility" class="custom-form-control">
                                <option value="">Select sport facility</option>
                                <option value="Swiming" <?php selected( $gym_sport_facility, 'Swiming' ); ?>>swiming</option>
                                <option value="Bath" <?php selected( $gym_sport_facility, 'Bath' ); ?>>bath</option>
                                <option value="Gym" <?php selected( $gym_sport_facility, 'Gym' ); ?>>gym</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col gym-image">
                        <div class="custom-form-group">
                            <?php if($url){ ?>
                            <img src="<?php echo $url; ?>" /><br>
                        <?php } ?>
                            <label for="address"><?php _e('Image'); ?></label> 
                                <input type="file" name="image"> 
                        </div> 
                    </div>
                    <h4 class="form-title">Description</h4>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Description'); ?></label>
                            <textarea name="gym_description" id="gym_description" rows="5" cols="40" ><?php echo get_post_field('post_content', $edit_id); ?></textarea>
                        </div> 
                    </div>
                    <h4 class="form-title">Address</h4>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_sport_facility"><?php _e('District'); ?></label>
                            <select name="gym_district" id="gym_district" class="custom-form-control">
                                <option value="">Select district</option>
                                <option value="district_1" <?php selected( $gym_district, 'district_1' ); ?>>District 1</option>
                                <option value="district_2" <?php selected( $gym_district, 'district_2' ); ?>>District 2</option>
                                <option value="district_3" <?php selected( $gym_district, 'district_3' ); ?>>District 3</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="profile-email"><?php _e('Street / Number'); ?></label>
                            <input type="text" name="gym_street" class="custom-form-control" value="<?php echo $gym_street; ?>">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="phone"><?php _e('Post Code'); ?></label><span>*</span>
                            <input type="number" name="gym_postcode" class="custom-form-control" value="<?php echo $gym_postcode; ?>" oninput="validity.valid||(value='');" onKeyPress="if(this.value.length==5) return false;" min="0">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="mobile"><?php _e('City'); ?></label><span>*</span>
                            <input type="text" name="gym_city" class="custom-form-control" value="<?php echo $gym_city; ?>">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="fax"><?php _e('Latitude'); ?></label>
                            <input type="text" name="gym_latitude" class="custom-form-control" value="<?php echo $gym_latitude; ?>" maxlength="50">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="home-page"><?php _e('Longitude'); ?></label>
                            <input type="text" name="gym_longitude" class="custom-form-control" value="<?php echo $gym_longitude; ?>" maxlength="50">
                        </div> 
                    </div>
                    <h4 class="form-title">Opening Times</h4>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Monday'); ?></label></br>
                            from<input type="text" id="gym_monday_from"  class="custom-form-control custom-job-time"  name="gym_monday_from" value="<?php echo $gym_monday_from;?>"  >clock &nbsp;
                            to<input type="text" id="gym_monday_to" name="gym_monday_to" class="custom-form-control custom-job-time" value="<?php echo $gym_monday_to; ?>" >clock
                            <div id="monday_error"></div> 
                        </div>
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Tuesday'); ?></label></br>
                            from<input type="text" id="gym_tuesday_from" name="gym_tuesday_from" class="custom-form-control" value="<?php echo $gym_tuesday_from; ?>" >clock &nbsp;
                            to<input type="text" id="gym_tuesday_to" name="gym_tuesday_to" class="custom-form-control" value="<?php echo $gym_tuesday_to; ?>" >clock
                            <div id="tuesday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Wednesday'); ?></label></br>
                            from<input type="text" id="gym_wednesday_from" name="gym_wednesday_from" class="custom-form-control" value="<?php echo $gym_wednesday_from; ?>" >clock &nbsp;
                            to<input type="text" id="gym_wednesday_to" name="gym_wednesday_to" class="custom-form-control" value="<?php echo $gym_wednesday_to; ?>" >clock
                            <div id="wednesday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Thursday'); ?></label></br>
                            from<input type="text" id="gym_thursday_from" name="gym_thursday_from" class="custom-form-control" value="<?php echo $gym_thursday_from; ?>" >clock &nbsp;
                            to<input type="text" id="gym_thursday_to" name="gym_thursday_to" class="custom-form-control" value="<?php echo $gym_thursday_to; ?>" >clock
                            <div id="thursday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Friday'); ?></label></br>
                            from<input type="text" id="gym_friday_from" name="gym_friday_from" class="custom-form-control" value="<?php echo $gym_friday_from; ?>" >clock &nbsp;
                            to<input type="text" id="gym_friday_to" name="gym_friday_to" class="custom-form-control" value="<?php echo $gym_friday_to; ?>" >clock
                            <div id="friday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Saturday'); ?></label></br>
                            from<input type="text" id="gym_saturday_from" name="gym_saturday_from" class="custom-form-control" value="<?php echo $gym_saturday_from; ?>" >clock &nbsp;
                            to<input type="text" id="gym_saturday_to" name="gym_saturday_to" class="custom-form-control" value="<?php echo $gym_saturday_to; ?>">clock
                            <div id="saturday_error"></div>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Sunday'); ?></label></br>
                            from<input type="text" id="gym_sunday_from" name="gym_sunday_from" class="custom-form-control" value="<?php echo $gym_sunday_from; ?>">clock &nbsp;
                            to<input type="text" id="gym_sunday_to" name="gym_sunday_to" class="custom-form-control" value="<?php echo $gym_sunday_to; ?>" >clock
                            <div id="sunday_error"></div> 
                        </div> 
                    </div>
                    <h4 class="form-title">Conatct Person</h4>
                    <div class="custom-col custom-col-lg-12">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Sports Club / School?'); ?></label> 
                           <select name="gym_club_school" id="gym_club_school" class="custom-form-control">
                                <option value="">Select club/school</option>
                                <option value="abc" <?php selected( $gym_district, 'abc' ); ?>>abc</option>
                                <option value="xyz" <?php selected( $gym_district, 'xyz' ); ?>>xyz</option>
                                <option value="abcd" <?php selected( $gym_district, 'abcd' ); ?>>abcd</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Contact Person Name'); ?></label>
                            <input type="text" name="gym_contact_name" class="custom-form-control" value="<?php echo $gym_contact_name; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Mail'); ?></label>
                            <input type="text" name="gym_mail" class="custom-form-control" value="<?php echo $gym_mail; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Address'); ?></label><span>*</span>
                            <input type="text" name="gym_address" class="custom-form-control" value="<?php echo $gym_address; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Phone'); ?></label>
                            <input type="text" name="gym_phone" oninput="validity.valid||(value='');" class="custom-form-control" value="<?php echo $gym_phone; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Fax'); ?></label>
                            <input type="text" name="gym_fax" oninput="validity.valid||(value='');" class="custom-form-control" value="<?php echo $gym_fax; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Home Page'); ?></label>
                            <input type="text" name="gym_home_page" class="custom-form-control" value="<?php echo $gym_home_page; ?>">
                        </div> 
                    </div>
                    <h4 class="form-title">Details</h4>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Accessible?'); ?></label> 
                            <select name="gym_barrier_free" id="gym_barrier_free" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="Yes" <?php selected( $gym_barrier_free, 'Yes' ); ?>>Yes</option>
                                <option value="No" <?php selected( $gym_barrier_free, 'No' ); ?>>No</option>
                                <option value="No Answer" <?php selected( $gym_barrier_free, 'No Answer' ); ?>>No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Is there a shower?'); ?></label> 
                            <select name="gym_shower" id="gym_shower" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" <?php selected( $gym_shower, 'yes' ); ?>>Yes</option>
                                <option value="no" <?php selected( $gym_shower, 'no' ); ?>>No</option>
                                <option value="no_answer" <?php selected( $gym_shower, 'no_answer' ); ?>>No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Is there a toilet?'); ?></label> 
                            <select name="gym_toilets" id="gym_toilets" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" <?php selected( $gym_toilets, 'yes' ); ?>>Yes</option>
                                <option value="no" <?php selected( $gym_toilets, 'no' ); ?>>No</option>
                                <option value="no_answer" <?php selected( $gym_toilets, 'no_answer' ); ?>>No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Is there a possibility of catering?'); ?></label> 
                            <select name="gym_gastranomy" id="gym_gastranomy" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" <?php selected( $gym_gastranomy, 'yes' ); ?>>Yes</option>
                                <option value="no" <?php selected( $gym_gastranomy, 'no' ); ?>>No</option>
                                <option value="no_answer" <?php selected( $gym_gastranomy, 'no_answer' ); ?>>No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Does the sports facility have to be paid for?'); ?></label> 
                            <select name="gym_chargeble" id="gym_chargeble" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" <?php selected( $gym_chargeble, 'yes' ); ?>>Yes</option>
                                <option value="no" <?php selected( $gym_chargeble, 'no' ); ?>>No</option>
                                <option value="no_answer" <?php selected( $gym_chargeble, 'no_answer' ); ?>>No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Is it an indoor or an outdoor location?'); ?></label> 
                            <select name="gym_outdoor" id="gym_outdoor" class="custom-form-control">
                                <option value="">Select</option>
                              <option value="Indoor" <?php selected( $gym_outdoor, 'Indoor' ); ?>>Indoor</option>
                              <option value="Outdoor" <?php selected( $gym_outdoor, 'Outdoor' ); ?>>Outdoor</option>
                              <option value="Both" <?php selected( $gym_outdoor, 'Both' ); ?>>Both</option>
                            </select>
                        </div> 
                    </div>

                    <div class="custom-col custom-col-md-12">
                        <div class="custom-form-group abort-button">
                            <input type="submit" name="gym-edit" value="Save" id="save">
                            <a href="<?php the_permalink(); ?>" class="button">Abort</a>
                        </div> 
                    </div>
                </div>         
            </div>
        </form>
       <?php }
    }else if($current_url == $addform){ ?>
        <form method="post" enctype="multipart/form-data" name="gym_add_form">
            <div class="manage-data-section gym-form-add">
                <div class="manage-data-form-main custom-row">
                    <h4 class="form-title">Create GYM</h4>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <input type="checkbox" name="gym_hide" class="custom-form-control" value="1">
                            <label for="gym_hide"><?php _e('Hidden'); ?></label>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <input type="checkbox" name="gym_show_timetable" class="custom-form-control" value="1">
                            <?php //esc_attr_e( 'Hide', 'mytheme' ); ?>
                            <label for="gym_show_timetable"><?php _e('Show In Time Table'); ?></label>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Name'); ?></label><span>*</span>
                            <input type="text" name="gym_name" class="custom-form-control">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_surname"><?php _e('Surname'); ?></label>
                            <input type="text" name="gym_surname" class="custom-form-control">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_sport_facility"><?php _e('GYM Parts'); ?></label>
                            <select name="gym_parts" id="gym_parts" class="custom-form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div> 
                    </div>
                     <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_sport_facility"><?php _e('Sport Facility'); ?></label>
                            <select name="gym_sport_facility" id="gym_sport_facility" class="custom-form-control">
                                <option value="">Select sport facility </option>
                              <option value="Swiming">Swiming</option>
                              <option value="Bath">Bath</option>
                              <option value="Gym">Gym</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col gym-image">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Image'); ?></label> 
                                <input type="file" name="image"> 
                        </div> 
                    </div>
                    <h4 class="form-title">Description</h4>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Description'); ?></label>
                            <textarea name="gym_description" id="gym_description" rows="5" cols="40" ></textarea>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_sport_facility"><?php _e('District'); ?></label>
                            <select name="gym_district" id="gym_district" class="custom-form-control">
                                <option value="">Select district</option>
                              <option value="district_1">District 1</option>
                              <option value="district_2">District 2</option>
                              <option value="district_3">District 3</option>
                            </select>
                        </div> 
                    </div>

                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="profile-email"><?php _e('Street / Number'); ?></label>
                            <input type="text" name="gym_street" class="custom-form-control">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="phone"><?php _e('Post Code'); ?></label><span>*</span>
                            <input type="number" name="gym_postcode" class="custom-form-control" oninput="validity.valid||(value='');" onKeyPress="if(this.value.length==5) return false;" min="0">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="mobile"><?php _e('City'); ?></label><span>*</span>
                            <input type="text" name="gym_city" class="custom-form-control">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="fax"><?php _e('Latitude'); ?></label>
                            <input type="text" name="gym_latitude" class="custom-form-control" maxlength="50">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="home-page"><?php _e('Longitude'); ?></label>
                            <input type="text" name="gym_longitude" class="custom-form-control" maxlength="50">
                        </div> 
                    </div>
                    <h4 class="form-title">Opening Time</h4>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Monday'); ?></label></br>
                            from<input type="text" id="gym_monday_from" class="custom-form-control custom-job-time" name="gym_monday_from" >clock &nbsp;
                            to<input type="text" id="gym_monday_to" name="gym_monday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                         
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Tuesday'); ?></label></br>
                            from<input type="text" id="gym_tuesday_from" name="gym_tuesday_from"  >clock &nbsp;
                            to<input type="text" id="gym_tuesday_to" name="gym_tuesday_to">clock
                            <div id="tuesday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Wednesday'); ?></label></br>
                            from<input type="text" id="gym_wednesday_from" name="gym_wednesday_from" >clock &nbsp;
                            to<input type="text" id="gym_wednesday_to" name="gym_wednesday_to" >clock
                            <div id="wednesday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Thursday'); ?></label></br>
                            from<input type="text" id="gym_thursday_from" name="gym_thursday_from" >clock &nbsp;
                            to<input type="text" id="gym_thursday_to" name="gym_thursday_to">clock
                            <div id="thursday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Friday'); ?></label></br>
                            from<input type="text" id="gym_friday_from" name="gym_friday_from" >clock &nbsp;
                            to<input type="text" id="gym_friday_to" name="gym_friday_to" >clock
                            <div id="friday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Saturday'); ?></label></br>
                            from<input type="text" id="gym_saturday_from" name="gym_saturday_from" >clock &nbsp;
                            to<input type="text" id="gym_saturday_to" name="gym_saturday_to" >clock
                            <div id="saturday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Sunday'); ?></label></br>
                            from<input type="text" id="gym_sunday_from" name="gym_sunday_from" >clock &nbsp;
                            to<input type="text" id="gym_sunday_to" name="gym_sunday_to" >clock
                            <div id="sunday_error"></div> 
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-12">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Sports Club / School?'); ?></label> 
                           <select name="gym_club_school" id="gym_club_school" class="custom-form-control">
                            <option value="">Select club/school</option>
                                <option value="abc">abc</option>
                                <option value="xyz">xyz</option>
                                <option value="abcd">abcd</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Contact Person Name'); ?></label>
                            <input type="text" name="gym_contact_name" class="custom-form-control">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Mail'); ?></label>
                            <input type="text" name="gym_mail" >
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Address'); ?></label><span>*</span>
                            <input type="text" name="gym_address" >
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Phone'); ?></label>
                            <input type="text" oninput="validity.valid||(value='');" name="gym_phone">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Fax'); ?></label>
                            <input type="text" oninput="validity.valid||(value='');" name="gym_fax">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="gym_name"><?php _e('Home Page'); ?></label>
                            <input type="text" name="gym_home_page" >
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Frequency'); ?></label>
                            <select name="gym_frequency" id="gym_frequency">
                                <option>Select</option>
                                <option value="1" <?php selected( $gym_frequency, '1' ); ?>>Weekly</option>
                                <option value="2" <?php selected( $gym_frequency, '2' ); ?>>Every two weeks</option>
                            </select>
                        </div>
                    </div>
                    <h4 class="form-title">Details</h4>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Accessible?'); ?></label> 
                            <select name="gym_barrier_free" id="gym_barrier_free" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                                <option value="no_answer" >No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Is there a shower?'); ?></label> 
                            <select name="gym_shower" id="gym_shower" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                                <option value="no_answer" >No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Is there a toilet?'); ?></label> 
                            <select name="gym_toilets" id="gym_toilets" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" >Yes</option>
                                <option value="no">No</option>
                                <option value="no_answer">No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address" class="custom-label"><?php _e('Is there a possibility of catering?'); ?></label> 
                            <select name="gym_gastranomy" id="gym_gastranomy" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                                <option value="no_answer" >No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address" class="custom-label"><?php _e('Does the sports facility have to be paid for?'); ?></label> 
                            <select name="gym_chargeble" id="gym_chargeble" class="custom-form-control">
                                <option value="">Select</option>
                                <option value="yes" >Yes</option>
                                <option value="no" >No</option>
                                <option value="no_answer">No Answer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-xl-6">
                        <div class="custom-form-group">
                            <label for="address" class="custom-label"><?php _e('Is it an indoor or an outdoor location?'); ?></label> 
                            <select name="gym_outdoor" id="gym_outdoor" class="custom-form-control">
                                <option value="">Select</option>
                              <option value="Indoor" >Indoor</option>
                              <option value="Outdoor" >Outdoor</option>
                              <option value="Both" >Both</option>
                            </select>
                        </div> 
                    </div>


                    <div class="custom-col custom-col-md-12">
                        <div class="custom-form-group abort-button">
                            <input type="submit" name="gym-submit" value="Save">
                            <a href="<?php the_permalink(); ?>" class="button ">Abort</a>
                        </div> 
                    </div>
                    
                </div>         
            </div>
        </form>
  <?php  }
    else {
    
    ?>
<div class="listing-section">
    <div class="create-listing">
        <a class="button editform" href=<?php echo $link."?addgym"; ?>>Add Data</a>
    </div>
  <div class="listing-table-main responsive-table">
       <table class="listing-table">
            <thead class="thead">
                
                <tr>
                    <th>Hidden</th>
                    <th>Surname</th>
                    <th>Address</th>
                    <th>Postcode</th>
                    <th>District</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
           </thead>
        <tbody class="listing-tbody">
            <?php
       
       $var =  get_the_permalink(); 
            $author_id = get_current_user_id();
            $loop = new WP_Query( array( 'post_type' => 'clubgym', 'posts_per_page' => 5, 'author' => $author_id, 'paged' => get_query_var('paged') ? get_query_var('paged') : 1) ) ;
          if($loop->have_posts()){


            while ( $loop->have_posts() ) : $loop->the_post(); 
                $id = get_the_ID();
               
                //echo $current;
                $gymname = get_post_meta($id,'gym_name', true);
                $gym_surname = get_post_meta($id,'gym_surname', true);
                $gym_district = get_post_meta($id,'gym_district', true);
                $gym_postcode = get_post_meta($id,'gym_postcode', true);
                $jobs_working_place = get_post_meta($id,'jobs-working-place', true);
                $gym_street = get_post_meta($id,'gym_street', true);
                $gym_city = get_post_meta($id,'gym_city', true);
                $gym_address = get_post_meta($id,'gym_address', true);

                ?> 
            <tr>
                <td> <?php echo the_title(); ?></td>
               <!--  <td> <?php echo $gymname; ?> </td> -->
                <td> <?php echo $gym_surname; ?> </td>
                <td><?php echo $gym_address; ?></td>
                <td><?php echo $gym_postcode; ?></td>
                <td><?php echo $gym_district; ?></td> 
                <td>
                  <a class="listing-edit" href="<?php echo $link."?edit_id="; echo the_id(); ?>"><span class="dashicons dashicons-edit"></span></a>
                </td>
                <td>
                  <a class="listing-delete" href="<?php echo $link."?delete_id="; echo the_id(); ?>" onclick="return confirm('Do you really want to delete this Gym?');"><span class="dashicons dashicons-trash"></span></a>
                </td>
                
            </tr>
            <?php endwhile;
              }
              else{
              	?><tr rowspan="2"><td colspan="7" class="norecord">Records not found.</td></tr><tr></tr> <?php
              }
              ?>
        </tbody>
    </table>
  </div> 
  <div class = "club-custom-pagination"><?php 
    $total_pages = $loop->max_num_pages;
            if ($total_pages > 1){
                $current_page = max(1, get_query_var('paged'));
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => '?paged=%#%',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_text'    => __('«'),
                    'next_text'    => __('»'),
                ));
            } ?>
  </div> 
</div>

<?php }
}
      else{
        $link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }
}
/*if(isset($_POST['gym-edit'])){


if(isset($_GET['edit_id'])){
     $edit_id = $_GET['edit_id'];
    //print_r($_POST);
    
}
echo "<script>window.location = '".$link."'</script>";
}*/
// if(isset($_POST['gym-edit'])){
//     $link = get_permalink();
//     echo "<script>window.location = '".$link."'</script>"; 
// }
add_shortcode('GymListing','gym_listing'); 
function ww_load_dashicons(){
   wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'ww_load_dashicons', 999);

function fn_set_featured_image() {
    
    if ( isset($_POST['gym-edit']) ) {
        //$post_id = $_GET['edit_id'];
        if($_FILES['image']['name']){
        $upload = wp_upload_bits($_FILES["image"]["name"], null, file_get_contents($_FILES["image"]["tmp_name"]));
 
            $post_id = $_GET['edit_id']; //set post id to which you need to set featured image
            $filename = $upload['file'];
            $wp_filetype = wp_check_filetype($filename, null);
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
 
            $attachment_id = wp_insert_attachment( $attachment, $filename, $post_id );
 
            if ( ! is_wp_error( $attachment_id ) ) {
                require_once(ABSPATH . 'wp-admin/includes/image.php');
 
                $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
                wp_update_attachment_metadata( $attachment_id, $attachment_data );
                set_post_thumbnail( $post_id, $attachment_id );
            }
      }  
    }
}
add_action('init', 'fn_set_featured_image');