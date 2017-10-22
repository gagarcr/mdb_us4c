<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

  wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
  wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array('jquery'), $the_theme->get( 'Version' ), false );
}


/**
 * --------------------------------------------------------------------------
 * MDB_US4C Custom theme setup
 * --------------------------------------------------------------------------
 */
function mdb_us4c_setup() {    
    // Set up the Wordpress Theme logo feature.
    add_theme_support( 'custom-logo', array(
        'width' => 150,
        'height' => 150,
        'flex-width' => true,
    ) );

    // Add custom-header.php inclusion. This handles the custom header
    // theme support.
    add_theme_support( 'custom-header', array(
        'flex-width'    => true,
        'width'         => 980,
        'flex-height'    => true,
        'height'        => 200,
        'default-image' => get_template_directory_uri() . '/images/header.jpg',
    ) );

    // Register new categories filter menu
    register_nav_menus( array(
        'category_filter' => 'Catergory Filter Menu'
    ) );
}

// Call mdb_us4c_setup
add_action( 'after_setup_theme', 'mdb_us4c_setup' );


/**
 * --------------------------------------------------------------------------
 * Helper Functions
 * --------------------------------------------------------------------------
 */
// Custom menu walker. Returns array of elements
function mdb_us4c_get_menu( $menu_name ) {
    if ( $menu_name !== '')
    {
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
            $menu = $locations[ $menu_name ];
            $menu_items = wp_get_nav_menu_items($menu);
            return ($menu_items);
        }
    }
   return false; 
}

?>

<?php
// TODO: REMOVE
ini_set('display_errors', 'On');
error_reporting(E_ALL);
?>
