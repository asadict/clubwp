<?php

class WEOC_post_types_parent2 {

    public $postId;
    public $meta_boxes;
    public $cpt_name="Sportcources";
    public $cpt_id;
    public $cpt_dashicon;
    public $taxonomy;
    public $taxonomy_url;

    public function __construct() {}

    public function cpt_init() {
        /*add_action( 'init', array($this,'customPostType_weoc_weoc_post_types_parent2'));
        add_action('init', array($this, 'add_taxonomy14'));
        add_action('init', array($this, 'add_taxonomy'));
        add_action('admin_menu', array($this, 'create_meta_box'));
        add_action('save_post', array($this, 'save_postdata'));
*/
    }

    public function add_taxonomy(){

        $labels = array(
            'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
            'all_items'                  => __( 'All Items', 'text_domain' ),
            'parent_item'                => __( 'Parent Item', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
            'new_item_name'              => __( 'New Item Name', 'text_domain' ),
            'add_new_item'               => __( 'Add New Item', 'text_domain' ),
            'edit_item'                  => __( 'Edit Item', 'text_domain' ),
            'update_item'                => __( 'Update Item', 'text_domain' ),
            'view_item'                  => __( 'View Item', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular Items', 'text_domain' ),
            'search_items'               => __( 'Search Items', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
            'no_terms'                   => __( 'No items', 'text_domain' ),
            'items_list'                 => __( 'Items list', 'text_domain' ),
            'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => array(
                'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'text_domain' ),
                'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
                'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
                'all_items'                  => __( 'All Items', 'text_domain' ),
                'parent_item'                => __( 'Parent Item', 'text_domain' ),
                'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
                'new_item_name'              => __( 'New Item Name', 'text_domain' ),
                'add_new_item'               => __( 'Add New Item', 'text_domain' ),
                'edit_item'                  => __( 'Edit Item', 'text_domain' ),
                'update_item'                => __( 'Update Item', 'text_domain' ),
                'view_item'                  => __( 'View Item', 'text_domain' ),
                'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
                'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
                'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
                'popular_items'              => __( 'Popular Items', 'text_domain' ),
                'search_items'               => __( 'Search Items', 'text_domain' ),
                'not_found'                  => __( 'Not Found', 'text_domain' ),
                'no_terms'                   => __( 'No items', 'text_domain' ),
                'items_list'                 => __( 'Items list', 'text_domain' ),
                'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
            ),
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'taxonomy', array( 'Sportkurse' ), $args );







        register_taxonomy(
            $this->taxonomy,
            array (
                0 => $this->cpt_id,
            ),
            array(
                'hierarchical' => true,
                'label' => $this->taxonomy,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array(
                    'slug' => $this->taxonomy_url
                ),
                'singular_label' => $this->taxonomy,
            )
        );
    }
    ////////////////////////////////////////



    public function add_taxonomy14(){

        $labels = array(
            'name'                       => _x( 'Taxonomies', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Taxonomy', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
            'all_items'                  => __( 'All Items', 'text_domain' ),
            'parent_item'                => __( 'Parent Item', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
            'new_item_name'              => __( 'New Item Name', 'text_domain' ),
            'add_new_item'               => __( 'Add New Item', 'text_domain' ),
            'edit_item'                  => __( 'Edit Item', 'text_domain' ),
            'update_item'                => __( 'Update Item', 'text_domain' ),
            'view_item'                  => __( 'View Item', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular Items', 'text_domain' ),
            'search_items'               => __( 'Search Items', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
            'no_terms'                   => __( 'No items', 'text_domain' ),
            'items_list'                 => __( 'Items list', 'text_domain' ),
            'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'taxonomy', array( 'Sportkurse' ), $args );







        register_taxonomy(
            $this->taxonomy1,
            array (
                0 => $this->cpt_id1,
            ),
            array(
                'hierarchical' => true,
                'label' => $this->taxonomy1,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array(
                    'slug' => $this->taxonomy_url1
                ),
                'singular_label' => $this->taxonomy1,
            )
        );




        register_taxonomy(
            $this->taxonomy2,
            array (
                0 => $this->cpt_id2,
            ),
            array(
                'hierarchical' => true,
                'label' => $this->taxonomy2,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array(
                    'slug' => $this->taxonomy_url2
                ),
                'singular_label' => $this->taxonomy2,
            )
        );



    }


    ///////////////////////////////////////////
    public function customPostType_weoc_weoc_post_types_parent2() {

        $labels = array(
            'name'	=> _x( $this->cpt_name, 'Post Type General Name', 'weoc' ),
            'singular_name'	=> _x( $this->cpt_name, 'Post Type Singular Name', 'weoc' ),
            'menu_name'	=> __( $this->cpt_name, 'weoc' ),
            'parent_item_colon'	=> __( 'Parent', 'weoc' ),
            'all_items'	=> __( 'All', 'weoc' ),
            'view_item'	=> __( 'View', 'weoc' ),
            'add_new_item'	=> __( 'Add New', 'weoc' ),
            'add_new'	=> __( 'Add New', 'weoc' ),
            'edit_item'	 => __( 'Edit', 'weoc' ),
            'update_item' 	=> __( 'Update', 'weoc' ),
            'search_items'	=> __( 'Search', 'weoc' ),
            'not_found'	=> __( 'Not Found', 'weoc' ),
            'not_found_in_trash'	=> __( 'Not found in Trash', 'weoc' ),
        );

        $args = array(
            'label'               => __( 'Sportcources', 'weoc' ),
            'description'         => __( 'Sportcources', 'weoc' ),
            'labels'              => 'Sportcources',
            'supports'            => array( 'title', 'custom-fields', 'editor', 'thumbnail' ),
            'taxonomies'          => array(),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            //  'show_in_rest'   	  => true,
            'menu_position'       => 10,
            'menu_icon'       => 'dashicons-dashboard',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',

        );

        register_post_type( $this->cpt_id, $args );
    }

    public function new_meta_boxes() {
        global $post;
        foreach ($this->meta_boxes as $meta_box) {
            $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
            if($meta_box_value == "") {
                $meta_box_value = $meta_box['std'];
            }
            if(isset($meta_box['type']) && $meta_box['type'] == 'textarea')
            {
                echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                echo'<table width="100%"><tbody>';
                echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                echo'<td><textarea style="width:100%;height:100px;border:1px solid black" name="'.$meta_box['name'].'">'.$meta_box_value.'</textarea></td></tr>';
                echo'</tbody></table>';
                echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
            }
            if(isset($meta_box['type']) && $meta_box['type'] == 'selet_Trainers')
            {
                ?>
                <select name="cars" id="cars">
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
                <?php
                /* echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                 echo'<table width="100%"><tbody>';
                 echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                 echo'<td><textarea style="width:100%;height:100px;border:1px solid black" name="'.$meta_box['name'].'">'.$meta_box_value.'</textarea></td></tr>';
                 echo'</tbody></table>';
                 echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';*/
            }



            else if(isset($meta_box['type']) && $meta_box['type'] == 'select'){
                if(isset($meta_box['dropdown-qty']) && $meta_box['dropdown-qty'] == 'multiple') {
                    $dropdown = $meta_box['name'].'<select multiple name="{$meta_box[name]}[]">';
                    foreach($meta_box['values'] as $key => $mbvalue)
                    {
                        $selected = (in_array($mbvalue,$meta_box_value)) ? 'selected="selected"' : "" ;
                        if(!is_numeric($key)) {
                            $dropdown .= "<option value='{$mbvalue}' {$selected}>{$key}</option>";
                        }
                        else {
                            $dropdown .= "<option {$selected}>{$mbvalue}</option>";
                        }
                    }
                }
                else {
                    $dropdown = '<select name="'.$meta_box['name'].'">';
                    foreach($meta_box['values'] as  $key => $mbvalue)
                    {
                        $selected = ($meta_box_value == $mbvalue) ? 'selected="selected"' : "" ;
                        if(!is_numeric($key)) {
                            $dropdown .= "<option value='{$mbvalue}' {$selected}>{$key}</option>";
                        } else
                        {
                            $dropdown .= "<option {$selected}>{$mbvalue}</option>";
                        }
                    }
                }
                $dropdown .= $meta_box['name'].'</select>';
                echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                echo'<table width="100%"><tbody>';
                echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                echo'<td>'.$dropdown.'</td></tr>';
                echo'</tbody></table>';
                echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
            }

            else if(isset($meta_box['type']) && $meta_box['type'] == 'file')
            {
                echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                echo'<table width="100%"><tbody>';
                echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                echo'<td><input style="width:30%" name="document_type" id="document_type"  value="'.$meta_box_value.'" size="80"  />';
                echo'<button class="button "  style=" display: inline-block;"  id="pdfUploadSettings" type="button" value="Upload Media" /><span style="display: inline-block; margin-top: 3px; " class="dashicons dashicons-upload"></span> Upload Media</button></td></tr>';
                echo'</tbody></table>';
                echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
            }
            else if(isset($meta_box['type']) && $meta_box['type'] == 'doc_file')
            {
                echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                echo'<table width="100%"><tbody>';
                echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                echo'<td><input style="width:30%" name="publicationsdocumenttype" id="publicationsdocumenttype"  value="'.$meta_box_value.'" size="80"  />';
                echo'<button class="button "  style=" display: inline-block;"  id="wsrcfile_button" type="button" value="Upload Media" /><span style="display: inline-block; margin-top: 3px; " class="dashicons dashicons-upload"></span> Upload Media</button></td></tr>';
                echo'</tbody></table>';
                echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
            }
            else if(isset($meta_box['type']) && $meta_box['type'] == 'input')
            {
                echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                echo'<table width="100%"><tbody>';
                echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                echo'<td><input type="text/number" name="'.$meta_box['name'].'" value="'.$meta_box_value.'" style="width: 100%;" /></td></tr>';
                echo'</tbody></table>';
                echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
            }
            else if(isset($meta_box['type']) && $meta_box['type'] == 'date')
            {
                echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                echo'<table width="100%"><tbody>';
                echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                echo'<td><input type="date" name="'.$meta_box['name'].'" value="'.$meta_box_value.'" style="width: 20%;" /></td></tr>';
                echo'</tbody></table>';
                echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
            }
            else if(isset($meta_box['type']) && $meta_box['type'] == 'dropdown')
            {
                ?>
                <select name="cars" id="cars">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="mercedes">Mercedes</option>
  <option value="audi">Audi</option>
</select>
           <?php
            }
            else if(isset($meta_box['type']) && $meta_box['type'] == 'checkbox')
            {
                $checked = ($meta_box_value) ? 'checked="checked"' : "" ;
                echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                echo'<table width="100%"><tbody>';
                echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                echo'<td><input type="checkbox" name="'.$meta_box['name'].'" value="1" '. $checked .' /></td></tr>';
                echo'</tbody></table>';
                echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
            }
            else if(isset($meta_box['type']) && $meta_box['type'] == 'dropdown-table')
            {
                if(isset($meta_box['dropdown-qty']) && $meta_box['dropdown-qty'] == 'multiple') {
                    $dropdown = "<select multiple name='{$meta_box['name']}[]'   style='width: 100%;'>";
                    foreach($meta_box['values'] as $key => $mbvalue)
                    {
                        if(is_array($meta_box_value)) {
                            $selected = (in_array($mbvalue['name'],$meta_box_value)) ? 'selected="selected"' : "" ;
                        }
                        if(!is_numeric($key)) {
                            $dropdown .= "<option value='{$mbvalue[name]}' {$selected}>{$key}</option>";
                        } else {
                            $dropdown .= "<option {$selected}>{$mbvalue[name]}</option>";
                        }
                    }
                    $dropdown .= '</select>';
                    echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                    echo'<table width="100%"><tbody>';
                    echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                    echo'<td>'.$dropdown.'</td></tr>';
                    echo'</tbody></table>';
                    echo'<table width="100%"><tbody>';
                    echo'<tr><td align="right" style="width: 184px;"><strong></strong></td>';
                    echo'<td><ul style="list-style:none;">';
                    foreach($meta_box['values'] as $key => $mbvalue)
                    {
                        if(is_array($meta_box_value)) {
                            if(in_array($mbvalue['name'],$meta_box_value)) {
                                if(!is_numeric($key)) {
                                    echo "<li>{$key}</li>";
                                } else {
                                    echo "<li><a target='_blank' href='{$mbvalue[link]}'>{$mbvalue[name]}</a></li>";
                                }
                            }
                        }
                    }
                    echo'</ul></td></tr></tbody></table>';
                    echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
                }
                else {
                    $dropdown = "<select name='{$meta_box[name]}'   style='width: 100%;'>";
                    foreach($meta_box['values'] as  $key => $mbvalue)
                    {
                        if(is_array($meta_box_value)) {
                            $selected = (in_array($mbvalue['name'],$meta_box_value)) ? 'selected="selected"' : "" ;
                        }
                        if(!is_numeric($key)) {
                            $dropdown .= "<option value='{$mbvalue[name]}' {$selected}>{$key}</option>";
                        } else {
                            $dropdown .= "<option {$selected}>{$mbvalue[name]}</option>";
                        }
                    }
                    $dropdown .= '</select>';
                    echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                    echo'<table width="100%"><tbody>';
                    echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                    echo'<td>'.$dropdown.'</td></tr>';
                    echo'</tbody></table>';
                    echo'<table width="100%"><tbody>';
                    echo'<tr><td align="right" style="width: 184px;"><strong></strong></td>';
                    echo'<td><ul style="list-style:none;">';

                    foreach($meta_box['values'] as $key => $mbvalue){
                        if(is_array($meta_box_value)) {
                            if(in_array($mbvalue['name'],$meta_box_value)) {
                                if(!is_numeric($key)) {
                                    echo "<li>{$key}</li>";
                                } else {
                                    echo "<li><a target='_blank' href='{$mbvalue[link]}'>{$mbvalue[name]}</a></li>";
                                }
                            }
                        }
                    }
                    echo'</ul></td></tr></tbody></table>';
                    echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
                }
            }
            else if(isset($meta_box['type']) && $meta_box['type'] == 'dropdown')
            {
                if(isset($meta_box['dropdown-qty']) && $meta_box['dropdown-qty'] == 'multiple') {
                    $dropdown = "<select class='js-example-basic-multiple' name='" . $meta_box['name'] . "[]' multiple='multiple'>";
                    foreach($meta_box['values'] as $key => $mbvalue)
                    {
                        if(is_array($meta_box_value)) {
                            $selected = (in_array($mbvalue,$meta_box_value)) ? 'selected="selected"' : "" ;
                        }
                        if(!is_numeric($key)) {
                            $dropdown .= "<option value='{$mbvalue}' {$selected}>{$key}</option>";
                        } else {
                            $dropdown .= "<option {$selected}value='{$mbvalue}'>{$mbvalue}</option>";
                        }
                    }
                }
                else {
                    $dropdown = "<select class='js-example-basic-multiple' name='" . $meta_box['name'] . "[]' multiple='multiple'>";
                    foreach($meta_box['values'] as  $key => $mbvalue)
                    {
                        $selected = ($meta_box_value == $mbvalue) ? 'selected="selected"' : "" ;
                        if(!is_numeric($key)) {
                            $dropdown .= "<option value=".$meta_box['value']." {$selected}>{$key}</option>";
                        } else {
                            $dropdown .= "<option {$selected}>{$mbvalue}</option>";
                        }
                    }
                }
                $dropdown .= '</select>';
                echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
                echo'<table width="100%"><tbody>';
                echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
                echo'<td>'.$dropdown.'</td></tr>';
                echo'</tbody></table>';
                echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
            }



        }
    }

    public function create_meta_box() {
        if ( function_exists('add_meta_box') ) {
            add_meta_box( 'new-meta-boxes', 'Details', array($this,'new_meta_boxes'), $this->cpt_id, 'normal', 'high' );
        }
    }

    public function save_postdata( $post_id ) {
        global $post;
        foreach($this->meta_boxes as $meta_box)
        {
            if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
                return $post_id;
            }
            if ( 'page' == $_POST['post_type'] ) {
                if ( !current_user_can( 'edit_page', $post_id ))
                    return $post_id;
            } else {
                if ( !current_user_can( 'edit_post', $post_id ))
                    return $post_id;
            }
            $data = $_POST[$meta_box['name']];
            if(get_post_meta($post_id, $meta_box['name']) == "")
                add_post_meta($post_id, $meta_box['name'], $data, true);
            elseif($data != get_post_meta($post_id, $meta_box['name'], true))
                update_post_meta($post_id, $meta_box['name'], $data);
            elseif($data == "")
                delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
        }
    }
}
new WEOC_post_types_parent2;