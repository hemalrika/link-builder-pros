<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<div class="row">
		<div class="col-xxl-4 col-xl-6 col-lg-5 mb-15 mb-lg-0 mb-15 mb-xxl-0">
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
			<?php
			do_action( 'woocommerce_before_add_to_cart_quantity' );
			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
				)
			);
			do_action( 'woocommerce_after_add_to_cart_quantity' );
			?>
		</div>
		<div class="col-xxl-4 col-xl-6 col-lg-7 col-md-12 col-sm-6 mb-15 mb-xxl-0">
			<button type="submit" class="single_add_to_cart_button alt blog-btn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
			<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
			<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="0" />
		</div>
		<div class="col-xxl-4 col-xl-6 col-lg-12 col-md-12 col-sm-6">
			<?php if(shortcode_exists('woosw') && function_exists( 'woosw_init' )) : ?>
				<div class="ayaa-single-add-wishlist-btn">
					<?php echo do_shortcode('[woosw id="99"]'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
