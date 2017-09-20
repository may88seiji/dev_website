<?php

namespace Sheis\Welcart\Extension;

function purchase_button($out = '')
{
  global $usces, $usces_entries;

  $html = '';
  $payments = usces_get_payments_by_name($usces_entries['order']['payment_name']);
  $acting_flag = ($payments['settlement'] === 'acting') ? $payments['module'] : $payments['settlement'];
  $rand = usces_acting_key();
  $cart = $usces->cart->get_cart();

  switch ($acting_flag)
  {
    case 'acting_remise_card':
      $have_continue_charge = usces_have_continue_charge($cart);
      $acting_opts = $usces->options['acting_settings']['remise'];
      $usces->save_order_acting_data($rand);
      usces_save_order_acting_data($rand);
      $member = $usces->get_member();
      $send_url = ('public' == $acting_opts['card_pc_ope']) ? $acting_opts['send_url_pc'] : $acting_opts['send_url_pc_test'];
      $html .= '<form id="purchase_form" name="purchase_form" action="' . $send_url . '" method="post" onKeyDown="if (event.keyCode == 13) {return false;}" accept-charset="Shift_JIS">
        <input type="hidden" name="SHOPCO" value="' . esc_attr($acting_opts['SHOPCO']) . '" />
        <input type="hidden" name="HOSTID" value="' . esc_attr($acting_opts['HOSTID']) . '" />
        <input type="hidden" name="REMARKS3" value="' . $acting_opts['REMARKS3'] . '" />
        <input type="hidden" name="S_TORIHIKI_NO" value="' . $rand . '" />
        <input type="hidden" name="JOB" value="' . apply_filters('usces_filter_remise_card_job', $acting_opts['card_jb']) . '" />
        <input type="hidden" name="MAIL" value="' . esc_attr($usces_entries['customer']['mailaddress1']) . '" />
        <input type="hidden" name="ITEM" value="' . apply_filters('usces_filter_remise_card_item', '0000120') . '" />
        <input type="hidden" name="TOTAL" value="' . usces_crform($usces_entries['order']['total_full_price'], false, false, 'return', false) . '" />
        <input type="hidden" name="AMOUNT" value="' . usces_crform($usces_entries['order']['total_full_price'], false, false, 'return', false) . '" />
        <input type="hidden" name="RETURL" value="' . home_url('registration/thankyou/') . '" />
        <input type="hidden" name="NG_RETURL" value="' . home_url('registration/error/') . '" />
        <input type="hidden" name="EXITURL" value="' . wp_nonce_url(home_url('registration/confirm/'), 'registration-form', '_nonce') . '" />
        ';
      // if( 'on' == $acting_opts['payquick'] && $usces->is_member_logged_in() ){
      //   $pcid = $usces->get_member_meta_value('remise_pcid', $member['ID']);
      //   $html .= '<input type="hidden" name="PAYQUICK" value="1">';
      //   if( $pcid != NULL )
      //     $html .= '<input type="hidden" name="PAYQUICKID" value="' . $pcid . '">';
      // }
      // if( 'on' == $acting_opts['howpay'] && isset($usces_entries['order']['div']) && '0' !== $usces_entries['order']['div'] && !$have_continue_charge ){
      //   $html .= '<input type="hidden" name="div" value="' . $usces_entries['order']['div'] . '">';
      //   switch( $usces_entries['order']['div'] ){
      //     case '1':
      //       $html .= '<input type="hidden" name="METHOD" value="61">';
      //       $html .= '<input type="hidden" name="PTIMES" value="2">';
      //       break;
      //     case '2':
      //       $html .= '<input type="hidden" name="METHOD" value="80">';
      //       break;
      //   }
      // }else{
        $html .= '<input type="hidden" name="div" value="0">';
        $html .= '<input type="hidden" name="METHOD" value="10">';
      // }
      if( $have_continue_charge ){
        $frequency = $usces->getItemFrequency($cart[0]['post_id']);
        $nextdate = current_time('mysql');
        $kana = ( !empty($usces_entries['customer']['name3']) ) ? $usces_entries['customer']['name3'] : '';
        if( !empty($usces_entries['customer']['name4']) ) $kana .= $usces_entries['customer']['name4'];
        if( !empty($kana) ) {
          $kana = str_replace( "・", "", str_replace( "　", "", mb_convert_kana( $kana, "KVC", 'UTF-8' ) ) );
          $kana = mb_substr( $kana, 0, 20, 'UTF-8' );
          mb_regex_encoding( 'UTF-8' );
          if( !mb_ereg( "^[ァ-ヶー]+$", $kana ) ) $kana = '';
        }
        $html .= '
        <input type="hidden" name="AUTOCHARGE" value="1">
        <input type="hidden" name="AC_S_KAIIN_NO" value="' . $member['ID'] . '">
        <input type="hidden" name="AC_NAME" value="">
        <input type="hidden" name="AC_KANA" value="' . esc_attr($kana) . '">
        <input type="hidden" name="AC_TEL" value="' . esc_attr(str_replace('-', '', mb_convert_kana($usces_entries['customer']['tel'], 'a', 'UTF-8'))) . '">
        <input type="hidden" name="AC_AMOUNT" value="' . $usces_entries['order']['total_full_price'] . '">
        <input type="hidden" name="AC_TOTAL" value="' . $usces_entries['order']['total_full_price'] . '">
        <input type="hidden" name="AC_NEXT_DATE" value="' . date('Ymd', dlseller_first_charging($cart[0]['post_id'], 'time')) . '">
        <input type="hidden" name="AC_INTERVAL" value="' . $frequency . 'M">
        ';
      }
      $html .= '<input type="hidden" name="dummy" value="&#65533;" />';
      $html .= '<div class="button_next-wrap js-button_next-wrap is-disabled"><input type="submit" class="button_next is-disabled js-button_next" value="NEXT" onClick="'. ga_event_script('cv', 'confirm-next') .'"></div>';
      $html .= '</form>';
      break;
  }

  if ($out === 'return') return $html;

  echo $html;
}
