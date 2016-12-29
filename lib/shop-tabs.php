<?php
// Hide unwanted tabs
add_filter( 'woocommerce_product_tabs', 'serge_remove_product_tabs', 98 );
function serge_remove_product_tabs( $tabs ) {
    //unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'serge_new_product_tab', 100 );
function serge_new_product_tab( $tabs ) {
	
	global $post; global $sa_settings;

	//The custom tab 1
	if ($tab_content = get_post_meta($post->ID, 'serge_tab_content', true)) {
		$tabs['custom_tab_1'] = array(
			'title' 	=> __( 'Details &amp; Care', 'woocommerce' ),
			'priority' 	=> 50,
			'callback' 	=> 'serge_custom_tab_content_1'
			);
	}

	//The custom tab 2
	if ( $tab_content = get_post_meta($post->ID, 'serge_tab_content_2', true) ){
		$tabs['custom_tab_2'] = array(
			'title' 	=> __( 'Size &amp; Fit', 'woocommerce' ),
			'priority' 	=> 55,
			'callback' 	=> 'serge_custom_tab_content_2'
			);
	}

	//The general tab
	if ( $tab_content = of_get_option('delivery_tab_content') ){
		$tabs['global_tab'] = array(
			'title' 	=> __( 'Delivery/Returns', 'woocommerce' ),
			'priority' 	=> 60,
			'callback' 	=> 'serge_global_tab_content'
			);
	}

	return $tabs;
}

//Delivery & returns
function  serge_global_tab_content() {

	if ($tab_content = of_get_option('delivery_tab_content') ) {
		echo $tab_content;
	}
}

// Size & fit
function  serge_custom_tab_content_2() {
	global $post;
	if ($tab_content = get_post_meta($post->ID, 'serge_tab_content_2', true)) {
		echo $tab_content;
	}
}

//Details & care
function serge_custom_tab_content_1() {
	global $post;
	if ($tab_content = get_post_meta($post->ID, 'serge_tab_content', true)) {
		echo $tab_content;
	}
}