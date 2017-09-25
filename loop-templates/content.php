<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

?>


<!-- Custom Tag proccessing. This gets 'portfolio-width' and diplays the
     content according to the number. --> 
<?php 
	$width = get_post_meta(get_the_ID(), 'portfolio-width', true);

	if ($width == 3):
		echo('<div class="col-xs-12 col-md-12 grid-item">');
	elseif ($width == 2):
		echo('<div class="col-xs-12 col-md-8 grid-item" >');
	else:
		echo('<div class="col-xs-12 col-md-4 grid-item">');
	endif;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<!-- Make the hole element clickable -->
	<a href="<?php echo( get_permalink() ) ?>">
	<!-- TODO: remove -->
	<?php if(0): ?>
	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
		'</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php understrap_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->
	<!-- TODO: remove -->
	<?php endif; ?> <!-- If 0 -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
	<!-- TODO: remove -->
	<?php if(0): ?>
	<div class="entry-content">

		<?php
		the_excerpt();
		?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->
	<!-- TODO: remove -->
	<?php endif; ?> <!-- If 0 -->

	<footer class="entry-footer">
		<!-- TODO: remove -->
		<?php if(0): ?>
		<?php understrap_entry_footer(); ?>
		<?php endif; ?> <!-- If 0 -->


	</footer><!-- .entry-footer -->
	</a><!-- End clickable -->
</article><!-- #post-## -->
</div><!-- End custom Tag proccessing --> 