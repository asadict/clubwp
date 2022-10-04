<?php
function csv_download() {
   global $wp,$wpdb;
   if (is_user_logged_in()) {
   $user_id = get_current_user_id();
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
       11 => 'gb_thursday_start',
       12 => 'gb_thursday_end',
       13 => 'gb_friday_start',
       14 => 'gb_friday_end',
       15 => 'gb_saturday_start',
       16 => 'gb_saturday_end',
       17 => 'gb_sunday_start',
       18 => 'gb_sunday_end',
       19 => 'Hours',
       20 => 'Weeks',
       21 => 'Total Hours',
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
           $start_date_data = "g_startdate = $start_date";
       }
       if($end_date)
       {
           $end_date_data = "AND '$end_date'";
       }
       $user_data =   "SELECT *, clb_gym_booking_days.* FROM `clb_gym_booking` 
                           INNER JOIN clb_gym_booking_days on clb_gym_booking_days.gb_id = clb_gym_booking.id
                           INNER JOIN clb_posts on clb_posts.post_author = clb_gym_booking.user_id
                           INNER JOIN clb_users  ON clb_users.ID = clb_posts.post_author 
                           WHERE g_startdate <= '$start_date' AND g_enddate >= '$end_date' and clb_gym_booking.g_id = $gymID and clb_gym_booking.user_id = $club_id GROUP BY clb_gym_booking.id";

       $users = $wpdb->get_results($user_data);
       foreach ( $users as $u ) {
           $row = array();
           $gym_name = get_the_title($u->g_id);
           $user_name = get_the_author_meta('display_name', $u->user_id);
           $row[0] = $gym_name;
           $row[1] = $user_name;
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
           $row[15] = $u->gb_saturday_end;
           $row[16] = $u->gb_saturday_end;
           $row[17] = $u->gb_sunday_start;
           $row[18] = $u->gb_sunday_end;
           $row[19] = $u->gym_hours;
           $row[20] = $u->gym_weeks;
           $row[21] = $u->gym_total_hours;
           $data_rows[] = $row;
       }
      
       //$fh = @fopen( 'php://output', 'w' );
      $random = rand(1000000000,9999999999);
      $str=rand();
      $rand = sha1($str);
      $path = plugin_dir_path(__DIR__).'exportCsv/';
      $filename = 'export_'.$random.'_'.$rand.'.csv';
      $now = current_time('mysql', false);
      $table = $wpdb->prefix.'csv_download';
        $data = array('user_id' => $club_id, 'file_name' => $filename, 'created_date' => $now);
        $format = array('%d','%s','%s');
        $wpdb->insert($table,$data,$format);
        $my_id = $wpdb->insert_id;
        $fh = @fopen($path.$filename, "w");
        fputcsv( $fh, $header_row );
       foreach ( $data_rows as $data_row ) {
            $temp = implode(';', $data_row);
            fwrite($fh, $temp);
            fwrite($fh, "\n");
       }

       fclose( $fh );

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
                        <input type="hidden"  name="csv_club_hidden" value="XXX" />
                        <label><?php _e('Sports facility'); ?></label>
                        <select name="club_facility" id="course_sport_facility" class="custom-form-control">
                            <option value="">Select sport facility</option>
				            <?php
				            $query = new WP_Query(array(
					            'post_type' => 'clubgym',
					            'post_status' => 'publish',
					            'posts_per_page' => -1,
					            'author' => $user_id
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
                     <label><?php _e('Sports club'); ?></label>
                     <select name="csv_club" id="csv_club" class="custom-form-control" >
                        <option value="" selected >Select club</option>
                        <option value="<?php echo $user_id; ?>" <?php if($user_id== $_POST['csv_club']){ echo "selected"; } ?>><?php echo get_the_author_meta('display_name',$user_id); ?></option>
                        
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
   $userID = get_current_user_id();
   $query = "SELECT * FROM `6s7hi_csv_download` WHERE user_id = $userID ";
   $users = $wpdb->get_results($query);
   foreach($users as $user_data)
   {
    $fileURL= plugin_dir_url( __DIR__ ).'exportCsv/'.$user_data->file_name.'';
    $thelist .= '<li><a  download="'.$user_data->file_name.'" href="'.$fileURL.'">'.$user_data->file_name.'</a><span>'.$user_data->created_date.'</span></li>';
             }
          
  
   ?>
<h4>Download</h4><h4 class="csv-header">Date</h4>
<ul class="csv-gym-export-listing"><?php echo $thelist; ?></ul> 

<?php
}

      else{
        $link = '/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }
   }
add_shortcode('CsvDownload', 'csv_download');