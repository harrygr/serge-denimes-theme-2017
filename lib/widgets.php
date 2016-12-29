<?php
/**
 * Register sidebars and widgets
 */
function roots_widgets_init() {
  // Sidebars
  register_sidebar(array(
    'name'          => __('Primary', 'roots'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title sub-heading">',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Footer', 'roots'),
    'id'            => 'sidebar-footer',
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  ));
  register_sidebar(array(
    'name'          => __('Footer', 'roots'),
    'id'            => 'sidebar-footer2',
    'before_widget' => '<section class="widget col-md-4 col-sm-5 %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Shop', 'roots'),
    'id'            => 'sidebar-shop',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));

  // Widgets
  register_widget('Roots_Vcard_Widget');
}
add_action('widgets_init', 'roots_widgets_init');

/**
 * Example vCard widget
 */
class Roots_Vcard_Widget extends WP_Widget {
  private $fields = array(
    'title'          => 'Title (optional)',
    'street_address' => 'Street Address',
    'locality'       => 'City/Locality',
    'region'         => 'State/Region',
    'postal_code'    => 'Zipcode/Postal Code',
    'tel'            => 'Telephone',
    'email'          => 'Email'
  );

  function __construct() {
    $widget_ops = array('classname' => 'widget_roots_vcard', 'description' => __('Use this widget to add a vCard', 'roots'));

    $this->WP_Widget('widget_roots_vcard', __('Roots: vCard', 'roots'), $widget_ops);
    $this->alt_option_name = 'widget_roots_vcard';

    add_action('save_post', array(&$this, 'flush_widget_cache'));
    add_action('deleted_post', array(&$this, 'flush_widget_cache'));
    add_action('switch_theme', array(&$this, 'flush_widget_cache'));
  }

  function widget($args, $instance) {
    $cache = wp_cache_get('widget_roots_vcard', 'widget');

    if (!is_array($cache)) {
      $cache = array();
    }

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? __('vCard', 'roots') : $instance['title'], $instance, $this->id_base);

    foreach($this->fields as $name => $label) {
      if (!isset($instance[$name])) { $instance[$name] = ''; }
    }

    echo $before_widget;

    if ($title) {
      echo $before_title, $title, $after_title;
    }
  ?>
    <p class="vcard">
      <a class="fn org url" href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a><br>
      <span class="adr">
        <span class="street-address"><?php echo $instance['street_address']; ?></span><br>
        <span class="locality"><?php echo $instance['locality']; ?></span>,
        <span class="region"><?php echo $instance['region']; ?></span>
        <span class="postal-code"><?php echo $instance['postal_code']; ?></span><br>
      </span>
      <span class="tel"><span class="value"><?php echo $instance['tel']; ?></span></span><br>
      <a class="email" href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a>
    </p>
  <?php
    echo $after_widget;

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_roots_vcard', $cache, 'widget');
  }

  function update($new_instance, $old_instance) {
    $instance = array_map('strip_tags', $new_instance);

    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');

    if (isset($alloptions['widget_roots_vcard'])) {
      delete_option('widget_roots_vcard');
    }

    return $instance;
  }

  function flush_widget_cache() {
    wp_cache_delete('widget_roots_vcard', 'widget');
  }

  function form($instance) {
    foreach($this->fields as $name => $label) {
      ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id($name)); ?>"><?php _e("{$label}:", 'roots'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
    </p>
    <?php
    }
  }
}

if ( !is_admin() ){
add_filter('sidebars_widgets', 'hidemywidget');
}
function hidemywidget($all_widgets)
{
$widget_key_men_menu='nav_menu-7';
$widget_key_women_menu='nav_menu-8';

	if (is_tax('product_cat')) {

		$top_term=get_top_level_term(get_queried_object(),'product_cat');
		if($top_term->term_id==140){
	        foreach ($all_widgets['sidebar-shop'] as $i => $inst)
        {

         
            if($inst== $widget_key_women_menu)
            {
                
                unset($all_widgets['sidebar-shop'][$i]);
            }
        }
		}else{
	        foreach ($all_widgets['sidebar-shop'] as $i => $inst)
        {

         
            if($inst== $widget_key_men_menu)
            {
                
                unset($all_widgets['sidebar-shop'][$i]);
            }
        }
		}
  }else{
		$post_id=get_the_ID();
		$terms = wp_get_post_terms( $post_id, 'product_cat' );
		if(!empty($terms)){
    $top_term=get_top_level_term($terms[0],'product_cat');
		if($top_term->term_id==140){
	        foreach ($all_widgets['sidebar-shop'] as $i => $inst)
        {

         
            if($inst== $widget_key_women_menu)
            {
                
                unset($all_widgets['sidebar-shop'][$i]);
            }
        }
		}else{
	        foreach ($all_widgets['sidebar-shop'] as $i => $inst)
        {

         
            if($inst== $widget_key_men_menu)
            {
                
                unset($all_widgets['sidebar-shop'][$i]);
            }
        }
		}
		}else{
			
	        foreach ($all_widgets['sidebar-shop'] as $i => $inst)
        {

         
            if($inst== $widget_key_men_menu || $inst== $widget_key_women_menu)
            {
                
                unset($all_widgets['sidebar-shop'][$i]);
            }
        }			
		}
		

	
}

    return $all_widgets;
}
function get_top_level_term($term,$taxonomy){
    if($term->parent==0) return $term;
    $parent = get_term( $term->parent,$taxonomy);
    return get_top_level_term( $parent , $taxonomy );
}