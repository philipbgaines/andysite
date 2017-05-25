<?php
/**
 * Attractor Theme:	Home page for site or blog
 * @package:			WordPress
 * @subpackage:			Attractor Theme
 * @since:				1.0
 */
 
 // Include framework options
 $hgr_options = get_option( 'redux_options' );
 
 // Get metaboxes values from database
 $this_page_id 			=	get_option('page_for_posts');
 $hgr_page_color_scheme	=	get_post_meta( $this_page_id, '_hgr_page_color_scheme', true );
 ?>
<?php 
	get_header();
 ?>
<!-- index.php -->

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
        <?php comments_template(); ?>
        <?php if(is_paged()) : ?>
        <?php paginate_comments_links(); ?>
        <?php endif;?>
      </div>
      <?php if(is_paged()) : ?>
      <div class="navigation">
        <div class="alignleft">
          <?php previous_posts_link( __('&larr; Previous', 'attractor') ) ?>
        </div>
        <div class="alignright">
          <?php next_posts_link( __('Next &rarr;', 'attractor'),'') ?>
        </div>
      </div>
      <?php endif;?>
      <?php endwhile; ?>
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
