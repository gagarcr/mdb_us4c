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
		$classes = array('col-xs-12 col-md-12 card text-white border-light text-center grid-item p-3');
	elseif ($width == 2):
		$classes = array('col-xs-12 col-md-12 card text-white border-light text-center grid-item p-3');
	else:
		$classes = array('col-xs-12 col-md-4 card text-white border-light text-center grid-item p-3'); // Padding to x-sizer y-sizer
		//echo('<div class="col-xs-12 col-md-4 grid-item">');			 
	endif;

?>
	<div <?php echo(post_class($classes)); ?>>
		<!-- Make the hole element clickable -->

		<a class="card-a" href="<?php echo( get_permalink() ) ?>">
			<img class="card-img" src="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="<?php echo $post->ID ?>">
			<div class="overlay">
				<h4 class="card-title text-white text-uppercase"><?php the_title(); ?></h4>
				<img class="card-img blur" src="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="<?php echo $post->ID ?>">
				<?php if (0): ?>
					<p class="card-text"><?php the_excerpt(); ?></p>
				<?php endif; ?>
			</div><!-- #card-img-overlay -->
		
		
			<?php if (0): ?>
			<div class="container-fluid">
				<div class="row justify-content-center">
					<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
				</div><!-- #row -->
			</div><!-- #container-fluid -->
			<?php endif; ?>
			</a><!-- End clickable -->

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

</article><!-- #post-## -->


</div><!-- End custom Tag proccessing --> 