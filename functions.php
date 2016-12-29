<?php
/**
 * Roots includes
 */
require_once locate_template('/lib/custom-in-stock-message.php');
require_once locate_template('/lib/editor.php');
require_once locate_template('/lib/instagram.php');
require_once locate_template('/lib/live.php');
require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/wrapper.php');         // Theme wrapper class
require_once locate_template('/lib/header.php');          // Header Stuff
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/titles.php');          // Page titles
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/gallery.php');         // Custom [gallery] modifications
require_once locate_template('/lib/comments.php');        // Custom comments modifications
require_once locate_template('/lib/relative-urls.php');   // Root relative URLs
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions
require_once locate_template('/lib/woocommerce.php');
require_once locate_template('/lib/shop-forms.php');
require_once locate_template('/lib/shop-tabs.php');          // Woocommerce functions
require_once locate_template('/lib/serge-settings.php');  // Woocommerce functions
require_once locate_template('/woocommerce/custom-wc-functions.php');  // Woocommerce functions

add_action('woocommerce_thankyou', 'my_custom_tracking');

function my_custom_tracking($order_id)
{
    $order = new WC_Order($order_id);
    $total = $order->get_subtotal();
    $id = str_replace('#', '', $order->get_order_number());
    echo '<iframe src="https://studentbeansnetwork.go2cloud.org/aff_l?offer_id=113&amount=' . $total . '&adv_sub=' . $id . '" scrolling="no" frameborder="0" width="1" height="1"></iframe>';
}

// if (is_page('external-product-feed')) {
// 	$products = get_posts([
// 		'post_type' => 'product',
// 		'numberposts' => -1
// 	]);
// 	echo 'hello';
// 	file_put_contents(__DIR__ . '/product-feed.json', json_encode($products));
// 	echo json_encode($products);
// }
