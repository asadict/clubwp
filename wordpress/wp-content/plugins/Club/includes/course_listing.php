<?php
function course_listing(){ 
    if (is_user_logged_in()) {
    global $wp;
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
    $addform = get_permalink().'?addcourse';
    $listing = get_permalink();
    $sports_type_tags = get_terms([
      'taxonomy'  => 'Sportart',
      'hide_empty'    => false
    ]);
    $target_group_tags = get_terms([
      'taxonomy'  => 'target_groups',
      'hide_empty'    => false
    ]);
    if(isset($_POST['course-submit']))
    {
        $my_post = array();
        $my_post['post_title']    =  $_POST['course_name'];
        $my_post['post_status']   = 'publish';
        $my_post['post_type'] = 'course';
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
        $day_time = array('course_monday_from','course_monday_to','course_tuesday_from','course_tuesday_to','course_wednesday_to','course_wednesday_from','course_thursday_from','course_thursday_to','course_friday_from','course_friday_to','course_saturday_from','course_saturday_to','course_sunday_to','course_sunday_from');
        foreach ($day_time as $key => $field) {
            $value = !empty($_POST[$field]) ? date("H:i:s", strtotime($_POST[$field] )) : '';
            update_post_meta( $post_id, $field, $value);
        }
        
        wp_set_post_terms( $post_id, $_POST['course_sports'], 'sports' );
        wp_set_post_terms( $post_id, $_POST['target_groups'], 'target_groups' );
        echo "<script>window.location = '".$listing."'</script>"; 
    }
    if(isset($_GET['delete_id'])){
        $delete_id = $_GET['delete_id'];
        $deletepost = get_permalink().'?delete_id='.$delete_id;
        if($current_url == $deletepost){ 
            wp_delete_post( $delete_id);
            echo "<script>window.location = '".$listing."'</script>";
        }
    }
    if(isset($_GET['edit_id'])){
        $edit_id = $_GET['edit_id'];
        $editform = get_permalink().'?edit_id='.$edit_id;

        if(isset($_POST['course-edit'])){
            $post_update = array(
                    'ID'         => $edit_id,
                    'post_title' => $_POST['course_name'],
                  );
                wp_update_post( $post_update );
                if (array_key_exists('course_hide', $_POST)) {
                    update_post_meta($edit_id, 'course_hide', $_POST['course_hide']);
                }else{
                     update_post_meta($edit_id, 'course_hide', 0);
                }
                if (array_key_exists('course_special_offer', $_POST)) {
                    update_post_meta($edit_id, 'course_special_offer', $_POST['course_special_offer']);
                }else{
                     update_post_meta($edit_id, 'course_special_offer', 0);
                }
                if (array_key_exists('course_sport_facility', $_POST)) {
                    update_post_meta($edit_id, 'course_sport_facility', $_POST['course_sport_facility']);
                }
                if (array_key_exists('course_gender', $_POST)) {
                    update_post_meta($edit_id, 'course_gender', $_POST['course_gender']);
                }
                if (array_key_exists('course_description', $_POST)) {
                    update_post_meta($edit_id, 'course_description', $_POST['course_description']);
                }
                if (array_key_exists('course_cost', $_POST)) {
                    update_post_meta($edit_id, 'course_cost', $_POST['course_cost']);
                }
                if (array_key_exists('course_sport_trainer', $_POST)) {
                    update_post_meta($edit_id, 'course_sport_trainer', $_POST['course_sport_trainer']);
                }
                if (array_key_exists('course_holiday', $_POST)) {
                    update_post_meta($edit_id, 'course_holiday', $_POST['course_holiday']);
                }
                if (array_key_exists('course_type', $_POST)) {
                    update_post_meta($edit_id, 'course_type', $_POST['course_type']);
                }
                if (array_key_exists('course_start_date', $_POST)) {
                    update_post_meta($edit_id, 'course_start_date', $_POST['course_start_date']);
                }
                if (array_key_exists('course_end_date', $_POST)) {
                    update_post_meta($edit_id, 'course_end_date', $_POST['course_end_date']);
                }
                if (array_key_exists('course_start_week', $_POST)) {
                    update_post_meta($edit_id, 'course_start_week', $_POST['course_start_week']);
                }
                if (array_key_exists('course_end_week', $_POST)) {
                    update_post_meta($edit_id, 'course_end_week', $_POST['course_end_week']);
                }
//                if (array_key_exists('course_frequency', $_POST)) {
//                    update_post_meta($edit_id, 'course_frequency', $_POST['course_frequency']);
//                }
                $day_time = array('course_monday_from','course_monday_to','course_tuesday_from','course_tuesday_to','course_wednesday_to','course_wednesday_from','course_thursday_from','course_thursday_to','course_friday_from','course_friday_to','course_saturday_from','course_saturday_to','course_sunday_to','course_sunday_from');
                foreach ($day_time as $key => $field) {
                    $value = !empty($_POST[$field]) ? date("H:i:s", strtotime($_POST[$field] )) : '';
                    update_post_meta( $edit_id, $field, $value);
                } 
                wp_set_post_terms( $edit_id, $_POST['course_sports'] ,'sports', false );
                wp_set_post_terms( $edit_id, $_POST['target_groups'] ,'target_groups', false );
                
                echo "<script>window.location = '".$listing."'</script>";
        }
        if($current_url == $editform){ 
            global $post;
            $course_sport_facility = get_post_meta($edit_id, 'course_sport_facility', true); 
            $course_special_offer = get_post_meta($edit_id,'course_special_offer', true);
            $course_hide = get_post_meta($edit_id, 'course_hide', true);
            $course_sports =get_post_meta($edit_id, 'course_sports', true);

            $target_groups = get_post_meta($edit_id, 'target_groups', true); 
            $trainer_type = get_post_meta($edit_id, 'trainer_type', true); 
            $course_gender = get_post_meta($edit_id, 'course_gender', true);
            $course_description = get_post_meta($edit_id, 'course_description', true);
            $course_cost = get_post_meta($edit_id, 'course_cost', true);
            $course_sport_trainer = get_post_meta($edit_id, 'course_sport_trainer', true);
            $course_holiday = get_post_meta($edit_id, 'course_holiday', true);
            $course_type = get_post_meta($edit_id, 'course_type', true);
            $course_start_date = get_post_meta($edit_id, 'course_start_date', true);
            $course_end_date = get_post_meta($edit_id, 'course_end_date', true);
            $course_start_week = get_post_meta($edit_id, 'course_start_week', true);
            $course_end_week = get_post_meta($edit_id, 'course_end_week', true);
           
//            $course_frequency = get_post_meta($edit_id, 'course_frequency', true);
            $day_time = array('course_monday_from','course_monday_to','course_tuesday_from','course_tuesday_to','course_wednesday_to','course_wednesday_from','course_thursday_from','course_thursday_to','course_friday_from','course_friday_to','course_saturday_from','course_saturday_to','course_sunday_to','course_sunday_from');
            foreach ($day_time as $key => $field) {
                    $$field = !empty(get_post_meta($edit_id, $field, true)) ? date("h:i A", strtotime(get_post_meta($edit_id, $field, true))) : '';
            } 
            $url = wp_get_attachment_url( get_post_thumbnail_id($edit_id), 'thumbnail' );

            ?>

        <form method="post" enctype="multipart/form-data" name="trainer_edit_form">
            <div class="manage-data-section gym-form-edit">
                <div class="manage-data-form-main custom-row">
                    <h4 class="form-title">Create Course</h4>
                                        <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Sport Facility*'); ?></label>
                            <select name="course_sport_facility" id="course_sport_facility" class="custom-form-control">
                                <option value="">Select sport facility</option>
                                <?php
                                $query = new WP_Query(array(
                                    'post_type' => 'clubgym',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1
                                ));
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    $post_id = get_the_ID(); ?>
                                    <option value="<?php echo $post_id; ?>" <?php selected( $course_sport_facility, $post_id ); ?>><?php the_title(); ?></option>
                                <?php }

                                wp_reset_query();
                             ?>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <input type="checkbox" name="course_special_offer" class="custom-form-control" value="1" <?php if ($course_special_offer == 1) {echo "checked";}?>>
                            <label for="course_special_offer"><?php _e('Special offer'); ?></label>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <input type="checkbox" name="course_hide" class="custom-form-control" value="1" <?php if ($course_hide == 1) {echo "checked";}?>>
                            <label for="course_hide"><?php _e('Hide'); ?></label>
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
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="course_name"><?php _e('Sport course name'); ?></label><span>*</span>
                            <input type="text" name="course_name" class="custom-form-control" value="<?php echo get_the_title($edit_id); ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Sports'); ?></label>
                            <select name="course_sports" id="course_sports" class="custom-form-control">
                                <option value="">Select type</option>
                                <?php
                                $terms = get_terms( array(
                                    'taxonomy' => 'sports',
                                    'hide_empty' => false,
                                ) );
                                foreach ($terms as $term){
                                $course_sports_name = wp_get_post_terms($edit_id, 'sports', array('fields' => 'ids')); 
                                    ?>
                                  <option value="<?php echo $term->term_id; ?>"<?php if(in_array($term->term_id, $course_sports_name)) echo "selected"; ?> ><?php echo $term->name;?>
                                  </option>
                                        <?php } ?>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Target Group'); ?></label>
                            <select name="target_groups" id="target_groups" class="custom-form-control">
                                <option value="">Select type</option>
                                <?php
                                $terms = get_terms( array(
                                    'taxonomy' => 'target_groups',
                                    'hide_empty' => false,
                                ) );
                                foreach ($terms as $term){ 
                                    $target_groups_tag = wp_get_post_terms($edit_id, 'target_groups', array('fields' => 'ids'));  ?>
                                  <option value="<?php echo $term->term_id; ?>"<?php if(in_array($term->term_id, $target_groups_tag)) echo "selected"; ?> ><?php echo $term->name;?>
                                  </option>
                                        <?php } ?>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="course_gender"><?php _e('Gender'); ?></label>
                            <select name="course_gender" id="course_gender" class="custom-form-control">
                                <option value="male" <?php selected( $course_gender, 'male' ); ?>>Male</option>
                                <option value="female" <?php selected( $course_gender, 'female' ); ?>>Female</option>
                                <option value="both" <?php selected( $course_gender, 'both' ); ?>>Both</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="course_description"><?php _e('Description'); ?></label>
                            <textarea name="course_description" id="course_description" rows="5" cols="40" ><?php echo $course_description; ?></textarea>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="course_cost"><?php _e('Cost'); ?></label>
                            <textarea name="course_cost" id="course_cost" rows="5" cols="40" ><?php echo $course_cost; ?></textarea>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="course_sport_trainer"><?php _e('Trainer'); ?></label>
                            <select name="course_sport_trainer" id="course_sport_trainer">
                                <option>Select Sport facility</option>
                                    <?php 
                                    $author_id = get_current_user_id();
                                        $query = new WP_Query(array(
                                            'post_type' => 'trainer',
                                            'post_status' => 'publish',
                                            'author' => $author_id
                                        ));
                                        while ($query->have_posts()) {
                                            $query->the_post();
                                            $post_id = get_the_ID(); ?>
                                            <option value="<?php echo $post_id; ?>" <?php selected( $course_sport_trainer, $post_id ); ?>><?php the_title(); ?></option>
                                        <?php }
                                        wp_reset_query();
                                     ?>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="course_gender"><?php _e('Type'); ?></label>
                            <select name="course_type" id="course_type">
                                <option>Select type</option>
                                <option value="1" <?php selected( $course_type, '1' ); ?>>Recurring</option>
                                <option value="2" <?php selected( $course_type, '2' ); ?>>Short course</option>
                                <option value="3" <?php selected( $course_type, '3' ); ?>>Single</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="course_gender"><?php _e('During school holidays?'); ?></label>
                            <select name="course_holiday" id="course_holiday">
                                <option>Select</option>
                                <option value="0" <?php selected( $course_holiday, '0' ); ?>>Yes</option>
                                <option value="1" <?php selected( $course_holiday, '1' ); ?>>No</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="profile-email"><?php _e('Starting date'); ?></label>
                            <input type="date" class="custom-date" id="course_starting_date" value="<?php echo $course_start_date; ?>" name="course_start_date">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="phone"><?php _e('Ending date'); ?></label>
                            <input type="date" class="custom-date" id="course_ending_date" value="<?php echo $course_end_date; ?>" name="course_end_date">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="phone"><?php _e('Starting calender week'); ?></label>
                           <select name="course_start_week" id="course_start_week">
                                <option>Select start week</option>
                                 <?php for ($i = 1; $i <= 52; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if($course_start_week == $i){ echo "selected"; } ?> ><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="phone"><?php _e('Ending calender week'); ?></label>
                            <select name="course_end_week" id="course_end_week">
                                <option>Select end week</option>
                                 <?php for ($i = 1; $i <= 52; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php if($course_end_week == $i){ echo "selected"; }?> ><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Monday'); ?></label></br>
                            from<input type="text" id="course_monday_from" class="custom-form-control custom-job-time" value="<?php echo $course_monday_from; ?>" name="course_monday_from" >clock &nbsp;
                            to<input type="text" id="course_monday_to" name="course_monday_to" value="<?php echo $course_monday_to?>" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div>
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Tuesday'); ?></label></br>
                            from<input type="text" id="course_tuesday_from" class="custom-form-control custom-job-time" value="<?php echo $course_tuesday_from; ?>" name="course_tuesday_from" >clock &nbsp;
                            to<input type="text" id="course_tuesday_to" value="<?php echo $course_tuesday_to; ?>" name="course_tuesday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Wednesday'); ?></label></br>
                            from<input type="text" id="course_wednesday_from" class="custom-form-control custom-job-time" value="<?php echo $course_wednesday_from; ?>" name="course_wednesday_from" >clock &nbsp;
                            to<input type="text" id="course_wednesday_to" value="<?php echo $course_wednesday_to; ?>" name="course_wednesday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Thursday'); ?></label></br>
                            from<input type="text" value="<?php echo $course_thursday_from; ?>" id="course_thursday_from" class="custom-form-control custom-job-time" name="course_thursday_from" >clock &nbsp;
                            to<input type="text" value="<?php echo $course_thursday_to; ?>" id="course_thursday_to" name="course_thursday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Friday'); ?></label></br>
                            from<input type="text" value="<?php echo $course_friday_from; ?>" id="course_friday_from" class="custom-form-control custom-job-time" name="course_friday_from" >clock &nbsp;
                            to<input type="text" value="<?php echo $course_friday_to; ?>" id="course_friday_to" name="course_friday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Saturday'); ?></label></br>
                            from<input type="text" value="<?php echo $course_saturday_from; ?>" id="course_saturday_from" class="custom-form-control custom-job-time" name="course_saturday_from" >clock &nbsp;
                            to<input type="text" value="<?php echo $course_saturday_to; ?>" id="course_saturday_to" name="course_saturday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Sunday'); ?></label></br>
                            from<input type="text" value="<?php echo $course_sunday_from; ?>" id="course_sunday_from" class="custom-form-control custom-job-time" name="course_sunday_from" >clock &nbsp;
                            to<input type="text" value="<?php echo $course_sunday_to; ?>" id="course_sunday_to" name="course_sunday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div>
<!--                    <div class="custom-col">-->
<!--                        <div class="custom-form-group">-->
<!--                        <label for="provider/sport-club">--><?php //_e('Frequency'); ?><!--</label>-->
<!--                        <select name="course_frequency" id="course_frequency">-->
<!--                            <option value="0">Select</option>-->
<!--                            <option value="1" --><?php //selected( $course_frequency, '1' ); ?><!-->Weekly</option>-->
<!--                            <option value="2" --><?php //selected( $course_frequency, '2' ); ?><!-->Every two weeks</option>-->
<!--                        </select>-->
<!--                    </div> -->
<!--                    </div>-->

                   
                    <div class="custom-col custom-col-md-12">
                        <div class="custom-form-group abort-button">
                            <input type="submit" name="course-edit" value="Save" id="save">
                            <a href="<?php the_permalink(); ?>" class="button">Abort</a>
                        </div> 
                    </div>
                </div>         
            </div>
        </form>
       <?php }
    }
    else if( $current_url == $addform){ ?>
    <form method="post" enctype="multipart/form-data" name="course_add_form" runat="server">
        <div class="manage-data-section jobs-form">
            <div class="manage-data-form-main custom-row">
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="trainer_name"><?php _e('Sports Facility'); ?></label>
                        <select name="course_sport_facility" id="course_sport_facility">
                            <option>Select Sport facility</option>
                                <?php 
                                $author_id = get_current_user_id();
                                    $query = new WP_Query(array(
                                        'post_type' => 'clubgym',
                                        'post_status' => 'publish',
                                        'author' => $author_id
                                    ));
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $post_id = get_the_ID(); ?>
                                        <option value="<?php echo $post_id; ?>" <?php selected( $course_sport_facility, $post_id ); ?>><?php the_title(); ?></option>
                                    <?php }
                                    wp_reset_query();
                                 ?>
                        </select>
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <input type="checkbox" name="course_special_offer" value="1" <?php if ($course_special_offer == "1") {echo "Checked";} else{echo "Unchecked"; } ?>>
                        <label for="trainer_name"><?php _e('Special offer'); ?></label>
                    </div>
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <input type="checkbox" name="course_hide" value="1" <?php if ($course_hide == "1") {echo "Checked";} else{echo "Unchecked"; } ?>>
                        <label for="trainer_name"><?php _e('Hide'); ?></label>
                    </div>
                </div>
                <div class="custom-col gym-image">
                    <div class="custom-form-group">
                        <label for="address"><?php _e('Image'); ?></label> 
                            <input type="file" name="image"> 
                    </div> 
                    </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="trainer_name"><?php _e('Sport course name'); ?></label><span>*</span>
                        <input type="text" name="course_name" class="custom-form-control">
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="custom-profile-name"><?php _e('Sports'); ?></label>
                        <select name="course_sports" id="course_sports">
                            <option>Select type</option>
                            <?php
                    $terms = get_terms( array(
                            'taxonomy' => 'sports',
                            'hide_empty' => false,
                        ) );
                    foreach ($terms as $term){ ?>
                      <option value="<?php echo $term->term_id; ?>" <?php if($term->term_id == $_POST['course_sports']){ echo "selected"; } ?> ><?php echo $term->name;?></option>
                            <?php } ?>
                        </select>
                    </div> 
                </div>
                <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Target group'); ?></label>
                            <select name="target_groups" id="target_groups">
                                <option>Select target group</option>
                                <?php
                                    $terms = get_terms( array(
                                            'taxonomy' => 'target_groups',
                                            'hide_empty' => false,
                                        ) );
                        foreach ($terms as $term){ ?>
                          <option value="<?php echo $term->term_id; ?>" <?php if($term->term_id == $_POST['target_groups']){ echo "selected"; } ?> ><?php echo $term->name;?></option>
                                <?php } ?>
                            </select>
                        </div> 
                    </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Gender'); ?></label>
                        <select name="course_gender" id="course_gender">
                            <option>Select gender</option>
                            <option value="male" <?php selected( $course_gender, 'male' ); ?>>Male</option>
                            <option value="female" <?php selected( $course_gender, 'female' ); ?>>Female</option>
                            <option value="both" <?php selected( $course_gender, 'both' ); ?>>Both</option>
                        </select>
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Description'); ?></label>
                        <textarea name="course_description" id="course_description" rows="5" cols="40" ><?php echo $course_description; ?></textarea>
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Cost'); ?></label>
                        <textarea name="course_cost" id="course_cost" rows="5" cols="40" ><?php echo $course_cost; ?></textarea>
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Trainer'); ?></label>
                        <select name="course_sport_trainer" id="course_sport_trainer">
                            <option>Select trainer</option>
                                <?php 
                                $author_id = get_current_user_id();
                                    $query = new WP_Query(array(
                                        'post_type' => 'trainer',
                                        'post_status' => 'publish',
                                        'author' => $author_id
                                    ));
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $post_id = get_the_ID(); ?>
                                        <option value="<?php echo $post_id; ?>" <?php selected( $course_sport_trainer, $post_id ); ?>><?php the_title(); ?></option>
                                    <?php }
                                    wp_reset_query(); ?>
                        </select>
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Type'); ?></label>
                        <select name="course_type" id="course_type">
                            <option>Select type</option>
                            <option value="1" <?php selected( $course_type, '1' ); ?>>Recurring</option>
                            <option value="2" <?php selected( $course_type, '2' ); ?>>Short course</option>
                            <option value="3" <?php selected( $course_type, '3' ); ?>>Single</option>
                        </select>
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('During school holidays?'); ?></label>
                        <select name="course_holiday" id="course_holiday">
                            <option>Select</option>
                            <option value="0" <?php selected( $course_holiday, '0' ); ?>>Yes</option>
                            <option value="1" <?php selected( $course_holiday, '1' ); ?>>No</option>
                        </select>
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Starting date'); ?></label>
                        <input type="date" class="custom-date" id="course_starting_date" value="<?php echo $course_start_date; ?>" name="course_start_date">
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Ending date'); ?></label>
                        <input type="date" class="custom-date" id="course_ending_date" value="<?php echo $course_end_date; ?>" name="course_end_date">
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Staring calender week'); ?></label>
                        <select name="course_start_week" id="course_start_week">
                            <option>Select start week</option>
                             <?php for ($i = 1; $i <= 52; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php if($course_start_week == $i){ echo "selected"; } ?> ><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Ending calender week'); ?></label>
                        <select name="course_end_week" id="course_end_week">
                            <option>Select end week</option>
                             <?php for ($i = 1; $i <= 52; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php if($course_end_week == $i){ echo "selected"; }?> ><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                    </div> 
                </div>
                   <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Monday'); ?></label></br>
                            from<input type="text" id="course_monday_from" class="custom-form-control custom-job-time" name="course_monday_from" >clock &nbsp;
                            to<input type="text" id="course_monday_to" name="course_monday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Tuesday'); ?></label></br>
                            from<input type="text" id="course_tuesday_from" class="custom-form-control custom-job-time" name="course_tuesday_from" >clock &nbsp;
                            to<input type="text" id="course_tuesday_to" name="course_tuesday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Wednesday'); ?></label></br>
                            from<input type="text" id="course_wednesday_from" class="custom-form-control custom-job-time" name="course_wednesday_from" >clock &nbsp;
                            to<input type="text" id="course_wednesday_to" name="course_wednesday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Thursday'); ?></label></br>
                            from<input type="text" id="course_thursday_from" class="custom-form-control custom-job-time" name="course_thursday_from" >clock &nbsp;
                            to<input type="text" id="course_thursday_to" name="course_thursday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Friday'); ?></label></br>
                            from<input type="text" id="course_friday_from" class="custom-form-control custom-job-time" name="course_friday_from" >clock &nbsp;
                            to<input type="text" id="course_friday_to" name="course_friday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Saturday'); ?></label></br>
                            from<input type="text" id="course_saturday_from" class="custom-form-control custom-job-time" name="course_saturday_from" >clock &nbsp;
                            to<input type="text" id="course_saturday_to" name="course_saturday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div> 
                    <div class="custom-col custom-col-md-6 custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="contact-person"><?php _e('Sunday'); ?></label></br>
                            from<input type="text" id="course_sunday_from" class="custom-form-control custom-job-time" name="course_sunday_from" >clock &nbsp;
                            to<input type="text" id="course_sunday_to" name="course_sunday_to" class="custom-form-control custom-job-time"  >clock
                            <div id="monday_error"></div>
                        </div>
                    </div>
<!--                    <div class="custom-col">-->
<!--                    <div class="custom-form-group">-->
<!--                        <label for="provider/sport-club">--><?php //_e('Frequency'); ?><!--</label>-->
<!--                        <select name="course_frequency" id="course_frequency">-->
<!--                            <option>Select</option>-->
<!--                            <option value="1" --><?php //selected( $course_frequency, '1' ); ?><!-->Weekly</option>-->
<!--                            <option value="2" --><?php //selected( $course_frequency, '2' ); ?><!-->Every two weeks</option>-->
<!--                        </select>-->
<!--                    </div> -->
<!--                </div> -->
                    <div class="custom-col custom-col-lg-12">
                    <div class="custom-form-group abort-button">
                        <input type="submit" name="course-submit" value="Submit">
                        <a href="<?php the_permalink(); ?>" class="button">Abort</a>
                    </div> 
                </div>
            </div> 
        </div>
    </form>
  <?php  }else {?>
<div class="listing-section">
    <div class="create-listing">
        <a class="button editform" href=<?php echo $listing."?addcourse" ?>>Add Data</a>
    </div>
  <div class="listing-table-main responsive-table">
       <table class="listing-table">
            <thead class="thead">
                
                <tr>
                    <th>Sports Course </th>
                    <th>Sports Facility </th>
                    <th>Sports</th>
                    <th>Target group</th>
                    <th>Trainer</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
           </thead>
        <tbody class="listing-tbody">
            <?php
            $author_id = get_current_user_id();
            $loop = new WP_Query( array( 'post_type' => 'course', 'posts_per_page' => 5, 'author' => $author_id, 'paged' => get_query_var('paged') ? get_query_var('paged') : 1 ) );
            if($loop->have_posts()){
            while ( $loop->have_posts() ) : $loop->the_post(); 
                $id = get_the_ID();
                $course_sport_facility = get_post_meta($id, 'course_sport_facility', true);
                $course_sport_facility_name = get_the_title($course_sport_facility);
                $course_sports_name = wp_get_post_terms($id, 'sports', array('fields' => 'names')); // returns an array of term names
                $target_groups = wp_get_post_terms($id, 'target_groups', array('fields' => 'names')); // returns an array of term names
                $course_sport_trainer = get_post_meta($id, 'course_sport_trainer', true);
                $course_sport_trainer_name = get_the_title($course_sport_trainer);
                $course_type = get_post_meta($id, 'course_type', true);
                ?>
            <tr>
                <td> <?php echo the_title(); ?></td>
                <td> <?php echo $course_sport_facility_name;?></td>
                <td> <?php echo implode(', ', $course_sports_name); ?></td>
                <td> <?php echo implode(', ', $target_groups); ?></td>
                <td> <?php echo $course_sport_trainer_name;?></td>
                <td>
                  <a class="listing-edit" href="<?php echo $listing."?edit_id="; echo the_id(); ?>"><span class="dashicons dashicons-edit"></span></a>
                </td>
                <td>
                  <a class="listing-delete" href="<?php echo $listing."?delete_id="; echo the_id(); ?>" onclick="return confirm('Do you really want to delete this position?');"><span class="dashicons dashicons-trash"></span></a>
                </td>
            </tr>
            <?php endwhile; 
                }  else { ?> <tr><td colspan="7" class="norecord"> Records not found.</td></tr><?php }   ?> 
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
            } ?></div>  
</div>

<?php }
}
      else{
        $link = '/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }
	}
add_shortcode('CourseListing','course_listing'); 


function fn_set_featured_image_course() {
    
    if ( isset($_POST['course-edit']) ) {
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

add_action('init', 'fn_set_featured_image_course');

?>