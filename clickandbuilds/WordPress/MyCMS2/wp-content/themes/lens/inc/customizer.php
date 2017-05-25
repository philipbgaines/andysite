<?php
/**
 * lens Theme Customizer
 *
 * @package lens
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lens_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'lens' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'lens_logo' , array(
	    'default'     => '',
	    'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'lens_logo',
	        array(
	            'label' => 'Upload Logo',
	            'section' => 'title_tagline',
	            'settings' => 'lens_logo',
	            'priority' => 5,
	        )
		)
	);
	
	$wp_customize->add_setting( 'lens_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'lens_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'lens_logo_resize',
	        array(
	            'label' => 'Resize & Adjust Logo',
	            'section' => 'title_tagline',
	            'settings' => 'lens_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'lens_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function lens_logo_enabled($control) {
		$option = $control->manager->get_setting('lens_logo');
		return $option->value() == true;
	}
	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override lens_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('lens_site_titlecolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'lens_site_titlecolor', array(
			'label' => __('Site Title Color','lens'),
			'section' => 'colors',
			'settings' => 'lens_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('lens_header_desccolor', array(
	    'default'     => '#FFFFFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'lens_header_desccolor', array(
			'label' => __('Site Tagline Color','lens'),
			'section' => 'colors',
			'settings' => 'lens_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	
	$wp_customize->add_setting( 'lens_himg_align' , array(
	    'default'     => true,
	    'sanitize_callback' => 'lens_sanitize_himg_align'
	) );
	
	/* Sanitization Function */
	function lens_sanitize_himg_align( $input ) {
		if (in_array( $input, array('center','left','right') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
	'lens_himg_align', array(
		'label' => __('Header Image Alignment','lens'),
		'section' => 'header_image',
		'settings' => 'lens_himg_align',
		'type' => 'select',
		'choices' => array(
				'center' => __('Center','lens'),
				'left' => __('Left','lens'),
				'right' => __('Right','lens'),
			)
		
	) );
	
	$wp_customize->add_setting( 'lens_himg_darkbg' , array(
	    'default'     => true,
	    'sanitize_callback' => 'lens_sanitize_checkbox'
	) );
	
	$wp_customize->add_control(
	'lens_himg_darkbg', array(
		'label' => __('Add a Dark Filter to make the text Above the Image More Clear and Easy to Read.','lens'),
		'section' => 'header_image',
		'settings' => 'lens_himg_darkbg',
		'type' => 'checkbox'
		
	) );
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'lens_hide_title_tagline',
		array( 'sanitize_callback' => 'lens_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'lens_hide_title_tagline', array(
		    'settings' => 'lens_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'lens' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	function lens_title_visible( $control ) {
		$option = $control->manager->get_setting('lens_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	//TOP BUTTONS
	$wp_customize->add_section(
	    'lens_btn_sec',
	    array(
	        'title'     => 'Top Buttons',
	        'priority'  => 30,
	        'description' => __('This is used to Display 2 Custom Buttons in Top Right Corner of the Site. In the Icon Field, Enter the <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Font Awesome</a> Icon Name.', 'lens'),
	    )
	);
	
	for ( $i = 1 ; $i < 3; $i++ ) {
		$wp_customize->add_setting(
			'lens_btn_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'lens_btn_title'.$i, array(
			    'settings' => 'lens_btn_title'.$i,
			    'label'    => __( 'Button ','lens' ).$i,
			    'section'  => 'lens_btn_sec',
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'lens_btn_icon'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'lens_btn_icon'.$i, array(
			    'settings' => 'lens_btn_icon'.$i,
			    'label'    => __( 'Icon','lens' ),
			    'section'  => 'lens_btn_sec',
			    'type'     => 'text',
			)
		);
		
		
		$wp_customize->add_setting(
			'lens_btn_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'lens_btn_url'.$i, array(
			    'settings' => 'lens_btn_url'.$i,
			    'label'    => __( 'Target URL','lens' ),
			    'section'  => 'lens_btn_sec',
			    'type'     => 'url',
			)
		);
	}
	
		
	// SLIDER PANEL
	$wp_customize->add_panel( 'lens_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Main Slider',
	) );
	
	$wp_customize->add_section(
	    'lens_sec_slider_options',
	    array(
	        'title'     => 'Enable/Disable',
	        'priority'  => 0,
	        'panel'     => 'lens_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'lens_main_slider_enable',
		array( 'sanitize_callback' => 'lens_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'lens_main_slider_enable', array(
		    'settings' => 'lens_main_slider_enable',
		    'label'    => __( 'Enable Slider.', 'lens' ),
		    'section'  => 'lens_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'lens_main_slider_count',
			array(
				'default' => '0',
				'sanitize_callback' => 'lens_sanitize_positive_number'
			)
	);
	
	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_control(
			'lens_main_slider_count', array(
		    'settings' => 'lens_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 10)' ,'lens'),
		    'section'  => 'lens_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Enter a Value, and Hit Save above to Configure Slides.','lens'),
		    
		)
	);
	
		
	//Render Slides Sec	
	for ( $i = 1 ; $i <= 10 ; $i++ ) :
		
		//Create the settings Once, and Loop through it.
		static $x = 0;
		$wp_customize->add_section(
		    'lens_slide_sec'.$i,
		    array(
		        'title'     => 'Slide '.$i,
		        'priority'  => $i,
		        'panel'     => 'lens_slider_panel',
		        'active_callback' => 'lens_show_slide_sec'
		        
		    )
		);			
		
		$wp_customize->add_setting(
			'lens_slide_img'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'lens_slide_img'.$i,
		        array(
		            'label' => '',
		            'section' => 'lens_slide_sec'.$i,
		            'settings' => 'lens_slide_img'.$i,			       
		        )
			)
		);
		
		$wp_customize->add_setting(
			'lens_slide_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'lens_slide_title'.$i, array(
			    'settings' => 'lens_slide_title'.$i,
			    'label'    => __( 'Slide Title','lens' ),
			    'section'  => 'lens_slide_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'lens_slide_desc'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'lens_slide_desc'.$i, array(
			    'settings' => 'lens_slide_desc'.$i,
			    'label'    => __( 'Slide Description','lens' ),
			    'section'  => 'lens_slide_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		
		$wp_customize->add_setting(
			'lens_slide_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'lens_slide_url'.$i, array(
			    'settings' => 'lens_slide_url'.$i,
			    'label'    => __( 'Target URL','lens' ),
			    'section'  => 'lens_slide_sec'.$i,
			    'type'     => 'url',
			)
		);
		
	endfor;
	
		
	//active callback to see if the slide section is to be displayed or not
	function lens_show_slide_sec( $control ) {
		        $option = $control->manager->get_setting('lens_main_slider_count');
		        global $x;
		        if ( $x < $option->value() ){
		        	$x++;
		        	return true;
		        }
			}
	
	//Showcase
	$wp_customize->add_panel( 'lens_showcase_panel', array(
	    'priority'       => 37,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Showcase Area',
	) );
	
	$wp_customize->add_section(
	    'lens_sec_showcase_options',
	    array(
	        'title'     => 'Enable/Disable',
	        'priority'  => 0,
	        'panel'     => 'lens_showcase_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'lens_main_showcase_enable',
		array( 'sanitize_callback' => 'lens_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'lens_main_showcase_enable', array(
		    'settings' => 'lens_main_showcase_enable',
		    'label'    => __( 'Enable showcase.', 'lens' ),
		    'section'  => 'lens_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'lens_main_showcase_title',
			array(
				'default' => __('My Featured Work','lens'),
				'sanitize_callback' => 'sanitize_text_field'
			)
	);
	
	$wp_customize->add_control(
		'lens_main_showcase_title',
			array(
				'settings' => 'lens_main_showcase_title',
			    'label'    => __( 'Showcase Title.', 'lens' ),
			    'section'  => 'lens_sec_showcase_options',
			    'type'     => 'text',
			    'active_callback' => 'lens_sc_enabled'
			)
	);
	
	
	
	for ( $i = 1 ; $i <= 3 ; $i++ ) :
			
			//Create the settings Once, and Loop through it.
						
			$wp_customize->add_section(
			    'lens_showcase_sec'.$i,
			    array(
			        'title'     => 'Showcase '.$i,
			        'priority'  => $i,
			        'panel'     => 'lens_showcase_panel',
			        'active_callback' => 'lens_sc_enabled',
			    )
			);
			
			
			
			$wp_customize->add_setting(
				'lens_showcase_img'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
			    new WP_Customize_Image_Control(
			        $wp_customize,
			        'lens_showcase_img'.$i,
			        array(
			            'label' => '',
			            'section' => 'lens_showcase_sec'.$i,
			            'settings' => 'lens_showcase_img'.$i,			       
			        )
				)
			);
			
			$wp_customize->add_setting(
				'lens_showcase_title'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'lens_showcase_title'.$i, array(
				    'settings' => 'lens_showcase_title'.$i,
				    'label'    => __( 'Showcase Title','lens' ),
				    'section'  => 'lens_showcase_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'lens_showcase_desc'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'lens_showcase_desc'.$i, array(
				    'settings' => 'lens_showcase_desc'.$i,
				    'label'    => __( ' Description','lens' ),
				    'section'  => 'lens_showcase_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			
			$wp_customize->add_setting(
				'lens_showcase_url'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
					'lens_showcase_url'.$i, array(
				    'settings' => 'lens_showcase_url'.$i,
				    'label'    => __( 'Target URL','lens' ),
				    'section'  => 'lens_showcase_sec'.$i,
				    'type'     => 'url',
				)
			);
			
		endfor;
		
		function lens_sc_enabled( $control ) {
						$option = $control->manager->get_setting('lens_main_showcase_enable');
						return $option->value() == true ;
					}
	
	//ABOUT ME
	$wp_customize->add_section(
	    'lens_aboutme_sec',
	    array(
	        'title'     => __('About Me Section','lens'),
	        'priority'  => 38,
	    ) );
	    
	$wp_customize->add_setting(
		'lens_main_aboutme_enable',
		array( 'sanitize_callback' => 'lens_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'lens_main_aboutme_enable', array(
		    'settings' => 'lens_main_aboutme_enable',
		    'label'    => __( 'Enable About Me Section.', 'lens' ),
		    'section'  => 'lens_aboutme_sec',
		    'type'     => 'checkbox',
		)
	);    
	
	$wp_customize->add_setting(
		'lens_aboutme_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'lens_aboutme_title', array(
		    'settings' => 'lens_aboutme_title',
		    'label'    => __( 'Section Title','lens' ),
		    'description' => __( 'e.g "About Me" or "About Us"','lens'),
		    'section'  => 'lens_aboutme_sec',
		    'type'     => 'text',
		    'active_callback' => 'lens_aboutme_enabled'
		)
	);
	    
    $wp_customize->add_setting(
			'lens_aboutme_img',
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'lens_aboutme_img',
	        array(
	            'label' => __('Your Avatar or Company Logo','lens'),
	            'section' => 'lens_aboutme_sec',
	            'settings' => 'lens_aboutme_img',	
	            'active_callback' => 'lens_aboutme_enabled'		       
	        )
		)
	);
	
	$wp_customize->add_setting(
		'lens_aboutme_name',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'lens_aboutme_name', array(
		    'settings' => 'lens_aboutme_name',
		    'label'    => __( 'Author/Company Name','lens' ),
		    'section'  => 'lens_aboutme_sec',
		    'type'     => 'text',
		    'active_callback' => 'lens_aboutme_enabled'
		)
	);
	
	$wp_customize->add_setting(
		'lens_aboutme_desc',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'lens_aboutme_desc', array(
		    'settings' => 'lens_aboutme_desc',
		    'label'    => __( ' Description','lens' ),
		    'section'  => 'lens_aboutme_sec',
		    'type'     => 'textarea',
		    'active_callback' => 'lens_aboutme_enabled'
		)
	);
	    
	
	$wp_customize->add_setting(
			'lens_aboutme_bgimg',
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'lens_aboutme_bgimg',
	        array(
	            'label' => __('Background Image','lens'),
	            'description' => __('Use a Large Image','lens'),
	            'section' => 'lens_aboutme_sec',
	            'settings' => 'lens_aboutme_bgimg',		
	            'active_callback' => 'lens_aboutme_enabled'	       
	        )
		)
	);    
	
	function lens_aboutme_enabled( $control ) {
		$option = $control->manager->get_setting('lens_main_aboutme_enable');
	    return $option->value() == true ; 
	}

	
		
	// Layout and Design
	$wp_customize->add_panel( 'lens_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','lens'),
	) );
	
		
	$wp_customize->add_section(
	    'lens_design_options',
	    array(
	        'title'     => __('Blog Layout','lens'),
	        'priority'  => 0,
	        'panel'     => 'lens_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'lens_blog_layout',
		array( 'sanitize_callback' => 'lens_sanitize_blog_layout' )
	);
	
	function lens_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','lens','lens_3_col','photo_4_col') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'lens_blog_layout',array(
				'label' => __('Select Layout','lens'),
				'settings' => 'lens_blog_layout',
				'section'  => 'lens_design_options',
				'type' => 'select',
				'choices' => array(
						'lens' => __('Lens Layout','lens'),
						'lens_3_col' => __('Lens Layout (3 Column)','lens'),
						'grid' => __('Basic Blog Layout','lens'),
						'photo_4_col' => __('Photography (4 Column)','lens'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'lens_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','lens'),
	        'priority'  => 0,
	        'panel'     => 'lens_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'lens_disable_sidebar',
		array( 'sanitize_callback' => 'lens_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'lens_disable_sidebar', array(
		    'settings' => 'lens_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','lens' ),
		    'section'  => 'lens_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'lens_disable_sidebar_home',
		array( 'sanitize_callback' => 'lens_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'lens_disable_sidebar_home', array(
		    'settings' => 'lens_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Blog & Archives.','lens' ),
		    'section'  => 'lens_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'lens_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'lens_disable_sidebar_front',
		array( 'sanitize_callback' => 'lens_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'lens_disable_sidebar_front', array(
		    'settings' => 'lens_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','lens' ),
		    'section'  => 'lens_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'lens_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'lens_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'lens_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'lens_sidebar_width', array(
		    'settings' => 'lens_sidebar_width',
		    'label'    => __( 'Sidebar Width','lens' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','lens'),
		    'section'  => 'lens_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'lens_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function lens_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('lens_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	class Lens_Custom_CSS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'lens_custom_codes',
    array(
    	'title'			=> __('Custom CSS','lens'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','lens'),
    	'priority'		=> 11,
    	'panel'			=> 'lens_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'lens_custom_css',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'lens_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
	    new Lens_Custom_CSS_Control(
	        $wp_customize,
	        'lens_custom_css',
	        array(
	            'section' => 'lens_custom_codes',
	            'settings' => 'lens_custom_css'
	        )
	    )
	);
	
	function lens_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'lens_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','lens'),
    	'description'	=> __('Enter your Own Copyright Text.','lens'),
    	'priority'		=> 11,
    	'panel'			=> 'lens_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'lens_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'lens_footer_text',
	        array(
	            'section' => 'lens_custom_footer',
	            'settings' => 'lens_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_section(
	    'lens_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','lens'),
	        'priority'  => 41,
	        'description' => __('Defaults: Roboto Slab, Open Sans.','lens')
	    )
	);
	
	$font_array = array('Roboto Slab','Open Sans','Bitter','Raleway','Khula','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','Ubuntu','Lobster','Arimo','Bitter','Noto Sans');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'lens_title_font',
		array(
			'default'=> 'Roboto Slab',
			'sanitize_callback' => 'lens_sanitize_gfont' 
			)
	);
	
	function lens_sanitize_gfont( $input ) {
		if ( in_array($input, array('Roboto Slab','Open Sans','Bitter','Raleway','Khula','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'lens_title_font',array(
				'label' => __('Title','lens'),
				'settings' => 'lens_title_font',
				'section'  => 'lens_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'lens_body_font',
			array(	'default'=> 'Open Sans',
					'sanitize_callback' => 'lens_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'lens_body_font',array(
				'label' => __('Body','lens'),
				'settings' => 'lens_body_font',
				'section'  => 'lens_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('lens_social_section', array(
			'title' => __('Social Icons','lens'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','lens'),
					'facebook' => __('Facebook','lens'),
					'twitter' => __('Twitter','lens'),
					'google-plus' => __('Google Plus','lens'),
					'instagram' => __('Instagram','lens'),
					'rss' => __('RSS Feeds','lens'),
					'vimeo-square' => __('Vimeo','lens'),
					'youtube' => __('Youtube','lens'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'lens_social_'.$x, array(
				'sanitize_callback' => 'lens_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'lens_social_'.$x, array(
					'settings' => 'lens_social_'.$x,
					'label' => __('Icon ','lens').$x,
					'section' => 'lens_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'lens_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'lens_social_url'.$x, array(
					'settings' => 'lens_social_url'.$x,
					'description' => __('Icon ','lens').$x.__(' Url','lens'),
					'section' => 'lens_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function lens_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vimeo-square',
					'youtube',
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function lens_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function lens_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function lens_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'lens_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lens_customize_preview_js() {
	wp_enqueue_script( 'lens_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'lens_customize_preview_js' );
