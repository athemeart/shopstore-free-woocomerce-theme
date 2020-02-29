<?php
/**
 * Default theme options.
 *
 * @package shopstore
 */

if ( ! function_exists( 'shopstore_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function shopstore_get_default_theme_options() {

		$defaults = array();
		
		/*Global Layout*/
		
		$defaults['social_profile_link']     		= '';
		$defaults['primary_color']     				= esc_attr( '#37BF91' );
		
		
		$defaults['excerpt_length_blog']     		= 60;
		$defaults['blog_loop_content_type']     	= 'excerpt-only';
		
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'shopstore' );
		
		// Pass through filter.
		$defaults = apply_filters( 'shopstore_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
