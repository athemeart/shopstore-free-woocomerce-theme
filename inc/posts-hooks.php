<?php
/**
 * Posts hook & function
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package shopstore
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! function_exists( 'shopstore_posts_formats_thumbnail' ) ) :

	/**
	 * Post formats thumbnail.
	 *
	 * @since 1.0.0
	 */
	function shopstore_posts_formats_thumbnail() {
	?>
		<?php if ( has_post_thumbnail() ) :
			$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			$formats = get_post_format(get_the_ID());
			$type =  get_theme_mod( 'blog_content_type', 'excerpt' ) ;

		?>
        <div class="featured-post">  
		<?php if ( is_singular() ) :?>
        	<a href="<?php echo esc_url( $post_thumbnail_url );?>" class="image-popup">
        <?php else: ?>
        	<a href="<?php echo esc_url( get_permalink() );?>" class="image-link">
        <?php endif;?>
        		<?php the_post_thumbnail('full');?>
        	</a>
        </div><div class="divider25"></div>
         <?php endif;?> 
	<?php
	}

endif;
add_action( 'shopstore_posts_formats_thumbnail', 'shopstore_posts_formats_thumbnail' );


if ( ! function_exists( 'shopstore_posts_formats_video' ) ) :

	/**
	 * Post Formats Video.
	 *
	 * @since 1.0.0
	 */
	function shopstore_posts_formats_video() {
	
		$content = apply_filters( 'the_content', get_the_content(get_the_ID()) );
		$video = false;
		// Only get video from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
		}
		
			// If not a single post, highlight the video file.
			$post_thumbnail_url = '';
			
			if ( ! empty( $video ) ) :	
				$i = 0;
				foreach ( $video as $video_html ) {  $i++;
					echo '<div class="entry-video embed-responsive embed-responsive-16by9">';
					echo $video_html;
					echo '</div>';
					echo '<div class="divider25"></div>';
					if( $i == 1 ){ break; }
				}
			else: 
				do_action('shopstore_posts_formats_thumbnail');	
			endif;
		
		
	 }

endif;
add_action( 'shopstore_posts_formats_video', 'shopstore_posts_formats_video' ); 


if ( ! function_exists( 'shopstore_posts_formats_audio' ) ) :

	/**
	 * Post Formats audio.
	 *
	 * @since 1.0.0
	 */
	function shopstore_posts_formats_audio() {
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;
	
		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}
		
		
			$post_thumbnail_url = '';
			if ( has_post_thumbnail() ) :
				$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			endif;
			
			
		// If not a single post, highlight the audio file.
		if ( ! empty( $audio ) ) : $i = 0;
			foreach ( $audio as $audio_html ) { $i++;
				if( $post_thumbnail_url != "" ){
				   echo '<figure style="background: url(\''.esc_url( $post_thumbnail_url ).'\') no-repeat center center; background-size:cover; -webkit-background-size:cover; -moz-background-size:cover;" class="entry-video embed-responsive embed-responsive-16by9"><div class="audio-center">';
						echo $audio_html;
					echo '</div></figure>';
				}else{
					
					echo $audio_html;
					
				}
					echo '<div class="divider25"></div>';
					if( $i == 1 ){ break; }
					
			}
		else: 
			do_action('shopstore_posts_formats_video');	
		endif;
	
		
	 }

endif;
add_action( 'shopstore_posts_formats_audio', 'shopstore_posts_formats_audio' ); 

add_filter( 'use_default_gallery_style', '__return_false' );


if ( ! function_exists( 'shopstore_posts_formats_gallery' ) ) :

	/**
	 * Post Formats gallery.
	 *
	 * @since 1.0.0
	 */
	function shopstore_posts_formats_gallery() {
		global $post;
		$post_thumbnail_url = '';
		
		if( has_block('gallery', $post->post_content) ): 
		
			$post_blocks = parse_blocks( $post->post_content );
			
			if( !empty( $post_blocks ) ):
				
				echo '<div class="gallery-media wp-block-gallery">';
				foreach ( $post_blocks as $row  ):
					if( $row['blockName']=='core/gallery' )
					echo $row['innerHTML'];
				endforeach;
				echo '</div>';
			endif;
			
		
		elseif ( get_post_gallery() ) :
			echo '<figure class="gallery-media owlGallery">';
			
				$gallery = get_post_gallery( $post, false );
				$ids = explode( ",", $gallery['ids'] );
				
				foreach( $ids as $id ) {
				
				   $link   = wp_get_attachment_url( $id );
				
				  echo '<div class="item"><img src="' . esc_url( $link ) . '"  class="img-responsive" alt="' .esc_attr( get_the_title() ). '" title="' .esc_attr( get_the_title() ). '"  /></div>';
				
				} 
				
			echo '</figure>';
			
		else: 
			do_action('shopstore_posts_formats_thumbnail');	
		endif;	
	
	 }

endif;
add_action( 'shopstore_posts_formats_gallery', 'shopstore_posts_formats_gallery' ); 




if ( ! function_exists( 'shopstore_posts_blog_media' ) ) :

	/**
	 * Post shopstore_posts_blog_media
	 *
	 * @since 1.0.0
	 */
	function shopstore_posts_blog_media() {
		$formats = get_post_format(get_the_ID());
		
		switch ( $formats ) {
			default:
				do_action('shopstore_posts_formats_thumbnail');
			break;
			case 'gallery':
				do_action('shopstore_posts_formats_gallery');
			break;
			case 'audio':
				do_action('shopstore_posts_formats_audio');
			break;
			case 'video':
				do_action('shopstore_posts_formats_video');
			break;
		} 
		
	 }

endif;
add_action( 'shopstore_posts_blog_media', 'shopstore_posts_blog_media' ); 



if ( ! function_exists( 'shopstore_posted_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function shopstore_posted_meta() {
		
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s','shopstore' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<li>' . $posted_on . '</li> <li>' . $byline . '</li>'; // WPCS: XSS OK.
	
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'shopstore' ) );
		if ( $categories_list && shopstore_categorized_blog() ) {
			printf( '<li class="cat-links">%1$s</li>', $categories_list ); // WPCS: XSS OK.
		}

		
	}
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<li class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'shopstore' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</li>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'shopstore' ),
			the_title( '<li class="screen-reader-text">"', '"</li>', false )
		),
		'<li class="edit-link">',
		'</li>'
	);
	

	}
endif; 
if ( ! function_exists( 'shopstore_categorized_blog' ) ) :
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function shopstore_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'shopstore_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'shopstore_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so shopstore_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so shopstore_categorized_blog should return false.
		return false;
	}
}
endif; 


if ( ! function_exists( 'shopstore_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function shopstore_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'shopstore' ) );
			if ( $tags_list ) {
				echo $tags_list;
			}
			
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'shopstore' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link pull-right">',
			'</span>'
		);
	}
endif;



if ( ! function_exists( 'shopstore_single_post_navigation' ) ) :

	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function shopstore_single_post_navigation( ) {
		echo '<div class="blog-pagination single-prev-next"><div class="row">';
		$prevPost = get_previous_post(true);
		if( $prevPost ) :
			echo '<div class="col-md-6 col-sm-6 prev">';
				$prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(40,40) );
				previous_post_link('%link',$prevthumbnail , TRUE); 
				echo '<div class="text"><h6>'.esc_html__('Previous Article','shopstore').'</h6>';
					previous_post_link('%link',"<span>%title</span>", TRUE); 
				echo '</div>';
			echo '</div>';
			
		endif;
		
		$nextPost = get_next_post(true);
		if( $nextPost ) : 
			echo '<div class="col-md-6 col-sm-6 text-right">';
				$nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(40,40) );
				next_post_link('%link',$nextthumbnail, TRUE);
				echo '<div class="text"><h6>'.esc_html__('Next Article','shopstore').'</h6>';
					next_post_link('%link',"<span>%title</span>", TRUE);
				echo '</div>';
			echo '</div>';
			
		endif;
		echo '</div></div>';
		} 
		

endif;
add_action( 'shopstore_single_post_navigation', 'shopstore_single_post_navigation', 10 ); 



if ( ! function_exists( 'shopstore_walker_comment' ) ) : 
	/**
	 * Implement Custom Comment template.
	 *
	 * @since 1.0.0
	 *
	 * @param $comment, $args, $depth
	 * @return $html
	 */
	  
	function shopstore_walker_comment($comment, $args, $depth) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<li <?php comment_class( empty( $args['has_children'] ) ? 'comment shift' : 'comment' ) ?> id="comment-<?php comment_ID() ?>">
            <div class="comment_wrp ">
               
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 60 ); ?>
               	
                <div class="comment_container">
                    <h4 class="user-heading"><?php echo get_comment_author_link();?>
                        <small>
                        <?php
                        /* translators: 1: date, 2: time */
                        printf( esc_html__('%1$s at %2$s', 'shopstore' ), get_comment_date(),  get_comment_time() ); ?></a> </small>
                        <small>  <?php edit_comment_link( esc_html__( '(Edit)' , 'shopstore' ), '  ', '' );?>  </small>
                    </h4>
                      
                   <p><?php comment_text(); ?></p>
                    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
            </div>
			<div class="clearfix"></div>
	   </li>
       <?php
	}
	
	
endif;


if ( ! function_exists( 'shopstore_the_posts_navigation' ) ) :

	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function shopstore_the_posts_navigation( ) {
		the_posts_navigation(
			array(
				'prev_text' => '<span class="btn-content">'.esc_html__('Previous page', 'shopstore').'</span><span class="icon"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>',
				'next_text' => '<span class="btn-content">'.esc_html__('Next page', 'shopstore').'</span><span class="icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>',
				'screen_reader_text' => __('Posts navigation', 'shopstore')
			)
		);
		echo '<div class="clearfix"></div>';
		
	}
endif;
add_action( 'shopstore_the_posts_navigation', 'shopstore_the_posts_navigation', 10 ); 

if ( ! function_exists( 'shopstore_custom_excerpt_length' ) ) :

	/**
	 * Post Single Posts Navigation 
	 *
	 * @since 1.0.0
	 */
	function shopstore_custom_excerpt_length( $length ) {
		$custom = get_theme_mod( 'excerpt_length_blog' );
		if( $custom != '' ) {
			return $length = intval( $custom );
		} else {
			return $length;
		}
		
	}
	add_filter( 'excerpt_length', 'shopstore_custom_excerpt_length', 999 );
endif;


if( ! function_exists( 'shopstore_blog_loop_content_type' ) && ! is_admin() ) :

    /**
     * Excerpt length
     *
     * @since  Blog Expert 1.0.0
     *
     * @param null
     * @return int
     */
    function shopstore_blog_loop_content_type( $length ){
        $type = get_theme_mod( 'blog_loop_content_type', 'excerpt-only' );

        if ( $type === 'excerpt-only' ) {
        		the_excerpt();
        }else{
			$content = preg_replace("/<embed[^>]+>/i", "", get_the_content() , 1);
			echo strip_shortcodes( $content );
		}

        return $length;

    }
	add_action( 'shopstore_blog_loop_content_type', 'shopstore_blog_loop_content_type', 10 ); 
endif; 


if( ! function_exists( 'shopstore_read_more_link' ) ) :
	/**
	* Adds custom Read More.
	*
	*/
	function shopstore_read_more_link( $more  ) {
		
		return sprintf( '<div class="more-link">
             <a href="%1$s" class="btn btn-theme">%2$s<i class="fa fa-fw fa-long-arrow-right"></i></a>
        </div>',
            get_permalink( get_the_ID() ),
            esc_html__( 'Continue Reading', 'shopstore' )
        );
		
	}
	add_filter( 'the_content_more_link', 'shopstore_read_more_link' );
endif;

if( ! function_exists( 'shopstore_excerpt_more' ) ) :
	/**
	 * Filter the "read more" excerpt string link to the post.
	 *
	 * @param string $more "Read more" excerpt string.
	 * @return string (Maybe) modified "read more" excerpt string.
	 */
function shopstore_excerpt_more( $more ) {
    if ( ! is_single() ) {
        $more = sprintf( '<div class="more-link">
             <a href="%1$s" class="btn btn-theme">%2$s<i class="fa fa-fw fa-long-arrow-right"></i></a>
        </div>',
            get_permalink( get_the_ID() ),
            esc_html__( 'Continue Reading', 'shopstore' )
        );
		
    }
    return $more;
}
add_filter( 'excerpt_more', 'shopstore_excerpt_more' );

endif;