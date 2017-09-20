<?php

require_once( WP_CONTENT_DIR . '/includes/add_taxonomy.php' );
require_once( WP_CONTENT_DIR . '/includes/acf.php' );

/* ----------------------------------------------------------

  ￼Init

---------------------------------------------------------- */

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

remove_action( 'load-plugins.php', 'wp_update_plugins' );
remove_action( 'load-update.php', 'wp_update_plugins' );
remove_action( 'load-update-core.php', 'wp_update_plugins' );
remove_action( 'admin_init', '_maybe_update_core');
remove_action( 'admin_init', '_maybe_update_plugins' );
remove_action( 'wp_update_plugins', 'wp_update_plugins' );
remove_action( 'wp_version_check', 'wp_version_check' );

add_filter( 'pre_transient_update_plugins', function() { return null; } );
add_filter( 'pre_site_transient_update_core', function() { return null; } );
add_filter( 'pre_site_transient_update_plugins', function() { return null; } );

// add_theme_support('post-thumbnails');

function remove_default_post_screen_metaboxes() {
  remove_meta_box( 'postexcerpt','post','normal' );       // 抜粋
  remove_meta_box( 'trackbacksdiv','post','normal' );     // トラックバック送信
  remove_meta_box( 'postcustom','post','normal' );        // カスタムフィールド
  remove_meta_box( 'commentstatusdiv','post','normal' );  // ディスカッション
  remove_meta_box( 'commentsdiv','post','normal' );       // コメント
  remove_meta_box( 'authordiv','post','normal' );         // 作成者
  remove_meta_box( 'revisionsdiv','post','normal' );      // リビジョン
  remove_meta_box( 'formatdiv','post','normal' );         // フォーマット
}
add_action('admin_menu','remove_default_post_screen_metaboxes');

function remove_menus () {
    global $menu;
    // unset($menu[2]);  // ダッシュボード
    unset($menu[4]);  // メニューの線1
    // unset($menu[5]);  // 投稿
    // unset($menu[10]); // メディア
    // unset($menu[15]); // リンク
    // unset($menu[20]); // ページ
    unset($menu[25]); // コメント
    // unset($menu[59]); // メニューの線2
    // unset($menu[60]); // テーマ
    // unset($menu[65]); // プラグイン
    // unset($menu[70]); // プロフィール
    // unset($menu[75]); // ツール
    // unset($menu[80]); // 設定
    // unset($menu[90]); // メニューの線3
}
add_action('admin_menu', 'remove_menus');

function custom_columns ($columns) {
  unset($columns['comments']);    // コメント
  return $columns;
}
add_filter('manage_posts_columns', 'custom_columns');


/* ----------------------------------------------------------

  JS & CSS

---------------------------------------------------------- */

add_action('wp_enqueue_scripts', function()
{
  wp_deregister_script('jquery');
  wp_enqueue_script('fontplus', '//webfont.fontplus.jp/accessor/script/fontplus.js?fgjNLi9Uupw%3D&aa=1&ab=2');
  wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/build.js', array(), null, true);

  wp_enqueue_style('style', get_template_directory_uri().'/assets/css/style.css', array(), null);
  wp_enqueue_style('fontplus', 'https://fonts.googleapis.com/css?family=Homemade+Apple|Poppins:500,600', array(), null);

  $custom_style[] = '.list_octagon-img image,.list_octagon-img img {clip-path: url(#clip-octagon);}';
  if($color_set = get_field('colorset', 'options'))
  {
    foreach($color_set as $key => $value)
    {
      if($value['base'] && $value['font'])
      {
        $custom_style[] = '.c-bg-b_'. $key. '{background-color:'.$value['base']. '}';
        $custom_style[] = '.c-bd-b_'. $key. '{border-color:'.$value['base']. '}';
        $custom_style[] = '.c-cl-b_'. $key. '{color:'.$value['base']. '}';
        $custom_style[] = '.c-bg-f_'. $key. '{background-color:'.$value['font']. '}';
        $custom_style[] = '.c-bd-f_'. $key. '{border-color:'.$value['font']. '}';
        $custom_style[] = '.c-cl-f_'. $key. '{color:'.$value['font']. '}';
      }
    }
    wp_add_inline_style('style', implode('', $custom_style));
  }

});
/* ----------------------------------------------------------

  ￼Admin Bar

---------------------------------------------------------- */

function mytheme_remove_item( $wp_admin_bar )
{
  $wp_admin_bar->remove_node('customize');
  $wp_admin_bar->remove_node('appearance');
  $wp_admin_bar->remove_node('comments');
}
add_action( 'admin_bar_menu', 'mytheme_remove_item', 1000 );
add_filter( 'show_admin_bar', '__return_false' );


function query_to_string($slug = null, $query = array())
{
  if(!$slug || !$query) return false;
  return home_url('/'. $slug. '?'. http_build_query($query));
}

function do_404()
{
  status_header( 404 );
  get_template_part('404');
  exit;
}

function get_canonical_url()
{
  $path = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
  return home_url($path);
}

function is_external_url($url)
{
  return !preg_match('/^' . preg_quote(get_bloginfo('url'), '/') . '/', $url);
}

function get_pref()
{
  return array(
              '北海道',
              '青森県',
              '岩手県',
              '宮城県',
              '秋田県',
              '山形県',
              '福島県',
              '茨城県',
              '栃木県',
              '群馬県',
              '埼玉県',
              '千葉県',
              '東京都',
              '神奈川県',
              '新潟県',
              '富山県',
              '石川県',
              '福井県',
              '山梨県',
              '長野県',
              '岐阜県',
              '静岡県',
              '愛知県',
              '三重県',
              '滋賀県',
              '京都府',
              '大阪府',
              '兵庫県',
              '奈良県',
              '和歌山県',
              '鳥取県',
              '島根県',
              '岡山県',
              '広島県',
              '山口県',
              '徳島県',
              '香川県',
              '愛媛県',
              '高知県',
              '福岡県',
              '佐賀県',
              '長崎県',
              '熊本県',
              '大分県',
              '宮崎県',
              '鹿児島県',
              '沖縄県',
              '海外',
               );
}

function switch_selected_form($field = null, $value = null, $default = null)
{
  if(!$field || !$value) return false;

  $condition_match = (is_array($value)) ? in_array($value, get_postman($field)) : $value == get_postman($field);
  $condition_base = get_postman($field) && $condition_match;

  if($default)
  {
    return ($condition_base || (!get_postman($field) && ($default == $value)));
  }
  else
  {
    return $condition_base;
  }
}

function get_tw_url()
{
  $title = (get_field('og_title')) ? get_field('og_title') : strip_tags(get_the_title());
  return "https://twitter.com/share?shareUrl=". rawurlencode(get_the_permalink()) ."&text=". rawurlencode ($title. ' @sheis_jp #sheisjp');
}

function get_fb_url()
{
  $title = (get_field('og_title')) ? get_field('og_title') : strip_tags(get_the_title());
  return "https://www.facebook.com/sharer/sharer.php?u=". rawurlencode(get_the_permalink()) ."&t=". rawurlencode($title);
}

function get_pocket_url()
{
  return "http://getpocket.com/edit?url=". rawurlencode(get_the_permalink());
}

function get_line_url()
{
  $title = (get_field('og_title')) ? get_field('og_title') : strip_tags(get_the_title());
  return "http://line.me/R/msg/text/?". rawurlencode($title) ."%0D%0A". rawurlencode(get_the_permalink());
}