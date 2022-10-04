<?php

global $wpdb, $table_prefix;
$url = site_url();

//require_once('wp-config.php');
//require_once('wp-includes/wp-db.php');

$url = site_url();
?>

<h3>Herzlich Willkommen in Deinem Admin-Bereich</h3>
<p> Was möchtest du heute tun? </p>
<ul class="hm-dashboard-menu">
	<li> <a href="<?=esc_url( get_page_link( get_option('club_dashboard_link') ) );?>">Startseite</a> </li>
    
    <li> <a href="<?=esc_url( get_page_link( get_option('manage_club_link') ) );?>">Meine Daten
        </a> </li>
    <li> <a href="<?=esc_url( get_page_link( get_option('change_password_link') ) );?>">Passwort ändern
        </a> </li>
	<li> <a href="<?=esc_url( get_page_link( get_option('gym_booking_link') ) );?>">Loaction Buchen
        </a> </li>
    <li> <a href="<?=esc_url( get_page_link( get_option('courses_link') ) );?>">Kurs anlegen / bearbeiten
        </a> </li>
	<li> <a href="<?=esc_url( get_page_link( get_option('trainer_link') ) );?>">Trainer hinzufügen</a></li>
    
    <li> <a href="<?=esc_url( get_page_link( get_option('jobs_link') ) );?>">Jobs anlegen / bearbeiten
        </a> </li>
	<li> <a href="<?=esc_url( get_page_link( get_option('gym_link') ) );?>">Location anlegen / bearbeiten
        </a> </li>
        <li> <a href="<?=esc_url( get_page_link( get_option('csv_link') ) );?>">CSV Download
        </a> </li>
        <li><a href="<?php echo esc_url( wp_logout_url() ); ?>">Logout
        </a></li></li>
</ul>
