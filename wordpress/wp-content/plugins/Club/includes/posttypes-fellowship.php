<?php
class Fellowship extends WEOC_post_types_parent {
    public $cpt_name = "Fellowship";
    public $cpt_id = "Fellowship";
    public $cpt_dashicon = "dashicons-visibility";

    public function __construct(){
        $this->cpt_init();
        add_action('admin_menu', array($this,'select_fellows') );
        add_shortcode( 'fellowship', array($this,'fellowship_shortcode') );

    }

    public function select_fellows(){
        if (is_user_logged_in()){
            global $wpdb;
                $args = array(
                    'post_type' => 'posttypes_posttypes_people',
                    'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'Group',
                                'field'    => 'slug',
                                'terms'    => 'fellows',
                            ),
                        ),
                );
            $the_query = new WP_Query( $args );
                if ( $the_query->have_posts() ){
                    while ( $the_query->have_posts() ){
                        $the_query->the_post();
                        $titles[]=get_the_title();
                    }
                    $this->titles = $titles;
                }
            wp_reset_postdata();
        }
        $this->meta_boxes = array(
            "fellows_name[]" => array(
                "name" => "fellows_name",
                "std" => "",
                "type"=>"dropdown",
                "title" => "Fellows Name",
                "dropdown-qty" => "multiple",
                "values" =>$this->titles,
            ),
        );
    }
    public function fellowship_shortcode(){
        if ( ! is_admin() ) {
            global $wpdb;
            $args = array( 'post_type' => 'fellowship', 'posts_per_page' => 10 );
            $the_query = new WP_Query( $args );
            if ( $the_query->have_posts() ){
                while ( $the_query->have_posts() ){
                    $the_query->the_post();
                    ?>
                    <div class='wsrc_fields' style='padding:20px;color:#fff;background: #000;width: 30%;margin-top: 20px'>
                        <?php the_post_thumbnail();?>
                        <a href='<?php the_permalink()?>'><?php the_title()?></a>
                        <p style='color:#fff'><?php the_content()?></p>
                        <?php
                        the_meta()?>
                    </div>
                    <?php
                    wp_reset_postdata(); ?>
                    <?php
                }
            }
        }
    }
}
new Fellowship;