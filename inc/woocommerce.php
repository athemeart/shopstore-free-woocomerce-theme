<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package moduagency
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function shopstore_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'shopstore_woocommerce_setup' );


/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function shopstore_woocommerce_scripts() {
	
	wp_enqueue_style( 'shopstore-woocommerce-style', get_theme_file_uri( '/assets/woocommerce.css' ), array(), '1.0.0' );
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'shopstore-woocommerce-style', $inline_font );
	
	wp_enqueue_script( 'shopstore-woocommerce-js', get_theme_file_uri( '/assets/woocommerce.js' ), array(), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'shopstore_woocommerce_scripts' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function shopstore_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'shopstore_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function shopstore_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'shopstore_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function shopstore_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'shopstore_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function shopstore_woocommerce_loop_columns() {
	return 2;
}
add_filter( 'loop_shop_columns', 'shopstore_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function shopstore_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 6,
		'columns'        => 2,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'shopstore_woocommerce_related_products_args' );


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'shopstore_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function shopstore_woocommerce_wrapper_before() {
		$arg = array( 'column' => 'col-md-8' );
		/**
		* Hook - shopstore_page_container_wrp_start - 10
		* Hook - shopstore_header_middle 	- 20.
		* Hook - shopstore_header_bottom 	- 30.
		*
		* @hooked shopstore_header
		*/
		do_action( 'shopstore_page_container_start',$arg );
		?>
			<div id="shop" class="style1" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'shopstore_woocommerce_wrapper_before' );

if ( ! function_exists( 'shopstore_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function shopstore_woocommerce_wrapper_after() {
			?>
			
		</div><!-- #primary -->
		<?php
		$arg = array( 'sidebar' => 'active' );
		/**
    * Hook - shopstore_page_container_wrp_end - 100
	* Hook - shopstore_header_middle 	- 20.
	* Hook - shopstore_header_bottom 	- 30.
    *
    * @hooked shopstore_header
    */
    do_action( 'shopstore_page_container_end', $arg );
	}
}
add_action( 'woocommerce_after_main_content', 'shopstore_woocommerce_wrapper_after' );



if ( ! function_exists( 'shopstore_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function shopstore_woocommerce_product_columns_wrapper() {
		$columns = 3;
		echo '<div class="main-shop columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'shopstore_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'shopstore_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function shopstore_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'shopstore_woocommerce_product_columns_wrapper_close', 40 );



/**
 * Remove default WooCommerce Loop Title.
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


if ( ! function_exists( 'shopstore_loop_item_box_content_before' ) ) {
	/**
	 * Product Box Content before Title.
	 *
	 * @return  void
	 */
	function shopstore_loop_item_box_content_before() {
		echo '<div class="box-content">';
	}
}
add_action( 'shopstore_loop_item_box_content', 'shopstore_loop_item_box_content_before', 5 );


if ( ! function_exists( 'shopstore_loop_item_box_content_categories' ) ) {
	/**
	 * Product Loop categorie.
	 *
	 * @return  void
	 */
	function shopstore_loop_item_box_content_categories() {
		global $product;
		echo '<div class="cat-name">';
            echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">', '</span>' );
        echo '</div>';
	}
}
add_action( 'shopstore_loop_item_box_content', 'shopstore_loop_item_box_content_categories', 10 );

if ( ! function_exists( 'shopstore_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function shopstore_template_loop_product_title() {
		global $product;

		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		echo '<div class="product-name">';
			echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
				echo esc_html( get_the_title() );
			echo '</a>';
		echo '</div>';
	}
}
add_action( 'shopstore_loop_item_box_content', 'shopstore_template_loop_product_title', 20 );



add_action( 'shopstore_loop_item_box_content', 'woocommerce_template_loop_price', 30 );



add_action( 'shopstore_loop_item_box_content', 'woocommerce_template_loop_add_to_cart', 40 );



if ( ! function_exists( 'shopstore_loop_item_box_content_after' ) ) {
	/**
	 * Product Box Content after Title.
	 *
	 * @return  void
	 */
	function shopstore_loop_item_box_content_after() {
		echo '</div>';
	}
}
add_action( 'shopstore_loop_item_box_content', 'shopstore_loop_item_box_content_after', 100 );


if ( !function_exists('shopstore_top_product_search') ):
	
	/**
	 * shopstore_top_product_search.
	 *
	 * @since 1.0.0
	 */
	 
	function shopstore_top_product_search(){	
		?>
		
		<?php if ( class_exists( 'WooCommerce' ) ) :
		
		if (  is_active_sidebar( 'replace_header_search' ) ) {
			dynamic_sidebar( 'replace_header_search' );
		}else{
			?>
        <div class="col-lg-6 col-md-6 col-sm-12">
      <div id="search-category">
        <form role="search" class="search-box search-box" action="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" method="get">
          <div class="search-categories">
            <div class="search-cat">
              <?php 
            $args = array(
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'show_count' => '0',
            'pad_counts' => '0',
            'hierarchical' => '1',
            'title_li' => '',
            'hide_empty' => '0',
            
            );
            $all_categories = get_categories( $args );
			 $selected = ( isset( $_GET['category'] ) && $_GET['category'] != "" ) ? sanitize_text_field( $_GET['category'] ) : '';
            ?>
              <select class="category-items" name="category">
                <option value="0">
                <?php esc_html_e('All Categories','shopstore') ?>
                </option>
                <?php foreach( $all_categories as $category ) { ?>
               <option  value="<?php echo esc_attr( $category->slug ); ?>" <?php echo ( $category->slug == $selected ) ? 'selected="selected"' : '';?> ><?php echo esc_html( $category->cat_name ); ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <input type="search" name="s" id="text-search" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search here...','shopstore') ?>" />
          <button id="btn-search-category" type="submit"><img src="<?php echo esc_url( get_template_directory_uri() );?>/assets/img/search.png" /></button>
          <input type="hidden" name="post_type" value="product" />
        </form>
      </div>
    </div>
    <?php } endif;
	
		
	}
	add_action( 'shopstore_top_product_search', 'shopstore_top_product_search');
endif;

function shopstore_advanced_search_query($query) {

    if($query->is_search()) {
        // category terms search.
        if (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) {
            $query->set('tax_query', array(array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => array($_REQUEST['category']) )
            ));
        }    
    }
    return $query;
}
add_action('pre_get_posts', 'shopstore_advanced_search_query', 1000);
/**
* Single product.
*
* @since 1.0.0
*/

add_action( 'shopstore_single_product_title', 'woocommerce_template_single_title', 5 );

add_action( 'shopstore_single_product_rating_n_stock', 'woocommerce_template_single_rating', 10 );

if ( ! function_exists( 'shopstore_get_stock_html' ) ) {

	/**
	 * Output the product stock.
	 */
	function shopstore_get_stock_html() {
		global $product; 
		echo '<div class="status-product">';
		echo wc_get_stock_html( $product );
		echo '</div>';
	}
	add_action( 'shopstore_single_product_rating_n_stock', 'shopstore_get_stock_html', 10 );
}




if ( ! function_exists( 'shopstore_template_single_price_action' ) ) {

	/**
	 * Trigger the single product price action.
	 */
	function shopstore_template_single_price_action() {
		global $product;
		if( $product->get_type() == 'variable' ){
		// Main Price
        $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
        $price = $prices[0] !== $prices[1] ? wc_price( $prices[0] ) . '-' . wc_price( $prices[1] ) : wc_price( $prices[0] );

        // Sale Price
        $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
        sort( $prices );
        $saleprice = $prices[0] !== $prices[1] ? wc_price( $prices[0] ) . '-' . wc_price( $prices[1] ) : wc_price( $prices[0] );

        if ( $price !== $saleprice && $product->is_on_sale() ) {
            $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
			
        }

        echo '<div class="price shopstore_variable_price">'.$price.'</div><div class="shopstore_variable_product_status"></div>
        <div class="hidden-variable-price" >'.$price.'</div>';
		}elseif( $product->get_type() == 'simple' ){
			
			if( function_exists('woocommerce_single_variation') ) { echo woocommerce_template_single_price(); }
			
		}else{
			
			if( function_exists('woocommerce_single_variation') ) { echo woocommerce_template_single_price(); }
			
		}
	}
}




remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'shopstore_template_single_price_action', 10 );





/* 
 TOOL BAR
*/

remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);

if ( ! function_exists( 'shopstore_header_toolbar_start' ) ) {
	/**
	 * Insert the opening anchor tag for products in the loop.
	 */
	function shopstore_header_toolbar_start() {
		echo '<div class="shopstore-toolbar clearfix">';
	}
	
	add_action('woocommerce_before_shop_loop','shopstore_header_toolbar_start',20);
}


function shopstore_result_count() {
	get_template_part( 'woocommerce/result-count' );
}
add_action('woocommerce_before_shop_loop','shopstore_result_count',30);


if ( ! function_exists( 'shopstore_header_toolbar_end' ) ) {
	/**
	 * Insert the opening anchor tag for products in the loop.
	 */
	function shopstore_header_toolbar_end() {
		echo '<div class="clearfix"></div></div>';
	}
	
	add_action('woocommerce_before_shop_loop','shopstore_header_toolbar_end',30);
}





if ( ! function_exists( 'shopstore_shop_loop_shop_per_page' ) ) :
	/**
	 * Returns correct posts per page for the shop
	 *
	 * @since 1.0.0
	 */
	function shopstore_loop_shop_per_page() {
		
		$posts_per_page = ( isset( $_GET['products-per-page'] ) ) ? sanitize_text_field( wp_unslash( $_GET['products-per-page'] ) ) : 12;

		if ( $posts_per_page == 'all' ) {
			$posts_per_page = wp_count_posts( 'product' )->publish;
		}
		
		return $posts_per_page;
	}
	add_filter( 'loop_shop_per_page', 'shopstore_loop_shop_per_page', 20 );
endif;