<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>
<?php if (!WC()->cart->is_empty()) : ?>
    <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
        <?php
        do_action('woocommerce_before_mini_cart_contents');

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
                $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                ?>
                <li class="woocommerce-mini-cart-item moda-cart-items <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                    <a href="<?php echo esc_url($product_permalink); ?>">
                        <div class="part-img">
                        <?php echo wp_kses_post($_product->get_image()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                        <div class="part-txt">
                            <span class="name"><?php echo wp_kses_post(wp_trim_words($_product->get_name(), 4)); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                            <span><?php echo wp_kses_post($cart_item['quantity']); ?> <i class="fa-regular fa-xmark"></i> <?php echo wp_kses_post($product_price); ?></span>
                        </div>
                    </a>
                    <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>" aria-label="<?php echo esc_attr__('Remove this item', 'ayaa'); ?>" data-product_id="<?php echo esc_attr($product_id); ?>" data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>" data-product_sku="<?php echo esc_attr($_product->get_sku()); ?>" class="delete-btn"><i class="fa-regular fa-trash-can"></i></a>
                </li>
                <?php
            }
        }

        do_action('woocommerce_mini_cart_contents');
        ?>
    </ul>
    <div class="moda-cart-drawer-btn">
        <p class="woocommerce-mini-cart__total total">
            <?php
            /**
             * Hook: woocommerce_widget_shopping_cart_total.
             *
             * @hooked ayaa_woocommerce_widget_shopping_cart_subtotal - 10
             */
            do_action('woocommerce_widget_shopping_cart_total');
            ?>
        </p>
    </div>
    <?php else : ?>

    <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'ayaa'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>
