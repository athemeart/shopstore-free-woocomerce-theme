<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shopstore
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('main-post'); ?>>

	<?php
    /**
    * Hook - shopstore_posts_blog_media.
    *
    * @hooked shopstore_posts_formats_thumbnail - 10
    */
    do_action( 'shopstore_posts_blog_media' );
    ?>

<div class="content-post">
   
   <?PHP
    if ( is_singular() ) :
        the_title( '<h3 class="title-post">', '</h1>' );
    else :
        the_title( '<h3 class="title-post"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
    ?>
    <?php
		if ( 'post' === get_post_type() ) :
			?>
			<ul class="entry-meta meta-post">
				<?php
				shopstore_posted_meta();
				//shopstore_posted_by();
				?>
			</ul><!-- .entry-meta -->
		<?php endif; ?>

    <div class="entry-post entry-content">
      <?php 
		/**
		* Hook - shopstore_blog_loop_content_type.
		*
		* @hooked shopstore_blog_loop_content_type - 10
		*/
		do_action( 'shopstore_blog_loop_content_type' );
	  
	  ?>
      
    </div>
</div>

</article><!-- #post-<?php the_ID(); ?> -->
