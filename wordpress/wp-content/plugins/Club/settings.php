<?php
global $wpdb;
global $post;
add_thickbox();
?>
<div class="booking-backend-main responsive-table">
       <table class="booking-backend-table">
            <thead class="thead">
                <h1>List Of customer boooked GYM</h1>
                <tr>
                    <th>Customer Name</th>
                    <th>Gym</th>
                    <th>Action</th>
                </tr>
           </thead>
        <tbody class="listing-tbody">
  <?php


$current_url =strtok($_SERVER['REQUEST_URI'],"&");
$current_url2 = get_site_url().esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) );

    $gymbooking = $wpdb->prefix . "gym_booking";
    $gymdaybooking = $wpdb->prefix . "gym_booking_days";
    $query = $wpdb->prepare("SELECT * FROM $gymbooking");
    $gymdata = $wpdb->get_results($query);

        foreach ( $gymdata as $getgymdata ) 
        {
            
                $gymID = $getgymdata->g_id;
                
                $author_obj = get_user_by('id', $getgymdata->user_id);
                $customerName = $author_obj->user_login;
                $gymName = get_the_title( $gymID );

        ?>
            <tr>
                <td> <?php echo $customerName; ?></td>
                <td><?php echo $gymName; ?> </td>
                <td>  <a class="listing-delete" href="<?php echo $current_url2."&delete_id=";echo $getgymdata->id; ?>"><span class="dashicons dashicons-trash" id="deletedata"></span></a></td>
                <td>
                    <input alt="#TB_inline?height=400&inlineId=examplePopup<?php echo $getgymdata->id; ?>" title="View Detail" class="thickbox view_data" type="button" value="View Detail" id="<?php echo $getgymdata->id; ?>"/>
                
            </tr>
             <?php 
                 }?>

        </tbody>
    </table> 
  </div>

<?php

if (isset($_GET['delete_id']))
                {
                    
                    $id = $_GET['delete_id'];
                    $gymDelete = $wpdb->query("DELETE FROM $gymbooking WHERE id = $id");
                    $gymdaybook = $wpdb->query("DELETE FROM $gymdaybooking WHERE gb_id = $id");
                    if ($gymDelete)
                    {

                        echo "<p class='success_message'>Record Deleted successfully.<p>";
                    } 
                    else{
                        echo "<p class='validation_message'>Record not deleted. Please try again.</p>";
                    }
                    ?>
                    <script>    
                    if(typeof window.history.pushState == 'function') {
                       // window.location.reload();
                        window.history.pushState({}, "Hide", '<?php echo $current_url; ?>');
                        window.location.reload();
                    }
                    </script>
                    <?php
                }
        
?>

<div id="examplePopup<?php echo $getgymdata->id; ?>" style="display:none" class="customer_detail">
</div>


<script>
    var Id;

    jQuery(document).ready(function($) {

    $('.view_data').click(function(){
               gymId = $(this).attr('id');
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                method: "POST",
                dataType: "html",
                data: {gymID:gymId, action :'get_ajax_customerdata'
                },
                success: function(response) {
                    $('#TB_ajaxContent').html(response);
                    $(this).trigger('click');
                }
            });
        
    });
});
</script>
