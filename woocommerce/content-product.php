<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array('col-md-3', 'col-xs-6', 'top-buffer');
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<div data-div-id="product-part" data-product-id="<?php echo get_the_ID(); ?>" <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
	</a>
		<div id="catalog-info_<?php echo get_the_ID(); ?>" class="catalog-info">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<p class="out-of-stock">OUT OF STOCK</p>
    
            <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
            <!--<p class="product-view-link"><a href="<?php //the_permalink(); ?>">View</a></p>-->
            
			<?php
				/*if( $product->is_type( 'simple' ) ){
					echo '<p class="product-view-link"><a href="?add-to-cart='.get_the_ID().'">Add To Cart</a></p>';
				} elseif( $product->is_type( 'variable' ) ){
					echo '<p class="product-view-link"><a href="'.get_permalink().'">Select Options</a></p>';
				}*/
            ?>
		</div>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>
<!--<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery('div[data-div-id="product-part"]').hover(function() {
			var productcatalog = jQuery(this).attr("data-product-id");
			jQuery('#catalog-info_'+productcatalog).stop(true).fadeTo(50, 0.8, function() { jQuery(this).show(); });
		}, function() {
			var productcatalog = jQuery(this).attr("data-product-id");
			jQuery('#catalog-info_'+productcatalog).stop(true).fadeTo(50, 0, function () { jQuery(this).hide(); });
		});
	});
</script>-->