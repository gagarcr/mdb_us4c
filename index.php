
 <style>
 * {
	//background-color: rgba(123,120,120,0.2);
	//border: 1px solid black;
 }




 .parallax { 
    min-height: 200px;
    height: 60vh; /* 60% of viewport height */
    margin: 0;
    padding: 0;
    /*max-height: 800px;*/
	overflow: hidden;
	position: relative;
	z-index: -1;
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
    background: url('<?php echo( get_header_image() );?>') no-repeat top center;
    background-size: cover;
    z-index: -1;
    will-change: transform; /* creates a new paint layer */
}








/* Vertical align ( childs, apply to parent ). 
   Alernative to: "container d-flex h-100 justify-content-center align-items-center" justify-content-center (horizontal, flexbox) align-items-center(vertival, flexbox)*/
.v-align-child-center {
	display:flex;
	height:100%;
  	align-items:center;
}

/* Other option for vertical align */
.v-align-self-center {
	margin-top: auto;
	margin-bottom: auto;
}

/* Horizon align 
   Alternative to: "justify-content-center" */
.h-align-self-center {
	margin-left: auto;
	margin-right: auto;
}

/* Custom logo width */
.custom-logo-link > img {
	width: 50px;
	mix-blend-mode: multiply;
}

/* General style edits */
/* Remove card border. 
	We use the body selector to override boostrap4 styles 	
	#mdb_us4c-body .card 
	
	Or 2 selctors ( '.' = and )
*/
.card.grid-item {
	border: none;
}
/* Hover projects.
.card-img-overlay is the overall hover. A .card-img is located below that acts as a background for the hover (that can be blurred)
*/
.card.grid-item:hover .overlay {
        opacity: 1;
}
.card.grid-item .card-a {
	overflow: hidden;
	background-color: white;
	position: relative;
}

.card.grid-item .overlay {
	position: absolute;
	top: auto;
	left: 0;
	bottom: 0;
	right: 0;

	height: 5em;
	opacity: 0;
	overflow: hidden; 	/* The contents (img) will be bigger, we dont want to show anything */

	background-color: white; /* We set the content with a background, and the content::before with the background blurred. This prevents
									the edges being transparentens on the blurred background */
	background-size: cover;       
	border-radius: calc(.25rem - 1px);

	/* Create a common z-workspace for .overlay childs */
	z-index: 0;

	/* Required to center the <h1> */
	display:flex;
    align-items: center;
    justify-content: center;
}
	


.card.grid-item .overlay .card-img {
	/* We set to absolute and start in the coordinates of the parent. This way we dont distort
       the image, and it is alligned */
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;

	opacity: 1;

	transform: translateY(-100%) translateY(+5em) translateZ(0); /* Move 100% up, the 5 em down */
    //clip: rect(0px,60px,200px,0px);
	//object-fit: cover;
	//object-position: bottom;

	 z-index: 1;
}

.card.grid-item .overlay::before {
	position: absolute;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;

	background-color: rgba(0,0,0,0.4);

	z-index: 2;
	content: ' ';
}
/* Position card-title in the center */
.card.grid-item .overlay .card-title{
	position: relative; 
	margin: 0;
	//height: 2.5em;

	z-index: 4;
}

/* transitions */
.overlay {
	transition: opacity 0.25s ease;
}




  
 </style>

<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */


$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero', 'none' ); ?>
<?php endif; ?>

<?php get_header(); ?>


<div class="container-fluid hidden-sm-block visible-md-block visible-lg-block page-header">
	<div class="parallax">							
		
	</div> <!-- parallax -->
</div>


<div class="wrapper" id="wrapper-index">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">



			<!-- ******************* The Filter Navbar Area ******************* -->
			<div class="wrapper-fluid wrapper-navbar hidden-xl-down" id="wrapper-navbar">
				<nav class="navbar sticky-top  navbar-expand-md navbar-inverse">
				<?php if ( 'container' == $container ) : ?>
					<div class="container">
				<?php endif; ?>
						<!-- The WordPress Menu goes here. Only on >sm screen -->
						<ul id="filter-menu" class="navbar-nav nav-fill w-100 filter-button-group nav-pills"> <!-- Add selector for filter js, nav pills make button-like -->

							<?php		
								$menu_items = mdb_us4c_get_menu('primary');
								foreach ($menu_items as $menu_item) {
									echo ("<li class='d-none d-md-flex align-items-center menu-item menu-item-type-taxonomy menu-item-object-category nav-item text-uppercase'><a class='w-100 nav-link' href='" . $menu_item->url . "' >" . $menu_item->title . "</a></li>");							
								}
							?>

							<li class='menu-item menu-item-type-taxonomy menu-item-object-category nav-item '>				
								<!-- Your site title as branding in the menu -->
								<?php if ( ! has_custom_logo() ) { ?>

									<?php if ( is_front_page() && is_home() ) : ?>

										<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
										
									<?php else : ?>

										<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
									
									<?php endif; ?>
								<?php } else { ?>
									<a class="navbar-brand custom-logo-link d-none d-md-block w-100" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
									<?php
										$custom_logo_id = get_theme_mod( 'custom_logo' );
										$logo = wp_get_attachment_image_src( $custom_logo_id , 'thumbnail' );
										echo '<img src="'. esc_url( $logo[0] ) .'"  class="img-fluid" alt="logo" itemprop="logo" >';
										//the_custom_logo();
									?>
									</a>
								<?php } ?>
							</li>
							<!-- end custom logo -->
							
							<!-- The filter menu -->
							<?php		
								$menu_items = mdb_us4c_get_menu('category_filter');
								foreach ($menu_items as $menu_item) {
									echo ("<li class='align-items-center d-flex menu-item menu-item-type-taxonomy menu-item-object-category nav-item text-uppercase'><a class='w-100 nav-link' data-filter='.category-" . $menu_item->title . "' >" . $menu_item->title . "</a></li>");							
								}
								
								// Create filter for isotope
								$other_filter = ":not(";
								foreach ($menu_items as $menu_item) {
									$other_filter .= '.category-' . $menu_item->title . ', ';
								}
								// Remove last ',' 
								$other_filter = rtrim($other_filter, ', ');
								$other_filter .= ")";

								// Add "Other"
								echo ("<li class='align-items-center d-flex menu-item menu-item-type-taxonomy menu-item-object-category nav-item text-uppercase'><a class='w-100 nav-link' data-filter='" . $other_filter . "' >Other</a></li>");							
								
								
								
							?>

						</ul>
					<?php if ( 'container' == $container ) : ?>
					</div><!-- .container -->
					<?php endif; ?>

				</nav><!-- .site-navigation -->

			</div><!-- .filter navbar end -->

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<!-- Add grid containter to the main class -->
			<main class="site-main <?php echo esc_attr( $container ); ?>" id="main">
				<div class="row grid"> 
				<!--<div class="card-columns grid">-->
					<!-- Required for grid library. Add sizing element for columnWidth -->
					<!-- TODO: CHANGE!!! -->
					<div class="col-md-4 grid-sizer d-none" ></div>
					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php

							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part( 'loop-templates/content', get_post_format() );
							?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>
				</div><!-- #div row -->
			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php get_sidebar( 'right' ); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<!-- TODO: remove from here -->
<style>
.grid {
    /* Enable HW acceleration */
    transform:translate3d(0,0,0);
}
</style>
<?php get_footer(); ?>
