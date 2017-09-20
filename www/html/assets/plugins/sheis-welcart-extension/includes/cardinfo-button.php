<?php

namespace Sheis\Welcart\Extension;

function cardinfo_button($out = '')
{
  global $usces;

  $html = '';

  $member = $usces->get_member();
  if (!Helper::is_continuation_member($member['ID'])) return;

  $order_id = Helper::get_continuation_order_id($member['ID']);
  $order_data = $usces->get_order_data($order_id, 'direct');
  $ac_member_id = $usces->get_member_meta_value('continue_memberid_' . $order_id, $member['ID']);

  if ($order_data && $ac_member_id)
  {
    $acting_opts = $usces->options['acting_settings']['remise'];
    $send_url = ('public' == $acting_opts['card_pc_ope']) ? $acting_opts['send_url_pc'] : $acting_opts['send_url_pc_test'];
    $rand = '0000000' . sprintf('%010d', mt_rand(1, 9999999999));
    $usces->save_order_acting_data($rand);

    $html .= '<form method="post" action="' . esc_url($send_url) . '" accept-charset="Shift_JIS">';
    $html .= '<input type="hidden" name="SHOPCO" value="' . esc_attr($acting_opts['SHOPCO']) . '">';
    $html .= '<input type="hidden" name="HOSTID" value="' . esc_attr($acting_opts['HOSTID']) . '">';
    $html .= '<input type="hidden" name="S_TORIHIKI_NO" value="' . esc_attr($rand) . '">';
    $html .= '<input type="hidden" name="JOB" value="CHECK">';
    $html .= '<input type="hidden" name="ITEM" value="0000990">';
    $html .= '<input type="hidden" name="AUTOCHARGE" value="1">';
    $html .= '<input type="hidden" name="AC_MEMBERID" value="' . esc_attr($ac_member_id) . '">';
    $html .= '<input type="hidden" name="AC_AMOUNT" value="' . usces_crform($order_data['order_item_total_price'], false, false, 'return', false) . '">';
    $html .= '<input type="hidden" name="AC_TOTAL" value="' . usces_crform($order_data['order_item_total_price'], false, false, 'return', false) . '">';
    $html .= '<input type="hidden" name="RETURL" value="' . wp_nonce_url(home_url('members/card/complete/'), 'card-complete', '_nonce') . '">';

    $html .= '<input type="hidden" name="MAIL" value="' . esc_attr($member['mailaddress1']) . '">';
    $html .= '<input type="hidden" name="AC_S_KAIIN_NO" value="' . esc_attr($member['ID']) . '">';
    $html .= '<input type="hidden" name="AC_NAME" value="' . esc_attr($member['name1'] . $member['name2']) . '">';
    $html .= '<input type="hidden" name="AC_KANA" value="' . esc_attr($member['name3'] . $member['name4']) . '">';
    $html .= '<input type="hidden" name="AC_TEL" value="' . esc_attr(str_replace('-', '', mb_convert_kana($member['tel'], 'a', 'UTF-8'))) . '">';
    $html .= '<input type="hidden" name="AC_NEXT_DATE" value="' . date('Ymd', dlseller_next_charging($order_id, 'time')) . '">';

    // $html .= '<p class="button_fill"><input type="submit" value="カード情報を変更する（外部サイト）"></p>';
    $html .= '<p class="button_fill"><a href="javascript:void(0);" onclick="$(this).parents(\'form\').submit();" target="_blank">カード情報を変更する（外部サイト）</a></p>';
    $html .= '</form>';
  }

  if ($out === 'return') return $html;

  echo $html;
}
