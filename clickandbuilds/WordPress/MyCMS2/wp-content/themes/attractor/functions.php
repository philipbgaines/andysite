<?php
/*
 * @package:			WordPress
 * @subpackage:			Attractor Theme
 * @since:				1.0
 */
 
 // Add multilanguage support
	load_theme_textdomain( 'attractor', get_template_directory() . '/highgrade/languages' );
 
 // Enqueue CSS and JS script to frontend header and footer
 if( !function_exists('hgr_enqueue') ) {
	function hgr_enqueue() {
		// Include framework glogal
			global $hgr_options;
		// CSS
		wp_enqueue_style( 'css-bootstrap', 				get_template_directory_uri() . '/highgrade/css/bootstrap.min.css', '', '3.1.1' );
		wp_enqueue_style( 'hgr-icons', 					get_template_directory_uri() . '/highgrade/css/icons.css', '', '1.0.0' );
		
		wp_enqueue_style( 'css-fontawesome', 			get_template_directory_uri() . '/highgrade/css/font-awesome.min.css', '', '1.0.0' );
		wp_enqueue_style( 'css-component', 				get_template_directory_uri() . '/highgrade/css/component.css', '', '1.0.0' );
		
		
		wp_enqueue_style( 'theme-css', 					get_stylesheet_uri() );
		
		wp_enqueue_style( 'theme-dinamic-css', 			get_template_directory_uri() . '/highgrade/theme-style.css', '', '1.0.0' );
		
		// JS
		wp_enqueue_script( 'bootstrap-min',				get_template_directory_uri() . '/highgrade/js/bootstrap.min.js', array('jquery'), '3.1.0', true );
		
		wp_enqueue_script( 'hgr-imagesloaded',			get_template_directory_uri() . '/highgrade/js/imagesloaded.js', array(), '3.1.4', true );
		
		wp_enqueue_script( 'isotope'); // Loaded from Visual Composer
		
		wp_enqueue_script( 'hgr-modernizr-custom',		get_template_directory_uri() . '/highgrade/js/modernizr.custom.js', array(), '1.0', false );
		
		wp_enqueue_script( 'hgr-js',						get_template_directory_uri() . '/highgrade/js/app.js', array(), '1.0.0', true );

		// Visual composer - move styles to head
		wp_enqueue_style( 'js_composer_front' );
		wp_enqueue_style('js_composer_custom_css');
		
	}
 }
 add_action( 'wp_enqueue_scripts', 'hgr_enqueue' );

 // Setup $content_width - REQUIRED
 if ( ! isset( $content_width ) ) {$content_width = 1180;}
 
 // Register Custom Navigation Walker
 require_once('highgrade/navwalker/wp_bootstrap_navwalker.php');
	
 // Custom pagination for posts
 if( !function_exists('hgr_pagination') ) {
	function hgr_pagination( $args = '' ) {
		$defaults = array(
			'before' => '<p id="post-pagination">' . __( 'Pages:', 'attractor' ), 
			'after' => '</p>',
			'text_before' => '',
			'text_after' => '',
			'next_or_number' => 'number', 
			'nextpagelink' => __( 'Next page', 'attractor' ),
			'previouspagelink' => __( 'Previous page', 'attractor' ),
			'pagelink' => '%',
			'echo' => 1
		);
	
		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );
	
		global $page, $numpages, $multipage, $more, $pagenow;
	
		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '<li>';
						$output .= _wp_link_page( $i );
					}
					else {
						$output .= '<li class="active">';
						$output .= _wp_link_page( $i );
					}
	
					$output .= $j;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '</a>';
						$output .= '</li>';
					}
					else {
						$output .= '</a>';
						$output .= '</li>';
					}
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}
		if ( $echo )
			echo $output;
		return $output;
	}
 }
 
 // Search only in blog posts
 function hgr_search_filter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
 }
 add_filter('pre_get_posts','hgr_search_filter');
 
 // Include Mobile detect class
 require_once dirname( __FILE__ ) . '/highgrade/Mobile_Detect.php';
 
  /**
 * @package	TGM-Plugin-Activation
 * @version	2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright Copyright (c) 2012, Thomas Griffin
 * @license	http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link      https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
// Include the TGM_Plugin_Activation class
	require_once dirname( __FILE__ ) . '/highgrade/plugins/class-tgm-plugin-activation.php';
	add_action( 'tgmpa_register', 'hgr_register_required_plugins' );


// Register the required / recommended plugins for theme
 if( !function_exists('hgr_register_required_plugins') ) {
		function hgr_register_required_plugins() {
		$plugins = array(
			// Visual Composer
			array(
				'name'     				=> 'WPBakery Visual Composer', // The plugin name
				'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
				'source'   				=> get_stylesheet_directory() . '/highgrade/plugins/js_composer.zip', // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			),
			// Revolution Slider
			array(
				'name'     				=> 'Revolution Slider',
				'slug'     				=> 'revslider',
				'source'   				=> get_stylesheet_directory() . '/highgrade/plugins/revslider.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> true,
			),
			// HighGrade Extender for Visual Composer
			array(
				'name'     				=> 'HighGrade Extender for Visual Composer',
				'slug'     				=> 'hgr_vc_extender',
				'source'   				=> get_stylesheet_directory() . '/highgrade/plugins/hgr_vc_extender.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> true,
			),
			// Wordpress Importer
			array(
				'name' 		=> 'Wordpress Importer',
				'slug' 		=> 'wordpress-importer',
				'required' => false,
			),
			// Contact Form 7
			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'required' => false,
			),
			
			// 4K Icons for VC
			array(
				'name'     				=> '4K VC Icons Shortcode',
				'slug'     				=> '4k-vc-icon-shortcode',
				'source'   				=> get_stylesheet_directory() . '/highgrade/plugins/4k-vc-icon-shortcode.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> true,
			),
			// Essential Grid
			array(
				'name'     				=> esc_html__( 'Essential Grid', 'attractor'),
				'slug'     				=> 'essential-grid',
				'default_path' 			=> '',
				'source'   				=> trailingslashit( get_template_directory() ) . 'highgrade/plugins/essential-grid.zip',
				'required' 				=> false,
				'version' 				=> '',
				'force_activation' 		=> false,
				'force_deactivation' 	=> true,
				'external_url' 			=> '',
			),
	
		);
				
		$config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'attractor' ),
            'menu_title'                      => __( 'Install Plugins', 'attractor' ),
            'installing'                      => __( 'Installing Plugin: %s', 'attractor' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'attractor' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'attractor' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'attractor' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'attractor' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
		tgmpa( $plugins, $config );
	 }
 }
 
 
 // Some basic setup after theme setup
 add_action( 'after_setup_theme', 'hgr_theme_setup' );
 function hgr_theme_setup(){
	// Add theme support for featured image, menus, etc
	if ( function_exists( 'add_theme_support' ) ) { 
		$hgr_defaults = array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 2560,
			'height'                 => 1440,
			'flex-height'            => true,
			'flex-width'             => true,
			'default-text-color'     => '#fff',
			'header-text'            => false,
			'uploads'                => true,
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		add_theme_support( 'custom-header', $hgr_defaults );
	
		// Add theme support for featured image
		add_theme_support( 'post-thumbnails', array( 'post','hgr_portfolio','hgr_testimonials' ) );
		
		// Add theme support for feed links
		add_theme_support( 'automatic-feed-links' );
		
		// Add theme support for menus
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
				  'header-menu' => 'Header Menu'
				)
			);
		}
	}
	 
	
	
	// Enables wigitized sidebars
 	if ( function_exists('register_sidebar') ) {
	register_sidebar(array(	'name'=>'Blog',
								'id'=>	'blog-widgets',
								'description' => __( 'Widgets in this area will be shown into the blog sidebar.', 'attractor'),
								'before_widget' => '<div class="col-md-12 blog_widget">',
								'after_widget' => '</div>',
								'before_title' => '<h4>',
								'after_title' => '</h4>',
							)
					);
	}
 	// END Widgets
	
 }
 
 // Create post type: Portfolio, Testimonials
 add_action( 'init', 'hgr_create_post_type' );
 function hgr_create_post_type() {
	register_post_type( 'hgr_portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolio', 'attractor' ),
				'singular_name' => __( 'Portfolio', 'attractor' )
			),
		'public' => true,
		'menu_icon' =>'dashicons-format-image',
		'has_archive' => true,
		'rewrite' => array('slug' => 'portfolio'),
		'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
		'taxonomies' => array('post_tag','portfolio-category')
		)
	);
	
	register_post_type( 'hgr_testimonials',
		array(
			'labels' => array(
				'name' => __( 'Testimonials', 'attractor' ),
				'singular_name' => __( 'Testimonial','attractor' )
			),
		'public' => true,
		'menu_icon'=>'dashicons-editor-quote',
		'has_archive' => true,
		'rewrite' => array('slug' => 'testimonials'),
		'supports' => array('title','editor')
		)
	);
 }

// Create portfolio categories taxonomy
add_action( 'init', 'hgr_portfolio_tax' );
function hgr_portfolio_tax() {
	register_taxonomy(
		'portfolio-category',
		array('hgr_portfolio'),
		array(
			'hierarchical'=> true,
			'label' => __( 'Categories','attractor' ),
			'rewrite' => array( 'slug' => 'portfolio-category' ),
		)
	);}

 
 // Pages Metaboxes
	// Generate the metabox
	function hgr_metaboxes() {
    	$screens = array( 'page' );
    	foreach ( $screens as $screen ) {
       		add_meta_box(
           	'hgr_metaboxid',
            	__( 'Page settings', 'attractor' ),
            	'hgr_inner_custom_box',
            	$screen
        	);
    	}
	}
	add_action( 'add_meta_boxes', 'hgr_metaboxes' );

	// Print the box content
	function hgr_inner_custom_box($post) {
		// Add an nonce field so we can check for it later
		wp_nonce_field( 'hgr_inner_custom_box', 'hgr_inner_custom_box_nonce' );

		// Get metaboxes values from database
		$hgr_page_bgcolor			=	get_post_meta( $post->ID, '_hgr_page_bgcolor', true );
		$hgr_page_top_padding		=	get_post_meta( $post->ID, '_hgr_page_top_padding', true );
		$hgr_page_btm_padding		=	get_post_meta( $post->ID, '_hgr_page_btm_padding', true );
		$hgr_page_color_scheme	=	get_post_meta( $post->ID, '_hgr_page_color_scheme', true );
		$hgr_page_height			=	get_post_meta( $post->ID, '_hgr_page_height', true );
		
		// Construct the metaboxes and print out
		// Page color scheme
		echo '<div class="settBlock"><label for="page_color_scheme">';
		   _e( "Page color scheme", 'attractor' );
		echo '</label> ';
		if($hgr_page_color_scheme == 'dark_scheme'){
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="dark_scheme" name="dark_scheme" selected="selected">Dark scheme</option><option value="light_scheme" name="light_scheme">Light scheme</option></select></div>';
		}
		elseif($hgr_page_color_scheme == 'light_scheme'){
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="dark_scheme" name="dark_scheme">Dark scheme</option><option value="light_scheme" name="light_scheme" selected="selected">Light scheme</option></select></div>';
		}
		else{
			echo '<select name="page_color_scheme" id="page_color_scheme"><option value="light_scheme" name="light_scheme" selected="selected">Light scheme</option><option value="dark_scheme" name="dark_scheme">Dark scheme</option></select></div>';
		}
		
		// Page background color
		echo '<div class="settBlock"><label for="page_bgcolor">';
		   _e( "Page background color", 'attractor' );
		echo '</label> ';
		echo '<input type="text" id="page_bgcolor" name="page_bgcolor" value="' . esc_attr( $hgr_page_bgcolor ) . '" size="25" placeholder="#000" /></div>';
	  
	  	// Page top padding
	  	echo '<div class="settBlock"><label for="page_top_padding">';
		   _e( "Page top padding", 'attractor' );
		echo '</label> ';
	  	echo '<input type="text" id="page_top_padding" name="page_top_padding" value="' . esc_attr( $hgr_page_top_padding ) . '" size="25" /> <em>pixels</em></div>';
	  
	  	// Page bottom padding
	  	echo '<div class="settBlock"><label for="page_btm_padding">';
		   _e( "Page bottom padding", 'attractor' );
	  	echo '</label> ';
	  	echo '<input type="text" id="page_btm_padding" name="page_btm_padding" value="' . esc_attr( $hgr_page_btm_padding ) . '" size="25" /> <em>pixels</em></div>';
		
		// Page height
	  	echo '<div class="settBlock"><label for="page_height">';
		   _e( "Page height", 'attractor' );
	  	echo '</label> ';
	  	echo '<input type="text" id="page_height" name="page_height" value="' . esc_attr( $hgr_page_height ) . '" size="25" /> <em>pixels. If not set, auto-height is set.</em></div>';
	}
	
	// Save the metabox data to database
	function hgr_save_postdata( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['hgr_inner_custom_box_nonce'] ) ) {
    		return $post_id;
		}

		$nonce = $_POST['hgr_inner_custom_box_nonce'];

		// Verify that the nonce is valid
		if ( ! wp_verify_nonce( $nonce, 'hgr_inner_custom_box' ) ) {
			return $post_id;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		}
		
		// OK to save data
		// Sanitize user input
		$page_bgcolor				= sanitize_text_field( $_POST['page_bgcolor'] );
 		$hgr_page_top_padding		= sanitize_text_field( $_POST['page_top_padding'] );
 		$hgr_page_btm_padding		= sanitize_text_field( $_POST['page_btm_padding'] );
		$hgr_page_color_scheme	= sanitize_text_field( $_POST['page_color_scheme'] );
		$hgr_page_height			= sanitize_text_field( $_POST['page_height'] );
		
		// Update the meta field in the database
		update_post_meta( $post_id, '_hgr_page_bgcolor',		$page_bgcolor );
		update_post_meta( $post_id, '_hgr_page_top_padding',	$hgr_page_top_padding );
		update_post_meta( $post_id, '_hgr_page_btm_padding',	$hgr_page_btm_padding );
		update_post_meta( $post_id, '_hgr_page_color_scheme',	$hgr_page_color_scheme );
		update_post_meta( $post_id, '_hgr_page_height',			$hgr_page_height );
	}
	add_action( 'save_post', 'hgr_save_postdata' );
 // END Pages Metaboxes





 // Custom search form
 function hgr_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search" />
    <input type="submit" id="searchsubmit" value="'. __( 'Search','attractor' ) .'" />
    </div>
    </form>';

    return $form;
 }
 add_filter( 'get_search_form', 'hgr_search_form' );
 
 
 // Icons shortcode
	add_shortcode( 'icon', 'hgr_icons_shortcode' );
	function hgr_icons_shortcode( $content = null ) {
		$addColor = '';
		$addSize = '';
		$addHeight='';
		extract( shortcode_atts( array(
					'name' => 'default',
					'color'=>'',
					'size'=>'',
					'height'=>''
				), $content ) );
		
		if( !empty($color) ) {
			$addColor=' color:' . $color . '; ';
		}
		if( !empty($size) ) {
			$addSize=' font-size:' . $size . '!important; ';
		}
		if( !empty($height) ) {
			$addHeight=' line-height:' . $height . '!important; ';
		}
		return '<i class="icon ' . $name . '" style="'. $addColor . $addSize . $addHeight.'"></i>';
 	}
 
 
 // Include the HighGrade Framework
	if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/highgrade/framework/framework.php' ) ) {require_once( dirname( __FILE__ ) . '/highgrade/framework/framework.php' );}
	if ( file_exists( dirname( __FILE__ ) . '/highgrade/config.php' ) ) {require_once( dirname( __FILE__ ) . '/highgrade/config.php' );}

// Custom CSS for Highgrade Framework admin panel
	function hgr_addAndOverridePanelCSS() {
	  wp_dequeue_style( 'redux-css' );
	  wp_register_style(
		'highgrade-css',
		get_template_directory_uri().'/highgrade/css/framework.css',
		array(),
		time(),
		'all'
	  );    
	  wp_enqueue_style('highgrade-css');
	}
	add_action( 'redux/page/hgr_options/enqueue', 'hgr_addAndOverridePanelCSS' );
	
	add_action('admin_head', 'hgr_custom_meta_css');
	function hgr_custom_meta_css() {
	  echo '<style>
		#hgr_metaboxid label {
		  display: inline-block;
		  min-width:170px;
		} 
		#hgr_metaboxid .settBlock {
		  display: block;
		  margin-bottom:5px;
		} 
		#hgr_metaboxid input[type="text"], #hgr_metaboxid select {
		  width: 120px;
		} 
	  </style>';
	}
	
	function hgr_get_post_meta_by_key($key) {
		global $wpdb;
		$vc_styles = '';
		$meta = $wpdb->get_results("SELECT `meta_value` FROM `".$wpdb->postmeta."` WHERE meta_key='".$key."' ");

		if ( !empty($meta) ) {
			foreach($meta as $custom_style){
				$vc_styles .= $custom_style->meta_value;
			}
		}
		else {
			return false;
		}
		return $vc_styles;
	}