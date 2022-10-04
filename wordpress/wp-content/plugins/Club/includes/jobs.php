<?php // Our custom post type function
function create_posttype_clubjobs() {
 
    register_post_type( 'clubjobs',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Club Jobs' ),
                'singular_name' => __( 'Club Jobs' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'clubjobs'),
            'supports' => array( 'title', 'editor', 'thumbnail', 'revisions','author','page-attributes'),
            'capability_type'     => 'page'
        )
    );
    $args = array(
        'hierarchical'      => false,
        'labels' => array(
                'name' => __( 'Sports Type Tags' ),
                'singular_name' => __( 'Sports Type Tag' )
            ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'sports_type' ),
    );

    register_taxonomy( 'sports_type', array( 'clubjobs' ), $args );

    $args = array(
        'hierarchical'      => false,
        'labels' => array(
                'name' => __( 'Target Group Tags' ),
                'singular_name' => __( 'Target Group Tag' )
            ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'target_group' ),
    );

    register_taxonomy( 'target_group', array( 'clubjobs' ), $args );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_clubjobs' );

add_action('admin_init', 'custom_meta_boxes_clubjobs', 2);
function custom_meta_boxes_clubjobs() {
add_meta_box(
        'meta-box', 
        __( 'Jobs' ),
        'render_meta_box',
        array('clubjobs'), //post types here
    );}
function render_meta_box()
{
    if (is_user_logged_in()) {
    global $post;
    $jobs_title = get_post_meta($post->ID,'jobs_title', true);
    $jobs_type_meta_box = get_post_meta($post->ID, 'jobs_type_meta_box', true); 
    $jobs_sport_facility = get_post_meta($post->ID, 'jobs_sport_facility', true); 
    $working_place = get_post_meta($post->ID, 'jobs_working_place', true);
    $jobs_contact_person = get_post_meta($post->ID, 'jobs_contact_person', true);
    $jobs_phone = get_post_meta($post->ID, 'jobs_phone', true);
    $jobs_mail = get_post_meta($post->ID, 'jobs_mail', true);
    $jobs_web = get_post_meta($post->ID, 'jobs_web', true); 
    $jobs_starting_day = get_post_meta($post->ID, 'jobs_starting_day', true);
    $jobs_time_from = get_post_meta($post->ID, 'jobs_time_from', true);
    $jobs_time_to = get_post_meta($post->ID, 'jobs_time_to', true);
    $jobs_description = get_post_meta($post->ID, 'jobs_description', true);
    $jobs_qualifications = get_post_meta($post->ID, 'jobs_qualifications', true);
    $day = get_post_meta($post->ID, 'jobs_day', true);
    
    $sports_type_tag = wp_get_post_terms($post->ID, 'sports_type', array("fields" => "all"));
    $target_group_tag = wp_get_post_terms($post->ID, 'target_group', array("fields" => "all"));
    $sports_type_tags = get_terms([
          'taxonomy'  => 'sports_type',
          'hide_empty'    => false
        ]);
    $target_group_tags = get_terms([
          'taxonomy'  => 'target_group',
          'hide_empty'    => false
        ]);
        // if($sports_type_tags){
        //     foreach($sports_type_tags as $tag){
        //         // echo $tag->name;
        //         // echo "<br>";
        //     }
        // }
    //print_r($term_list);
    
    ?>
    <table>
   <tr>
        <th><label>Jobs Type </label></th>
            <td><select name="jobs_type" id="jobs_type">
                    <option value="Federal Voluntary Service" <?php selected( $jobs_type_meta_box, 'Federal Voluntary Service' ); ?>>Federal Voluntary Service</option>
                    <option value="Volunteering" <?php selected( $jobs_type_meta_box, 'Volunteering' ); ?>>Volunteering</option>
                    <option value="Full Time" <?php selected( $jobs_type_meta_box, 'Full Time' ); ?>>Full Time</option>
                    <option value="Trainer" <?php selected( $jobs_type_meta_box, 'Trainer' ); ?>>Trainer</option>
            </select></td>
    </tr>
    <tr>
        <th><label>Sports Facility </label></th>
            <td><select name="jobs_sport_facility" id="jobs_sport_facility">
                    <?php
                                $query = new WP_Query(array(
                                    'post_type' => 'clubgym',
                                    'post_status' => 'publish'
                                ));
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    $post_id = get_the_ID(); ?>
                                    <option value="<?php echo $post_id; ?>" <?php selected( $jobs_sport_facility, $post_id ); ?>><?php the_title(); ?></option>
                                <?php }

                                wp_reset_query();
                             ?>
         </select></td>
    </tr>
    <tr>
        <th><label>Working Place</label></th>
        <td><input type="text" name="jobs-working-place" value="<?php echo $working_place; ?>"></td>
    </tr>
    <tr>
        <th><label>Contact person</label></th>
        <td><input type="text" name="jobs_contact_person" value="<?php echo $jobs_contact_person; ?>"></td>
    </tr>
    <tr>
        <th><label>Phone</label></th>
        <td><input type="number" name="jobs-phone" value="<?php echo $jobs_phone; ?>"></td>
    </tr>
    <tr>
        <th><label>Mail</label></th>
        <td><input type="text" name="jobs_mail" value="<?php echo $jobs_mail; ?>"></td>
    </tr>
    <tr>
        <th><label>Web</label></th>
        <td><input type="text" name="jobs-web" value="<?php echo $jobs_web; ?>"></td>
    </tr>
    <tr>
        <th><label>Starting Day</label></th>
        <td><input type="date" id="contact-start" class="custom-date" name="jobs_starting_day" value="<?php echo $jobs_starting_day; ?>"></td>
    </tr>
    <tr>
        <th><label>Time From</label></th>
        <td><input type="text" id="jobs_time_from" name="jobs-time-from" value="<?php echo $jobs_time_from; ?>" ></td>
    </tr>
    <tr>
        <th><label>Time To</label></th>
        <td><input type="text" id="jobs_time_to" name="jobs_time_to" value="<?php echo $jobs_time_to; ?>"></td>
    </tr>
    
        
        <tr>
        <th><label> Day </label></th>
            <td><?php $jobs_day = explode(' , ', $day); ?>
                <select name="jobs_day[]" id="jobs_day" multiple="true" class="custom-form-control">
                    <option value="Monday" <?php if(in_array('Monday', $jobs_day)){echo "selected";} ?>>Monday</option>
                    <option value="Tuesday" <?php if(in_array('Tuesday', $jobs_day)){echo "selected";} ?>>Tuesday</option>
                    <option value="Wednesday" <?php if(in_array('Wednesday', $jobs_day)){echo "selected";} ?>>Wednesday</option>
                    <option value="Thursday" <?php if(in_array('Thursday', $jobs_day)){echo "selected";} ?>>Thursday</option>
                    <option value="Friday" <?php if(in_array('Friday', $jobs_day)){echo "selected";} ?>>Friday</option>
                    <option value="Saturday" <?php if(in_array('Saturday', $jobs_day)){echo "selected";} ?>>Saturday</option>
                    <option value="Sunday" <?php if(in_array('Sunday', $jobs_day)){echo "selected";} ?>>Sunday</option>
                </select></td>
    </tr>
    
    <tr>
        <th><label>Qualifications needed</label></th>
       <td><textarea name="jobs-qualifications" id="jobs-qualifications" rows="5" cols="40" ><?php echo $jobs_qualifications; ?></textarea></td>
    </tr>
</table>
<?php 
}
      else{
        $link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }
}
function save_clubjobs_post($post_id){ 

    if(isset($_POST["jobs_type"])){
        update_post_meta($post_id, 'jobs_type_meta_box', $_POST['jobs_type']);
    }
    if(isset($_POST["jobs_sport_facility"])){
        update_post_meta($post_id, 'jobs_sport_facility', $_POST['jobs_sport_facility']);
    }
    if(isset($_POST["jobs-working-place"])){
        update_post_meta($post_id, 'jobs_working_place', $_POST['jobs-working-place']);
    }
    if(isset($_POST["jobs_contact_person"])){
        update_post_meta($post_id, 'jobs_contact_person', $_POST['jobs_contact_person']);
    }
    if(isset($_POST["jobs-phone"])){
        update_post_meta($post_id, 'jobs_phone', $_POST['jobs-phone']);
    }
    if(isset($_POST["jobs_mail"])){
        update_post_meta($post_id, 'jobs_mail', $_POST['jobs_mail']);
    }
    if(isset($_POST["jobs-web"])){
        update_post_meta($post_id, 'jobs_web', $_POST['jobs-web']);
    }
    if(isset($_POST["jobs_starting_day"])){
        update_post_meta($post_id, 'jobs_starting_day', $_POST['jobs_starting_day']);
    }
    if(isset($_POST["jobs-time-from"])){
        update_post_meta($post_id, 'jobs_time_from', $_POST['jobs-time-from']);
    }
    if(isset($_POST["jobs_time_to"])){
        update_post_meta($post_id, 'jobs_time_to', $_POST['jobs_time_to']);
    }
    if(isset($_POST["jobs-qualifications"])){
        update_post_meta($post_id, 'jobs_qualifications', $_POST['jobs-qualifications']);
    }
    if( isset($_POST['jobs_day']) ) {
    $day = implode(' , ', $_POST['jobs_day']);
    update_post_meta($post_id, 'jobs_day', $day); 
    }
    
}
add_action('save_post', 'save_clubjobs_post');

function load_clubjobs_template( $template ) {
    global $post;
    if ( 'clubjobs' === $post->post_type && locate_template( array( 'single-clubjobs.php' ) ) !== $template ) {
        return plugin_dir_path( __FILE__ ) . 'single-clubjobs.php';
    }
    return $template;
}
add_filter( 'single_template', 'load_clubjobs_template' );

/** Custom Search for Library */
function search_library($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
 // print_r($wp_query->is_search);
//  print_r($post_type);die;
  if( $wp_query->is_search &&  $post_type = 'clubjobs' )   
  {
   // echo $template;die;
    $template = plugin_dir_path( __FILE__ ) . 'search-clubjobs.php';
  } else{
   // echo "sfdaes";die;
  }  
  return $template;   
}
add_filter('template_include', 'search_library');
