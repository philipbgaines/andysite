<?php
/*
* Add-on Name: Content Box
* Add-on URI: http://highgradelab.com/plugins/highgrade-extender/
* Since: 1.0
* Add-on Author: Bogdan COSTESCU
*/
if(!class_exists('HGR_VC_CONTENTBOX')) {
	class HGR_VC_CONTENTBOX {
		
		function __construct() {
			add_action('admin_init', array($this, 'hgr_contentbox_init'));
			
			/*
				Param type "number"
			*/ 
			if ( function_exists('add_shortcode_param')){
				add_shortcode_param('number' , array('HGR_XTND', 'make_number_input' ) );
			}
		}
		
		/*
			Visual Composer mapping function
			Public API
			Refference:	http://kb.wpbakery.com/index.php?title=Vc_map
			Example:		http://kb.wpbakery.com/index.php?title=Visual_Composer_tutorial
		*/
		function hgr_contentbox_init() {
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   "name"			=>	__("HGR ContentBox", "hgr_lang"),
					   "base"			=>	"hgr_content_box",
					   "class"			=>	"",
					   "icon"			=>	"hgr_content_box",
					   "category"		=>	__("HighGrade Extender", "hgr_lang"),
					   "description"	=>	__("ContentBox with advanced settings", "hgr_lang"),
					   "params"		=>	array(
							/*
								Icon section configuration
							*/
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Display icon:","hgr_lang"),
								"param_name"	=>	"icon_type",
								"value"			=>	array(
										__( 'Font Icon Browser', 'hgr_lang' ) => 'selector',
										__( 'Custom Image Icon', 'hgr_lang' ) => 'custom',
									),
								"save_always" => true,
								"description"	=>	__("Use an existing font icon or upload a custom image.", "hgr_lang")
							),
							array(
								"type"			=>	"icon_browser",
								"class"			=>	"",
								"heading"		=>	__("Select Icon ","hgr_lang"),
								"param_name"	=>	"icon",
								"value"			=>	"",
								"description"	=>	__("Click on an icon to select it.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" )
									),
							),
							array(
								"type"			=>	"attach_image",
								"class"			=>	"",
								"heading"		=>	__("Upload Image Icon:", "hgr_lang"),
								"param_name"	=>	"icon_img",
								"admin_label"	=>	true,
								"value"			=>	"",
								"description"	=>	__("Upload the custom image icon.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "custom" )
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Image Width", "hgr_lang"),
								"param_name"	=>	"img_width",
								"value"			=>	48,
								"min"			=>	16,
								"max"			=>	512,
								"suffix"		=>	"px",
								"description"	=>	__("Provide image width", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "custom" )
									),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Size of Icon", "hgr_lang"),
								"param_name"	=>	"icon_size",
								"value"			=>	32,
								"min"			=>	12,
								"max"			=>	72,
								"suffix"		=>	"px",
								"description"	=>	__("Set the icon size.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" )
									),
							),
							array(
								"type"			=>"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color on normal state", "hgr_lang"),
								"param_name"	=>	"icon_color",
								"value"			=>	"#222222",
								"description"	=>	__("Select prefered color on normal state.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" ),
									),						
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Icon Color on hover state", "hgr_lang"),
								"param_name"	=>	"icon_color_hover",
								"value"			=>	"#FFFFFF",
								"description"	=>	__("Select prefered color on hover state.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"icon_type",
										"value"		=>	array( "selector" ),
									),						
							),
							/*
								Text and color configuration
							*/
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Title text","hgr_lang"),
								 "param_name"	=>	"title_normal",
								 "value"		=>	"Fast customization",
								 "description"	=>	__("Insert title text here.","hgr_lang"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color on normal state", "hgr_lang"),
								"param_name"	=>	"normal_title_color",
								"value"			=>	"#222222",
								"description"	=>	__("Color of title text in normal state.", "hgr_lang"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Title color on hover state", "hgr_lang"),
								"param_name"	=>	"hover_title_color",
								"value"			=>	"#ffffff",
								"description"	=>	__("Color of title text in hover state.", "hgr_lang"),
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Description text","hgr_lang"),
								 "param_name"	=>	"desc_normal",
								 "value"		=>	"Using the visual editor has never been easier.",
								 "description"	=>	__("Insert description here.","hgr_lang")
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color on normal state", "hgr_lang"),
								"param_name"	=>	"normal_desc_color",
								"value"			=>	"#8d8d8d",
								"description"	=>	__("Color of description text in normal state.", "hgr_lang"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Description color on hover state", "hgr_lang"),
								"param_name"	=>	"hover_desc_color",
								"value"			=>	"#85cee0",
								"description"	=>	__("Color of description text in hover state.", "hgr_lang"),
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Background type on normal state", "hgr_lang"),
								"param_name"	=>	"normal_background_type",
								"value"			=>	array(
										__( 'Select color', 'hgr_lang' ) => 'custom-normal-color',
										__( 'None', 'hgr_lang' ) => 'none',
									),
								"save_always" => true,
								"description"	=>	__("Select background type in normal state.", "hgr_lang"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background color on normal state", "hgr_lang"),
								"param_name"	=>	"normal_background_color",
								"value"			=>	"#ffffff",
								"description"	=>	__("Pick a background color for normal state.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"normal_background_type",
										"value"		=>	array( "custom-normal-color" )
									),						
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Border type on normal state", "hgr_lang"),
								"param_name"	=>	"normal_border_type",
								"value"			=>	array(
										__( 'None', 'hgr_lang' ) => 'none',
										__( 'Select color', 'hgr_lang' ) => 'custom-normal-border',
									),
								"save_always" => true,
								"description"	=>	__("Select border type in normal state.", "hgr_lang"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border width on normal state", "hgr_lang"),
								"param_name"	=>	"normal_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"normal_border_type",
										"value"		=>	array( "custom-normal-border" )
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color on normal state", "hgr_lang"),
								"param_name"	=>	"normal_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for normal state box.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"normal_border_type",
										"value"		=>	array( "custom-normal-border" )
									),						
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Background type on hover state", "hgr_lang"),
								"param_name"	=>	"hover_background_type",
								"value"			=>	array(
										__( 'Select color', 'hgr_lang' ) => 'custom-hover-color',
										__( 'None', 'hgr_lang' ) => 'none',
									),
								"save_always" => true,
								"description"	=>	__("Select background type in hover state.", "hgr_lang"),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Background color on hover state", "hgr_lang"),
								"param_name"	=>	"hover_background_color",
								"value"			=>	"#0484c9",
								"description"	=>	__("Pick a background color for hover state.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hover_background_type",
										"value"		=>	array( "custom-hover-color" )
									),						
							),
							array(
								"type"			=>	"dropdown",
								"class"			=>	"",
								"heading"		=>	__("Border type on hover state", "hgr_lang"),
								"param_name"	=>	"hover_border_type",
								"value"			=>	array(
										__( 'None', 'hgr_lang' ) => 'none',
										__( 'Select color', 'hgr_lang' ) => 'custom-hover-border',
									),
								"save_always" => true,
								"description"	=>	__("Select border type in hover state.", "hgr_lang"),
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Border width on hover state", "hgr_lang"),
								"param_name"	=>	"hover_border_width",
								"value"			=>	2,
								"min"			=>	1,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hover_border_type",
										"value"		=>	array( "custom-hover-border" )
									),
							),
							array(
								"type"			=>	"colorpicker",
								"class"			=>	"",
								"heading"		=>	__("Border color on hover state", "hgr_lang"),
								"param_name"	=>	"hover_border_color",
								"value"			=>	"#222222",
								"description"	=>	__("Pick a border color for hover state box.", "hgr_lang"),
								"dependency"	=>	array(
										"element"	=>	"hover_border_type",
										"value"		=>	array( "custom-hover-border" )
									),						
							),
							array(
								"type"			=>	"number",
								"class"			=>	"",
								"heading"		=>	__("Box Border Roundness:", "hgr_lang"),
								"param_name"	=>	"nh_border_roundness",
								"value"			=>	0,
								"min"			=>	0,
								"max"			=>	10,
								"suffix"		=>	"px",
								"description"	=>	__("Enter value in pixels, example: 0 for square, or 5 for rounded corners.", "hgr_lang"),
							),
							array(
								"type"			=>	"dropdown",
								"class"		=>	"",
								"heading"		=>	__("Link","hgr_lang"),
								"param_name"	=>	"custom_link",
								"value"			=>	array(
										__( 'No Link', 'hgr_lang' ) => '#',
										__( 'Add custom link to box', 'hgr_lang' ) => '1',
									),
								"save_always" => true,
								"description"	=>	__("You can add / remove custom link", "hgr_lang")
							),
							array(
								 "type"			=>	"vc_link",
								 "class"		=>	"",
								 "heading"		=>	__("Link ","hgr_lang"),
								 "param_name"	=>	"contentbox_link",
								 "value"		=>	"",
								 "description"	=>	__("You can add or remove the existing link from here.", "hgr_lang"),
								 "dependency"	=>	array(
								 		"element"	=>	"custom_link",
										"value"		=>	array( "1" )
									),
							),
							array(
								 "type"			=>	"textfield",
								 "class"		=>	"",
								 "heading"		=>	__("Extra class","hgr_lang"),
								 "param_name"	=>	"cb_extra_class",
								 "value"		=>	"",
								 "description"	=>	__("Add extra class name. You can use this class for your css/js customizations.", "hgr_lang")
							),
						),
					)
				);
			}
		}
	}
	new HGR_VC_CONTENTBOX;
}