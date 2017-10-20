<?php

require_once( WP_CONTENT_DIR . '/includes/add_taxonomy.php' );
require_once( WP_CONTENT_DIR . '/includes/acf.php' );
require_once( WP_CONTENT_DIR . '/includes/init.php' );


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
  wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/build.js', array(), null, true);

  wp_enqueue_style('style', get_template_directory_uri().'/assets/css/style.css', array(), null);

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
//  return "https://twitter.com/share?shareUrl=". rawurlencode(get_the_permalink()) ."&text=". rawurlencode ($title. ' @sheis_jp #sheisjp');
}

function get_custom_post($pp = null, $type = null)
{
  $args = array(
    'posts_per_page' => $pp, //表示する記事の数
    'post_type' => $type //投稿タイプ名
  );
  $customPosts = get_posts($args);
  
  return $customPosts;
}