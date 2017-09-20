<?php
$management_status = get_option('usces_management_status');

$oa = 'editpost';

$ID = $_REQUEST['member_id'];
$member_metas = $usces->get_member_meta($ID);
ksort($member_metas);
global $wpdb;

$tableName = $wpdb->prefix . "usces_member";
$query = $wpdb->prepare("SELECT * FROM $tableName WHERE ID = %d", $ID);
$data = $wpdb->get_row( $query, ARRAY_A );

$usces_member_history = $usces->get_member_history($ID);

//$deli = unserialize($data['order_delivery']);
//$cart = unserialize($data['order_cart']);
//$condition = unserialize($data['order_condition']);
//$ordercheck = unserialize($data['order_check']);
//if( !is_array($ordercheck) ) $ordercheck = array();
//
//if($usces->is_status('duringorder', $data['order_status']))
//	$taio = 'duringorder';
//else if($usces->is_status('cancel', $data['order_status']))
//	$taio = 'cancel';
//else if($usces->is_status('completion', $data['order_status']))
//	$taio = 'completion';
//else
//	$taio = 'new';
//	
//if($usces->is_status('estimate', $data['order_status']))
//	$admin = 'estimate';
//else if($usces->is_status('adminorder', $data['order_status']))
//	$admin = 'adminorder';
//else
//	$admin = '';
//
//if($usces->is_status('noreceipt', $data['order_status']))
//	$receipt = 'noreceipt';
//else if($usces->is_status('receipted', $data['order_status']))
//	$receipt = 'receipted';
//else
//	$receipt = '';

?>
<div class="wrap">
<div class="usces_admin">

<h1>Welcart Management <?php _e('Edit continue member data','usces'); ?></h1>
<p class="version_info">Version <?php echo WCEX_DLSELLER_VERSION; ?></p>
<?php usces_admin_action_status(); ?>

<form action="<?php echo USCES_ADMIN_URL.'?page=usces_memberlist&member_action='.$oa; ?>" method="post" name="editpost">
<div class="ordernavi"><input name="upButton" class="upButton" type="submit" value="<?php _e('change decision', 'usces'); ?>" /><?php _e("When you change amount, please click 'Edit' before you finish your process.", 'usces'); ?></div>
<div class="info_head">
<div class="error_message"><?php echo $usces->error_message; ?></div>
<table class="mem_wrap">
<tr>
<td class="label"><?php _e('membership number', 'usces'); ?></td><td class="col1"><div class="rod large short"><?php echo $data['ID']; ?></div></td>
<td colspan="2" rowspan="5" class="mem_col2">
<table class="mem_info">
		<tr>
				<td class="label">e-mail</td>
				<td><input name="mem_email" type="text" class="text long" value="<?php echo esc_attr($data['mem_email']); ?>" /></td>
		</tr>
		<tr>
				<td class="label"><?php _e('name', 'usces'); ?></td>
				<td><input name="mem_name1" type="text" class="text short" value="<?php echo esc_attr($data['mem_name1']); ?>" />		<input name="mem_name2" type="text" class="text short" value="<?php echo esc_attr($data['mem_name2']); ?>" /></td>
		</tr>
		<tr>
				<td class="label"><?php _e('furigana', 'usces'); ?></td>
				<td><input name="mem_name3" type="text" class="text short" value="<?php echo esc_attr($data['mem_name3']); ?>" />		<input name="mem_name4" type="text" class="text short" value="<?php echo esc_attr($data['mem_name4']); ?>" /></td>
		</tr>
		<tr>
				<td class="label"><?php _e('Zip/Postal Code', 'usces'); ?></td>
				<td><span class="col2">
						<input name="mem_zip" type="text" class="text short" value="<?php echo esc_attr($data['mem_zip']); ?>" />
				</span></td>
		</tr>
		<tr>
				<td class="label"><?php _e('Province', 'usces'); ?></td>
				<td><span class="col2">
						<select name="mem_pref" class="select">
								<?php
//	$prefs = get_option('usces_pref');
	$prefs = $usces->options['province'];
foreach((array)$prefs as $value) {
	$selected = ($data['mem_pref'] == $value) ? ' selected="selected"' : '';
	echo "\t<option value='" . esc_attr($value) . "'{$selected}>" . esc_html($value) . "</option>\n";
}
?>
						</select>
				</span></td>
		</tr>
		<tr>
				<td class="label"><?php _e('city', 'usces'); ?></td>
				<td><span class="col2">
						<input name="mem_address1" type="text" class="text long" value="<?php echo esc_attr($data['mem_address1']); ?>" />
				</span></td>
		</tr>
		<tr>
				<td class="label"><?php _e('numbers', 'usces'); ?></td>
				<td><span class="col2">
						<input name="mem_address2" type="text" class="text long" value="<?php echo esc_attr($data['mem_address2']); ?>" />
				</span></td>
		</tr>
		<tr>
				<td class="label"><?php _e('building name', 'usces'); ?></td>
				<td><span class="col2">
						<input name="mem_address3" type="text" class="text long" value="<?php echo esc_attr($data['mem_address3']); ?>" />
				</span></td>
		</tr>
		<tr>
				<td class="label"><?php _e('Phone number', 'usces'); ?></td>
				<td><input name="mem_tel" type="text" class="text long" value="<?php echo esc_attr($data['mem_tel']); ?>" /></td>
		</tr>
		<tr>
				<td class="label"><?php _e('FAX number', 'usces'); ?></td>
				<td><input name="mem_fax" type="text" class="text long" value="<?php echo esc_attr($data['mem_fax']); ?>" /></td>
		</tr>
</table>
</td>
<td colspan="2" rowspan="5" class="mem_col3">
<table class="mem_info">
<?php foreach($member_metas as $value){ ?>
		<tr>
				<td class="label"><?php echo esc_html($value['meta_key']); ?></td>
				<td><div class="rod_left"><?php echo esc_html($value['meta_value']); ?></div></td>
		</tr>
<?php } ?>
</table>


</td>
		</tr>
<tr>
<td class="label"><?php _e('Rank', 'usces'); ?></td><td class="col1"><select name="mem_status">
<?php 
	foreach ((array)$usces->member_status as $rk => $rv) {
		$selected = ($rk == $data['mem_status']) ? ' selected="selected"' : '';
?>
    <option value="<?php echo esc_attr($rk); ?>"<?php echo $selected; ?>><?php echo esc_html($rv); ?></option>
<?php } ?>
</select></td>
</tr>
<tr>
<td class="label"><?php _e('current point', 'usces'); ?></td><td class="col1"><input name="mem_point" type="text" class="text right short" value="<?php echo esc_attr($data['mem_point']); ?>" /></td>
<?php if( USCES_JP ): ?>
<?php endif; ?>
</tr>
<tr>
<td class="label"><?php _e('Strated date', 'usces'); ?></td><td class="col1"><div class="rod shortm"><?php echo sprintf(__('%2$s %3$s, %1$s', 'usces'),substr($data['mem_registered'],0,4),substr($data['mem_registered'],5,2),substr($data['mem_registered'],8,2)); ?></div></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</table>
</div>
<div id="member_history">
<table>
<?php if ( !count($usces_member_history) ) : ?>
<tr>
<td><?php _e('There is no purchase history for this moment.', 'usces'); ?></td>
</tr>
<?php endif; ?>
<?php foreach ( (array)$usces_member_history as $umhs ) :	$cart = $umhs['cart']; ?>
<tr>
<th class="historyrow"><?php _e('Purchase date', 'usces'); ?></th>
<th class="historyrow"><?php _e('Purchase price', 'usces'); ?></th>
<th class="historyrow"><?php _e('Used points','usces'); ?></th>
<th class="historyrow"><?php _e('Special Price', 'usces'); ?></th>
<th class="historyrow"><?php _e('Shipping', 'usces'); ?></th>
<th class="historyrow"><?php _e('C.O.D', 'usces'); ?></th>
<th class="historyrow"><?php _e('consumption tax', 'usces'); ?></th>
<th class="historyrow"><?php _e('Acquired points', 'usces'); ?></th>
</tr>
<tr>
<td><?php echo $umhs['date']; ?></td>
<td class="rightnum"><?php echo number_format($usces->get_total_price($cart)-$umhs['usedpoint']+$umhs['discount']+$umhs['shipping_charge']+$umhs['cod_fee']+$umhs['tax']); ?></td>
<td class="rightnum"><?php echo number_format($umhs['usedpoint']); ?></td>
<td class="rightnum"><?php echo number_format($umhs['discount']); ?></td>
<td class="rightnum"><?php echo number_format($umhs['shipping_charge']); ?></td>
<td class="rightnum"><?php echo number_format($umhs['cod_fee']); ?></td>
<td class="rightnum"><?php echo number_format($umhs['tax']); ?></td>
<td class="rightnum"><?php echo number_format($umhs['getpoint']); ?></td>
</tr>
<tr>
<td class="retail" colspan="8">
	<table id="retail_table">
	<tr>
	<th scope="row" class="num"><?php echo __('No.','usces'); ?></th>
	<th class="thumbnail">&nbsp;</th>
	<th><?php _e('Items','usces'); ?></th>
	<th class="price "><?php _e('Unit price','usces'); ?></th>
	<th class="quantity"><?php _e('Quantity','usces'); ?></th>
	<th class="subtotal"><?php _e('Amount','usces'); ?></th>
	</tr>
<?php
for($i=0; $i<count($cart); $i++) { 
	$cart_row = $cart[$i];
	$post_id = $cart_row['post_id'];
	$sku = $cart_row['sku'];
	$quantity = $cart_row['quantity'];
	$options = $cart_row['options'];
	$itemCode = $usces->getItemCode($post_id);
	$itemName = $usces->getItemName($post_id);
	$cartItemName = $usces->getCartItemName($post_id, $sku);
	$skuPrice = $usces->getItemPrice($post_id, $sku);
	$pictids = $usces->get_pictids($itemCode);
	$optstr =  '';
	foreach((array)$options as $key => $value){
		$optstr .= esc_html($key) . ' : ' . esc_html($value) . "<br />\n"; 
	}
	$materials = compact( 'i', 'cart_row', 'post_id', 'sku', 'sku_code', 'quantity', 'options',
						'itemCode', 'itemName', 'cartItemName', 'skuPrice', 'pictids'  );
	?>
	<tr>
	<td><?php echo $i + 1; ?></td>
	<td><?php echo wp_get_attachment_image( $pictids[0], array(60, 60), true ); ?></td>
	<td class="aleft">
<?php echo apply_filters('usces_filter_admin_cart_item_name', esc_html($cartItemName), $materials ); ?><br /><?php echo $optstr; ?></td>
	<td class="rightnum"><?php echo number_format($skuPrice); ?></td>
	<td class="rightnum"><?php echo number_format($cart_row['quantity']); ?></td>
	<td class="rightnum"><?php echo number_format($skuPrice * $cart_row['quantity']); ?></td>
	</tr>
<?php 
}
?>
	</table>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>
<input name="member_action" type="hidden" value="<?php echo $oa; ?>" />
<input name="member_id" id="member_id" type="hidden" value="<?php echo $data['ID']; ?>" />


<div id="mailSendAlert" title="">
	<div id="order-response"></div>
	<fieldset>
	</fieldset>
</div>

</form>

</div><!--usces_admin-->
</div><!--wrap-->
