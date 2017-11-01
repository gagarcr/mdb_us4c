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

<div id="loader-opener" class="d-none">
  <h1 class="text-uppercase strong"><?php bloginfo( 'name' ); ?></h1>
</div>

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

      <a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content',
				'understrap' ); ?></a>
