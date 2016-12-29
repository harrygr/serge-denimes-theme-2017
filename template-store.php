<?php
/*
Template Name: Online Store Template
*/
?>

<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>
<div class="row clearfix">
	<div class="col-sm-6">
		<div class="outerDiv">
			<a href="<?php the_field('unisex_link'); ?>">
				<img src="<?php the_field('unisex_picture'); ?>" alt="" />
				<div class="innerDiv">
					<div class="innerDivtxt">
						<h2><?php the_field('unisex_title'); ?></h2>
						<p><?php the_field('unisex_text'); ?></p>
					</div>
				</div>
			</a>
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="outerDiv">
			<a href="<?php the_field('womens_link'); ?>">
				<img src="<?php the_field('womens_picture'); ?>" alt="" />
				<div class="innerDiv">
					<div class="innerDivtxt">
						<h2><?php the_field('womens_title'); ?></h2>
						<p><?php the_field('womens_text'); ?></p>
					</div>
				</div>
			</a>
		</div>
	</div>

</div>
