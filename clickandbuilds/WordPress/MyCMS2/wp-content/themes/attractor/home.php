 <?php
/**
 * Attractor Theme:	Blog, front page
 * @package:			WordPress
 * @subpackage:			Attractor Theme
 * @since:				1.0
 */
 ?>
 
 <?php 
	get_header();
 ?>
 <!-- home.php -->
 
<!-- Header Image -->
<?php if (get_header_image() != '') : ?>

<div class="header_image_container"> <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="header image" class="header_image" />
  <div class="headerWelcome">
    <h1>
      <?php bloginfo('name'); ?>
    </h1>
    <h2><a href="#" class="readTheBlogBtn">Read the blog</a></h2>
  </div>
</div>
<?php endif;?>
<!-- Header Image End --> 

<!-- blog content -->
<div class="row blogPosts <?php echo (isset($hgr_options['blog_color_scheme']) ? $hgr_options['blog_color_scheme'] : '');?>" id="blogPosts">
  <div class="container"> 
    <!-- posts -->
    <div class="col-md-9">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php 
	  	$format = get_post_format();
	  ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
        <?php 
			if ( has_post_thumbnail() ) {
			  the_post_thumbnail('full', array('class' => 'img-responsive'));
			} 
		 ?>
        <?php if($format != 'aside') : ?>
        <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h1>
        <?php endif;?>
        <small> <span class="highlight"><i class="icon blog-date"></i>
        <?php the_time('F jS, Y') ?>
        </span> <span class="highlight"><i class="icon blog-user"></i>
        <?php _e('Posted by ', 'attractor');?>
        <?php the_author_posts_link() ?>
        </span> <span class="highlight"><i class="icon blog-category"></i>
        <?php the_category(', '); ?>
        </span> <span class="highlight"><i class="icon blog-comments"></i>
        <?php comments_number( __('No Comment yet', 'attractor'), __('1 comment', 'attractor'), __('% comments', 'attractor') ); ?>
        </span> </small>
        <div class="entry">
          <?php if(has_excerpt()) : ?>
          <?php the_excerpt(); ?>
          <?php else : ?>
          <?php the_content(); ?>
          <?php endif;?>
        </div>
        <div class="entry-meta">
          <?php the_tags(); ?>
        </div>
      </div>
      
      <!--<?php if(is_paged()) : ?>
      <div class="navigation">
        <div class="alignleft">
          <?php previous_posts_link( __('&larr; Previous', 'attractor') ) ?>
        </div>
        <div class="alignright">
          <?php next_posts_link( __('Next &rarr;', 'attractor'),'') ?>
        </div>
      </div>
      <?php endif;?>-->
      
      <?php endwhile; ?>
      
      <div class="navigation">
        <div class="alignleft">
          <?php previous_posts_link(  __('&larr; Previous', 'attractor') ) ?>
        </div>
        <div class="alignright">
          <?php next_posts_link( __('Next &rarr;', 'attractor'),'' ) ?>
        </div>
      </div>
      
      <?php else: ?>
      <p>
        <?php _e('Sorry, no posts matched your criteria.', 'attractor'); ?>
      </p>
      <?php endif; ?>
      <?php wp_reset_query();?>
    </div>
    <!-- / posts --> 
    
    <!-- sidebar -->
    <div class="col-md-3">
      <?php 
		get_sidebar();
	 ?>
    </div>
    <!-- / sidebar --> 
  </div>
</div>
<!-- blog content end -->

 <?php 
 	get_footer();
 ?>