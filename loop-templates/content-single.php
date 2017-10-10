
<style>
* {
	//background-color: rgba(123,120,120,0.2);
	//border: 1px solid black;
}

.project-page {
	min-height: 100vh;
	//border-bottom: 1px solid black;

	/* Required to center the <h1> */
	display:flex;
    align-items: center;
    justify-content: center;
	flex-direction: column;

	padding-bottom: 4em;
	padding-top: 4em;
}


.project-page.entry-header { /* project-page and entry header */
	background-color: rgba(0,0,0,1);
}

.project-technical .container {
	/* Required to center the <h1> */
	//display:flex;
    //align-items: center;
    //justify-content: center;
	//flex-direction: row;
}

.project-gallery {
	//background-color: rgba(0,0,0,1);
}

.project-gallery .card {
	border: none;
}


 


</style>
<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

?>
<article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header project-page project-cover text-center text-white">
		<?php the_title( '<h1 class="entry-title text-uppercase p-5">', '</h1>' ); ?>
		<div class="entry-short p-5">
 			<p>
				<?php the_field('short_description'); ?>
			</p>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<!-- Technical description page -->	
	<div class="project-page project-technical">
		<div class="container">
			<div class="row justify-content-center align-items-center text-justify">
				<div class="entry-technical text-center text-lg-left col-12 col-lg-3">
					<?php the_field('technical_description'); ?>
				</div><!-- .entry-technical .col -->
				<div class="entry-technical-img d-none d-lg-block col-lg-5">
					<?php 
						$id = get_field('technical_description_image');
						// Only add if user created it
						if ($id):
							$thumbnail_image_url = wp_get_attachment_image_src($id, 'large');
							if ($thumbnail_image_url):
								$thumbnail_image_url = $thumbnail_image_url[0]; // Fist array field is src.	
								?>
								<img class="img-fluid rounded" src="<?php echo $thumbnail_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>"></img>
								<?php
							endif;
						endif;
					?>
				</div><!-- .entry-technical-img .col -->
			</div><!-- .row -->
		</div> <!-- .container -->
	</div> <!-- .project-technical -->

	<!-- full description page -->	
	<div class="project-page project-full-description">
		<div class="entry-long container">
			<div class="row justify-content-center align-items-center text-justify">
				<div class="col-12 col-lg-8">
					<?php the_title( '<h4 class="entry-title text-uppercase">', '</h4>' ); ?>

					<?php 
					the_content();
					?>
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .entry-long -->
	</div> <!-- .project-full-description -->

	<!-- Gallery page -->	
	<div class="project-page project-gallery">
 		<div class="container">
			<div class="card-columns">
				<?php 
				//Get the images ids from the post_metadata
				$images = acf_photo_gallery('gallery', $post->ID);
				//Check if return array has anything in it
				if( count($images) ):
					//Cool, we got some data so now let's loop over it
					foreach($images as $image):
						$id = $image['id']; // The attachment id of the media
						$title = $image['title']; //The title
						$caption= $image['caption']; //The caption
						$full_image_url= $image['full_image_url']; //Full size image url
						//$full_image_url = acf_photo_gallery_resize_image($full_image_url, 262, 160); //Resized size to 262px width by 160px height image url
						//$thumbnail_image_url= $image['thumbnail_image_url']; //Get the thumbnail size image url 150px by 150px
						$thumbnail_image_url = wp_get_attachment_image_src($id, 'large');
						if ($thumbnail_image_url):
							$thumbnail_image_url = $thumbnail_image_url[0]; // Fist array field is src.
						endif;
						$url= $image['url']; //Goto any link when clicked
						$target= $image['target']; //Open normal or new tab
						$alt = get_field('photo_gallery_alt', $id); //Get the alt which is a extra field (See below how to add extra fields)
						$class = get_field('photo_gallery_class', $id); //Get the class which is a extra field (See below how to add extra fields)
				?>
					<div class="card mb-4">
						<img class="card-img" src="<?php echo $thumbnail_image_url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>"></img>
					</div> <!-- .card -->
				<?php endforeach; endif; ?>		
			</div><!-- .row -->
		</div><!-- .container -->
	</div> <!-- .project-gallery .container -->

</article>

<?php if (0): ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">

				<?php understrap_posted_on(); ?>

			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

		<div class="entry-content">

			<?php the_content(); ?>

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			) );
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php understrap_entry_footer(); ?>

		</footer><!-- .entry-footer -->

	</article><!-- #post-## -->
<?php endif; ?>