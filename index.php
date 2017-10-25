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

<!-- Header -->
<?php get_header(); ?>

<div class="wrapper home-page" id="wrapper-index">
  <!-- Parallax -->
  <div class="parallax page-header" >							
    <div class="parallax-fixed" style="background: url('<?php echo( get_header_image() );?>') no-repeat top center; background-size: cover;"></div>
  </div> <!-- .parallax -->
    
  <div class="container-fluid" id="content">
    <div class="<?php echo esc_attr( $container );?>" tabindex="-1">
    <!-- Content -->
      <!-- Navbar -->
			<div class="wrapper-fluid wrapper-navbar hidden-xl-down" id="navbar-selector">
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

      <!-- PROJECT GRID -->
      <div class="row">

        <!-- Do the left sidebar check and opens the primary div -->
        <?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

        <!-- Add grid containter to the main class -->
        <main class="site-main <?php echo esc_attr( $container ); ?>" id="main">
          <div class="row grid">
            <!-- Required for grid library. Add sizing element for columnWidth -->
            <div class="col-xs-12 col-md-4 card pt-3 pb-3 grid-sizer d-none" ></div>
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
    </div><!-- .container -->
  </div><!-- .container-fluid -->
</div><!-- .wrapper -->

<?php get_footer(); ?>
