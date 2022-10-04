<?php
get_header();
get_sidebar();
include(WP_PLUGIN_DIR. '/Club/comman_function.php');
global $post;
$course_gender = $wpdb->get_results("select meta_value from {$wpdb->base_prefix}postmeta where meta_key ='course_gender'");
?>
<div id="content" class="content search-sports-offer" role="main">
<div class="search-main">
    <form role="search" method="post" id="quicksearch" name="quicksearch" action="/sports-offer">
        <div class="row custom-row">
          <div class="custom-col custom-col-md-6 custom-col-xl-3">
            <div class="custom-form-group">
                <label><?php _e('Sports'); ?></label>
                    <select name="quick_sports" id="quick_sports" class="custom-form-control">
                      <?php $quick_sportssss = isset($_POST['quick_sports']) ? $_POST['quick_sports'] : ""; ?>
                        <option value=""  >Sports</option>
                        <?php
                        $quick_sports = get_terms([
                                'taxonomy'  => 'sports',
                                'hide_empty'    => false
                        ]);
                        foreach($quick_sports as $tag){ 
                         ?>
                        <option value="<?php echo $tag->term_id;?>" <?php if($tag->term_id == $quick_sportssss){ echo "selected"; } else if($tag->term_id == $_POST['quick_sports']){ echo "selected"; }?>><?php echo $tag->name; ?></option>
                   <?php } ?>
                    </select>
              </div> 
            </div>
            <div class="custom-col custom-col-md-6 custom-col-xl-3">
              <div class="custom-form-group">
                  <label for="quick_target_group"><?php _e('Target group'); ?></label>
                    <select name="quick_target_group" id="quick_target_group" class="custom-form-control">
                      <?php $quick_target_groups = isset($_POST['quick_target_group']) ? $_POST['quick_target_group'] : ""; ?>
                        <option value="" selected >Target group</option>
                        <?php 
                        $quick_target_group = get_terms([
                                'taxonomy'  => 'target_groups',
                                'hide_empty'    => false
                        ]);
                        foreach($quick_target_group as $tag){ ?>
                        <option value="<?php echo $tag->term_id;?>" <?php if($tag->term_id == $quick_target_groups){ echo "selected"; } else if($tag->term_id == $_POST['quick_target_group']){ echo "selected"; } ?>><?php echo $tag->name; ?></option>
                   <?php } ?>
                    </select>
              </div> 
            </div>
            <div class="custom-col custom-col-md-6 custom-col-xl-3">
              <div class="custom-form-group">
                  <label for="quick_district"><?php _e('District'); ?></label>
                  <?php
                  $quick_district_select = isset($_POST['quick_district']) ? $_POST['quick_district'] : "";
                  echo selectClubDistrict('quick_district', $quick_district_select); ?>
              </div> 
            </div>
            <div class="custom-col custom-col-md-6 custom-col-xl-3">
              <div class="custom-form-group">
                  <label for="course_gender"><?php _e('Gender'); ?></label>
                  <?php  $post_id = get_the_id(); echo $post_meta_value = get_post_meta( $post_id, 'course_gender', true );?>
                    <select name="course_gender" id="course_gender" class="custom-form-control">
                        <option value="">All gender</option>
                        <option value="both" <?php selected( $_POST['course_gender'], 'both' ); ?> >Female and Male</option>
                        <option value="male" <?php selected( $_POST['course_gender'], 'male' ); ?>>Only male</option>
                        <option value="female" <?php selected( $_POST['course_gender'], 'female' ); ?>>Only female</option>
                    </select>
              </div> 
            </div>
            <div class="custom-col custom-col-md-6 custom-col-xl-3">
              <div class="custom-form-group">
                  <label for="course_sport_facility"><?php _e('Sport Facility'); ?></label>
                   <select name="course_sport_facility" id="course_sport_facility">
                      <option value="">Select Sport facility</option>
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
                                  <option value="<?php echo $post_id; ?>" <?php if($post_id == $_POST['course_sport_facility']) { echo "selected"; } ?>><?php the_title(); ?></option>
                              <?php }
                              wp_reset_query();
                           ?>
                  </select>
              </div> 
            </div>
            <div class="custom-col custom-col-md-6 custom-col-lg-9">
                <div class="custom-form-group">
                    <div class="custom-row">
                      <div class="custom-col-lg-6"><p>from</p><input type="text" id="offer_from" class="custom-form-control custom-job-time" value="<?php echo $_POST['offer_from']; ?>" name="offer_from" ><p>clock</p></div>
                      <div class="custom-col-lg-6"><p>to</p><input type="text" id="offer_to" name="offer_to" value="<?php echo $_POST['offer_to']; ?>" class="custom-form-control custom-job-time"  ><p>clock</p></div>
                      <div id="monday_error"></div>
                    </div>
                </div>
            </div>
            <div class="custom-col">
              <div class="custom-form-group">
                  <label for="gym_sport_facility" class="weedays-title"><b><?php _e('Weekdays'); ?></b></label>
                    <div class="custom-checkbox-main">
                        <input type="checkbox" name="course_monday" value="course_monday" <?php if('course_monday' == $_POST['course_monday']) echo "checked";?>>
                        <label>Monday</label>
                          <input type="checkbox" name="course_tuesday" value="course_tuesday" <?php if('course_tuesday' == $_POST['course_tuesday']) echo "checked";?>>
                        <label>Tuesday</label>
                          <input type="checkbox" name="course_wednesday" value="course_wednesday" <?php if('course_wednesday' == $_POST['course_wednesday']) echo "checked";?>>
                        <label>Wednesday</label>
                          <input type="checkbox" name="course_thursday" value="course_thursday" <?php if('course_thursday' == $_POST['course_thursday']) echo "checked";?>>
                        <label>Thursday</label>
                          <input type="checkbox" name="course_friday" value="course_friday" <?php if('course_friday' == $_POST['course_friday']) echo "checked";?>>
                        <label>Friday</label>
                          <input type="checkbox" name="course_saturday" value="course_saturday" <?php if('course_saturday' == $_POST['course_saturday']) echo "checked";?>>
                        <label>Saturday</label>
                          <input type="checkbox" name="course_sunday" value="course_sunday" <?php if('course_sunday' == $_POST['course_sunday']) echo "checked";?>>
                        <label>Sunday</label>
                      </div>

              </div> 
          </div>
            <div class="custom-col custom-col-md-6 custom-col-xl-3">
              <div class="custom-form-group">
                <label for="gym_sport_facility"><?php _e('Search'); ?></label>
                  <input type="text" name="searchcourse" id="s" <?php if(is_search()) { ?>value="<?php the_search_query(); ?>" <?php } else { ?>value="<?php if (isset($_POST['searchcourse'])) echo $_POST['searchcourse']; ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"<?php } ?> />
              </div>
          </div>

            

        </div>
         <div class="search-submit contact-footer">
                  <input type="submit" name="searchsubmit"  id="searchsubmit" value="Submit" />
                  <input type="reset" name="searchreset" id="searchreset" class="grey-btn" value="Reset" />
          </div>
</form>  
</div>
<?php
  $posts_array = array();
  $query_array = array();
  $meta_array = array();

$args = array(
    'meta_query' => array(
        array(
            'key' => 'place',
            'value' => $_POST['quick_district'],
            'compare' => '='
        )
    )
);
$member_arr = get_users($args); //finds all users with this meta_key == 'member_id' and meta_value == $member_id passed in url
$user_ids = array();
if ($member_arr) {  // any users found?
  foreach ($member_arr as $user) {
    $user_ids[] = $user->ID;
  } 
}
  if(isset($_POST) && !empty($_POST['quick_sports'])){
      $query_array[] = array(
          'taxonomy' => 'sports',
          'field' => 'term_id',
          'terms' => $_POST['quick_sports'],
      );
  }
  if(isset($_POST) && !empty($_POST['quick_target_group'])){
      $query_array[] = array(
          'taxonomy' => 'target_groups',
          'field' => 'term_id',
          'terms' => $_POST['quick_target_group'],
      );
  }
  if(isset($_POST) && !empty($_POST['course_sport_facility'])){
      $meta_array[] = array(
          'key' => 'course_sport_facility',
          'value' => $_POST['course_sport_facility'],
      );
  }
  if(isset($_POST) && !empty($_POST['course_gender'])){
      $meta_array[] = array(
          'key' => 'course_gender',
          'value' => $_POST['course_gender'],
          'compare'   => '=',
      );
  }

  $offer_from = $_POST['offer_from'];
  $offer_to = $_POST['offer_to'];

  if(isset($_POST) && !empty($_POST['course_monday']) ){           
   $meta_array[] = array(
    'relation' => 'AND',
    array(
          'key' => 'course_monday_from',
          'value' => date("H:i:s", strtotime($offer_from)),
          'compare' => '<=',
          'type' => 'TIME'
      ),
      array(
          'key' => 'course_monday_to',
          'value' => date("H:i:s", strtotime($offer_to)),
          'compare' => '>=',
          'type' => 'TIME'
      )
    );
  }
  if(isset($_POST) && !empty($_POST['course_tuesday']) ){           
   $meta_array[] = array(
    'relation' => 'AND',
    array(
          'key' => 'course_tuesday_from',
          'value' => date("H:i:s", strtotime($offer_from)),
          'compare' => '<=',
          'type' => 'TIME'
      ),
      array(
          'key' => 'course_tuesday_to',
          'value' => date("H:i:s", strtotime($offer_to)),
          'compare' => '>=',
          'type' => 'TIME'
      )
    );
  }
  if(isset($_POST) && !empty($_POST['course_wednesday']) ){           
   $meta_array[] = array(
    'relation' => 'AND',
    array(
          'key' => 'course_wednesday_from',
          'value' => date("H:i:s", strtotime($offer_from)),
          'compare' => '<=',
          'type' => 'TIME'
      ),
      array(
          'key' => 'course_wednesday_to',
          'value' => date("H:i:s", strtotime($offer_to)),
          'compare' => '>=',
          'type' => 'TIME'
      )
    );
  }
  if(isset($_POST) && !empty($_POST['course_thursday']) ){           
   $meta_array[] = array(
    'relation' => 'AND',
    array(
          'key' => 'course_thursday_from',
          'value' => date("H:i:s", strtotime($offer_from)),
          'compare' => '<=',
          'type' => 'TIME'
      ),
      array(
          'key' => 'course_thursday_to',
          'value' => date("H:i:s", strtotime($offer_to)),
          'compare' => '>=',
          'type' => 'TIME'
      )
    );
  }
  if(isset($_POST) && !empty($_POST['course_friday']) ){           
   $meta_array[] = array(
    'relation' => 'AND',
    array(
          'key' => 'course_friday_from',
          'value' => date("H:i:s", strtotime($offer_from)),
          'compare' => '<=',
          'type' => 'TIME'
      ),
      array(
          'key' => 'course_friday_to',
          'value' => date("H:i:s", strtotime($offer_to)),
          'compare' => '>=',
          'type' => 'TIME'
      )
    );
  }
  if(isset($_POST) && !empty($_POST['course_saturday']) ){           
   $meta_array[] = array(
    'relation' => 'AND',
    array(
          'key' => 'course_saturday_from',
          'value' => date("H:i:s", strtotime($offer_from)),
          'compare' => '<=',
          'type' => 'TIME'
      ),
      array(
          'key' => 'course_saturday_to',
          'value' => date("H:i:s", strtotime($offer_to)),
          'compare' => '>=',
          'type' => 'TIME'
      )
    );
  }
  if(isset($_POST) && !empty($_POST['course_sunday']) ){
   $meta_array[] = array(
    'relation' => 'AND',
    array(
          'key' => 'course_sunday_from',
          'value' => date("H:i:s", strtotime($offer_from)),
          'compare' => '<=',
          'type' => 'TIME'
      ),
      array(
          'key' => 'course_sunday_to',
          'value' => date("H:i:s", strtotime($offer_to)),
          'compare' => '>=',
          'type' => 'TIME'
      )
    );
  }
  $args = array(  
      'post_type'      => 'course',
      'post_status' => 'publish',
      'posts_per_page'=> -1,
   );
  if(isset($_POST['searchcourse']) && !empty($_POST['searchcourse'])){
    $args['s'] = $_POST['searchcourse'];
  }
  if(isset($query_array) && !empty($query_array)){
    $args['tax_query'] = $query_array;
  }
  
  if(isset($user_ids) && !empty($user_ids)){
    $args['author'] = implode(',', $user_ids);
  }elseif(isset($_POST['quick_district']) && !empty($_POST['quick_district'])){
    $meta_array[] = array(
    'relation' => 'OR',
    array(
          'key' => 'author',
          'value' => -1,
          'compare'   => 'between',
      )
    );
  }
  if(isset($meta_array) && !empty($meta_array)){
    $args['meta_query'] = $meta_array;
  }
 // echo "<pre>";print_r($args);echo "</pre>";
  $loop = new WP_Query( $args );
  global $post;
  if ( $loop->have_posts() ) : 
    while ( $loop->have_posts() ) : $loop->the_post();
        $post_id = get_the_ID();   ?>
      
<div class="custom-list-item" onclick="location.href='<?php echo get_the_permalink();?>';">
  <div class="list-inner">
            <div class="listing-img">
                <a href="#" alt="">
                  <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_id, 'thumbnail' ) ); ?>" width="80" height="80" alt="">
                </a>
            </div>
            <div class="listing-details">
                <h2><a href="<?php echo get_the_permalink();?>" alt=""><?php the_title(); ?></a></h2>
                <div class="search-listing-table responsive-table">
                  <table>
                        <tbody>
                        <tr>
                            <th>Sports facility :</th>
                            <td><?php $sports_facility_id = get_post_meta($post_id,'course_sport_facility',true);
                                echo $sports_facility_name = get_the_title($sports_facility_id); ?></td>
                        </tr>
                        <tr>
                            <th>Providers :</th>
                            <td><?php $author_id = get_post_field ('post_author', $post_id);
                                      echo get_the_author_meta( 'display_name' , $author_id ); ?></td>
                        </tr>
                        <tr>
                            <th>Events :</th>
                            <td><?php 
$startDateTime = get_post_meta($post_id,'course_start_date',true); 
$endDateTime = get_post_meta($post_id,'course_end_date',true);
$weekInterval = get_post_meta($post_id,'course_frequency',true);
$weekInterval = (!empty($weekInterval)) ? $weekInterval : 0;

$start = new DateTime($startDateTime);
$end = new DateTime( $endDateTime );
$interval = new DateInterval('P1D');

$period = new DatePeriod($start, $interval, $end);

// initialize fake week
$fakeWeek = 0;
$currentWeek = $start->format('W');
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
    if($course_sunday_from){$sundays = "Sunday"; }

       if ($dayOfWeek == $mondays ) { echo $dayOfWeek . ', ' . $date->format('Y-m-d') . ', ' . $course_monday_from. ' to ' . $course_monday_to;break;
      }else if($dayOfWeek == $tuesdays)
      {
         print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ',  ' . $course_tuesday_from. ' to '. $course_tuesday_to;break;
      }else if($dayOfWeek == $wednesdays)
      {
        print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ',  ' . $course_wednesday_from. ' to ' . $course_wednesday_to;break;
      }else if($dayOfWeek == $thursdays)
      {
       print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ',  ' . $course_thursday_from. ' to ' . $course_thursday_to;
       break;
      }
       else if($dayOfWeek == $fridays)
       {
        print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ', ' . $course_friday_from. ' to ' . $course_friday_to;
        break;
      }
      else if($dayOfWeek == $saturdays)
       { 
        print $dayOfWeek . ',   ' . $date->format('Y-m-d') . ',  ' . $course_saturday_from. ' to ' . $course_saturday_to;
        break;
      }
      else if($dayOfWeek == $sundays)
      {
        print $dayOfWeek . ',  ' . $date->format('Y-m-d') . ',  ' . $course_sunday_from. ' to ' . $course_sunday_to;
        break;
      }
   }?></td>
                        </tr>
                        <tr>
                            <th>Sports :</th>
                            <td><?php 
                            $posttags = wp_get_post_terms( $post->ID, 'sports');
                                  if($posttags){ $sports_name = "";  
                                    foreach($posttags as $tag){
                                      $sports_name .= $tag->name.' , '; 
                        } echo rtrim($sports_name, ', '); } ?></td>
                        </tr>
                        <tr>
                            <th>District :</th>
                            <td><?php 
                            $distrId = get_the_author_meta( 'place' , $author_id );
                          echo getDistrictById($distrId);//get_the_author_meta( 'place' , $author_id ); ?></td>
                        </tr>
                        <tr>
                            <th>Target group :</th>
                            <td><?php 
                            $posttags = wp_get_post_terms( $post->ID, 'target_groups');
                                  if($posttags){ $sports_name = "";  
                                    foreach($posttags as $tag){
                                      $sports_name .= $tag->name.' , '; 
                        } echo rtrim($sports_name, ', '); } ?></td>
                        </tr>
                    </tbody>
                   </table>
                </div>
            </div>
      </div>
</div>
<?php
endwhile;
else: ?>
  <div class="custom-list-item">
    <div class="list-inner">
      <span>Records Not Found</span>
    </div>
  </div> </div><?php
      endif; wp_reset_postdata();

get_footer();
