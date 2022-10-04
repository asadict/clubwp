<?php 
get_header();
$sports_type_tags = get_terms([
          'taxonomy'  => 'sports_type',
          'hide_empty'    => false
        ]);
  $target_group_tags = get_terms([
          'taxonomy'  => 'target_group',
          'hide_empty'    => false
        ]);
// echo "sinflw twmplae";
$id = get_the_id();
$sports_type_tag = wp_get_post_terms($id, 'sports_type', array("fields" => "all"));
// echo "<pre>";
// print_r($sports_type_tag);
$user_id = get_current_user_id();
$author_id = get_post_field( 'post_author', $post->ID); 
?>
<div class="club-jobs-details">
	<h1><?php the_title(); ?></h1>
	<h2><a href="<?php echo "/provider-detail?id=".$author_id; ?>" title="" class="custom-link"><?php echo get_the_author_meta( 'provider-sport-club', $author_id); ?></a></h2>
	<div class="responsive-table">
		<table class="job-table-one">
	        <tbody>
	        <tr>
	            <th>Position :</th>
	            <td><?php $position = get_post_meta($id,'jobs_type_meta_box',true);
	            if($position) 
                echo $position;
            	else echo "-";
	            ?></td>
	        </tr>
	        <tr>
	            <th>Wanted From :</th>
	            <td><?php echo get_post_meta($id,'jobs_starting_day',true); ?></td>
	        </tr>
	        <tr>
	            <th>Sports :</th>
	            <td><?php
	            if($sports_type_tag){ $sports = "";
				foreach ( $sports_type_tag as $tag ) {
   					$sports .= $tag->name . ' , ';
					} 
					echo rtrim($sports, ', '); }
					else echo "-";
 				?></td>
	        </tr>
	        <tr>
	            <th>Sports Facility :</th>
	            <td><a href="<?php echo "/provider-detail?id=".$author_id.'&facility=active' ?>" alt="" class="custom-link" title=""><?php $jobs_sport_facility = get_post_meta($id,'jobs_sport_facility',true);
	            if($jobs_sport_facility) 
                echo get_the_title($jobs_sport_facility);
            	else echo "-";
                            ?></a></td>
	        </tr>
	        <tr>
	            <th>Weekday (s) :</th>
	            <td><?php $days = get_post_meta($id,'jobs_day',true);
	            if($days) 
                echo $days;
            	else echo "-";
            	?></td>
	        </tr>
	        <tr>
	            <th>Period :</th>
	            <td><?php echo get_post_meta($id,'jobs_time_from',true) .' - '.get_post_meta($id,'jobs_time_to',true); ?></td>
	        </tr>
	    </tbody>
	   </table>
	</div>
   <h3>Description</h3>
   <div class="club-jobs-description">
   	 <?php the_content(); ?>
	</div>
	<h3>Desired Qualifications</h3>
   <div class="club-qualification">
   	 <?php echo get_post_meta($id,'jobs_qualifications',true); ?>
	</div>
	<div class="responsive-table">
		<table class="job-table-one">
		        <tbody><tr>
		            <th>Contact Person :</th>
		            <td><?php echo get_post_meta($id,'jobs_contact_person',true); ?></td>
		        </tr>
		        <tr>
		            <th>Phone :</th>
		            <td><?php echo get_post_meta($id,'jobs_phone',true); ?></td>
		        </tr>
		        <tr>
		            <th>Internet Address :</th>
		            <td><a href="<?php echo '//'.get_post_meta($id,'jobs_web',true); ?>" target="_blank" class="custom-link"><?php echo get_post_meta($id,'jobs_web',true); ?></a></td>
		        </tr>
		    </tbody>
		</table>
	</div>
	<?php if(isset($_POST['send_provider_mail'])){ ?>
	<div style="color: green; font-size: 20px;">
	<?php echo "The message was sent successfully."; } ?></div>
	
	<div class="club-jobs-contact">
		<p class="success_message" id="success_message"></p>
    	<form name="contactForm" id="contactForm" method="post" action="">
        	<div class="vendor-contact">
                <h3>Make contact</h3>
                <p><b>Recipient To : </b> <?php echo get_post_meta($id,'jobs_contact_person',true); ?></p>
		          <div class="manage-data-form-main custom-row">
		            <div class="custom-col">
		                <div class="custom-form-group">
		                    <label for="facebook-site">Your Name :</label>
		                    <input id="abs" type="text" class="" name="cf_provider_name" value="">
		                </div> 
		            </div>
		            <div class="custom-col">
		                <div class="custom-form-group">
		                    <label for="insta-site">Your Email Address :</label>
		                    <input id="email" type="text" class="" name="cf_provider_email" value="">
		                </div> 
		            </div>
		            <div class="custom-col">
		                <div class="custom-form-group">
		                    <label for="twitter-site">Your Message :</label>
		                    <textarea id="text" name="cf_provider_message" class=""></textarea>
		                </div> 
		            </div>
		        </div>
                <div class="contact-footer">
                    <input class="btn--primary" type="submit" name="send_provider_mail" value="Send Message">
                </div>
             </div>   
    	</form>
	</div>
</div>
<?php
if(isset($_POST['send_provider_mail'])){ 
	
$author_id = get_post_field( 'post_author', $post->ID);
//echo $author_id;
$to = get_the_author_meta( 'profile-email', $author_id);
//$to = 'php.ict3@gmail.com';
//echo $to;
$subject = 'Sportportal';
$message = $_POST['cf_provider_message'];
$from = $_POST['cf_provider_email'];
$headers = 'From: '. $from;
}
if(isset($_POST['send_provider_mail'])){
	wp_mail( $to, $subject, $message, $headers ); 
}
get_footer();
?>