<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lens
 */
?>

	</div><!-- #content -->

	<?php get_sidebar('footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php printf( __( 'Powered By by %1$s.', 'lens' ), '<a href="'.esc_url("https://rohitink.com/2015/05/02/lens-photography-theme/").'" rel="nofollow">Lens Theme</a>' ); ?>
			<?php echo ( get_theme_mod('lens_footer_text') == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','lens') ) : esc_html( get_theme_mod('lens_footer_text') ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>