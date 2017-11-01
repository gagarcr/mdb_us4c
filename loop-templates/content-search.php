<?php
/**
 * Search results partial template.
 *
 * @package understrap
 */

?>
            
<article <?php post_class('card mb-3'); ?> id="post-<?php the_ID(); ?>">
    
  <header class="entry-header card-header">
    
    <?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>

  </header><!-- .entry-header -->
    
  <div class="card-body">

    <div class="entry-summary card-text">

      <?php the_excerpt(); ?>

    </div><!-- .entry-summary -->
    
  </div><!-- .card-body -->

</article><!-- #post-## -->
