<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shopstore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#primary">
<?php esc_html_e( 'Skip to content', 'shopstore' ); ?>
</a>
<div class="boxed">


<section id="header" class="header">
    
	<?php
    /**
    * Hook - shopstore_header_top 		- 10
	* Hook - shopstore_header_middle 	- 20.
	* Hook - shopstore_header_bottom 	- 30.
    *
    * @hooked shopstore_header_container
    */
    do_action( 'shopstore_header_container' );
    ?> 
    
</section>