<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package fstore
 */

get_header(); ?>

<div id="container">
			<section class="error-404 not-found">
					<h2>К сожалению, страница не найдена.</h2>
					<img src="<?php echo FROOT?>/img/sad.svg" alt="404"/>
			</section><!-- .error-404 -->
</div>

<?php
get_footer();
