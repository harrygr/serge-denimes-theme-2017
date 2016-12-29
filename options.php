<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	//$themename = get_option( 'stylesheet' );
	//$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$themename = 'serge';

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	$video_sources = array(
		'youtube'	=> 'YouTube',
		'vimeo'		=> 'Vimeo',
		);


	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => 'Site Settings',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => 'Custom footer scripts',
		'desc' => 'Add any custom scripts to appear at the bottom of the page. These will appear wrapped in script tags so no need to add your own.',
		'id' => 'footer_scripts',
		'std' => '',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => 'Custom footer html',
		'desc' => 'Add any custom html. You cannot enter scripts here.',
		'id' => 'footer_html',
		'std' => '',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	$options[] = array(
		'name' => __('Home Page Settings', 'options_check'),
		'type' => 'heading'
		);

	// Tile 1A
	$options[] = array(
		'name' => '',
		'desc' => '<h3>Top Left Tile</h3>',
		'type' => 'info');

	$options[] = array(
		'name' => __('Tile 1A Image', 'options_check'),
		'desc' => __('The top-left image', 'options_check'),
		'id' => 'tile_1a_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Tile 1A Text', 'options_check'),
		'desc' => __('The text to be overlaid on the image', 'options_check'),
		'id' => 'tile_1a_text',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Tile 1A URL', 'options_check'),
		'desc' => __('The URL that the image links to', 'options_check'),
		'id' => 'tile_1a_url',
		'std' => '',
		'type' => 'text');

	// Tile 1B
	$options[] = array(
		'name' => '',
		'desc' => '<h3>Top Right Tile</h3>',
		'type' => 'info');

	$options[] = array(
		'name' => __('Tile 1B Image', 'options_check'),
		'desc' => __('The top-right image', 'options_check'),
		'id' => 'tile_1b_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Tile 1B Text', 'options_check'),
		'desc' => __('The text to be overlaid on the image', 'options_check'),
		'id' => 'tile_1b_text',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Tile 1B URL', 'options_check'),
		'desc' => __('The URL that the image links to', 'options_check'),
		'id' => 'tile_1b_url',
		'std' => '',
		'type' => 'text');

	// Middle Row
	$options[] = array(
		'name' => '',
		'desc' => '<h3>Middle Left Tile</h3>',
		'type' => 'info');

	$options[] = array(
		'name' => __('Tile 2A Image', 'options_check'),
		'desc' => __('The middle-left image', 'options_check'),
		'id' => 'tile_2a_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Tile 2A Text', 'options_check'),
		'desc' => __('The text to be overlaid on the image', 'options_check'),
		'id' => 'tile_2a_text',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Tile 2A URL', 'options_check'),
		'desc' => __('The URL that the image links to', 'options_check'),
		'id' => 'tile_2a_url',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '',
		'desc' => '<h3>Middle Right Tile</h3>',
		'type' => 'info');

	$options[] = array(
		'name' => __('Tile 2B Image', 'options_check'),
		'desc' => __('The middle-right image', 'options_check'),
		'id' => 'tile_2b_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Tile 2B Text', 'options_check'),
		'desc' => __('The text to be overlaid on the image', 'options_check'),
		'id' => 'tile_2b_text',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Tile 2B URL', 'options_check'),
		'desc' => __('The URL that the image links to', 'options_check'),
		'id' => 'tile_2b_url',
		'std' => '',
		'type' => 'text');
// Third row full-span image
	$options[] = array(
		'name' => '',
		'desc' => '<h3>Third Row Tile</h3>',
		'type' => 'info');

	$options[] = array(
		'name' => __('Tile 3 Image', 'options_check'),
		'desc' => __('The bottom row image', 'options_check'),
		'id' => 'tile_3_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Tile 3 Text', 'options_check'),
		'desc' => __('The text to be overlaid on the image', 'options_check'),
		'id' => 'tile_3_text',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Tile 3 URL', 'options_check'),
		'desc' => __('The URL that the image links to', 'options_check'),
		'id' => 'tile_3_url',
		'std' => '',
		'type' => 'text');
//Video
	$options[] = array(
		'name' => '',
		'desc' => '<h3>Video Embed Tile</h3>',
		'type' => 'info');

	$options[] = array(
		'name' => __('Video embed ID', 'options_check'),
		'desc' => __('Just enter the video ID here', 'options_check'),
		'id' => 'home_video_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Video Source', 'options_check'),
		'id' => 'video_source',
		'std' => 'youtube',
		'type' => 'radio',
		'options' => $video_sources);

	//Video

	$options[] = array(
		'name' => '',
		'desc' => '<h3>Video Popup</h3>',
		'type' => 'info');

	$options[] = array(
	'desc' => 'Enable Popup Video',
	'name' => 'Show a popup video on the homepage',
	'id'   => 'enable_popup_video',
	'type' => 'checkbox',
	'std'  => false,
	);

	$options[] = array(
		'name' => __('Popup Video ID', 'options_check'),
		'desc' => __('Just enter the video ID here', 'options_check'),
		'id' => 'popup_video_id',
		'std' => '',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Video Source', 'options_check'),
		'id' => 'popup_video_source',
		'std' => 'youtube',
		'type' => 'radio',
		'options' => $video_sources);

				//------------------------//

	$options[] = array(
		'name' => __('Blog Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Blog Category Tiles', 'options_check'),
		'desc' => __('Select the categories to be shown as links on the blog page', 'options_check'),
		'id' => 'blog_category_tiles',
		 // These items get checked by default
		'type' => 'multicheck',
		'options' => $options_categories);


				//------------------------//

	$options[] = array(
		'name' => __('Shop Settings', 'options_check'),
		'type' => 'heading');

	$wp_editor_settings = array(
		'wpautop' => false,
		'textarea_rows' => 5,
		'tinymce' => false,
		);

	$options[] = array(
		'name' => __('Delivery Tab Content', 'options_check'),
		'desc' => 'The content in the Delivery/Return tab for products',
		'id' => 'delivery_tab_content',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

				//------------------------//

	return $options;
}
