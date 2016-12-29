<?php 
if ( function_exists('is_woocommerce') && is_woocommerce() || is_page(array('cart', 'checkout', 'my-account'))) {
	
	$term_object = get_queried_object();
	if( $term_object->taxonomy == "product_cat" && $term_object->parent == 0 ) {
		// do noting
	} else {
		dynamic_sidebar('sidebar-shop');
	}
	
} else {
	dynamic_sidebar('sidebar-primary');
}
?>
