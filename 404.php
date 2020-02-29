<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package shopstore
 */

$arg = array( 'section' => 'page-container' , 'column' => 'col-md-12', 'sidebar' => 'inactive' );
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
			
            <div class="error-404">
                <img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/img/page-404-icon.png" alt="" title="" />
                <h2><?php esc_html_e( ' Oops! That page can&#39;t be found.', 'shopstore' ); ?></h2>
                <h5><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'shopstore' ); ?></h5>
                
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-style-2"><span class="btn-content"><?php esc_html_e( 'Back to home', 'shopstore' ); ?></span><span class="icon"><i class="fa fa-arrow-left" aria-hidden="true"></i></span></a>
            </div>
            
            
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