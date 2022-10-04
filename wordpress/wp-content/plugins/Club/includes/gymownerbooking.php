<?php 
function gymownerbooking()
{
	global $wp,$wpdb;
		$id ="";
		$post_id = '';
	    global $post;
	if (is_user_logged_in()) 
	{
	    if (isset($_SERVER['HTTPS']) &&
		        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
		        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
		        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		        $protocol = 'https://';
		    	} else {
		        $protocol = 'http://';
		    	}
			    $current_url=$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			    $addform = get_permalink().'?slotbooking';
			    $listing = get_permalink();
			     $current_url2 = $_SERVER['REQUEST_URI'];


	    		$current_user_id = get_current_user_id();



                $args = array(
    'post_type'     => 'clubgym',
    'post_status'   => 'publish',
    'fields'        => 'ids',
    'author' => get_current_user_id()
  );

  $result_query = new WP_Query( $args );

  $ID_array = $result_query->posts;
  $gymdatabooked = implode(',',$ID_array);
  


                ?>

				
				<div class="listing-section">
		  <div class="listing-table-main responsive-table">
		       <table class="listing-table" id="table_detail" align=center cellpadding=10>
		            <thead class="thead">
                
                <tr>
                 

		                    <th>Customer Name</th>
		                    <th>Gym	</th>
		                    <th>Booking Detail</th>
		                </tr>
		           </thead>
		        <tbody class="listing-tbody">
		        	 <?php
                            
                        ;
		        	 // $gymID = ($_POST['gymID']);
        			$gymCustomerData = $wpdb->prefix . "gym_booking";
        			$gymBookingData = $wpdb->prefix . "gym_booking_days";

                  $query_sql = $wpdb->prepare("SELECT $gymCustomerData.user_id,$gymCustomerData.g_id,$gymCustomerData.g_startdate,$gymCustomerData.gym_parts,$gymCustomerData.g_enddate, $gymBookingData.gb_monday_start,$gymBookingData.gb_monday_end,$gymBookingData.gb_tuesday_start,$gymBookingData.gb_tuesday_end,$gymBookingData.gb_wednesday_start,$gymBookingData.gb_wednesday_end,$gymBookingData.gb_thursday_start,$gymBookingData.gb_thursday_end,$gymBookingData.gb_friday_start,$gymBookingData.gb_friday_end,$gymBookingData.gb_saturday_start,$gymBookingData.gb_saturday_end,$gymBookingData.gb_sunday_start,$gymBookingData.gb_sunday_end,$gymCustomerData.g_targetgroup,$gymCustomerData.g_gender FROM $gymCustomerData JOIN $gymBookingData ON $gymBookingData.gb_id = $gymCustomerData.id WHERE $gymCustomerData.g_id IN ($gymdatabooked)");
                        wp_reset_postdata();
    					$getdata = $wpdb->get_results($query_sql);
    					if (!empty($getdata)) 
    					{
    			
						        foreach ( $getdata as $key =>  $gymdataview  ) 
						        {
						                $gymID = $gymdataview->g_id;
						                
						                $author_obj = get_user_by('id', $gymdataview->user_id);
						                $customerName = $author_obj->user_login;
						                $gymName = get_the_title( $gymID );
						               

						        $startDate = $gymdataview->g_startdate;
                                $endDate = $gymdataview->g_enddate;
                                $gymParts = $gymdataview->gym_parts;
                                $monStart = $gymdataview->gb_monday_start;
                                $monEnd = $gymdataview->gb_monday_end;
                                $tueStart = $gymdataview->gb_tuesday_start;
                                $tueEnd = $gymdataview->gb_tuesday_end;
                                $wedStart = $gymdataview->gb_wednesday_start;
                                $wedEnd = $gymdataview->gb_wednesday_end;
                                $thuStart = $gymdataview->gb_thursday_start;
                                $thuEnd = $gymdataview->gb_thursday_end;
                                $friStart = $gymdataview->gb_friday_start;
                                $friEnd = $gymdataview->gb_friday_end;
                                $satStart = $gymdataview->gb_saturday_start;
                                $satEnd = $gymdataview->gb_saturday_end;
                                $sunstart = $gymdataview->gb_sunday_start;
                                $sunEnd = $gymdataview->gb_sunday_start;
                                $targetgroup = $gymdataview->g_targetgroup;
                                $gender = $gymdataview->g_gender;
                ?>
            	<tr>
                <td> <?php echo $customerName; ?></td>
                <td><?php echo $gymName; ?> </td>
                <td><button onclick="show_hide_row('hidden_row<?php echo $key; ?>');" class="view_data_btn">View Details</button></td>
                <tr id="hidden_row<?php echo $key;?>" class="hidden_row">
            <td colspan="4"><table class="gymdetaildata">
                      <tbody>
                       <tr class="gymdetaildate">
                        <td colspan="2"><b>Start Date : </b><?php echo  $startDate;?></td>
                        <td colspan="2"><b>End Date : </b><?php echo  $endDate;?></td>
                      </tr>
                      <tr><td colspan="2"><b>Gym Parts : </b><?php if($gymParts){echo  $gymParts;}else{echo "Whole GYM";}?></td></tr>
                        <tr class="gymdetailinfo">
                        <td colspan="4">Booking Info</td>
                      </tr>
                       <tr class="gymdetailday">
                        <th>Day</th>
                        <th><b>Start Time</b></th>
                        <th><b>End Time</b></th>
                      </tr>
                      <tr>
                            <td>Monday</td>
                            <td><?php if (empty($monStart)) {
                                echo "-";
                             }echo $monStart;?></td>
                            <td><?php if(empty($monEnd)){echo "-";}echo $monEnd;?></td>
                        </tr>
                         <tr>
                            <td>Tuesday</td>
                            <td><?php if(empty($tueStart)){echo "-";}echo $tueStart; ?></td>
                            <td><?php if(empty($tueEnd)){echo "-";}echo $tueEnd; ?></td>
                        </tr>
                        <tr>
                            <td>Wednesday</td>
                            <td><?php if(empty($wedStart)){echo "-";}echo $wedStart; ?></td>
                            <td><?php if(empty($wedEnd)){echo "-";} echo $wedEnd; ?></td>
                        </tr>
                         <tr>
                            <td>Thursday</td>
                            <td><?php if(empty($thuStart)){echo "-";} echo $thuStart; ?></td>
                            <td><?php if(empty($thuEnd)){echo "-";} echo $thuEnd; ?></td>
                        </tr>
                        <tr>
                            <td>Friday</td>
                            <td><?php if(empty($friStart)){echo "-";} echo $friStart; ?></td>
                            <td><?php if(empty($friEnd)){echo "-";} echo $friEnd; ?></td>
                        </tr>
                        <tr>
                            <td>Saturday</td>
                            <td><?php if(empty($satStart)){echo "-";} echo $satStart; ?></td>
                            <td><?php if(empty($satEnd)){echo "-";} echo $satEnd; ?></td>
                        </tr>
                        <tr>
                            <td>Sunday</td>
                            <td><?php if(empty($sunstart)){echo "-";} echo $sunstart; ?></td>
                            <td><?php if(empty($sunstart)){echo "-";} echo $sunEnd; ?></td>
                        </tr>

                        <tr class="gymdetailtarget">
                        <td colspan="2"><b>Target Group : </b><?php echo  $targetgroup;?></td>
                        <td colspan="2"><b>Gender : </b><?php echo $gender;?></td>
                      </tr>
                    </tbody></table></td>
                                </tr>
             <?php 
                 }?>  
            </tr>
            <?php  
                }  else { ?> <tr><td colspan="4" class="norecord"> Records not found.</td></tr><?php }   ?> 
        </tbody>
    </table> 
  </div>
  <script>
    function show_hide_row(row)
                    {
                     $("#"+row).toggle();
                    }

</script>
<style type="text/css">
  table {
    border-collapse: collapse;
  }
  #table_detail .hidden_row {
    display: none;
}
</style>
  	 <div class = "club-custom-pagination">
  	 	<?php 


				if (isset($_GET['delete_id']))
        	 {
                // get value of id that sent from address bar 
                $id = $_GET['delete_id'];
               
                $gymDelete = $wpdb->prepare("DELETE FROM $gymbooking
                 WHERE id = $id");

                    $result = $wpdb->get_results($gymDelete);
                    if ($result)
                    {
                          header('Location: '.$current_url);
                        
                       echo "Deleted Successfully";
                     } 
                     else{
                     	echo "not delete";
                     }

        		}
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

<?php }


else
	{
        $link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }

}
add_shortcode( 'gymownerbooking', 'gymownerbooking' );

ob_start();
?>
