<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="row" id="team-members">
<?php 
while (have_posts()) : 
the_post(); 
$args = array(
	'post_type' => 'attachment',
	'post_status' => null,
	'numberposts' => -1,
	'orderby'	  => 'menu_order',
	'order'		  => 'ASC',
	'post_parent' => $post->ID,
	);

if ($attachments = get_children( $args )) : 
	foreach ( $attachments as $attachment ) :
		$image = wp_get_attachment_image_src( $attachment->ID, 'square' );
	?>
<div class="col-md-4 col-sm-6 top-buffer team-member">
	<div class="team-container">
	<div class="img-container">
	<img src="<?php echo $image[0]; ?>" alt="">

	</div>
	
	<h3 class="team-caption"><?php echo $attachment->post_content; ?></h3>
	<div class="team-description"><?php echo $attachment->post_excerpt; ?></div>
	</div>
</div>	
<?php 
endforeach;
endif;
 ?>


<?php endwhile; ?>
</div>