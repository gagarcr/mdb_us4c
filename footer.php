<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

          <?php if (is_home()): get_sidebar( 'footerfull' ); else: ?>

            <div class="cross-arrow">
              <a href="<?php echo get_home_url(); ?>" aria-label="Close">
                <img class="img-fluid" alt="x" aria-hidden="true" src="<?php echo  get_stylesheet_directory_uri() . '/fonts/ic_close_white_32px.svg'; ?>"></img>
                <span class="sr-only">&times;</span>			
              </a>					
            </div>
            
          <?php endif; ?>      

        </div><!-- #page we need this extra closing tag here -->   
    </div><!-- .barba-container -->
  </div><!-- #barba-wrapper -->

  <div id="loader-spinner">
    <i class="fa fa-circle-o-notch fa-spin fa-3x"></i>
  </div>

<!--Admin bar -->
<?php wp_footer(); ?>

</body>

</html>
