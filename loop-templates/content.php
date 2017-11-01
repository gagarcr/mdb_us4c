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
		$classes = array('col-xs-12 col-md-12 card text-white text-center grid-item pt-3 mb-4');
	elseif ($width == 2):
		$classes = array('col-xs-12 col-md-8 card text-white text-center grid-item pt-3 mb-4');
  else:
		$classes = array('col-xs-12 col-md-4 card text-white text-center grid-item mt-3 mb-4'); // Padding to x-sizer y-sizer
	endif;

?>

<div <?php echo(post_class($classes)); ?>>

    <?php if (has_post_thumbnail()): ?>

      <!-- Make the hole element clickable -->
      <a class="card-a bg-secondary" href="<?php echo( get_permalink() ) ?>">

        <img class="card-img" src="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="<?php echo $post->ID ?>">

        <div class="overlay">

          <h4 class="card-title text-white text-uppercase"><?php the_title(); ?></h4>
          <img class="card-img blur" src="<?php echo get_the_post_thumbnail_url( $post->ID, 'large' ); ?>" alt="<?php echo $post->ID ?>">

        </div><!-- #card-img-overlay -->

      </a><!-- .card-a -->

    <?php else: ?>

      <?php if (has_tag()): ?>
      
        <div class="card-header card-project-text bg-light text-primary text-capitalize text-left"><?php the_tags(''); ?></div>
      
      <?php endif; ?>

      <a class="card-body card-project-text bg-light pt-1" href="<?php echo( get_permalink() ) ?>">

        <h4 class="card-title text-primary text-left pb-3"><?php the_title(); ?></h4>
        <div class="card-text text-muted text-left"><?php the_excerpt() ?></div>

      </a><!-- .card-body -->
        
    <?php endif; ?>

  </a><!-- .card-a -->
</div><!-- End custom Tag proccessing --> 