<?php if ( get_theme_mod('lens_main_aboutme_enable') && is_front_page() ) : ?>
	<div id="aboutme">
		<div class="layer">
			<div class="container">
				<div id="aboutme-title" class="section-title"><?php echo esc_html( get_theme_mod('lens_aboutme_title','About Me') ) ?></div>
				
				<div class="author col-md-3">
					<img src="<?php echo get_theme_mod('lens_aboutme_img') ?>">
					<div class="author-name title-font"><?php echo esc_html( get_theme_mod('lens_aboutme_name') ) ?></div>
				</div>
				
				<div class="col-md-9 about">
					<?php echo esc_html( get_theme_mod('lens_aboutme_desc') ); ?>
				</div>
				
			</div>
		</div>
	</div>
<?php endif; ?>