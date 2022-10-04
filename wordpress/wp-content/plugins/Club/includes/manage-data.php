<?php
function fb_add_custom_user_profile_fields( $user ) { 
if (is_user_logged_in()) {
?>
    <h3><?php _e('Contact Information'); ?></h3>
    <div class="manage-data-section">
        <div class="manage-data-form-main custom-row">
            <div class="custom-col">
                <div class="custom-form-group">
                    <input name="contact_info" type="checkbox" value="true" class="custom-checkbox" <?php echo (esc_attr( get_the_author_meta( 'contact_info', $user->ID ) )) ? "checked":"" ?>>
                    <span><b><?php _e('Hide contact information'); ?></b></span>
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="custom-profile-name"><?php _e('Name'); ?><span>*</span></label>
                    <input type="text" name="custom_profile_name" id="custom-profile-name" value="<?php echo esc_attr( get_the_author_meta( 'custom-profile-name', $user->ID ) );  ?>" class="custom-form-control" placeholder="<?php _e('Please enter your name.'); ?>"  />
                    <!-- <span class="custom-validation"></span> -->
                </div> 
            </div>
             <div class="custom-col">
                <div class="custom-form-group">
                    <label for="provider/sport-club"><?php _e('Provider Name / Sports Club Name'); ?></label>
                    <input type="text" name="provider-sport-club" id="provider-sport-club" value="<?php echo esc_attr( get_the_author_meta( 'provider-sport-club', $user->ID ) ); ?>" class="custom-form-control" placeholder="<?php _e('Please enter Provider Name / Sports Club Name.'); ?>"/>
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="profile_email"><?php _e('Email'); ?><span>*</span></label>
                    <input type="email" name="profile_email" id="profile-email" value="<?php echo esc_attr( get_the_author_meta( 'profile-email', $user->ID ) ); ?>" class="custom-form-control" />
                </div> 
            </div>
            <div class="custom-col custom-col-lg-6">
                <div class="custom-form-group">
                    <label for="phone"><?php _e('Phone'); ?><span>*</span></label>
                    <input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="custom-form-control"  />
                </div> 
            </div>
            <div class="custom-col custom-col-lg-6">
                <div class="custom-form-group">
                    <label for="mobile"><?php _e('Mobile'); ?></label>
                    <input type="text" name="mobile" id="mobile" value="<?php echo esc_attr( get_the_author_meta( 'mobile', $user->ID ) ); ?>" class="custom-form-control" oninput="validity.valid||(value='');" />
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="fax"><?php _e('Fax'); ?></label>
                    <input type="text" name="fax" id="fax" value="<?php echo esc_attr( get_the_author_meta( 'fax', $user->ID ) ); ?>" class="custom-form-control" oninput="validity.valid||(value='');"/>
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="home-page"><?php _e('Home Page'); ?></label>
                    <input type="text" name="home-page" id="home-page" value="<?php echo esc_attr( get_the_author_meta( 'home-page', $user->ID ) ); ?>" class="custom-form-control" />
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="contact-person"><?php _e('Contact Person (first name last name)'); ?></label><span>*</span>
                    <input type="text" name="contact_person" id="contact-person" value="<?php echo esc_attr( get_the_author_meta( 'contact-person', $user->ID ) ); ?>" class="custom-form-control"/>
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="contact-time"><?php _e('Contact Time'); ?></label>
                    <input type="text"  name="contact-time" id="contact_time" value="<?php echo esc_attr( get_the_author_meta( 'contact-time', $user->ID ) ); ?>" class="custom-form-control custom-date" /> 
                </div> 
            </div>
            <h4 class="form-title">Address</h4>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="address"><?php _e('Address', 'your_textdomain'); ?><span>*</span></label>
                    <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="custom-form-control" />
                </div> 
            </div>
            <div class="custom-col custom-col-lg-3">
                <div class="custom-form-group">
                    <label for="zip"><?php _e('Zip', 'your_textdomain'); ?><span>*</span></label>
                    <input type="number" name="zip" id="zip" value="<?php echo esc_attr( get_the_author_meta( 'zip', $user->ID ) ); ?>" class="custom-form-control" min="0" oninput="validity.valid||(value='');" onKeyPress="if(this.value.length==5) return false;"/> 
                </div> 
            </div>
            <div class="custom-col custom-col-lg-9">
                <div class="custom-form-group">
                    <label for="mobile"><?php _e('City'); ?></label>
                    <input type="text" name="city" class="custom-form-control" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="custom-form-control" />
                </div>
            </div>
            <div class="custom-col custom-col-lg-9">
                <div class="custom-form-group">
                    <label for="place"><?php _e('Place', 'your_textdomain'); ?><span>*</span></label>
                   <?php $selected = get_the_author_meta( 'place', $user->ID ); ?>
                    <select name="place" id="place" class="custom-form-control">
                        <option value="">Select place</option>
                        <option class="busy" value="1" <?php echo ($selected == "1")?  'selected="selected"' : '' ?>>old town</option>
                        <option class="busy" value="2" <?php echo ($selected == "2")?  'selected="selected"' : '' ?>>Outside Fribourg</option>
                        <option class="busy" value="3" <?php echo ($selected == "3")?  'selected="selected"' : '' ?>>Betzenhausen</option>
                        <option class="busy" value="4" <?php echo ($selected == "4")?  'selected="selected"' : '' ?>>Bruehl</option>
                        <option class="busy" value="5" <?php echo ($selected == "5")?  'selected="selected"' : '' ?>>paves</option>
                        <option class="busy" value="6" <?php echo ($selected == "6")?  'selected="selected"' : '' ?>>Guenterstal</option>
                        <option class="busy" value="7" <?php echo ($selected == "7")?  'selected="selected"' : '' ?>>Haslach</option>
                        <option class="busy" value="8" <?php echo ($selected == "8")?  'selected="selected"' : '' ?>>herders</option>
                        <option class="busy" value="9" <?php echo ($selected == "9")?  'selected="selected"' : '' ?>>Chapel</option>
                        <option class="busy" value="10" <?php echo ($selected == "10")?  'selected="selected"' : '' ?>>landwater</option>
                        <option class="busy" value="11" <?php echo ($selected == "11")?  'selected="selected"' : '' ?>>fief</option>
                        <option class="busy" value="12" <?php echo ($selected == "12")?  'selected="selected"' : '' ?>>littenweiler</option>
                        <option class="busy" value="13" <?php echo ($selected == "13")?  'selected="selected"' : '' ?>>moss forest</option>
                        <option class="busy" value="14" <?php echo ($selected == "14")?  'selected="selected"' : '' ?>>Mundenhof</option>
                        <option class="busy" value="15" <?php echo ($selected == "15")?  'selected="selected"' : '' ?>>Munzingen</option>
                        <option class="busy" value="16" <?php echo ($selected == "16")?  'selected="selected"' : '' ?>>Neuburg</option>
                        <option class="busy" value="17" <?php echo ($selected == "17")?  'selected="selected"' : '' ?>>Oberau</option>
                        <option class="busy" value="18" <?php echo ($selected == "18")?  'selected="selected"' : '' ?>>Opfingen</option>
                        <option class="busy" value="19" <?php echo ($selected == "19")?  'selected="selected"' : '' ?>>drainage field</option>
                        <option class="busy" value="20" <?php echo ($selected == "20")?  'selected="selected"' : '' ?>>St. George</option>
                        <option class="busy" value="21" <?php echo ($selected == "21")?  'selected="selected"' : '' ?>>stuhlinger</option>
                        <option class="busy" value="22" <?php echo ($selected == "22")?  'selected="selected"' : '' ?>>Tiengen</option>
                        <option class="busy" value="23" <?php echo ($selected == "23")?  'selected="selected"' : '' ?>>Vauban</option>
                        <option class="busy" value="24" <?php echo ($selected == "24")?  'selected="selected"' : '' ?>>forest lake</option>
                        <option class="busy" value="25" <?php echo ($selected == "25")?  'selected="selected"' : '' ?>>Waltershofen</option>
                        <option class="busy" value="26" <?php echo ($selected == "26")?  'selected="selected"' : '' ?>>vineyard</option>
                        <option class="busy" value="27" <?php echo ($selected == "27")?  'selected="selected"' : '' ?>>Wiehre</option>
                        <option class="busy" value="28" <?php echo ($selected == "28")?  'selected="selected"' : '' ?>>Zahringen</option>
                    </select>
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="dropdown">Display on Map</label>
                    <?php 
                    //get dropdown saved value
                    $selected = get_the_author_meta( 'display_on_map', $user->ID ); //there was an extra ) here that was not needed 
                    ?>
                    <select name="display_on_map" id="display_on_map">
                        <option value="">Select</option>
                        <option class="busy" value="yes" <?php echo ($selected == "yes")?  'selected="selected"' : '' ?>>Yes</option>
                        <option class="busy" value="no" <?php echo ($selected == "no")?  'selected="selected"' : '' ?>>No</option>
                    </select>
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="dropdown">Main Sports Venue</label>
                     <?php 
                    //get dropdown saved value
                    $selected = get_the_author_meta( 'main_sport_venue', $user->ID ); //there was an extra ) here that was not needed 
                    ?>
                    <select name="main_sport_venue" id="main_sport_venue">
                        <option value="">Select main sports venue</option>
                         <option class="yes" value="yes" <?php echo ($selected == "yes")?  'selected="selected"' : '' ?>>Yes</option>
                        <option class="no" value="no" <?php echo ($selected == "no")?  'selected="selected"' : '' ?>>No</option>
                    </select>
                </div> 
            </div>
            <h4 class="form-title">Short Description</h4>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="short-description"><?php _e('Short Description', 'your_textdomain'); ?></label>
                    <textarea rows="5" cols="100" name="short-description" id="short-description"  class="custom-form-control" /><?php echo esc_attr( get_the_author_meta( 'short-description', $user->ID ) ); ?></textarea>
                </div> 
            </div>
            <h4 class="form-title">Long Description</h4>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="long-description"><?php _e('Long Description', 'your_textdomain'); ?></label>
                    <textarea rows="10" cols="100" name="long-description" id="long-description"  class="custom-form-control" /><?php echo esc_attr( get_the_author_meta( 'long-description', $user->ID ) ); ?></textarea>
                </div> 
            </div>
            
            
            <h4 class="form-title">More Information</h4>
            <!-- <form action="#" method="post" enctype="multipart/form-data">  -->
            <div class="custom-col gym-image"> 
                <img src="<?php echo esc_attr( get_the_author_meta( 'fileToUpload', $user->ID ) ); ?>" style="max-width: 100px;max-height: 100px;">
                <div class="custom-form-group image-upload">
                    <label for="twitter-site"><?php _e('Logo Upload', 'your_textdomain'); ?></label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div> 
            </div>      
            <!-- </form> -->
            <div class="custom-col custom-col-lg-6">
                <div class="custom-form-group">
                    <label for="founding-year"><?php _e('Founding Year', 'your_textdomain'); ?></label>
                    <input type="number" name="founding-year" id="founding-year" value="<?php echo esc_attr( get_the_author_meta( 'founding-year', $user->ID ) ); ?>" class="custom-form-control" min="1" oninput="validity.valid||(value='');" max="<?php echo date('Y'); ?>" onKeyPress="if(this.value.length==4) return false;"/>  
                </div> 
            </div>
            <div class="custom-col custom-col-lg-6">
                <div class="custom-form-group">
                    <label for="amount-of-member"><?php _e('Amount of Members', 'your_textdomain'); ?></label>
                    <input type="number" name="amount-of-member" id="amount-of-member" value="<?php echo esc_attr( get_the_author_meta( 'amount-of-member', $user->ID ) ); ?>" class="custom-form-control" oninput="validity.valid||(value='');" min="0"/> 
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="facebook-site"><?php _e('Facebook Site', 'your_textdomain'); ?></label>
                    <input type="text" name="facebook-site" id="facebook-site" value="<?php echo esc_attr( get_the_author_meta( 'facebook-site', $user->ID ) ); ?>" class="custom-form-control" /> 
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="insta-site"><?php _e('Insta Site', 'your_textdomain'); ?></label>
                    <input type="text" name="insta-site" id="insta-site" value="<?php echo esc_attr( get_the_author_meta( 'insta-site', $user->ID ) ); ?>" class="custom-form-control" /> 
                </div> 
            </div>
            <div class="custom-col">
                <div class="custom-form-group">
                    <label for="twitter-site"><?php _e('Twitter Site', 'your_textdomain'); ?></label>
                    <input type="text" name="twitter-site" id="twitter-site" value="<?php echo esc_attr( get_the_author_meta( 'twitter-site', $user->ID ) ); ?>" class="custom-form-control" /> 
                </div> 
            </div>
        </div>
        
    </div>
        </tr>
    </table>
<?php 
}else{
    $link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
}
}


function fb_save_custom_user_profile_fields( $user_id ) {
    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    } 
    if ( !current_user_can( 'edit_user', $user_id ) )
        return FALSE;

    update_user_meta( $user_id, 'custom-profile-name', $_POST['custom_profile_name'] );
    update_user_meta( $user_id, 'provider-sport-club', $_POST['provider-sport-club'] );
    update_user_meta( $user_id, 'profile-email', $_POST['profile_email'] );
    update_user_meta( $user_id, 'phone', $_POST['phone'] );
    update_user_meta( $user_id, 'mobile', $_POST['mobile'] );
    update_user_meta( $user_id, 'fax', $_POST['fax'] );
    update_user_meta( $user_id, 'home-page', $_POST['home-page'] );
    update_user_meta( $user_id, 'contact-person', $_POST['contact_person'] );
    update_user_meta( $user_id, 'contact-time', $_POST['contact-time'] );
    update_user_meta( $user_id, 'address', $_POST['address'] );
    update_user_meta( $user_id, 'zip', $_POST['zip'] );
	update_user_meta( $user_id, 'city', $_POST['city'] );
    update_user_meta( $user_id, 'place', $_POST['place'] );
    update_user_meta( $user_id, 'short-description', $_POST['short-description'] );
    update_user_meta( $user_id, 'long-description', $_POST['long-description'] );
    update_user_meta( $user_id, 'display_on_map', $_POST['display_on_map'] );
    update_user_meta( $user_id, 'main_sport_venue', $_POST['main_sport_venue'] );
    update_user_meta( $user_id, 'founding-year', $_POST['founding-year'] );
    update_user_meta( $user_id, 'amount-of-member', $_POST['amount-of-member'] );
    update_user_meta( $user_id, 'facebook-site', $_POST['facebook-site'] );
    update_user_meta( $user_id, 'insta-site', $_POST['insta-site'] );
    update_user_meta( $user_id, 'twitter-site', $_POST['twitter-site'] );
    if(isset($_POST['updateuser'])){
           if($_FILES['fileToUpload']['name'] != ''){
        $uploadedfile = $_FILES['fileToUpload'];
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        $imageurl = "";
            if ( $movefile && ! isset( $movefile['error'] ) ) {
               $imageurl = $movefile['url'];
               update_user_meta( $user_id, 'fileToUpload', $imageurl );
            } else {
                echo "error";
               echo $movefile['error'];
            }
        } 
    }
    if(isset( $_POST['contact_info']))
        update_user_meta( $user_id, 'contact_info', $_POST['contact_info']);
}
add_action( 'show_user_profile', 'fb_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'fb_add_custom_user_profile_fields' );

add_action( 'personal_options_update', 'fb_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'fb_save_custom_user_profile_fields' );


function club_manage_data() 
{ 
    if (is_user_logged_in()) {
    global $current_user, $wp_roles;

$error = array();
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
    if ( count($error) == 0 ) {
        do_action('edit_user_profile_update', $current_user->ID);
    }
}
    ?>
        <div id="post-manage-data">
        <div class="entry-content entry">
          <font color="red"><p id = "val"></p></font>
          <?php if(isset($_POST['updateuser'])){ ?><p class="success_message"> Data Updated Successfully.</p> <?php } ?>
                <form method="post" id="adduser" name = "manage_data" enctype="multipart/form-data">
                    <?php 
                        //action hook for plugin and extra fields
                        do_action('edit_user_profile',$current_user); 
                    ?>
                    <p class="form-submit">
                        
                        <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
                        <input name="action" type="hidden" id="action" value="update-user" />
                    </p><!-- .form-submit -->
                </form><!-- #adduser -->
      
        </div><!-- .entry-content -->
    </div>
<?php
}
else{
$link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
} } 
add_shortcode('club_manage_data','club_manage_data');