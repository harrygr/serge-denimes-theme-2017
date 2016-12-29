<form role="search" method="get" class="search-form form-inline hidden-xs" action="<?php echo home_url('/'); ?>">

    <div class="header-search clearfix">

        <div class="input-group">

            <input type="search" value="<?php if (is_search()) {
                echo get_search_query();
            } ?>" name="s" class="search-field form-control input-sm" placeholder="Search">
            <label class="hide"><?php _e('Search for:', 'roots'); ?></label>

            <span class="input-group-btn">
                <button type="button" class="search-submit btn btn-default btn-sm"><i class="fa fa-search"></i></button>
            </span>

        </div>

    </div>

</form>
