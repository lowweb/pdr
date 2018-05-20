<?php
/**
 * Template Name: Testimonials-bottom
 * Description: The template for displaying a page with testimonials at the bottom.
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package fstore
 */

get_header(); ?>

<div id="container">

  <?php get_sidebar(); ?>


		<main id="main" class="site-main" role="main">

      <div class="search-contact">
        <?php echo do_shortcode('[search]'); ?>
        <?php echo do_shortcode('[contact]'); ?>
      </div>

      <?php

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.

			?>

		</main><!-- #main -->
    <!-- <div class="clearfix"></div> -->

</div>
  <?php echo do_shortcode('[testimonials]'); ?>

<?php
get_footer();
