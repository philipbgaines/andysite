<?php
/**
 * @package Lens
 */
?>
				
<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-4 grid lens'); ?>>
	<div class="card">
		<div class="featured-thumb front">
			<?php if (has_post_thumbnail()) : ?>	
				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('lens-thumb'); ?></a>
			<?php else: ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder-lens.jpg"; ?>"></a>
			<?php endif; ?>
			
		</div><!--.featured-thumb-->
		
		<div class="out-thumb back">
				<header class="entry-header">
					<h1 class="entry-title body-font"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				</header><!-- .entry-header -->
			</div><!--.out-thumb-->
			
	</div>	
		
</article><!-- #post-## -->