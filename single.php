<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();

//TODO: implement understrap_project_container_type
//$container   = get_theme_mod( 'understrap_container_type' );
$container   = 'container-fluid';
//$container   = 'no-gutters';
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>
<style>
* {
	//background-color: rgba(10,220,320,0.2);
	//border: 1px solid black;
 }


#single-wrapper {
	margin: 0;
	padding: 0;
	
}

#main {
	margin: 0;
	padding: 0;
}

/* left-sidebar-check creates a single cell, that has a padding of 15.
   We dont need that */
#primary {
	padding: 0;
} 


/* Make post-navigation float */
.post-navigation-bar {
	position: fixed;
	top: 2em;
	bottom: auto;
	right: 1em;
	left: auto;
	mix-blend-mode: difference;	
}





</style>

<div class="wrapper" id="single-wrapper">
	
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check. This creates a <div> -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

				<main class="site-main" id="main">
				
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'single' ); ?>

							<?php //understrap_post_nav(); ?>
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php endwhile; // end of the loop. ?>

					
					<div class="post-navigation-bar">
						<a href="<?php echo get_home_url(); ?>" aria-label="Close">
							<img class="img-fluid" alt="x" aria-hidden="true" src="<?php echo  get_stylesheet_directory_uri() . '/fonts/ic_close_white_32px.svg'; ?>"></img>
							<span class="sr-only">&times;</span>			
						</a>					
					</div>
				</main><!-- #main -->

			</div><!-- #primary -->

			<!-- Do the right sidebar check -->
			<?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

				<?php get_sidebar( 'right' ); ?>

			<?php endif; ?>

		</div><!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
