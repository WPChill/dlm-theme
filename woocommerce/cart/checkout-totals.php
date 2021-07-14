<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<table cellspacing="0" class="shop_table shop_table_responsive">

		<tr class="cart-total">
			<th><?php _e( 'Your total today', 'woocommerce' ); ?></th>
			<td data-title="<?php esc_attr_e( 'Your total today', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html() ?></td>
		</tr>

	</table>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
