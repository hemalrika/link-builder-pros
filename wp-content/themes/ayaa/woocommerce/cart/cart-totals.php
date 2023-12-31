<?php

/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined('ABSPATH') || exit;

?>
<div class="tab-sections <?php echo (WC()->customer->has_calculated_shipping()) ? 'calculated_shipping' : ''; ?>">
	<div class="tab-contents">
		<div class="cart-total-panel">
			<?php do_action('woocommerce_before_cart_totals'); ?>
			<h3 class="title"><?php esc_html_e('Cart Total', 'ayaa'); ?></h3>
			<div class="panel-body">
				<div class="calculate-area">
					<ul>
						<li><?php esc_html_e('Subtotal', 'ayaa'); ?> <span class="price-txt"><?php ayaa_wc_cart_totals_subtotal_html(); ?></span></li>
						<li><?php echo esc_html__('Total', 'ayaa'); ?> <span class="price-txt"><?php echo get_woocommerce_currency_symbol(); echo wp_kses_post(WC()->cart->get_cart_contents_total()); ?></span></li>
						<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
							<li class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
								<?php wc_cart_totals_coupon_label($coupon); ?>
								<span class="price-txt" data-title="<?php echo esc_attr(wc_cart_totals_coupon_label($coupon, false)); ?>"><?php wc_cart_totals_coupon_html($coupon); ?></span>
							</li>
						<?php endforeach; ?>
						<?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
							<table class="ayaa-el-cart-table-control">
								<tbody>
									<?php do_action('woocommerce_cart_totals_before_shipping'); ?>
									<?php wc_cart_totals_shipping_html(); ?>
									<?php do_action('woocommerce_cart_totals_after_shipping'); ?>
								</tbody>
							</table>
						<?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>
							<li class="shipping">
								<th><?php esc_html_e('Shipping', 'ayaa'); ?></th>
								<span data-title="<?php esc_attr_e('Shipping', 'ayaa'); ?>" class="price-txt" id="shippingFee"><?php woocommerce_shipping_calculator(); ?></span>
							</li>
						<?php endif; ?>
						<?php foreach (WC()->cart->get_fees() as $fee) : ?>
							<li class="fee">
								<?php echo esc_html($fee->name); ?>
								<span data-title="<?php echo esc_attr($fee->name); ?>" class="price-txt"><?php wc_cart_totals_fee_html($fee); ?></span>
							</li>
						<?php endforeach; ?>
						<?php
						if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) {
							$taxable_address = WC()->customer->get_taxable_address();
							$estimated_text  = '';

							if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) {
								/* translators: %s location. */
								$estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'ayaa') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
							}

							if ('itemized' === get_option('woocommerce_tax_total_display')) {
								foreach (WC()->cart->get_tax_totals() as $code => $tax) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
						?>
									<li class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
										<?php echo esc_html($tax->label) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										?>
										<span data-title="<?php echo esc_attr($tax->label); ?>" class="price-txt"><?php echo wp_kses_post($tax->formatted_amount); ?></span>
									</li>
								<?php
								}
							} else {
								?>
								<tr class="tax-total">
									<th><?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; ?></th>
									<td data-title="<?php echo esc_attr(WC()->countries->tax_or_vat()); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
								</tr>
						<?php
							}
						}
						?>
					</ul>
					<div class="wc-proceed-to-checkout">
						<?php do_action('woocommerce_proceed_to_checkout'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
