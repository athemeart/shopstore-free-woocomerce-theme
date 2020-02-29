<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 6.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
    	<div class="product-detail">
            <div class="header-detail">
				<?php
                /**
                * Hook: woocommerce_template_single_title.
                *
                * @hooked shopstore_single_product_title - 5
                */
                do_action( 'shopstore_single_product_title' );
                ?>
              <!--  <div class="category">
                    Smart Watches
                </div>-->
                <div class="reviewed">
					<?php
                    /**
                    * Hook: shopstore_single_product_rating_n_stock.
                    *
                    * @hooked woocommerce_template_single_rating - 5
					* @hooked shopstore_get_stock_html - 10
                    */
                    do_action( 'shopstore_single_product_rating_n_stock' );
                    ?>
                    <div class="clearfix"></div>
                </div><!-- /.reviewed -->
            </div>
            
            <div class="content-detail">
				<?php
                /**
                * Hook: woocommerce_single_product_summary.
                *
                * @hooked shopstore_template_single_price_action - 10
                * @hooked woocommerce_template_single_excerpt - 20
                * @hooked woocommerce_template_single_add_to_cart - 30
				* @hooked shopstore_loop_wishlist_n_compare - 31
                * @hooked woocommerce_template_single_meta - 40
                * @hooked woocommerce_template_single_sharing - 50
                * @hooked WC_Structured_Data::generate_product_data() - 60
                */
                do_action( 'woocommerce_single_product_summary' );
                ?>
                
            </div>

		
        </div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
