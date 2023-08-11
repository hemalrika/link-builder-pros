<?php

/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.1.0
 */

defined('ABSPATH') || exit;

global $product;

$attribute_keys  = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo esc_attr($variations_attr); ?>">
	<?php do_action('woocommerce_before_variations_form'); ?>

	<?php if (empty($available_variations) && false !== $available_variations) : ?>
		<p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'ayaa'))); ?></p>
	<?php else : ?>
		<div class="ayaa-variation-data">
			<?php woocommerce_single_variation(); ?>
		</div>
		<div class="variations">
			<div class="row g-xl-4 g-3">
				<?php foreach ($attributes as $attribute_name => $options) :
					$product_label_class = preg_replace('/[^\p{L}\p{N}\s]/u', '', strtolower(wc_attribute_label($attribute_name)));
				?>
					<div class="col-xxl-6 col-xl-6 col-lg-6 col-12">
						<div class="color-select-wrap">
							<label for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo wc_attribute_label($attribute_name); ?></label>
							<?php
							wc_dropdown_variation_attribute_options(
								array(
									'options'   => $options,
									'attribute' => $attribute_name,
									'product'   => $product,
									'class'   => 'select wide ' . $product_label_class . '-select',
								)
							);
							echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#0">' . esc_html__('Clear', 'ayaa') . '</a>')) : '';
							?>
						</div>
					</div>
				<?php endforeach; ?>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="quantity-wrap">
						<label><?php echo esc_html__('QTY', 'ayaa'); ?></label>
						<?php woocommerce_single_variation_add_to_cart_button(); ?>
					</div>
				</div>
			</div>
		</div>

		<?php do_action('woocommerce_after_variations_table'); ?>

		<div class="single_variation_wrap ayaa-product-variable">
			<?php
			/**
			 * Hook: woocommerce_before_single_variation.
			 */
			do_action('woocommerce_before_single_variation');
			/**
			 * Hook: woocommerce_after_single_variation.
			 */
			do_action('woocommerce_after_single_variation');
			?>
		</div>
	<?php endif; ?>

	<?php do_action('woocommerce_after_variations_form'); ?>
</form>

<?php
do_action('woocommerce_after_add_to_cart_form');
