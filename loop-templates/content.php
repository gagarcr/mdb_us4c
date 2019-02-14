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

/* Repeat for 3 posible thumbnails */
for ($i=1; $i < 4; $i++) { 
  
	//$width = get_post_meta(get_the_ID(), 'portfolio-width', true);
  $flex_enable = get_field('thumbnail_' . $i . '_enable');

  // If the first thumbnail is disabled, we output a text-based thumbnail.
  // The rest of the thumnail does not behave as this.
  if (($flex_enable) || ($i == 1)){

    $flex_width = get_field('thumbnail_' . $i . '_width');
    $flex_order = get_field('thumbnail_' . $i . '_order');
    $flex_title = get_field('thumbnail_' . $i . '_title');

    if ($flex_title == false): $flex_title = get_the_title(); endif;

    if ($flex_order === false): $flex_order = 0; endif;
  
    $flex_img = wp_get_attachment_image_src(get_field('thumbnail_' . $i . '_image'), 'medium_large');

    if ($flex_img == false) {
      // If no img, and we are in the first one, we also check the thumbnail image
      if ($i == 1) {
        $flex_img = get_the_post_thumbnail_url( $post->ID, 'medium_large' ); 
        //var_dump($flex_img);  
      }
    }
    else {
      $flex_img = $flex_img[0]; // Just take the url
    }

    switch ($flex_width) {
      case '1':
        $classes = array('col-xs-12 col-md-4 card text-white text-center grid-item mt-3 mb-4'); // Padding to x-sizer y-sizer
        break;
      case '2':
        $classes = array('col-xs-12 col-md-8 card text-white text-center grid-item mt-3 mb-4'); // Padding to x-sizer y-sizer
        break;
      case '3':
        $classes = array('col-xs-12 col-md-12 card text-white text-center grid-item mt-3 mb-4'); // Padding to x-sizer y-sizer
        break;
      default:
        $classes = array('col-xs-12 col-md-4 card text-white text-center grid-item mt-3 mb-4'); // Padding to x-sizer y-sizer
        break;
    } // End switch

?>


  <?php if ($flex_enable): ?>
    <div <?php echo(post_class($classes)); ?> style="order: <?php echo $flex_order ?>" order="<?php echo $flex_order ?>">

      <!-- Make the hole element clickable -->
      <a class="card-a" href="<?php echo( get_permalink() ) ?>">

        <img class="card-img" src="<?php echo $flex_img; ?>" alt="<?php echo $post->ID ?>">

        <div class="overlay">

          <h4 class="card-title text-white text-uppercase"><?php echo $flex_title ?></h4>
          <img class="card-img blur" src="<?php echo $flex_img; ?>" alt="<?php echo $post->ID ?>">

        </div><!-- #card-img-overlay -->

      </a><!-- .card-a -->

  <?php else: ?>
    
    <div <?php echo(post_class($classes[0] . ' card-project-text')); ?> style="order: <?php echo $flex_order ?>" order="<?php echo $flex_order ?>">

      <?php if (has_tag()): ?>
      
        <div class="card-header text-primary text-capitalize text-left"><?php the_tags(''); ?></div>
      
      <?php endif; ?>

      <a class="card-body pt-1" href="<?php echo( get_permalink() ) ?>">

        <h4 class="card-title text-primary text-left pb-3"><?php the_title(); ?></h4>
        <div class="card-text text-muted text-left"><?php the_excerpt() ?></div>

      </a><!-- .card-body -->
        
    <?php endif; ?>

  </a><!-- .card-a -->
</div><!-- End custom Tag proccessing --> 

<?php

  } // End if 
} // End for

?>