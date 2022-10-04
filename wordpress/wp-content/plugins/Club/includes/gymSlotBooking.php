<?php
function gymSlotBooking()
{
		global $wp,$wpdb;
		$id ="";
		$post_id = '';
	    global $post;
	    $gymCustomerData = $wpdb->prefix . "gym_booking";
        $gymBookingData = $wpdb->prefix . "gym_booking_days";

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
			    $current_url2 = get_site_url().esc_attr( wp_unslash( $_SERVER['REDIRECT_URL'] ) );


	    		$current_user_id = get_current_user_id();
		$args = array(
	    'post_type' => 'clubgym',
	    'posts_per_page' => -1,
	    'meta_query' => array(
    array(
        'key' => 'gym_show_timetable',
        'value'   => 1
        
    )
)
	);
	$clubgym_query = new WP_Query($args);
?>
					<?php if($current_url == $addform){ ?>
					<form action="" method="post" name="booking_gym">
						 <div class="manage-data-section booking-form">
						 	<div class="manage-data-form-main custom-row">
						 		 <div class="custom-col">
                        			<div class="custom-form-group">
                        				<label for="gym-selection">Gym Selection</label>
                        				<select id="gym-selection" class="gym-selection custom-form-control" name="g_id" required>
									        <option value="">Choose the gym</option>
									        <?php while ($clubgym_query->have_posts()) : $clubgym_query->the_post();
									        	$id = $post->ID;?>
									        <option value="<?php echo $id?>">
				    							<?php 
				    							echo get_the_title();
												endwhile; wp_reset_postdata();?></option>	
									    </select>
                        			</div>
                        		</div>
                                <div class="custom-col">
                                    <div class="custom-form-group">
                                        <label for="gym_surname"><?php _e('Nickname'); ?></label>
                                        <input type="text" name="gym_surname" class="custom-form-control">
                                    </div>
                                </div>
                        		<div class="custom-col custom-col-md-6 custom-hide-div">
                        			<div class="custom-form-group relative">
                        				<label for="checkin-date">From Date</label>
					    				<input type="text" id="my_date_picker" class="checkin-date custom-form-control g_startdate" name="g_startdate" placeholder="YYYY-MM-DD" required tabindex="-1" readonly>
					    				 <span class="dashicons dashicons-calendar-alt" id="starting_date"></span>
                        			</div>
                        		</div>
                        		<div class="custom-col custom-col-md-6 custom-hide-div">
                        			<div class="custom-form-group relative">
                        				<label for="checkout-date">To Date</label>
					    				<input type="text" id="my_date_picker_to" class="checkin-date custom-form-control g_enddate" name="g_enddate" placeholder="YYYY-MM-DD" required tabindex="-1" readonly>
					    				<span class="dashicons dashicons-calendar-alt" id="ending_date"></span>
                        			</div>
                        		</div>
                        		<div class="custom-col" id="gym_part_selection" style="display:none;">
							    	<div class="custom-form-group">
							        <label for="gym-selection">Gym Part Selection</label>
				                        <select name="gym_parts" id="gym_parts"  class="custom-form-control gym-parts">
			                  			</select>
								    </div>
								</div>
                                <div class="day-select" style="display: flex">
                        		<div class="custom-col custom-col-md-4 custom-hide-div gym_day_and_time" style="display:none">
                        			<div class="custom-form-group">
                        				<label for="day_selection">Day Selection</label>
									    <select class="day_selection custom-form-control" name="day_selection" required>
									        <option value="">Select a day</option>
									        <option value="0">Monday</option>
									        <option value="1">Tuesday</option>
									        <option value="2">Wednesday</option>
									        <option value="3">Thursday</option>
									        <option value="4">Friday</option>
									        <option value="5">Saturday</option>
									        <option value="6">Sunday</option>
									    </select>
                        			</div>
                        		</div>
                        		<div class="custom-col custom-col-md-4 custom-hide-div gym_day_and_time" style="display:none">
                        			<div class="custom-form-group">
                        				<div><label>Start Time</label>  
										<input type="text" id="time"  placeholder="Select a time" class="custom-form-control custom-job-time" name="start_time" required></div>
										<div id="startDateError"></div>
                        			</div>
                        			
                        		</div>
                        		<div class="custom-col custom-col-md-4 custom-hide-div gym_day_and_time" style="display:none">
                        			<div class="custom-form-group">
                        				<div><label>End Time</label>
							 			<input type="text" id="timeEnd" placeholder="Select a time" class="custom-form-control custom-job-time" name="end_time" required></div>
							 			<div id="endDateError"></div>
                        			</div>	
                        		</div>
                                </div>
                        		<div class="custom-col color-box1" style="display: none;">
                        			<div class="color-details">
                        				<div class='box grey-box'><span class="grey"></span>Gym Closed</div>
                        				<div class='box green-box'><span class="green"></span>Not available any part</div>
										<div class='box white-box'><span class="white"></span>All parts available</div>
									</div>
                        		</div>
                        		<div class="custom-col color-box2" style="display: none;">
                        			<div class="color-details">
                        				<div class='box grey-box'><span class="grey"></span>Gym Closed</div>
                        				<div class='box yellow-box'><span class="yellow"></span>1 Parts available</div>
                        				<div class='box green-box'><span class="green"></span><span class="two-part-yellow"></span>Not  available any part</div>
										<div class='box white-box'><span class="white"></span>All parts available</div>
									</div>
                        		</div>
                        		<div class="custom-col color-box3" style="display: none;">
                        			<div class="color-details">
                        				<div class='box grey-box'><span class="grey"></span>Gym Closed</div>
                        				<div class='box yellow-box'><span class="yellow"></span>2 Parts available</div>
                        				<div class='box green-box'><span class="green"></span><span class="two-part-yellow"></span>1 Part available</div>
										<div class='box red-box'><span class="green-yellow"></span><span class="red"></span><span class="dark-yellow"></span>Not available any part</div>
										<div class='box white-box'><span class="white"></span>All parts available</div>
									</div>
                        		</div>
                        		
                        		<div class="custom-col custom-hide-div">
                        			<div class="custom-form-group">
                        				<div id="schedule-demo">
								  		<input type="hidden" name="schedule" id="result" value="">
								  		</div>
                        			</div>
                        		</div>
                        		<div class="custom-col custom-col-md-6">
                        			<div class="custom-form-group">
                        				<label for="group-selection">Target Group</label>
									    <select id="group-selection" class="custom-form-control" name="g_targetgroup">
									        <option value="">Target group</option>
									        <option value="Kids">Kids</option>
									        <option value="Adult">Adult</option>
									        <option value="Teenager 13-14 year">Teenager 13-14 year</option>
									        <option value="Teenager 15-16 year">Teenager 15-16 year</option>
									    </select>
                        			</div>
                        		</div>
                        		<div class="custom-col custom-col-md-6">
                        			<div class="custom-form-group">
                        				<label for="gender-selection" >Gender</label>
                        				<select id="gender-selection" class="custom-form-control" name="g_gender">
									        <option value="">Gender</option>
									        <option value="Men">Men</option>
									        <option value="Women">Women</option>
									        <option value="Both">Both</option>
								    	</select>
                        			</div>
                        		</div>
                        		<div class="custom-col">
			                        <div class="custom-form-group booking-button">
			                            <input type="submit" name="gymbooking" value="Book an Appointment">
			                            <a href="<?php the_permalink(); ?>" class="button booking-cancel-btn">Cancel</a>
			                            
			                        </div> 
			                    </div>
						 	</div>
						 </div>
					</form>
					<?php }
					else{ ?>


				<div class="listing-section">
		    <div class="create-listing">
		        <a class="button editform" href=<?php echo $listing."?slotbooking" ?>>GYM Booking</a>
		    </div>
		    <?php
		    	if (isset($_GET['delete_id']))
				{
					$referer = strtok($_SERVER['HTTP_REFERER'], "?");
					$id = $_GET['delete_id'];
					$gymDelete = $wpdb->query("DELETE FROM $gymCustomerData WHERE id = $id");
					$gymdaybook = $wpdb->query("DELETE FROM $gymBookingData WHERE gb_id = $id");
				    if ($gymDelete)
				    {
				    	echo "<p class='success_message'>Record deleted successfully.<p>";
				    } 
				    else{?>
				    	<p class='validation_message'>Record not deleted.Please try again.</p>
				   <?php }
				   
					
				}
				$query_sql = $wpdb->prepare("SELECT $gymCustomerData.user_id,$gymCustomerData.g_id,$gymCustomerData.id,$gymCustomerData.g_startdate,$gymCustomerData.g_enddate,$gymCustomerData.gym_parts, $gymBookingData.gb_monday_start,$gymBookingData.gb_monday_end,$gymBookingData.gb_tuesday_start,$gymBookingData.gb_tuesday_end,$gymBookingData.gb_wednesday_start,$gymBookingData.gb_wednesday_end,$gymBookingData.gb_thursday_start,$gymBookingData.gb_thursday_end,$gymBookingData.gb_friday_start,$gymBookingData.gb_friday_end,$gymBookingData.gb_saturday_start,$gymBookingData.gb_saturday_end,$gymBookingData.gb_sunday_start,$gymBookingData.gb_sunday_end,$gymCustomerData.g_targetgroup,$gymCustomerData.g_gender FROM $gymCustomerData JOIN $gymBookingData ON $gymBookingData.gb_id = $gymCustomerData.id WHERE $gymCustomerData.user_id =$current_user_id ORDER BY 
					$gymCustomerData.id DESC");

    					$getdata = $wpdb->get_results($query_sql);
		    ?>
		  <div class="listing-table-main responsive-table">
		       <table class="listing-table" id="table_detail">
		            <thead class="thead">
                		<tr>
		                    <th>Customer Name</th>
		                    <th>Gym	</th>
		                    <th>Delete</th>
		                    <th>Booking Detail</th>
		                </tr>
		           </thead>
		        	<tbody class="listing-tbody">
		        	 <?php
    					if (!empty($getdata)) 
    					{
						        foreach ( $getdata as $key => $gymdataview ) 
						        {
					            
					                $gymID = $gymdataview->g_id;
					                $bookingId = $gymdataview->id;
					               
					                
					                $author_obj = get_user_by('id', $gymdataview->user_id);
					                $customerName = $author_obj->user_login;
					                $gymName = get_the_title($gymID);

							        $startDate = $gymdataview->g_startdate;
	                                $endDate = $gymdataview->g_enddate;


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
	                                $gymParts = $gymdataview->gym_parts;

     							?>
			            <tr>
			                <td> <?php echo $customerName; ?></td>
			                <td><?php echo $gymName; ?> </td>
			                 <td>  <a class="listing-delete" href="<?php echo $current_url2."?delete_id=";echo $bookingId; ?>" onclick="return confirm('Do you really want to delete this position?');"><span class="dashicons dashicons-trash" id="deletedata"></span></a></td>
			                <td><button onclick="show_hide_row('hidden_row<?php echo $key;?>');" class="view_data_btn">View Details</button></td>
			               
			            </tr>
			    		<tr id="hidden_row<?php echo $key;?>" class="hidden_row">
			      			<td colspan="4">
			      				<table class="gymdetaildata">
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
									</tbody>
								</table>
							</td>	    		
						</tr>
				<?php } ?>
            </tr>
            <?php  
                }  else { ?> <tr><td colspan="4" class="norecord"> Records not found.</td></tr><?php }   ?> 
        </tbody>
    </table> 
  </div>
<style type="text/css">
  table {
    border-collapse: collapse;
  }
  #table_detail .hidden_row {
    display: none;
}
</style>
			
  	<div class = "club-custom-pagination">
   <?php  $total_pages = $loop->max_num_pages;
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

	?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		var selectegym = null;
		var start_date = null;
		var end_date = null;
		var gym_parts = null;
		var startTimeSelected = null;
		var endTimeSelected = null;
		var day = null;
		var docs = null;
		var start_time = null;
		var endTimeSelected = null;
		var scheduleData = [];
		var selectedDay = null;
	    var minimumTime = "7:00 AM"; // mentions the start time.
	    var maximumTime = "10:30 PM"; // mentions the start time.
	    var minimumTimepicker;
	    var bookingData = [];

	    //create validation endtime role
	    $.validator.addMethod('codExistss', function (value, element) {
     		return false;
       	},"Please remove booking on this day.");
				
		$("select.gym-selection").change(function () {
			selectegym = jQuery(this).val();
			getGymPars(selectegym);

			jQuery('.g_startdate, .g_enddate, .day_selection, #time, #timeEnd, #result').val('');

			start_date =  end_date =  gym_parts = startTimeSelected = endTimeSelected = selectedDay  = null;
			bookingData = [];

			jQuery('.gym_day_and_time').hide();
			jQuery('#schedule-demo').jqs('reset');

			//disableBookingDay(selectegym, start_date, end_date, gym_parts,startTimeSelected,endTimeSelected,selectedDay,bookingData);
		});
		$('.g_startdate').change(function() {
			start_date = $(this).val();
			$('.g_enddate').val('');
			$('.g_enddate').focus();
			disableBookingDay(selectegym, start_date, end_date, gym_parts,startTimeSelected,endTimeSelected,selectedDay,bookingData);
		});
		$('.g_enddate').change(function() {
			end_date = $(this).val();
			disableBookingDay(selectegym, start_date, end_date, gym_parts,startTimeSelected,endTimeSelected,selectedDay,bookingData);
		});

		$('.gym-parts').change(function() {
			gym_parts = jQuery('select.gym-parts').children("option:selected").val();
			jQuery('.gym_day_and_time').show();
			disableBookingDay(selectegym, start_date, end_date, gym_parts,startTimeSelected,endTimeSelected,selectedDay,bookingData);

		});
		//get selected Day
		jQuery("select.day_selection").change(function()
		{
			selectedDay = jQuery(this).children("option:selected").val();
			jQuery('.gym-parts').attr("style", "pointer-events: none;");
			jQuery('#time,#timeEnd').val('');
			minimumTimepicker = $("#timeEnd").data("ejTimePicker");
	       	minimumTimepicker.setModel({ "value" : '' });
		});

    	$("#time").ejTimePicker({
            minTime:  "7:00 AM", // Start time as minimumTime.
            maxTime: "10:30 PM", // End time as maximumTime.
            interval: 5,
            minutesInterval : 5,
            watermarkText: "Select a time",
            value : '',
            select: function (args) {
            	startTimeSelected = args.value;
                minimumTimepicker = $("#timeEnd").data("ejTimePicker");
	       		minimumTimepicker.setModel({ "minTime": args.value,"value" : '' });
            	jQuery("#timeEnd").val('');
            	endTimeSelected = null;
            }
        });
        $("#timeEnd").ejTimePicker({
			minTime: "7:00 AM",
	        maxTime: "10:30 PM",
	        interval: 5,
	        minutesInterval : 5,
	        watermarkText: "Select a time",
	        value : '',
	        change: function (args) {
				endTimeSelected = args.value;
				if(startTimeSelected && endTimeSelected && selectedDay && !isNaN(+selectedDay) && +selectedDay > -1) {
					var tempData = jQuery('#schedule-demo').jqs('export');
					tempData = JSON.parse(tempData);
					var isTrue = false;
					tempData.forEach(dayObj => {
						if (dayObj.day === +selectedDay) {
								if(dayObj['periods'].length !== 0){
									alert('please remove selected time');
									
								}else{
								startTimeSelected = startTimeSelected.replace('AM','am').replace('PM','pm');
	      						endTimeSelected = endTimeSelected.replace('AM','am').replace('PM','pm');
	      						dayObj['periods'] = new Array();
								dayObj['periods'].push([startTimeSelected, endTimeSelected]);

								}
								
						}
					});
					
					var result = jQuery('#result').val();
					bookingData = (result) ? jQuery.parseJSON(result) : bookingData;
					
					disableBookingDay(selectegym, start_date, end_date, gym_parts,startTimeSelected,endTimeSelected,selectedDay,bookingData);
				}
			
			}
		});
	});
	function getGymPars(selectegym){
		$.ajax({
			type: 'POST',
	        url: '<?php echo admin_url('admin-ajax.php'); ?>',
	        dataType: "html", // add data type
	        data: {	
	        	selectegym:selectegym,
	        	action :'get_ajax_gymparts'
	    	},
	    	success: function(response){
	    		if(response != null){
		        	var parts = response;
		        	$("#gym_parts").empty();
		        	if(parts !=1){
		        		$("#gym_parts").empty();
		        		$("#gym_parts").append('<option disabled="" selected="">Select Gym Part</option>');
			        	for (let i = 1; i <= parts; i++) {
						  		$("#gym_parts").append("<option value='"+ i + "'>"+ i + "</option>");
								}
								$("#gym_part_selection").show();
								$('.gym-parts').attr("style", "pointer-events: all;");
							}else{
								$("#gym_part_selection").hide();
								jQuery('.gym_day_and_time').show();
							}
							if(parts == 1){
								$(".color-box1").show();
								$(".color-box2").hide();
								$(".color-box3").hide();

							}
							else if(parts == 2){
								$(".color-box2").show();
								$(".color-box1").hide();
								$(".color-box3").hide();
							}
							else if(parts == 3){
								$(".color-box3").show();
								$(".color-box2").hide();
								$(".color-box1").hide();
							}
		      }else{
		        	$("#gym_part_selection").hide();
		        	jQuery('.gym_day_and_time').show();
		      }
	    	}
		});
	}
			
	function disableBookingDay(selectegym, start_date, end_date, gym_parts,startTimeSelected,endTimeSelected,selectedDay,bookingData){
		if(startTimeSelected == endTimeSelected && startTimeSelected !=null && endTimeSelected != null){
			alert('Your selected same start time. Please choose another time');
				jQuery('#timeEnd').val('');
		}else{
			$.ajax({
			        type: 'POST',
			        url: '<?php echo admin_url('admin-ajax.php'); ?>',
			        dataType: "html", // add data type
			        data: {	
			        	selectegym:selectegym,
			        	start_date : start_date,
			        	end_date : end_date,
			        	gym_parts : gym_parts,
			        	startTimeSelected : startTimeSelected,
			        	end_time : endTimeSelected,
			        	day_data : selectedDay,
			        	booking_data : bookingData,
			        	action :'get_ajax_posts'
			    	},
			        success: function( response ) {
			        	var obj = JSON.parse(response);
			        	jQuery('#schedule-demo').jqs('reset');	
						if(!jQuery.isEmptyObject(obj.dynamicData)){
							jQuery('#schedule-demo').jqs('import',obj.dynamicData);
							jQuery('#result').val(JSON.stringify(obj.dynamicData));
						}
				        jQuery('#schedule-demo').jqs('importDisable',obj.disabledata);
				        if(obj.message != '' && startTimeSelected != null && endTimeSelected != null)
				        {
				        	alert(obj.message);
				        	jQuery('#time, #timeEnd').val('');
				        }
				        if(obj.dynamicData == null){
				        	jQuery('#time, #timeEnd, #result').val('');
				        }
			       	}
			    });
		}
	}

	//Read mode for dchedule
	jQuery("#schedule-demo").jqs({
		data: [],
		minTime: "07:00 am",
		maxTime: "10:30 pm",
		disableData: [],
	});

	function show_hide_row(row)
	{
	 jQuery("#"+row).toggle();
	}

	if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $referer; ?>');
    }			
</script>
<?php 
	if ( isset( $_POST['gymbooking'] ) )
	{	$gym_parts = get_post_meta($_POST['g_id'],'gym_parts', true);
		if($gym_parts == 1){$parts = 2;}else{$parts = $_POST['gym_parts'];}
        $tablename = $wpdb->prefix.'gym_booking';
        $wpdb->insert( $tablename, array(
        	'user_id' 		=>$current_user_id,
        	'g_id' 			=>$_POST['g_id'],
            'g_startdate' 	=> $_POST['g_startdate'], 
            'g_enddate' 	=> $_POST['g_enddate'],
            'g_targetgroup' => $_POST['g_targetgroup'], 
            'g_gender' 		=> $_POST['g_gender'], 
            'gym_parts'     => $parts,
            
            ),
             array( '%d', '%d', '%s', '%s', '%s', '%s', '%s' ) 
        );
        $lastInsertId = $wpdb->insert_id;
       	$schedule = json_decode(stripslashes($_POST['schedule']));
       		$monstart = $monend = $tuestart = $tueend = $wedstart = $wedend = $thusstart = $thusend = $fristart = $friend = $satstart = $satend = $sunstart = $sunend = "";
       		foreach($schedule as $k => $cur)
			{ 
			  	if(!empty($cur->periods)){
			  		$days = $cur->day;
				  	switch ($days) {
					    case "0":
					        $monstart = $cur->periods[0][0];
					  		$monend = $cur->periods[0][1];
					        break;
					    case "1":

					        $tuestart = $cur->periods[0][0];
					  		$tueend = $cur->periods[0][1];
					        break;
					    case "2":
					        $wedstart = $cur->periods[0][0];
					  		$wedend = $cur->periods[0][1];
					        break;
						case "3":
					        $thusstart = $cur->periods[0][0];
					  		$thusend = $cur->periods[0][1];
					        break;
					    case "4":
					        $fristart = $cur->periods[0][0];
					  		$friend = $cur->periods[0][1];
					        break;
					    case "5":
					        $satstart = $cur->periods[0][0];
					  		$satend = $cur->periods[0][1];
					        break;
						case "6":
					        $sunstart = $cur->periods[0][0];
					  		$sunend = $cur->periods[0][1];
					        break;
					}
			  	}
			 }
       $tablename2 = $wpdb->prefix.'gym_booking_days';
       $result = $wpdb->insert( $tablename2, array(
        	'gb_id' 				=>$lastInsertId,
        	'gb_monday_start' 		=>$monstart,
            'gb_monday_end' 		=>$monend, 
            'gb_tuesday_start' 		=>$tuestart,
            'gb_tuesday_end' 		=>$tueend,
            'gb_wednesday_start' 	=>$wedstart,
            'gb_wednesday_end' 		=>$wedend,
            'gb_thursday_start' 	=>$thusstart,
            'gb_thursday_end' 		=>$thusend,
            'gb_friday_start' 		=>$fristart,
            'gb_friday_end' 		=>$friend,
            'gb_saturday_start' 	=>$satstart,
            'gb_saturday_end' 		=> $satend,
            'gb_sunday_start' 		=>$sunstart,
            'gb_sunday_end' 		=>$sunend,
            ),
             array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) 
        );

       if($result){
			       	echo "<script>window.location = '".$listing."'</script>";
			       	echo "your gym Successfully Booked";
			       }
			       else{
			       	echo "Not booked something is wrong";
			       }

    }
}
	else{
        $link = get_permalink().'/login-landing/';
        echo "<script>window.location = '".$link."'</script>"; 
      }	
}

//functions
add_shortcode( 'gymSlotBooking', 'gymSlotBooking' );
add_action('wp_ajax_get_ajax_posts', 'get_ajax_posts');
add_action('wp_ajax_nopriv_get_ajax_posts', 'get_ajax_posts');
add_action('wp_ajax_get_ajax_gymparts', 'get_ajax_gymparts');
add_action('wp_ajax_nopriv_get_ajax_gymparts', 'get_ajax_gymparts');


function get_ajax_gymparts(){
 	global $wpdb;
 	$post_id 			= ($_POST['selectegym']);
 	$gym_parts          = get_post_meta($post_id,'gym_parts', true);
 	echo $gym_parts;
 	die;
}

function get_ajax_posts() 
{
	global $wpdb;
	$dayname = null;
	$gym_sday = null;
	$gym_eday = null;
	$post_id 			= ($_POST['selectegym']);
	$start_date 		= $_POST['start_date'];
	$end_date 			= $_POST['end_date'];
	$gymparts 			= $_POST['gym_parts'];
	$gym_start_time     = $_POST['startTimeSelected'];
	$gym_end_time     	= $_POST['end_time'];
	$day_data 			= $_POST['day_data'];
	$booking_data		= $_POST['booking_data'];

	$gym_parts          = get_post_meta($post_id,'gym_parts', true);
	$monday_start 		= get_post_meta($post_id,'gym_monday_from', true);
    $monday_end 		= get_post_meta($post_id,'gym_monday_to', true);
    $tuesday_start 		= get_post_meta($post_id,'gym_tuesday_from', true);
    $tuesday_end 		= get_post_meta($post_id,'gym_tuesday_to', true);
    $wednesday_start 	= get_post_meta($post_id,'gym_wednesday_from', true);
    $wednesday_end 		= get_post_meta($post_id,'gym_wednesday_to', true);
    $thursday_start 	= get_post_meta($post_id,'gym_thursday_from', true);
    $thursday_end 		= get_post_meta($post_id,'gym_thursday_to', true);
    $friday_start 		= get_post_meta($post_id,'gym_friday_from', true);
    $friday_end 		= get_post_meta($post_id,'gym_friday_to', true);
    $saturday_start 	= get_post_meta($post_id,'gym_saturday_from', true);
    $saturday_end 		= get_post_meta($post_id,'gym_saturday_to', true);
    $sunday_start 		= get_post_meta($post_id,'gym_sunday_from', true);
    $sunday_end 		= get_post_meta($post_id,'gym_sunday_to', true);
    
    if($day_data == 0){$dayname = monday; $gym_sday = $monday_start; $gym_eday = $monday_end;}
    elseif($day_data == 1){$dayname = tuesday; $gym_sday = $tuesday_start; $gym_eday = $tuesday_end;}
    elseif($day_data == 2){$dayname = wednesday; $gym_sday = $wednesday_start; $gym_eday = $wednesday_end;}
    elseif($day_data == 3){$dayname = thursday; $gym_sday = $thursday_start; $gym_eday = $thursday_end;}
    elseif($day_data == 4){$dayname = friday; $gym_sday = $friday_start; $gym_eday = $friday_end;}
    elseif($day_data == 5){$dayname = saturday; $gym_sday = $saturday_start; $gym_eday = $saturday_end;}
    elseif($day_data == 6){$dayname = sunday; $gym_sday = $sunday_start; $gym_eday = $sunday_end;}


	 $sum = "SELECT SUM(b.gym_parts) as gym_parts
        FROM `".$wpdb->prefix."gym_booking` AS b
        LEFT JOIN `".$wpdb->prefix."gym_booking_days` AS bd ON b.id = bd.gb_id
        WHERE b.g_id = $post_id
        AND b.g_enddate >= CURDATE()
        AND unix_timestamp(b.g_enddate) >= unix_timestamp('$start_date')
        AND unix_timestamp(b.g_startdate) <= unix_timestamp('$end_date')";
	    if(!empty($gym_start_time) && !empty($gym_end_time)){
	    	$sum .= "AND unix_timestamp(STR_TO_DATE(bd.gb_".$dayname."_end, '%l:%i %p')) > unix_timestamp(STR_TO_DATE('$gym_start_time', '%l:%i %p'))
	        AND unix_timestamp(STR_TO_DATE(bd.gb_".$dayname."_start, '%l:%i %p')) < unix_timestamp(STR_TO_DATE('$gym_end_time', '%l:%i %p'))";
	    }
     
		$resultsum = $wpdb->get_row($sum);
		if($gymparts){
			$count = ($resultsum->gym_parts)+($gymparts); 
		}else { 
			$count = $resultsum->gym_parts; 
		}
		$query = "SELECT b.g_id,b.g_startdate,b.g_enddate,b.gym_parts ,b.id, bd.*
        FROM `".$wpdb->prefix."gym_booking` AS b
        LEFT JOIN `".$wpdb->prefix."gym_booking_days` AS bd ON b.id = bd.gb_id
        WHERE b.g_id = $post_id 
        AND b.g_enddate >= CURDATE()
        AND unix_timestamp(b.g_enddate) >= unix_timestamp('$start_date')
        AND unix_timestamp(b.g_startdate) <= unix_timestamp('$end_date')
        AND $count > $gym_parts";

		$result_query = $wpdb->get_results($query);
		$mainresult = array();
		$dynamicData = array();
		$message = "Your selected part is already booked for the same time. Please choose another time";
		if(count($result_query) == 0 && !empty($gym_start_time) && !empty($gym_end_time)){
			$message = '';
			foreach ($booking_data as $key => $value) {
				if($value['day'] == $day_data){
					unset($booking_data[$key]);
				}
			}
			if((strtotime($gym_sday) <= strtotime($gym_start_time)) && (strtotime($gym_eday) >= strtotime($gym_end_time))){
				$currentarr = array();
				$currentarr['gym_parts'] = $gymparts;
				$currentarr['day'] = $day_data;
				$currentarr['periods'][0][0] = $gym_start_time;
				$currentarr['periods'][0][1] = $gym_end_time;
				$booking_data[] = $currentarr;

				$sum = "SELECT SUM(b.gym_parts) as gym_parts
		        FROM `".$wpdb->prefix."gym_booking` AS b
		        LEFT JOIN `".$wpdb->prefix."gym_booking_days` AS bd ON b.id = bd.gb_id
		        WHERE b.g_id = $post_id
		        AND b.g_enddate >= CURDATE()
		        AND unix_timestamp(b.g_enddate) >= unix_timestamp('$start_date')
		        AND unix_timestamp(b.g_startdate) <= unix_timestamp('$end_date')";
		    		     
				$resultsum = $wpdb->get_row($sum);
				if($gymparts){
					$count = ($resultsum->gym_parts)+($gymparts); 
				}else { 
					$count = $resultsum->gym_parts; 
				}
				$query = "SELECT b.g_id,b.g_startdate,b.g_enddate,b.gym_parts ,b.id, bd.*
		        FROM `".$wpdb->prefix."gym_booking` AS b
		        LEFT JOIN `".$wpdb->prefix."gym_booking_days` AS bd ON b.id = bd.gb_id
		        WHERE b.g_id = $post_id 
		        AND b.g_enddate >= CURDATE()
		        AND unix_timestamp(b.g_enddate) >= unix_timestamp('$start_date')
		        AND unix_timestamp(b.g_startdate) <= unix_timestamp('$end_date')
		        AND $count > $gym_parts  ";

				$result_query = $wpdb->get_results($query);
			}
		}

		$array = array();
    	$timeCurrent = ['AM','PM'];
    	$timeReplace = ['am','pm'];
    	if(!empty($monday_start) && strtotime($monday_start) < strtotime($monday_end)){
    		$monday_start = str_replace($timeCurrent, $timeReplace, $monday_start);
    		$monday_end = str_replace($timeCurrent, $timeReplace, $monday_end);
    		$array0['gym_parts'] = $gym_parts;
    		$array0['day'] = 0;
    		$array0['periods'][] = array('start'=>'12:00 am','end'=>$monday_start,"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    		$array0['periods'][] = array('start'=>$monday_end,'end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    		$array[] = $array0;
    	}else{
    		$array0['gym_parts'] = $gym_parts;
    		$array0['day'] = 0;
    		$array0['periods'][] = array('start'=>'12:00 am','end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    		$array[] = $array0;
    	}

    	if(!empty($tuesday_start) && strtotime($tuesday_start) < strtotime($tuesday_end)){
    		$tuesday_start = str_replace($timeCurrent, $timeReplace, $tuesday_start);
    		$tuesday_end = str_replace($timeCurrent, $timeReplace, $tuesday_end);
    		$array1['gym_parts'] = $gym_parts;
    		$array1['day'] = 1;
    		$array1['periods'][] = array('start'=>'12:00 am','end'=>$tuesday_start,"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    		$array1['periods'][] = array('start'=>$tuesday_end,'end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    		$array[] = $array1;
    	}else{
	    	$array1['gym_parts'] = $gym_parts;
    		$array1['day'] = 1;
    		$array1['periods'][] = array('start'=>'12:00 am','end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    		$array[] = $array1;
    	}

    if(!empty($wednesday_start) && strtotime($wednesday_start) < strtotime($wednesday_end)){
    	$wednesday_start = str_replace($timeCurrent, $timeReplace, $wednesday_start);
    	$wednesday_end = str_replace($timeCurrent, $timeReplace, $wednesday_end);
    	$array2['gym_parts'] = $gym_parts;
    	$array2['day'] = 2;
    	$array2['periods'][] = array('start'=>'12:00 am','end'=>$wednesday_start,"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array2['periods'][] = array('start'=>$wednesday_end,'end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array2;
    }else{
    	$array2['gym_parts'] = $gym_parts;
    	$array2['day'] = 2;
    	$array2['periods'][] = array('start'=>'12:00 am','end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array2;
    }

    if(!empty($thursday_start) && strtotime($thursday_start) < strtotime($thursday_end)){
    	$thursday_start = str_replace($timeCurrent, $timeReplace, $thursday_start);
    	$thursday_end = str_replace($timeCurrent, $timeReplace, $thursday_end);
    	$array3['gym_parts'] = $gym_parts;
    	$array3['day'] = 3;
    	$array3['periods'][] = array('start'=>'12:00 am','end'=>$thursday_start,"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array3['periods'][] = array('start'=>$thursday_end,'end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array3;
    }else{
    	$array3['gym_parts'] = $gym_parts;
    	$array3['day'] = 3;
    	$array3['periods'][] = array('start'=>'12:00 am','end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array3;
    }

    if(!empty($friday_start) && strtotime($friday_start) < strtotime($friday_end)){
    	$friday_start = str_replace($timeCurrent, $timeReplace, $friday_start);
    	$friday_end = str_replace($timeCurrent, $timeReplace, $friday_end);
    	$array4['gym_parts'] = $gym_parts;
    	$array4['day'] = 4;
    	$array4['periods'][] = array('start'=>'12:00 am','end'=>$friday_start,"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array4['periods'][] = array('start'=>$friday_end,'end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array4;
    }else{
    	$array4['gym_parts'] = $gym_parts;
    	$array4['day'] = 4;
    	$array4['periods'][] = array('start'=>'12:00 am','end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array4;
    }

    if(!empty($saturday_start) && strtotime($saturday_start) < strtotime($saturday_end)){
    	$saturday_start = str_replace($timeCurrent, $timeReplace, $saturday_start);
    	$saturday_end = str_replace($timeCurrent, $timeReplace, $saturday_end);
    	$array5['gym_parts'] = $gym_parts;
    	$array5['day'] = 5;
    	$array5['periods'][] = array('start'=>'12:00 am','end'=>$saturday_start,"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array5['periods'][] = array('start'=>$saturday_end,'end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array5;
    }else{
    	$array5['gym_parts'] = $gym_parts;
    	$array5['day'] = 5;
    	$array5['periods'][] = array('start'=>'12:00 am','end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array5;
    }

    if(!empty($sunday_start) && strtotime($sunday_start) < strtotime($sunday_end)){
    	$sunday_start = str_replace($timeCurrent, $timeReplace, $sunday_start);
    	$sunday_end = str_replace($timeCurrent, $timeReplace, $sunday_end);
    	$array6['gym_parts'] = $gym_parts;
    	$array6['day'] = 6;
    	$array6['periods'][] = array('start'=>'12:00 am','end'=>$sunday_start,"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array6['periods'][] = array('start'=>$sunday_end,'end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array6;
    }else{
    	$array6['gym_parts'] = $gym_parts;
    	$array6['day'] = 6;
    	$array6['periods'][] = array('start'=>'12:00 am','end'=>'12:00 am',"backgroundColor" => "rgba(0, 0, 0, 0.1)","borderColor" => "#000");
    	$array[] = $array6;
    }
	$padding = 0;
	foreach($result_query as $data){  
		//$bgColor = ($data->gym_parts == 3) ? 'rgba(240,128,128)' : 'rgba(127,255,212)';
    		$bgColor = ($data->gym_parts == 3) ? "rgb(236,10,10,30%)" : (($data->gym_parts == 2) ? "rgba(127,255,212,0.3)" : "rgba(249, 225, 9,30%)");
		    	if(!empty($data->gb_monday_start )){
		    		if($data->gym_parts ) {
		    			$array[0]['periods'][] = array('gym_parts'=>$data->gym_parts, 'start'=>$data->gb_monday_start,'end'=>$data->gb_monday_end,"backgroundColor" => $bgColor,"borderColor" => "#000", "paddingTop" => $padding."px");
		    		}
		    	}
		    	if(!empty($data->gb_tuesday_start)){
		    		
		    			$array[1]['periods'][] = array('gym_parts'=>$data->gym_parts, 'start'=>$data->gb_tuesday_start,'end'=>$data->gb_tuesday_end,"backgroundColor" => $bgColor,"borderColor" => "#000", "paddingTop" => $padding."px");
		    	}
		    	if(!empty($data->gb_wednesday_start)){
		    		
		    			$array[2]['periods'][] = array('gym_parts'=>$data->gym_parts,'start'=>$data->gb_wednesday_start,'end'=>$data->gb_wednesday_end,"backgroundColor" => $bgColor,"borderColor" => "#000", "paddingTop" => $padding."px");
		    	}
		    	if(!empty($data->gb_thursday_start)){
		    		
		    			$array[3]['periods'][] = array('gym_parts'=>$data->gym_parts, 'start'=>$data->gb_thursday_start,'end'=>$data->gb_thursday_end,"backgroundColor" => $bgColor,"borderColor" => "#000", "paddingTop" => $padding."px");
		    	}
		    	if(!empty($data->gb_friday_start)){
		    		
		    			$array[4]['periods'][] = array('gym_parts'=>$data->gym_parts, 'start'=>$data->gb_friday_start,'end'=>$data->gb_friday_end,"backgroundColor" => $bgColor,"borderColor" => "#000", "paddingTop" => $padding."px");
		    		
		    	}
		    	if(!empty($data->gb_saturday_start)){
		    		
		    			$array[5]['periods'][] = array('gym_parts'=>$data->gym_parts, 'start'=>$data->gb_saturday_start,'end'=>$data->gb_saturday_end,"backgroundColor" => $bgColor,"borderColor" => "#000", "paddingTop" => $padding."px");
		    		
		    	}
		    	if(!empty($data->gb_sunday_start)){
		    		
		    			$array[6]['periods'][] = array('gym_parts'=>$data->gym_parts, 'start'=>$data->gb_sunday_start,'end'=>$data->gb_sunday_end,"backgroundColor" => $bgColor,"borderColor" => "#000", "paddingTop" => $padding."px");
		    		
		    	}
		    	
		    	$padding = ($padding == 20) ? 0 : $padding+10;
	}

	
	$mainresult = ['dynamicData' => $booking_data, 'disabledata' => $array, 'message' => $message];

	echo json_encode($mainresult);
	die;
}
?>
