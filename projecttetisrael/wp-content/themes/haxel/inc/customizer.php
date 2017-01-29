<?php
/**
 * haxel Theme Customizer
 *
 * @package haxel
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function haxel_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'haxel' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'haxel_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'haxel_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'haxel_logo_resize',
	        array(
	            'label' => __('Resize & Adjust Logo','haxel'),
	            'section' => 'title_tagline',
	            'settings' => 'haxel_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'haxel_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function haxel_logo_enabled($control) {
		$option = $control->manager->get_setting('custom_logo');
		return $option->value() == true;
	}
	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override haxel_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('haxel_site_titlecolor', array(
	    'default'     => '#FFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'haxel_site_titlecolor', array(
			'label' => __('Site Title Color','haxel'),
			'section' => 'colors',
			'settings' => 'haxel_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('haxel_header_desccolor', array(
	    'default'     => '#FFF',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'haxel_header_desccolor', array(
			'label' => __('Site Tagline Color','haxel'),
			'section' => 'colors',
			'settings' => 'haxel_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Settings for Nav Area
	$wp_customize->add_section(
	    'haxel_menu_basic',
	    array(
	        'title'     => __('Menu Settings','haxel'),
	        'priority'  => 0,
	        'panel'     => 'nav_menus'
	    )
	);
	
	$wp_customize->add_setting( 'haxel_disable_nav_desc' , array(
	    'default'     => true,
	    'sanitize_callback' => 'haxel_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(
	'haxel_disable_nav_desc', array(
		'label' => __('Disable Description of Menu Items','haxel'),
		'section' => 'haxel_menu_basic',
		'settings' => 'haxel_disable_nav_desc',
		'type' => 'checkbox'
	) );
	
	$wp_customize->add_setting( 'haxel_disable_active_nav' , array(
	    'default'     => true,
	    'sanitize_callback' => 'haxel_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(
	'haxel_disable_active_nav', array(
		'label' => __('Disable Highlighting of Current Active Item on the Menu.','haxel'),
		'section' => 'nav',
		'settings' => 'haxel_disable_active_nav',
		'type' => 'checkbox'
	) );
		
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'haxel_hide_title_tagline',
		array( 'sanitize_callback' => 'haxel_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'haxel_hide_title_tagline', array(
		    'settings' => 'haxel_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'haxel' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'haxel_branding_below_logo',
		array( 'sanitize_callback' => 'haxel_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'haxel_branding_below_logo', array(
		    'settings' => 'haxel_branding_below_logo',
		    'label'    => __( 'Display Site Title and Tagline Below the Logo.', 'haxel' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		    'active_callback' => 'haxel_title_visible'
		)
	);
	
	function haxel_title_visible( $control ) {
		$option = $control->manager->get_setting('haxel_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	
	// SLIDER PANEL
	$wp_customize->add_panel( 'haxel_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Main Slider','haxel'),
	) );
	
	$wp_customize->add_section(
	    'haxel_sec_slider_options',
	    array(
	        'title'     => __('Enable/Disable','haxel'),
	        'priority'  => 0,
	        'panel'     => 'haxel_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'haxel_main_slider_enable',
		array( 'sanitize_callback' => 'haxel_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'haxel_main_slider_enable', array(
		    'settings' => 'haxel_main_slider_enable',
		    'label'    => __( 'Enable Slider.', 'haxel' ),
		    'section'  => 'haxel_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'haxel_main_slider_count',
			array(
				'default' => '0',
				'sanitize_callback' => 'haxel_sanitize_positive_number'
			)
	);
	
	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_control(
			'haxel_main_slider_count', array(
		    'settings' => 'haxel_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 3)' ,'haxel'),
		    'section'  => 'haxel_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Save the Settings, and Reload this page to Configure the Slides.','haxel'),
		    
		)
	);
	
	

	$wp_customize->add_section(
	    'haxel_sec_upgrade',
	    array(
	        'title'     => __('Haxel - Help & Support','haxel'),
	        'priority'  => 10,
	    )
	);
	
	$wp_customize->add_setting(
			'haxel_upgrade',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'haxel_upgrade',
	        array(
	            'label' => __('Thanks for Downloading.','haxel'),
	            'description' => __('Thank you for Downloading Haxel Theme. We hope you are enjoying it. To see how this theme would look like after complete set up, check out its <a target="_blank" href="http://demo.inkhive.com/haxel/">demo blog</a>. Visit <a href="http://inkhive.com" target="_blank"> for any help','haxel'),
	            'section' => 'haxel_sec_upgrade',
	            'settings' => 'haxel_upgrade',			       
	        )
		)
	);
	
	$wp_customize->add_section(
	    'haxel_sec_upgrade_pro',
	    array(
	        'title'     => __('Discover Haxel Plus','haxel'),
	        'priority'  => 10,
	    )
	);
	
	$wp_customize->add_setting(
			'haxel_upgrade_pro',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'haxel_upgrade_pro',
	        array(
	            'label' => __('Want More Control & Features?','haxel'),
	            'description' => __('Haxel Plus is the Powerful Version of Haxel, with Multiple Header Layouts, Unlimited Colors and fonts, Custom Widgets, Multiple Footer Columns, Custom Skin Designer, More Showcases and Featured Areas, etc. <a target="_blank" href="https://inkhive.com/product/haxel-plus/">More Details</a>.','haxel'),
	            'section' => 'haxel_sec_upgrade_pro',
	            'settings' => 'haxel_upgrade_pro',			       
	        )
		)
	);

		
	
		$slides = get_theme_mod('haxel_main_slider_count');
		
		for ( $i = 1 ; $i <= 3 ; $i++ ) :
			
			//Create the settings Once, and Loop through it.
			
			$wp_customize->add_setting(
				'haxel_slide_img'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
			    new WP_Customize_Image_Control(
			        $wp_customize,
			        'haxel_slide_img'.$i,
			        array(
			            'label' => '',
			            'section' => 'haxel_slide_sec'.$i,
			            'settings' => 'haxel_slide_img'.$i,			       
			        )
				)
			);
			
			
			$wp_customize->add_section(
			    'haxel_slide_sec'.$i,
			    array(
			        'title'     => __('Slide ','haxel').$i,
			        'priority'  => $i,
			        'panel'     => 'haxel_slider_panel'
			    )
			);
			
			$wp_customize->add_setting(
				'haxel_slide_title'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'haxel_slide_title'.$i, array(
				    'settings' => 'haxel_slide_title'.$i,
				    'label'    => __( 'Slide Title','haxel' ),
				    'section'  => 'haxel_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'haxel_slide_desc'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'haxel_slide_desc'.$i, array(
				    'settings' => 'haxel_slide_desc'.$i,
				    'label'    => __( 'Slide Description','haxel' ),
				    'section'  => 'haxel_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			
			
			$wp_customize->add_setting(
				'haxel_slide_CTA_button'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'haxel_slide_CTA_button'.$i, array(
				    'settings' => 'haxel_slide_CTA_button'.$i,
				    'label'    => __( 'Custom Call to Action Button Text(Optional)','haxel' ),
				    'section'  => 'haxel_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'haxel_slide_url'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
					'haxel_slide_url'.$i, array(
				    'settings' => 'haxel_slide_url'.$i,
				    'label'    => __( 'Target URL','haxel' ),
				    'section'  => 'haxel_slide_sec'.$i,
				    'type'     => 'url',
				)
			);
			
		endfor;
	
	//CUSTOM SHOWCASE
	$wp_customize->add_panel( 'haxel_showcase_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Custom Showcase','haxel'),
	) );
	
	$wp_customize->add_section(
	    'haxel_sec_showcase_options',
	    array(
	        'title'     => __('Enable/Disable','haxel'),
	        'priority'  => 0,
	        'panel'     => 'haxel_showcase_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'haxel_showcase_enable',
		array( 'sanitize_callback' => 'haxel_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'haxel_showcase_enable', array(
		    'settings' => 'haxel_showcase_enable',
		    'label'    => __( 'Enable Showcase on Front Page.', 'haxel' ),
		    'section'  => 'haxel_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'haxel_showcase_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'haxel_showcase_title', array(
		    'settings' => 'haxel_showcase_title',
		    'label'    => __( 'Title','haxel' ),
		    'section'  => 'haxel_sec_showcase_options',
		    'type'     => 'text',
		)
	);
	
	for ( $i = 1 ; $i <= 3 ; $i++ ) :
		
		//Create the settings Once, and Loop through it.
		$wp_customize->add_section(
		    'haxel_showcase_sec'.$i,
		    array(
		        'title'     => __('ShowCase ','haxel').$i,
		        'priority'  => $i,
		        'panel'     => 'haxel_showcase_panel',
		        
		    )
		);	
		
		$wp_customize->add_setting(
			'haxel_showcase_img'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
		    new WP_Customize_Image_Control(
		        $wp_customize,
		        'haxel_showcase_img'.$i,
		        array(
		            'label' => '',
		            'section' => 'haxel_showcase_sec'.$i,
		            'settings' => 'haxel_showcase_img'.$i,			       
		        )
			)
		);
		
		$wp_customize->add_setting(
			'haxel_showcase_title'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'haxel_showcase_title'.$i, array(
			    'settings' => 'haxel_showcase_title'.$i,
			    'label'    => __( 'Showcase Title','haxel' ),
			    'section'  => 'haxel_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		$wp_customize->add_setting(
			'haxel_showcase_desc'.$i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);
		
		$wp_customize->add_control(
				'haxel_showcase_desc'.$i, array(
			    'settings' => 'haxel_showcase_desc'.$i,
			    'label'    => __( 'Showcase Description','haxel' ),
			    'section'  => 'haxel_showcase_sec'.$i,
			    'type'     => 'text',
			)
		);
		
		
		$wp_customize->add_setting(
			'haxel_showcase_url'.$i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);
		
		$wp_customize->add_control(
				'haxel_showcase_url'.$i, array(
			    'settings' => 'haxel_showcase_url'.$i,
			    'label'    => __( 'Target URL','haxel' ),
			    'section'  => 'haxel_showcase_sec'.$i,
			    'type'     => 'url',
			)
		);
		
	endfor;
	
	//FEATURED POSTS
	
	$wp_customize->add_section(
	    'haxel_featposts',
	    array(
	        'title'     => __('Featured Posts','haxel'),
	        'priority'  => 35,
	    )
	);
	
	$wp_customize->add_setting(
		'haxel_featposts_enable',
		array( 'sanitize_callback' => 'haxel_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'haxel_featposts_enable', array(
		    'settings' => 'haxel_featposts_enable',
		    'label'    => __( 'Enable', 'haxel' ),
		    'section'  => 'haxel_featposts',
		    'type'     => 'checkbox',
		)
	);
	
	
	$wp_customize->add_setting(
		'haxel_featposts_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'haxel_featposts_title', array(
		    'settings' => 'haxel_featposts_title',
		    'label'    => __( 'Title', 'haxel' ),
		    'section'  => 'haxel_featposts',
		    'type'     => 'text',
		)
	);
	
	
	
	$wp_customize->add_setting(
		    'haxel_featposts_cat',
		    array( 'sanitize_callback' => 'haxel_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new Haxel_WP_Customize_Category_Control(
	        $wp_customize,
	        'haxel_featposts_cat',
	        array(
	            'label'    => __('Category For Featured Posts','haxel'),
	            'settings' => 'haxel_featposts_cat',
	            'section'  => 'haxel_featposts'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'haxel_featposts_rows',
		array( 'sanitize_callback' => 'haxel_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'haxel_featposts_rows', array(
		    'settings' => 'haxel_featposts_rows',
		    'label'    => __( 'Max No. of Rows.', 'haxel' ),
		    'section'  => 'haxel_featposts',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
		
	// Layout and Design
	$wp_customize->add_panel( 'haxel_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','haxel'),
	) );
	
	$wp_customize->add_section(
	    'haxel_design_options',
	    array(
	        'title'     => __('Blog Layout','haxel'),
	        'priority'  => 0,
	        'panel'     => 'haxel_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'haxel_blog_layout',
		array( 'sanitize_callback' => 'haxel_sanitize_blog_layout' )
	);
	
	function haxel_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','grid_3_column','haxel') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'haxel_blog_layout',array(
				'label' => __('Select Layout','haxel'),
				'settings' => 'haxel_blog_layout',
				'section'  => 'haxel_design_options',
				'type' => 'select',
				'choices' => array(
						'haxel' => __('Haxel Theme Layout','haxel'),
						'grid' => __('Basic Blog Layout','haxel'),
						'grid_2_column' => __('Grid - 2 Column','haxel'),
						'grid_3_column' => __('Grid - 3 Column','haxel'),
						
					)
			)
	);
	
	$wp_customize->add_section(
	    'haxel_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','haxel'),
	        'priority'  => 0,
	        'panel'     => 'haxel_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'haxel_disable_sidebar',
		array( 'sanitize_callback' => 'haxel_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'haxel_disable_sidebar', array(
		    'settings' => 'haxel_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','haxel' ),
		    'section'  => 'haxel_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'haxel_disable_sidebar_home',
		array( 'sanitize_callback' => 'haxel_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'haxel_disable_sidebar_home', array(
		    'settings' => 'haxel_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','haxel' ),
		    'section'  => 'haxel_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'haxel_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'haxel_disable_sidebar_front',
		array( 'sanitize_callback' => 'haxel_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'haxel_disable_sidebar_front', array(
		    'settings' => 'haxel_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','haxel' ),
		    'section'  => 'haxel_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'haxel_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'haxel_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'haxel_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'haxel_sidebar_width', array(
		    'settings' => 'haxel_sidebar_width',
		    'label'    => __( 'Sidebar Width','haxel' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','haxel'),
		    'section'  => 'haxel_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'haxel_show_sidebar_options',
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
	function haxel_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('haxel_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	class Haxel_Custom_CSS_Control extends WP_Customize_Control {
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
    'haxel_custom_codes',
    array(
    	'title'			=> __('Custom CSS','haxel'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','haxel'),
    	'priority'		=> 11,
    	'panel'			=> 'haxel_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'haxel_custom_css',
	array(
		'default'		=> '',
		'sanitize_callback'    => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		)
	);
	
	$wp_customize->add_control(
	    new Haxel_Custom_CSS_Control(
	        $wp_customize,
	        'haxel_custom_css',
	        array(
	            'section' => 'haxel_custom_codes',
	            'settings' => 'haxel_custom_css'
	        )
	    )
	);
	
	function haxel_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'haxel_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','haxel'),
    	'description'	=> __('Enter your Own Copyright Text.','haxel'),
    	'priority'		=> 11,
    	'panel'			=> 'haxel_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'haxel_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'haxel_footer_text',
	        array(
	            'section' => 'haxel_custom_footer',
	            'settings' => 'haxel_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_section(
	    'haxel_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','haxel'),
	        'priority'  => 41,
	    )
	);
	
	$font_array = array('Ubuntu','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'haxel_title_font',
		array(
			'default'=> 'Ubuntu',
			'sanitize_callback' => 'haxel_sanitize_gfont' 
			)
	);
	
	function haxel_sanitize_gfont( $input ) {
		if ( in_array($input, array('Ubuntu','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'haxel_title_font',array(
				'label' => __('Title','haxel'),
				'settings' => 'haxel_title_font',
				'section'  => 'haxel_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'haxel_body_font',
			array(	'default'=> 'Ubuntu',
					'sanitize_callback' => 'haxel_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'haxel_body_font',array(
				'label' => __('Body','haxel'),
				'settings' => 'haxel_body_font',
				'section'  => 'haxel_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('haxel_social_section', array(
			'title' => __('Social Icons','haxel'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','haxel'),
					'facebook' => __('Facebook','haxel'),
					'twitter' => __('Twitter','haxel'),
					'google-plus' => __('Google Plus','haxel'),
					'instagram' => __('Instagram','haxel'),
					'rss' => __('RSS Feeds','haxel'),
					'vine' => __('Vine','haxel'),
					'vimeo-square' => __('Vimeo','haxel'),
					'youtube' => __('Youtube','haxel'),
					'flickr' => __('Flickr','haxel'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'haxel_social_'.$x, array(
				'sanitize_callback' => 'haxel_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'haxel_social_'.$x, array(
					'settings' => 'haxel_social_'.$x,
					'label' => __('Icon ','haxel').$x,
					'section' => 'haxel_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'haxel_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'haxel_social_url'.$x, array(
					'settings' => 'haxel_social_url'.$x,
					'description' => __('Icon ','haxel').$x.__(' Url','haxel'),
					'section' => 'haxel_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function haxel_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function haxel_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function haxel_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function haxel_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'haxel_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function haxel_customize_preview_js() {
	wp_enqueue_script( 'haxel_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'haxel_customize_preview_js' );
