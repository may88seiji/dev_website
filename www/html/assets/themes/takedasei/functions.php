<?php

include_once( WP_CONTENT_DIR . '/includes/global.php' );

function get_main_feature($format = 'object')
{
  //TODO: transientつかう
  $term = get_field('pickup_feature', 'options');

  switch ($format) {
    case 'object':
    default:
      return $term;
      break;

    case 'permalink':
      return get_term_link($term);
      break;

    case 'id':
      return $term->term_id;
      break;

    case 'name':
      return $term->name;
      break;
  }
}

function get_main_theme_color_key()
{
  global $wp_query, $feature;

  //TODO: transientつかう
  if($feature && (is_tax('feature') || is_single()))
  {
    $term = $feature;
  }
  elseif(get_main_feature())
  {
    $term = get_main_feature();
  }

  return get_field('color', $term);
}

function get_gift_from_feature($feature_id = null, $format = 'id')
{
  //TODO: transientつかう
  if(!$feature_id) return false;

  $results = get_wp_search_index(array('ft' => $feature_id), array('ft' => array('column' => 'taxonomy_feature')));

  $get_posts = get_posts(array('category_name' => 'gift', 'include' => $results));

  if(!$get_posts) return false;

  switch ($format) {
    case 'object':
    default:
      return $get_posts[0];
      break;

    case 'permalink':
      return get_the_permalink($get_posts[0]->ID);
      break;

    case 'id':
      return $get_posts[0]->ID;
      break;
  }
}

function get_main_gift($format = 'id')
{
  //TODO: transientつかう
  if($pickup = get_main_feature('id'))
  {
    return get_gift_from_feature($pickup, $format);
  }
}

function get_headernavi_links()
{
  //TODO: transientつかう
  $links = array();

  $tags = get_field('pickup_tags', 'options');
  if($tags)
  {
    foreach($tags as $tag)
    {
      $links[] = array('label' => $tag->name, 'href' => home_url('/tag/'. $tag->slug));
    }
  }

  $categories = get_field('pickup_category', 'options');
  if($categories)
  {
    foreach($categories as $category)
    {
      $links[] = array('label' => $category->name, 'href' => home_url('/'. $category->slug. '/'));
    }
  }

  $series = get_field('pickup_series', 'options');
  if($series)
  {
    foreach($series as $tag)
    {
      $links[] = array('label' => $tag->name, 'href' => get_term_link($tag));
    }
  }

  $links[] = array('label' => '連載', 'href' => home_url('/series/'));
  if($links) return $links;
}

function get_tags_for_her($post_id = null)
{
  if(!$post_id) $post_id = get_the_ID();

  $tags = array();
  $tags = get_the_terms($post_id, 'post_tag');

  $showable_category = array('interview', 'voice', 'column', 'hottopic', 'note');
  foreach($showable_category as $slug)
  {
    if(in_category($slug, $post_id)) $tags[] = get_category_by_slug($slug);
  }

  return $tags;

}

function get_the_first_term($post_id = null, $term_slug = null)
{
  $terms = get_the_terms($post_id, $term_slug);
  return (isset($terms[0])) ? $terms[0] : null;
}

function is_cancelable()
{
  /* TODO: #369*/
  return (date_i18n("U") >= strtotime("2017-11-02"));
}

function ga_event_script($category = null, $label = null)
{
  if(!$category || !$label) return false;
  if(!IS_LOCAL) return "ga('send', 'event', '". $category. "', 'click', '". $label. "', 1, {'nonInteraction':1});";

}

/* ----------------------------------------------------------

  Pre_Get_Posts

---------------------------------------------------------- */
function change_pre_get_posts($query)
{
  remove_action( 'pre_get_posts', __FUNCTION__ );
  if(is_admin()/* || !$query->is_main_query()*/) return;

  if(is_tax() || is_tag())
  {
    $query->set('category__not_in', array(get_category_id_by_slug('gift'), get_category_id_by_slug('limited'), get_category_id_by_slug('item')));
    return $query;
  }
}

add_action('pre_get_posts', 'change_pre_get_posts');

function get_category_id_by_slug($slug = null)
{
  if(!$slug) return false;
  $obj = get_category_by_slug($slug);
  if($obj) return $obj->term_id;
}

/* ----------------------------------------------------------

  Thumbnail

---------------------------------------------------------- */
function add_thumbnail_size() {
  add_image_size('si-keyvisual', 1745, 635);
  add_image_size('si-wide', 1960, 760);
  add_image_size('si-wide-2', 980, 427);
  add_image_size('si-wide-sp', 680, 446);
  add_image_size('si-share', 1686, 1180);
  add_image_size('si-square-large', 680, 680);
  add_image_size('si-square-medium', 520, 520);
  add_image_size('si-square-small', 400, 400);
  add_image_size('si-square-xsmall', 280, 280);
  add_image_size('si-limited-list', 522, 348);
  add_image_size('si-banner-top-sp', 1160, 960);
}
add_action( 'after_setup_theme', 'add_thumbnail_size' );

/* ----------------------------------------------------------

  Pagination

---------------------------------------------------------- */

function si_pagination($pages = '', $range = 2)
{
  $showitems = ($range * 2) + 1;

  global $paged;
  if(empty($paged)) $paged = 1;

  if($pages == '')
  {
   global $wp_query;
   $pages = $wp_query->max_num_pages;
   if (!$pages) $pages = 1;
  }
  $lt = $paged + 1;
  $gt = $paged - 1;

  if(1 < $pages)
  {
    echo '<div class="pager">';

    if(1 < $paged) echo '<div class="prev"><a href="'.get_pagenum_link($paged-1).'">Prev</a></div>';

    if($paged !== (int)$wp_query->max_num_pages) echo '<div class="next"><a href="'.get_pagenum_link($paged+1).'">Next</a></div>';

    echo '<ol class="pager-numPC">';

    for ($i=1; $i <= $pages; $i++)
    {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
      {
       echo ($paged == $i)? '<li class="is-current"><span>'.$i.'</span></li>' : "<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
      }
    }

    if($pages < $wp_query->max_num_pages) echo '<li class="ellipsis"><span>...</span></li>';

    echo "</ol>";

    echo "<ul class='pager-numSP'>";
    echo "<li>". $paged. "</li>";
    echo "<li>". $wp_query->max_num_pages. "</li>";
    echo "</ul>";

    echo "</div>\n";
  }

}

function si_next_link( $atts, $content = null ) {

  global $page, $paged;
  if(empty($paged)) $paged = 1;
  $page_link = get_pagenum_link($paged + 1);

  $html = '<div class="titleListBox">
          <div class="titleListBox-inner">
            <ul>
              <li><span class="txtNext">NEXT PAGE</span>'. _wp_link_page($page + 1) . $content . '</a></li>
            </ul>
          </div>
        </div>';

    return $html;
}
add_shortcode('next', 'si_next_link');

function si_link_page() {

  global $page, $numpages, $multipage, $more;

  $prev = $page - 1;
  $next = $page + 1;

  if($more && $numpages > 1)
  {
    echo '<div class="pager">';

    if($prev > 0) echo '<div class="prev">'. _wp_link_page($prev). 'Prev</a></div>';

    if($next <= $numpages) echo '<div class="next">'. _wp_link_page($next). 'Next</a></div>';

    echo "<ul class='pager-numSP'>";
    echo "<li>". $page. "</li>";
    echo "<li>". $numpages. "</li>";
    echo "</ul>";

    echo "</div>\n";
  }
}

/* ----------------------------------------------------------

  Initialize > SearchIndex

---------------------------------------------------------- */
add_action('search_index_config_init', function(){
  $search_index_options   = array(
    'post_type' => array('post'),
    'category'  => array(),
    'keys'      => array(
                         'taxonomy_category',
                         'taxonomy_feature',
                         'taxonomy_series',
                         'taxonomy_girlfriend',
                         ),
  );
  WP_Search_Index_Config::set(null, $search_index_options);
});


function merge_wp_search_ids($index_sort_ids = array(), $date_sort_ids = array())
{
  if(isset($index_sort_ids) && isset($date_sort_ids))
  {
    $ids = array_intersect($index_sort_ids, $date_sort_ids);
  }
  elseif(isset($index_sort_ids))
  {
    $ids = $index_sort_ids;
  }
  elseif(isset($date_sort_ids))
  {
    $ids = $date_sort_ids;
  }

  return $ids;
}

/* ----------------------------------------------------------

  Meta Tags Generator

---------------------------------------------------------- */

add_action('meta_tags_generator_init', function()
{
  $meta_title_default = get_field('meta_title', 'options');
  $meta_description_default = get_field('meta_description', 'options');
  $og_image = get_field('og_image', 'options');
  $canonical_url = (is_front_page()) ? home_url('/') : get_canonical_url();

  $sitename = $meta_title_default;
  $title = $sitename;

  if (is_front_page())
  {
    $sns_description = $meta_description_default;
    $meta_description = null;
  }
  elseif (is_archive() || is_category())
  {
    if (is_admin()) return;
    if ($term = get_queried_object())
    {
      if(isset($term->term_id))
      {
        $meta_title = get_term_field('meta_title', $term->term_id, $term->taxonomy);
        $meta_description = get_term_field('meta_description', $term->term_id, $term->taxonomy);

        $sns_title = get_term_field('meta_sns_title', $term->term_id, $term->taxonomy) ?: $meta_title;
        $sns_description = get_term_field('meta_sns_description', $term->term_id, $term->taxonomy) ?: $meta_description;
      }
      else
      {
        $meta_title = $term->label;
        $sns_title = $term->label;
        $meta_description = null;
        $sns_description = null;
      }
    }
  }
  else
  {
    $meta_title = get_field('meta_title');
    $meta_description = get_field('meta_description');

    $sns_title = get_field('meta_sns_title') ?: $meta_title;
    $sns_description = get_field('meta_sns_description') ?: $meta_description;
  }

  if(!is_front_page())
  {
    global $wp_query;
    $fields = array('og_image', 'share_image', 'image', 'main_image', 'list_image_pc');
    $get_image = null;

    foreach($fields as $field)
    {
      if(is_tax() && $tax = $wp_query->queried_object)
      {
        if(!$get_image && get_field($field, $tax)) $og_image = get_field($field, $tax);
      }
      else
      {
        if(!$get_image && get_field($field)) $og_image = get_field($field);
      }

    }

    if($get_image) $og_image = $get_image;
  }

  // title
  if (is_front_page())
  {
    set_title($title);
    $sns_title = $title;
  }
  elseif ((is_single() || is_page()) && !get_query_var('si_action'))
  {
    $title = $meta_title ?: strip_tags(get_the_title());
    $title .= ($title ? ' - ' : '') . $sitename;
    set_title($title);
  }
  elseif (is_archive())
  {
    $title = $meta_title ?: wp_title('', false);
    $title .= ($title ? ' - ' : '') . $sitename;
    set_title($title);
  }
  else
  {
    $title = wp_title('', false);
    $title .= ($title ? ' - ' : '') . $sitename;
    set_title($title);
  }

  // meta
  MetaTagsGenerator::set('description', $meta_description ?: $meta_description_default);

  // facebook
  $og_title = $sns_title ?: $sns_title ?: $title;
  $og_description = $sns_description ? $sns_description : $meta_description_default;

  MetaTagsGenerator::set('og:site_name', $sitename, 'property');
  MetaTagsGenerator::set('og:title', $og_title, 'property');
  MetaTagsGenerator::set('og:description', $og_description, 'property');
  MetaTagsGenerator::set('og:url', $canonical_url, 'property');
  MetaTagsGenerator::set('og:image', ($og_image ? $og_image['url'] : ''), 'property');
  MetaTagsGenerator::set('og:type', 'website', 'property');
  if(get_field('fb_app_id', 'options')) MetaTagsGenerator::set('fb:app_id', get_field('fb_app_id', 'options'), 'property');

  // Twitter
  MetaTagsGenerator::set('twitter:site', $sitename);
  MetaTagsGenerator::set('twitter:title', $og_title);
  MetaTagsGenerator::set('twitter:description', $og_description);
  MetaTagsGenerator::set('twitter:url', $canonical_url);
  MetaTagsGenerator::set('twitter:card', 'summary_large_image');
  MetaTagsGenerator::set('twitter:image', ($og_image ? $og_image['url'] : ''));
});

/* ----------------------------------------------------------

  Title

---------------------------------------------------------- */

add_filter('wp_title', function($title)
{
  return trim($title);
}, 99);

function set_title($title)
{
  $new_title = $title;

  add_filter('wp_title', function($title, $sep, $seplocation) use($new_title)
  {
    if ($seplocation === 'right')
    {
      $title = $new_title . " $sep ";
    }
    else
    {
      $title = " $sep " . $new_title;
    }

    return $title;

  }, 10, 3);
}


/* ----------------------------------------------------------

  Initialize > Postman

---------------------------------------------------------- */

add_action('postman_init', 'postman_setting');
function postman_setting()
{
  global $postman;

  $postman->set_vals(array(
    'post_type' => array(
      'label' => 'お問い合わせの種類',
      'name' => 'post_type',
      'rules' => null
    ),
    'post_company' => array(
      'label' => '名前',
      'name' => 'post_company',
      'rules' => null
    ),
    'post_name' => array(
      'label' => '名前',
      'name' => 'post_name',
      'rules' => array(
        'required' => array(
          'slug' => 'required',
          'value' => null,
        ),
      ),
    ),
    'post_kana' => array(
      'label' => 'フリガナ',
      'name' => 'post_kana',
      'rules' => array(
        'required' => array(
          'slug' => 'required',
          'value' => null,
        ),
      ),
    ),
    'post_email' => array(
      'label' => 'メールアドレス',
      'name' => 'post_email',
      'rules' => array(
        'required' => array(
          'slug' => 'required',
          'value' => null,
        ),
      ),
    ),
    'post_email_check' => array(
      'label' => '確認用メールアドレス',
      'name' => 'post_email_check',
      'rules' => array(
        'required' => array(
          'slug' => 'required',
          'value' => null,
        ),
        'match' => array(
          'slug' => 'match',
          'value' => 'post_email'
        ),
      ),
    ),
    'post_tel' => array(
      'label' => '電話番号',
      'name' => 'post_tel',
      'rules' => null
    ),
    'post_orderid' => array(
      'label' => 'ご注文ID',
      'name' => 'post_orderid',
      'rules' => null,
    ),
    'post_content' => array(
      'label' => '内容',
      'name' => 'post_content',
      'rules' => array(
        'required' => array(
          'slug' => 'required',
          'value' => null,
        ),
      ),
    ),

  ));
  $postman->set_templates(array(
    'send_member' => array(
      'type' => 'send',
      'subject' => '【She is】 一般、Membersのお問い合わせ（[post_type]）',
      'from' => '[post_name] <[post_email]>',
      'to' => 'support@sheishere.jp',
      'body' => '「She is」に一般、Membersのお客さまからお問い合わせがありました。
お送りいただいた内容は以下の通りです。

お問い合わせの種類：[post_type]
-------------------------------
お名前：[post_name]
フリガナ：[post_kana]
メールアドレス：[post_email]
電話番号：[post_tel]

内容：
[post_content]
-------------------------------',
    ),
    'send_company' => array(
      'type' => 'send',
      'subject' => '【She is】 法人のお問い合わせ（[post_type]）',
      'from' => '[post_name] <[post_email]>',
      'to' => 'hello@sheishere.jp',
      'body' => '「She is」に法人のお客さまからお問い合わせがありました。
お送りいただいた内容は以下の通りです。

お問い合わせの種類：[post_type]
-------------------------------
貴社名：[post_company]
お名前：[post_name]
フリガナ：[post_kana]
メールアドレス：[post_email]
電話番号：[post_tel]

内容：
[post_content]
-------------------------------',
    ),

    'confirm_member' => array(
      'type' => 'confirm',
      'subject' => '【She is】 お問い合わせありがとうございました。',
      'from' => 'She is <support@sheishere.jp>',
      'to' => '[post_email]',
      'body' => '[post_name] 様

この度は、「She is」よりお問い合わせいただきありがとうございます。

本メールは、お問い合わせいただいた方に自動返信しております。
心当たりのない方はお手数ですが、その旨を本メールに
ご返信いただけますよう、お願い申し上げます。

内容によりましては、多少のお時間を頂戴する場合、
またご返信ができない場合もございますことをあらかじめご了承くださいませ。

お送りいただいた内容は以下の通りです。

お問い合わせの種類：[post_type]
-------------------------------
お名前：[post_name]
フリガナ：[post_kana]
メールアドレス：[post_email]
電話番号：[post_tel]

内容：
[post_content]
-------------------------------

今後とも、She isをよろしくお願い申し上げます。


株式会社CINRA
She is編集部
〒150-0043
東京都渋谷区道玄坂1-20-8 寿パークビル5F
TEL 03-5784-4560　FAX 03-5784-4561
10:00〜18:00（土日祝は除く）
support@sheishere.jp
http://sheishere.jp/'
    ),
    'confirm_company' => array(
      'type' => 'confirm',
      'subject' => '【She is】 お問い合わせありがとうございました。',
      'from' => 'She is <support@sheishere.jp>',
      'to' => '[post_email]',
      'body' => '[post_name] 様

この度は、「She is」よりお問い合わせいただきありがとうございます。

本メールは、お問い合わせいただいた方に自動返信しております。
心当たりのない方はお手数ですが、その旨を本メールに
ご返信いただけますよう、お願い申し上げます。

内容によりましては、多少のお時間を頂戴する場合、
またご返信ができない場合もございますことをあらかじめご了承くださいませ。

お送りいただいた内容は以下の通りです。

お問い合わせの種類：[post_type]
-------------------------------
貴社名：[post_company]
お名前：[post_name]
フリガナ：[post_kana]
メールアドレス：[post_email]
電話番号：[post_tel]

内容：
[post_content]
-------------------------------

今後とも、She isをよろしくお願い申し上げます。

株式会社CINRA
She is編集部
〒150-0043
東京都渋谷区道玄坂1-20-8 寿パークビル5F
TEL 03-5784-4560　FAX 03-5784-4561
10:00〜18:00（土日祝は除く）
hello@sheishere.jp
http://sheishere.jp/'
    ),

  ));
}

function get_question_choices($field = null)
{
  $choices = array(
                 'post_type_member' => array(
                                     'ご意見・ご要望など',
                                     'ご質問',
                                     '記事の感想など',
                                     '自動継続・お支払いについて',
                                     'アカウント・ログインについて',
                                     'パスワード変更について',
                                     'ギフトについて',
                                     'イベントについて',
                                     'Members限定記事について',
                                     '解約について',
                                     'その他',
                                     ),
                 'post_type_company' => array(
                                     '記事タイアップ、バナー広告について',
                                     'イベントについて',
                                     'ギフトについて',
                                     'Girlfriendについて',
                                     'その他',
                                     ),
                 );
  return ($field && isset($choices[$field])) ? $choices[$field] : $choices;
}
