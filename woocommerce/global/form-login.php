<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) 
	return;
?>
<div class="row">
	<div class="col-md-6">

<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

	<div class="form-group">
		<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="text" class="form-control" name="username" id="username" />
	</div>
	<div class="form-group">
		<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input class="form-control" type="password" name="password" id="password" />
	</div>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="form-group">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<input type="submit" class="button btn btn-success" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
		<label for="rememberme" class="inline">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
		</label>
	</div>
	<p class="lost_password">
		<a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>
		
	</div>
</div>