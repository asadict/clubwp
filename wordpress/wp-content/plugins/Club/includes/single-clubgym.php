<?php get_header(); 
   $post_id = get_the_id();
   $author_id = get_post_field( 'post_author', $post_id);
   ?>
<div class="custom-card tab-section west-indoor-main single-gym">
<div class="west-indoor-details">
   <div class="d-inline">
      <h1 class="left"><?php the_title(); ?></h1>
      <!-- <div class="print-icon right"><span class="dashicons dashicons-printer"></span></div> -->
   </div>
   <div class="tab-head-details">
          <a href="<?php echo get_the_permalink();?>" alt="">
                <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_id, 'thumbnail' ) ); ?>" width="80" height="80" alt="">
            </a>
    </div>
   <h2>Contact</h2>
   <p>Administration By : <?php echo get_the_author_meta( 'display_name', $author_id); ?> <a href="<?php echo "/provider-detail?id=".$author_id."&contact=active"; ?>" alt="#" class="custom-link"><?php echo get_the_author_meta( 'provider-sport-club', $author_id); ?></a></p>
   <br>
   <p>Contact Person : <?php echo get_post_meta($post_id, 'gym_contact_name', true); ?></p>
   <p>Address : <?php echo get_post_meta($post_id, 'gym_address', true); ?></p>
   <p>Phone : <?php echo get_post_meta($post_id, 'gym_phone', true); ?></p>
   <p>Fax : <?php echo get_post_meta($post_id, 'gym_fax', true); ?></p>
   <p><a href="<?php echo get_post_meta($post_id, 'gym_home_page', true); ?>" alt="#" class="custom-link"><?php echo get_post_meta($post_id, 'gym_home_page', true); ?></a></p>
   <p><a href="mailto:<?php echo get_post_meta($post_id, 'gym_mail', true); ?>" alt="#" class="custom-link"><?php echo get_post_meta($post_id, 'gym_mail', true); ?></a></p>
   <p><a href="<?php echo "/club-listing"?>" alt="#" class="custom-link">Show sport offers in <?php echo the_title(); ?></a></p>
</div>
<tbody class="listing-tbody">
   <?php
      global $wp,$wpdb;
      
        $gymCustomerData = $wpdb->prefix . "gym_booking";
        $gymBookingData = $wpdb->prefix . "gym_booking_days";
      
        $gym_data = $wpdb->prepare("SELECT $gymCustomerData.user_id,$gymCustomerData.g_id,$gymCustomerData.g_startdate,$gymCustomerData.gym_parts,$gymCustomerData.g_enddate, $gymBookingData.*,$gymCustomerData.g_targetgroup,$gymCustomerData.g_gender FROM $gymCustomerData JOIN $gymBookingData ON $gymBookingData.gb_id = $gymCustomerData.id WHERE $gymCustomerData.g_id = $post_id AND $gymCustomerData.g_startdate BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)");
      
        $gymData = $wpdb->get_results($gym_data); ?>
</tbody>
<div class="west-indoor-time-details">
   <ul>
      <?php
         global $wp,$wpdb;
         
           $gymCustomerData = $wpdb->prefix . "gym_booking";
           $gymBookingData = $wpdb->prefix . "gym_booking_days";
         
           $gym_data = $wpdb->prepare("SELECT $gymCustomerData.user_id,$gymCustomerData.g_id,$gymCustomerData.g_startdate,$gymCustomerData.gym_parts,$gymCustomerData.g_enddate, $gymBookingData.*,$gymCustomerData.g_targetgroup,$gymCustomerData.g_gender FROM $gymCustomerData JOIN $gymBookingData ON $gymBookingData.gb_id = $gymCustomerData.id WHERE $gymCustomerData.g_id = $post_id ");
           //echo $gym_data;
           $gymData = $wpdb->get_results($gym_data);
           foreach($gymData as $days)
           { 
             $user_id = $days->user_id;
             $user_name = get_author_name($user_id);
             $gb_monday_start = $days->gb_monday_start;
             $gb_monday_end = $days->gb_monday_end;
             $gb_tuesday_start = $days->gb_tuesday_start;
             $gb_tuesday_end = $days->gb_tuesday_end;
             $gb_wednesday_start = $days->gb_wednesday_start;
             $gb_wednesday_end = $day->gb_wednesday_end;
             $gb_thursday_start = $days->gb_thursday_start;
             $gb_thursday_end = $days->gb_thursday_end;
             $gb_friday_start = $days->gb_friday_start;
             $gb_friday_end = $days->gb_friday_end;
             $gb_saturday_start = $days->gb_saturday_start;
             $gb_saturday_end = $days->gb_saturday_end;
             $gb_sunday_start = $days->gb_sunday_start;
             $gb_sunday_end = $days->gb_sunday_end;
             $parts = $days->gym_parts;
             if($gb_monday_start){ ?>
                <li><span>Monday <?php echo $gb_monday_start; ?> to <?php echo $gb_monday_end; ?>, Gym Part <?php echo $parts; ?></span></li>
                <?php } 
                   if($gb_tuesday_start) { ?>
                <li><span>Tuesday <?php echo $gb_tuesday_start; ?> to <?php echo $gb_tuesday_end; ?>, Gym Part <?php echo $parts; ?></span></li>
                <?php }
                   if($gb_wednesday_start) { ?>
                <li><span>Wednesday <?php echo $gb_wednesday_start; ?> to <?php echo $gb_wednesday_end; ?>, Gym Part <?php echo $parts; ?></span></li>
                <?php } 
                   if($gb_thursday_start) { ?>
                <li><span>Thursday <?php echo $gb_thursday_start; ?> to <?php echo $gb_thursday_end; ?>, Gym Part <?php echo $parts; ?></span></li>
                <?php } 
                   if($gb_friday_start) { ?>
                <li><span>Friday <?php echo $gb_friday_start; ?> to <?php echo $gb_friday_end; ?>, Gym Part <?php echo $parts; ?></span></li>
                <?php } 
                   if($gb_saturday_start) { ?>
                <li><span>Saturday <?php echo $gb_saturday_start; ?> to <?php echo $gb_saturday_end; ?>, Gym Part <?php echo $parts; ?></span></li>
                <?php } 
                   if($gb_sunday_start) { ?>
                <li><span>Sunday <?php echo $gb_sunday_start; ?> to <?php echo $gb_sunday_end; ?>, Gym Part <?php echo $parts; ?></span></li>
                <?php }
              } ?>
            </ul>
</div>
<div class="west-indoor-table-main">
   <h2>Details</h2>
   <div class="responsive-table">
      <table>
         <tbody>
            <tr>
               <th>Sports :</th>
               <td><?php echo get_post_meta($post_id, 'gym_sport_facility', true); ?></td>
            </tr>
            <tr>
               <th>District :</th>
               <td><?php echo get_post_meta($post_id, 'gym_district', true); ?></td>
            </tr>
            <tr>
               <th>Plant type :</th>
               <td></td>
            </tr>
            <tr>
               <th>Barrier-free?</th>
               <td><?php echo get_post_meta($post_id, 'gym_barrier_free', true); ?></td>
            </tr>
            <tr>
               <th>Shower facilities available?</th>
               <td><?php echo get_post_meta($post_id, 'gym_shower', true); ?></td>
            </tr>
            <tr>
               <th>Toilet available?</th>
               <td><?php echo get_post_meta($post_id, 'gym_toilets', true); ?></td>
            </tr>
            <tr>
               <th>Is there a possibility of catering?</th>
               <td><?php echo get_post_meta($post_id, 'gym_gastranomy', true); ?></td>
            </tr>
            <tr>
               <th>Indoor / outdoor?</th>
               <td><?php echo get_post_meta($post_id, 'gym_outdoor', true); ?></td>
            </tr>
            <tr>
               <th>Chargeable?</th>
               <td><?php echo get_post_meta($post_id, 'gym_chargeble', true); ?></td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
<div class="map-section">
   <h2>Description Hallenbad West</h2>
   <p>The indoor swimming pool West was renovated in 2011 and has six 25 meter lanes, a diving pool and a non-swimmer pool.</p>
   <div class="map" style="width: 100%">
      <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=100%&amp;hl=en&amp;q=germany+(Your%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><!-- <a href="https://www.mapsdirections.info/en/measure-map-radius/">Radius distance map</a> -->
   </div>
   <div class="contact-footer">
      <div><a href="#" class="custom-link"> Back to the List</a></div>
   </div>
</div>
<?php get_footer();