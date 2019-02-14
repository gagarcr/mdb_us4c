<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

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
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'popper-scripts', get_stylesheet_directory_uri() . '/js/popper.min.js', array(), false);
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );


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
        'default-text-color' => 'ffffff',
        'width'         => 1440,
        'height'        => 600,
        'flex-width'    => true,
        'flex-height'    => true,
        'default-image' => get_template_directory_uri() . '/images/header.jpg',
    ) );

    // Register new categories filter menu
    register_nav_menus( array(
        'category_filter' => 'Catergory Filter Menu'
    ) );
}


/**
 * --------------------------------------------------------------------------
 * THEME Customizer Functions
 * --------------------------------------------------------------------------
 */

 function mdb_us4c_customize_register( $wp_customize ) {
  // Create a theme-specific section
  $wp_customize->add_section( 'mdb_us4c', array(
    'title' => __( 'MDB_US4C' ),
    'description' => __( 'MDB_US4C Personalization'),
    'panel' => '', // Not typically needed.
    'priority' => 160,
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
  ) );

  // Header parallax
  $wp_customize->add_setting( 'setting_header_parallax_id', array(
    'type' => 'theme_mod', // or 'option'. Theme mod only affects this theme.
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => 'true',
    'transport' => 'postMessage', // refresh or postMessage (no-refresh)
    'sanitize_callback' => '', // ensure that no unsafe data is stored in the database
    'sanitize_js_callback' => '', // Basically to_json.
  ) );
  $wp_customize->add_control( 'setting_header_parallax_id', array(
    'type' => 'checkbox', // <input>, checkbox, textarea, radio, select, dropdown-pages
    'priority' => 10, // Within the section.
    'section' => 'mdb_us4c', // Required, core or custom.
    'label' => __( 'Header Parallax' ),
    'description' => __( 'Parallax header effect enable.' ),
    'active_callback' => 'is_front_page',
    //'setting' => 'setting_header_parallax', // Accesible from php get_theme_mod('setting_header_parallax')  If not defined, then the $id as the setting ID is used.
  ) );

  // Header height
  $wp_customize->add_setting( 'setting_header_height_id', array(
    'type' => 'theme_mod', // or 'option'. Theme mod only affects this theme.
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => '60',
    'transport' => 'postMessage', // refresh or postMessage (no-refresh)
    'sanitize_callback' => 'absint', // ensure that no unsafe data is stored in the database
    'sanitize_js_callback' => '', // Basically to_json.
  ) );
  $wp_customize->add_control( 'setting_header_height_id', array(
    'type' => 'number', // <input>, checkbox, textarea, radio, select, dropdown-pages
    'priority' => 10, // Within the section.
    'section' => 'mdb_us4c', // Required, core or custom.
    'label' => __( 'Header Height' ),
    'description' => __( 'Set the header height in % of the view port height' ),
    'active_callback' => 'is_front_page',
  ) );

  // Max-height limit
  $wp_customize->add_setting( 'setting_max_height_enable_id', array(
    'type' => 'theme_mod', // or 'option'. Theme mod only affects this theme.
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => 'true',
    'transport' => 'postMessage', // refresh or postMessage (no-refresh)
    'sanitize_callback' => '', // ensure that no unsafe data is stored in the database
    'sanitize_js_callback' => '', // Basically to_json.
  ) );
  $wp_customize->add_control( 'setting_max_height_enable_id', array(
    'type' => 'checkbox', // <input>, checkbox, textarea, radio, select, dropdown-pages
    'priority' => 10, // Within the section.
    'section' => 'mdb_us4c', // Required, core or custom.
    'label' => __( 'Max height limit enable' ),
    'description' => __( 'Limit the maximum height of the header and body.' ),
    'active_callback' => 'is_front_page',
    //'setting' => 'setting_header_parallax', // Accesible from php get_theme_mod('setting_header_parallax')  If not defined, then the $id as the setting ID is used.
  ) );

  // Max-height limit
  $wp_customize->add_setting( 'setting_max_height_id', array(
    'type' => 'theme_mod', // or 'option'. Theme mod only affects this theme.
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => '600',
    'transport' => 'postMessage', // refresh or postMessage (no-refresh)
    'sanitize_callback' => '', // ensure that no unsafe data is stored in the database
    'sanitize_js_callback' => '', // Basically to_json.
  ) );
  $wp_customize->add_control( 'setting_max_height_id', array(
    'type' => 'number', // <input>, checkbox, textarea, radio, select, dropdown-pages
    'priority' => 10, // Within the section.
    'section' => 'mdb_us4c', // Required, core or custom.
    'label' => __( 'Max height value' ),
    'description' => __( 'Maximum height in px' ),
    'active_callback' => 'is_front_page',
    //'setting' => 'setting_header_parallax', // Accesible from php get_theme_mod('setting_header_parallax')  If not defined, then the $id as the setting ID is used.
  ) );

  // Max-width limit
  $wp_customize->add_setting( 'setting_max_width_enable_id', array(
    'type' => 'theme_mod', // or 'option'. Theme mod only affects this theme.
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => 'true',
    'transport' => 'postMessage', // refresh or postMessage (no-refresh)
    'sanitize_callback' => '', // ensure that no unsafe data is stored in the database
    'sanitize_js_callback' => '', // Basically to_json.
  ) );
  $wp_customize->add_control( 'setting_max_width_enable_id', array(
    'type' => 'checkbox', // <input>, checkbox, textarea, radio, select, dropdown-pages
    'priority' => 10, // Within the section.
    'section' => 'mdb_us4c', // Required, core or custom.
    'label' => __( 'Max width limit enable' ),
    'description' => __( 'Limit the maximum width of the header and body.' ),
    'active_callback' => 'is_front_page',
    //'setting' => 'setting_header_parallax', // Accesible from php get_theme_mod('setting_header_parallax')  If not defined, then the $id as the setting ID is used.
  ) );

  // Max-width limit
  $wp_customize->add_setting( 'setting_max_width_id', array(
    'type' => 'theme_mod', // or 'option'. Theme mod only affects this theme.
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => '1440',
    'transport' => 'postMessage', // refresh or postMessage (no-refresh)
    'sanitize_callback' => '', // ensure that no unsafe data is stored in the database
    'sanitize_js_callback' => '', // Basically to_json.
  ) );
  $wp_customize->add_control( 'setting_max_width_id', array(
    'type' => 'number', // <input>, checkbox, textarea, radio, select, dropdown-pages
    'priority' => 10, // Within the section.
    'section' => 'mdb_us4c', // Required, core or custom.
    'label' => __( 'Max width value' ),
    'description' => __( 'Maximum width in px' ),
    'active_callback' => 'is_front_page',
    //'setting' => 'setting_header_parallax', // Accesible from php get_theme_mod('setting_header_parallax')  If not defined, then the $id as the setting ID is used.
  ) );

  /* Add grid background color */
  $wp_customize->add_setting( 'setting_grid_background_color_id', array(
    'type' => 'theme_mod', // or 'option'. Theme mod only affects this theme.
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => '#F5F5F5',
    'transport' => 'postMessage', // refresh or postMessage (no-refresh)
    'sanitize_callback' => '', // ensure that no unsafe data is stored in the database
    'sanitize_js_callback' => '', // Basically to_json.
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'setting_grid_background_color_id', array(
    'label'      => __( 'Project grid background color', 'understrap' ),
    'section'    => 'colors',
  ) ) );

  /* Add navbar text color */
  $wp_customize->add_setting( 'setting_navbar_text_color_id', array(
    'type' => 'theme_mod', // or 'option'. Theme mod only affects this theme.
    'capability' => 'edit_theme_options',
    'theme_supports' => '', // Rarely needed.
    'default' => '#8C8C8C',
    'transport' => 'postMessage', // refresh or postMessage (no-refresh)
    'sanitize_callback' => '', // ensure that no unsafe data is stored in the database
    'sanitize_js_callback' => '', // Basically to_json.
  ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'setting_navbar_text_color_id', array(
    'label'      => __( 'Navigation bar text color', 'understrap' ),
    'section'    => 'colors',
  ) ) );
}

/**
 * --------------------------------------------------------------------------
 * Live preview JS
 * --------------------------------------------------------------------------
 */
function mdb_us4c_customizer_live_preview_js()
{
  wp_enqueue_script( 'mdb_us4c-themecustomizer', get_stylesheet_directory_uri() . '/js/mdb_us4_theme-customizer.js',
      array( 'jquery', 'customize-preview' ), '', true );
}


/**
 * --------------------------------------------------------------------------
 * Add actions
 * --------------------------------------------------------------------------
 */
// Call mdb_us4c_setup
add_action( 'after_setup_theme', 'mdb_us4c_setup' );

// Add customizer options
add_action('customize_register','mdb_us4c_customize_register');

// Add theme customization output to wp_head
add_action( 'wp_head', 'mdb_us4c_customize_css');

// Live preview js
add_action( 'customize_preview_init', 'mdb_us4c_customizer_live_preview_js' );


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
 
// Modify default [...]
function custom_excerpt_more( $more ) {
  return ' [...]';
}

/* Modify understrap add more button */
function all_excerpts_get_more_link( $post_excerpt ) {
  return $post_excerpt;
}

/* Theme customization output */
function mdb_us4c_customize_css()
{
  ?>
    <style type="text/css">
      /* Header parallax effect */
      <?php if (get_theme_mod('setting_header_parallax_id') == false): ?>
        .home-page .parallax .parallax-fixed {
          position: absolute;
        }
      <?php endif; ?>

      /* Header height */
      .home-page .parallax, .home-page .parallax .parallax-fixed {
        height: <?php echo get_theme_mod('setting_header_height_id', '60') ?>vh; 
      }

      /* Max height */
      .home-page .parallax, .home-page .parallax .parallax-fixed {
        max-height: <?php
          if (get_theme_mod('setting_max_height_enable_id') == false){
            echo ('none');
          }
          else {
            echo (get_theme_mod('setting_max_height_id', '600'));
            echo ('px');
          } 
        ?>;  
      }

      /* Max width */
      .home-page .parallax .parallax-fixed, #wrapper-index .navbar-mobile, .home-page > .container-fluid {
        max-width: <?php
          if (get_theme_mod('setting_max_width_enable_id') == false){
            echo ('none');
          }
          else {
            echo (get_theme_mod('setting_max_width_id', '1440'));
            echo ('px');
          } 
        ?>;  
      }

      /* Project grid background color */
      .home-page .custom-logo-link, .home-page .grid-item, .home-page > .container-fluid {
        background-color: <?php echo (get_theme_mod('setting_grid_background_color_id')) ?>;
      }

      /* Navigation bar text color */
      .home-page #navbar-selector .nav-link {
        color: <?php echo (get_theme_mod('setting_navbar_text_color_id')) ?>;
      }


    </style>
  <?php
}


/**
 * --------------------------------------------------------------------------
 * Debug
 * --------------------------------------------------------------------------
 */

if (0) {
  ini_set('display_errors', 'On');
  error_reporting(E_ALL);
}

?>
