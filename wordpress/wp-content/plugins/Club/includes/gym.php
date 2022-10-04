<?php // Our custom post type function
function create_posttype_clubgym() {
 
    register_post_type( 'clubgym',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'GYM' ),
                'singular_name' => __( 'GYM' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'clubgym'),
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions','author'),
            'capability_type'     => 'page'
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_clubgym' );

add_action('admin_init', 'custom_meta_boxes_clubgym', 2);
function custom_meta_boxes_clubgym() {
add_meta_box(
        'meta-box', 
        __( 'GYM' ),
        'render_meta_box_gym',
        array('clubgym'), //post types here
    );}
function render_meta_box_gym()
{
    if (is_user_logged_in()) {
    global $post;
    $gym_hide = get_post_meta($post->ID, 'gym_hide', true);
    $gym_surname = get_post_meta($post->ID, 'gym_surname', true);
    $gym_sport_facility = get_post_meta($post->ID,'gym_sport_facility', true);
    $gym_parts = get_post_meta($post->ID,'gym_parts', true);
    $gym_district = get_post_meta($post->ID,'gym_district', true);
    $gym_street = get_post_meta($post->ID,'gym_street', true);
    $gym_postcode = get_post_meta($post->ID,'gym_postcode', true);
    $gym_city = get_post_meta($post->ID,'gym_city', true);
    $gym_latitude = get_post_meta($post->ID,'gym_latitude', true);
    $gym_longitude = get_post_meta($post->ID,'gym_longitude', true);
    $gym_monday_to = get_post_meta($post->ID,'gym_monday_to', true);
    $gym_monday_from = get_post_meta($post->ID,'gym_monday_from', true);
    $gym_tuesday_to = get_post_meta($post->ID,'gym_tuesday_to', true);
    $gym_tuesday_from = get_post_meta($post->ID,'gym_tuesday_from', true);
    $gym_wednesday_to = get_post_meta($post->ID,'gym_wednesday_to', true);
    $gym_wednesday_from = get_post_meta($post->ID,'gym_wednesday_from', true);
    $gym_thursday_to = get_post_meta($post->ID,'gym_thursday_to', true);
    $gym_thursday_from = get_post_meta($post->ID,'gym_thursday_from', true);
    $gym_friday_to = get_post_meta($post->ID,'gym_friday_to', true);
    $gym_friday_from = get_post_meta($post->ID,'gym_friday_from', true);
    $gym_saturday_to = get_post_meta($post->ID,'gym_saturday_to', true);
    $gym_saturday_from = get_post_meta($post->ID,'gym_saturday_from', true);
    $gym_sunday_to = get_post_meta($post->ID,'gym_sunday_to', true);
    $gym_sunday_from = get_post_meta($post->ID,'gym_sunday_from', true);
    $gym_club_school = get_post_meta($post->ID,'gym_club_school', true);
    $gym_contact_name = get_post_meta($post->ID,'gym_contact_name', true);
    $gym_mail = get_post_meta($post->ID,'gym_mail', true);
    $gym_address = get_post_meta($post->ID,'gym_address', true);
    $gym_phone = get_post_meta($post->ID,'gym_phone', true);
    $gym_fax = get_post_meta($post->ID,'gym_fax', true);
    $gym_home_page = get_post_meta($post->ID,'gym_home_page', true);
    $gym_barrier_free = get_post_meta($post->ID,'gym_barrier_free', true);
    $gym_shower = get_post_meta($post->ID,'gym_shower', true);
    $gym_toilets = get_post_meta($post->ID,'gym_toilets', true);
    $gym_gastranomy = get_post_meta($post->ID,'gym_gastranomy', true);
    $gym_chargeble = get_post_meta($post->ID,'gym_chargeble', true);
    $gym_outdoor = get_post_meta($post->ID,'gym_outdoor', true);
    //$gym_file = get_post_meta($_POST['variable'])
    $gymtimeend = get_post_meta($post->ID,'gymtimeend', true);
    ?>
    <table>
        <tr>
            <th><label>Hide/Show </label></th>
            <td><input type="checkbox" name="gym_hide" value="1" <?php if (get_post_meta($post->ID, 'gym_hide', true)) {echo "Checked";} else{echo "Unchecked"; } ?>>
                    <?php esc_attr_e( 'Hide', 'mytheme' ); ?></td>
        </tr>
        <tr>
            <th><label>Show in Time Tables </label></th>
            <td><input type="checkbox" name="gym_show_timetable" value="1" <?php if (get_post_meta($post->ID, 'gym_show_timetable', true)) {echo "Checked";} else{echo "Unchecked"; } ?>>
                    <?php esc_attr_e( 'Show', 'mytheme' ); ?></td>
        </tr>
                <tr>
            <th><label>GYM Parts</label></th>
            <td><select name="gym_parts" id="gym_parts">
                <option value="1" <?php selected( $gym_parts, '1' ); ?>>1</option>
                <option value="2" <?php selected( $gym_parts, '2' ); ?>>2</option>
                <option value="3" <?php selected( $gym_parts, '3' ); ?>>3</option>
              
            </select></td>
        </tr>
        <tr>
            <th><label>Surname</label></th>
            <td><input type="text" name="gym_surname" value="<?php echo $gym_surname; ?>"></td>
        </tr>
        <tr>
            <th><label>Sport Facility</label></th>
            <td><select name="gym_sport_facility" id="gym_sport_facility">
                <option value="" selected="">Select sport facility</option>
                <option value="swiming" <?php selected( $gym_sport_facility, 'swiming' ); ?>>swiming</option>
                <option value="bath" <?php selected( $gym_sport_facility, 'bath' ); ?>>bath</option>
                <option value="gym" <?php selected( $gym_sport_facility, 'gym' ); ?>>gym</option>
            </select></td>
        </tr>

        <tr>
            <th><label>District</label></th>
            <td><select name="gym_district" id="gym_district">
                <option value="" selected="">Select district</option>
                <option value="district_1" <?php selected( $gym_district, 'district_1' ); ?>>District 1</option>
                <option value="district_2" <?php selected( $gym_district, 'district_2' ); ?>>District 2</option>
                <option value="district_3" <?php selected( $gym_district, 'district_3' ); ?>>District 3</option>
            </select></td>
        </tr>
        <tr>
            <th><label>Street / Number</label></th>
            <td><input type="text" name="gym_street" value="<?php echo $gym_street; ?>"></td>
        </tr>
        <tr>
            <th><label>Post code</label></th>
            <td><input type="number" name="gym_postcode" value="<?php echo $gym_postcode; ?>"></td>
        </tr>
        <tr>
            <th><label>City</label></th>
            <td><input type="text" name="gym_city" value="<?php echo $gym_city; ?>"></td>
        </tr>
        <tr>
            <th><label>Latitude</label></th>
            <td><input type="text" name="gym_latitude" value="<?php echo $gym_latitude; ?>"></td>
        </tr>
        <tr>
            <th><label>Longitude</label></th>
            <td><input type="text" name="gym_longitude" value="<?php echo $gym_longitude; ?>"></td>
        </tr>
        <tr>
            <th><label>Monday</label></th>
            <td>from<input type="text" id="gym_monday_from" name="gym_monday_from" value="<?php echo $gym_monday_from?>" >Uhr</td>
            <td>to<input type="text" id="gym_monday_to" name="gym_monday_to" value="<?php echo $gym_monday_to; ?>"   >Uhr</td>
        </tr>
        <tr>
            <th><label>Tuesday</label></th>
            <td>from<input type="text" id="gym_tuesday_from" name="gym_tuesday_from" value="<?php echo $gym_tuesday_from; ?>" >Uhr</td>
            <td>to<input type="text" id="gym_tuesday_to" name="gym_tuesday_to" value="<?php echo $gym_tuesday_to; ?>"  >Uhr</td>
        </tr>
        <tr>
            <th><label>Wednesday</label></th>
            <td>from<input type="text" id="gym_wednesday_from" name="gym_wednesday_from" value="<?php echo $gym_wednesday_from; ?>" >Uhr</td>
            <td>to<input type="text" id="gym_wednesday_to" name="gym_wednesday_to" value="<?php echo $gym_wednesday_to; ?>" >Uhr</td>
        </tr>
        <tr>
            <th><label>Thursday</label></th>
            <td>from<input type="text" id="gym_thursday_from" name="gym_thursday_from" value="<?php echo $gym_thursday_from; ?>" >Uhr</td>
            <td>to<input type="text" id="gym_thursday_to" name="gym_thursday_to" value="<?php echo $gym_thursday_to; ?>" >Uhr</td>
        </tr>
        <tr>
            <th><label>Friday</label></th>
            <td>from<input type="text" name="gym_friday_from" id="gym_friday_from" value="<?php echo $gym_friday_from; ?>" >Uhr</td>
            <td>to<input type="text" id="gym_friday_to" name="gym_friday_to" value="<?php echo $gym_friday_to; ?>" >Uhr</td>
        </tr>
        <tr>
            <th><label>Saturday</label></th>
            <td>from<input type="text" id="gym_saturday_from" name="gym_saturday_from" value="<?php echo $gym_saturday_from; ?>" >Uhr</td>
            <td>to<input type="text" id="gym_saturday_to" name="gym_saturday_to" value="<?php echo $gym_saturday_to; ?>" >Uhr</td>
        </tr>
        <tr>
            <th><label>Sunday</label></th>
            <td>from<input type="text" id="gym_sunday_from" name="gym_sunday_from" value="<?php echo $gym_sunday_from; ?>" >Uhr</td>
            <td>to<input type="text" id="gym_sunday_to" name="gym_sunday_to" value="<?php echo $gym_sunday_to; ?>" >Uhr</td>
        </tr>
        <tr>
            <th><label>Sports Club / School ?</label></th>
            <td><select name="gym_club_school" id="gym_club_school">
              <option value="abc" <?php selected( $gym_club_school, 'abc' ); ?>>abc</option>
              <option value="xyz" <?php selected( $gym_club_school, 'xyz' ); ?>>xyz</option>
              <option value="abcd" <?php selected( $gym_club_school, 'abcd' ); ?>>abcd</option>
            </select></td>
        </tr>
        <tr>
            <th><label>Contact Person Name</label></th>
            <td><input type="text" name="gym_contact_name" value="<?php echo $gym_contact_name; ?>"></td>
        </tr>
        <tr>
            <th><label>Mail</label></th>
            <td><input type="text" name="gym_mail" value="<?php echo $gym_mail; ?>"></td>
        </tr>
        <tr>
            <th><label>Address</label></th>
            <td><input type="text" name="gym_address" value="<?php echo $gym_address; ?>"></td>
        </tr>
        <tr>
            <th><label>Phone</label></th>
            <td><input type="number" name="gym_phone" value="<?php echo $gym_phone; ?>"></td>
        </tr>
        <tr>
            <th><label>Fax</label></th>
            <td><input type="number" name="gym_fax" value="<?php echo $gym_fax; ?>"></td>
        </tr>
        <tr>
            <th><label>Home Page</label></th>
            <td><input type="text" name="gym_home_page" value="<?php echo $gym_home_page; ?>"></td>
        </tr>
        <tr>
            <th><label>Accessible?</label></th>
            <td><select name="gym_barrier_free" id="gym_barrier_free">
                <option value="" selected="">Select option</option>
                <option value="yes" <?php selected( $gym_barrier_free, 'yes' ); ?>>yes</option>
                <option value="no" <?php selected( $gym_barrier_free, 'no' ); ?>>no</option>
                <option value="no_answer" <?php selected( $gym_barrier_free, 'no_answer' ); ?>>no_answer</option>
            </select></td>
        </tr>
        <tr>
            <th><label>Is there a shower?</label></th>
            <td><select name="gym_shower" id="gym_shower">
                <option value="" selected="">Select option</option>
                <option value="yes" <?php selected( $gym_shower, 'yes' ); ?>>yes</option>
                <option value="no" <?php selected( $gym_shower, 'no' ); ?>>no</option>
                <option value="no_answer" <?php selected( $gym_shower, 'no_answer' ); ?>>no_answer</option>
            </select></td>
        </tr>
        <tr>
            <th><label>Is there a toilet?</label></th>
            <td><select name="gym_toilets" id="gym_toilets">
                <option value="" selected="">Select option</option>
                <option value="yes" <?php selected( $gym_toilets, 'yes' ); ?>>yes</option>
                <option value="no" <?php selected( $gym_toilets, 'no' ); ?>>no</option>
                <option value="no_answer" <?php selected( $gym_toilets, 'no_answer' ); ?>>no_answer</option>
            </select></td>
        </tr>
        <tr>
            <th><label>Is there a possibility of catering?</label></th>
            <td><select name="gym_gastranomy" id="gym_gastranomy">
                <option value="" selected="">Select option</option>
                <option value="yes" <?php selected( $gym_gastranomy, 'yes' ); ?>>yes</option>
                <option value="no" <?php selected( $gym_gastranomy, 'no' ); ?>>no</option>
                <option value="no_answer" <?php selected( $gym_gastranomy, 'no_answer' ); ?>>no_answer</option>
            </select></td>
        </tr>
        <tr>
            <th><label>Does the sports facility have to be paid for?</label></th>
            <td><select name="gym_chargeble" id="gym_chargeble">
                <option value="" selected="">Select option</option>
                <option value="yes" <?php selected( $gym_chargeble, 'yes' ); ?>>yes</option>
                <option value="no" <?php selected( $gym_chargeble, 'no' ); ?>>no</option>
                <option value="no_answer" <?php selected( $gym_chargeble, 'no_answer' ); ?>>no_answer</option>
            </select></td>
        </tr>
        <tr>
            <th><label>Is it an indoor or an outdoor location?</label></th>
            <td><select name="gym_outdoor" id="gym_outdoor">
                <option value="" selected="">Select option</option>
                <option value="Indoor" <?php selected( $gym_outdoor, 'Indoor' ); ?>>Indoor</option>
                <option value="Outdoor" <?php selected( $gym_outdoor, 'Outdoor' ); ?>>no</option>
                <option value="Both" <?php selected( $gym_outdoor, 'Both' ); ?>>Both</option>
            </select></td>
        </tr>
            


</table>
<?php 
}
      else{
        $link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }
}
function save_clubgym_post($post_id){ 
    if (array_key_exists('gym_hide', $_POST)) {
        update_post_meta($post_id, 'gym_hide', $_POST['gym_hide']);
    }else{
         update_post_meta($post_id, 'gym_hide', 0);
    }
    if (array_key_exists('gym_show_timetable', $_POST)) {
        update_post_meta($post_id, 'gym_show_timetable', $_POST['gym_show_timetable']);
    }else{
         update_post_meta($post_id, 'gym_show_timetable', 0);
    }
    if (array_key_exists('gym_sport_facility', $_POST)) {
        update_post_meta($post_id, 'gym_sport_facility', $_POST['gym_sport_facility']);
    }
    if (array_key_exists('gym_parts', $_POST)) {
        update_post_meta($post_id, 'gym_parts', $_POST['gym_parts']);
    }
     if (array_key_exists('gym_surname', $_POST)) {
        update_post_meta($post_id, 'gym_surname', $_POST['gym_surname']);
    }
    if (array_key_exists('gym_district', $_POST)) {
        update_post_meta($post_id, 'gym_district', $_POST['gym_district']);
    }
    if (array_key_exists('gym_street', $_POST)) {
        update_post_meta($post_id, 'gym_street', $_POST['gym_street']);
    }
    if (array_key_exists('gym_postcode', $_POST)) {
        update_post_meta($post_id, 'gym_postcode', $_POST['gym_postcode']);
    }
    if (array_key_exists('gym_city', $_POST)) {
        update_post_meta($post_id, 'gym_city', $_POST['gym_city']);
    }
    if (array_key_exists('gym_latitude', $_POST)) {
        update_post_meta($post_id, 'gym_latitude', $_POST['gym_latitude']);
    }
    if (array_key_exists('gym_longitude', $_POST)) {
        update_post_meta($post_id, 'gym_longitude', $_POST['gym_longitude']);
    }
    if (array_key_exists('gym_monday_to', $_POST)) {
        update_post_meta($post_id, 'gym_monday_to', $_POST['gym_monday_to']);
    }
    if (array_key_exists('gym_monday_from', $_POST)) {
        update_post_meta($post_id, 'gym_monday_from', $_POST['gym_monday_from']);
    }
    if (array_key_exists('gym_tuesday_to', $_POST)) {
        update_post_meta($post_id, 'gym_tuesday_to', $_POST['gym_tuesday_to']);
    }
    if (array_key_exists('gym_tuesday_from', $_POST)) {
        update_post_meta($post_id, 'gym_tuesday_from', $_POST['gym_tuesday_from']);
    }
    if (array_key_exists('gym_wednesday_to', $_POST)) {
        update_post_meta($post_id, 'gym_wednesday_to', $_POST['gym_wednesday_to']);
    }
    if (array_key_exists('gym_wednesday_from', $_POST)) {
        update_post_meta($post_id, 'gym_wednesday_from', $_POST['gym_wednesday_from']);
    }
    if (array_key_exists('gym_thursday_to', $_POST)) {
        update_post_meta($post_id, 'gym_thursday_to', $_POST['gym_thursday_to']);
    }
    if (array_key_exists('gym_thursday_from', $_POST)) {
        update_post_meta($post_id, 'gym_thursday_from', $_POST['gym_thursday_from']);
    }
    if (array_key_exists('gym_friday_to', $_POST)) {
        update_post_meta($post_id, 'gym_friday_to', $_POST['gym_friday_to']);
    }
    if (array_key_exists('gym_friday_from', $_POST)) {
        update_post_meta($post_id, 'gym_friday_from', $_POST['gym_friday_from']);
    }
    if (array_key_exists('gym_saturday_to', $_POST)) {
        update_post_meta($post_id, 'gym_saturday_to', $_POST['gym_saturday_to']);
    }
    if (array_key_exists('gym_saturday_from', $_POST)) {
        update_post_meta($post_id, 'gym_saturday_from', $_POST['gym_saturday_from']);
    }
    if (array_key_exists('gym_sunday_to', $_POST)) {
        update_post_meta($post_id, 'gym_sunday_to', $_POST['gym_sunday_to']);
    }
    if (array_key_exists('gym_sunday_from', $_POST)) {
        update_post_meta($post_id, 'gym_sunday_from', $_POST['gym_sunday_from']);
    }
    if (array_key_exists('gym_club_school', $_POST)) {
        update_post_meta($post_id, 'gym_club_school', $_POST['gym_club_school']);
    }
    if (array_key_exists('gym_contact_name', $_POST)) {
        update_post_meta($post_id, 'gym_contact_name', $_POST['gym_contact_name']);
    }
    if (array_key_exists('gym_mail', $_POST)) {
        update_post_meta($post_id, 'gym_mail', $_POST['gym_mail']);
    }
    if (array_key_exists('gym_address', $_POST)) {
        update_post_meta($post_id, 'gym_address', $_POST['gym_address']);
    }
    if (array_key_exists('gym_phone', $_POST)) {
        update_post_meta($post_id, 'gym_phone', $_POST['gym_phone']);
    }
    if (array_key_exists('gym_fax', $_POST)) {
        update_post_meta($post_id, 'gym_fax', $_POST['gym_fax']);
    }
    if (array_key_exists('gym_home_page', $_POST)) {
        update_post_meta($post_id, 'gym_home_page', $_POST['gym_home_page']);
    }
    if (array_key_exists('gym_barrier_free', $_POST)) {
        update_post_meta($post_id, 'gym_barrier_free', $_POST['gym_barrier_free']);
    }
    if (array_key_exists('gym_shower', $_POST)) {
        update_post_meta($post_id, 'gym_shower', $_POST['gym_shower']);
    }
    if (array_key_exists('gym_toilets', $_POST)) {
        update_post_meta($post_id, 'gym_toilets', $_POST['gym_toilets']);
    }
    if (array_key_exists('gym_gastranomy', $_POST)) {
        update_post_meta($post_id, 'gym_gastranomy', $_POST['gym_gastranomy']);
    }
    if (array_key_exists('gym_chargeble', $_POST)) {
        update_post_meta($post_id, 'gym_chargeble', $_POST['gym_chargeble']);
    }
    if (array_key_exists('gym_outdoor', $_POST)) {
        update_post_meta($post_id, 'gym_outdoor', $_POST['gym_outdoor']);
    }
    if (array_key_exists('gymtimeend', $_POST)) {
        update_post_meta($post_id, 'gymtimeend', $_POST['gymtimeend']);
    }
    
}
add_action('save_post', 'save_clubgym_post');

function load_clubgym_template( $template ) {
    global $post;
    if ( 'clubgym' === $post->post_type && locate_template( array( 'single-clubgym.php' ) ) !== $template ) {
        return plugin_dir_path( __FILE__ ) . 'single-clubgym.php';
    }
    return $template;
}
add_filter( 'single_template', 'load_clubgym_template' );