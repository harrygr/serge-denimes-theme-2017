<?php

/**
 * Change In Stock / Out of Stock Text
 */
function wcs_custom_get_availability($availability, $_product) {

  if (get_the_ID() == 34453 && $_product->is_in_stock()) {
    $availability['availability'] = __('In Stock', 'woocommerce') . ': ' . $_product->get_stock_quantity();
  }

  return $availability;
}

add_filter('woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
