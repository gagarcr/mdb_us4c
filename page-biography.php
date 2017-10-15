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

.biography-page {
	min-height: 100vh;
	//border-bottom: 1px solid black;
	position: relative; /* Reset x,y coord */


	//padding-bottom: 1em;
	//padding-top: 2em;
	padding-bottom: 4em;
	padding-top: 4em;

	/* Required to center the <h1> */
	display:flex;
    align-items: center; /* Horinzontal */
    //justify-content: center; /* Vertical */
	flex-direction: column;
}

/* Vertical centering. This is used instead of justify-content: center 
   in the parent element as we want the arrow to be placed at the bottom
   of the page */
.biography-page > .container { /* Only Direct child */
	margin-top: auto;
	margin-bottom: auto;
}

/* Reduce inner-paragraph spacing */
.biography-page p {
	margin-bottom: 0.5em;
}

.biography-exhibitions {
	padding-bottom: 4em;
}


a.scroll-arrow {
    font-size: 35px;
    color: black;
    width: 40px;
	height: 40px;
    line-height: 35px;
    border-radius: 50%;
    border: 0px solid white;
    display: block;
    //margin: 0 auto;
    //position: absolute;
    //margin-top: auto;
	//padding-bottom: 3em;
	//left: 50%;
    z-index: 1029;
    //-webkit-transform: translateX(-50%);
    //-moz-transform: translateX(-50%);
    //-ms-transform: translateX(-50%);
    //-o-transform: translateX(-50%);
    //transform: translateX(-50%);
    opacity: 1;
	box-sizing: border-box;
	//align-self: end;
	//mix-blend-mode: difference;	

	text-align: bottom;
}


a.scroll-arrow i {
	width: 100%;
	//height: 100%;
	//margin: auto;
	vertical-align:middle;
	
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
							<header class="biography-page biography-biography" id="sectionBioBiography">
								<div class="container">
									<div class="row justify-content-center align-items-center">
										<div class="col-12 col-lg-8">
											<h1 class="entry-title text-uppercase text-center pb-3"><?php the_title(); ?></h1>
											<div class="entry-short text-justify">
												<p>
													<?php the_content(); ?>
												</p>
											</div><!-- .entry-short -->

										</div><!-- .col -->
									</div><!-- .row -->
								</div> <!-- .container -->
								
								<a id="cli" href="#sectionBioStatement" class="scroll-arrow d-none d-md-block">
									<i class="fa fa-angle-down"></i>
								</a>
							</header><!-- .biography-biography -->
						
							<!-- Technical description page -->	
							<div class="biography-page biography-statement" id="sectionBioStatement">
								<div class="container">
									<div class="row justify-content-center align-items-center">
										<div class="col-12 col-lg-8">
											<h1 class="entry-title text-uppercase text-center pb-3"><?php the_field('statement_title'); ?></h1>
											<div class="entry-statement text-justify">
												<?php the_field('statement'); ?>
											</div><!-- .entry-statement -->
										</div><!-- .col -->
									</div><!-- .row -->		
								</div> <!-- .container -->
								<a id="cli" href="#sectionExhibitions" class="scroll-arrow d-none d-md-block">
									<i class="fa fa-angle-down"></i>
								</a>
							</div> <!-- .biography-statement -->
						
							<!-- full description page -->	
							<div class="biography-page biography-exhibitions" id="sectionExhibitions">
								<div class="container">
									<div class="row justify-content-center align-items-center">
										<div class="col-12 col-lg-8">
											<h1 class="entry-title text-uppercase text-center pb-3"><?php the_field('exhibitions_title'); ?></h1>
											<div class="entry-exhibitions text-justify">
												
												<?php 
												$table = get_field( 'exhibitions' );
												
												if ( $table ) {
												
													echo '<table class="table">';
												
														if ( $table['header'] ) {
												
															echo '<thead>';
												
																echo '<tr>';
												
																	foreach ( $table['header'] as $th ) {
												
																		echo '<th>';
																			echo $th['c'];
																		echo '</th>';
																	}
												
																echo '</tr>';
												
															echo '</thead>';
														}
												
														echo '<tbody>';
												
															foreach ( $table['body'] as $tr ) {
												
																echo '<tr>';
												
																	foreach ( $tr as $td ) {
												
																		echo '<td>';
																			echo $td['c'];
																		echo '</td>';
																	}
												
																echo '</tr>';
															}
												
														echo '</tbody>';
												
													echo '</table>';
												}
												
												 ?>
											</div><!-- .entry-statement -->
										</div><!-- .col -->
									</div><!-- .row -->
								</div><!-- .entry-long -->
							</div> <!-- .pbiography-exhibitions -->
						
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
