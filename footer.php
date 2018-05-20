<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fstore
 */

?>

	</div><!-- #content -->

<footer id="footer">
	<div class="container">
		<div id="footer-left">

			<?php echo wp_get_attachment_image(get_theme_mod('footer-logo'),[66,66]) ?>


			<?php //echo get_option('footer-cred'); ?>
			© «Подряд» 2017
			<a class="cred" href="http://podryad.tv">podryad.tv</a>
		</div>

		<div id="footer-center">
				<?php if ( !function_exists('footer-1') || !dynamic_sidebar("header-right") ) : dynamic_sidebar( 'footer-1' ) ?>
				<?php endif;?>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
