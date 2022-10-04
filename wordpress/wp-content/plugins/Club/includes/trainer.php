<?php // Our custom post type function
function create_posttype_trainer() {
 
    register_post_type( 'trainer',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Trainer' ),
                'singular_name' => __( 'Trainer' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'trainer'),
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions','author','page-attributes'),
            'capability_type'     => 'page'
        )
    );
     // register taxonomy
   register_taxonomy( 
'type', //taxonomy 
'trainer', //post-type
array( 
    'hierarchical'  => false, 
    'label'         => __( 'Type','type'), 
    'singular_name' => __( 'Tag', 'type' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'multiple' => false 
));

     //register taxonomy for custom post tags
    
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_trainer' );

/* Upgrade the Author Role */
function author_level_up_trainer() {
    // Retrieve the  Author role.
    $role = get_role(  'club' );  
    // Let's add a set  of new capabilities we want Authors to have.
    $role->add_cap(  'edit_pages' );
    $role->add_cap(  'edit_published_pages' );
    $role->add_cap(  'publish_pages' );
}
add_action( 'admin_init', 'author_level_up_trainer');

/* Tag change checkbox to radio button start */
add_action('add_meta_boxes','mysite_add_meta_boxes_trainer',10,2);
    function mysite_add_meta_boxes_trainer($post_type, $post) {
    ob_start();
}
add_action('dbx_post_sidebar','mysite_dbx_post_sidebar_trainer');

function mysite_dbx_post_sidebar_trainer() {
    $html = ob_get_clean();
    $html = str_replace('"checkbox"','"radio"',$html);
    echo $html;
}

/* Tag change checkbox to radio button end */


add_action('admin_init', 'custom_meta_boxes_trainer', 2);
function custom_meta_boxes_trainer() {
add_meta_box(
        'meta-box', 
        __( 'Trainer' ),
        'render_meta_box_trainer',
        array('trainer') //post types here
    );}

/* Hide view button from backend */
add_filter( 'post_row_actions', 'remove_view_link_cpt' );
function remove_view_link_cpt( $action ) {

    unset ($action['view']);
    return $action;
}

function render_meta_box_trainer()
{
    global $post;
    $trainer_hide = get_post_meta($post->ID, 'trainer_hide', true);
    $trainer_name = get_post_meta($post->ID, 'trainer_name', true); 
    $trainer_email = get_post_meta($post->ID, 'trainer_email', true);
    $trainer_phone = get_post_meta($post->ID, 'trainer_phone', true);
    $trainer_homepage = get_post_meta($post->ID, 'trainer_homepage', true);
    $trainer_type = get_post_meta($post->ID, 'trainer_type', true);

    ?>
    <form id="form1">
    <table>
        
        <tr>
            <th><label>Email</label></th>
            <td><input type="email" name="trainer_email" value="<?php echo $trainer_email; ?>"></td>
        </tr>
        <tr>
            <th><label>Phone</label></th>
            <td><input type="number" name="trainer_phone" value="<?php echo $trainer_phone; ?>"></td>
        </tr>
        <tr>
            <th><label>Homepage</label></th>
            <td><input type="text" name="trainer_homepage" value="<?php echo $trainer_homepage; ?>"></td>
        </tr>
        <tr>
            <th><label>Hide/Show </label></th>
            <td><input type="checkbox" name="trainer_hide" value="1" <?php if (get_post_meta($post->ID, 'trainer_hide', true)) {echo "Checked";} else{echo "Unchecked"; } ?>>
                    <?php esc_attr_e( 'Show', 'mytheme' ); ?></td>
        </tr>
    </table>
</form>
<?php
}
function save_trainer_post($post_id){ 
    if (array_key_exists('trainer_hide', $_POST)) {
        update_post_meta($post_id, 'trainer_hide', $_POST['trainer_hide']);
    }else{
         update_post_meta($post_id, 'trainer_hide', 0);
    }
    if (array_key_exists('trainer_email', $_POST)) {
        update_post_meta($post_id, 'trainer_email', $_POST['trainer_email']);
    }
     if (array_key_exists('trainer_phone', $_POST)) {
        update_post_meta($post_id, 'trainer_phone', $_POST['trainer_phone']);
    }
    if (array_key_exists('trainer_homepage', $_POST)) {
        update_post_meta($post_id, 'trainer_homepage', $_POST['trainer_homepage']);
    }
    if (array_key_exists('trainer_type', $_POST)) {
        update_post_meta($post_id, 'trainer_type', $_POST['trainer_type']);
    }
}
add_action('save_post', 'save_trainer_post');
?>
