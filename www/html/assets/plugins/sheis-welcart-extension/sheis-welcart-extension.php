<?php
/*
Plugin Name: Sheis Welcart Extension
Plugin URI: http://www.cinra.co.jp/
Description: Welcart extension for "She is"
Version: 1.0.0
Author: CINRA Inc.
Author URI: http://www.cinra.co.jp/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('SHEIS_WELCART_EX_PATH', plugin_dir_path(__FILE__));

class Sheis_Welcart_Extension
{
  public function __construct()
  {
    add_action('plugins_loaded', array($this, 'initialize'));
    add_action('init', array($this, 'rewrite_rules'));
    add_filter('query_vars', array($this, 'add_query_vars'));
    add_action('template_redirect', array($this, 'remove_filters'), 1);

    register_activation_hook(__FILE__, array($this, 'activate'));
  }

  public function remove_filters()
  {
    global $usces;
    remove_action('wp_enqueue_scripts', 'usces_wp_enqueue_scripts' , 11);
    remove_action('wp_footer', array(&$usces, 'shop_foot'));
    remove_filter('wp_footer', 'usces_action_footer_comment');
  }

  public function initialize()
  {
    $active_plugin_check = true;
    $active_plugins = get_option('active_plugins');

    if (!in_array('usc-e-shop/usc-e-shop.php', $active_plugins)) $active_plugin_check = false;
    if (!in_array('usc-e-shop/usc-e-shop.php', $active_plugins)) $active_plugin_check = false;

    if (!$active_plugin_check)
    {
      add_action('admin_notices', function()
      {
        echo '<div class="error"><p><b>Welcart・WCEX DL Seller</b> を有効化してください</p></div>';
      });
      return;
    }

    require_once SHEIS_WELCART_EX_PATH . 'classes/config.php';
    require_once SHEIS_WELCART_EX_PATH . 'classes/helper.php';

    require_once SHEIS_WELCART_EX_PATH . 'classes/registration.php';
    require_once SHEIS_WELCART_EX_PATH . 'classes/member.php';
    require_once SHEIS_WELCART_EX_PATH . 'classes/mailchimp.php';

    require_once SHEIS_WELCART_EX_PATH . 'includes/shortcode.php';
    require_once SHEIS_WELCART_EX_PATH . 'includes/purchase-button.php';
    require_once SHEIS_WELCART_EX_PATH . 'includes/cardinfo-button.php';

    if (is_admin())
    {
      require_once SHEIS_WELCART_EX_PATH . 'classes/admin/non-continuation-member.php';
    }
  }

  public function add_query_vars($vars)
  {
    $vars[] = 'si_action';
    $vars[] = 'si_param1';
    return $vars;
  }

  public function rewrite_rules()
  {
    global $wp_rewrite;

    $wp_rewrite->add_rule('registration/([^/]+)/?$', 'index.php?post_type=page&pagename=registration&si_action=$matches[1]', 'top');
    $wp_rewrite->add_rule('members/([^/]+)/?$', 'index.php?post_type=page&pagename=members&si_action=$matches[1]', 'top');
    $wp_rewrite->add_rule('members/([^/]+)/([^/]+)/?$', 'index.php?post_type=page&pagename=members&si_action=$matches[1]&si_param1=$matches[2]', 'top');
    $wp_rewrite->add_rule('(logout)/?$', 'index.php?post_type=page&pagename=members&si_action=$matches[1]', 'top');

    $wp_rewrite->flush_rules();
  }

  public function activate()
  {
    // MEMBERS 新規登録
    if (get_page_by_path('registration', OBJECT, 'post') === null)
    {
      wp_insert_post(array(
        'post_name'   => 'registration',
        'post_title'  => 'MEMBERS 新規登録',
        'post_status' => 'publish',
        'post_type'   => 'page',
      ));
    }

    // ログイン
    if (get_page_by_path('login', OBJECT, 'post') === null)
    {
      wp_insert_post(array(
        'post_name'   => 'login',
        'post_title'  => 'ログイン',
        'post_status' => 'publish',
        'post_type'   => 'page',
      ));
    }

    // マイページ
    if (get_page_by_path('members', OBJECT, 'post') === null)
    {
      wp_insert_post(array(
        'post_name'   => 'members',
        'post_title'  => 'マイページ',
        'post_status' => 'publish',
        'post_type'   => 'page',
      ));
    }

    // Welcart カスタムメンバーフィールド
    $custom_member_field = array(
      'gender'      => array(
        'name'      => '性別',
        'means'     => '0',
        'essential' => '0',
        'value'     => array(
          '0'       => '男性
女性
その他',
        ),
        'position'  => 'fax_after',
      ),

      'birthday' => array(
        'name'      => '生年月日',
        'means'     => '2',
        'essential' => '0',
        'value'     => '',
        'position'  => 'fax_after',
      ),

      'mail_magazine' => array(
        'name'      => 'メールマガジン',
        'means'     => '0',
        'essential' => '0',
        'value'     => array(
          '0' => '希望する
希望しない',
        ),
        'position'  => 'fax_after',
      ),

      'size' => array(
        'name'      => 'サイズ',
        'means'     => '0',
        'essential' => '0',
        'value'     => array(
          '0' => 'S
M
L',
        ),
        'position'  => 'fax_after',
      ),

      'settle_status' => array(
        'name'      => '決済ステータス',
        'means'     => '0',
        'essential' => '0',
        'value'     => array(
          '0' => '未決済
決済完了
決済失敗',
        ),
        'position'  => 'fax_after',
      ),

      'setteled_date' => array(
        'name'      => '決済完了日時',
        'means'     => '2',
        'essential' => '0',
        'value'     => '',
        'position'  => 'fax_after',
      ),

      'updated_card_date' => array(
        'name'      => 'カード更新日時',
        'means'     => '2',
        'essential' => '0',
        'value'     => '',
        'position'  => 'fax_after',
      ),
    );

    update_option('usces_custom_member_field', serialize($custom_member_field));

  }
}

new Sheis_Welcart_Extension;
