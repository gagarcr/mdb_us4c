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
<style>
#footer-full-content .textwidget {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
  </style>
<?php if (is_home()): get_sidebar( 'footerfull' ); endif; ?>


        </div><!-- #page we need this extra closing tag here -->
    </div><!-- .barba-container -->
</div><!-- #barba-wrapper -->


</body>

</html>
