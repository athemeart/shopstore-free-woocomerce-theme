<?php 

/**
 * Theme Options Panel.
 *
 * @package shopstore
 */

$default = shopstore_get_default_theme_options();




// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'shopstore' ),
		'priority'   => 20,
		'capability' => 'edit_theme_options',
	)
);

// Styling Options.*/

$wp_customize->add_section( 'styling_section_settings',
	array(
		'title'      => esc_html__( 'Styling Options', 'shopstore' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);


// Primary Color.
$wp_customize->add_setting( 'primary_color',
	array(
	'default'           => $default['primary_color'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'primary_color',
	array(
	'label'    	   => esc_html__( 'Primary Color Scheme:', 'shopstore' ),
	'section'  	   => 'styling_section_settings',
	'description'  => esc_html__( 'The theme comes with unlimited color schemes for your theme\'s styling. upgrade pro for color options & features', 'shopstore' ),
	'type'     => 'color',
	'priority' => 120,
	)
);


// Global Section Start.*/

$wp_customize->add_section( 'social_option_section_settings',
	array(
		'title'      => esc_html__( 'Footer Social Link', 'shopstore' ),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		/*
		Social media
		*/
		$shopstore_options['social']['fa-facebook']= array(
			'label' => esc_html__('Facebook URL', 'shopstore')
		);
		$shopstore_options['social']['fa-twitter']= array(
			'label' => esc_html__('Twitter URL', 'shopstore')
		);
		$shopstore_options['social']['fa-pinterest']= array(
			'label' => esc_html__('Pinterest URL', 'shopstore')
		);
		$shopstore_options['social']['fa-youtube']= array(
			'label' => esc_html__('Youtube URL', 'shopstore')
		);
		$shopstore_options['social']['fa-instagram']= array(
			'label' => esc_html__('Instagram URL', 'shopstore')
		);
		
		foreach( $shopstore_options as $key => $options ):
			foreach( $options as $k => $val ):
				// SETTINGS
				if ( isset( $key ) && isset( $k ) ){
					$wp_customize->add_setting('shopstore_social_profile_link['.$key .']['. $k .']',
						array(
							'default'           => esc_url( $default['social_profile_link'] ),
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'esc_url_raw'
						)
					);
					// CONTROLS
					$wp_customize->add_control('shopstore_social_profile_link['.$key .']['. $k .']', 
						array(
							'label'		 => esc_attr( $val['label'] ), 
							'section'    => 'social_option_section_settings',
							'type'       => 'url',
							
						)
					);
				}
			
			endforeach;
		endforeach;


/*Posts management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Blog Management', 'shopstore' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

		
		
		/*content excerpt in global*/
		$wp_customize->add_setting( 'excerpt_length_blog',
			array(
				'default'           => $default['excerpt_length_blog'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'shopstore_sanitize_positive_integer',
			)
		);
		$wp_customize->add_control( 'excerpt_length_blog',
			array(
				'label'    => esc_html__( 'Set Blog Excerpt Length', 'shopstore' ),
				'section'  => 'theme_option_section_settings',
				'type'     => 'number',
				'priority' => 175,
				'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),
		
			)
		);
		
		/*Blog Loop Content*/
		$wp_customize->add_setting( 'blog_loop_content_type',
			array(
				'default'           => $default['blog_loop_content_type'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'shopstore_sanitize_select',
			)
		);
		$wp_customize->add_control( 'blog_loop_content_type',
			array(
				'label'    => esc_html__( 'Blog Looop Content', 'shopstore' ),
				'section'  => 'theme_option_section_settings',
				'choices'               => array(
					'excerpt-only' => __( 'Excerpt Only', 'shopstore' ),
					'full-post' => __( 'Full Post', 'shopstore' ),
					),
				'type'     => 'select',
				'priority' => 180,
			)
		);
		
		
/*Posts management section start */
$wp_customize->add_section( 'page_option_section_settings',
	array(
		'title'      => esc_html__( 'Page Management', 'shopstore' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Footer Section.
$wp_customize->add_section( 'top_bar_right',
	array(
	'title'      => esc_html__( 'Top Bar Address', 'shopstore' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'location',
	array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'location',
	array(
	'label'    => esc_html__( 'Location:', 'shopstore' ),
	'section'  => 'top_bar_right',
	'type'     => 'text',
	'priority' => 120,
	)
);
$wp_customize->add_setting( 'email',
	array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'email',
	array(
	'label'    => esc_html__( 'email', 'shopstore' ),
	'section'  => 'top_bar_right',
	'type'     => 'text',
	'priority' => 120,
	)
);

$wp_customize->add_setting( 'phone',
	array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'phone',
	array(
	'label'    => esc_html__( 'Phone', 'shopstore' ),
	'section'  => 'top_bar_right',
	'type'     => 'text',
	'priority' => 120,
	)
);






