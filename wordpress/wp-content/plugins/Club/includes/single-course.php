<?php get_header(); 
   $post_id = get_the_id();
   $author_id = get_post_field( 'post_author', $post_id);
   ?>
<div class="custom-card tab-section west-indoor-main">
<div class="west-indoor-details">
   <div class="d-inline">
      <h2 class="left"><?php the_title(); ?></h2>
      <div class="listing-img">
         <a href="#" alt="">
         <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_id, 'thumbnail' ) ); ?>" width="80" height="80" alt="">
         </a>
      </div>
   </div>
   <?php $course_sport_facility = get_post_meta($id, 'course_sport_facility', true);
      $course_sport_facility_name = get_the_title($course_sport_facility); ?>
   <p><b>Sports :</b> <?php echo $course_sport_facility_name; ?></p>
   <p><b>Providers :</b> <?php echo get_the_author_meta( 'custom-profile-name'); ?></p>
   <?php $target_groups = get_the_terms($id, 'target_groups');
                         $types ='';
                         foreach($target_groups as $term_single) {
                              $types .= ucfirst($term_single->slug).', ';
                         }
                         $target_groups_data = rtrim($types, ', '); ?>
   <p><b>Target groups :</b> <?php echo $target_groups_data; ?></p>
   <?php 
    $day_time = array('course_monday_from','course_monday_to','course_tuesday_from','course_tuesday_to','course_wednesday_to','course_wednesday_from','course_thursday_from','course_thursday_to','course_friday_from','course_friday_to','course_saturday_from','course_saturday_to','course_sunday_to','course_sunday_from');
    foreach ($day_time as $key => $field) {
      $$field = (get_post_meta($id, $field, true)) ? date("h:i A", strtotime(get_post_meta($id, $field, true))) : '';
    }
    ?>
    <div class="event-main-custom">
   <p><b>Events :</b>  <ul>
                          <?php if($course_monday_from){ ?>  <li>Mon, <?php echo $course_monday_from; ?> to <?php echo $course_monday_to; ?> </li><?php } ?>
                           <?php if($course_tuesday_from){ ?> <li>Tue, <?php echo $course_tuesday_from; ?> to <?php echo $course_tuesday_to; ?> </li><?php } ?>
                            <?php if($course_wednesday_from){ ?><li>Wed, <?php echo $course_wednesday_from; ?> to <?php echo $course_wednesday_to; ?> </li><?php } ?>
                           <?php if($course_thursday_from){ ?> <li>Thu, <?php echo $course_thursday_from; ?> to <?php echo $course_thursday_to; ?> </li><?php } ?>
                            <?php if($course_friday_from) { ?><li>Fri, <?php echo $course_friday_from; ?> to <?php echo $course_friday_to; ?> </li><?php } ?>
                          <?php if($course_saturday_from) { ?>  <li>Sat, <?php echo $course_saturday_from; ?> to <?php echo $course_saturday_to; ?> </li><?php } ?>
                           <?php if($course_sunday_from) { ?> <li>Sun, <?php echo $course_sunday_from; ?> to <?php echo $course_sunday_to; ?> </li><?php } ?>
                        </ul>

    </p>
</div>
</div>
<?php
$startDateTime = get_post_meta($id,'course_start_date',true); 
$endDateTime = get_post_meta($id,'course_end_date',true);
$weekInterval = get_post_meta($id,'course_frequency',true);
$weekInterval = (!empty($weekInterval)) ? $weekInterval : 0;

$start = new DateTime($startDateTime);
$end = new DateTime( $endDateTime );
$interval = new DateInterval('P1D');

$period = new DatePeriod($start, $interval, $end);

// initialize fake week
$fakeWeek = 0;
$currentWeek = $start->format('W'); ?>
<div class="west-indoor-timedetails">
      <h3>Next Meetings</h3>
      <ul>
         <?php
foreach ($period as $date) {
$monday = get_post_meta($id,'course_monday_from',true);
    if ($date->format('W') !== $currentWeek) {
        $currentWeek = $date->format('W');
        $fakeWeek++;
    }

    if ($weekInterval != 0 && $fakeWeek % $weekInterval !== 0) {
        continue;
    }
    $mondays = $tuesdays = $wednesdays = $thursdays = $fridays = $saturdays = $sundays = '';
    $dayOfWeek = $date->format('l');
    $day_time = array('course_monday_from','course_monday_to','course_tuesday_from','course_tuesday_to','course_wednesday_to','course_wednesday_from','course_thursday_from','course_thursday_to','course_friday_from','course_friday_to','course_saturday_from','course_saturday_to','course_sunday_to','course_sunday_from');
    foreach ($day_time as $key => $field) {
      $$field = (get_post_meta($id, $field, true)) ? date("h:i A", strtotime(get_post_meta($id, $field, true))) : '';
    }
    if($course_monday_from){ $mondays = "Monday"; }
    if($course_tuesday_from){ $tuesdays = "Tuesday";}
    if($course_wednesday_from){ $wednesdays = "Wednesday"; }
    if($course_thursday_from){$thursdays = "Thursday"; }
    if($course_friday_from){$fridays = "Friday"; }
    if($course_saturday_from){$saturdays = "Saturday"; }
    if($course_sunday_from){$sundays = "Sunday"; } ?>
    
      <?php
       if ($dayOfWeek == $mondays ) { ?>
            <li><span><?php print $dayOfWeek . ', ' . $date->format('Y-m-d') . ', ' . $course_monday_from. ' to ' . $course_monday_to.  '<br/>'; ?> </span></li> 
      <?php } 
       else if($dayOfWeek == $tuesdays)
       { ?>
         <li><span><?php print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ',  ' . $course_tuesday_from. ' to '. $course_tuesday_to .'<br/>'; ?> </span></li>
       <?php }
       else if($dayOfWeek == $wednesdays)
       { ?>
        <li><span><?php print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ',  ' . $course_wednesday_from. ' to ' . $course_wednesday_to . '<br/>'; ?> </span></li>
      <?php } 
       else if($dayOfWeek == $thursdays)
       { ?>
        <li><span><?php print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ',  ' . $course_thursday_from. ' to ' . $course_thursday_to . '<br/>'; ?> </span></li>
      <?php }
       else if($dayOfWeek == $fridays)
       { ?>
        <li><span><?php print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ', ' . $course_friday_from. ' to ' . $course_friday_to . '<br/>'; ?> </span></li>
      <?php }
      else if($dayOfWeek == $saturdays)
       { ?>
        <li><span><?php print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ',  ' . $course_saturday_from. ' to ' . $course_saturday_to . '<br/>'; ?> </span></li>
      <?php }
      else if($dayOfWeek == $sundays)
       { ?>
        <li><span><?php print $dayOfWeek . ',  ' . $date->format('Y-m-d') . ',  ' . $course_sunday_from. ' to ' . $course_sunday_to . '<br/>'; ?> </span></li>
      <?php }
   }
   ?>
      </ul>
   </div>

<div class="west-indoor-table-main">
   <h3>Sports Facility</h3>
   <div class="responsive-table">
      <?php $course_sport_facility = get_post_meta($id, 'course_sport_facility', true);
         $course_sport_facility_name = get_the_title($course_sport_facility); ?>
      <p><a href="<?php echo get_post_permalink($course_sport_facility); ?>" alt="#" class="custom-link"><?php echo $course_sport_facility_name; ?></a></p>
   </div>
</div>
<h3>District</h3>
<p><?php echo get_the_author_meta( 'address'); ?> </p>
<div class="map-section">
   <h3>Description Hallenbad West</h3>
   <p>The indoor swimming pool West was renovated in 2011 and has six 25 meter lanes, a diving pool and a non-swimmer pool.</p>
   <div class="map" style="width: 100%">
      <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=100%&amp;hl=en&amp;q=germany+(Your%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><!-- <a href="https://www.mapsdirections.info/en/measure-map-radius/">Radius distance map</a> -->
   </div>
   <div class="contact-footer">
      <div><a href="#" class="custom-link"> Back to the List</a></div>
   </div>
</div>
<?php get_footer();