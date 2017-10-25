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

<body id="mdb_us4c-body">

  <svg class="hideSvgSoThatItSupportsFirefox">
    <filter id="sharpBlur">
      <feGaussianBlur stdDeviation="30"></feGaussianBlur>
      <feColorMatrix type="matrix" values="1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 9 0"></feColorMatrix>
      <feComposite in2="SourceGraphic" operator="in"></feComposite>
    </filter>
  </svg>

<div id="barba-wrapper">
	<?php 
		function get_current_template() {
		global $template;
		return basename($template, '.php');
		}
	?>
	<!-- Barba namespace -->
	<div data-namespace="<?php echo get_current_template() ?>" <?php body_class('barba-container') ?> >

		<div class="hfeed site" id="page">

			<?php if(0): ?>
			<div class="d-none">
				<?php if ( 'container' == $container ) : ?>
					<div class="container">
				<?php endif; ?>

					<h1 class="title responsive-text mt-1 mr-3 text-right text-uppercase"> 
						<?php
							$title = get_bloginfo( 'name', 'raw');
							$title_words = explode(' ', $title);
							foreach ($title_words as $value)
							{
								echo ($value . ".  ");
							}
						?>
					</h1>
				<?php if ( 'container' == $container ) : ?>
					</div><!-- .container -->
				<?php endif; ?>
			</div><!-- .d-none -->
			<?php endif; ?>


	




			<?php if (0): ?>

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
								//$custom_logo_id = get_theme_mod( 'custom_logo' );
								//$logo = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
								//echo '<img src="'. esc_url( $logo[0] ) .'">';
								the_custom_logo();
							} ?><!-- end custom logo -->

						<button class="navbar-toggler" type="button" data-toggle="collapse-filter" data-target="#navbarNavDropdown-filter" aria-controls="navbarNavDropdown-filter" aria-expanded="false" aria-label="Toggle">
							<span class="navbar-toggler-icon"></span>
						</button>

						<!-- The WordPress Menu goes here -->
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'container_class' => 'collapse-filter navbar-collapse',
								'container_id'    => 'navbarNavDropdown-filter',
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

			<?php endif; ?>


	