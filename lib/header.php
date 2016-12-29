<?php 

// Adds the ability to have a header image
$args = array(
	'width'         => 565,
	'height'        => 175,
	'default-image' => get_template_directory_uri() . '/assets/img/serge-header-image.jpg',
	'uploads'       => true,
);
add_theme_support( 'custom-header', $args );
 ?>
