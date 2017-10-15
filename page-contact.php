<?php
/**
 * Template Name: Biography Page Template
 *
 * Template for displaying a blank page.
 *
 * @package mdb_us4c
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

.contact-page {
	min-height: 100vh;
	//border-bottom: 1px solid black;
	position: relative; /* Reset x,y coord */


	//padding-bottom: 1em;
	//padding-top: 2em;
	padding-bottom: 4em;
	padding-top: 4em;

	/* Required to center the <h1> */
	display:flex;
    align-items: center; /* Vertical */
    justify-content: center; /* Horinzontal */
	flex-direction: row;
}


/* Reduce inner-paragraph spacing */
.biography-page p {
	margin-bottom: 0.5em;
}



</style>

<div class="wrapper" id="single-wrapper">
	
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check. This creates a <div> -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

				<main class="site-main" id="main">
				
					<?php while ( have_posts() ) : the_post(); ?>

						<article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
							<header class="contact-page">
								<div class="container">
									<div class="row justify-content-center align-items-center text-justify">
										<div class="entry-technical-img col-12 col-lg-5">
											<?php the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive rounded-circle', 'title' => 'Contact image']); ?>
										</div><!-- .entry-technical-img .col -->
										<div class="entry-contact text-center text-lg-left col-12 col-lg-3">
											<h1 class="entry-title text-uppercase text-justify pb-3"><?php the_title(); ?></h1>

											<?php the_content(); ?>
										</div><!-- .entry-technical .col -->
									</div><!-- .row -->
								
								</div> <!-- .container -->
								
							</header><!-- .biography-biography -->
						</article>
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