 <?php
 if(isset($_POST['csv_submit']))
   {
   
   $club_id = $_POST['csv_club'];
   $gymID = $_POST['club_facility'];
   $start_date = $_POST['csv_from_date'];
   $end_date = $_POST['csv_end_date'];
   $header_row = array(
       0 => 'Gym name',
       1 => 'Club name',
       2 => 'Start date',
       3 => 'End date',
       4 => 'Parts',
       5 => 'Mondat Start',
       6 => 'Monday end',
       7 => 'Tuesday Start',
       8 => 'Tuesday end',
       9 => 'Wednesday Start',
       10 => 'Wednesday end',
       10 => 'gb_thursday_start',
       11 => 'gb_thursday_end',
       12 => 'gb_friday_start',
       13 => 'gb_friday_end',
       14 => 'gb_saturday_start',
       15 => 'gb_saturday_end',
       16 => 'gb_sunday_start',
       17 => 'gb_sunday_end',
       18 => 'Parts', 
   );
       $data_rows = array();
       global $wpdb, $bp;
       if($club_id)
       {
           $club_id_data = "AND p.post_author = $club_id";
       }
       if($gymID)
       {
           $gym_data = "AND p.ID = $gymID";
       }
       if($start_date)
       {
           $start_date_data = "AND p.post_date BETWEEN '$start_date'";
       }
       if($end_date)
       {
           $end_date_data = "AND '$end_date'";
       }
       $user_data = "SELECT * FROM 6s7hi_posts p 
       LEFT OUTER JOIN 6s7hi_term_relationships r ON r.object_id = p.ID
       LEFT OUTER JOIN 6s7hi_users u ON u.ID = p.post_author
       LEFT OUTER JOIN 6s7hi_postmeta p1 ON p1.post_id = p.ID 
       LEFT OUTER JOIN 6s7hi_term_taxonomy x ON x.term_taxonomy_id = r.term_taxonomy_id 
       LEFT OUTER JOIN 6s7hi_gym_booking g ON g.user_id = p.post_author
       LEFT OUTER JOIN 6s7hi_gym_booking_days gd on gd.gb_id = g.id
       LEFT OUTER JOIN 6s7hi_terms t ON t.term_id = x.term_id WHERE p.post_type = 'clubgym' AND p.post_status = 'publish' 
       $club_id_data $gym_data $start_date_data $end_date_data GROUP BY p.post_author
       ORDER BY p.post_date DESC";
       $users = $wpdb->get_results($user_data);
       foreach ( $users as $u ) {
           $row = array();
           $row[0] = $u->post_title;
           $row[1] = $u->display_name;
           $row[2] = $u->g_startdate;
           $row[3] = $u->g_enddate;
           $row[4] = $u->gym_parts;
           $row[5] = $u->gb_monday_start;
           $row[6] = $u->gb_monday_end;
           $row[7] = $u->gb_tuesday_start;
           $row[8] = $u->gb_tuesday_end;
           $row[9] = $u->gb_wednesday_start;
           $row[10] = $u->gb_wednesday_end;
           $row[11] = $u->gb_thursday_start;
           $row[12] = $u->gb_thursday_end;
           $row[13] = $u->gb_friday_start;
           $row[14] = $u->gb_friday_end;
           $row[15] = $u->gb_sunday_start;
           $row[16] = $u->gb_sunday_end;
           $data_rows[] = $row;
       }
      
       //$fh = @fopen( 'php://output', 'w' );
       $random = rand(1000000000,9999999999);
       $str=rand();
       $rand = sha1($str);
       $path = plugin_dir_path(__DIR__).'exportCsv/';
       $filename = 'export_'.$random.'_'.$rand;
       $fh = @fopen($path.$filename, "w");
       fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
       header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
       header( 'Content-Description: File Transfer' );
       header( 'Content-type: text/csv' );
       header( "Content-Disposition: attachment; filename={$filename}" );
       header( 'Expires: 0' );
       header( 'Pragma: public' );
       fputcsv( $fh, $header_row );
       foreach ( $data_rows as $data_row ) {
           fputcsv( $fh, $data_row );
       }
       fclose( $fh );
       die();
       }
       get_header();
       global $wpdb,$post; ?>
<div class="search-main csv-gym-export">
   <form role="search" method="post" id="quicksearch" name="quicksearch">
      <!--         <input type="hidden" name="post_type" value="clubjobs" /> -->
      <div class="row">
         <div class="custom-col-6 ">
            <div class="row custom-row">
               <div class="custom-col custom-col-md-6 custom-col-xl-6">
                  <div class="custom-form-group">
                     <label><?php _e('Sports club'); ?></label>
                     <select name="csv_club" id="csv_club" class="custom-form-control" >
                        <option value="" selected >Select club</option>
                        <?php $args = array(
                           'role'    => 'club',
                           'order'   => 'ASC'
                           );
                           $users = get_users( $args ); 
                           foreach ($users as $user_data) { ?>
                        <option value="<?php echo $user_data->ID?>" <?php if($user_data->ID == $_POST['csv_club']){ echo "selected"; } ?>><?php echo $user_data->display_name; ?></option>
                        <?php }  ?>
                     </select>
                  </div>
               </div>
               <div class="custom-col custom-col-md-6 custom-col-xl-6">
                  <div class="custom-form-group">
                     <input type="hidden"  name="csv_club_hidden" value="XXX" />
                     <label><?php _e('Sports facility'); ?></label>
                     <select name="club_facility" id="course_sport_facility" class="custom-form-control">
                        <option value="">Select sport facility</option>
                        <?php
                           $query = new WP_Query(array(
                               'post_type' => 'clubgym',
                               'post_status' => 'publish',
                               'posts_per_page' => -1,
                           ));
                           while ($query->have_posts()) {
                               $query->the_post();
                               $post_id = get_the_ID(); ?>
                        <option value="<?php echo $post_id; ?>" <?php if($post_id == $_POST['club_facility']) echo "selected"; ?>><?php the_title(); ?></option>
                        <?php }
                           wp_reset_query();
                           ?>
                     </select>
                  </div>
               </div>
               <div class="custom-col custom-col-md-6 custom-col-xl-6">
                  <div class="custom-form-group">
                     <label><?php _e('From'); ?></label>
                     <input type="date" name="csv_from_date" id="date_timepicker_from">
                  </div>
               </div>
               <div class="custom-col custom-col-md-6 custom-col-xl-6">
                  <div class="custom-form-group">
                     <label><?php _e('To'); ?></label>
                     <input type="date" name="csv_end_date" id="date_timepicker_end">
                  </div>
               </div>
            </div>
         </div>
         <div class="custom-col-3">
            <div class="search-submit contact-footer">
               <input type="submit" name="csv_submit">
            </div>
         </div>
      </div>
   </form>
</div>
<script type="text/javascript">
   $("#csv_club").change(function(){
   $("input[name='csv_club_hidden']").val($(this).val())
   });
</script>
<?php
   $path = plugin_dir_path(__DIR__).'exportCsv/';
    if ($handle = opendir($path)) {
      while (false !== ($file = readdir($handle))) {
             if ($file != "." && $file != "..") {
                   $fileURL= plugin_dir_url( __DIR__ ).'/exportCsv/'.$file.'';
                   $headers = get_headers($fileURL, 1);
                   $date = "Error";
                   if ( $headers && (strpos($headers[0],'200') !== FALSE) ) {
                       $time=strtotime($headers['Last-Modified']);
                       $date=date("d-m-Y H:i:s", $time);
                   }
               $thelist .= '<li><a  download="'.$file.'" href="'.$fileURL.'">'.$file.'</a><span>'.$date.'</span></li>';
             }
          }
     closedir($handle);
     }
   ?>
<h4>Download</h4><h4 class="csv-header">Date</h4>
<ul class="csv-gym-export-listing"><?php echo $thelist; ?></ul> 
