<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><a class="sub-heading" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/post-header'); ?>
  </header>
  <div class="entry-summary">
    <?php the_content(); ?>
  </div>
  <?php get_template_part('templates/entry-meta'); ?>
</article>
