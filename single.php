<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package shopstore
 */

get_header();
	/**
    * Hook - shopstore_page_container_wrp_start - 10
	* Hook - shopstore_header_middle 	- 20.
	* Hook - shopstore_header_bottom 	- 30.
    *
    * @hooked shopstore_header
    */
    do_action( 'shopstore_page_container_start' );
    ?> 
     <div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-single', get_post_type() );
			
			/**
			* Hook - shopstore_single_post_navigation.
			*
			* @hooked shopstore_single_post_navigation - 20
			*/
			 do_action('shopstore_single_post_navigation');
			
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
    do_action( 'shopstore_page_container_end' );
	get_footer();

