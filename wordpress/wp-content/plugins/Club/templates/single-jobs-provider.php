<?php 
get_header();
if(isset($_GET['id']))
{
  $user_id = $_GET['id'];
?>

<div class="tab-section">
<div class="custom-card tab-view-main">
        <div class="tab-header">
            <h2 class="left"><?php echo get_the_author_meta( 'custom-profile-name', $user_id); ?></h2>
            <!-- <div class="print-icon right"><span class="dashicons dashicons-printer"></span></div> -->
        </div>
        <div class="tab-head-details">
          <a href="<?php echo get_the_permalink();?>" alt="">
                <img src="<?php echo get_the_author_meta( 'fileToUpload', $user_id )?>" width="80" height="80" alt="">
            </a>
    </div>
    <hr>
  <div class="tab">
    <?php if(isset($_GET['contact'])){ ?>
    <button class="tablinks" onclick="openCity(event, 'Home')">Home</button>
    <button class="tablinks" onclick="openCity(event, 'Offer')" >Offers</button>
    <button class="tablinks" onclick="openCity(event, 'Sports facilities')">Sports Facilities</button>
    <button class="tablinks active" onclick="openCity(event, 'Contact')" id="defaultOpen">Contact</button>
    <?php } else if(isset($_GET['facility'])){ ?>
    <button class="tablinks" onclick="openCity(event, 'Home')">Home</button>
    <button class="tablinks" onclick="openCity(event, 'Offer')" >Offers</button>
    <button class="tablinks active" onclick="openCity(event, 'Sports facilities')" id="defaultOpen">Sports Facilities</button>
    <button class="tablinks" onclick="openCity(event, 'Contact')" >Contact</button>
    <?php } else if(isset($_GET['offer'])){ ?>
    <button class="tablinks" onclick="openCity(event, 'Home')">Home</button>
    <button class="tablinks active" onclick="openCity(event, 'Offer')" >Offers</button>
    <button class="tablinks " onclick="openCity(event, 'Sports facilities')" id="defaultOpen">Sports Facilities</button>
    <button class="tablinks" onclick="openCity(event, 'Contact')" >Contact</button>
    <?php } else{ ?>
    <button class="tablinks" onclick="openCity(event, 'Home')" id="defaultOpen">Home</button>
    <button class="tablinks" onclick="openCity(event, 'Offer')" >Offers</button>
    <button class="tablinks" onclick="openCity(event, 'Sports facilities')">Sports Facilities</button>
    <button class="tablinks" onclick="openCity(event, 'Contact')" >Contact</button>
  <?php } ?>
  </div>
</div>

<div id="Home" class="tabcontent custom-card">
  <h2>Information on <?php echo get_the_author_meta( 'custom-profile-name', $user_id); ?></h2>
  <div class="responsive-table">
    <table class="search-table">
          <tbody>
          <tr>
              <th>Founding Year :</th>
              <td><?php echo esc_attr( get_the_author_meta( 'founding-year', $user_id ) ); ?></td>
          </tr>
          <tr>
              <th>Number of Members :</th>
              <td><?php echo esc_attr( get_the_author_meta( 'amount-of-member', $user_id ) ); ?></td>
          </tr>
          <tr>
              <th>Sports :</th>
              <?php $posts = get_posts( array('post_type' => 'course', 'posts_per_page' => -1, 'author' => $user_id) );
              $author_terms_name = array();
              foreach ($posts as $p) {
                  $terms = wp_get_object_terms( $p->ID, 'sports');
                  foreach ($terms as $t) {
                   $author_terms_name[] = $t->name;
                  }
              } ?>
              <td><?php echo implode(', ',$author_terms_name); ?></td>
          </tr>
          <tr>
              <th>Facebook :</th>
              <td><?php echo esc_attr( get_the_author_meta( 'facebook-site', $user_id ) );?>
              </td>
          </tr>
      </tbody>
     </table>
  </div>
  <div class="selfdescription">
    <p><?php echo esc_attr( get_the_author_meta( 'long-description', $user_id ) ); ?></p>
  </div>
  <div class="contact-footer">
        <div><a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="custom-link">Back to the List</a></div>
    </div>
</div>

<?php if(isset($_GET['Offer'])) { ?>
<div id="Offer" class="tabcontent" style="display: block;">
  <?php } else { ?>
<div id="Offer" class="tabcontent">
  <?php }
      $query = new WP_Query(array(
          'author' => $user_id,
          'post_type' => 'course',
          'post_status' => 'publish',
          'posts_per_page' => -1
      ));
      while ($query->have_posts()) :
          $query->the_post();
          $post_id = get_the_id();
   ?>
  <div class="listing custom-list-item" onclick="location.href='<?php echo get_the_permalink(); ?>';">
  <div class="list-inner">
            <div class="listing-img">
                <a href="#" alt="">
                  <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_id, 'thumbnail' ) ); ?>" width="80" height="80" alt="">
                </a>
            </div>
            <div class="listing-details">
                <h2><a href="<?php echo get_the_permalink(); ?>" alt=""><?php the_title(); ?></a></h2>
                <div class="search-listing-table responsive-table">
                  <table>
                        <tbody>
                        <tr>
                            <th>Sports facility:</th>
                            <?php $course_sport_facility = get_post_meta($id, 'course_sport_facility', true);
                            $course_sport_facility_name = get_the_title($course_sport_facility); ?>
                            <td><?php echo $course_sport_facility_name; ?></td>
                        </tr>
                        <tr>
                            <th>Providers :</th>
                            <td><?php echo get_the_author_meta( 'custom-profile-name', $user_id); ?></td>
                        </tr>
                        <tr>
                            <th>Events:</th>
                            <td><?php echo $date = date('Y-m-d'); ?></td>
                        </tr>
                        <tr>
                            <th>Sports :</th>
                            <?php $sports = get_the_terms($id, 'sports');
                                  $types ='';
                                  foreach($sports as $term_single) {
                                       $types .= ucfirst($term_single->slug).', ';
                                  }
                                  $sports_data = rtrim($types, ', '); ?>
                            <td><?php echo $sports_data; ?></td>
                        </tr>
                        <tr>
                            <th>District :</th>
                            <td><?php echo get_the_author_meta( 'place', $user_id); ?></td>
                        </tr>
                        <tr>
                            <th>Target groups :</th>
                            <?php $target_groups = get_the_terms($id, 'target_groups');
                                  $types ='';
                                  foreach($target_groups as $term_single) {
                                       $types .= ucfirst($term_single->slug).', ';
                                  }
                                  $target_groups_data = rtrim($types, ', '); ?>
                            <td><?php echo $target_groups_data; ?></td>
                        </tr>
                        
                    </tbody>
                   </table>
                </div>
            </div>
</div>
</div>
<?php endwhile;  ?>
</div>

<?php if(isset($_GET['facility'])) { ?>
<div id="Sports facilities" class="tabcontent" style="display: block;">
  <?php } else { ?>
<div id="Sports facilities" class="tabcontent">
  <?php }
                $query = new WP_Query(array(
                    'author' => $user_id,
                    'post_type' => 'clubgym',
                    'post_status' => 'publish',
                    'posts_per_page' => -1
                ));
                while ($query->have_posts()) :
                    $query->the_post();
                    $post_id = get_the_id();
             ?>
  <div class="listing custom-list-item" onclick="location.href='<?php echo get_the_permalink(); ?>'">
  <div class="list-inner">
            <div class="listing-img">
                <a href="#" alt="">
                  <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_id, 'thumbnail' ) ); ?>" width="80" height="80" alt="">
                </a>
            </div>
            <div class="listing-details">
                <h2><a href="<?php echo get_the_permalink(); ?>" alt=""><?php the_title(); ?></a></h2>
                <div class="search-listing-table responsive-table">
                  <table>
                        <tbody>
                        <tr>
                            <th>Sports :</th>
                            <td><?php echo get_post_meta($post_id, 'gym_sport_facility', true); ?></td>
                        </tr>
                        <tr>
                            <th>District :</th>
                            <td><?php echo get_post_meta($post_id, 'gym_district', true); ?></td>
                        </tr>
                        <tr>
                            <th>Plant Type :</th>
                            <td><?php echo get_post_meta($post_id, 'gym_sport_facility', true); ?></td>
                        </tr>
                        <tr>
                            <th>Address :</th>
                            <td><?php echo get_post_meta($post_id, 'gym_address', true); ?></td>
                        </tr>
                    </tbody>
                   </table>
                </div>
            </div>
</div>
</div>
<?php endwhile;  ?>
</div>
<?php if(isset($_GET['contact'])){ ?>
<div id="Contact" class="tabcontent contact-card-main custom-card" style="display: block;">
<?php }else{ ?>
<div id="Contact" class="tabcontent contact-card-main custom-card">
<?php } ?>
  <h2 class="contact-heading">Contact details for <?php echo get_the_author_meta( 'display_name', $user_id); ?></h2>
   <?php echo get_the_author_meta( 'address', $user->ID ); ?> <br> <?php echo get_the_author_meta( 'zip', $user->ID ); ?>   <?php echo get_the_author_meta( 'place', $user->ID ); ?>
  <div class="row custom-row">
    <div class="custom-col custom-col-md-6">
     <div class="contact-card-details">
       <div class="contact-card">
          <h3><?php echo esc_attr( get_the_author_meta( 'custom-profile-name', $user_id ) ); ?></h3>
          <p>General Contact</p>
          <span>Phone</span>
          <p><?php echo esc_attr( get_the_author_meta( 'phone', $user_id ) ); ?></p>
          <span>Mobile</span>
          <p><?php echo esc_attr( get_the_author_meta( 'mobile', $user_id ) ); ?></p>
          <span>Fax</span>
          <p><?php echo esc_attr( get_the_author_meta( 'fax', $user_id ) ); ?></p>
          <span>Web</span>
          <p><a href="<?php echo esc_attr( get_the_author_meta( 'home-page', $user_id ) ); ?>" target="_blank" class="custom-link"><?php echo esc_attr( get_the_author_meta( 'home-page', $user_id ) ); ?></a></p>
          <span>Contact Times</span>
          <p><?php echo esc_attr( get_the_author_meta( 'contact-time', $user_id ) ); ?></p>
      </div>
          <div class="contact-footer">
            <div><a href="#" class="custom-link">Back to the List</a></div>
        </div>
     </div>
    </div>

    <div class="custom-col custom-col-md-6">
          <?php if(isset($_POST['submit_jobs_provider'])){ ?>

  <p style="color: green; font-size: 16px;"><?php echo "The message was sent successfully."; } ?></p>
      <form method="post" id="jobs_provider" name="jobs_provider">
      <div class="contact-form">
        <h3>Make Contact</h3>
       <div class="row custom-row">
         <div class="custom-col">
            <div class="custom-form-group">
              <label for="gym_name">Recipient</label>
                <select name="facility" id="facility" class="custom-form-control">
                  <option selected="selected">general request</option>
                    <option><?php echo esc_attr( get_the_author_meta( 'contact-person', $user_id ) ); ?></option>
                </select>
            </div> 
          </div>
          <div class="custom-col">
            <div class="custom-form-group">
              <label for="gym_sport_facility">Your Name :</label>
                <input type="text" name="cf_provider_name" class="custom-form-control"/>
            </div>
          </div>
          <div class="custom-col">
            <div class="custom-form-group">
              <label for="gym_sport_facility">Your Email Address :</label>
                <input type="email" name="cf_provider_email" class="custom-form-control"/>
            </div>
          </div>
          <div class="custom-col">
                <div class="custom-form-group">
                    <label for="short-description">Your Message :</label>
                    <textarea name="cf_provider_message" class="cf_provider_message_error"></textarea>
                </div> 
            </div>
             <div class="custom-col">
                <div class="custom-form-group">
                    <input type="submit" name="submit_jobs_provider" value="Send Message">
                </div> 
            </div>
       
     </div>
   </form>
    </div>
<?php
if(isset($_POST['submit_jobs_provider'])){
$to = get_the_author_meta( 'profile-email', $user_id);
$subject = 'Sportportal';
$message = $_POST['cf_provider_message'];
$from = $_POST['cf_provider_email'];
$headers = 'From: '. $from;
}
if(isset($_POST['submit_jobs_provider'])){
  wp_mail( $to, $subject, $message, $headers ); 
} ?>      
  </div>
</div>
</div>
</div>
<?php
}
else{
  $link = home_url();
  echo "<script>window.location = '".$link."'</script>";
}
?>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<?php
get_footer();
?>

