<?php

add_shortcode('si_registration_button', function($atts)
{
  global $usces;

  extract(shortcode_atts(array(
    'item' => '',
    'sku' => '',
    'value' => 'Members登録',
    'onclick' => '',
  ), $atts));

  $post_id  = $usces->get_ID_byItemName($item);
  $datas    = $usces->get_skus( $post_id, 'code' );
  $zaikonum = $datas[$sku]['stocknum'];
  $zaiko    = $datas[$sku]['stock'];
  $gptekiyo = $datas[$sku]['gp'];
  $skuPrice = $datas[$sku]['price'];
  $sku_enc  = urlencode($sku);

  if (!$usces->is_item_zaiko($post_id, $sku))
  {
    return '<div class="button_status">' . esc_html($usces->zaiko_status[$zaiko]) . '</div>';
  }

  $html = "<form action=\"" . home_url('registration/step1/') . "\" method=\"post\">\n";
  $html .= wp_nonce_field('registration-form', '_registration_form_nonce');
  $html .= "<input name=\"zaikonum[{$post_id}][{$sku_enc}]\" type=\"hidden\" id=\"zaikonum[{$post_id}][{$sku_enc}]\" value=\"{$zaikonum}\" />\n";
  $html .= "<input name=\"zaiko[{$post_id}][{$sku_enc}]\" type=\"hidden\" id=\"zaiko[{$post_id}][{$sku_enc}]\" value=\"{$zaiko}\" />\n";
  $html .= "<input name=\"gptekiyo[{$post_id}][{$sku_enc}]\" type=\"hidden\" id=\"gptekiyo[{$post_id}][{$sku_enc}]\" value=\"{$gptekiyo}\" />\n";
  $html .= "<input name=\"skuPrice[{$post_id}][{$sku_enc}]\" type=\"hidden\" id=\"skuPrice[{$post_id}][{$sku_enc}]\" value=\"{$skuPrice}\" />\n";
  $html .= "<input name=\"inCart[{$post_id}][{$sku_enc}]\" type=\"hidden\" id=\"inCart[{$post_id}][{$sku_enc}]\" class=\"skubutton\" value=\"{$value}\" />";
  $html .= "<p class=\"button_line c-bg-b_" . get_field('color', get_main_feature()) . "\"><a href=\"javascript:void(0)\" onclick=\"". $onclick. "$(this).parents('form').submit();\">{$value}</a></p>";
  $html .= "<input name=\"usces_referer\" type=\"hidden\" value=\"" . esc_url($_SERVER['REQUEST_URI']) . "\" />\n";
  $html = apply_filters('usces_filter_single_item_inform', $html);
  $html .= "</form>";
  $html .= '<div class="error_message">' . usces_singleitem_error_message($post_id, $sku, 'return') . '</div>'."\n";

  return $html;

});
