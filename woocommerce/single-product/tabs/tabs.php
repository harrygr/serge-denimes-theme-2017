<?php
/**
 * Single Product tabs
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($tabs)) : ?>

    <div class="panel entry-content top-buffer">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Details <i class="fa fa-caret-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <?php call_user_func('woocommerce_product_description_tab', 'description', $tab) ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Delivery <i class="fa fa-caret-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <?php
                        if(get_field('delivery', get_the_ID())) {
                            echo get_field('delivery', get_the_ID());
                        } else { ?>
                            <a href="<?php echo get_permalink(486) ?>"><span class="red">-  Free UK Premium delivery on all orders over £50</span></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Size Guide <i class="fa fa-caret-down"></i>
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <a href="<?php echo get_permalink(118) ?>"><span class="red">- Please click</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div itemprop="description">
        <?php
        global $post;
        echo apply_filters('woocommerce_short_description', $post->post_excerpt);
        ?>
    </div>

    <script>
        $(document).ready(function () {
            $('.panel-title a').on('click', function () {
                var icon = $(this).find('i');

                if (icon.hasClass('fa-caret-down')) {
                    $('.panel-title a i').removeClass('fa-caret-up').addClass('fa-caret-down');
                    icon.removeClass('fa-caret-down').addClass('fa-caret-up');
                } else {
                    $('.panel-title a i').removeClass('fa-caret-up').addClass('fa-caret-down');
                    icon.removeClass('fa-caret-up').addClass('fa-caret-down');
                }

            });
        });
    </script>

<?php endif; ?>