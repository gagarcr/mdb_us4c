<?php
/**
 * The template for displaying the biography page
 *
 * @package understrap
 */

get_header();

//$container   = get_theme_mod( 'understrap_container_type' );
$container   = 'container-fluid';
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<div class="wrapper" id="page-biography-wrapper">
	
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
                                    if ($td['c'] == ""):
                                      echo '<td class="td-inner-year">';
                                    else:
                                      echo '<td>';
                                    endif;

																			echo $td['c'];
																		echo '</td>';
																	}
												
																echo '</tr>';
															}
												
														echo '</tbody>';
												
													echo '</table>';
												}
												
												 ?>

											</div><!-- .entry-exhibitions -->

										</div><!-- .col -->
									</div><!-- .row -->
								</div><!-- .container -->

							</div> <!-- .biography-exhibitions -->
						
						</article>
					<?php endwhile; // end of the loop. ?>
					
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
