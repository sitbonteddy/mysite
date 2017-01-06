<?php
// Remove the admin bar from the front end
add_filter( 'show_admin_bar', '__return_false' );

// ACTIVATION MENU
add_theme_support('menus');

// ACTIVATION DES IMAGES A LA UNE
add_theme_support( 'post-thumbnails' );
  /*******************************************************************/
 /******************** TYPE DE CONTENU ******************************/
/*******************************************************************/

// CREATION DU TYPE DE CONTENU
add_action( 'init', 'register_cpt_portfolio');

// FONCTIONS DU TYPE DE CONTENU
function register_cpt_portfolio() {

    $labels = array( 
        'name' => _x( 'Portfolio', 'portfolio_kapsul' ),
        'singular_name' => _x( 'Portfolio', 'portfolio_kapsul' ),
        'add_new' => _x( 'Ajouter', 'portfolio_kapsul' ),
        'add_new_item' => _x( 'Ajouter un projet', 'portfolio_kapsul' ),
        'edit_item' => _x( 'Editer le contenu', 'portfolio_kapsul' ),
        'new_item' => _x( 'Nouveau contenu', 'portfolio_kapsul' ),
        'view_item' => _x( 'Voir le contenu', 'portfolio_kapsul' ),
        'search_items' => _x( 'Rechercher', 'portfolio_kapsul' ),
        'not_found' => _x( 'Rien ici', 'portfolio_kapsul' ),
        'not_found_in_trash' => _x( 'Rien ici', 'portfolio_kapsul' ),
        'parent_item_colon' => _x( 'Contenu parent :', 'portfolio_kapsul' ),
        'menu_name' => _x( 'Portfolio', 'portfolio_kapsul' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Les contenus du Portfolio',
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 3,
        
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        
        'menu_icon' => 'dashicons-format-image'
    );

    register_post_type( 'portfolio', $args );
}

  /*******************************************************************/
 /******************** CMB 2 ****************************************/
/*******************************************************************/


if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
    require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

//require_once WP_PLUGIN_DIR . '/cmb2/init.php';
/*
if ( ! function_exists( 'cmb2_attached_posts_fields_render' ) ) {
    require_once WP_PLUGIN_DIR . '/cmb2/cmb2-attached-posts-field.php';
}
*/
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function cmb2_hide_if_no_cats( $field ) {
    // Don't show this field if not in the cats category
    if ( ! has_tag( 'cats', $field->object_id ) ) {
        return false;
    }
    return true;
}

add_filter( 'cmb2_meta_boxes', 'teddy_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function teddy_metaboxes( array $meta_boxes ) {

    $prefix = 'teddy_';
    
    $meta_boxes['home'] = array(
        'id'         => 'home',
        'title'      => __( 'Informations complémentaires pour la page', 'cmb2' ),
        'object_types' => array( 'page' ), 
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on'      => array( 'id' => array( 4 ) ),
        'fields'     => array(
			array(
                'name'         => __( 'Skills sur la home', 'cmb2' ),
                'desc'         => __( 'Ajouter du texte', 'cmb2' ),
                'id'           => $prefix . 'skills',
			    'type'    => 'text',
			    'repeatable' => true,
            ),
        ),
    );

    $meta_boxes['portfolio'] = array(
        'id'         => 'portfolio',
        'title'      => __( 'Informations complémentaires pour la page Portfolio', 'cmb2' ),
        'object_types' => array( 'portfolio' ), 
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
			array(
                'name'         => __( 'Skills du projet', 'cmb2' ),
                'desc'         => __( 'Ajouter du texte', 'cmb2' ),
                'id'           => $prefix . 'skills',
			    'type'    => 'text',
			    'repeatable' => true,
            ),
        ),
    );
    $meta_boxes['portfolio2'] = array(
        'id'         => 'portfolio2',
        'title'      => __( 'Informations complémentaires pour l\'article', 'cmb2' ),
        'object_types' => array( 'portfolio' ), 
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'         => __( 'Agence', 'cmb2' ),
                'desc'         => __( 'Ajouter du texte', 'cmb2' ),
                'id'           => $prefix . 'agence',
                'type'    => 'text',
            ),
            array(
                'name'         => __( 'Client', 'cmb2' ),
                'desc'         => __( 'Ajouter du texte', 'cmb2' ),
                'id'           => $prefix . 'client',
                'type'    => 'text',
            ),
            array(
                'name'         => __( 'Site web', 'cmb2' ),
                'desc'         => __( 'Ajouter du texte', 'cmb2' ),
                'id'           => $prefix . 'web',
                'type'    => 'text',
            ),
        ),
    );
    

    return $meta_boxes;
}


?>