<?php // Our custom post type function
function create_posttype_course() {
    register_post_type( 'course',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Course' ),
                'singular_name' => __( 'Course' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'course'),
            'supports' => array( 'title', 'editor', 'thumbnail', 'revisions','author','page-attributes'),
            'capability_type'     => 'page'
        )
    );

    /* Upgrade the Author Role */
function author_level_up() {
    // Retrieve the  Author role.
    $role = get_role(  'club' );  
    // Let's add a set  of new capabilities we want Authors to have.
    $role->add_cap(  'edit_pages' );
    $role->add_cap(  'edit_published_pages' );
    $role->add_cap(  'publish_pages' );
}
add_action( 'admin_init', 'author_level_up');

     // register taxonomy
    register_taxonomy('sports', 'course', array('hierarchical' => true, 'label' => 'Sports', 'query_var' => true, 'rewrite' => array( 'slug' => 'sports-category' ), 'supports' => array('author')));

     //register taxonomy for custom post tags
    register_taxonomy('target_groups', 'course', array('hierarchical' => true, 'label' => 'Target Group', 'query_var' => true, 'rewrite' => array( 'slug' => 'sports-category' ), 'supports' => array('author')));
    
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_course' );

add_action('admin_init', 'custom_meta_boxes_course', 2);
function custom_meta_boxes_course() {
add_meta_box(
        'meta-box', 
        __( 'Course' ),
        'render_meta_box_course',
        array('course') //post types here
    );}

/* Tag change checkbox to radio button start */
add_action('add_meta_boxes','mysite_add_meta_boxes',10,2);
    function mysite_add_meta_boxes($post_type, $post) {
    ob_start();
}
add_action('dbx_post_sidebar','mysite_dbx_post_sidebar');

function mysite_dbx_post_sidebar() {
    $html = ob_get_clean();
    $html = str_replace('"checkbox"','"radio"',$html);
    echo $html;
}

/* Tag change checkbox to radio button end */

function render_meta_box_course()
{
    global $post;
    $course_sport_facility = get_post_meta($post->ID, 'course_sport_facility', true); 
    $course_special_offer = get_post_meta($post->ID, 'course_special_offer', true);
    $course_hide = get_post_meta($post->ID, 'course_hide', true); 
    $course_sports = get_post_meta($post->ID, 'course_sports', true); 
    $target_groups = get_post_meta($post->ID, 'target_groups', true);
    $course_description = get_post_meta($post->ID, 'course_description', true);
    $course_sport_trainer = get_post_meta($post->ID,'course_sport_trainer',true);
    $course_holiday = get_post_meta($post->ID, 'course_holiday', true);
    $course_gender = get_post_meta($post->ID, 'course_gender', true);
    $course_type = get_post_meta($post->ID, 'course_type', true);
    $course_cost = get_post_meta($post->ID, 'course_cost', true);
    $course_start_date = get_post_meta($post->ID, 'course_start_date', true);
    $course_end_date =  get_post_meta($post->ID, 'course_end_date', true);
    $course_frequency = get_post_meta($post->ID, 'course_frequency', true);
    $course_start_week = get_post_meta($post->ID, 'course_start_week', true); 
    $course_end_week = get_post_meta($post->ID, 'course_end_week', true);
    $day_time = array('course_monday_from','course_monday_to','course_tuesday_from','course_tuesday_to','course_wednesday_to','course_wednesday_from','course_thursday_from','course_thursday_to','course_friday_from','course_friday_to','course_saturday_from','course_saturday_to','course_sunday_to','course_sunday_from');
    foreach ($day_time as $key => $field) {
            $$field = !empty(get_post_meta($post->ID, $field, true)) ? date("h:i A", strtotime(get_post_meta($post->ID, $field, true))) : '';
    } 

    ?>
    <form id="form1" runat="server">
    <table>
        <tr>
        <th><label>Sports Facility </label></th>
            <td><select name="course_sport_facility" id="course_sport_facility">
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
                            <option value="<?php echo $post_id; ?>" <?php if($post_id == $course_sport_facility) { echo "selected"; } ?>><?php the_title(); ?></option>
                        <?php }
                        wp_reset_query();
                     ?>
            </select></td>
        </tr>
        <tr>
            <th><label>Special offer </label></th>
            <td><input type="checkbox" name="course_special_offer" value="1" <?php if($course_special_offer == "1") {echo "Checked";} else{echo "Unchecked"; } ?>>
                    <?php esc_attr_e( 'Special offer', 'mytheme' ); ?></td>
        </tr>
        <tr>
            <th><label>Hide</label></th>
            <td><input type="checkbox" name="course_hide" value="1" <?php if ($course_hide == "1") {echo "Checked";} else{echo "Unchecked"; } ?>>
                    <?php esc_attr_e( 'Hide', 'mytheme' ); ?></td>
        </tr>
       <tr>
            <th><label>Gender</label></th>
            <td><select name="course_gender" id="course_gender">
                <option>Select gender</option>
                <option value="male" <?php selected( $course_gender, 'male' ); ?>>Männllich</option>
                <option value="female" <?php selected( $course_gender, 'female' ); ?>>Weiblich</option>
                <option value="both" <?php selected( $course_gender, 'both' ); ?>>Beides</option>
              
            </select></td>
        </tr>
        <tr>
            <th><label>Description</label></th>
            <td><textarea name="course_description" id="course_description" rows="5" cols="40" ><?php echo $course_description; ?></textarea></td>
        </tr>
        <tr>
            <th><label>Cost</label></th>
            <td><textarea name="course_cost" id="course_cost" rows="5" cols="40" ><?php echo $course_cost; ?></textarea></td>
        </tr>
        <tr>
        <th><label>Trainer</label></th>
            <td><select name="course_sport_trainer" id="course_sport_trainer">
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
            </select></td>
        </tr>
        <tr>
            <th><label>Type</label></th>
            <td><select name="course_type" id="course_type">
                <option>Select type</option>
                <option value="1" <?php selected( $course_type, '1' ); ?>>Recurring</option>
                <option value="2" <?php selected( $course_type, '2' ); ?>>Short course</option>
                <option value="3" <?php selected( $course_type, '3' ); ?>>Single</option>
            </select></td>
        </tr>
        <tr>
            <th><label>During school holidays?</label></th>
            <td><select name="course_holiday" id="course_holiday">
                <option>Select</option>
                <option value="0" <?php selected( $course_holiday, '0' ); ?>>Yes</option>
                <option value="1" <?php selected( $course_holiday, '1' ); ?>>No</option>
            </select></td>
        </tr>
        <tr>
            <th><label>Starting date</label></th>
            <td><input type="date" class="custom-date" id="course_starting_date" value="<?php echo $course_start_date; ?>" name="course_start_date"></td>
        </tr>
        <tr>
            <th><label>Ending date</label></th>
            <td><input type="date" class="custom-date" id="course_ending_date" value="<?php echo $course_end_date; ?>" name="course_end_date"></td>
        <tr>
            <th><label>Starting calender week</label></th>
            <td><select name="course_start_week" id="course_start_week">
                <option>Select start week</option>
                 <?php for ($i = 1; $i <= 52; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php if($course_start_week == $i){ echo "selected"; } ?> ><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label>Ending calender week</label></th>
            <td><select name="course_end_week" id="course_end_week">
                <option>Select end week</option>
                 <?php for ($i = 1; $i <= 52; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php if($course_end_week == $i){ echo "selected"; }?> ><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th><label>Monday</label></th>
            <td>from<input type="text" id="course_monday_from" name="course_monday_from" value="<?php echo $course_monday_from?>" >Uhr</td>
            <td>to<input type="text" id="course_monday_to" name="course_monday_to" value="<?php echo $course_monday_to; ?>"   >Uhr</td>
        </tr>
        <tr>
            <th><label>Tuesday</label></th>
            <td>from<input type="text" id="course_tuesday_from" name="course_tuesday_from" value="<?php echo $course_tuesday_from?>" >Uhr</td>
            <td>to<input type="text" id="course_tuesday_to" name="course_tuesday_to" value="<?php echo $course_tuesday_to; ?>"   >Uhr</td>
        </tr>
        <tr>
            <th><label>Wednesday</label></th>
            <td>from<input type="text" id="course_wednesday_from" name="course_wednesday_from" value="<?php echo $course_wednesday_from?>" >Uhr</td>
            <td>to<input type="text" id="course_wednesday_to" name="course_wednesday_to" value="<?php echo $course_wednesday_to; ?>"   >Uhr</td>
        </tr>
        <tr>
            <th><label>Thursday</label></th>
            <td>from<input type="text" id="course_thursday_from" name="course_thursday_from" value="<?php echo $course_thursday_from?>" >Uhr</td>
            <td>to<input type="text" id="course_thursday_to" name="course_thursday_to" value="<?php echo $course_thursday_to; ?>"   >Uhr</td>
        </tr>
        <tr>
            <th><label>Friday</label></th>
            <td>from<input type="text" id="course_friday_from" name="course_friday_from" value="<?php echo $course_friday_from?>" >Uhr</td>
            <td>to<input type="text" id="course_friday_to" name="course_friday_to" value="<?php echo $course_friday_to; ?>"   >Uhr</td>
        </tr>
        <tr>
            <th><label>Saturday</label></th>
            <td>from<input type="text" id="course_saturday_from" name="course_saturday_from" value="<?php echo $course_saturday_from?>" >Uhr</td>
            <td>to<input type="text" id="course_saturday_to" name="course_saturday_to" value="<?php echo $course_saturday_to; ?>"   >Uhr</td>
        </tr>
        <tr>
            <th><label>Sunday</label></th>
            <td>from<input type="text" id="course_sunday_from" name="course_sunday_from" value="<?php echo $course_sunday_from?>" >Uhr</td>
            <td>to<input type="text" id="course_sunday_to" name="course_sunday_to" value="<?php echo $course_sunday_to; ?>"   >Uhr</td>
        </tr>
        <tr>
            <th><label>Frequency</label></th>
            <td><select name="course_frequency" id="course_frequency">
                <option value="0">Select</option>
                <option value="1" <?php selected( $course_frequency, '1' ); ?>>Weekly</option>
                <option value="2" <?php selected( $course_frequency, '2' ); ?>>Every two weeks</option>
            </select></td>
        </tr>
    </table>
</form>
<?php
}
function save_course_post($post_id){
    if (array_key_exists('course_special_offer', $_POST)) {
        update_post_meta($post_id, 'course_special_offer', $_POST['course_special_offer']);
    }else{
         update_post_meta($post_id, 'course_special_offer', 0);
    }
    if (array_key_exists('course_hide', $_POST)) {
        update_post_meta($post_id, 'course_hide', $_POST['course_hide']);
    }else{
         update_post_meta($post_id, 'course_hide', 0);
    }
    if(isset($_POST["course_sport_facility"])){
        update_post_meta($post_id, 'course_sport_facility', $_POST['course_sport_facility']);
    }
    if(isset($_POST["course_sports"])){
        update_post_meta($post_id, 'course_sports', $_POST['course_sports']);
    }
    if(isset($_POST["course_sport_trainer"])){
        update_post_meta($post_id, 'course_sport_trainer', $_POST['course_sport_trainer']);
    }
    if (array_key_exists('course_gender', $_POST)) {
        update_post_meta($post_id, 'course_gender', $_POST['course_gender']);
    }
     if (array_key_exists('course_type', $_POST)) {
        update_post_meta($post_id, 'course_type', $_POST['course_type']);
    }
    if (array_key_exists('target_groups', $_POST)) {
        update_post_meta($post_id, 'target_groups', $_POST['target_groups']);
    }
    if (array_key_exists('course_description', $_POST)) {
        update_post_meta($post_id, 'course_description', $_POST['course_description']);
    }
    if (array_key_exists('course_holiday', $_POST)) {
        update_post_meta($post_id, 'course_holiday', $_POST['course_holiday']);
    }
    if (array_key_exists('course_cost', $_POST)) {
        update_post_meta($post_id, 'course_cost', $_POST['course_cost']);
    }
    if (array_key_exists('course_start_date', $_POST)) {
        update_post_meta($post_id, 'course_start_date', $_POST['course_start_date']);
    }
    if (array_key_exists('course_end_date', $_POST)) {
        update_post_meta($post_id, 'course_end_date', $_POST['course_end_date']);
    }
    if (array_key_exists('course_frequency', $_POST)) {
        update_post_meta($post_id, 'course_frequency', $_POST['course_frequency']);
    }
    if (array_key_exists('course_start_week', $_POST)) {
        update_post_meta($post_id, 'course_start_week', $_POST['course_start_week']);
    }
    if (array_key_exists('course_end_week', $_POST)) {
        update_post_meta($post_id, 'course_end_week', $_POST['course_end_week']);
    }
    $day_time = array('course_monday_from','course_monday_to','course_tuesday_from','course_tuesday_to','course_wednesday_to','course_wednesday_from','course_thursday_from','course_thursday_to','course_friday_from','course_friday_to','course_saturday_from','course_saturday_to','course_sunday_to','course_sunday_from');
    foreach ($day_time as $key => $field) {
        $value = !empty($_POST[$field]) ? date("H:i:s", strtotime($_POST[$field] )) : '';
        update_post_meta( $post_id, $field, $value);
    }
    
}
add_action('save_post', 'save_course_post');


function load_course_template( $template ) {
    global $post;
    if ( 'course' === $post->post_type && locate_template( array( 'single-course.php' ) ) !== $template ) {
        return plugin_dir_path( __FILE__ ) . 'single-course.php';
    }
    return $template;
}
add_filter( 'single_template', 'load_course_template' );