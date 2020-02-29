<?php
/*
Template Name: Full Container
*/
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shopstore
 */
 
$column = 'col-md-12';
$sidebar = 'inactive';
$sidebar_column = 'col-md-4';
$arg = array( 'section' => 'page-container', 'column' => $column, 'sidebar'=>$sidebar , 'sidebar_column' => $sidebar_column );

get_header();

    /**
    * Hook - shopstore_page_container_wrp_start - 10
	* Hook - shopstore_header_middle 	- 20.
	* Hook - shopstore_header_bottom 	- 30.
    *
    * @hooked shopstore_header
    */
    do_action( 'shopstore_page_container_start',$arg );
    ?> 

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

    /**
    * Hook - shopstore_page_container_wrp_end - 100
	* Hook - shopstore_header_middle 	- 20.
	* Hook - shopstore_header_bottom 	- 30.
    *
    * @hooked shopstore_header
    */
    do_action( 'shopstore_page_container_end',$arg );
get_footer();