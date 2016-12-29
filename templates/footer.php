<footer class="content-info" id="main-footer" role="contentinfo">
    <div class="container" id="footer-widgets">

        <nav class="collapse navbar-collapse" role="navigation">
            <?php if (has_nav_menu('footer_menu')) : ?>
                <div class="row">
                    <div class="colf-md-12">
                        <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'nav navbar-nav')); ?>
                    </div>
                </div>
            <?php endif; ?>
        </nav>

        <div class="top-buffer">
            <div class="line-1">
                <?php dynamic_sidebar('sidebar-footer'); ?>
            </div>

            <div class="line-2">
                <ul>
                    <li class="currency">
                        Currency:
                        <select>
                            <!--                            <option>($) AUS DOLLAR</option>-->
                            <!--                            <option>($) US DOLLAR</option>-->
                            <!--                            <option>(€) EURO</option>-->
                            <option>(£) POUND STERLING</option>
                        </select>
                    </li>
                    <li class="copy">&copy; Copyright Serge DeNimes <?php echo date('Y'); ?></li>
                    <li>
                        <!-- Begin MailChimp Signup Form -->
                        <div id="mc_embed_signup">
                            <form action="//sergedenimes.us4.list-manage.com/subscribe/post?u=02f15a1f5236415407f96f1de&amp;id=f9769405d2" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                    <label for="mce-EMAIL">NEWSLETTER:</label>
                                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="EMAIL" required>
                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_02f15a1f5236415407f96f1de_f9769405d2" tabindex="-1" value=""></div>
                                    <div class="clear hidden"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                                </div>
                            </form>
                        </div>

                        <!--End mc_embed_signup-->
                    </li>
                </ul>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
<?php
if (!$woocommerce) global $woocommerce;
?>
<script>
    $(function () {
        // use the custom woocommerce cookie to determine if the empty cart icon should show in the header or the full cart icon should show

        function resizeForAffix() {

            if ($(window).width() > 755 && $(window).scrollTop() > 160) {
                $('.archive aside.sidebar').css("left", parseInt($('.wrap.container').css("margin-right")));
                $('.blog aside.sidebar').css("left", parseInt($('.wrap.container').css("margin-right")));
                $('.single-post aside.sidebar').css("left", parseInt($('.wrap.container').css("margin-right")));
            } else {
                $('.archive aside.sidebar').attr("style", "");
                $('.archive aside.sidebar').removeClass('affix');
                $('.single-post aside.sidebar').removeClass('affix');

                $('.blog aside.sidebar').attr("style", "");
                $('.archive aside.sidebar').removeClass('affix');
                $('.single-post aside.sidebar').removeClass('affix');
            }

        }

        var cartCount = $.cookie("woocommerce_cart_count");
        var cartTotal = $.cookie("woocommerce_cart_total");
        if (typeof(cartTotal) === "undefined") cartTotal = "0.00";

        var cart_url = "<?php echo $woocommerce->cart->get_cart_url(); ?>";
        var shop_url = "<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>";

        if (typeof(cartCount) !== "undefined" && parseInt(cartCount, 10) > 0) {
            $('#micro-cart .cart_link').html(cartCount + ' items');
            $('#micro-cart .cart_link').attr('href', cart_url);
            $('#micro-cart .cart_link_url').attr('href', cart_url);
            $('.cart_link_header a').attr('href', cart_url);
        } else {
            $('#micro-cart .cart_link').html('Basket:');
            $('#micro-cart .cart_link').attr('href', cart_url);
            $('#micro-cart .cart_link_url').attr('href', cart_url);
            $('.cart_link_header a').attr('href', cart_url);
        }
        $('#micro-cart .cart_amount').html('&pound;' + cartTotal);

        $('.search-form.form-inline button').on('click', function () {
            $('.search-form.form-inline input').toggleClass('active');

            return false;
        });

        $('.dropdown-toggle').removeAttr('data-toggle');

        $('.archive aside.sidebar')
            .affix({offset: {top: 160}})
            .on('affix.bs.affix', function () {
                var margin = parseInt($('.container').css("margin-right"));
                $('.archive aside.sidebar').css("left", margin);
            })
            .on('affix-top.bs.affix', function () {
                $('.archive aside.sidebar').attr("style", "");
            });

        $('.blog aside.sidebar')
            .affix({offset: {top: 160}})
            .on('affix.bs.affix', function () {
                var margin = parseInt($('.container').css("margin-right"));
                $('.blog aside.sidebar').css("left", margin);
            })
            .on('affix-top.bs.affix', function () {
                $('.blog aside.sidebar').attr("style", "");
            });

        $('.single-post aside.sidebar')
            .affix({offset: {top: 160}})
            .on('affix.bs.affix', function () {
                var margin = parseInt($('.container').css("margin-right"));
                $('.single-post aside.sidebar').css("left", margin);
            })
            .on('affix-top.bs.affix', function () {
                $('.single-post aside.sidebar').attr("style", "");
            });

        $('.banner.navbar.navbar-default')
            .on('affix.bs.affix', function () {
                if ($(window).width() > 755) {
                    $('body').css('padding-top', '10px');
                }
            })
            .on('affix-top.bs.affix', function () {
                $('body').css('padding-top', '0');
            });

        resizeForAffix();

        $(window).resize(resizeForAffix);

        $(window).scroll(resizeForAffix);

        jQuery(document).ready(function ($) {
            jQuery('.products .pif-has-gallery>a:first-child').hover(function () {
                jQuery(this).children('.wp-post-image').removeClass('fadeInDown').addClass('animated fadeOutUp');
                jQuery(this).children('.secondary-image').width(jQuery(this).children('.wp-post-image').width());
                jQuery(this).children('.secondary-image').removeClass('fadeOutUp').addClass('animated fadeInDown');
            }, function () {
                jQuery(this).children('.wp-post-image').removeClass('fadeOutUp').addClass('fadeInDown');
                jQuery(this).children('.secondary-image').removeClass('fadeInDown').addClass('fadeOutUp');
            });
        });

        $('.up_header').click(function () {
            $("html, body").animate({scrollTop: 0}, 'slow');
        });

        $('.search_header').click(function () {
            $("html, body").animate({scrollTop: 0}, 'slow');

            if (!$('.search-form.form-inline .input-group input').hasClass('active')) {
                $('.search-submit').trigger('click');
            }

        });

        $('footer select').chosen({disable_search_threshold: 10});

        $('body.careers li').click(function () {
            $(this).find('ul').toggleClass('active');

            if ($(this).find('ul').hasClass('active')) {
                $(this).find('i').addClass('up').removeClass('down');
            } else {
                $(this).find('i').addClass('down').removeClass('up');
            }
        });

        var diffWeeks = 3;

        function isLocalStorageNameSupported() {
            var testKey = 'test', storage = window.localStorage;
            try {
                storage.setItem(testKey, '1');
                storage.removeItem(testKey);
                return true;
            } catch (error) {
                return false;
            }
        }

        if (isLocalStorageNameSupported() && typeof sessionStorage != "undefined" && sessionStorage.popupTime) {
            var past = new Date(sessionStorage.popupTime);
            var currentDate = new Date();

            var diffWeeks = Math.abs(Math.round((past - currentDate) / 604800000));
        }

        if (isLocalStorageNameSupported() && typeof sessionStorage != "undefined" && diffWeeks >= 3) {
            // $('.popup-newsletter').addClass('active');

            var currentDate = new Date();
            var dd = currentDate.getDate();
            var mm = currentDate.getMonth() + 1;

            if (dd < 10) {
                dd = '0' + dd
            }

            if (mm < 10) {
                mm = '0' + mm
            }

            currentDate = currentDate.getFullYear() + '-' + mm + '-' + dd;

            sessionStorage.popupTime = currentDate;
        }

        $('.popup-newsletter .close').click(function () {
            $('.popup-newsletter').removeClass('active');
        });

        // PHP Problem
        $("a.thumbnail").each(function () {
            $(this).attr('href', $(this).find('img').attr('src').replace(/-100x150/g, '').replace(/-225x150/g, ''));
        });

        $('body.blog .thumbnail').fancybox();

    });

</script>
