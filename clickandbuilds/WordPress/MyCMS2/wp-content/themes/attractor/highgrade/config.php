<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_options";


    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }


    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'hgr_options',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,
        // REMOVE

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://www.youtube.com/user/HighGradeLab',
        'title' => 'YouTube Video Help',
        'icon'  => 'el el-youtube'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/highgradelab',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '<p>For support or problems please submit your ticket at <a href="https://highgrade.ticksy.com/" target="_blank">https://highgrade.ticksy.com/</a>.</p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>For support or problems please submit your ticket at <a href="https://highgrade.ticksy.com/" target="_blank">https://highgrade.ticksy.com/</a>.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>For support or problems please submit your ticket at <a href="https://highgrade.ticksy.com/" target="_blank">https://highgrade.ticksy.com/</a>.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    // ACTUAL DECLARATION OF SECTIONS ****************************************** //
	// BRANDING SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_branding',
		'icon'		=> 'el-icon-globe',
		'title'		=>	__('Branding', 'attractor'),
        'fields'		=> array(
			array(
				'id'			=>	'logo',
				'type'			=>	'media',
				'title'			=>	__('Regular logo', 'redux-framework-demo'),
				'subtitle'		=>	__('Upload your logo. <br>Recomended: 174px x 60px transparent .png', 'attractor'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array( 'url'=>get_template_directory_uri().'/highgrade/images/logo.png', 'width'=>'174', 'height'=>'60' ),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'			=>	'retina_logo',
				'type'			=>	'media',
				'title'			=>	__('Retina Logo @2x', 'redux-framework-demo'),
				'subtitle'		=>	__('Upload your retina logo. <br>Recomended: 348px x 120px transparent .png', 'attractor'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array( 'url'=>get_template_directory_uri().'/highgrade/images/logo@2x.png','width'=>'174', 'height'=>'60' ),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'			=>	'favicon',
				'type'			=>	'media',
				'title'			=>	__('Regular Favicon', 'redux-framework-demo'),
				'subtitle'		=>	__('Upload your favicon. <br>Recomended: 16px x 16px transparent .png file', 'attractor'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'			=>	'retina_favicon',
				'type'			=>	'media',
				'title'			=>	__('Retina Favicon @2x', 'redux-framework-demo'),
				'subtitle'		=>	__('Upload your retina favicon. <br>Recomended: 32px x 32px transparent .png file', 'attractor'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'			=>	'iphone_icon',
				'type'			=>	'media',
				'title'			=>	__('Apple iPhone Icon', 'attractor'),
				'subtitle'		=>	__('Upload your Apple iPhone icon. <br>Recomended: 60px x 60px transparent .png file', 'attractor'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/iphone-favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'			=>	'retina_iphone_icon',
				'type'			=>	'media',
				'title'			=>	__('Apple iPhone Retina Icon @2x', 'attractor'),
				'subtitle'		=>	__('Upload your Apple iPhone Retina icon. <br>Recomended: 120px x 120px transparent .png file', 'attractor'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/iphone-favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'			=>	'ipad_icon',
				'type'			=>	'media',
				'title'			=>	__('Apple iPad Icon', 'attractor'),
				'subtitle'		=>	__('Upload your Apple iPad icon. <br>Recomended: 76px x 76px transparent .png file', 'attractor'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/ipad-favicon.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
			array(
				'id'			=>	'ipad_retina_icon',
				'type'			=>	'media',
				'title'			=>	__('Apple iPad Retina Icon @2x', 'attractor'),
				'subtitle'		=>	__('Upload your Apple iPad Retina icon. <br>Recomended: 152px x 152px transparent .png file', 'attractor'),
				'url'			=>	true,
				'mode'			=>	false, // Can be set to false to allow any media type, or can also be set to any mime type.
				'default'		=>	array('url'=>get_template_directory_uri().'/highgrade/images/ipad-favicon@2x.png'),
				'hint'			=>	array(
					'content'	=>	'Please respect the recommended dimensions, in order to have a perfect-look branding.',
				)
			),
	)
    ) );
	
	// COLORS SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_colors',
		'icon'		=>	'el-icon-eye-open',
		'title'		=>	__('Colors', 'attractor'),
		'desc'		=>	__('You can setup two color schemes: dark and light', 'attractor'),
        'fields'     => array(
			array(
				'id'			=>	'bg_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'			=>	array('body, #pagesContent'),
				'title'			=>	__('Body Background Color', 'attractor'), 
				'subtitle'		=>	__('Pick a background color for the theme.', 'attractor'),
				'default'		=>	'#ffffff',
			),
			array(
				'id'			=>	'theme_dominant_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.theme_dominant_color, .wpcf7-submit'),
				'title'			=>	__('Theme dominant color', 'attractor'), 
				'subtitle'		=>	__('Pick a dominant color for the theme.', 'attractor'),
				'hint'			=>	array(
					'content'	=>	'Theme dominant color its used on certain elements, for witch you do not have a specific option to define a color.',
				),
				'default'		=>	'#FE7E17',
			),
	)
    ) );
	
	// COLORS SECTION - Dark Color Scheme
    Redux::setSection( $opt_name, array(
        'title'		=>	__('Dark Color Scheme', 'attractor'),
        'id'         => 'hgr_dark_colors',
		'subsection' => true,
        'fields'     => array(
			array(
				'id'			=>	'dark-scheme-info',
				'type'			=>	'info',
				'desc'			=>	__('Color options settings for "dark" color scheme (website sections that feature a dark image or background color; a light text color is recommended for these sections).', 'attractor'),
			),
			array(
				'id'			=>	'ds_text_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.dark_scheme'),
				'title'			=>	__('Text color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for text.', 'attractor'),
				'default'		=>	'#f2f2f2',
			),
			array(
				'id'			=>	'h1_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.dark_scheme h1'),
				'title'			=>	__('H1 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H1 tags.', 'attractor'),
				'default'		=>	'#ffffff',
			),
			array(
				'id'			=>	'h2_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.dark_scheme h2'),
				'title'			=>	__('H2 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H2 tags.', 'attractor'),
				'default'		=>	'#ffffff',
			),
			array(
				'id'			=>	'h3_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.dark_scheme h3'),
				'title'			=>	__('H3 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H3 tags.', 'attractor'),
				'default'		=>	'#ffffff',
			),
			array(
				'id'			=>	'h4_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.dark_scheme h4'),
				'title'			=>	__('H4 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H4 tags.', 'attractor'),
				'default'		=>	'#ffffff',
			),
			array(
				'id'			=>	'h5_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.dark_scheme h5'),
				'title'			=>	__('H5 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H5 tags.', 'attractor'),
				'default'		=>	'#ffffff',
			),
			array(
				'id'			=>	'h6_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.dark_scheme h6'),
				'title'			=>	__('H6 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H6 tags.', 'attractor'),
				'default'		=>	'#ffffff',
			),
			array(
				'id'        	=>	'ahref_color',
				'type'      	=>	'link_color',
				'output'		=>	array('.dark_scheme a'),
				'title'			=>	__('Links Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for links.', 'attractor'),
				'desc'      	=>	__('Setup links color on regular and hovered state.', 'redux-framework-demo'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#f2f2f2',
					'hover'		=>	'#fe7e17',
				)
			),
		)
    ) );
	
	// COLORS SECTION - Light Color Scheme
    Redux::setSection( $opt_name, array(
        'title'		=>	__('Light Color Scheme', 'attractor'),
        'id'         => 'hgr_light_colors',
		'subsection' => true,
        'fields'     => array(
			array(
				'id'			=>	'light-scheme-info',
				'type'			=>	'info',
				'desc'			=>	__('Color options settings for "light" color scheme (website sections that feature a light image or background color; a dark text color is recommended for these sections).', 'attractor'),
			),
			array(
				'id'			=>	'ls_text_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.light_scheme'),
				'title'			=>	__('Text color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for text.', 'attractor'),
				'default'		=>	'#444444',
			),
			array(
				'id'			=>	'light_h1_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.light_scheme h1'),
				'title'			=>	__('H1 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H1 tags.', 'attractor'),
				'default'		=>	'#444444',
			),
			array(
				'id'			=>	'light_h2_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.light_scheme h2'),
				'title'			=>	__('H2 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H2 tags.', 'attractor'),
				'default'		=>	'#444444',
			),
			array(
				'id'			=>	'light_h3_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.light_scheme h3'),
				'title'			=>	__('H3 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H3 tags.', 'attractor'),
				'default'		=>	'#fe7e17',
			),
			array(
				'id'			=>	'light_h4_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.light_scheme h4'),
				'title'			=>	__('H4 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H4 tags.', 'attractor'),
				'default'		=>	'#444444',
			),
			array(
				'id'			=>	'light_h5_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.light_scheme h5'),
				'title'			=>	__('H5 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H5 tags.', 'attractor'),
				'default'		=>	'#444444',
			),
			array(
				'id'			=>	'light_h6_color',
				'type'			=>	'color',
				'validate'		=>	'color',
				'output'		=>	array('.light_scheme h6'),
				'title'			=>	__('H6 Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for H6 tags.', 'attractor'),
				'default'		=>	'#444444',
			),
			array(
				'id'        	=>	'light_ahref_color',
				'type'      	=>	'link_color',
				'output'		=>	array('.light_scheme a'),
				'title'			=>	__('Links Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for links.', 'attractor'),
				'desc'      	=>	__('Setup links color on regular and hovered state.', 'redux-framework-demo'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#fe7e17',
					'hover'		=>	'#666666',
				)
			),
		)
    ) );
	
	// TYPOGRAPHY SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_typography',
		'icon'      => 'el-icon-fontsize',
		'title'		=>	__('Typography', 'attractor'),
		'desc'		=>	__('Setup the fonts that will be used in your theme. You can choose from Standard Fonts and Google Web Fonts.', 'attractor'),
        'fields'     => array(
			array(
				'id'			=> 'body-font',
				'type'			=> 'typography',
				'title'			=> __('Body Font', 'redux-framework-demo'),
				'subtitle' 	=> __('Specify the body font properties.', 'redux-framework-demo'),
				'output'		=> array('body'),
				'google'		=> true,
				'color'        => false,
				'default'		=> array(
					'font-size'		=>	'14px',
					'line-height'		=>	'20px',
					'font-family'		=>	'Open Sans',
					'font-weight'		=>	'400',
				),
			),
			array(
				'id'			=> 'h1-font',
				'type'			=> 'typography',
				'title'			=> __('H1 Font', 'attractor'),
				'subtitle'		=> __('Specify the H1 font properties.', 'attractor'),
				'output'		=> array('h1'),
				'google'		=> true,
				'color'       	=> false,
				'default'		=> array(
					'font-size'		=>	'60px',
					'line-height'		=>	'60px',
					'font-family'		=>	'Raleway',
					'font-weight'		=>	'200',
				),
			),
			array(
				'id'			=> 'h2-font',
				'type'			=> 'typography',
				'title'			=> __('H2 Font', 'attractor'),
				'subtitle'		=> __('Specify the H2 font properties.', 'attractor'),
				'output'		=> array('h2'),
				'google'		=> true,
				'color'        => false,
				'default'		=> array(
					'font-size'		=>	'28px',
					'line-height'		=>	'36px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'300',
				),
			),
			array(
				'id'			=> 'h3-font',
				'type'			=> 'typography',
				'title'			=> __('H3 Font', 'attractor'),
				'subtitle'		=> __('Specify the H3 font properties.', 'attractor'),
				'output'		=> array('h3'),
				'google'		=> true,
				'color'			=> false,
				'default'		=> array(
					'font-size'		=>	'18px',
					'line-height'		=>	'32px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'700',
				),
			),
			array(
				'id'			=> 'h4-font',
				'type'			=> 'typography',
				'title'			=> __('H4 Font', 'attractor'),
				'subtitle'		=> __('Specify the H4 font properties.', 'attractor'),
				'output'		=> array('h4'),
				'google'		=> true,
				'color'			=> false,
				'default'		=> array(
					'font-size'		=>	'18px',
					'line-height'		=>	'32px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
				),
			),
			array(
				'id'			=> 'h5-font',
				'type'			=> 'typography',
				'title'			=> __('H5 Font', 'attractor'),
				'subtitle'		=> __('Specify the H5 font properties.', 'attractor'),
				'output'		=> array('h5'),
				'google'		=> true,
				'color'			=> false,
				'default'		=> array(
					'font-size'		=>	'18px',
					'line-height'		=>	'32px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'700',
				),
			),
			array(
				'id'			=> 'h6-font',
				'type'			=> 'typography',
				'title'			=> __('H6 Font', 'attractor'),
				'subtitle'		=> __('Specify the H6 font properties.', 'attractor'),
				'output'		=> array('h6'),
				'google'		=> true,
				'color'			=> false,
				'default'		=> array(
					'font-size'		=>	'14px',
					'line-height'		=>	'36px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
				),
			),
			
			
	)
    ) );
	
	// MENU SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_menu',
		'icon'		=> 'el-icon-website',
		'title'		=>	__('Menu', 'attractor'),
        'fields'		=> array(
			array(
				'id'			=>	'menu-font',
				'type'			=>	'typography',
				'title'			=>	__('Menu Font', 'attractor'),
				'subtitle'		=>	__('Specify the menu font properties.', 'attractor'),
				'output'		=>	array('.bka_menu, .bka_menu .navbar-default .navbar-nav>li>a, .bka_menu .navbar-default .dropdown-menu>li>a'),
				'google'		=>	true,
				'color'			=>	false,
				'default'		=>	array(
					'font-size'		=>	'12px',
					'line-height'		=>	'30px',
					'font-family'		=>	'Roboto',
					'font-weight'		=>	'400',
				),
			),
			array(
				'id'        	=>	'menu-font-hover-color',
				'type'      	=>	'link_color',
				'output'		=>	array('.bka_menu .navbar-default .navbar-nav a','.bka_menu .navbar-default .navbar-nav li.active a'),
				'title'			=>	__('Menu Font Color', 'attractor'),
				'subtitle'		=>	__('Specify the menu font color.', 'attractor'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#666666',
					'hover'		=>	'#fe7e17',
				)
			),
			array(
				'id'			=>	'menu-style',
				'type'			=>	'switch',
				'title'			=>	__('Floating menu bar?', 'attractor'),
				'subtitle'		=>	__('If "Floating", the menu is hidden and it shows only after page scrolling.', 'attractor'),
				'default'		=>	0,
				'on'			=>	'Floating',
				'off'			=>	'Static',
			),
			array(
				'id'				=>	'menu-background',
				'type'				=>	'background',
				'output'			=>	array('.bka_menu'),
				'title'				=>	__('Menu Background', 'redux-framework-demo'),
				'subtitle'			=>	__('Menu background image (optional).', 'redux-framework-demo'),
				'preview_height'	=>	'60px',
				'background-color'	=>	false,
			),
			array(
				'id'				=> 'menu-bgcolor',
				'type'				=> 'color',
				'title'				=>	__('Top menu background color', 'attractor'), 
				'subtitle'			=>	__('Set the background color for top menu', 'attractor'),
				'default'			=> '#ffffff',
				'validate'			=> 'color',
			),
			array(
				'id'        => 'menu-border',
				'type'      => 'border',
				'title'     => __('Menu Border Option', 'redux-framework-demo'),
				'output'    => array('.bka_menu'), // An array of CSS selectors to apply this font style to
				'desc'      => __('Setup menu container border, in pixels (top, right, bottom, left).', 'redux-framework-demo'),
				'all'       => false,
				'default'   => array(
					'border-color'  => '#D8D8D8', 
					'border-style'  => 'solid', 
					'border-top'    => '0px', 
					'border-right'  => '0px', 
					'border-bottom' => '1px', 
					'border-left'   => '0px'
				)
			),	
		)
    ) );
	
	// FOOTER SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_footer',
		'icon'		=> 'el-icon-hand-down',
		'title'		=>	__('Footer', 'attractor'),
        'fields'		=> array(
			array(
				'id'				=> 'footer-bgcolor',
				'type'				=> 'color',
				//'output'			=>	array('.bka_footer'),
				'title'				=>	__('Footer background color', 'attractor'), 
				'subtitle'			=>	__('Set the background color for footer', 'attractor'),
				'default'			=> '#57595b',
				'validate'			=> 'color',
			),
			array(
				'id'				=>	'footer_color_scheme',
				'type'				=>	'select',
				'title'				=>	__('Color scheme to use on footer', 'attractor'), 
				'options'			=>	array('dark_scheme' => 'Dark scheme','light_scheme' => 'Light scheme'),
				'default'			=>	'dark_scheme'
			),
			array(
				'id'				=>	'footer-copyright',
				'type'				=>	'textarea',
				'validate'			=>	'html',
				'title'				=>	__('Footer copyright text', 'attractor'), 
				'subtitle'			=>	__('If empty, this section will be hidden.', 'attractor'),
				'desc'				=>	__('HTML is permited', 'attractor'),
				'default'			=>	'Copyright 2014 <a href="http://www.highgradelab.com">HighGrade</a>. All rights reserved.'
			),
		)
    ) );
	
	// PORTFOLIO SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_portfolio',
		'icon'		=> 'el-icon-cogs',
		'title'		=>	__('Portfolio', 'attractor'),
        'fields'		=> array(
			array(
				'id'		=>	'portfolio-items-select',
				'type'		=>	'select',
				'title'		=>	__('Portfolio items to show', 'attractor'), 
				'options'	=>	array('2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','8' => '8','9' => '9', '12' => '12', '16' => '16', '20' => '20', '24' => '24', '1000'=>'All', ),
				'default' 	=>	'9'
			),
			array(
				'id'		=>	'portfolio-order-by',
				'type'		=>	'select',
				'title'		=>	__('Order by', 'attractor'), 
				'subtitle'	=>	__('Order portfolio items by...', 'attractor'),
				'options'	=>	array('title' => 'Title', 'date' => 'Date','id' => 'ID','rand' => 'Random'),
				'default'	=>	'date'
			),
			array(
				'id'		=>	'portfolio-order',
				'type'		=>	'select',
				'title'		=>	__('Order', 'attractor'), 
				'options'	=>	array('ASC' => 'Ascending','DESC' => 'Descending'),
				'default'	=>	'DESC'
			),
		)
    ) );
	
	// BLOG SECTION
    Redux::setSection( $opt_name, array(
        'id'			=> 'hgr_blog',
		'icon'		=> 'el-icon-screen',
		'title'		=>	__('Blog', 'attractor'),
        'fields'		=> array(
			array(
				'id'			=> 'blog_body_font',
				'type'			=> 'typography',
				'output'		=>	array('body.blog, body.category, body.single, body.archive, body.search'),
				'title'			=>	__('Body Font for blog', 'attractor'),
				'subtitle'		=>	__('Specify the body font properties.', 'attractor'),
				'google'		=>	true,
				'color'			=>	true,
				'default'		=>	array(
					'color'			=>	'#444444',
					'font-size'	=>	'14px',
					'line-height'	=>	'20px',
					'font-family'	=>	'Open Sans',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'			=> 'blog_h1_font',
				'type'			=> 'typography',
				'output'		=>	array('body.blog h1, body.category h1, body.single h1, body.archive h1, body.search h1, body.blog h1 a, body.category h1 a, body.single h1 a, body.archive h1 a, body.search h1 a'),
				'title'			=>	__('H1 Font', 'attractor'),
				'subtitle'		=>	__('Specify the H1 font properties.', 'attractor'),
				'google'		=>	true,
				'color'			=>	true,
				'default'		=>	array(
					'color'			=>	'#444444',
					'font-size'	=>	'30px',
					'line-height'	=>	'35px',
					'font-family'	=>	'Source Sans Pro',
					'font-weight'	=>	'400',
					'text-transform' => 'uppercase'
				),
			),
			array(
				'id'			=> 'blog_h2_font',
				'type'			=> 'typography',
				'output'		=>	array('.blog h2, body.single h2'),
				'title'			=>	__('H2 Font', 'attractor'),
				'subtitle'		=>	__('Specify the H2 font properties.', 'attractor'),
				'google'		=>	true,
				'color'			=>	true,
				'default'		=>	array(
					'color'			=>	'#444444',
					'font-size'	=>	'30px',
					'line-height'	=>	'48px',
					'font-family'	=>	'Source Sans Pro',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'			=> 'blog_h3_font',
				'type'			=> 'typography',
				'output'		=>	array('.blog h3, body.single h3'),
				'title'			=>	__('H3 Font', 'attractor'),
				'subtitle'		=>	__('Specify the H3 font properties.', 'attractor'),
				'google'		=>	true,
				'color'			=>	true,
				'default'		=>	array(
					'color'			=>	'#333333',
					'font-size'	=>	'24px',
					'line-height'	=>	'36px',
					'font-family'	=>	'Source Sans Pro',
					'font-weight'	=>	'400',
				),
			),
			array(
				'id'			=> 'blog_h4_font',
				'type'			=> 'typography',
				'output'		=>	array('.blog h4, body.single h4'),
				'title'			=>	__('H4 Font', 'attractor'),
				'subtitle'		=>	__('Specify the H4 font properties.', 'attractor'),
				'google'		=>	true,
				'color'			=>	true,
				'default'		=>	array(
					'color'			=>	'#333333',
					'font-size'		=>	'16px',
					'line-height'	=>	'30px',
					'font-family'	=>	'Source Sans Pro',
					'font-weight'	=>	'600',
				),
			),
			array(
				'id'			=> 'blog_h5_font',
				'type'			=> 'typography',
				'output'		=>	array('.blog h5, body.single h5'),
				'title'			=>	__('H5 Font', 'attractor'),
				'subtitle'		=>	__('Specify the H5 font properties.', 'attractor'),
				'google'		=>	true,
				'color'			=>	true,
				'default'		=>	array(
					'color'			=>	'#000000',
					'font-size'		=>	'14px',
					'line-height'	=>	'25px',
					'font-family'	=>	'Source Sans Pro',
					'font-weight'	=>	'600',
				),
			),
			array(
				'id'			=> 'blog_h6_font',
				'type'			=> 'typography',
				'output'		=>	array('.blog h6, body.single h6'),
				'title'			=>	__('H6 Font', 'attractor'),
				'subtitle'		=>	__('Specify the H6 font properties.', 'attractor'),
				'google'		=>	true,
				'color'			=>	true,
				'default'		=>	array(
					'color'			=>	'#000000',
					'font-size'	=>	'12px',
					'line-height'	=>	'18px',
					'font-family'	=>	'Source Sans Pro',
					'font-weight'	=>	'300',
				),
			),
			array(
				'id'        	=>	'blog_ahref_color',
				'type'      	=>	'link_color',
				'output'		=>	array('#blogPosts a'),
				'title'			=>	__('Links Color', 'attractor'), 
				'subtitle'		=>	__('Pick a color for links.', 'attractor'),
				'desc'      	=>	__('Setup links color on regular and hovered state.', 'redux-framework-demo'),
				'regular'   	=>	true,	// Enable / Disable Regular Color
				'hover'     	=>	true,	// Enable / Disable Hover Color
				'active'    	=>	false,	// Enable / Disable Active Color
				'visited'   	=>	false,	// Enable / Disable Visited Color
				'default'   	=>	array(
					'regular'	=>	'#FE7E17',
					'hover'		=>	'#444444',
				)
			),
			array(
				'id'				=> 'blog_bg_color',
				'type'				=> 'color',
				//'output'			=>	array('.bka_footer'),
				'title'				=>	__('Body Background Color', 'attractor'), 
				'subtitle'			=>	__('Pick a background color for blog.', 'attractor'),
				'default'			=> '#ffffff',
				'validate'			=> 'color',
			),
		)
    ) );
	
	// CUSTOM CODE SECTION
    Redux::setSection( $opt_name, array(
        'title'		=>	__('Custom Code', 'attractor'),
        'id'         => 'hgr_custom_code',
        'fields'     => array(
			array(
				'id'        => 'css-code',
				'type'      => 'ace_editor',
				'title'     => __('CSS Code', 'redux-framework-demo'),
				'subtitle'  => __('Paste your CSS code here.', 'redux-framework-demo'),
				'mode'      => 'css',
				'theme'     => 'monokai',
				'default'   => ""
			),
			array(
				'id'        => 'js-code',
				'type'      => 'ace_editor',
				'title'     => __('JS Code', 'redux-framework-demo'),
				'subtitle'  => __('Paste your JS code here.', 'redux-framework-demo'),
				'mode'      => 'javascript',
				'theme'     => 'chrome',
				'default'   => "jQuery(document).ready(function(){\n\n});"
			),
		)
    ) );
	
	
	/*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
        print_r( $changed_values ); // Values that have changed since the last save
        echo "</pre>";
        //print_r($options); //Option values
        //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    function dynamic_section( $sections ) {
        //$sections = array();
        $sections[] = array(
            'title'  => __( 'Section via hook', 'redux-framework-demo' ),
            'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
            'icon'   => 'el el-paper-clip',
            // Leave this as a blank section, no options just some intro text set above.
            'fields' => array()
        );

        return $sections;
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
