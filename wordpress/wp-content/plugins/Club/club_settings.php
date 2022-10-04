<div class="wrap">
        <h2>Club Setting</h2>
        <form method="post" action="options.php">
            <?php settings_fields('custom_plugin_options_group'); ?>
        <table class="form-table">
            <tr>
                <th><label for="club_dashboard_link">Club Dashboard Page:</label></th>
                <td>
                        <?php wp_dropdown_pages( array( 
                        'name' => 'club_dashboard_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('club_dashboard_link'),
                        )); ?>
                </td>
            </tr>
            <tr>
                <th><label for="trainer_link">Trainer Page:</label></th>
                <td>
                    <?php wp_dropdown_pages( array( 
                        'name' => 'trainer_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('trainer_link'),
                        )); ?>
                </td>
            </tr>
            <tr>
                <th><label for="manage_club_link">Manage Club Page:</label></th>
                <td>
                    <?php wp_dropdown_pages( array( 
                        'name' => 'manage_club_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('manage_club_link'),
                        )); ?>
                </td>
            </tr>
            <tr>
                <th><label for="change_password_link">Change Password Page:</label></th>
                <td>
                    <?php wp_dropdown_pages( array( 
                        'name' => 'change_password_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('change_password_link'),
                        )); ?>
                </td>
            </tr>
            <tr>
                <th><label for="courses_link">Courses Page:</label></th>
                <td>
                    <?php wp_dropdown_pages( array( 
                        'name' => 'courses_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('courses_link'),
                        )); ?>
                </td>
            </tr>
            <tr>
                <th><label for="gym_link">Gym Page:</label></th>
                <td>
                    <?php wp_dropdown_pages( array( 
                        'name' => 'gym_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('gym_link'),
                        )); ?>
                </td>
            </tr>
            <tr>
                <th><label for="gym_link">Gym Booking list Page:</label></th>
                <td>
                    <?php wp_dropdown_pages( array( 
                        'name' => 'gym_booking_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('gym_booking_link'),
                        )); ?>
                </td>
            </tr>
            <tr>
                <th><label for="jobs_link">Jobs Page:</label></th>
                <td>
                    <?php wp_dropdown_pages( array( 
                        'name' => 'jobs_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('jobs_link'),
                        )); ?>
                </td>
            </tr>
            <tr>
                <th><label for="jobs_link">CSV Page:</label></th>
                <td>
                    <?php wp_dropdown_pages( array( 
                        'name' => 'csv_link', 
                        'show_option_none' => __( '— Select Page —' ), 
                        'option_none_value' => '0', 
                        'selected' => get_option('csv_link'),
                        )); ?>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
 
    </div>