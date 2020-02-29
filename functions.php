<?php
/**
 * Implement the Core.
 */
require get_template_directory() . '/inc/theme-core.php';

/**
* Implement Theme Layout.
*/
require get_template_directory() . '/inc/posts-hooks.php';

/**
* Implement Theme Layout.
*/
require get_template_directory() . '/inc/theme-layout.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';



/**
 * Implement the Custom woocommerce feature.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
/**
* Implement pro features.
*/
require get_template_directory() . '/inc/pro/admin-page.php';

/**
* Implement pro features.
*/
require get_template_directory() . '/inc/customizer/customizer.php';

/**
* Implement Recommed plugins.
*/
require_once get_template_directory() . '/inc/tgm/plugins.php';