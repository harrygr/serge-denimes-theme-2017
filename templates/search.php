<article <?php //post_class(); ?>>
	<header>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part('templates/post-header'); ?>
	</header>
	<div class="entry-summary">
		<?php
		if ( has_post_thumbnail() ) the_post_thumbnail('thumbnail', array('class' => 'alignright'));

		the_excerpt(); 
		?>
		<div class="clearfix"></div>
	</div>
	<?php get_template_part('templates/entry-meta'); ?>
</article>
