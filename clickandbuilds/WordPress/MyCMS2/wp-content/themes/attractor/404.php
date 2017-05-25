 <?php
/**
 * Attractor Theme:		404 error page
 * @package:			WordPress
 * @subpackage:			Attractor Theme
 * @since:				1.0
 */
 ?>
 
<?php 
	get_header();
 ?>

 <script>
 jQuery(document).ready(function() {
 	var windowHeight = jQuery(window).height(); //retrieve current window height
	jQuery('.standAlonePage').css('min-height',windowHeight-40);
 })
 </script>
 
 <div id="page-not-found" class="row standAlonePage light_scheme"  style="padding-top:140px;">
	<div class="col-md-12" >
		<div class="container">
			<h1>404: Page not found</h1>
			<p class="not-found-text"><?php _e('Sorry, but the page you are looking for has not been found. Try checking the URL for errors, then hit the refresh button on your browser.', 'attractor'); ?></p>
			<p><a href="<?php echo get_site_url(); ?>">Return to homepage</a></p>
		</div>
	</div>
 </div>

<?php 
 	get_footer();
 ?>