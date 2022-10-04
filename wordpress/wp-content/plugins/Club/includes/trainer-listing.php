<?php
function listing_trainer() {
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
    $addform = get_permalink().'?addtrainer';
    $listing = get_permalink();
    $sports_type_tags = get_terms([
      'taxonomy'  => 'trainer',
      'hide_empty'    => false
    ]);
    if(isset($_POST['trainer-submit']))
    {

        $my_post = array();
        $my_post['post_title']    =  $_POST['trainer_name'];
        $my_post['post_status']   = 'publish';
        $my_post['post_type'] = 'trainer';
        $my_post['post_category'] = array(0);
        // Insert the post into the database
        $post_id = wp_insert_post( $my_post );

        wp_set_post_terms( $post_id, $_POST['target_group'], 'target_group' );
        wp_set_post_terms( $post_id, $_POST['tags'], 'type',true );
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

        if(isset($_POST['trainer-edit'])){
            $post_update = array(
                    'ID'         => $edit_id,
                    'post_title' => $_POST['trainer_name'],
                  );
                wp_update_post( $post_update );
                if (array_key_exists('trainer_hide', $_POST)) {
                    update_post_meta($edit_id, 'trainer_hide', $_POST['trainer_hide']);
                }else{
                     update_post_meta($edit_id, 'trainer_hide', 0);
                }
                if (array_key_exists('gym_district', $_POST)) {
                    update_post_meta($edit_id, 'gym_district', $_POST['gym_district']);
                }
                if (array_key_exists('trainer_email', $_POST)) {
                    update_post_meta($edit_id, 'trainer_email', $_POST['trainer_email']);
                }
                wp_set_post_terms( $edit_id, $_POST['tags_type'] ,'type', false );
                
                echo "<script>window.location = '".$listing."'</script>";
        }
        if($current_url == $editform){ 
            global $post;
            $trainer_email = get_post_meta($edit_id,'trainer_email', true);
            $trainer_hide = get_post_meta($edit_id, 'trainer_hide', true);
            $trainer_phone = get_post_meta($edit_id, 'trainer_phone', true); 
            $trainer_homepage = get_post_meta($edit_id, 'trainer_homepage', true); ?>

        <form method="post" enctype="multipart/form-data" name="trainer_edit_form">
            <div class="manage-data-section gym-form-edit">
                <div class="manage-data-form-main custom-row">
                    <h4 class="form-title">Create Trainer</h4>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <input type="checkbox" name="trainer_hide" class="custom-form-control" value="1" <?php if ($trainer_hide == 1) {echo "checked";}?>>
                            <label for="trainer_hide"><?php _e('Show'); ?></label>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="trainer_name"><?php _e('Name'); ?></label><span>*</span>
                            <input type="text" name="trainer_name" class="custom-form-control" value="<?php echo get_the_title($edit_id); ?>">
                        </div> 
                    </div>
                     <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="trainer_name"><?php _e('Type'); ?></label>
                            <input type="hidden" name="trainer_type" value="<?= $post_id; ?>">
                                <select name="tags_type"  id="frontend-triner-type">
                                    <option selected value="">Select type</option>
                                    <?php $tags = get_the_terms( $edit_id, 'type' );
                                        foreach($tags as $tag_data)
                                        {} ?>
                                    <?php if ( $tags = get_terms( [ 'taxonomy' => 'type', 'hide_empty' => false ] ) ): ?>
                                        <?php foreach ( $tags as $tag ): echo "jdjgdfk"; ?>
                                            <?php echo $has_tag = selected( has_tag( $tag->term_id, $post_id ), true, false ); ?>
                                            <option value="<?= $tag->name; ?>"<?php if($tag->name == $tag_data->name) echo "selected";?>><?= $tag->name; ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="trainer_email"><?php _e('Email'); ?></label>
                            <input type="text" name="trainer_email" class="custom-form-control" value="<?php echo $trainer_email; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="profile-email"><?php _e('Phone'); ?></label>
                            <input type="text" name="trainer_phone" class="custom-form-control" value="<?php echo $trainer_phone; ?>">
                        </div> 
                    </div>
                    <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="phone"><?php _e('Home page'); ?></label>
                            <input type="text" name="trainer_homepage" class="custom-form-control" value="<?php echo $trainer_homepage; ?>">
                        </div> 
                    </div>
                   
                    <div class="custom-col custom-col-md-12">
                        <div class="custom-form-group abort-button">
                            <input type="submit" name="trainer-edit" value="Save" id="save">
                            <a href="<?php the_permalink(); ?>" class="button">Abort</a>
                        </div> 
                    </div>
                </div>         
            </div>
        </form>
       <?php }
    }
    else if( $current_url == $addform){ ?>
    <form method="post" name="trainer_add_form" runat="server">
        <div class="manage-data-section jobs-form">
            <div class="manage-data-form-main custom-row">
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="trainer_name"><?php _e('Name'); ?></label>
                        <input type="text" name="trainer_name" class="custom-form-control">
                    </div> 
                 </div>
                 <div class="custom-col">
                    <div class="custom-form-group"> 
                        <label for="trainer_name"><?php _e('Type'); ?></label>
                        <input type="hidden" name="trainer_type" value="<?= $post_id; ?>">
                            <select name="tags"  id="frontend-triner-type">
                                <option selected value="">Select type</option>
                                <?php if ( $tags = get_terms( [ 'taxonomy' => 'type', 'hide_empty' => false ] ) ): ?>
                                    <?php foreach ( $tags as $tag ): ?>
                                        <?php $has_tag = selected( has_tag( $tag->term_id, $post_id ), true, false ); ?>
                                        <option value="<?= $tag->name; ?>"<?= $has_tag; ?>><?= $tag->name; ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                    </div>
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="custom-profile-name"><?php _e('Email'); ?></label>
                       <input type="email" name="trainer_email" value="<?php echo $trainer_email; ?>">
                        <!-- <span class="custom-validation"></span> -->
                    </div> 
                </div>
                <div class="custom-col">
                        <div class="custom-form-group">
                            <label for="provider/sport-club"><?php _e('Phone'); ?></label>
                            <input type="number" name="trainer_phone" value="<?php echo $trainer_phone; ?>">
                        </div> 
                    </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <label for="provider/sport-club"><?php _e('Home page'); ?></label>
                        <input type="text" name="trainer_homepage" value="<?php echo $trainer_homepage; ?>">
                    </div> 
                </div>
                <div class="custom-col">
                    <div class="custom-form-group">
                        <input type="checkbox" name="trainer_hide" value="1" <?php if (get_post_meta($post->ID, 'trainer_hide', true)) {echo "Checked";} else{echo "Unchecked"; } ?>>
                  <label for="profile-email"><?php _e('Show'); ?></label> 
                    </div> 
                </div>
                <div class="custom-col custom-col-lg-12">
                    <div class="custom-form-group abort-button">
                        <input type="submit" name="trainer-submit" value="Submit">
                        <a href="<?php the_permalink(); ?>" class="button">Abort</a>
                    </div> 
                </div>
            </div> 
        </div>
    </form>
  <?php  } else { ?>
<div class="listing-section">
    <div class="create-listing">
        <a class="button editform" href=<?php echo $listing."?addtrainer" ?>>Add Trainer</a>
    </div>
  <div class="listing-table-main responsive-table">
       <table class="listing-table">
            <thead class="thead">
                
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Homepage</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
           </thead>
        <tbody class="listing-tbody">
            <?php
            $author_id = get_current_user_id();
            $loop = new WP_Query( array( 'post_type' => 'trainer', 'posts_per_page' => 5, 'author' => $author_id, 'paged' => get_query_var('paged') ? get_query_var('paged') : 1 ) );
            if($loop->have_posts()){
            while ( $loop->have_posts() ) : $loop->the_post(); 
                $id = get_the_ID();
                $trainer_name = get_post_meta($id, 'trainer_name', true);
                $trainer_email = get_post_meta($id, 'trainer_email', true); 
                $trainer_phone = get_post_meta( $id, 'trainer_phone',true); 
                $term_names = wp_get_post_terms($id, 'type', array('fields' => 'names')); // returns an array of term names
                $trainer_homepage = get_post_meta($id, 'trainer_homepage', true);
                ?>
            <tr>
                <td> <?php echo the_title(); ?></td>
                 <td> <?php echo implode(', ', $term_names); ?></td>
                <td> <?php echo $trainer_email;?></td>
                <td> <?php echo $trainer_phone;?></td>
               <td> <?php echo $trainer_homepage;?></td>
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
<?php
    }
}
  else{
    $link = '/login-landing/';
    echo "<script>window.location = '".$link."'</script>"; 
  }

}
// register shortcode
add_shortcode('TrainerListing', 'listing_trainer');