<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/assets/js/jquery.bxslider.js"></script>
<link href="<?php echo get_bloginfo('stylesheet_directory'); ?>/assets/css/jquery.bxslider.css" rel="stylesheet" />

<div class="bxslider">
	<?php
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" rel="gall[product-gallery]">%s</a>', $image_link, $image_title, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
<div class="bx-custom-pagination"></div>
<script type="text/javascript">
jQuery(document).ready(function() {

	var addPagination = (function () {
		if ($('.bxslider')) {
			function createEl(name, cls, parent) {
				var el = document.createElement(name);
				$(el).addClass(cls);
				if ($(parent)) {
					$(parent).append(el);
				}
				return $(el);
			}
			var images = $('.bxslider').children('.zoom');
			var box = $('.bx-custom-pagination');
			var frag = document.createDocumentFragment();
			for (var i = 0, j = images.length; i < j; i++) {
				var newA = createEl('a', 'pagination-img', frag);
				newA.attr('data-slide-index', i);
				var newImg = createEl('img', 'pagination-img', newA);
				var imgSrc = $(images[i]).find('img').attr('src');
				newImg.attr('src', imgSrc);
			}
			box.append(frag);
		}
	})();


	$('.bxslider').bxSlider({
		pagerCustom: '.bx-custom-pagination',
		controls: false
	});

	$('.bx-custom-pagination').before('<button class="bx-up"><i class="fa fa-angle-up"></i></button>');
	$('.bx-custom-pagination').after('<button class="bx-down"><i class="fa fa-angle-down"></i></button>');

    $('.bx-up').on('click', function () {
        if (parseInt($('.bx-custom-pagination').css('margin-top')) < 0) {
            $('.bx-custom-pagination').css('margin-top', parseInt($('.bx-custom-pagination').css('margin-top')) + 150 + 'px');
        }
    });

    $('.bx-down').on('click', function () {
        if (Math.abs(parseInt($('.bx-custom-pagination').css('margin-top')) / 150) < $('a.pagination-img').length - parseInt($('.images').height() / 150)) {
            $('.bx-custom-pagination').css('margin-top', parseInt($('.bx-custom-pagination').css('margin-top')) - 150 + 'px');
        }
    });

});
jQuery(window).load(function (){
	$('.size-list li').on('click', function(){
		$('.size-list li').removeClass('active');
		$(this).addClass('active');
		$('.size-select').val($(this).data('value')).change();
	});

	$('.size-list li:first').trigger('click');
});
</script>
