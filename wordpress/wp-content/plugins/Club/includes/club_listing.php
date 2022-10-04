<?php
   function club_listing(){ 
   global $wpdb,$post; 
   include(WP_PLUGIN_DIR. '/Club/comman_function.php');
   ?>
<div class="search-main club-listing">
   <form role="search" method="POST" id="searchform">
      <div class="row custom-row">
         <div class="custom-col custom-col-md-6 custom-col-xl-3">
            <div class="custom-form-group">
               <label for="gym_name"><?php _e('Sports'); ?></label>
               <select name="club_sports" id="club_sports" class="custom-form-control">
                  <option value="" selected >Sports</option>
                  <?php
                     $sports_type_tags = get_terms([
                             'taxonomy'  => 'sports',
                             'hide_empty'    => false
                     ]);
                     foreach($sports_type_tags as $tag){ ?>
                  <option value="<?php echo $tag->term_id;?>" <?php if(isset($_POST['club_sports']) && $tag->term_id == $_POST['club_sports']){ echo "selected"; }?>><?php echo $tag->name; ?></option>
                  <?php } ?>
               </select>
            </div>
         </div>
         <div class="custom-col custom-col-md-6 custom-col-xl-3">
            <div class="custom-form-group">
               <label for="club_target_groups"><?php _e('Zielgruppe'); ?></label>
               <select name="club_target_groups" id="club_target_groups" class="custom-form-control">
                  <option value="" selected >Target group</option>
                  <?php
                     $club_target_groups = get_terms([
                             'taxonomy'  => 'target_groups',
                             'hide_empty'    => false
                     ]);
                     foreach($club_target_groups as $tag){ ?>
                  <option value="<?php echo $tag->term_id;?>" <?php if(isset($_POST['club_target_groups']) && $tag->term_id == $_POST['club_target_groups']){ echo "selected"; }?>><?php echo $tag->name; ?></option>
                  <?php } ?>
               </select>
            </div>
         </div>
         <div class="custom-col custom-col-md-6 custom-col-xl-3">
            <div class="custom-form-group">
               <label for="club_district"><?php _e('District'); ?></label>
               <?php
                  $club_district_select = isset($_POST['club_district']) ? $_POST['club_district'] : "";
                  echo selectClubDistrict('club_district', $club_district_select); ?>
            </div>
         </div>
         <div class="custom-col custom-col-md-6 custom-col-xl-3">
            <div class="custom-form-group">
               <label for="club_provider_type"><?php _e('Provider Type'); ?></label>
               <select name="club_provider_type" id="club_provider_type" class="custom-form-control">
                  <option value="">Select provider type</option>
                  <?php    $club_list = array(
                     'role'    => 'club',
                     'orderby' => 'user_nicename',
                     'order'   => 'ASC'
                     );
                     $users = get_users( $club_list );
                     
                     foreach ( $users as $user ) { ?>
                  <option value="<?php echo $user->ID; ?>" <?php if(isset($_POST['club_provider_type']) && $user->ID == $_POST['club_provider_type']){echo "selected"; } ?>><?php echo $user->display_name; ?></option>
                  <?php } ?>
               </select>
            </div>
         </div>
         <div class="custom-col custom-col-md-6 custom-col-xl-3">
            <div class="custom-form-group">
               <label for="gym_sport_facility"><?php _e('Keyword'); ?></label>
               <input type="text" name="search" id="s" <?php if(is_search()) { ?>value="<?php the_search_query(); ?>" <?php } else { ?>value="" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"<?php } ?> />
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
   $query_array = array();
   
       $args = array(
           'meta_query' => array(
               array(
                   'key' => 'place',
                   'value' => $_POST['club_district'],
                   'compare' => '='
               )
           )
       );
       $club_arr = get_users($args); //finds all users with this meta_key == 'member_id' and meta_value == $member_id passed in url
       $user_ids = array();
       if ($club_arr) {  // any users found?
         foreach ($club_arr as $user_data) {  
           $user_ids[] = $user_data->ID;
         }
       }
       implode(',', $user_ids);
       if(isset($_POST) && !empty($_POST['club_sports'])){
         $query_array[] = array(
             'taxonomy' => 'sports',
             'field' => 'term_id',
             'terms' => $_POST['club_sports'],
         );
         }
       if(isset($_POST) && !empty($_POST['club_target_groups'])){
         $query_array[] = array(
             'taxonomy' => 'target_groups',
             'field' => 'term_id',
             'terms' => $_POST['club_target_groups'],
         );
       }
   
   if(isset($_POST['searchsubmit']))
   {
       $club_provider_type = $_POST['club_provider_type'];
       if($club_provider_type){
         $args = array(  
              'post_type' => 'course',
              's' => $_POST['search'],
              'post_status' => 'publish',
              'tax_query' => $query_array,
              'author'=> $club_provider_type,
              'posts_per_page'=> -1,
              'role'=>'club',
          );
       }
       else
       {
          $args = array(  
              'post_type' => 'course',
              's' => $_POST['search'],
              'post_status' => 'publish',
              'tax_query' => $query_array,
              'author' => (!empty($user_ids)) ? implode(',', $user_ids) : 0,
              'posts_per_page'=> -1,
              'role'=>'club',
          );
       }
   $courseData = new WP_Query( $args );
   
   global $post;
     if ( $courseData->have_posts() ) : 
       while ( $courseData->have_posts() ) : $courseData->the_post();
           $post_id = get_the_ID(); 
           $author_id = get_post_field( 'post_author', $post->ID); ?>
<div class="custom-list-item" onclick="location.href='<?php echo "/provider-detail?id=".$author_id; ?>';">
   <div class="list-inner">
      <div class="listing-img">
         <a href="<?php echo get_the_permalink();?>" alt="">
         <img src="<?php echo get_the_author_meta( 'fileToUpload', $author_id )?>" width="80" height="80" alt="">
         </a>
      </div>
      <div class="listing-details">
         <h2><a href="<?php echo "/provider-detail?id=".$user->ID; ?>" alt="#" class="custom-link"><?php echo get_the_author_meta( 'display_name' , $author_id );; ?></a></h2>
         <div class="search-listing-table responsive-table">
            <table>
               <tbody>
                 <tr><?php $posts = get_posts( array('post_type' => 'course', 'posts_per_page' => -1, 'author' => $author_id) );

                           $author_terms_name = array();
                           foreach ($posts as $p) {
                               $terms = wp_get_object_terms( $p->ID, 'sports');
                               foreach ($terms as $t) {
                                $author_terms_name[] = $t->name;
                               }
                           } ?>
                     <td> 
                        <?php echo implode(', ',$author_terms_name); ?>
                     </td>
                  </tr>
                  <tr>
                     <td class="listing-address"><?php echo get_the_author_meta( 'address', $user->ID ); ?>  <?php echo get_the_author_meta( 'zip', $user->ID ); ?>   <?php echo get_the_author_meta( 'place', $user->ID ); ?></td>
                  </tr>
                  <tr>
                     <td class="listing-phone">Phone :<?php echo get_the_author_meta( 'phone', $user->ID );
                        ?></td>
                  </tr>
                  <tr>
                     <td class="listing-phone"><a><?php echo get_the_author_meta( 'url', $user->ID );
                        ?></a></td>
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
</div>
<?php
   endif; wp_reset_postdata();
   }
   else{
   
   $club_list = array(
   'role'    => 'club',
   'orderby' => 'user_nicename',
   'order'   => 'ASC'
   );
   $users = get_users( $club_list );
   
   foreach ( $users as $user ) { ?>
<div class="custom-list-item" onclick="location.href='<?php echo "/provider-detail?id=".$user->ID; ?>';">
   <div class="list-inner">
      <div class="listing-img">
         <a href="<?php echo get_the_permalink();?>" alt="">
         <img src="<?php echo get_the_author_meta( 'fileToUpload', $user->ID )?>" width="80" height="80" alt="">
         </a>
      </div>
      <div class="listing-details">
         <h2><a href="<?php echo "/provider-detail?id=".$user->ID; ?>" alt="#" class="custom-link"><?php echo $user->display_name; ?></a></h2>
         <div class="search-listing-table responsive-table">
            <table>
               <tbody>
                  <tr><?php $posts = get_posts( array('post_type' => 'course', 'posts_per_page' => -1, 'author' => $user->ID) );

                           $author_terms_name = array();
                           foreach ($posts as $p) {
                               $terms = wp_get_object_terms( $p->ID, 'sports');
                               foreach ($terms as $t) {
                                $author_terms_name[] = $t->name;
                               }
                           } ?>
                     <td> 
                        <?php echo implode(', ',$author_terms_name); ?>
                     </td>
                  </tr>
                  <tr>
                     <td class="listing-address"><?php echo get_the_author_meta( 'address', $user->ID ); ?>  <?php echo get_the_author_meta( 'zip', $user->ID ); ?>   <?php echo get_the_author_meta( 'place', $user->ID ); ?></td>
                  </tr>
                  <tr>
                     <td class="listing-phone">Phone :<?php echo get_the_author_meta( 'phone', $user->ID );
                        ?></td>
                  </tr>
                  <tr>
                     <td class="listing-phone"><a><?php echo get_the_author_meta( 'url', $user->ID );
                        ?></a></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php
}
}
}
add_shortcode('ClubListing','club_listing');