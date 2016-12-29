
<div id="masonary-container">
	<div class="gutter-sizer"></div>

<?php while (have_posts()) : the_post(); 
$args = array(
	'numberposts' => 99,
	'order' => 'ASC',
		//'post_mime_type' => 'image',
	'post_parent' => $post->ID,
	'post_status' => null,
	'post_type' => 'attachment',
	);

$attachments = get_children( $args );

endwhile; 

foreach ($attachments as $attachment) {
	$image_tile = wp_get_attachment_image_src($attachment->ID, 'whowears-thumb');
	$image_full = wp_get_attachment_image_src($attachment->ID, 'full');
	?>
	<div class="col-sm-6s col-md-4s top-bufferd img-container">
		<a href="<?php echo $image_full[0]; ?>" class="zoom" rel="gall-<?php echo $post->ID; ?>"><img src="<?php echo $image_tile[0]; ?>" alt=""></a>
	</div>
<?php } ?>
</div>