	<?php
	$blog_page = get_page_by_path( 'blog-list' );
	$blog_page_id = $blog_page->ID;
	?>
	<div class="page-header">
		<h1 class="heading">Daily Blog</h1>
	</div>

	<a href="<?php echo get_permalink( $blog_page_id ); ?>">View list of posts</a>


	<div class="row blog-grid">
		<header>
			<div class="entry-title entry-subtitle">
				<h2 class="sub-heading">Latest Posts</h2>
			</div>
		</header>
		<?php
//First we will query blog posts with featured images
		$args = array(
			'post_type'  => 'post',
			'posts_per_page' => 3,
			'meta_key' => '_thumbnail_id'
			);
		$query = new WP_Query($args);
		if( $query->have_posts() ) {
			while($query->have_posts()) : $query->the_post();
			?>
			<div class='col-sm-4 bloggrid-box' id="post-<?php the_ID(); ?>">
				<a href="<?php the_permalink(); ?>" title="Go to <?php the_title( ); ?>" class="thumb-link">
					<?php
					if ( has_post_thumbnail() ) {
		// only print out the thumbnail if it actually has one
						the_post_thumbnail('landscape-thumb');
					} else {
						//This should never appear but is here for debugging
						echo '<p>this post does not have a featured image</p>';
					} ?>
				</a>
				<p class="meta"><span class="cats"><?php the_category(', ') ?></span> / <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time></p>
				<a href="<?php the_permalink(); ?>" title="Go to <?php the_title( ); ?>">
					<h3><?php the_title(); ?></h3>
				</a>
				<div class="excerpt"><?php the_excerpt(); ?></div>

			</div><!-- /.pic-box -->
			<?php
			endwhile;
		} else {
	//no posts found
		} ?>
	</div>


	<div class="row">
		<header>
			<div class="entry-title entry-subtitle">
				<h2 class="sub-heading">Blog Categories</h2>
			</div>
		</header>
		<?php
		$post_cats = of_get_option('blog_category_tiles');
		foreach ( $post_cats as $post_cat => $is_shown ) :
			if ( $is_shown ) :
				$cat = get_category( $post_cat );
			?>
			<div class='col-sm-6 col-md-4 bloggrid-box' id="category-<?php echo $post_cat; ?>">
				<a href="<?php echo get_category_link( $post_cat ); ?>" class="thumb-link">
					<img src="<?php echo serge_cat_image($cat->term_id, 'landscape-thumb'); ?>" alt="">
				</a>
				<a href="<?php echo get_category_link( $post_cat ); ?>" class="">
					<h3><?php echo $cat->name; ?></h3>
				</a>
			</div>
			<?php
			endif;
			endforeach;
			?>
		</div>
