<p class="postmeta text-muted">
	<span class="byline author vcard">
		<?php echo __('By', 'roots'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a>
	</span> / 
	<span class="cats">Posted in <?php the_category(', ') ?></span>
	<?php 
	echo " / ";
	$linkText = "Comment on this post";
	comments_popup_link( $linkText, $linkText, $linkText); 
	edit_post_link('Edit <i class="fa fa-pencil"></i>', ' / ', ''); ?>
</p>
<?php if ( in_category('serge-song-of-the-week') ){ ?>
<p class="spotify-meta"><a href="http://open.spotify.com/user/1163287097/playlist/1ztfJ8Z9278J7AVPtRSMg5" title="Serge Songs of the Week on Spotify">Subscribe to the Serge Spotify</a></p>
<?php } ?>
<?php //get_template_part('templates/social', 'buttons'); ?>
<?php do_action( 'addthis_widget' ); ?>
<hr>