<?php
/**
 * Attractor Theme:	Header file
 * @package:			WordPress
 * @subpackage:			Attractor Theme
 * @since:				1.0
 * TO BE INCLUDED IN ALL OTHER PAGES
 */
 $hgr_options = get_option( 'redux_options' );
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 ie-lt10 ie-lt9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 ie-lt10 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. --> 
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php echo ( !empty($hgr_options['retina_favicon']['url']) ? '<link href="'.$hgr_options['retina_favicon']['url'].'" rel="icon">'."\r\n" : '<link href="'.$hgr_options['favicon']['url'].'" rel="icon">'."\r\n" ); ?>
<?php echo ( !empty($hgr_options['iphone_icon']['url']) ? '<link href="'.$hgr_options['iphone_icon']['url'].'" rel="apple-touch-icon">'."\r\n" : ''); ?>
<?php echo ( !empty($hgr_options['retina_iphone_icon']['url']) ? '<link href="'.$hgr_options['retina_iphone_icon']['url'].'" rel="apple-touch-icon" sizes="76x76" />'."\r\n" : ''); ?>
<?php echo ( !empty($hgr_options['ipad_icon']['url']) ? '<link href="'.$hgr_options['ipad_icon']['url'].'" rel="apple-touch-icon" sizes="120x120" />'."\r\n" : ''); ?>
<?php echo ( !empty($hgr_options['ipad_retina_icon']['url']) ? '<link href="'.$hgr_options['ipad_retina_icon']['url'].'" rel="apple-touch-icon" sizes="152x152" />'."\r\n" : ''); ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php if ( !empty($hgr_options['css-code']) ) : ?>
<!-- Custom CSS -->
<style type="text/css">
<?php echo $hgr_options['css-code'];?>
</style>
<?php endif;?>
<style>
.wpb_btn-success {
    background-color: <?php echo $hgr_options['theme_dominant_color'];?>!important;
}
.bka_menu {
    background-color: <?php echo $hgr_options['menu-bgcolor'];?>!important;
}
<?php if($hgr_options['menu-bgcolor']):?>
.bka_menu, .bka_menu .container, .navbar-collapse.in, .navbar-collapse.colapsing, .bka_menu .dropdown-menu {
    background-color: <?php echo $hgr_options['menu-bgcolor'];?>;
}
<?php endif;?>
</style>
<!-- VC COMBINED STYLES -->
<?php echo '<style type="text/css" data-type="vc-shortcodes-custom-css">';?>
<?php echo hgr_get_post_meta_by_key('_wpb_shortcodes_custom_css');?>
<?php echo '</style>';?>
<!-- / VC COMBINED STYLES -->
<?php wp_head(); ?>
</head>
<body <?php body_class(''); ?>>
<!-- Page preloader -->
<div class="preloadermask">
	<div class="loading">
		<img src="<?php echo get_template_directory_uri(); ?>/highgrade/images/preloader.svg" class="preloader">
	</div>
</div>
<!-- END Page preloader -->

<div class="row bkaTopmenu bka_menu <?php echo ( !is_front_page() ? '' : ( $hgr_options['menu-style'] == 1 ? 'hidden' : '') ); ?>">
  <div class="container">
    <nav class="navbar navbar-default" role="navigation"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#hgr-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="<?php echo home_url();?>"><img src="<?php echo $hgr_options['logo']['url'];?>" width="<?php echo $hgr_options['logo']['width'];?>" height="<?php echo $hgr_options['logo']['height'];?>" alt="<?php bloginfo('name');?>" class="logo" /></a>
	  </div>
		
		<?php
            wp_nav_menu( array(
                'menu'              => 'header-menu',
                'theme_location'    => 'header-menu',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
				'container_id'      => 'hgr-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav navbar-right',
				'menu_id'        	=> 'mainNavUl',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
    </nav>
  </div>
</div>
<!--/ header --> 

<div class="top">
<span class="back-to-top"><i class="icon fa fa-angle-double-up"></i></span>
</div>