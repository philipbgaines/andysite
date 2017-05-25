 <?php
 /*
 Template Name: 		Testimonials OnePage Section
 * @package:			WordPress
 * @subpackage:			Attractor Theme
 * @since:				1.0
 */
 ?>

 <?php
  // Include framework options
 $hgr_options = get_option( 'redux_options' );
 
 /* Does this page have a featured image to be used as row background with paralax?! */
 	$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( 5600,1000 ), false, '' );
 ?>
 <!-- Testimonials <?php the_ID(); ?> -->
 
 
<?php
	// Get metaboxes values from database
	$hgr_page_bgcolor		=	get_post_meta( get_the_ID(), '_hgr_page_bgcolor', true );
	$hgr_page_top_padding	=	get_post_meta( get_the_ID(), '_hgr_page_top_padding', true );
	$hgr_page_btm_padding	=	get_post_meta( get_the_ID(), '_hgr_page_btm_padding', true );
	$hgr_page_color_scheme	=	get_post_meta( get_the_ID(), '_hgr_page_color_scheme', true );
 ?>
 
<style>
#testimonialsCarousel .carousel-indicators li{
    background-color: #000;
    border: 1px solid <?php echo $hgr_options['theme_dominant_color'];?>;
}

#testimonialsCarousel .carousel-indicators li.active {
    background-color: <?php echo $hgr_options['theme_dominant_color'];?>;
    border: 1px solid <?php echo $hgr_options['theme_dominant_color'];?>;
}
</style>

<?php
 	/* If the page has a featured image set, we use the full width template
		and we put the featured image with full width on page gackground, animated with parallax
	*/
	if(!empty($src[0])) :
 ?>
 <div class="<?php echo $hgr_page_color_scheme;?>" id="<?php echo $post->post_name;?>">
 <div class="parallax" style="background-image:url(<?php echo $src[0];?>)">
<div class="row" style="padding-top:<?php echo ( !empty($hgr_page_top_padding) ? $hgr_page_top_padding.'px' : '0' );?>!important; padding-bottom:<?php echo ( !empty($hgr_page_btm_padding) ? $hgr_page_btm_padding .'px' : '0' );?>!important; <?php echo ( !empty($hgr_page_bgcolor) ? 'background-color:'.$hgr_page_bgcolor.'!important;' : '' );?>">
  <div class="col-md-12">
  <div class="container">
    <?php the_content(); ?>
    </div>
  </div>
</div>

<!-- testimonials -->
<div class="row <?php echo $hgr_page_color_scheme;?>"> 
  <div class="container">
  <!-- Carousel
    ================================================== -->
  <div id="testimonialsCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php
			$args = array( 'post_type' => 'hgr_testimonials', 'posts_per_page' => 20 );
			$loop = new WP_Query( $args );
			$i = 1;
			while ( $loop->have_posts() ) : $loop->the_post();
			if($i == 1) {$isActive = ' active ';} else {$isActive = '';}
			$i++; ?>
				<div class="item <?php echo $isActive;?>">
                    <div class="testimonial_text"><?php echo the_content();?></div>
                    <div class="testimonial_title" style="color:<?php echo $hgr_options['theme_dominant_color'];?>;"><?php echo the_title();?></div>
             	</div>
        <?php endwhile; ?> 
        </div>
    <a class="left carousel-control" href="#testimonialsCarousel" data-slide="prev">
		<span class="quote-left"></span>
	</a>
	
	<a class="right carousel-control" href="#testimonialsCarousel" data-slide="next">
		<span class="quote-right"></span>
	</a>
    
    <div class="carousel-indicatiors-fix" style="display: block; height: 30px;">
     <!-- Indicators -->
		<ol class="carousel-indicators">
			<?php
				$i = 0;
				while ( $loop->have_posts() ) : $loop->the_post();
				if($i == 0) {$isActive = ' active ';} else {$isActive = '';}
					echo '<li data-target="#testimonialsCarousel" data-slide-to="'.$i.'" class="'.$isActive.'"></li>';
					$i++;
				endwhile;
			?> 
		</ol>
	</div>
  
   </div>
  <!-- /.carousel --> 
  </div>
</div>
</div>
<!--/ testimonials --> 
</div>

 <?php
 	/* If the page does not have a featured image set, we use the fixed width template
		with no image on background and no paralax
	*/
	else :	
 ?>
 
 <div class="row <?php echo $hgr_page_color_scheme;?>" style="padding-top:<?php echo ( !empty($hgr_page_top_padding) ? $hgr_page_top_padding.'px' : '0' );?>!important; padding-bottom:<?php echo ( !empty($hgr_page_btm_padding) ? $hgr_page_btm_padding .'px' : '0' );?>!important; <?php echo ( !empty($hgr_page_bgcolor) ? 'background-color:'.$hgr_page_bgcolor.'!important;' : '' );?>"  id="<?php echo $post->post_name;?>">
  <div class="col-md-12">
    <div class="container">
		<?php the_content(); ?>
    </div>
  </div>
</div>

<!-- testimonials -->
<div class="row <?php echo $hgr_page_color_scheme;?>"> 
  <div class="container">
  <!-- Carousel
    ================================================== -->
  <div id="testimonialsCarousel" class="carousel slide" data-ride="carousel"> 
    <div class="carousel-inner">
      <?php
			$args = array( 'post_type' => 'hgr_testimonials', 'posts_per_page' => 20 );
			$loop = new WP_Query( $args );
			$i = 1;
			while ( $loop->have_posts() ) : $loop->the_post();
			if($i == 1) {$isActive = ' active ';} else {$isActive = '';}
			$i++; ?>
				<div class="item <?php echo $isActive;?>">
      				<div class="testimonial_text"><?php echo the_content();?></div>
                    <div class="testimonial_title" style="color:<?php echo $hgr_options['theme_dominant_color'];?>;"><?php echo the_title();?></div>
             	</div>
         <?php endwhile;?> 
        </div>
    <a class="left carousel-control" href="#testimonialsCarousel" data-slide="prev">
		<span class="quote-left"></span>
	</a> 
	<a class="right carousel-control" href="#testimonialsCarousel" data-slide="next">
		<span class="quote-right"></span>
	</a>
  
	<div class="carousel-indicatiors-fix" style="display: block; height: 30px;">
     <!-- Indicators -->
		<ol class="carousel-indicators">
			<?php
				$i = 0;
				while ( $loop->have_posts() ) : $loop->the_post();
				if($i == 0) {$isActive = ' active ';} else {$isActive = '';}
					echo '<li data-target="#testimonialsCarousel" data-slide-to="'.$i.'" class="'.$isActive.'"></li>';
					$i++;
				endwhile;
			?> 
		</ol>
	</div>
  
   </div>
  <!-- /.carousel --> 
  </div>
  
  
</div>
<!--/ testimonials --> 
 
  <?php
 	endif;
 ?>
<!--/ Testimonials <?php the_ID(); ?> --> 