<?php
/**
 * shopstore Layout Hook
 *
 * @link https://developer.wordpress.org/themes/functionality/
 *
 * @package shopstore
 */

if( !function_exists('shopstore_header_container_top') ):
function shopstore_header_container_top(){
?>
<div class="header-top">
        <div class="container">
            <div class="row">
            
            
                <div class="col-md-6">
                    <ul class="flat-support">
                    	<?php if ( get_theme_mod('location') != "" ) : ?>
                        <li><i class="fa fa-map-marker"></i><?php echo esc_html( get_theme_mod('location') );?> </li>
                        <?php endif;?>
                        <?php if ( get_theme_mod('email') != "" ) : ?>
                        <li><i class="fa fa-envelope"></i><?php echo esc_html( get_theme_mod('email') );?> </li>
                        <?php endif;?>
                        <?php if ( get_theme_mod('phone') != "" ) : ?>
                        <li><i class="fa fa-phone"></i><?php echo esc_html( get_theme_mod('phone') );?> </li>
                        <?php endif;?>
                    </ul><!-- /.flat-support -->
                </div><!-- /.col-md-4 -->
                
                
                <!-- /.col-md-4 -->
                <div class="col-md-6">
                   
					<?php
                        wp_nav_menu( array(
                            'theme_location'    => 'top_bar_navigation',
                            'depth'             => 2,
                            'menu_class'  		=> 'flat-unstyled',
                            'container'			=>'ul',
                            'fallback_cb'    => false,
                        ) );
                    ?>	
                   
                </div><!-- /.col-md-4 -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.header-top -->

<?php	
}
endif;
add_action( 'shopstore_header_container', 'shopstore_header_container_top',10 );




if( !function_exists('shopstore_header_container_middle') ):
function shopstore_header_container_middle(){
?>

<div class="header-middle">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div id="logo" class="logo">
			<?php
            if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
            the_custom_logo();
            }else{
            ?>	
                <h1 class="logo site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a></h1>
                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                    <div class="site-description"><?php echo esc_html($description); ?></div>
                <?php endif; ?>
            <?php }?>  

            </div><!-- /#logo -->
        </div><!-- /.col-md-3 -->
		<?php
        /**
        * Hook - shopstore_top_product_search 		- 10
        * @hooked shopstore_top_product_search
        */
        do_action( 'shopstore_top_product_search' );
        ?> 
        <div class="col-md-3">
            <div class="box-icon-cart">
               
				<?php if ( class_exists( 'WooCommerce' ) ) :?>
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="icon-cart cart-icon">
                    <img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/img/cart.png" alt="">
                    <span class="count"><?php echo esc_html( WC()->cart->get_cart_contents_count());?></span>
                    <span class="price">
                        <?php echo wp_strip_all_tags( WC()->cart->get_cart_total() );?>
                    </span> 
                </a>
                <?php endif;?>
                
               
              
            </div><!-- /.box-cart -->
        </div><!-- /.col-md-3 -->
    </div><!-- /.row -->
</div><!-- /.container -->
</div><!-- /.header-middle -->

<?php	

}
endif;
add_action( 'shopstore_header_container', 'shopstore_header_container_middle',20 );


if( !function_exists('shopstore_header_container_bottom') ):
function shopstore_header_container_bottom(){
?>

<!-- RD Navbar -->
<div class="rd-navbar-wrap">
    <nav class="rd-navbar rd-navbar-transparent" >
        <div class="rd-navbar-inner">
            <!-- RD Navbar Panel -->
            <div class="rd-navbar-panel">
                <div class="rd-navbar-panel-canvas"></div>
                <!-- RD Navbar Toggle -->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span>
                </button>
            </div>
            <!-- END RD Navbar Panel -->
        </div>
        <div class="rd-navbar-outer">
            <div class="rd-navbar-inner">
				

                <div class="rd-navbar-subpanel">
                    <div class="rd-navbar-nav-wrap">
                        <!-- RD Navbar Nav -->
						<?php
                        wp_nav_menu( array(
                            'theme_location'    => 'primary',
                            'depth'             => 3,
                            'menu_class'  		=> 'menu rd-navbar-nav',
                            'container'			=>'ul',
                            'walker' => new shopstore_Navwalker(),
							'fallback_cb'       => 'shopstore_Navwalker::fallback',
                        ) );
                        ?>
                        <!-- END RD Navbar Nav -->
                    </div>

                </div>
            </div>
        </div>
    </nav>
</div>

<?php	
}
endif;
add_action( 'shopstore_header_container', 'shopstore_header_container_bottom',30 );


if ( ! function_exists( 'shopstore_banner_heading' ) ) :

	/**
	 * Add Banner Title.
	 *
	 * @since 1.0.0
	 */
	function shopstore_banner_heading() {
		 echo '<div class="site-header-text-wrap">';
		
			if ( is_home() ) {
					echo '<h1 class="page-title-text">';
					echo bloginfo( 'name' );
					echo '</h1>';
					echo '<p class="subtitle">';
					echo esc_html(get_bloginfo( 'description', 'display' ));
					echo '</p>';
			}else if ( function_exists('is_shop') && is_shop() ){
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					echo '<h1 class="page-title-text">';
					echo esc_html( woocommerce_page_title() );
					echo '</h1>';
				}
			}else if( function_exists('is_product_category') && is_product_category() ){
				echo '<h1 class="page-title-text">';
				echo esc_html( woocommerce_page_title() );
				echo '</h1>';
				echo '<p class="subtitle">';
				do_action( 'woocommerce_archive_description' );
				echo '</p>';
				
			}elseif ( is_singular() ) {
				echo '<h1 class="page-title-text">';
					echo single_post_title( '', false );
				echo '</h1>';
			} elseif ( is_archive() ) {
				
				the_archive_title( '<h1 class="page-title-text">', '</h1>' );
				the_archive_description( '<p class="archive-description subtitle">', '</p>' );
				
			} elseif ( is_search() ) {
				echo '<h1 class="title">';
					printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'shopstore' ),  get_search_query() );
				echo '</h1>';
			} elseif ( is_404() ) {
				echo '<h1 class="display-1">';
					esc_html_e( 'Oops! That page can&rsquo;t be found.', 'shopstore' );
				echo '</h1>';
			}
		
		echo '</div>';
	}

endif;

if ( ! function_exists( 'shopstore_static_banner_container' ) ) :

	/**
	 * Add title in custom header.
	 *
	 * @since 1.0.0
	 */
	function shopstore_static_banner_container() {
		
		if (is_front_page() && is_active_sidebar( 'front_page_sidebar' ) ) {
			dynamic_sidebar( 'front_page_sidebar' );
		}else{
			
		$header_image = get_header_image();
		echo '<div class="site-header">';
		
			if( function_exists('shopstore_banner_heading') ){ shopstore_banner_heading(); }
			
			if( $header_image !="" ){ 
				echo '<div class="site-header-bg-wrap">
					<div class="site-header-bg background-effect" style="background-image: url('.esc_url( $header_image ).'); opacity: 0.6; background-attachment: scroll;"></div>
				</div>
				';
			}	
			
		echo '</div>';
		}
	}

endif;

add_action( 'shopstore_header_container', 'shopstore_static_banner_container',40 );

/*-----------------------------------------
* PAGE CONTAINER 
*----------------------------------------*/
if( !function_exists('shopstore_page_container_wrp_start') ):
	function shopstore_page_container_wrp_start( $arg = 'gsdf' ) {
		if( !is_array( $arg ) ){ $arg = array(); }
		
		$arg['section'] = ( empty( $arg['section'] ) ) ? 'main-blog': $arg['section'];
		$arg['container'] = ( empty( $arg['container'] ) ) ? 'container': $arg['container'];
		
		?>
        <section class="<?php echo esc_attr( $arg['section'] );?>">
        <div class="<?php echo esc_attr( $arg['container'] );?>">
            <div class="row">
        <?php
	}
endif;	
add_action( 'shopstore_page_container_start', 'shopstore_page_container_wrp_start',10 );



if( !function_exists('shopstore_page_container_column') ):
	function shopstore_page_container_column( $arg = array() ) {
		if( !is_array( $arg ) ){ $arg = array(); } 	
		$arg['column'] = ( !isset( $arg['column'] ) ) ? 'col-md-8' : $arg['column'] ;
		?>
        <div class="<?php echo esc_attr( $arg['column'] );?>">
        <?php
	}
endif;	
add_action( 'shopstore_page_container_start', 'shopstore_page_container_column',20 );



/*-----------------------------------------
* PAGE CONTAINER  END
*----------------------------------------*/
if( !function_exists('shopstore_page_container_column_end') ):
	function shopstore_page_container_column_end() {
		?>
         </div>
        <?php
	}
endif;	
add_action( 'shopstore_page_container_end', 'shopstore_page_container_column_end',10 );



if( !function_exists('shopstore_page_container_sidebar') ):
	function shopstore_page_container_sidebar( $arg = array() ) {
		if( !is_array( $arg ) ){ $arg = array(); }
		$arg['sidebar'] = ( isset( $arg['sidebar'] ) && $arg['sidebar'] == 'inactive' ) ? 'inactive' : '' ;
		$arg['sidebar_column'] = ( !isset( $arg['sidebar_column'] ) ) ? 'col-md-4' : $arg['sidebar_column'] ;
		
		if( $arg['sidebar'] != 'inactive' ):
		?> 
        <div class="<?php echo esc_attr( $arg['sidebar_column'] );?>">
            <div class="sidebar">
                <?php get_sidebar();?>
            </div>
        </div>
        <?php
		endif;
		
	}
endif;	
add_action( 'shopstore_page_container_end', 'shopstore_page_container_sidebar',20 );



if( !function_exists('shopstore_page_container_wrp_end') ):
	function shopstore_page_container_wrp_end( $arg = array() ) {
		?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>
        <?php
	}
endif;	
add_action( 'shopstore_page_container_end', 'shopstore_page_container_wrp_end',100 );




