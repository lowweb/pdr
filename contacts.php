<?php
/**
 * Template Name: Contact page
 * The template for displaying contact page
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fstore
 */

get_header(); ?>

<div id="container">

		<main id="main" class="site-main" role="main">

      <div class="contact-left">
  			<?php
  			while ( have_posts() ) : the_post();

  				get_template_part( 'template-parts/content', 'page' );

  				// If comments are open or we have at least one comment, load up the comment template.
  				if ( comments_open() || get_comments_number() ) :
  					comments_template();
  				endif;

  			endwhile; // End of the loop.
  			?>
      </div>

      <div class="contact-right">
        <div id="map">
					<script src="<?php echo get_template_directory_uri()?>/js/map.js"></script>
					<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj00-ZXeVNt0seexQf2cXyFE1s3Xy3gmE&callback=initMap"
					async defer></script>
				</div>
      </div>

		</main><!-- #main -->

</div>

<?php
// get_sidebar();
get_footer();
