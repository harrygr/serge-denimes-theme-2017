<?php
// trying to get this to load on site. Just doesn't load at all. Loads the header and that's it.
$products = get_posts([
	'post_type' => 'product',
	'numberposts' => -1
]);
echo 'hello';
echo json_encode($products);
