<?php
/**
 * The template for displaying the contact page
 *
 * @package understrap
 */

get_header();

//$container   = get_theme_mod( 'understrap_container_type' );
$container   = 'container-fluid';
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<div class="wrapper" id="page-contact-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check. This creates a <div> -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

				<main class="site-main" id="main">		

          <?php while ( have_posts() ) : the_post(); ?>

            <article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">

              <div class="contact-page">

                <div class="container">
                
                  <div class="row justify-content-center">
                  
                    <div class="col-3 col-md-3 text-center">
                      <?php the_post_thumbnail('medium', ['class' => ' img-fluid rounded', 'title' => 'Contact image']); ?>
                    </div> <!-- .col -->

                    <div class"col-9 col-md-5">
                      <h1 class="content-title text-uppercase text-justify pb-3 "><?php the_title(); ?></h1>
                      <?php the_content(); ?>
                    </div> <!-- .col -->

                  </div> <!-- .row -->
                </div> <!-- .container -->
              </divr><!-- .contact-page -->

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
