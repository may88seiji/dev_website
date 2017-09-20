<?php

namespace Sheis\Welcart\Extension\Admin;

use Sheis\Welcart\Extension\Config;

class NonContinuationMember
{
  public function __construct()
  {
    add_action('admin_menu', array($this, 'add_menu'));
    add_action('admin_init', array($this, 'delete_non_continuation_members'));
    add_action('admin_init', array($this, 'cron_init'));
    add_action('admin_notices', array($this, 'notices'));

    add_action('si_reregistration_mail', array($this, 'delete_non_continuation_members'));
  }

  public function add_menu()
  {
    add_submenu_page('usces_orderlist', '非継続課金会員リスト', '非継続課金会員リスト', 'administrator', 'si_non_continuation', array($this, 'non_continuation_member_list_page'));
  }

  public function notices()
  {
    global $usces;

    if ($message = get_transient('reregistration_mail_sended'))
    {
      $usces->action_status = 'success';
      $usces->action_message = $message;
    }
    elseif ($message = get_transient('reregistration_mail_error'))
    {
      $usces->action_status = 'error';
      $usces->action_message = $message;
    }
  }

  public function non_continuation_member_list_page()
  {
    $results = $this->get_non_continuation_members();
    $total = count($results);
    include_once __DIR__ . '/../../views/admin/non-continuation-member-list.php';
  }

  public function delete_non_continuation_members()
  {
    $is_cron = defined('DOING_CRON') && DOING_CRON;

    if ($is_cron)
    {
      $members = $this->get_non_continuation_members();
      $this->send_mail_and_delete($members);
      return;
    }

    if (strtolower($_SERVER['REQUEST_METHOD']) === 'post' && isset($_POST['si_action_nonce']) && check_admin_referer('send_reregistration_mail', 'si_action_nonce'))
    {
      if (empty($_POST['listcheck']))
      {
        set_transient('reregistration_mail_error', '送信先が選択されていません', 5);
      }
      else
      {
        $members = $this->get_non_continuation_members($_POST['listcheck']);
        $this->send_mail_and_delete($members);
        set_transient('reregistration_mail_sended', '再登録案内メールを送信しました', 5);
      }

      wp_safe_redirect(menu_page_url('si_non_continuation', false));
      return;
    }
  }

  public function get_non_continuation_members($member_ids = '')
  {
    global $wpdb;

    $member_table = $wpdb->prefix . 'usces_member';
    $continuation_table = $wpdb->prefix . 'usces_continuation';

    $where = '';

    if ($member_ids)
    {
      if (!is_array($member_ids)) $member_ids = array($member_ids);
      $member_ids = array_map('absint', $member_ids);
      $where = "AND member.`ID` IN (" . implode(',', $member_ids) . ")";
    }
    elseif (defined('DOING_CRON') && DOING_CRON)
    {
      $where = "AND member.`mem_registered` < DATE_SUB('" . current_time('mysql') . "', INTERVAL 1 HOUR)";
    }

    $sql = "SELECT * FROM `{$member_table}` as member LEFT JOIN `{$continuation_table}` as con ON member.`ID` = con.`con_member_id` AND con.`con_status` = 'continuation' WHERE con.`con_id` IS NULL {$where}";
    return $wpdb->get_results($sql);
  }

  public function send_mail_and_delete($members)
  {
    if (!$members) return false;

    $template = Config::get('mail_template', 'reregistraion');
    if (!$template) return false;

    $headers = array();
    $headers[] = 'From: ' . $template['from'];
    $subject = $template['subject'];

    foreach ($members as $member)
    {
      if (!$member->mem_email) continue;

      $member_name = $member->mem_name1 . ' ' . $member->mem_name2;
      if ($member_name === ' ') $member_name = '';
      $body = str_replace('[member_name]', $member_name ?: '', $template['body']);
      $to = $member->mem_email;

      $result = @wp_mail($to, $subject, $body, implode("\r\n", $headers));

      if ($result) usces_delete_memberdata($member->ID);
    }
  }

  public function cron_init()
  {
    if (!wp_next_scheduled('si_reregistration_mail'))
    {
      wp_schedule_event(time(), 'hourly', 'si_reregistration_mail');
    }
  }
}

new NonContinuationMember;
