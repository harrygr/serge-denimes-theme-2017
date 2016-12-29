<header class="banner navbar navbar-default navbar-static-top" role="banner">
    <div class="container">
        <div class="navbar-header">

                <a href="" class="cart_link_url only-affix"><i class="fa fa-shopping-cart"></i></a>&nbsp;

                <img src="<?php header_image(); ?>" class="logo-mobile-affix" alt="Serge DeNimes"/>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

        </div>

        <nav class="collapse navbar-collapse" role="navigation">
            <?php
            function my_nav_wrap()
            {
                // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'

                // open the <ul>, set 'menu_class' and 'menu_id' values
                $wrap = '<ul id="%1$s" class="%2$s">';

                // get nav items as configured in /wp-admin/
                $wrap .= '%3$s';

                // the static link
                $wrap .= '<li class="cart_link_header only-fixed hidden-xs"><a href="javascript:void(0)">&nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;</a></li>';
                $wrap .= '<li class="search_header only-fixed hidden-xs"><a href="javascript:void(0)">&nbsp;&nbsp;&nbsp;<i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;</a></li>';
                $wrap .= '<li class="up_header only-fixed hidden-xs"><a href="javascript:void(0)">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;</a></li>';

                // close the <ul>
                $wrap .= '</ul>';
                // return the result
                return $wrap;
            }

            if (has_nav_menu('primary_navigation')) :
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary_navigation',
                        'menu_class' => 'nav navbar-nav',
                        'items_wrap' => my_nav_wrap()
                    )
                );
            endif;
            ?>
        </nav>
    </div>

    <div class="line"></div>
</header>
