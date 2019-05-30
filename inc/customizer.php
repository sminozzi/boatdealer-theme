<?php
/**
 * boatdealer Customizer functionality
 *
 * @package boatdealer
 * 
 * @since boatdealer 1.0
 */
/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since boatdealer 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function boatdealer_customize_register( $wp_customize ) {
$wp_customize->add_panel( 'general', array(
    'title' => 'Customize',
    'description' => 'General Settings Panel',
    'priority' => 10,
) ); 
$wp_customize->add_panel( 'settings', array(
    'title' => 'Settings',
    'description' => 'Settings Panel',
    'priority' => 20,
) );
$wp_customize->get_section('static_front_page')->panel = 'settings';
// $wp_customize->get_section('colors')->panel = 'general';
$wp_customize->get_section('header_image')->panel = 'general';
$wp_customize->get_section('background_image')->panel = 'general';
$wp_customize->get_section('title_tagline')->panel = 'settings';
$wp_customize->get_section('background_image')->panel = 'general';
  		$wp_customize->add_setting( 'boat_logo_margin_top', array(
         'sanitize_callback' =>'boat_sanitize_text',
         'default' => '00'
		) );
		$wp_customize->add_control( 'boat_logo_margin_top', array(
			'label'      => __( 'Logo Margin From Top', 'boatdealer' ),
			'section'    => 'title_tagline',
            'type' => 'range',
            'description' => __( 'Choose from -20px to 100px', 'boatdealer' ),
         	'priority' => 9,
            'input_attrs' => array(
            'min' => -20,
            'max' => 100,
            'step' => 10
          ),
		) );  
     $wp_customize->add_setting('boat_logo_height', array(
     'sanitize_callback' =>'boat_sanitize_text',
     'default' => '200'
     ));
     $wp_customize->add_control( 'boat_logo_height', array(
      'type' => 'range',
      'section' => 'title_tagline',
      'priority' => 9,
      'label' => __( 'Logo Height', 'boatdealer' ),
      'description' => __( 'Choose from 20 to 300 Pixels.', 'boatdealer' ),
      'sanitize_callback' => 'boat_sanitize_number', 
      'input_attrs' => array(
        'min' => 20,
        'max' => 360,
        'step' => 5,
      ),
    ) );    
    // Lay Out
    $wp_customize->add_section( 
    	'general_settings_section', 
    	array(
    		'title'       => __( 'Layout', 'boatdealer' ),
    		'priority'    => 1,
    		'capability'  => 'edit_theme_options',
    		'description' => __('Change General options here.', 'boatdealer'), 
            'panel'       => 'general',    	) 
    );
    $wp_customize->add_setting( 'boatdealer_menus_enabled', array(
      'default' =>'1' ,
      'sanitize_callback' =>'boat_sanitize_text',
    ));
	$wp_customize->add_control(
		'boatdealer_menus_enabled',
		array(
			'settings'		=> 'boatdealer_menus_enabled',
			'section'		=> 'general_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Menu enabled', 'boatdealer' ),
			'description'	=> '',
			'choices'		=> array(
				'1' => __( 'Vertical Left Menu', 'boatdealer' ),
				'2' => __( 'Horizontal Top Menu', 'boatdealer' )
			//	'3' => __( 'Both', 'boatdealer' )
			)
		)
	); 
     $wp_customize->add_setting('boatdealer_layout_type', array(
     'sanitize_callback' =>'boat_sanitize_text',
     'default' => '2'
     ));
 	$wp_customize->add_control(
		'boatdealer_layout_type',
		array(
			'settings'		=> 'boatdealer_layout_type',
			'section'		=> 'general_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Website Layout', 'boatdealer' ) ,
			'description'	=> '',
			'choices'		=> array(
				'1' => 'Boxed Width 1000px',
				'2' => 'Wide'
			)
		)
	);   
     $wp_customize->add_setting('boatdealer_opacity', array(
     'sanitize_callback' =>'boat_sanitize_text',
     'default' => '10'
     ));
     $wp_customize->add_control( 'boatdealer_opacity', array(
      'type' => 'range',
      'section' => 'general_settings_section',
      'label' => __( 'Background transparency (opacity)', 'boatdealer' ),
      'description' => __( 'Choose from .6 to 1', 'boatdealer' ),
      'input_attrs' => array(
        'min' => 6,
        'max' => 10,
        'step' => 1,
      ),
    ) );
    $wp_customize->add_setting('boatdealer_entry_title', array(
     'sanitize_callback' =>'boat_sanitize_text', 
     'default' => '1',
     ));
	$wp_customize->add_control(
		'boatdealer_entry_title',
		array(
			'settings'		=> 'boatdealer_entry_title',
			'section'		=> 'general_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Show entry-title', 'boatdealer' ),
			'description'	=> '',
			'choices'		=> array(
				'1' => 'Yes',
				'2' => 'No'
			)
		)
	);
    
    
    $wp_customize->add_setting('boatdealer_loading', array(
     'sanitize_callback' =>'sanitize_text_field','default' => '1',
     ));
	$wp_customize->add_control(
		'boatdealer_loading',
		array(
			'settings'		=> 'boatdealer_loading',
			'section'		=> 'general_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Show small orange loading image at top-right corner. ', 'boatdealer' ),
			'description'	=> '',
			'choices'		=> array(
				'1' => 'Yes',
				'2' => 'No'
			)
		)
	);    
    
    
    $wp_customize->add_setting('boatdealer_position', array(
     'sanitize_callback' =>'sanitize_text_field', 'default' => '1',
     ));
	$wp_customize->add_control(
		'boatdealer_position',
		array(
			'settings'		=> 'boatdealer_position',
			'section'		=> 'general_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Vertical menu and sidebar position. ', 'boatdealer' ),
			'description'	=> '',
			'choices'		=> array(
				'1' => 'Left',
				'2' => 'Right'
			)
		)
	);    
    

    $wp_customize->add_setting('boatdealer_show_sidebar', array(
     'sanitize_callback' =>'sanitize_text_field', 
     'default' => '1',
     ));
	$wp_customize->add_control(
		'boatdealer_position',
		array(
			'settings'		=> 'boatdealer_show_sidebar',
			'section'		=> 'general_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Show Sidebar Widgets in Small Devices? ', 'boatdealer' ),
			'description'	=> '',
			'choices'		=> array(
				'1' => 'Yes',
				'0' => 'No'
			)
		)
	);    
    
    
// End General
// Code
    $wp_customize->add_section( 
    	'code_settings_section', 
    	array(
    		'title'       => __( 'Code', 'boatdealer' ),
    		'priority'    => 20,
    		'capability'  => 'edit_theme_options',
    		'description' => __('Analytics.', 'boatdealer'), 
                	) 
    );   
     $wp_customize->add_setting('boatdealer_analytics', array(
     'sanitize_callback' =>'boat_sanitize_text',
     ));
    $wp_customize->add_control('boatdealer_analytics', array(
     'label'   => __( 'Google Analytics Tracking ID', 'boatdealer' ),
      'section' => 'code_settings_section',
     'type'    => 'text',
	 'description'	=> __('For example: UA-99999999-9 (no javascript)', 'boatdealer'),
    ));
// End Code    
// Footer
      $wp_customize->add_section( 
    	'footer_settings_section', 
    	array(
    		'title'       => __( 'Footer Copyright', 'boatdealer' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting('boatdealer_footer_copyright', array(
      'sanitize_callback' =>'boat_sanitize_html', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatdealer_footer_copyright', array(
     'label'   => __( 'Copyright Footer Text Here', 'boatdealer' ),
      'section' => 'footer_settings_section',
     'type'    => 'textarea',
    ));            
    $wp_customize->add_setting( 'boatdealer_copyright_background',
    	array(
    		'default' => '#f1f1f1',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_copyright_background', array(
    			'label'    => __( 'Copyright Background Color', 'boatdealer' ),
                'section' => 'footer_settings_section', 
    	        'settings' => 'boatdealer_copyright_background',
           		'priority' => 20,
    		)
    	)
    );
        $wp_customize->add_setting( 'boatdealer_copyright_color',
    	array(
    		'default' => '#333333',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_copyright_color', array(
    			'label'    => __( 'Copyright Text Color', 'boatdealer' ),
                'section' => 'footer_settings_section', 
    	        'settings' => 'boatdealer_copyright_color',
           		'priority' => 30,
    		)
    	)
    );
    /* End Footer  */
	$color_scheme = boatdealer_get_color_scheme();
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'boatdealer_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'boatdealer' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => boatdealer_get_color_scheme_choices(),
		'priority' => 1,
	) );
	// Add custom header and sidebar text color setting and control.
	$wp_customize->add_setting( 'sidebar_textcolor', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_textcolor', array(
		'label'       => __( 'Header and Sidebar Text Color', 'boatdealer' ),
		'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.', 'boatdealer' ),
		'section'     => 'colors',
	) ) );
	// Add custom menu text color.
	$wp_customize->add_setting( 'menu_textcolor', array(
		'default'           => $color_scheme[6],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_textcolor', array(
		'label'       => __( 'Menu Text Color', 'boatdealer' ),
		'section'     => 'colors',
	) ) );
	// Remove the core header textcolor control, as it shares the sidebar text color.
	$wp_customize->remove_control( 'header_textcolor' );
	// Add custom header and sidebar background color setting and control.
	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'       => __( 'Header and Sidebar Background Color', 'boatdealer' ),
		'description' => __( 'Applied to the header on small screens and the sidebar on wide screens.', 'boatdealer' ),
		'section'     => 'colors',
	) ) );
	// Add an additional description to the header image section.
  	$wp_customize->get_section( 'header_image' )->description = __( 'Applied to the header on small screens and the sidebar on wide screens.', 'boatdealer' );
// Top Page Settings
      $wp_customize->add_section( 
    	'top_header_settings_section', 
    	array(
    		'title'       => __( 'Top Page Settings', 'boatdealer' ),
    		'priority'    => 81,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general',    	 
    	) 
    );
    $wp_customize->add_setting('boatdealer_topinfo_phone', array(
      'sanitize_callback' =>'boat_sanitize_html', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatdealer_topinfo_phone', array(
     'label'   => __( 'Top Info Phone', 'boatdealer' ),
      'section' => 'top_header_settings_section',
     'type'    => 'text',
    )); 
       $wp_customize->add_setting('boatdealer_topinfo_email', array(
      'sanitize_callback' =>'boat_sanitize_email', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatdealer_topinfo_email', array(
     'label'   => __( 'Top Info eMail', 'boatdealer' ),
      'section' => 'top_header_settings_section',
     'type'    => 'text',
    ));
    
    $wp_customize->add_setting('boatdealer_topinfo_email_link', array(
      'sanitize_callback' =>'boatdealer_sanitize_html', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatdealer_topinfo_email_link', array(
     'label'   => __( 'Link for previous field or Left blank for default email link.', 'boatdealer' ),
      'section' => 'top_header_settings_section',
     'type'    => 'textarea',
    ));
     
       $wp_customize->add_setting('boatdealer_topinfo_hours', array(
      'sanitize_callback' =>'boat_sanitize_html', 
      'default'        => '',
     ));
    $wp_customize->add_control('boatdealer_topinfo_hours', array(
     'label'   => __( 'Top Info Hours', 'boatdealer' ),
      'section' => 'top_header_settings_section',
     'type'    => 'text',
    )); 
    $wp_customize->add_setting( 'boatdealer_topinfo_color', array(
      'default' =>'gray' ,
      'sanitize_callback' =>'boat_sanitize_text',
    ));
	$wp_customize->add_control(
		'boatdealer_topinfo_color',
		array(
			'settings'		=> 'boatdealer_topinfo_color',
			'section'		=> 'top_header_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'Top Page Info Color', 'boatdealer' ),
			'description'	=> '',
			'choices'		=> array(
				'white' => __( 'White', 'boatdealer' ),
				'gray' => __( 'Gray', 'boatdealer' ),
				'black' => __( 'Black', 'boatdealer' )
			)
		)
	);  
     $wp_customize->add_setting('boatdealer_search_icon', array(
     'sanitize_callback' =>'boat_sanitize_text',
     'default' => 'Gray'
     ));
	$wp_customize->add_control(
		'boatdealer_search_icon',
		array(
			'settings'		=> 'boatdealer_search_icon',
			'section'		=> 'top_header_settings_section',
			'type'			=> 'radio',
			'label'			=> __( 'My Search Icon Color', 'boatdealer' ),
			'description'	=> __( 'Find this icon at bottom right corner of the header.', 'boatdealer' ),
            'sanitize_callback' => 'sanitize_text_field',            
			'choices'		=> array(
				'White' => __( 'White', 'boatdealer' ),
				'Gray' => __( 'Light Gray', 'boatdealer' ),
                'No' => __( 'Hidden', 'boatdealer' ),
			)
		)
	); 
// End Top Page Settings
//////// Mobile Menu //////////
      $wp_customize->add_section( 
    	'mobile_navigation_section', 
    	array(
    		'title'       => __( 'Mobile Navigation Design', 'boatdealer' ),
    		'priority'    => 103,
    		'capability'  => 'edit_theme_options',
    		'description' => '',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting( 'boatdealer_mobile_background',
    	array(
    		'default' => '#555555',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_mobile_background', array(
    			'label'    => __( 'Mobile Background Color', 'boatdealer' ),
                'section' => 'mobile_navigation_section', 
    	        'settings' => 'boatdealer_mobile_background',
           		'priority' => 20,
    		)
    	)
    );
        $wp_customize->add_setting( 'boatdealer_mobile_color',
    	array(
    		'default' => '#ffffff',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_mobile_color', array(
    			'label'    => __( 'Mobile Text Color', 'boatdealer' ),
                'section' => 'mobile_navigation_section', 
    	        'settings' => 'boatdealer_mobile_color',
           		'priority' => 30,
    		)
    	)
    );
    $wp_customize->add_setting( 'boatdealer_mobile_separator',
    	array(
    		'default' => '#333333',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_mobile_separator', array(
    			'label'    => __( 'Mobile Separator Color', 'boatdealer' ),
                'section' => 'mobile_navigation_section', 
    	        'settings' => 'boatdealer_mobile_separator',
           		'priority' => 40,
    		)
    	)
    );
    $wp_customize->add_setting( 'boatdealer_mobile_icon',
    	array(
    		'default' => '#ffffff',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_mobile_icon', array(
    			'label'    => __( 'Mobile Bar Icon Color', 'boatdealer' ),
                'section' => 'mobile_navigation_section', 
    	        'settings' => 'boatdealer_mobile_icon',
           		'priority' => 50,
    		)
    	)
    );
    $wp_customize->add_setting( 'boatdealer_mobile_name_color',
    	array(
    		'default' => '#A8A9AC',
	    	'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_mobile_name_color', array(
    			'label'    => __( 'Mobile Menu Name Color', 'boatdealer' ),
                'section' => 'mobile_navigation_section', 
    	        'settings' => 'boatdealer_mobile_name_color',
           		'priority' => 50,
    		)
    	)
    );
    
    // Blog Settings
      $wp_customize->add_section( 
    	'blog_settings_section', 
    	array(
    		'title'       => __( 'Blog Settings', 'boatdealer' ),
    		'priority'    => 100,
    		'capability'  => 'edit_theme_options',
    		'description' => 'Configure Blog style.',
            'panel'       => 'general', 
    	) 
    );
    $wp_customize->add_setting( 'boatdealer_blog_style', array(
      'default' =>'3' ,
      'sanitize_callback' =>'boat_sanitize_text',
    ));
	$wp_customize->add_control(
		'boatdealer_blog_style',
		array(
			'settings'		=> 'boatdealer_blog_style',
			'section'		=> 'blog_settings_section',
			'type'			=> 'select',
			'label'			=> __( 'Choose Blog Page Style', 'boatdealer' ),
			'description'	=> 'Look the right panel (and go to blog page) to see the preview...',
			'choices'		=> array(
				'1' => 'Blog Standard',
				'2' => 'Blog List View',
                '3' => 'Blog Masonry', 
			)
		)
	);
$wp_customize->add_setting('boatdealer_blog_post_meta', array(
     'sanitize_callback' =>'boat_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatdealer_blog_post_meta', array(
				'label'    => __( 'Turn on to display post meta on blog single posts page','boatdealer' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatdealer_blog_post_meta',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('boatdealer_blog_post_author', array(
     'sanitize_callback' =>'boat_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatdealer_blog_post_author', array(
				'label'    => __( 'Turn on to display post author on blog single posts page','boatdealer' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatdealer_blog_post_author',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('boatdealer_blog_post_categories', array(
     'sanitize_callback' =>'boat_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatdealer_blog_post_categories', array(
				'label'    => __( 'Turn on to display categories on blog posts','boatdealer' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatdealer_blog_post_categories',
				'type'     => 'checkbox',
			) );
$wp_customize->add_setting('boatdealer_blog_post_date', array(
     'sanitize_callback' =>'boat_sanitize_checkbox', 
     'default' => '1',
     ));
$wp_customize->add_control( 'boatdealer_blog_post_date', array(
				'label'    => __( 'Turn on to display date on blog posts','boatdealer' ),
				'section'  => 'blog_settings_section',
				'settings' => 'boatdealer_blog_post_date',
				'type'     => 'checkbox',
			) );

/*    
// Post meta
// Turn on to display post meta on blog posts
Display Author
Display author on blog posts
Display Categories
Display categories on blog posts
*/
// End Blog
/////////// end Mobile Menu /////////////
/////////// Top Navigation Details
    $wp_customize->add_section( 
    	'navigation_colors_section', 
    	array(
    		'title'       => __( 'Top Navigation Design', 'boatdealer' ),
    		'priority'    => 101,
    		'capability'  => 'edit_theme_options',
    		'description' => __('Change Top Navigation detais here. <br />If you install WooCommerce, maybe you will need set this Top Margin around 50 pixels to left space for their menu.', 'boatdealer'), 
            'panel'       => 'general', 
    	) 
    );
     $wp_customize->add_setting( 'boatdealer_menu_margin_top',
        	array(
        		'default' => '10',
                'sanitize_callback' =>'boat_sanitize_text',
        	)
        );
     $wp_customize->add_control( 'boatdealer_menu_margin_top', array(
      'type' => 'range',
      'section' => 'navigation_colors_section',
      'label' => __( 'Menu Margin Top', 'boatdealer' ),
      'description' => __( 'Choose from 0 to 50 Pixels.', 'boatdealer' ),
      'input_attrs' => array(
        'min' => 0,
        'max' => 50,
        'step' => 1,
      ),
    ) );
    $wp_customize->add_setting( 'menu_font_size',
        	array(
        		'default' => '14',
                'sanitize_callback' =>'boat_sanitize_text',
        	)
        );
     $wp_customize->add_control( 'menu_font_size', array(
      'type' => 'range',
      'section' => 'navigation_colors_section',
      'label' => __( 'Menu Font Size', 'boatdealer' ),
      'description' => __( 'Choose from 12 to 18 Pixels.', 'boatdealer' ),
      'input_attrs' => array(
        'min' => 12,
        'max' => 18,
        'step' => 1,
      ),
    ) );
    function choice_a_background_color( $control ) {
        if ( $control->manager->get_setting('display_background_navigation_color')->value() == '1' ) {
            return true;
        } else {
            return false;
        }
    }
    $wp_customize->add_setting('display_background_navigation_color', array(
     'default'        => '',
     'sanitize_callback' => 'boat_sanitize_checkbox',
     ));
	$wp_customize->add_control(
		// $id
		'display_background_navigation_color',
		// $args
		array(
			'settings'		=> 'display_background_navigation_color',
			'section'		=> 'navigation_colors_section',
			'type'			=> 'checkbox',
            'sanitize_callback' => 'boat_sanitize_checkbox',
			'label'			=> __( 'Check to Use Background Navigation Color', 'boatdealer' ),
		)
	);
    $wp_customize->add_setting( 'boatdealer_navigation_background',
    	array(
    		'default' => '#e65e23',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_navigation_background', array(
    			'label'    => __( 'Background Navigation Color', 'boatdealer' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatdealer_navigation_background',
           		'priority' => 10,
    		)
    	)
    );
     $wp_customize->add_setting( 'boatdealer_menu_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_menu_color', array(
    			'label'    => __( 'Menu Text Color', 'boatdealer' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatdealer_menu_color',
           		'priority' => 10,
    		)
    	)
    ); 
   $wp_customize->add_setting( 'boatdealer_menu_hover_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_menu_hover_color', array(
    			'label'    => __( 'Menu Text Hover Color', 'boatdealer' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatdealer_menu_hover_color',
           		'priority' => 10,
    		)
    	)
    );   
      $wp_customize->add_setting( 'boatdealer_sub_menu_text_color',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_sub_menu_text_color', array(
    			'label'    => __( 'Sub Menu Text Color', 'boatdealer' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatdealer_sub_menu_text_color',
           		'priority' => 10,
    		)
    	)
    ); 
     $wp_customize->add_setting( 'boatdealer_menu_background',
    	array(
    		'default' => '#e65e23',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_menu_background', array(
    			'label'    => __( 'Sub Menu Background', 'boatdealer' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatdealer_menu_background',
           		'priority' => 10,
    		)
    	)
    );     
    $wp_customize->add_setting( 'boatdealer_submenu_hover_color',
    	array(
    		'default' => '#e65e23',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_submenu_hover_color', array(
    			'label'    => __( 'Sub Menu Hover color', 'boatdealer' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatdealer_submenu_hover_color',
           		'priority' => 10,
    		)
    	)
    );     
     $wp_customize->add_setting( 'boatdealer_submenu_hover_background',
    	array(
    		'default' => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
    	)
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'boatdealer_submenu_hover_background', array(
    			'label'    => __( 'Sub Menu Hover Background', 'boatdealer' ),
                'section' => 'navigation_colors_section', 
    	        'settings' => 'boatdealer_submenu_hover_background',
           		'priority' => 10,
    		)
    	)
    );
/* end top navigation details */    
    /* Sanitize */
    function boat_sanitize_html( $str ) {
    $allowed_html = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		'em' => array(),
		'i' => array(),
		'q' => array(
			'cite' => true,
		),
		'strike' => array(),
		'strong' => array(),
	);
        wp_kses($str, $allowed_html); 
        return trim($str) ;
    }    
    function boat_sanitize_url( $str ) {
        return esc_url( $str );
    } 
    function boat_sanitize_text( $str ) {
        return sanitize_text_field( $str );
    } 
    function boat_sanitize_textarea( $text ) {
        return esc_textarea( $text );
    } 
    function boat_sanitize_email( $text ) {
        return sanitize_email( $text );
    } 
    function boat_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
       } else {
        return '';
       }
    }
    function boat_sanitize_css( $text ) {
        $text1 = strtolower($text);
        $pos = strpos($text1,'<?php' );
        if ($pos !== false)
          return get_theme_mod('boatdealer_custom_css',2);
        $pos = strpos($text1,'javascript' );
        if ($pos !== false)
           return get_theme_mod('boatdealer_custom_css',2);
        return $text;
    }   
}
add_action( 'customize_register', 'boatdealer_customize_register', 11 );
/**
 * Register color schemes for boatdealer.
 *
 * Can be filtered with {@see 'boatdealer_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 * 7. Menu_textcolor
 *
 * @since boatdealer 1.0
 *
 * @return array An associative array of color scheme options.
 */
function boatdealer_get_color_schemes() {
	return apply_filters( 'boatdealer_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'boatdealer' ),
			'colors' => array(
				'#f1f1f1',
				'#ffffff',
				'#ffffff',
				'#333333',
				'#333333',
				'#f7f7f7',
				'#000000',
			),
		),
		'dark'    => array(
			'label'  => __( 'Dark', 'boatdealer' ),
			'colors' => array(
				'#111111',
				'#000000',
				'#202020',
				'#bebebe',
				'#bebebe',
				'#1b1b1b',
				'#ffffff',
			),
		),
		'Green'  => array(
			'label'  => __( 'Green', 'boatdealer' ),
			'colors' => array(
				'#CED7CE',
				'#067F44',
				'#ffffff',
				'#111111',
				'#ffffff',
				'#f1f1f1',
				'#ffffff',
			),
		),
		'red'    => array(
			'label'  => __( 'Red', 'boatdealer' ),
			'colors' => array(
				'#ffe5d1',
				'#e53b51',
				'#ffffff',
				'#352712',
				'#ffffff',
				'#f1f1f1',
				'#ffffff',
			),
		),
		'orange'  => array(
			'label'  => __( 'Orange', 'boatdealer' ),
			'colors' => array(
				'#ffe5d1', 
				'#FF6726',
				'#ffffff',
				'#FF6726',
				'#ffffff',
				'#f1f1f1',
				'#ffffff',
			),
		),
		'blue'   => array(
			'label'  => __( 'Blue', 'boatdealer' ),
			'colors' => array(
				'#e9f2f9',
				'#00608E',
				'#ffffff',
				'#22313f',
				'#ffffff',
				'#f1f1f1',
				'#ffffff',
			),
		),
  		'brown'   => array(
			'label'  => __( 'Brown', 'boatdealer' ),
			'colors' => array(
				'#D6CEBB',
				'#A27500',
				'#ffffff',
				'#22313f',
				'#ffffff',
				'#f1f1f1',
				'#ffffff',
			),
		),      
	) );
}
if ( ! function_exists( 'boatdealer_get_color_scheme' ) ) :
/**
 * Get the current boatdealer color scheme.
 *
 * @since boatdealer 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function boatdealer_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'blue' );
	$color_schemes       = boatdealer_get_color_schemes();
	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}
	return $color_schemes['default']['colors'];
}
endif; // boatdealer_get_color_scheme
if ( ! function_exists( 'boatdealer_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for boatdealer.
 *
 * @since boatdealer 1.0
 *
 * @return array Array of color schemes.
 */
function boatdealer_get_color_scheme_choices() {
	$color_schemes                = boatdealer_get_color_schemes();
	$color_scheme_control_options = array();
	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}
	return $color_scheme_control_options;
}
endif; // boatdealer_get_color_scheme_choices
if ( ! function_exists( 'boatdealer_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since boatdealer 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function boatdealer_sanitize_color_scheme( $value ) {
	$color_schemes = boatdealer_get_color_scheme_choices();
	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}
	return $value;
}
endif; // boatdealer_sanitize_color_scheme
/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since boatdealer 1.0
 *
 * @see wp_add_inline_style()
 */
function boatdealer_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'blue' );
	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}
	$color_scheme = boatdealer_get_color_scheme();
	// Convert main and sidebar text hex color to rgba.
	$color_textcolor_rgb         = boatdealer_hex2rgb( $color_scheme[3] );
	$color_sidebar_textcolor_rgb = boatdealer_hex2rgb( $color_scheme[4] );
	$colors = array(
		'background_color'            => $color_scheme[0],
		'header_background_color'     => $color_scheme[1], 
		'box_background_color'        => $color_scheme[2],
		'textcolor'                   => $color_scheme[3],
		'secondary_textcolor'         => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_textcolor_rgb ),
		'border_color'                => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_textcolor_rgb ),
		'border_focus_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_textcolor_rgb ),
		'sidebar_textcolor'           => $color_scheme[4],
		'sidebar_border_color'        => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_sidebar_textcolor_rgb ),
		'sidebar_border_focus_color'  => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.3)', $color_sidebar_textcolor_rgb ),
		'secondary_sidebar_textcolor' => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_sidebar_textcolor_rgb ),
		'meta_box_background_color'   => $color_scheme[5],
        'menu_textcolor'   => $color_scheme[6], 
	);
      $header_background_color = get_theme_mod('header_background_color', '#ffffff' ); 
      if(!empty($header_background_color))
         $colors['header_background_color'] = $header_background_color;
      $menu_textcolor = get_theme_mod('menu_textcolor','#ffffff');
      if(!empty($menu_textcolor))
         $colors['menu_textcolor'] = $menu_textcolor;
	$color_scheme_css = boatdealer_get_color_scheme_css( $colors );
	wp_add_inline_style( 'boatdealer-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'boatdealer_color_scheme_css' );
/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since boatdealer 1.0
 */
function boatdealer_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', boatdealer_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'boatdealer_customize_control_js' );
/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since boatdealer 1.0
 */
function boatdealer_customize_preview_js() {
	wp_enqueue_script( 'boatdealer-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'boatdealer_customize_preview_js' );
/**
 * Returns CSS for the color schemes.
 *
 * @since boatdealer 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function boatdealer_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'            => '',
		'header_background_color'     => '',
		'box_background_color'        => '',
		'textcolor'                   => '',
		'secondary_textcolor'         => '',
		'border_color'                => '',
		'border_focus_color'          => '',
		'sidebar_textcolor'           => '',
		'sidebar_border_color'        => '',
		'sidebar_border_focus_color'  => '',
		'secondary_sidebar_textcolor' => '',
		'meta_box_background_color'   => '',
        'menu_textcolor' => '',
	) );
	$css = <<<CSS
	/* Color Scheme */
    #wrapper,
    .sidebar,
    #sidebar
    {
      background-color: {$colors['header_background_color']} !important;  
    }
    #wrapper
    {
      background:  {$colors['background_color']} !important; 
	}
	/* Box Background Color */
	.post-navigation,
	.pagination,
	.secondary,
	.site-footer,
    .footer-container,
    #colophon,
	.hentry,
	.page-header,
	.page-content,
	.comments-area,
	.widecolumn {
		background-color: {$colors['box_background_color']};
	}
	/* Box Background Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	input[type="file"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus,
	.sticky-post {
		color: {$colors['box_background_color']};
	}
	/* Main Text Color */
	button,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	input[type="file"],
	.pagination .prev,
	.pagination .next,
	.widget_calendar tbody a,
	.page-links a,
	.sticky-post {
		color:  {$colors['textcolor']}; 
	}
	/* Main Text Color */
    .footer-container,
	body,
	blockquote cite,
	blockquote small,
	a,
	.dropdown-toggle:after,
	.image-navigation a:hover,
	.image-navigation a:focus,
	.comment-navigation a:hover,
	.comment-navigation a:focus,
	.widget-title,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .edit-link a:hover,
	.pingback .edit-link a:focus,
	.comment-list .reply a:hover,
	.comment-list .reply a:focus,
	.site-info a:hover,
	.site-info a:focus {
	  	color: {$colors['textcolor']}; 
	}
	/* Main Text Color */
	.entry-content a,
	.entry-summary a,
	.page-content a,
	.comment-content a,
	.pingback .comment-body > a,
	.author-description a,
	.taxonomy-description a,
	.textwidget a,
	.entry-footer a:hover,
	.comment-metadata a:hover,
	.pingback .edit-link a:hover,
	.comment-list .reply a:hover,
	.site-info a:hover {
	   	border-color: {$colors['textcolor']}; 
	}
	/* Secondary Text Color */
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['secondary_textcolor']};
	}
	/* Secondary Text Color */
	blockquote,
	a:hover,
	a:focus,
	.main-navigation .menu-item-description,
	.post-navigation .meta-nav,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.image-navigation,
	.image-navigation a,
	.comment-navigation,
	.comment-navigation a,
	.widget,
	.author-heading,
	.entry-footer,
	.entry-footer a,
	.taxonomy-description,
	.page-links > .page-links-title,
	.entry-caption,
	.comment-author,
	.comment-metadata,
	.comment-metadata a,
	.pingback .edit-link,
	.pingback .edit-link a,
	.post-password-form label,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.no-comments,
	.site-info,
	.site-info a,
	.wp-caption-text,
	.gallery-caption,
	.comment-list .reply a,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		color: {$colors['secondary_textcolor']};
	}
	/* Secondary Text Color */
	blockquote,
	.logged-in-as a:hover,
	.comment-author a:hover {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['secondary_textcolor']};
	}
	/* Border Color */
	hr,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus {
		background-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}
	/* Border Color */
	pre,
	abbr[title],
	table,
	th,
	td,
	input,
	textarea,
	.main-navigation ul,
	.main-navigation li,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.comment-navigation,
	.widget li,
	.widget_categories .children,
	.widget_nav_menu .sub-menu,
	.widget_pages .children,
	.site-header,
	.site-footer,
	.hentry + .hentry,
	.author-info,
	.entry-content .page-links a,
	.page-links > span,
	.page-header,
	.comments-area,
	.comment-list + .comment-respond,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-list .reply a,
	.no-comments {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}
	/* Border Focus Color */
	a:focus,
	button:focus,
	input:focus {
		outline-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		outline-color: {$colors['border_focus_color']};
	}
	input:focus,
	textarea:focus {
		border-color: {$colors['textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_focus_color']};
	}
	/* Sidebar Link Color */
	.secondary-toggle:before {
		color: {$colors['sidebar_textcolor']};
	}
	.site-title a,
	.site-description {
		color: {$colors['sidebar_textcolor']};
	}
	/* Sidebar Text Color */
	.site-title a:hover,
	.site-title a:focus {
		color: {$colors['secondary_sidebar_textcolor']};
	}
	/* Sidebar Border Color */
	.secondary-toggle {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_color']};
	}
	/* Sidebar Border Focus Color */
	.secondary-toggle:hover,
	.secondary-toggle:focus {
		border-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['sidebar_border_focus_color']};
	}
	.site-title a {
		outline-color: {$colors['sidebar_textcolor']}; /* Fallback for IE7 and IE8 */
	}
	/* Meta Background Color */
	.entry-footer {
		background-color: {$colors['meta_box_background_color']};
	}
	@media screen and (min-width: 38.75em) {
		/* Main Text Color */
		.page-header {
			border-color: {$colors['textcolor']};
		}
	}
	@media screen and (min-width: 15em) {
		/* Make sure its transparent on desktop */
          	button,
        	input[type="button"],
        	input[type="reset"],
        	input[type="submit"],
        	input[type="file"],    
        	.pagination .prev,
        	.pagination .next,
        	.widget_calendar tbody a,
        	.page-links a,
        	.sticky-post {
        		background-color:  {$colors['header_background_color']} ;
                color: {$colors['sidebar_textcolor']};
                border: solid 0px #DAD9D9 !important; /* {$colors['sidebar_textcolor']}  */
        	}        
	        .site-header,
		    .secondary {
			background-color: transparent;
		}
		/* Sidebar Background Color */
		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			color:  {$colors['header_background_color']};
		}
		/* Sidebar Link Color */
		.secondary a,
		.dropdown-toggle:after,
		.widget-title,
		.widget blockquote cite,
		.widget blockquote small {
			color: {$colors['sidebar_textcolor']};
		}
		.widget button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a {
			background-color: {$colors['sidebar_textcolor']};
		}
		.textwidget a {
			border-color:  {$colors['sidebar_textcolor']};
		}
		/* Sidebar Text Color */
		.secondary a:hover,
		.secondary a:focus,
		.main-navigation .menu-item-description,
		.widget,
		.widget blockquote,
		.widget .wp-caption-text,
		.widget .gallery-caption {
			color: {$colors['secondary_sidebar_textcolor']};
		}
		.widget button:hover,
		.widget button:focus,
		.widget input[type="button"]:hover,
		.widget input[type="button"]:focus,
		.widget input[type="reset"]:hover,
		.widget input[type="reset"]:focus,
		.widget input[type="submit"]:hover,
		.widget input[type="submit"]:focus,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: {$colors['secondary_sidebar_textcolor']};
		}
		.widget blockquote {
			border-color: {$colors['secondary_sidebar_textcolor']};
		}
		/* Sidebar Border Color */
		.main-navigation ul,
		.main-navigation li,
		.widget input,
		.widget textarea,
		.widget table,
		.widget th,
		.widget td,
		.widget pre,
		.widget li,
		.widget_categories .children,
		.widget_nav_menu .sub-menu,
		.widget_pages .children,
		.widget abbr[title] {
			border-color: {$colors['sidebar_border_color']};
		}
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.widget hr {
			background-color: {$colors['sidebar_border_color']};
		}
		.widget input:focus,
		.widget textarea:focus {
			border-color: {$colors['sidebar_border_focus_color']};
		}
		.sidebar a:focus,
		.dropdown-toggle:focus {
			outline-color: {$colors['sidebar_border_focus_color']};
		}
 }
         .menu-main-menu-container a
        {
        	color: {$colors['menu_textcolor']};
           /*   color: {$colors['background_color']}; */
        }
        .menu-item a
        {
        	color: {$colors['menu_textcolor']};
          /*   color: {$colors['background_color']};  */
        }
     /* Bill */
    .widget-area a
    {
      color: {$colors['sidebar_textcolor']}; 
    }
CSS;
	return $css;
}

add_action( 'wp_head' , 'boatdealer_dynamic_css' );
function boatdealer_dynamic_css() {
       global $mystickyheight;
	?>
	<style type='text/css'>
     .entry-title
     { 
     <?php
     $boatdealer_entry_title = get_theme_mod('boatdealer_entry_title',1); 
     if($boatdealer_entry_title == 1)
      {
        echo 'display:block;';
      } 
      else
      {
        echo 'visibility: hidden;';
        echo 'max-height: 1px !important;'; 
        // echo 'max-height: 1px !important';
        // echo 'opacity: 0 !important; ';    
      }
      ?>    
     }
    <?php 
    $boatdealer_position = get_theme_mod('boatdealer_position',1); 
    $boatdealer_layout_type = get_theme_mod('boatdealer_layout_type',2); 

    if($boatdealer_layout_type == 1) { ?>
        #wrapper
        	{ 
            	 max-width:1000px !important;
             }  
        .sidebar{
                max-width: 240px !important;
            }
        .site-content {
    		display: block;
    		float: left;
    		margin-left: 25.4118%;
    		width: 74.5882%;
    	}
    <?php } 
    else { ?>
         #wrapper
        	{ 
            	 max-width:100% !important;
             }  
         .sidebar{
                max-width: 400px !important
            }
         .site-content {
    		display: block;
    		float: left;
      margin-left: 25.4118%; 
    		width: 74.5882%;
            padding-right: 15px; 
    	} 
        
        
        
    <?php   }
             
      if($boatdealer_position == 1)
        { ?>
         
         .site-content {
            /* float: right; */
            }   
            .sidebar {
            float: left;
            z-index: 1;
            }  
            
        <?php }   
        else
        { ?>
        
           .site-content {
              float: left;
              margin-left: 1em ;
              margin-right: 25.4118%;
              padding-right: 20px !important;
            } 
            
              
         
            
            .sidebar {
              float: right;
              margin-right:  0px;
              margin-left: -100%;
              right: 0px;
              z-index: 1;
            }        
        
    <?php } ?>
    @media screen and (max-width: 65em) {    
                  .sidebar{
                     max-width: 100% !important;
            }
         }
    <?php  
    $mycopyrightbackground = get_theme_mod('boatdealer_copyright_background','#ffffff');
    $mycopyrightcolor = get_theme_mod('boatdealer_copyright_color','#7a7a7a');
    ?>
    .site-info,
    .site-info a {
        color: <?php echo esc_html($mycopyrightcolor);?> !important;
        background: <?php echo esc_html($mycopyrightbackground);?> !important;
    }
     #boatdealer_navbar {
           <?php 
              $mymenubackground = get_theme_mod('boatdealer_navigation_background', '#e65e23');  
	           if(! empty ($mymenubackground))
       	         echo 'background:'. esc_html($mymenubackground).'!important;';
            ?> 
     }
    <?php $mymenucolor = get_theme_mod('boatdealer_menu_color','white');?> 
	.primary-navigation a {
    <?php
           if(! empty ($mymenucolor))
           {
       	       echo 'color:'. esc_html($mymenucolor).'!important;';
               echo 'border-bottom-color:'.esc_html($mymenucolor).'!important;';
           }
    ?>
   } 
    <?php $mymenuhovercolor = get_theme_mod('boatdealer_menu_hover_color','yellow');?> 
	.primary-navigation a:hover {
    <?php
           if(! empty ($mymenucolor))
           {
       	       echo 'color:'. esc_html($mymenuhovercolor).'!important;';
           }
    ?>
   }  
    <?php 
    $mysubmenubackground = get_theme_mod('boatdealer_menu_background', '#e65e23');
    $boatdealer_sub_menu_text_color = get_theme_mod('boatdealer_sub_menu_text_color', 'white');
    ?> 
	.primary-navigation ul ul,
	.primary-navigation li li {
          <?php
	           if(! empty ($mysubmenubackground))
       	         echo 'background:'. esc_html($mysubmenubackground).'!important;';
            ?> 
}
     <?php
      ?> 
	       .primary-navigation ul ul a {
           <?php 
                 if(! empty ($boatdealer_sub_menu_text_color))
               {
           	       echo 'color:'. esc_html($boatdealer_sub_menu_text_color).'!important;';
                   echo 'border-bottom-color:'.esc_html($boatdealer_sub_menu_text_color).'!important;';
               }
             ?>     
          /*  color: red !important; */
      }
      <?php
     $mysubmenuhoverbackground = get_theme_mod('boatdealer_submenu_hover_background', 'white');
     $mysubmenuhovercolor = get_theme_mod('boatdealer_submenu_hover_color', '#e65e23');    
     ?> 
	.primary-navigation ul ul a:hover,
	.primary-navigation ul ul li.focus > a {
          <?php
	           if(! empty ($mysubmenuhoverbackground))
       	         echo 'background:'. esc_html($mysubmenuhoverbackground).'!important;';
          	   if(! empty ($mysubmenuhovercolor))
       	         echo 'color:'. esc_html($mysubmenuhovercolor).'!important;';       
            ?> 
} 
	.primary-navigation {
           <?php $mymenufontsize = get_theme_mod('menu_font_size',14); ?> 
		    font-size: <?php echo esc_html($mymenufontsize); ?>px !important;
        <?php $boatdealer_menu_margin_top = esc_html(get_theme_mod('boatdealer_menu_margin_top',0)); ?> 
        margin-top: <?php echo esc_html($boatdealer_menu_margin_top);?>px !important;
	}
    .sticky {
        <?php
         if($boatdealer_layout_type == 1)
           {
              echo 'max-width:1000px !important;';
           }
         ?>
        }
     <?php $boatdealer_search_icon = get_theme_mod('boatdealer_search_icon','Gray');?> 
     .search-submit{
            <?php
                 $theme_url = get_template_directory_uri ();
       	         if($boatdealer_search_icon == 'White') 
                     echo 'background: url('. $theme_url .'/images/magnifier_white.png) no-repeat transparent !important;';
                 elseif($boatdealer_search_icon == 'Gray')     
                     echo 'background: url('.$theme_url.'/images/magnifier_gray.png) no-repeat transparent !important;';
                 else
                     echo 'background: none !important;';
            ?>
	}
 #boatdealer_navbar {
  width: 100%;
  max-width: 100% !important; 
}
.search-submit 
   {
       margin-top: 10px; 
   }  
        #boatdealer_search_tool{
        <?php if( get_theme_mod('boatdealer_search_icon') == 'Hidden')
               echo 'display: none !important;'; 
        ?>
    } 
 <?php 
	$color_scheme = boatdealer_get_color_scheme();
    $header_background_color = get_theme_mod('header_background_color', '#00608E');
    if(empty($header_background_color))
      $header_background_color = '#00608E';
    $background_color = trim(get_theme_mod('background_color','#00608e'));
    $boatdealer_opacity = get_theme_mod('boatdealer_opacity',10)/10;
    if($boatdealer_opacity < 0.6 or $boatdealer_opacity > 1)
      $boatdealer_opacity = 1;
    $boat_logo_height = get_theme_mod('boat_logo_height',200); 
    $boatdealer_logo_margin_top = get_theme_mod('boat_logo_margin_top',0); 
    $boatdealer_total = $boat_logo_height + $boatdealer_logo_margin_top; 
    $menu_textcolor = get_theme_mod('menu_textcolor','#ffffff');
 //   $sidebar_textcolor = get_theme_mod('sidebar_textcolor', '#ffffff');
 ?>           
    #wrapper
      {
          background: #<?php echo $background_color; ?> !important; 
          opacity: <?php echo esc_html($boatdealer_opacity);?> !important; 
	  }
    .sidebar,
    #sidebar{
        background:  <?php echo $header_background_color; ?> !important; 
    }
    /* Bill   */
    <?php if(empty($sidebar_textcolor))
      $sidebar_textcolor = '#ffffff';
    ?>
    .widget-area a
    {
      color: <?php echo $sidebar_textcolor;?>;     
    }
    @media screen and (max-width: 65em) {
                     .main-navigation
                  .sidebar{
                      max-width: 100% !important
                   }
              .entry-content
            {
              <?php   if($boatdealer_entry_title != 1)
              {
                /* echo 'margin-top: 300px;'; */
              } ?>   
           } 
        }
    <?php 
     $boatdealer_menus_enabled = get_theme_mod('boatdealer_menus_enabled','1');
    /* 
    '1' => 'Only boat Left Menu',
	'2' => 'Only Horizontal Top Menu',
    */
     if($boatdealer_menus_enabled == '1'  ){
       ?>
            #boatdealer_navbar{
              display: none !important;
            }  
           .main-navigation{
            display: block; /* Bill 2017 tirei importante */
            }
            @media screen and (max-width: 65em) {
            .dropdown-toggle {
               display: none !important;
            }
         }
      <?php 
     }
        elseif($boatdealer_menus_enabled == '2' ) {
     ?>           
        #boatdealer_navbar{
          display: block !important;
        } 
        .main-navigation {
          display: none !important;
        }
        /* Bill 2018 added .main-navigation */
       	 @media screen and (max-width: 65em) {
              #boatdealer_navbar, .main-navigation{
                      display: hidden !important;
                      } 
     <?php  } ?>
            #boatdealer_search_icon  input[type="button"]
            .slicknav_btn
            .slicknav_menu .slicknav_icon 
            {
                background-color:transparent !important;
                border: 0px !important;
            }
            <?php
            global $woocommerce;
            if( isset($woocommerce))
               { ?>
               @media screen and (max-width: 1000px) {
                    #primary
                    {
                        margin-top: 1em !important;
                    } 
              }
              <?php } ?>
        .custom-logo{
          height: <?php echo $boat_logo_height;?>px !important;
          min-height: <?php echo $boat_logo_height;?>px !important;
          margin-top: <?php echo $boatdealer_logo_margin_top;?>px !important;
        }
<?php 
 $boat_icon_color = trim(get_theme_mod('boatdealer_topinfo_color','gray'));
 $boat_topinfo_color = boat_sanitizehtml($boat_icon_color);
 $boat_topinfo_email = trim(get_theme_mod('boatdealer_topinfo_email',''));
 $boat_topinfo_phone = trim(get_theme_mod('boatdealer_topinfo_phone',''));
 $boat_topinfo_hours = trim(get_theme_mod('boatdealer_topinfo_hours',''));
if( empty($boat_topinfo_email) and empty($boat_topinfo_phone) and empty($boat_topinfo_hours))
  { ?>
    #header_top_left 
       {
        display: none;  
       }
  <?php  
  }
  else
  {?>
        #primary
        {
            margin-top: 40px !important ;
        }    
 <?php } 
  if ( empty($boat_topinfo_email))
  { ?>
         #boatdealer_iconemail
         {
           display: none !important; 
         }
  <?php }
  if ( empty($boat_topinfo_phone))
  { ?>
         #boatdealer_iconphone
         {
           display: none !important; 
         }
  <?php }
  if ( empty($boat_topinfo_hours))
  { ?>
         #boatdealer_iconhours
         {
           display: none !important; 
         }
  <?php } ?>
   #header_top_left 
   {
    color: <?php echo $boat_topinfo_color; ?> !important;   
   }
     <?php $boatdealer_search_icon = get_theme_mod('boatdealer_search_icon','Gray');?> 
     .search-submit{
            <?php
                 $theme_url = get_template_directory_uri ();
       	         if($boatdealer_search_icon == 'White') 
                     echo 'background: url('. $theme_url .'/images/magnifier_white.png) no-repeat transparent !important;';
                 elseif($boatdealer_search_icon == 'Gray')     
                     echo 'background: url('.$theme_url.'/images/magnifier_gray.png) no-repeat transparent !important;';
                 else
                     echo 'background: none !important;';
            ?>
	}
   <?php
     $boatdealer_mobile_background = get_theme_mod('boatdealer_mobile_background','#555555');      
     $boatdealer_mobile_name_color = get_theme_mod('boatdealer_mobile_name_color','#555555');      
     $boatdealer_mobile_color = get_theme_mod('boatdealer_mobile_color','#ffffff');      
     $boatdealer_mobile_separator = get_theme_mod('boatdealer_mobile_separator','#333333');      
     $boatdealer_mobile_icon = get_theme_mod('boatdealer_mobile_icon','#ffffff'); 
?> 
.menu-main-menu-container a,
.menu-item a
{
	color: <?php  echo $menu_textcolor;?>;
}
 .slicknav_menu
{
	background: <?php echo $boatdealer_mobile_background;?>;
	padding: 0;
}  
.slicknav_menu  .slicknav_menutxt {
    color: <?php echo $boatdealer_mobile_name_color;?>;
    font-weight: bold;
    text-shadow: 0 1px 3px #000; 
    } 
.slicknav_menu .slicknav_icon-bar
{
	background-color: <?php echo $boatdealer_mobile_icon;?>;
}                    
.slicknav_nav LI
{
	border-top: 1px solid <?php echo $boatdealer_mobile_separator;?>;
}
.slicknav_nav A
{
	background: none;
	color: <?php echo $boatdealer_mobile_color;?>;
}
.slicknav_nav A:hover
{
    opacity: .7; 
}
.slicknav_nav A:hover
{
	background: none;
	color: <?php echo $boatdealer_mobile_color;?>;
    opacity: .7;
}
/*
.widget-area a{
    color: white;
}
*/
<?php
global $woocommerce;
if (! isset($woocommerce)) { ?>
  #header_top_left
  {
	width: 76% !important;
  }
  #header_top_right
  {
	width: 20% !important;
  } 
    #primary,
    .content-area
    {
        margin-top: -10px;
    }
<?php
}
else
{ ?>
 #header_top_left
    {
    	width: 70% !important;
    }
     #header_top_right
    {
    	width: 25% !important;
    }
    
<?php }
 
 
 $boatdealer_show_sidebar = get_theme_mod('boatdealer_show_sidebar','1'); 

if($boatdealer_show_sidebar == '1')
{
    echo '.secondary {';
    echo 'display: block;';
    echo '}';
}
 
$boatdealer_blog_post_meta = trim(get_theme_mod('boatdealer_blog_post_meta','1'));
$boatdealer_blog_post_meta = esc_attr($boatdealer_blog_post_meta);
$boatdealer_blog_post_categories = trim(get_theme_mod('boatdealer_blog_post_categories','1'));
$boatdealer_blog_post_categories = esc_attr($boatdealer_blog_post_categories);
$boatdealer_blog_post_date = trim(get_theme_mod('boatdealer_blog_post_date','1'));
$boatdealer_blog_post_date = esc_attr($boatdealer_blog_post_date);
$boatdealer_blog_post_author = trim(get_theme_mod('boatdealer_blog_post_author','1'));
$boatdealer_blog_post_author = esc_attr($boatdealer_blog_post_author);
if($boatdealer_blog_post_meta != '1')
{
       echo '.entry-content {
             width: 100% !important;
             }';
       echo '.entry-footer {
             display:none !important;
             }';
}
// author
if($boatdealer_blog_post_categories != '1')
{
       echo '.cat-links {
             display:none !important;
             }';
}
if($boatdealer_blog_post_date != '1')
{
       echo '.posted-on {
             display:none !important;
             }';
}
if($boatdealer_blog_post_author <> '1')
{
        echo '.author, .byline {
             display: none;
             }';   
}

?>
 
 
</style>
<?php /* end style */
}
/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 * @since boatdealer 1.0
 */
function boatdealer_color_scheme_css_template() {
	$colors = array(
		'background_color'            => '{{ data.background_color }}',
		'header_background_color'     => '{{ data.header_background_color }}',
		'box_background_color'        => '{{ data.box_background_color }}',
		'textcolor'                   => '{{ data.textcolor }}',
		'secondary_textcolor'         => '{{ data.secondary_textcolor }}',
		'border_color'                => '{{ data.border_color }}',
		'border_focus_color'          => '{{ data.border_focus_color }}',
		'sidebar_textcolor'           => '{{ data.sidebar_textcolor }}',
		'sidebar_border_color'        => '{{ data.sidebar_border_color }}',
		'sidebar_border_focus_color'  => '{{ data.sidebar_border_focus_color }}',
		'secondary_sidebar_textcolor' => '{{ data.secondary_sidebar_textcolor }}',
		'meta_box_background_color'   => '{{ data.meta_box_background_color }}',
		'menu_textcolor'              => '{{ data.menu_textcolor }}',    
	);
	?>
	<script type="text/html" id="tmpl-boatdealer-color-scheme">
		<?php echo boatdealer_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'boatdealer_color_scheme_css_template' );