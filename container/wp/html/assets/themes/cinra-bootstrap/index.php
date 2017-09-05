<?php

/* ----------------------------------------------------------

  Bootstrap Controller
  ※ 固定ページのテンプレート機能を利用するため、
    ここではルーティングのみを実装し、
    共通の機能などは、各テンプレートか、pre_get_postなどで実装すること

---------------------------------------------------------- */

$tpl = null;
$sub_tpl = null;

if (is_singular())
{
  if (is_single())
  {
    $tpl = 'singles/' . get_post_type();
    if (!locate_template($tpl.'.php')) $tpl = 'singles/post';
  }

  if (!$tpl) $tpl = 'pages/page';
}

if (is_front_page() || is_home())
{
  $tpl = 'pages/top';
}

if (is_archive())
{
  if (is_category())
  {
    $category_name = isset($wp_query->query['category_name']) ? str_replace('/', '-', $wp_query->query['category_name']) : null;
    if (strpos($category_name, '-') > 0)
    {
      $chunks = explode('-', $category_name);
      $sub_tpl = array_pop($chunks);
      $tpl = reset($chunks);
    }
    if ($category_name) $tpl = 'archives/' . $category_name;
  }
  elseif (is_tax())
  {
    // TODO: ここの処理は結構危ういです。i18n対応で、tax_queryに必ずlangが含まれているんですが、WPのget_queried_object()は、配列の最初のものを引っ張るだけなので、必ずlangがセットされてしまいます。i18nでtax_queryをセットするのはpre_get_postsのタイミングなので、テンプレートを読むずっと前なので、ここでは調整できないです。ここでは無理矢理配列を逆さにして、$taxを設定しています。
    if (isset($wp_query->tax_query->queries))
    {
      $tax = reset(array_reverse($wp_query->tax_query->queries));
      if (isset($tax['taxonomy'])) $tpl = 'archives/' . $tax['taxonomy'];
      if (isset($tax['terms'])) $sub_tpl = reset($tax['terms']);
    }
  }
  else
  {
    $post_type = get_post_type();
    $tpl = 'archives/' . $post_type;
  }

  if (!locate_template($tpl.'.php')) $tpl = 'archives/default';
}

locate_template($tpl.'.php') ? get_template_part($tpl, $sub_tpl) : do_404();
exit;