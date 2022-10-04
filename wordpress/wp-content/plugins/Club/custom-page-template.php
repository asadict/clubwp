<?php 
get_header();
global $post;
echo $author_id = get_post_field( 'post_author', $post->ID);
get_footer();
?>