<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<style>
.parallax { 
   min-height: 200px;
   height: 60vh; /* 60% of viewport height */
       margin: 0;
    padding: 0;
   /*max-height: 800px;*/
overflow: hidden;
position: relative;
} 

.parallax::before {
    content: " ";
    width :100%;
    min-height: 200px;
    height: 60vh;
    margin: 0;
    padding: 0;
    position: fixed;
    top:0;
    left:0;
    background: url('<?php echo( get_header_image() );?>') no-repeat bottom center;
    background-size: cover;
    z-index: -1;
       will-change: transform; /* creates a new paint layer */

}
h1 {
}


/* Resposive text */
h1.responsive-text{
    font-size: 3vw;
}
h2.responsive-text{
    font-size: 2vw;
}

.title {
    margin-bottom: 40px;
    text-transform:  uppercase;
    color: white;
    text-align: center;
}
.container-fluid{
    margin: 0;
    padding: 0;
}
.wrapper {
    background-color: white;
}

/* Vertical Align of child objetcs */
.vertical-align {
    display: flex;  
    align-items: center;
    justify-content: center;
    height: 100%;
    flex-direction: column;
}

.header-button {
    margin: 20px;

}
/* Navigation bar */
.navbar {
    background: white;
}
.mdb_nav {
    display: flex;
}
</style>

<div id="barba-wrapper">

	<?php 
	function get_current_template() {
	global $template;
	return basename($template, '.php');
	}
	?>
	<div data-namespace="<?php echo get_current_template() ?>" <?php body_class('barba-container') ?> >

		<div class="hfeed site" id="page">

			<!-- ******************* The Navbar Area ******************* -->
			<div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">

				<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content',
				'understrap' ); ?></a>

				<nav class="navbar navbar-expand-md navbar-dark bg-dark">

				<?php if ( 'container' == $container ) : ?>
					<div class="container">
				<?php endif; ?>

							<!-- Your site title as branding in the menu -->
							<?php if ( ! has_custom_logo() ) { ?>

								<?php if ( is_front_page() && is_home() ) : ?>

									<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
									
								<?php else : ?>

									<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
								
								<?php endif; ?>
								
							
							<?php } else {
								the_custom_logo();
							} ?><!-- end custom logo -->

						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<!-- The WordPress Menu goes here -->
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container_class' => 'collapse navbar-collapse',
								'container_id'    => 'navbarNavDropdown',
								'menu_class'      => 'navbar-nav',
								'fallback_cb'     => '',
								'menu_id'         => 'main-menu',
								'walker'          => new WP_Bootstrap_Navwalker(),
							)
						); ?>
					<?php if ( 'container' == $container ) : ?>
					</div><!-- .container -->
					<?php endif; ?>

				</nav><!-- .site-navigation -->

			</div><!-- .wrapper-navbar end -->
