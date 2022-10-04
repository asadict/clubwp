<?php 
/*
 Template Name: Custom jobs Template
 Template Post Type:  post, page, clubjobs
*/

get_header();
$sports_type_tags = get_terms([
          'taxonomy'  => 'sports_type',
          'hide_empty'    => false
        ]);
  $target_group_tags = get_terms([
          'taxonomy'  => 'target_group',
          'hide_empty'    => false
        ]);
  global $wpdb,$post;
  $district = $wpdb->get_results("select meta_value from {$wpdb->base_prefix}postmeta where meta_key ='jobs_sport_facility'");
  $contact =  $wpdb->get_results("select meta_value from {$wpdb->base_prefix}postmeta where meta_key ='jobs_contact_person'");
  ?>

<div class="search-main">
   <form role="search" method="POST" id="searchform">
      
      <input type="hidden" name="post_type" value="clubjobs" />
        <div class="row custom-row">
          <div class="custom-col custom-col-md-6 custom-col-xl-3">
              <div class="custom-form-group">
                  <label for="gym_name"><?php _e('Sports'); ?></label>
                  <select name="facility" id="facility" class="custom-form-control">
                                <option value="sports" selected disabled>sports</option>
                                <?php
                                if(isset($_POST['facility'])){
                                $facility = $_POST['facility']; 
                              }else{ $facility = ''; }
                                  if($sports_type_tags){
                                    foreach($sports_type_tags as $tag){
                                ?>
                                <option value="<?php echo $tag->term_id;?>" <?php selected($tag->term_id, $facility); ?>><?php echo $tag->name; ?></option>
                           <?php }
                        }
                    ?>
                              </select>
              </div> 
          </div>
          <div class="custom-col custom-col-md-6 custom-col-xl-3">
              <div class="custom-form-group">
                  <label for="gym_sport_facility"><?php _e('Sport Facility'); ?></label>
                    <select id="stadtteil" name="sports_facility" class="no-combobox form-control">
                                  <option value="sports_facility" selected disabled>Sports Facility</option>
                    <?php
                                $query = new WP_Query(array(
                                    'post_type' => 'clubgym',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1
                                ));
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    $post_id = get_the_ID();
                                    if(isset($_POST['sports_facility'])){
                                    $sports_facility = $_POST['sports_facility']; }else{ $sports_facility = '';}?>
                                    <option value="<?php echo $post_id; ?>" <?php selected( $sports_facility, $post_id ); ?>><?php the_title(); ?></option>
                                <?php }

                                // wp_reset_query();
                             ?>
                                </select>
              </div> 
          </div>
          <div class="custom-col custom-col-md-6 custom-col-xl-3">
              <div class="custom-form-group">
                  <label for="gym_sport_facility"><?php _e('Target Group'); ?></label>
                    <select name="target_groups" id="target_groups" class="custom-form-control">
                                <option value="target_group" selected disabled>Target Groups</option>
                                <?php if(isset($_POST['target_groups'])){
                                  $target_group = $_POST['target_groups'];
                                }else{
                                  $target_group = '';
                                }
                                
                                if($target_group_tags){
                                    foreach($target_group_tags as $tag){
                                ?>
                                <option value="<?php echo $tag->term_id; ?>" <?php selected($tag->term_id, $target_group); ?>><?php echo $tag->name; ?></option>
                           <?php }
                        }
                    ?>
                    </select>
              </div> 
          </div>
          <div class="custom-col custom-col-md-6 custom-col-xl-3">
            <div class="custom-form-group">
              <label for="gym_sport_facility"><?php _e('Keyword'); ?></label>
                <input type="text" name="s" id="s" <?php if(is_search()) { ?>value="<?php the_search_query(); ?>" <?php } else { ?>value="" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"<?php } ?> />
            </div>
          </div>
          <div class="custom-col">
              <div class="custom-form-group">
                  <label for="gym_sport_facility" class="weedays-title"><b><?php _e('Weekdays'); ?></b></label>
                    <div class="custom-checkbox-main">
                      <?php 
                      if(isset($_POST['days'])){
                          $days = $_POST['days']; }else{ $days = [];}
                          ?>
                          <input type="checkbox" name="days[]" value="Monday" <?php echo (in_array('Monday' , $days) )  ? "checked" : "" ?>>
                        <label>Monday</label>
                          <input type="checkbox" name="days[]" value="Tuesday" <?php echo (in_array('Tuesday' , $days) )  ? "checked" : "" ?>>
                        <label>Tuesday</label>
                          <input type="checkbox" name="days[]" value="Wednesday" <?php echo (in_array('Wednesday' , $days) )  ? "checked" : "" ?>>
                        <label>Wednesday</label>
                          <input type="checkbox" name="days[]" value="Thursday" <?php echo (in_array('Thursday' , $days) )  ? "checked" : "" ?>>
                        <label>Thursday</label>
                          <input type="checkbox" name="days[]" value="Friday" <?php echo (in_array('Friday' , $days) )  ? "checked" : "" ?>>
                        <label>Friday</label>
                          <input type="checkbox" name="days[]" value="Saturday" <?php echo (in_array('Saturday' , $days) )  ? "checked" : "" ?>>
                        <label>Saturday</label>
                          <input type="checkbox" name="days[]" value="Sunday" <?php echo (in_array('Sunday' , $days) )  ? "checked" : "" ?>>
                        <label>Sunday</label>
                      </div>
              </div> 
          </div>
        </div>
         <div class="search-submit contact-footer">
                  <input type="submit" name="searchsubmit" id="searchsubmit" value="Submit" />
                  <input type="reset" name="searchreset" id="searchreset" class="grey-btn" value="Reset" />
          </div>
</form>  
</div>

<?php 

  $posts_array = array();
  $query_array = array();
  $meta_array = array();
  //print_r($_POST);
  if( isset($_POST['days']) ) {
   $day = implode(' , ', $_POST['days']); }
  if(isset($_POST) && !empty($_POST['facility'])){
      $query_array[] = array(
          'taxonomy' => 'sports_type',
          'field' => 'term_id',
          'terms' => $_POST['facility'],
      );
  }
  if(isset($_POST) && !empty($_POST['target_groups'])){
      $query_array[] = array(
          'taxonomy' => 'target_group',
          'field' => 'term_id',
          'terms' => $_POST['target_groups'],
      );
  }
  if(isset($_POST) && !empty($_POST['sports_facility'])){
      $meta_array[] = array(
          'key' => 'jobs_sport_facility',
          'value' => $_POST['sports_facility'],
      );
  }
    if(isset($_POST) && !empty($_POST['days'])){
      //$values = array_map( 'trim', $_POST['days'] );
      //print_r($values);
      $meta_array[] = array(
          'key' => 'jobs_day',
          'value' =>  $day,
          'compare'   => 'LIKE',
      ); 
  }
 // print_r($meta_array); 
  $args = array(  
       'post_type'      => 'clubjobs',
       's' => $_POST['s'],
       'post_status' => 'publish',
       'tax_query' => $query_array,
       'meta_query'=>$meta_array,
       'posts_per_page'=> -1
   );
  
 
  $loop = new WP_Query( $args );
//  echo "<pre>";print_r($loop);
  global $post;
  if ( $loop->have_posts() ) : 
    while ( $loop->have_posts() ) : $loop->the_post();
        $id = get_the_ID(); 
        $user_id = get_current_user_id();
        $author_id = get_post_field( 'post_author', $post->ID); 
        ?>
      
<div class="custom-list-item" onclick="location.href='<?php echo get_the_permalink();?>';">
  <div class="list-inner">
            <div class="listing-img">
                <a href="<?php echo get_the_permalink();?>" alt="">
                  <img src="<?php echo get_the_author_meta( 'fileToUpload', $author_id )?>" width="80" height="80" alt="">
                </a>
            </div>
            <div class="listing-details">
                <h2><a href="<?php echo get_the_permalink();?>" alt=""><?php the_title(); ?></a></h2>
                <div class="search-listing-table responsive-table">
                  <table>
                        <tbody>
                        <tr>
                            <th>Providers :</th>
                            <td><?php echo get_the_author_meta( 'provider-sport-club', $author_id); ?></td>
                        </tr>
                        <tr>
                            <th>Wanted From :</th>
                            <td><?php echo get_post_meta($id,'jobs_starting_day',true); ?></td>
                        </tr>
                        <tr>
                            <th>Sports :</th>
                            <td><?php 
                           // echo $author_id;
                           // $userr = wp_get_post_terms($post->ID, $author_id, 'sports_type');
                           //  print_r($userr);
                            $posttags = wp_get_post_terms( $post->ID, 'sports_type');
                                  if($posttags){ $sports_name = "";  
                                    foreach($posttags as $tag){
                                      $sports_name .= $tag->name.' , '; 
                        } echo rtrim($sports_name, ', '); } ?></td>
                        </tr>
                        <tr>
                            <th>Sports Facility :</th>
                            <td><?php $jobs_sport_facility = get_post_meta($id,'jobs_sport_facility',true); 
                            echo get_the_title($jobs_sport_facility);
                            ?></td>
                        </tr>
                        <tr>
                            <th>Weekdays :</th>
                            <td><?php echo get_post_meta($id,'jobs_day',true); ?></td>
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
  </div> <?php
      endif; wp_reset_postdata();

get_footer();