	<div class="rowd" id="masonary-container">
		<div class="gutter-sizer"></div>
	<?php 
	$args = array(
		'category_name' 	=> 'who-wears-serge', 
		'posts_per_page' 	=> 99,
		);
	$who_wears_posts = new WP_Query($args);

	while ( $who_wears_posts->have_posts() ) : 
		$who_wears_posts->the_post(); 

	//Call a post image attachment
	if (has_post_thumbnail( $post->ID ) ){

		$thumbnail_id = get_post_thumbnail_id( $post->ID );
		$image 		= wp_get_attachment_image_src( $thumbnail_id , 'whowears-thumb' ); 
		$fullimage 	= wp_get_attachment_image_src( $thumbnail_id, 'full' ); 
		$title 		= get_the_title();
		$permalink 	= get_permalink();
		?>
		<div class="img-container">

			<a href="<?php echo $fullimage[0]; ?>" title="<?php echo $title; ?>" class="zoom">
				<img src="<?php echo $image[0]; ?>" alt="<?php echo $title; ?>">
			</a>
			<a href="<?php echo $permalink; ?>" title="View post: <?php echo $title; ?>" class="whowears-link"><?php echo $title; ?></a>

		</div>
		<?php
	}
	
	endwhile; 
	?>
	</div>

