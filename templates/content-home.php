<?php
while (have_posts()):
    the_post(); ?>
    <?php
    the_content(); ?>
    <?php
endwhile; ?>

<?php

// Get the Latest Blog Post
$args = array('posts_per_page' => 1, 'meta_key' => '_thumbnail_id');
$posts = new WP_Query($args);

$image = '';
while ($posts->have_posts()) :
    $posts->the_post();
    if (has_post_thumbnail($post->ID)) {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'square');
    }
    $post_title = get_the_title();
    $post_permalink = get_permalink();
endwhile;
wp_reset_postdata();

$video_source = of_get_option('video_source');
?>

<!-- First Row -->
<div class="top-buffer row-one">
    <?php for ($i = 1; $i <= 3; $i++) { ?>
        <div class="img-container home-tile img-<?php echo $i; ?> <?php if ($i == 3) {
            echo 'hidden-xs';
        } ?>">
            <a href="<?php echo get_field('row_1_box_' . $i . '_link', get_the_ID()) ?>">
                <img class="<?php if ($i == 2) { echo 'img-2-mobile'; } ?>" src="<?php echo get_field('row_1_box_' . $i . '_image', get_the_ID()) ?>"/>

                <div class="info-container">
                    <p class="title"><?php echo get_field('row_1_box_' . $i . '_title', get_the_ID()) ?></p>
                    <p class="text"><?php echo get_field('row_1_box_' . $i . '_text', get_the_ID()) ?></p>
                </div>

                <?php if ($i == 2) { ?>
                    <img class="img-2-desktop" src="<?php echo get_field('row_1_box_' . $i . '_image', get_the_ID()) ?>"/>
                <?php } ?>
            </a>
        </div>
    <?php } ?>
</div>

<script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/assets/js/jquery.bxslider.js"></script>
<link href="<?php echo get_bloginfo('stylesheet_directory'); ?>/assets/css/jquery.bxslider.css" rel="stylesheet"/>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var instagramSettingsDesktop = {
            pager: false,
            minSlides: 4,
            maxSlides: 4,
            slideWidth: 300,
            slideMargin: 40,
            controls: false,
            auto: true,
            moveSlides: 1
        };

        var instagramSettingsTablet = {
            pager: false,
            minSlides: 1,
            maxSlides: 2,
            slideWidth: 240,
            slideMargin: 15,
            controls: false,
            auto: true,
            moveSlides: 1
        };

        var instagramSettingsMobile = {
            pager: false,
            minSlides: 1,
            maxSlides: 1,
            slideWidth: 322,
            slideMargin: 15,
            controls: false,
            auto: true,
            moveSlides: 1
        };

        function reloadInstagramSlider() {
            if ($(window).width() > 752) {
                sliderInstagram.reloadSlider(instagramSettingsDesktop);
                $('.instagram-container').after($('.products-container'));
            } else if ($(window).width() > 480) {
                sliderInstagram.reloadSlider(instagramSettingsTablet);
                $('.instagram-container').before($('.products-container'));
            } else {
                sliderInstagram.reloadSlider(instagramSettingsMobile);
                $('.instagram-container').before($('.products-container'));
            }
        }

        if ($(window).width() > 752) {
            var sliderInstagram = jQuery('.slider-instagram').bxSlider(instagramSettingsDesktop);
            $('.instagram-container').after($('.products-container'));
        } else if ($(window).width() > 480) {
            var sliderInstagram = jQuery('.slider-instagram').bxSlider(instagramSettingsTablet);
            $('.instagram-container').before($('.products-container'));
        } else {
            var sliderInstagram = jQuery('.slider-instagram').bxSlider(instagramSettingsMobile);
            $('.instagram-container').before($('.products-container'));
        }

        $(window).resize(reloadInstagramSlider);

        jQuery('.slider-product').bxSlider({
            pager: false,
            nextText: '<i class="fa fa-angle-right"></i>',
            prevText: '<i class="fa fa-angle-left"></i>',
            minSlides: 1,
            maxSlides: 1,
            slideWidth: 0,
            slideMargin: 0,
            controls: true,
            auto: true,
            moveSlides: 1,
            randomStart: false,
            preloadImages: 'all'
        });

    });
</script>

<!-- Second Row -->
<div class="top-buffer row-two">
    <div class="instagram-container">
        <div>
            <a href="<?php echo get_field('sale_artwork_url', get_the_ID()) ?>" class="sale-artwork hidden-xs">
                <img src="<?php echo get_field('sale_artwork', get_the_ID()) ?>" alt="">
            </a>

            <div>
                <ul class="slider-instagram">
                    <?php foreach (get_media_instagram_by_user_id(189388501, 10) as $instagram_image) { ?>
                        <li>
                            <a href="<?php echo $instagram_image['link'] ?>" target="_blank">
                                <img src="<?php echo $instagram_image['image'] ?>" alt="<?php echo $instagram_image['description'] ?>">
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="products-container">
        <ul class="slider-product">
            <?php
            $array_images = array();
            for ($i = 1; $i <= 5; $i++) {
                $array_images[] = array(
                    new WC_product(get_field("products_link_$i", get_the_ID())->ID),
                    get_field("products_image_$i", get_the_ID())
                );
            }
            shuffle($array_images);
            foreach ($array_images as $array_image) {
                if ($array_image[0] && $array_image[1]) {
                    ?>
                    <li>
                        <a href="<?php echo $array_image[0]->get_permalink(); ?>">
                            <p><?php echo $array_image[0]->get_title() ?></p>
                            <img src="<?php echo $array_image[1] ?>" alt="<?php echo $array_image[0]->get_title() ?>"/>
                        </a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>


<div class="row top-buffer row-three">
    <div class="home-second-row iframe hidden-xs">
        <a href="<?php echo get_field('student_discount_url', get_the_ID()); ?>">
            <img src="<?php echo get_field('student_discount_image', get_the_ID()); ?>">
        </a>
    </div>

    <div class="home-second-row video">
        <div class="home-video">
            <?php if ('youtube' == $video_source) : ?>
                <iframe width="616" height="347" src="//www.youtube.com/embed/<?php echo of_get_option('home_video_id'); ?>" frameborder="0" allowfullscreen></iframe>
            <?php elseif ('vimeo' == $video_source) : ?>
                <iframe src="//player.vimeo.com/video/<?php echo of_get_option('home_video_id'); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="616" height="347" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php if ((of_get_option('enable_popup_video'))) : ?>
    <script>

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

	if(isLocalStorageNameSupported()) {
		var hours = 730;
		var now = new Date().getTime();
		var setupTime = localStorage.setupTime;

		if (setupTime == null) {
		    localStorage.popupTime = now;
		} else {
		    if(now - setupTime > hours*60*60*1000) {
		        localStorage.video = false;
	        	localStorage.setupTime = now;
		    }
		}
	}

	// Remove false to enable the video popup
        if (false && isLocalStorageNameSupported() && typeof sessionStorage != "undefined" && localStorage.video !== "true") {
            localStorage.video = true;

            var video_url = '<?php if ("youtube" == of_get_option("popup_video_source")) {
                echo "//www.youtube.com/embed/" . of_get_option("popup_video_id");
            } else {
                echo "//player.vimeo.com/video/" . of_get_option("popup_video_id");
            } ?>';

            $(document).ready(function () {
                $.fancybox({
                    autoPlay: false,
                    width: '90%',
                    height: '90%',
                    autoScale: true,
                    transitionIn: 'fade',
                    transitionOut: 'fade',
                    type: 'iframe',
                    padding: 0,
                    title: false,
                    helpers: {
                        media: true
                    },
                    href: video_url,
                    youtube: {
                        autoplay: 1
                    },
                    vimeo: {
                        autoplay: 1
                    }
                });
            });
        }
    </script>
<?php endif; ?>
