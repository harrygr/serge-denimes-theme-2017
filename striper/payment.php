<?php
/*
 * Title   : Stripe Payment extension for WooCommerce
 * Author  : Sean Voss
 * Url     : http://seanvoss.com/woostriper
 * License : http://seanvoss.com/woostriper/legal
 */
?>
<div class="row stripe-form">
  <div class="col-md-8">

    <div id="stripe_pub_key" class="hidden" style="display:none" data-publishablekey="<?=$this->publishable_key ?>"> </div>

        <p class='payment-errors required'></p>
    <div class="row">
      <div class="form-row col-md-8 form-group">
        <label>Card Number <span class="required">*</span></label>
        <input id="checkout_card_number" class="input-text form-control" type="text" size="19" maxlength="19" data-stripe="number" />
      </div>
      <div class="col-md-4">
        <ul class="cc">
          <li class="mastercard"></li>
          <li class="visa"></li>
          <li class="amex"></li>
<!--           <li class="discover"></li>
          <li class="jcb"></li>
          <li class="diners"></li> -->
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="form-row form-row-first form-group col-md-4 col-sm-6">
        <label>Expiration Month <span class="required">*</span></label>
        <select data-stripe="exp-month" class="form-control">
          <option value=1>01</option>
          <option value=2>02</option>
          <option value=3>03</option>
          <option value=4>04</option>
          <option value=5>05</option>
          <option value=6>06</option>
          <option value=7>07</option>
          <option value=8>08</option>
          <option value=9>09</option>
          <option value=10>10</option>
          <option value=11>11</option>
          <option value=12>12</option>
        </select>
      </div>
      <div class="form-row form-row-last form-group col-md-4 col-sm-6">
        <label>Expiration Year  <span class="required">*</span></label>
        <select data-stripe="exp-year" class="form-control">
          <?php
          $today = (int)date('Y', time());
          for($i = 0; $i < 10; $i++)
          {
            ?>
            <option value="<?php echo $today; ?>"><?php echo $today; ?></option>
            <?php
            $today++;
          }
          ?>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="form-row form-row-first form-group col-md-4 col-sm-6">
        <label>Card Verification Number <span class="required">*</span></label>
        <input class="input-text form-control" type="text" maxlength="4" data-stripe="cvc" value="" />
      </div>
      <div class="col-md-12"><p>Payment is processed securely by <a href="https://stripe.com/gb" target="_blank">Stripe</a>. <?php bloginfo( 'name' ); ?> does not store your card details.</p></div>
    </div>

  </div>
</div>

<script>

var initStriper = function(){
  jQuery(function($) {
    var $form = $('form.checkout,form#order_review');

    // Add additional information to be passed to Stripe
    var stripeMap = {

      billing_address_1:  'address_line1',
      billing_address_2:  'address_line2',
      billing_city:       'address_city',
      billing_country:    'address_country',
      billing_state:      'address_state',
      billing_postcode:   'address_zip',
    }
    var card_name = '';
    $('form.checkout').find('input[id*=billing_],select[id*=billing_]').each(function(idx,el){
      var mapped = stripeMap[el.id];
      if (mapped)
      {
        $(el).attr('data-stripe',mapped);

      }
      if(el.id == 'billing_first_name' || el.id == 'billing_last_name')
      {
        card_name += $(el).val() + ' ';
      }


    });
    if (!$('#stripeCardName').length)
    {
      $('<input id="stripeCardName" class="input-text" type="hidden" data-stripe="name" value="'+card_name+'"/>').appendTo($form);
    }

    var stripeResponseHandler = function(status, response) {

      if (response.error) {

      // Show the errors on the form
      $form.find('.payment-errors').text(response.error.message);
      // Unblock the form to re-enter data
      $form.unblock();

    } else {
      // Append the Token
      $form.append($('<input type="hidden" name="stripeToken" />').val(response.id));

      //Re-Submit
      $form.submit();

    }
  };

  $('body').on('click', '#place_order,form#order_review input:submit', function(){
    if(jQuery('.payment_methods input:checked').val() !== 'Striper')
    {
      return true;
    }

      // Make sure there's not an old token on the form
      Stripe.setPublishableKey($('#stripe_pub_key').data('publishablekey'));
      Stripe.createToken($form, stripeResponseHandler);
      return false;
    });


  $('body').on('click', '#place_order,form.checkout input:submit', function(){
    if(jQuery('.payment_methods input:checked').val() !== 'Striper')
    {
      return true;
    }
      // Make sure there's not an old token on the form
      $('form.checkout').find('[name=stripeToken]').remove()
    })


    // Bind to the checkout_place_order event to add the token
    $('form.checkout').bind('#place_order,checkout_place_order_Striper', function(e){

      if($('input[name=payment_method]:checked').val() != 'Striper'){
        return true;
      }

      $form.find('.payment-errors').html('');
      $form.block({message: null,overlayCSS: {background: "#fff url(" + woocommerce_params.ajax_loader_url + ") no-repeat center",backgroundSize: "16px 16px",opacity: .6}});

      // Pass if we have a token
      if( $form.find('[name=stripeToken]').length)
        return true;

      Stripe.setPublishableKey($('#stripe_pub_key').data('publishablekey'));
      Stripe.createToken($form, stripeResponseHandler)
      // Prevent the form from submitting with the default action
      return false;
    });
  });
};

if(typeof jQuery=='undefined')
{
  var headTag = document.getElementsByTagName("head")[0];
  var jqTag = document.createElement('script');
  jqTag.type = 'text/javascript';
  jqTag.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js';
  jqTag.onload = initStriper;
  headTag.appendChild(jqTag);
} else {
 initStriper()
}

(function ($) {
  $.fn.creditCardTypeDetector = function (options) {
    var settings = $.extend({
      'credit_card_logos_id': '.card_logos'
    }, options),

                // the object that contains the logos
                logos_obj = $(settings.credit_card_logos_id),

                // the regular expressions check for possible matches as you type, hence the OR operators based on the number of chars
                // Visa
                visa_regex = new RegExp('^4[0-9]{0,15}$'),

                // MasterCard
                mastercard_regex = new RegExp('^5$|^5[1-5][0-9]{0,14}$'),

                // American Express
                amex_regex = new RegExp('^3$|^3[47][0-9]{0,13}$'),

                // Diners Club
                diners_regex = new RegExp('^3$|^3[068]$|^3(?:0[0-5]|[68][0-9])[0-9]{0,11}$'),

                //Discover
                discover_regex = new RegExp('^6$|^6[05]$|^601[1]?$|^65[0-9][0-9]?$|^6(?:011|5[0-9]{2})[0-9]{0,12}$'),

                //JCB
                jcb_regex = new RegExp('^2[1]?$|^21[3]?$|^1[8]?$|^18[0]?$|^(?:2131|1800)[0-9]{0,11}$|^3[5]?$|^35[0-9]{0,14}$');

                return this.each(function () {
                // as the user types
                $(this).keyup(function () {
                  var cur_val = $(this).val();

                    // get rid of spaces and dashes before using the regular expression
                    cur_val = cur_val.replace(/ /g, '').replace(/-/g, '');

                    // checks per each, as there could be multiple hits
                    if (cur_val.match(visa_regex)) {
                      $('.visa').addClass('is_card');
                    } else {
                      $('.visa').removeClass('is_card');
                    }

                    if (cur_val.match(amex_regex)) {
                      $('.amex').addClass('is_card');
                    } else {
                      $('.amex').removeClass('is_card');
                    }

                    if (cur_val.match(mastercard_regex)) {
                      $('.mastercard').addClass('is_card');
                    } else {
                      $('.mastercard').removeClass('is_card');
                    }

                    if (cur_val.match(discover_regex)) {
                      $('.discover').addClass('is_card');
                    } else {
                      $('.discover').removeClass('is_card');
                    }

                    if (cur_val.match(jcb_regex)) {
                      $('.jcb').addClass('is_card');
                    } else {
                      $('.jcb').removeClass('is_card');
                    }
                    if (cur_val.match(diners_regex)) {
                      $('.diners').addClass('is_card');
                    } else {
                      $('.diners').removeClass('is_card');
                    }
                  });
});
};
})(jQuery);

jQuery(function($){
  $('#checkout_card_number').creditCardTypeDetector({
    'credit_card_logos': '.cc'
  });
});



</script>
