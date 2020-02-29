<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 6.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li>
<div class="row">
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	<div class="col-md-4 col-sm-4 col-4">
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php echo wp_kses_post( $product->get_image() ); ?>
		
	</a>
	</div>
    <div class="col-md-8 col-sm-8 col-8">
    <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
   		 <span class="product-title"><?php echo esc_html( $product->get_name() ); ?></span>
    </a>
	<?php if ( ! empty( $show_rating ) ) : ?>
		<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
	<?php endif; ?>

	<?php echo wp_kses_post( $product->get_price_html() ); ?>
    </div>
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</div>
</li>
