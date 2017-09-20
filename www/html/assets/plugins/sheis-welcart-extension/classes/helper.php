<?php

namespace Sheis\Welcart\Extension;

class Helper
{

  public static function do_404()
  {
    status_header(404);
    get_template_part('404');
    exit;
  }

  public static function is_post()
  {
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
  }

  public static function get_post($keys = null, $default = null)
  {
    return self::get_param($_POST, $keys, $default);
  }

  public static function get_param($params = array(), $keys = null, $default = null)
  {
    if ($keys === null) return $params;

    if (!is_array($keys)) $keys = explode('.', $keys);
    $key = array_shift($keys);

    if (!isset($params[$key])) return $default;

    if (!$keys)
    {
      $params[$key] = is_array($params[$key]) ? array_map('trim', $params[$key]) : trim($params[$key]);
      return $params[$key];
    }

    return self::get_param($params[$key], $keys, $default);
  }

  public static function member_logout()
  {
    global $usces;
    $cookie = $usces->get_cookie();
    $cookie['name'] = '';
    $cookie['rme'] = '';
    $usces->set_cookie($cookie);
    unset($_SESSION['usces_member'], $_SESSION['usces_entry']);
  }

  public static function get_current_member_id()
  {
    global $usces;
    $usces->get_current_member();
    return $usces->current_member['id'];
  }

  public static function is_member_exists($email, $exclude_member_id = 0)
  {
    global $wpdb;
    $member_table = $wpdb->prefix . "usces_member";
    $sql = $wpdb->prepare("SELECT ID FROM $member_table WHERE `mem_email` = %s AND `ID` != %d", $email, $exclude_member_id);
    $member_id = $wpdb->get_var($sql);
    return $member_id ? true : false;
  }

  public static function is_member_logged_in()
  {
    global $usces;

    $is_member_logged_in = false;

    if ($usces->is_member_logged_in())
    {
      $member_id = self::get_current_member_id();

      if (self::is_continuation_member($member_id))
      {
        $is_member_logged_in = true;
      }
    }

    return $is_member_logged_in;
  }

  public static function is_continuation_member($member_id)
  {
    global $wpdb;
    if (!$member_id) return false;
    $continuation_table = $wpdb->prefix . 'usces_continuation';
    $sql = $wpdb->prepare("SELECT `con_id` FROM {$continuation_table} WHERE `con_member_id` = %d AND `con_status` = 'continuation'", $member_id);
    $con_id = $wpdb->get_var($sql);
    return $con_id ? true : false;
  }

  public static function get_continuation_order_id($member_id)
  {
    global $wpdb;
    $continuation_table = $wpdb->prefix . 'usces_continuation';
    $sql = $wpdb->prepare("SELECT `con_order_id` FROM {$continuation_table} WHERE `con_member_id` = %d AND `con_status` = 'continuation'", $member_id);
    $order_id = $wpdb->get_var($sql);
    return $order_id;
  }

}