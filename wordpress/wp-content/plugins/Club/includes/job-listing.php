<?php

function job_listing(){ 
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
    $addform = get_permalink().'?addjob';
    $listing = get_permalink();
    $sports_type_tags = get_terms([
      'taxonomy'  => 'sports_type',
      'hide_empty'    => false
    ]);
    $target_group_tags = get_terms([
      'taxonomy'  => 'target_group',
      'hide_empty'    => false
    ]);
    // echo $_SERVER['REQUEST_URI'];
    // echo str_replace(home_url()," ",$listing);
    if(isset($_POST['jobs-submit']))
    {
      // print_r( $_POST);die;
        // Create post object
        $my_post = array();
        $my_post['post_title']    =  $_POST['jobs_title'];
        $my_post['post_content']  =  $_POST['jobs-description'];
        $my_post['post_status']   = 'publish';
        $my_post['post_type'] = 'clubjobs';
        $my_post['post_category'] = array(0);
        // Insert the post into the database
        $post_id = wp_insert_post( $my_post ); 
        wp_set_post_terms( $post_id, $_POST['target_group'], 'target_group' );
        wp_set_post_terms( $post_id, $_POST['sports_type'], 'sports_type' );
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
        if(isset($_POST['jobs-edit']))
        {
           // if (array_key_exists('jobs_title', $_POST)) {
                $post_update = array(
                    'ID'         => $edit_id,
                    'post_title' => $_POST['jobs_title'],
                    'post_content' => $_POST['jobs-description'],
                  );
                wp_update_post( $post_update );
                //wp_get_object_terms($edit_id, $_POST['target_group'],)
                wp_set_post_terms( $edit_id, $_POST['target_group'], 'target_group' );
                wp_set_post_terms( $edit_id, $_POST['sports_type'], 'sports_type' );
              // }
            if(isset($_POST["jobs_type"])){
                update_post_meta($edit_id, 'jobs_type_meta_box', $_POST['jobs_type']);}
            if(isset($_POST["jobs_sport_facility"])){
                update_post_meta($edit_id, 'jobs_sport_facility', $_POST['jobs_sport_facility']);}
            if(isset($_POST["jobs-working-place"])){
                update_post_meta($edit_id, 'jobs_working_place', $_POST['jobs-working-place']);}
            if(isset($_POST["jobs_contact_person"])){
                update_post_meta($edit_id, 'jobs_contact_person', $_POST['jobs_contact_person']);}
            if(isset($_POST["jobs-phone"])){
                update_post_meta($edit_id, 'jobs_phone', $_POST['jobs-phone']);}
            if(isset($_POST["jobs_mail"])){
                update_post_meta($edit_id, 'jobs_mail', $_POST['jobs_mail']);}
            if(isset($_POST["jobs-web"])){
                update_post_meta($edit_id, 'jobs_web', $_POST['jobs-web']);}
            if(isset($_POST["jobs_starting_day"])){
                update_post_meta($edit_id, 'jobs_starting_day', $_POST['jobs_starting_day']);}
            if(isset($_POST["jobs-time-from"])){
                update_post_meta($edit_id, 'jobs_time_from', $_POST['jobs-time-from']);}
            if(isset($_POST["jobs_time_to"])){
                update_post_meta($edit_id, 'jobs_time_to', $_POST['jobs_time_to']);}
            if(isset($_POST["jobs-qualifications"])){
                update_post_meta($edit_id, 'jobs_qualifications', $_POST['jobs-qualifications']);}
            if( isset($_POST['jobs_day']) ) {
                $day = implode(' , ', $_POST['jobs_day']);
                update_post_meta($edit_id, 'jobs_day', $day); }

            echo "<script>window.location = '".$listing."'</script>";
        }
        if($current_url == $editform){ 
            //echo $jobs_title;
            $jobs_type_meta_box = get_post_meta($edit_id, 'jobs_type_meta_box', true); 
            $jobs_sport_facility = get_post_meta($edit_id, 'jobs_sport_facility', true); 
            $working_place = get_post_meta($edit_id, 'jobs_working_place', true);
            $jobs_contact_person = get_post_meta($edit_id, 'jobs_contact_person', true);
            $jobs_phone = get_post_meta($edit_id, 'jobs_phone', true);
            $jobs_mail = get_post_meta($edit_id, 'jobs_mail', true);
            $jobs_web = get_post_meta($edit_id, 'jobs_web', true); 
            $jobs_starting_day = get_post_meta($edit_id, 'jobs_starting_day', true);
            $jobs_time_from = get_post_meta($edit_id, 'jobs_time_from', true);
            $jobs_time_to = get_post_meta($edit_id, 'jobs_time_to', true);
            $jobs_description = get_post_meta($edit_id, 'jobs_description', true);
            $jobs_qualifications = get_post_meta($edit_id, 'jobs_qualifications', true);
            $facility = get_post_meta($edit_id, 'facility', true);
            $target_group = get_post_meta($edit_id, 'target_group', true);
            $day = get_post_meta($edit_id, 'jobs_day', true);
            $selecte_target_group = get_the_terms( $edit_id, 'target_group');
            $selecte_sports_type = get_the_terms( $edit_id, 'sports_type');
             //echo "<pre>"; print_r($selecte_sports_type); 
        ?>
        <form method="post" name="job_edit_form">
            <div class="manage-data-section jobs-form">
                <div class="manage-data-form-main custom-row">
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="custom-profile-name"><?php _e('Title*'); ?></label>
                            <input type="text" name="jobs_title" class="custom-form-control" value="<?php echo get_the_title($edit_id); ?>">
                            <!-- <span class="custom-validation"></span> -->
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Job Type*'); ?></label>
                            <select name="jobs_type" id="jobs_type" class="custom-form-control">
                                <option value="">Select job type</option>
                                <option value="Federal Voluntary Service" <?php selected( $jobs_type_meta_box, 'Federal Voluntary Service' ); ?>>Federal Voluntary Service</option>
                                <option value="Volunteering" <?php selected( $jobs_type_meta_box, 'Volunteering' ); ?>>Volunteering</option>
                                <option value="Full Time" <?php selected( $jobs_type_meta_box, 'Full Time' ); ?>>Full Time</option>
                                <option value="Trainer" <?php selected( $jobs_type_meta_box, 'Trainer' ); ?>>Trainer</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Sport Facility*'); ?></label>
                            <select name="jobs_sport_facility" id="jobs_sport_facility" class="custom-form-control">
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
                                    <option value="<?php echo $post_id; ?>" <?php selected( $jobs_sport_facility, $post_id ); ?>><?php the_title(); ?></option>
                                <?php }

                                wp_reset_query();
                             ?>
                            </select>
                            <span>If the sports facility in which the offer takes place does not yet exist in the system, you can create it <a href="#">here</a>.</span>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="profile-email"><?php _e('Working Place'); ?></label>
                            <input type="text" class="custom-form-control" name="jobs-working-place" value="<?php echo $working_place; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="profile-email"><?php _e('Contact Person*'); ?></label>
                            <input type="text" class="custom-form-control" name="jobs_contact_person" value="<?php echo $jobs_contact_person; ?>">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="phone"><?php _e('Phone'); ?></label>
                            <input type="text" onKeyPress="if(this.value.length==13) return false;" class="custom-form-control" name="jobs-phone" value="<?php echo $jobs_phone; ?>" >
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="mobile"><?php _e('Mail*'); ?></label>
                            <input type="text" class="custom-form-control" name="jobs_mail" value="<?php echo $jobs_mail; ?>">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="fax"><?php _e('Web'); ?></label>
                            <input type="text" class="custom-form-control" name="jobs-web" value="<?php echo $jobs_web; ?>">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group relative">
                            <label for="home-page"><?php _e('Starting Day*'); ?></label>
                            <input type="text" class="custom-form-control" placeholder="MM/DD/YYYY" id="my_date_picker" tabindex="-1" name="jobs_starting_day" value="<?php echo $jobs_starting_day; ?>">
                            <span class="dashicons dashicons-calendar-alt" id="starting_date"></span>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="jobs-time-from"><?php _e('Time From (Specified in 00:00)'); ?></label>
                            <input type="text" id="jobs_time_from" class="custom-form-control custom-job-time" name="jobs-time-from" value="<?php echo $jobs_time_from; ?>">
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="contact-time"><?php _e('Time To (Specified in 00:00)'); ?></label>
                            <input type="text" id="jobs_time_to" class="custom-form-control custom-job-time" name="jobs_time_to" value="<?php echo $jobs_time_to; ?>"> 
                            <div id="time_from"></div>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Sports Type'); ?></label> 
                            <?php $jobs_sport_type = array_column($selecte_sports_type, 'name');?>
                            <select name="sports_type[]" id="sports_type" multiple="true" class="custom-form-control custom-select">
                                <?php if(!empty($sports_type_tags)){
                                    foreach ($sports_type_tags as $value) { ?>

                                      <option value="<?php echo  $value->name; ?>" <?php echo (in_array($value->name, $jobs_sport_type )) ? 'selected':'' ?>><?php echo  $value->name; ?></option>  
                                    <?php }
                                } ?>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Target Group'); ?></label> 
                            <?php $jobs_target_group = array_column($selecte_target_group, 'name');?>
                            <select name="target_group[]" id="target_group" multiple="true" class="custom-form-control custom-select">
                                <?php if(!empty($target_group_tags)){
                                    foreach ($target_group_tags as $value) { ?>
                                      <option value="<?php echo  $value->name; ?>" <?php echo (in_array($value->name, $jobs_target_group)) ? 'selected':'' ?> ><?php echo $value->name; ?></option>  
                                    <?php }
                                } ?>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-4">
                        <div class="custom-form-group">
                            <label for="address"><?php _e('Day'); ?></label> 
                           <?php $jobs_day = explode(' , ', $day); ?>
                            <select name="jobs_day[]" id="jobs_day" multiple="true" class="custom-form-control custom-select">
                                <option value="Monday" <?php if(in_array('Monday', $jobs_day)){echo "selected";} ?>>Monday</option>
                                <option value="Tuesday" <?php if(in_array('Tuesday', $jobs_day)){echo "selected";} ?>>Tuesday</option>
                                <option value="Wednesday" <?php if(in_array('Wednesday', $jobs_day)){echo "selected";} ?>>Wednesday</option>
                                <option value="Thursday" <?php if(in_array('Thursday', $jobs_day)){echo "selected";} ?>>Thursday</option>
                                <option value="Friday" <?php if(in_array('Friday', $jobs_day)){echo "selected";} ?>>Friday</option>
                                <option value="Saturday" <?php if(in_array('Saturday', $jobs_day)){echo "selected";} ?>>Saturday</option>
                                <option value="Sunday" <?php if(in_array('Sunday', $jobs_day)){echo "selected";} ?>>Sunday</option>
                            </select>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="zip"><?php _e('Description'); ?></label>
                            <textarea name="jobs-description" class="custom-form-control" id="jobs-description" rows="5" cols="40" ><?php echo get_post_field('post_content', $edit_id); ?></textarea>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-6">
                        <div class="custom-form-group">
                            <label for="place"><?php _e('Qualifications Needed'); ?></label>
                            <textarea name="jobs-qualifications" class="custom-form-control" id="jobs-qualifications" rows="5" cols="40" ><?php echo $jobs_qualifications; ?></textarea>
                        </div> 
                    </div>
                    <div class="custom-col custom-col-lg-12">
                        <div class="custom-form-group abort-button">
                            <input type="submit" name="jobs-edit" value="Save">
                            <a href="<?php the_permalink(); ?>" class="button">Abort</a>
                        </div> 
                    </div>
                </div>    
            </div>
        </form>
       <?php }
    }
    else if( $current_url == $addform){ ?>
    <form method="post" name="job_add_form">
        <div class="manage-data-section jobs-form">
            <div class="manage-data-form-main custom-row">
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="custom-profile-name"><?php _e('Title*'); ?></label>
                        <input type="text" name="jobs_title" class="custom-form-control" >
                        <!-- <span class="custom-validation"></span> -->
                    </div> 
                </div>
                <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Job Type*'); ?></label>
                            <select name="jobs_type" id="jobs_type" class="custom-form-control">
                                <option value="">Select job type</option>
                                <option value="Federal Voluntary Service">Federal Voluntary Service</option>
                                <option value="Volunteering">Volunteering</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Trainer">Trainer</option>
                            </select>
                        </div> 
                    </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Sport Facility*'); ?></label>
                        <select name="jobs_sport_facility" id="jobs_sport_facility" class="custom-form-control">
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
                                    <option value="<?php echo $post_id; ?>"><?php the_title(); ?></option>
                                <?php }
                                wp_reset_query();
                             ?>
                        </select>
                        <span>If the sports facility in which the offer takes place does not yet exist in the system, you can create it <a href="#">here</a>.</span> 
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="profile-email"><?php _e('Working Place'); ?></label>
                        <input type="text" class="custom-form-control" name="jobs-working-place" >
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="profile-email"><?php _e('Contact Person*'); ?></label>
                        <input type="text" class="custom-form-control" name="jobs_contact_person">
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-6">
                    <div class="custom-form-group">
                        <label for="phone"><?php _e('Phone'); ?></label>
                        <input type="text" onKeyPress="if(this.value.length==13) return false;" class="custom-form-control" name="jobs-phone" >
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-6">
                    <div class="custom-form-group">
                        <label for="mobile"><?php _e('Mail*'); ?></label>
                        <input type="text" class="custom-form-control" name="jobs_mail" >
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-6">
                    <div class="custom-form-group">
                        <label for="web"><?php _e('Web'); ?></label>
                        <input type="text" class="custom-form-control" name="jobs-web" >
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-6">
                    <div class="custom-form-group relative">
                        <label for="home-page"><?php _e('Starting Day*'); ?></label>
                        <input type="text" class="custom-form-control" placeholder="MM/DD/YYYY" id="my_date_picker" tabindex="-1" name="jobs_starting_day"  >
                        <span class="dashicons dashicons-calendar-alt" id="starting_date"></span>
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-6">
                    <div class="custom-form-group">
                        <label for="jobs-time-from"><?php _e('Time From (Specified in 00:00)'); ?></label>
                        <input type="text" id="jobs_time_from" class="custom-form-control custom-job-time" name="jobs-time-from" >
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-6">
                    <div class="custom-form-group">
                        <label for="contact-time"><?php _e('Time To (Specified in 00:00)'); ?></label>
                        <input type="text" id="jobs_time_to" class="custom-form-control custom-job-time" name="jobs_time_to"> 
                        <div id="time_from"></div>
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-4">
                    <div class="custom-form-group">
                        <label for="sports_type"><?php _e('Sports Type'); ?></label>
                        <select name="sports_type[]" id="sports_type" multiple="true" class="custom-form-control custom-select">
                         <?php if(!empty($sports_type_tags)){
                            foreach ($sports_type_tags as $key => $value) { ?>
                              <option value="<?php echo  $value->name; ?>" ><?php echo  $value->name; ?></option> 
                            <?php }
                        } ?>
                    </select>
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-4">
                    <div class="custom-form-group">
                        <label for="address"><?php _e('Target Group'); ?></label> 
                        <select name="target_group[]" id="target_group" multiple="true" class="custom-form-control custom-select">
                            <?php if(!empty($target_group_tags)){
                                    foreach ($target_group_tags as $key => $value) { ?>
                                      <option value="<?php echo  $value->name; ?>" ><?php echo  $value->name; ?></option>  
                                    <?php }
                                } ?>
                        </select>
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-4">
                    <div class="custom-form-group">
                        <label for="address"><?php _e('Day'); ?></label> 
                        <select name="jobs_day[]" id="jobs_day" multiple="true" class="custom-form-control custom-select">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-6">
                    <div class="custom-form-group">
                        <label for="zip"><?php _e('Description'); ?></label>
                        <textarea name="jobs-description" class="custom-form-control" id="jobs-description" rows="5" cols="40" ></textarea>
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-6">
                    <div class="custom-form-group">
                        <label for="place"><?php _e('Qualifications Needed'); ?></label>
                        <textarea name="jobs-qualifications" class="custom-form-control" id="jobs-qualifications" rows="5" cols="40" ></textarea>
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-12">
                    <div class="custom-form-group abort-button">
                        <input type="submit" name="jobs-submit" value="Submit">
                        <a href="<?php the_permalink(); ?>" class="button">Abort</a>
                    </div> 
                </div>
            </div> 
        </div>
    </form>
  <?php  }else {?>
<div class="listing-section">
    <div class="create-listing">
        <a class="button editform" href=<?php echo $listing."?addjob" ?>>Add Data</a>
    </div>
  <div class="listing-table-main responsive-table">
       <table class="listing-table">
            <thead class="thead">
                
                <tr>
                    <?php 
                    // global $wpdb;
                    // $sql = "SELECT * FROM {$wpdb->base_prefix}posts WHERE post_content LIKE '%[ClubLogin]%'";
                    // $pages = $wpdb->get_results($sql);
                    // echo '<pre>';
                    // //print_r($pages);
                    // foreach($pages as $page){
                    //     $link = the_permalink($page->ID);
                    //     echo $link;
                    //     echo "<br>";
                    // }
                    // echo '</pre>';?>
                    <th>Heading</th>
                    <th>Sports</th>
                    <th>Sports Facility</th>
                    <th>Days</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
           </thead>
        <tbody class="listing-tbody">
            <?php
            $author_id = get_current_user_id();
            $loop = new WP_Query( array( 'post_type' => 'clubjobs', 'posts_per_page' => 5, 'author' => $author_id, 'paged' => get_query_var('paged') ? get_query_var('paged') : 1 ) );
            if($loop->have_posts()){
            while ( $loop->have_posts() ) : $loop->the_post(); 
                $id = get_the_ID();
                $jobs_title = get_post_meta($id, 'jobs_title', true);
                $jobs_sport_facility = get_post_meta($id, 'jobs_sport_facility', true); 
                $selecte_sports_type = get_the_terms( $id, 'sports_type');
                //$sports = get_post_meta($id, 'facility', true);
                $jobs_day = get_post_meta($id, 'jobs_day', true);
                ?>
            <tr>
                <td> <?php echo the_title(); ?></td>
                <td> <?php if($selecte_sports_type) { $sports_name = "";
                    foreach($selecte_sports_type as $data){
                         $sports_name .= $data->name.',';
                          }//$trimmed_content = wp_trim_words($sports_name, 2, '... <a href="">more</a>');
                         //    echo $trimmed_content;
                         $sport = mb_strimwidth($sports_name, 0, 20, '...');
                         echo rtrim($sport, ', '); 
                     }?> 
                   
                </td>
                <td><?php $jobs_sport_facility = get_post_meta($id,'jobs_sport_facility',true); 
                echo get_the_title($jobs_sport_facility); ?></td>
                <td><?php echo $jobs_day; ?></td> 
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
        $link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }
}
add_shortcode('JobListing','job_listing');

