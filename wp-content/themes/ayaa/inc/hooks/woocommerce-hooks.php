<?php
add_action('woocommerce_before_shop_loop_item_title', 'ayaa_woo_product_thumbnail', 10);
add_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('ayaa_woocommerce_shop_loop_product_content', 'ayaa_woocommerce_template_loop_product_content', 10);
add_action('ayaa_woocommerce_shop_loop_product_content_list', 'ayaa_woocommerce_template_loop_product_content_list');
add_filter('loop_shop_columns', 'ayaa_shop_loop_columns');
add_filter('woocommerce_review_before_gravatar', 'ayaa_woocommerce_review_gravatar_size');
add_filter('woocommerce_output_related_products_args', 'ayaa_related_products_args', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10);
add_action('woocommerce_widget_shopping_cart_total', 'ayaa_woocommerce_widget_shopping_cart_subtotal', 10);
