<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

<div class="popup-newsletter">

    <div>
        <p class="close">X</p>

        <img src="<?php header_image(); ?>" alt="Serge DeNimes"/>

        <p class="text">
            SUBCRIBE TO OUR NEWSLETTER TO STAY UP TO DATE WITH THE LASTEST FROM SERGE DENIMES AND RECEIVE <span>10% OFF</span> YOUR FIRST ORDER
        </p>

        <!-- Begin MailChimp Signup Form -->
        <div id="mc_embed_signup">
            <form action="//sergedenimes.us4.list-manage.com/subscribe/post?u=02f15a1f5236415407f96f1de&amp;id=f9769405d2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
                    <p class="sub-heading">YOUR EMAIL ADDRESS</p>
                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" required>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_02f15a1f5236415407f96f1de_f9769405d2" tabindex="-1" value=""></div>
                    <div class="clear"><input type="submit" value="SEND" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
        </div>

        <!--End mc_embed_signup-->

        <p>
            BY CLICKING SIGN UP YOU'RE AGREESING TO OUR PRIVACY POLICY
        </p>
    </div>

</div>

<!--[if lt IE 8]>
<div class="alert alert-warning">
    <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
</div>
<![endif]-->

<?php get_template_part('templates/facebook', 'sdk'); ?>

<?php
do_action('get_header');
get_template_part('templates/header', 'masthead');
// Use Bootstrap's navbar if enabled in config.php
if (current_theme_supports('bootstrap-top-navbar')) {
    get_template_part('templates/header-top-navbar');
} else {
    get_template_part('templates/header');
}
?>

<?php if (get_the_ID() == 2) { ?>
    <div class="full-image">
        <div class="container">
            <?php echo get_the_post_thumbnail(get_the_ID()); ?>
        </div>
    </div>
<?php } ?>

<?php if (get_the_ID() == 487) { ?>
    <div class="full-image">
        <div class="container">
            <?php echo get_the_post_thumbnail(get_the_ID()); ?>
        </div>
    </div>
<?php } ?>

<?php if (get_the_ID() == 475) { ?>
    <div class="full-slider hidden-xs">
        <div class="container">
            <?php if (function_exists('easingslider')) {
                easingslider(24256);
            } ?>
        </div>
    </div>
<?php } ?>

<?php if (get_the_ID() == 882) { ?>
    <div class="full-map">
        <div class="container">
            <input id="pac-input" placeholder="Enter your postcode or town">
            <div id="stockists-map"></div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNNRY2cakjBh1tldvEjD9pGnDSDH3XaQw&libraries=places"></script>
    <script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/assets/js/map.js"></script>
<?php } ?>

<div class="wrap container" role="document">
    <div class="content row">
        <main class="main <?php echo roots_main_class(); ?>" role="main">
            <?php include roots_template_path(); ?>
        </main><!-- /.main -->

        <?php if (roots_display_sidebar()) : ?>
            <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
                <?php include roots_sidebar_path(); ?>
            </aside><!-- /.sidebar -->
        <?php endif; ?>


        <?php if (is_product()) { ?>
            <script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/assets/js/jquery.zoom.min.js"></script>

            <div class="col-sm-12 may-also-like">

                <p class="title">You may also like</p>

                <div class="other-products">
                    <?php
                    echo do_shortcode('[recent_products per_page="10" columns="1" orderby="rand" order="rand"]');
                    ?>
                </div>

                <script>
                    jQuery(document).ready(function () {
                        jQuery('.other-products .products').bxSlider({
                            pager: false,
                            minSlides: 1,
                            maxSlides: 5,
                            slideWidth: 240,
                            slideMargin: 35,
                            moveSlides: 1,
                            nextText: '<i class="fa fa-angle-right"></i>',
                            prevText: '<i class="fa fa-angle-left"></i>'
                        });

                        if($(window).width() > 768) {
                          $('.main .bxslider a').each(function () {
                              $(this).zoom({
                                  magnify: 1,
                                  url: $(this).attr('href')
                              });
                          });
                        }

                    });
                </script>

            </div>

        <?php } ?>

    </div><!-- /.content -->
</div><!-- /.wrap -->

<?php get_template_part('templates/footer'); ?>

<?php if ($footer_html = of_get_option('footer_html', false)) echo $footer_html; ?>
<?php if ($footer_scripts = of_get_option('footer_scripts', false)) echo "<script>$footer_scripts</script>"; ?>
</body>
</html>
