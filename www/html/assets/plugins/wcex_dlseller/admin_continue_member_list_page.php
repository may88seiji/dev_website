<?php
require_once( USCES_WP_PLUGIN_DIR.'/'.plugin_basename(dirname(__FILE__))."/continueMemberList.class.php" );

$DT = new ContinuationList();
$arr_column = $DT->get_column();
$res = $DT->MakeTable();

$arr_search = $DT->GetSearchs();
$arr_header = $DT->GetListheaders();
$dataTableNavigation = $DT->GetDataTableNavigation();
$rows = $DT->rows;
$status = $DT->get_action_status();
$message = $DT->get_action_message();
$status = ( isset($usces->action_status) && 'none' != $usces->action_status ) ? $usces->action_status : apply_filters( 'dlseller_continue_member_list_action_status', $status );
$message = ( isset($usces->action_message) ) ? $usces->action_message : apply_filters( 'dlseller_continue_member_list_action_message', $message );

$usces_admin_path = '';
$admin_perse = explode('/', $_SERVER['REQUEST_URI']);
$apct = count($admin_perse) - 1;
for( $ap = 0; $ap < $apct; $ap++ ) {
	$usces_admin_path .= $admin_perse[$ap].'/';
}
$list_option = get_option( 'usces_continuelist_option' );
$payment_structure = get_option( 'usces_payment_structure' );
$curent_url = urlencode(esc_url(USCES_ADMIN_URL.'?'.$_SERVER['QUERY_STRING']));

$dlseller_opt_continue = get_option( 'dlseller_opt_continue' );
$dlseller_opt_continue = apply_filters( 'dlseller_filter_opt_continue', $dlseller_opt_continue );
$chk_con = ( isset($dlseller_opt_continue['chk_con']) ) ? $dlseller_opt_continue['chk_con'] : array();
$applyform = usces_get_apply_addressform( $usces->options['system']['addressform'] );
?>
<div class="wrap">
<div class="usces_admin">
<h1>Welcart Management <?php _e('Continue Members','dlseller'); ?></h1>
<p class="version_info">Version <?php echo WCEX_DLSELLER_VERSION; ?></p>
<?php usces_admin_action_status( $status, $message ); ?>

<form action="<?php echo USCES_ADMIN_URL.'?page=usces_continue'; ?>" method="post" name="tablesearch" id="form_tablesearch">
<div id="datatable">
<div class="usces_tablenav usces_tablenav_top">
	<?php echo $dataTableNavigation ?>
	<div id="searchVisiLink" class="screen-field"><?php _e('Show the Operation field', 'usces'); ?><span class="dashicons dashicons-arrow-down"></span></div>
	<div class="refresh"><a href="<?php echo site_url('/wp-admin/admin.php?page=usces_continue&refresh'); ?>"><span class="dashicons dashicons-update"></span><?php _e('updates it to latest information', 'usces'); ?></a></div>
</div>

<?php do_action( 'dlseller_action_continue_member_list_table_header' ); ?>
<div id="tablesearch" class="usces_tablesearch">
<div id="searchBox">

	<table class="search_table">
	<tr>
		<td class="label"><?php _e( 'Order Search', 'usces' ); ?></td>
		<td>
			<div class="order_search_item search_item">
				<p class="search_item_label"><?php _e('From order information', 'usces'); ?></p>
				<p>
					<select name="search[order_column][0]" id="searchorderselect_0" class="searchselect">
						<option value=""> </option>
					<?php foreach( (array)$arr_column as $key => $value ):
							if( 'ID' == $key ) {
								continue;
							}
							$selected = ( $key == $arr_search['order_column'][0] ) ? ' selected="selected"' : ''; ?>
						<option value="<?php echo esc_attr($key); ?>"<?php echo $selected; ?>><?php echo esc_html($value); ?></option>
					<?php endforeach; ?>
					</select>
					<span id="searchorderword_0">
					<input name="search[order_word][0]" type="text" value="<?php echo esc_attr($arr_search['order_word'][0]); ?>" class="regular-text" maxlength="50" />
					<select name="search[order_word_term][0]" class="termselect">
						<option value="contain"<?php echo ( 'contain' == $arr_search['order_word_term'][0] ? ' selected="selected"' : '' ); ?>><?php _e('Contain', 'usces'); ?></option>
						<option value="notcontain"<?php echo ( 'notcontain' == $arr_search['order_word_term'][0] ? ' selected="selected"' : '' ); ?>><?php _e('Not Contain', 'usces'); ?></option>
						<option value="equal"<?php echo ( 'equal' == $arr_search['order_word_term'][0] ? ' selected="selected"' : '' ); ?>><?php _e('Equal', 'usces'); ?></option>
						<option value="morethan"<?php echo ( 'notcontain' == $arr_search['order_word_term'][0] ? ' selected="selected"' : '' ); ?>><?php _e('More than', 'usces'); ?></option>
						<option value="lessthan"<?php echo ( 'lessthan' == $arr_search['order_word_term'][0] ? ' selected="selected"' : '' ); ?>><?php _e('Less than', 'usces'); ?></option>
					</select>
					</span>
				</p>
				<p>
					<select name="search[order_term]" class="termselect">
						<option value="AND">AND</option>
						<option value="OR"<?php echo ( 'OR' == $arr_search['order_term'] ? ' selected="selected"' : '' ); ?>>OR</option>
					</select>
				</p>
				<p>
					<select name="search[order_column][1]" id="searchorderselect_1" class="searchselect">
						<option value=""> </option>
					<?php foreach( (array)$arr_column as $key => $value ):
							if( 'ID' == $key ) {
								continue;
							}
							$selected = ($key == $arr_search['order_column'][1]) ? ' selected="selected"' : ''; ?>
						<option value="<?php echo esc_attr($key); ?>"<?php echo $selected; ?>><?php echo esc_html($value); ?></option>
					<?php endforeach; ?>
					</select>
					<span id="searchorderword_1">
					<input name="search[order_word][1]" type="text" value="<?php echo esc_attr($arr_search['order_word'][1]); ?>" class="regular-text" maxlength="50" />
					<select name="search[order_word_term][1]" class="termselect">
						<option value="contain"<?php echo ( 'contain' == $arr_search['order_word_term'][1] ? ' selected="selected"' : '' ); ?>><?php _e('Contain', 'usces'); ?></option>
						<option value="notcontain"<?php echo ( 'notcontain' == $arr_search['order_word_term'][1] ? ' selected="selected"' : '' ); ?>><?php _e('Not Contain', 'usces'); ?></option>
						<option value="equal"<?php echo ( 'equal' == $arr_search['order_word_term'][1] ? ' selected="selected"' : '' ); ?>><?php _e('Equal', 'usces'); ?></option>
						<option value="morethan"<?php echo ( 'notcontain' == $arr_search['order_word_term'][1] ? ' selected="selected"' : '' ); ?>><?php _e('More than', 'usces'); ?></option>
						<option value="lessthan"<?php echo ( 'lessthan' == $arr_search['order_word_term'][1] ? ' selected="selected"' : '' ); ?>><?php _e('Less than', 'usces'); ?></option>
					</select>
					</span>
				</p>
			</div>

			<div class="search_separate">AND</div>

			<div class="product_search_item search_item">
				<p class="search_item_label"><?php _e('From product information', 'usces'); ?></p>
				<p>
					<select name="search[product_column][0]" id="searchproductselect_0" class="searchselect">
						<option value=""> </option>
						<option value="item_code"<?php echo( 'item_code' == $arr_search['product_column'][0] ? ' selected="selected"' : '' ); ?>><?php _e('item code', 'usces' ); ?></option>
						<option value="item_name"<?php echo( 'item_name' == $arr_search['product_column'][0] ? ' selected="selected"' : '' ); ?>><?php _e('item name', 'usces' ); ?></option>
						<option value="sku_code"<?php echo( 'sku_code' == $arr_search['product_column'][0] ? ' selected="selected"' : '' ); ?>><?php _e('SKU code', 'usces' ); ?></option>
						<option value="sku_name"<?php echo( 'sku_name' == $arr_search['product_column'][0] ? ' selected="selected"' : '' ); ?>><?php _e('SKU name', 'usces' ); ?></option>
						<option value="item_option"<?php echo( 'item_option' == $arr_search['product_column'][0] ? ' selected="selected"' : '' ); ?>><?php _e('options for items', 'usces' ); ?></option>
					</select>
					<span id="searchproductword_0"><input name="search[product_word][0]" type="text" value="<?php echo esc_attr($arr_search['product_word'][0]); ?>" class="regular-text" maxlength="50" /></span>
				</p>
				<p>
					<select name="search[product_term]" class="termselect">
						<option value="AND">AND</option>
						<option value="OR"<?php echo ( 'OR' == $arr_search['product_term'] ? ' selected="selected"' : '' ); ?>>OR</option>
					</select>
				</p>
				<p>
					<select name="search[product_column][1]" id="searchproductselect_1" class="searchselect">
						<option value=""> </option>
						<option value="item_code"<?php echo( 'item_code' == $arr_search['product_column'][1] ? ' selected="selected"' : '' ); ?>><?php _e('item code', 'usces' ); ?></option>
						<option value="item_name"<?php echo( 'item_name' == $arr_search['product_column'][1] ? ' selected="selected"' : '' ); ?>><?php _e('item name', 'usces' ); ?></option>
						<option value="sku_code"<?php echo( 'sku_code' == $arr_search['product_column'][1] ? ' selected="selected"' : '' ); ?>><?php _e('SKU code', 'usces' ); ?></option>
						<option value="sku_name"<?php echo( 'sku_name' == $arr_search['product_column'][1] ? ' selected="selected"' : '' ); ?>><?php _e('SKU name', 'usces' ); ?></option>
						<option value="item_option"<?php echo( 'item_option' == $arr_search['product_column'][1] ? ' selected="selected"' : '' ); ?>><?php _e('options for items', 'usces' ); ?></option>
					</select>
					<span id="searchproductword_1"><input name="search[product_word][1]" type="text" value="<?php echo esc_attr($arr_search['product_word'][1]); ?>" class="regular-text" maxlength="50" /></span>
				</p>
			</div>
			<div class="search_submit">
				<input name="searchIn" type="submit" class="button button-primary" value="<?php _e('Search', 'usces'); ?>" />
				<input name="searchOut" type="submit" class="button" value="<?php _e('Cancellation', 'usces'); ?>" />
			</div>
		</td>
	</tr>
	<tr>
		<td class="label"><?php _e( 'Action', 'usces' ); ?></td>
		<td id="dl_list_table">
			<div class="action_button">
				<input type="button" id="dl_continuemember_list" class="button" value="<?php _e('Download Continue Member List', 'dlseller'); ?>" />
				<?php do_action( 'dlseller_action_dl_list_table' ); ?>
			</div>
		</td>
	</tr>
	</table>
<div<?php if( has_action('dlseller_action_continue_memberlist_searchbox_bottom') ) echo ' class="searchbox_bottom"'; ?>>
<?php do_action( 'dlseller_action_continue_memberlist_searchbox_bottom' ); ?>
</div>
</div><!-- searchBox -->
<?php do_action( 'dlseller_action_continue_memberlist_searchbox' ); ?>
</div><!-- tablesearch -->

<table id="mainDataTable" class="new-table order-new-table">
<?php
	$list_header = '<th scope="col"><input name="allcheck" type="checkbox" value="" /></th>';
	foreach( (array)$arr_header as $key => $value ) {
		if( 'ID' == $key ) {
			continue;
		}
		if( !isset($list_option['view_column'][$key]) || !$list_option['view_column'][$key] ) {
			continue;
		}
		$list_header .= '<th scope="col">'.$value.'</th>';
	}

	$usces_serchproduct_column = array( 'item_code', 'item_name', 'sku_code', 'sku_name', 'item_option' );
	if( in_array( $arr_search['product_column'][0], $usces_serchproduct_column ) || in_array( $arr_search['product_column'][1], $usces_serchproduct_column ) ) {
		$list_header .= '<th scope="col">'.__('item code', 'usces' ).'</th>'."\n";
		$list_header .= '<th scope="col">'.__('item name', 'usces' ).'</th>'."\n";
		$list_header .= '<th scope="col">'.__('SKU code', 'usces' ).'</th>'."\n";
		$list_header .= '<th scope="col">'.__('SKU name', 'usces' ).'</th>'."\n";
		$list_header .= '<th scope="col">'.__('option name', 'usces' ).'</th>'."\n";
		$list_header .= '<th scope="col">'.__('option value', 'usces' ).'</th>'."\n";
	}
?>
	<thead>
	<tr>
		<?php echo apply_filters( 'dlseller_filter_continue_member_list_header', $list_header, $arr_header ); ?>
	</tr>
	</thead>
<?php
	foreach( (array)$rows as $data ):
		$list_detail = '<td align="center"><input name="listcheck[]" type="checkbox" value="'.$data['order_id'].'" /></td>';

		foreach( (array)$data as $key => $value ) {
			if( isset($list_option['view_column'][$key]) && !$list_option['view_column'][$key] ) {
				continue;
			}

			if( WCUtils::is_blank($value) ) {
				$value = '&nbsp;';
			}

			$detail = '';
			switch( $key ) {
			case 'ID':
				break;
			case 'order_id':
			case 'deco_id':
				$detail = '<td><a href="'.USCES_ADMIN_URL.'?page=usces_orderlist&order_action=edit&order_id='.$data['order_id'].'&wc_nonce='.wp_create_nonce('order_list').'">'.esc_html($value).'</a></td>';
				break;
			case 'limitofcard':
				$limitofcard = $value.dlseller_upcard_url( $data['mem_id'], $data['order_id'], $data['limitofcard'], 'return' );
				$limitofcard = apply_filters( 'dlseller_filter_continue_member_list_limitofcard', $limitofcard, $data['mem_id'], $data['order_id'], $data );
				$detail = '<td class="center">'.$limitofcard.'</td>';
				break;
			case 'price':
				$detail = '<td class="price">'.usces_crform( $value, true, false, 'return' ).'</td>';
				break;
			case 'acting':
				$acting_name = ( array_key_exists( $value, $payment_structure ) ) ? $payment_structure[$value] : '';
				$acting_name = apply_filters( 'dlseller_filter_continue_member_list_acting_name', $acting_name, $data['mem_id'], $data['order_id'], $data );
				$detail = '<td>'.$acting_name.'</td>';
				break;
			case 'orderdate':
			case 'startdate':
			case 'contractedday':
			case 'chargedday':
				$detail = '<td class="center">'.$value.'</td>';
				break;
			case 'status':
				if( $value == 'continuation' ) {
					$continue_status = '<td class="green center">'.__('continuation', 'dlseller').'</td>';
				} else {
					$continue_status = '<td class="red center">'.__('cancellation', 'dlseller').'</td>';
				}
				$detail = apply_filters( 'dlseller_filter_continue_member_list_continue_status', $continue_status, $data['mem_id'], $data['order_id'], $data );
				break;
			case 'condition':
				$condition = apply_filters( 'dlseller_filter_continue_member_list_condition', $value, $data['mem_id'], $data['order_id'], $data );
				$detail = '<td class="center">'.$condition.'</td>';
				break;
			default:
				$detail = '<td>'.esc_html($value).'</td>';
			}
			$list_detail .= apply_filters( 'dlseller_filter_continue_member_list_detail_value', $detail, $value, $key, $data['mem_id'], $data['order_id'] );
		}
?>
<tbody>
	<tr<?php echo apply_filters( 'dlseller_filter_continue_member_list_detail_trclass', '', $data ); ?>>
		<?php echo apply_filters( 'dlseller_filter_continue_member_list_detail', $list_detail, $data, $curent_url ); ?>
	</tr>
</tbody>
<?php endforeach; ?>
</table>
<div class="usces_tablenav usces_tablenav_bottom">
	<?php echo $dataTableNavigation; ?>
</div>
</div><!-- datatable -->

<input name="con_id" type="hidden" id="con_id" value="" />
<input name="member_id" type="hidden" id="member_id" value="" />
<input name="order_id" type="hidden" id="order_id" value="" />
<input name="usces_referer" type="hidden" id="usces_referer" value="<?php echo $curent_url; ?>" />
<?php do_action( 'dlseller_action_continue_member_list_table_footer' ); ?>
<div id="dlContinueMemberListDialog" title="<?php _e('Download Continue Member List', 'dlseller'); ?>" class="download_dialog" style="display:none;">
	<p><?php _e('Select the item you want, please press the download.', 'usces'); ?></p>
	<input type="button" class="button" id="dl_con" value="<?php _e('Download', 'usces'); ?>" />
	<fieldset><legend><?php _e('Continuation charging member information', 'dlseller'); ?></legend>
		<label for="chk_con[order_id]"><input type="checkbox" class="check_con" id="chk_con[order_id]" value="order_id"<?php usces_checked($chk_con, 'order_id'); ?> /><?php _e('Order ID', 'dlseller'); ?></label>
		<label for="chk_con[deco_id]"><input type="checkbox" class="check_con" id="chk_con[deco_id]" value="deco_id"<?php usces_checked($chk_con, 'deco_id'); ?> /><?php _e('order number', 'usces'); ?></label>
		<label for="chk_con[mem_id]"><input type="checkbox" class="check_con" id="chk_con[mem_id]" value="mem_id"<?php usces_checked($chk_con, 'mem_id'); ?> /><?php _e('membership number', 'usces'); ?></label>
		<label for="chk_con[name]"><input type="checkbox" class="check_con" id="chk_con[name]" value="name"<?php usces_checked($chk_con, 'name'); ?> /><?php _e('name', 'usces'); ?></label>
	<?php if( 'JP' == $applyform ): ?>
		<label for="chk_con[kana]"><input type="checkbox" class="check_con" id="chk_con[kana]" value="kana"<?php usces_checked($chk_con, 'kana'); ?> /><?php _e('furigana', 'usces'); ?></label>
	<?php endif; ?>
		<label for="chk_con[limitofcard]"><input type="checkbox" class="check_con" id="chk_con[limitofcard]" value="price"<?php usces_checked($chk_con, 'limitofcard'); ?> /><?php _e('Limit of Card(Month/Year)', 'dlseller'); ?></label>
		<label for="chk_con[price]"><input type="checkbox" class="check_con" id="chk_con[price]" value="price"<?php usces_checked($chk_con, 'price'); ?> /><?php _e('Total Amount', 'usces'); ?></label>
		<label for="chk_con[acting]"><input type="checkbox" class="check_con" id="chk_con[acting]" value="acting"<?php usces_checked($chk_con, 'acting'); ?> /><?php _e('Settlement Supplier', 'dlseller'); ?></label>
		<label for="chk_con[peyment_method]"><input type="checkbox" class="check_order" id="chk_con[peyment_method]" value="peyment_method"<?php usces_checked($chk_con, 'peyment_method'); ?> /><?php _e('payment method','usces'); ?></label>
		<label for="chk_con[orderdate]"><input type="checkbox" class="check_con" id="chk_con[orderdate]" value="orderdate" /><?php _e('Application Date', 'dlseller'); ?></label>
		<label for="chk_con[startdate]"><input type="checkbox" class="check_con" id="chk_con[startdate]" value="startdate" /><?php _e('First Withdrawal Date', 'dlseller'); ?></label>
		<label for="chk_con[contractedday]"><input type="checkbox" class="check_con" id="chk_con[contractedday]" value="contractedday"<?php usces_checked($chk_con, 'contractedday'); ?> /><?php _e('Renewal Date', 'dlseller'); ?></label>
		<label for="chk_con[chargedday]"><input type="checkbox" class="check_con" id="chk_con[chargedday]" value="chargedday"<?php usces_checked($chk_con, 'chargedday'); ?> /><?php _e('Next Withdrawal Date', 'dlseller'); ?></label>
		<label for="chk_con[status]"><input type="checkbox" class="check_con" id="chk_con[status]" value="status"<?php usces_checked($chk_con, 'status'); ?> /><?php _e('Status', 'dlseller'); ?></label>
		<label for="chk_con[condition]"><input type="checkbox" class="check_con" id="chk_con[condition]" value="condition"<?php usces_checked($chk_con, 'condition'); ?> /><?php _e('Condition', 'dlseller'); ?></label>
	</fieldset>
</div>
<?php do_action( 'dlseller_action_continue_member_list_footer' ); ?>
<?php wp_nonce_field( 'continue_member_list', 'wc_nonce' ); ?>
</form>
</div><!--usces_admin-->
</div><!--wrap-->
<div id="mailSendDialog" title="" style="display:none;">
	<div id="order-response"></div>
	<fieldset>
		<p><?php _e("Check the mail and click 'send'", 'usces'); ?></p>
		<label><?php _e('e-mail adress', 'usces'); ?></label><input type="text" name="sendmailaddress" id="sendmailaddress" class="text" /><br />
		<label><?php _e('Client name', 'usces'); ?></label><input type="text" name="sendmailname" id="sendmailname" class="text" /><br />
		<label><?php _e('subject', 'usces'); ?></label><input type="text" name="sendmailsubject" id="sendmailsubject" class="text" /><input name="sendmail" id="sendmail" type="button" value="<?php _e('send', 'usces'); ?>" /><br />
		<textarea name="sendmailmessage" id="sendmailmessage"></textarea>
		<input name="mailChecked" id="mailChecked" type="hidden" />
	</fieldset>
</div>
<div id="mailSendAlert" title="">
	<div id="order-response"></div>
	<fieldset>
	</fieldset>
</div>

<script type="text/javascript">
jQuery(function($) {

	$("#mailSendDialog").dialog({
		bgiframe: true,
		autoOpen: false,
		height: 650,
		width: 700,
		resizable: true,
		modal: true,
		buttons: {
			'<?php _e('close', 'usces'); ?>': function() {
				$(this).dialog('close');
			}
		},
		close: function() {
			$("#sendmailmessage").html( "" );
			$('#sendmailaddress').val('');
		}
	});

	$("#mailSendAlert").dialog({
		bgiframe: true,
		autoOpen: false,
		height: 200,
		width: 200,
		resizable: false,
		modal: false
	});

	$("#sendmail").click(function() {
		uscesMail.sendMail();
	});

	uscesMail = {
		sendMail: function() {
			if( $("#sendmailaddress").val() == "" ) {
				return;
			}

			var address = encodeURIComponent($("#sendmailaddress").val());
			var message = encodeURIComponent($("#sendmailmessage").val());
			var name = encodeURIComponent($("#sendmailname").val());
			var subject = encodeURIComponent($("#sendmailsubject").val());
			var order_id = $("#order_id").val();
			var member_id = $("#member_id").val();
			console.log('OK1');

			var s = uscesMail.settings;
			s.data = "action=dlseller_send_mail_ajax&mailaddress=" + address + "&message=" + message + "&name=" + name + "&subject=" + subject + "&oid=" + order_id + "&mid=" + member_id;
			s.success = function( data, dataType ) {
				if( data == 'success' ) {
					console.log('OK2')
					$('#mailSendAlert').dialog('option', 'buttons', {
						'OK': function() {
							$(this).dialog('close');
							$('#mailSendDialog').dialog('close');
						}
					});
					$('#mailSendAlert').dialog('option', 'title', 'SUCCESS');
					$('#mailSendAlert fieldset').html('<p><?php _e('E-mail has been sent.', 'usces'); ?></p>');
					$('#mailSendAlert').dialog('open');

				} else if( data == 'error' ) {
					console.log('NG')
					$('#mailSendAlert').dialog('option', 'buttons', {
						'OK': function() {
							$(this).dialog('close');
						}
					});
					$('#mailSendAlert fieldset').dialog('option', 'title', 'ERROR');
					$('#mailSendAlert fieldset').html('<p><?php _e('Failure in sending e-mails.', 'usces'); ?></p>');
					$('#mailSendAlert').dialog('open');
				}
			};
			s.error = function( data, dataType ) {
				$('#mailSendAlert').dialog('option', 'buttons', {
					'OK': function() {
						$(this).dialog('close');
					}
				});
				$('#mailSendAlert fieldset').dialog('option', 'title', 'ERROR');
				$('#mailSendAlert fieldset').html('<p><?php _e('Failure in sending e-mails.', 'usces'); ?></p>');
				$('#mailSendAlert').dialog('open');
			};
			$.ajax( s );
			return false;
		},

		getMailData : function( member_id, order_id ) {
			$("#order_id").val(order_id);
			$("#member_id").val(member_id);
			var p = uscesMail.settings;
			p.url = uscesL10n.requestFile;
			p.data = "action=dlseller_make_mail_ajax&order_id=" + order_id + "&member_id=" + member_id;
			p.success = function(data, dataType){
				if( 0 == data ) {
					alert('<?php _e('Data Error', 'dlseller'); ?>');
				} else {
					//alert(data);
					strs = data.split('#usces#');
					//alert(strs[1]);return;
					$("#sendmailaddress").val( strs[0] );
					$("#sendmailname").val( strs[1] );
					$("#sendmailsubject").val( strs[2] );
					$("#sendmailmessage").val( strs[3] );
					$('#mailSendDialog').dialog('option', 'title', '<?php _e('Update Request Email', 'dlseller'); ?>');
					$('#mailSendDialog').dialog('open');
				}
			};
			p.error = function( data, dataType ) {
				alert('<?php _e('Send Error', 'dlseller'); ?>');
			};
			$.ajax( p );
			return false;
		},

		settings: {
			url: uscesL10n.requestFile,
			type: 'POST',
			cache: false,
			success: function( data, dataType ) {
			}, 
			error: function(msg){
				//$("#ajax-response").html(msg);
			}
		}
	};

	$("input[name='allcheck']").click(function () {
		if( $(this).attr("checked") ) {
			$("input[name*='listcheck']").attr({checked: true});
		} else {
			$("input[name*='listcheck']").attr({checked: false});
		}
	});

	operation = {
		change_order_search_field_0: function() {
			var html = '';
			var column = $("#searchorderselect_0").val();

			if( column == 'acting' ) {
				html = '<select name="search[order_word][0]" class="searchselect">';
		<?php foreach( (array)$payment_structure as $idx => $payment ):
				$selected = ( isset($arr_search['order_word'][0]) && $idx == $arr_search['order_word'][0] ) ? ' selected="selected"' : '';
		?>
				html += '<option value="<?php echo esc_attr($idx); ?>"<?php echo $selected ?>><?php echo esc_html($payment); ?></option>';
		<?php endforeach; ?>
				html += '</select>';
			} else if( column == 'status' ) {
				html = '<select name="search[order_word][0]" class="searchselect">';
				html += '<option value="continuation"<?php if( isset($arr_search['order_word'][0]) && 'continuation' == $arr_search['order_word'][0] ) echo ' selected="selected"'; ?>><?php _e('continuation', 'dlseller'); ?></option>';
				html += '<option value="cancellation"<?php if( isset($arr_search['order_word'][0]) && 'cancellation' == $arr_search['order_word'][0] ) echo ' selected="selected"'; ?>><?php _e('cancellation', 'dlseller'); ?></option>';
				html += '</select>';
			} else {
				html = '<input name="search[order_word][0]" type="text" value="<?php echo esc_attr($arr_search['order_word'][0]); ?>" class="regular-text" maxlength="50" />';
				html += '<select name="search[order_word_term][0]" class="termselect">';
				html += '<option value="contain"<?php echo ( 'contain' == $arr_search['order_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('Contain', 'usces'); ?></option>';
				html += '<option value="notcontain"<?php echo ( 'notcontain' == $arr_search['order_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('Not Contain', 'usces'); ?></option>';
				html += '<option value="equal"<?php echo ( 'equal' == $arr_search['order_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('Equal', 'usces'); ?></option>';
				html += '<option value="morethan"<?php echo ( 'morethan' == $arr_search['order_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('More than', 'usces'); ?></option>';
				html += '<option value="lessthan"<?php echo ( 'lessthan' == $arr_search['order_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('Less than', 'usces'); ?></option>';
				html += '</select>';
			}
			$("#searchorderword_0").html( html );
		},

		change_order_search_field_1: function() {
			var html = '';
			var column = $("#searchorderselect_1").val();

			if( column == 'acting' ) {
				html = '<select name="search[order_word][1]" class="searchselect">';
		<?php foreach( (array)$payment_structure as $idx => $payment ):
				$selected = ( isset($arr_search['order_word'][1]) && $idx == $arr_search['order_word'][1] ) ? ' selected="selected"' : '';
		?>
				html += '<option value="<?php echo esc_attr($idx); ?>"<?php echo $selected ?>><?php echo esc_html($payment); ?></option>';
		<?php endforeach; ?>
				html += '</select>';
			} else if( column == 'status' ) {
				html = '<select name="search[order_word][1]" class="searchselect">';
				html += '<option value="continuation"<?php if( isset($arr_search['order_word'][1]) && 'continuation' == $arr_search['order_word'][1] ) echo ' selected="selected"'; ?>><?php _e('continuation', 'dlseller'); ?></option>';
				html += '<option value="cancellation"<?php if( isset($arr_search['order_word'][1]) && 'cancellation' == $arr_search['order_word'][1] ) echo ' selected="selected"'; ?>><?php _e('cancellation', 'dlseller'); ?></option>';
				html += '</select>';
			} else {
				html = '<input name="search[order_word][1]" type="text" value="<?php echo esc_attr($arr_search['order_word'][1]); ?>" class="regular-text" maxlength="50" />';
				html += '<select name="search[order_word_term][1]" class="termselect">';
				html += '<option value="contain"<?php echo ( 'contain' == $arr_search['order_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('Contain', 'usces'); ?></option>';
				html += '<option value="notcontain"<?php echo ( 'notcontain' == $arr_search['order_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('Not Contain', 'usces'); ?></option>';
				html += '<option value="equal"<?php echo ( 'equal' == $arr_search['order_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('Equal', 'usces'); ?></option>';
				html += '<option value="morethan"<?php echo ( 'morethan' == $arr_search['order_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('More than', 'usces'); ?></option>';
				html += '<option value="lessthan"<?php echo ( 'lessthan' == $arr_search['order_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('Less than', 'usces'); ?></option>';
				html += '</select>';
			}
			$("#searchorderword_1").html( html );
		},

		change_product_search_field_0: function() {
			var html = '';
			var column = $("#searchproductselect_0").val();

			if( column == 'item_option' ) {
				html = '<?php _e('option key', 'usces'); ?>:<input name="search[product_word][0]" type="text" value="<?php echo esc_attr($arr_search['product_word'][0]); ?>" class="text" maxlength="50" /> <?php _e('option value', 'usces'); ?>:<input name="search[option_word][0]" type="text" value="<?php echo esc_attr($arr_search['option_word'][0]); ?>" class="text" maxlength="50" />';
			} else {
				html = '<input name="search[product_word][0]" type="text" value="<?php echo esc_attr($arr_search['product_word'][0]); ?>" class="regular-text" maxlength="50" />';
				html += '<select name="search[product_word_term][0]" class="termselect">';
				html += '<option value="contain"<?php echo ( 'contain' == $arr_search['product_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('Contain', 'usces'); ?></option>';
				html += '<option value="notcontain"<?php echo ( 'notcontain' == $arr_search['product_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('Not Contain', 'usces'); ?></option>';
				html += '<option value="equal"<?php echo ( 'equal' == $arr_search['product_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('Equal', 'usces'); ?></option>';
				html += '<option value="morethan"<?php echo ( 'morethan' == $arr_search['product_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('More than', 'usces'); ?></option>';
				html += '<option value="lessthan"<?php echo ( 'lessthan' == $arr_search['product_word_term'][0] ? ' selected="selected"' : ''); ?>><?php _e('Less than', 'usces'); ?></option>';
				html += '</select>';
			}
			$("#searchproductword_0").html( html );
		}, 

		change_product_search_field_1: function() {
			var html = '';
			var column = $("#searchproductselect_1").val();

			if( column == 'item_option' ) {
				html = '<?php _e('option key', 'usces'); ?>:<input name="search[product_word][1]" type="text" value="<?php echo esc_attr($arr_search['product_word'][1]); ?>" class="text" maxlength="50" /> <?php _e('option value', 'usces'); ?>:<input name="search[option_word][1]" type="text" value="<?php echo esc_attr($arr_search['option_word'][1]); ?>" class="text" maxlength="50" />';
			} else {
				html = '<input name="search[product_word][1]" type="text" value="<?php echo esc_attr($arr_search['product_word'][1]); ?>" class="regular-text" maxlength="50" />';
				html += '<select name="search[product_word_term][1]" class="termselect">';
				html += '<option value="contain"<?php echo ( 'contain' == $arr_search['product_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('Contain', 'usces'); ?></option>';
				html += '<option value="notcontain"<?php echo ( 'notcontain' == $arr_search['product_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('Not Contain', 'usces'); ?></option>';
				html += '<option value="equal"<?php echo ( 'equal' == $arr_search['product_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('Equal', 'usces'); ?></option>';
				html += '<option value="morethan"<?php echo ( 'morethan' == $arr_search['product_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('More than', 'usces'); ?></option>';
				html += '<option value="lessthan"<?php echo ( 'lessthan' == $arr_search['product_word_term'][1] ? ' selected="selected"' : ''); ?>><?php _e('Less than', 'usces'); ?></option>';
				html += '</select>';
			}
			$("#searchproductword_1").html( html );
		}
	};

	$("#searchorderselect_0").change(function () {
		operation.change_order_search_field_0();
	});
	$("#searchorderselect_1").change(function () {
		operation.change_order_search_field_1();
	});
	$("#searchproductselect_0").change(function () {
		operation.change_product_search_field_0();
	});
	$("#searchproductselect_1").change(function () {
		operation.change_product_search_field_1();
	});
	operation.change_order_search_field_0();
	operation.change_order_search_field_1();
	operation.change_product_search_field_0();
	operation.change_product_search_field_1();

	$('table#mainDataTable tbody input[type=checkbox]').change(
		function() {
			$('input').closest('tbody').removeClass('select');
			$(':checked').closest('tbody').addClass('select');
		}
	).trigger('change');

	$("#searchVisiLink").click(function() {
		if( $("#searchBox").css("display") != "block" ) {
			$("#searchBox").slideDown(300);
			$("#searchVisiLink").html('<?php _e('Hide the Operation field', 'usces'); ?><span class="dashicons dashicons-arrow-up"></span>');
			$.cookie("orderSearchBox", 1, { path: "<?php echo $usces_admin_path; ?>", domain: "<?php echo $_SERVER['SERVER_NAME']; ?>"}) == true;
		} else {
			$("#searchBox").slideUp(300);
			$("#searchVisiLink").html('<?php _e('Show the Operation field', 'usces'); ?><span class="dashicons dashicons-arrow-down"></span>');
			$.cookie("orderSearchBox", 0, { path: "<?php echo $usces_admin_path; ?>", domain: "<?php echo $_SERVER['SERVER_NAME']; ?>"}) == true;
		}
	});

	if( $.cookie("orderSearchBox") == true ) {
		$("#searchVisiLink").html('<?php _e('Hide the Operation field', 'usces'); ?><span class="dashicons dashicons-arrow-up"></span>');
		$("#searchBox").show();
	} else if( $.cookie("orderSearchBox") == false ) {
		$("#searchVisiLink").html('<?php _e('Show the Operation field', 'usces'); ?><span class="dashicons dashicons-arrow-down"></span>');
		$("#searchBox").hide();
	}

	$("#dlContinueMemberListDialog").dialog({
		bgiframe: true,
		autoOpen: false,
		height: 400,
		width: 700,
		resizable: true,
		modal: true,
		buttons: {
			'<?php _e('close', 'usces'); ?>': function() {
				$(this).dialog('close');
			}
		},
		close: function() {
		}
	});

	$('#dl_con').click(function() {
		var args = "&ftype=csv&returnList=1";
		$(".check_con").each(function(i) {
			if($(this).attr('checked')) {
				args += '&check['+$(this).val()+']=on';
			}
		});
		location.href = "<?php echo USCES_ADMIN_URL; ?>?page=usces_continue&continue_action=dlcontinuememberlist&noheader=true"+args;
	});

	$('#dl_continuemember_list').click(function() {
		$('#dlContinueMemberListDialog').dialog('open');
	});
<?php do_action( 'dlseller_action_continue_member_list_page_js' ); ?>
});
</script>
