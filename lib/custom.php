<?php
/**
 * Custom functions
 */

/**
* add a default-gravatar to options
*/
if ( !function_exists('serge_addgravatar') ) {
	function serge_addgravatar( $avatar_defaults ) {
		$myavatar = get_bloginfo('template_directory') . '/assets/img/avatar.png';
		$avatar_defaults[$myavatar] = 'Serge Peacock';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'serge_addgravatar' );
}
    

/**
* Add gallery attribute to galleries for lightbox
*/
add_filter( 'wp_get_attachment_link' , 'sa_add_gallery_rel' );
function sa_add_gallery_rel( $attachment_link ) {
	global $post;
	$attachment_link = str_replace('<a', '<a data-fancybox-group="group-' . $post->ID . '"', $attachment_link);
	return $attachment_link;
}

// Print code preformatted
function pr($a){echo '<pre>'; print_r($a); echo '</pre>';}

//Custom image sizes
add_image_size( 'square', 420, 420, true ); //square image size - this will crop 
add_image_size( 'whowears-thumb', 313, 9999 ); //300 pixels wide (and unlimited height)
add_image_size( 'landscape-thumb', 420, 420*3/4, true ); 

// Category Image - uses the Categories Images plugin: http://zahlan.net/blog/2012/06/categories-images/
function serge_cat_image($cat_id = null, $image_size = null) {
	if  (function_exists('z_taxonomy_image_url')) {
		return z_taxonomy_image_url($cat_id, $image_size);
	} else {
		return false;
	}
}
