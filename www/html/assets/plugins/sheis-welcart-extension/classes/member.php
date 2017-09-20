<?php

namespace Sheis\Welcart\Extension;

class Member
{
  protected $template;
  protected $error;
  protected $limited_category_slug;

  public function __construct()
  {
    add_action('wp', array($this, 'limited_redirect'), 1);

    add_action('wp', array($this, 'controller'), 5);
    add_action('template_redirect', array($this, 'template_redirect'));

    add_filter('pre_post_link', array($this, 'adjust_members_article_link'), 10, 2);

    $this->error = new \WP_Error();
    $this->limited_category_slug = Config::get('members_limited_category_slug');
  }

  public function limited_redirect()
  {
    $redirect = '';

    if (is_category($this->limited_category_slug))
    {
      $redirect = home_url('members/article/');
    }
    elseif (is_single() && in_category($this->limited_category_slug))
    {
      $redirect = get_the_permalink();
    }

    if ($redirect)
    {
      wp_safe_redirect($redirect);
      exit;
    }
  }

  public function controller()
  {
    if (!is_page('members')
      && !is_page('login')
      && !is_page('forget')) return;

    if (is_page('members'))
    {
      if (!Helper::is_member_logged_in())
      {
        Helper::member_logout();
        wp_safe_redirect(home_url('login/'));
        exit;
      }

      $action = 'action_' . get_query_var('si_action');

      if (is_callable(array($this, $action)))
      {
        $this->{$action}();
      }
      else
      {
        $this->action_mypage();
      }
    }
    else
    {
      $action = 'action_' . get_query_var('pagename');
      if (is_callable(array($this, $action))) $this->{$action}();
    }
  }

  public function action_mypage()
  {
    $this->set_template('members/mypage');
  }

  public function action_profile()
  {
    if ($si_param1 = get_query_var('si_param1'))
    {
      switch ($si_param1)
      {
        case 'edit':
          $this->action_profile_edit();
          break;

        case 'complete':
          $this->action_profile_complete();
          break;
      }

      return;
    }

    set_title('登録情報');
    $this->set_template('members/profile');
  }

  public function action_profile_edit()
  {
    global $usces, $wpdb;

    if (Helper::is_post())
    {
      $nonce = isset($_POST['_profile_form_nonce']) ? $_POST['_profile_form_nonce'] : '';

      if (!wp_verify_nonce($nonce, 'profile-edit-form'))
      {
        wp_safe_redirect(home_url('members/profile/'));
        exit;
      }

      switch (Helper::get_post('si_profile_action'))
      {
        case 'confirm':
          if (!$this->validate_profile())
          {
            $this->set_template('members/profile-edit');
            return;
          }

          $_SESSION['si_profile_data'] = Helper::get_post('member');
          $_SESSION['si_profile_custom_data'] = Helper::get_post('custom_member');
          $_SESSION['si_profile_delivery_data'] = array_merge(array(
            'name1'    => '',
            'name2'    => '',
            'name3'    => '',
            'name4'    => '',
            'zipcode'  => '',
            'address1' => '',
            'address2' => '',
            'address3' => '',
            'tel'      => '',
            'fax'      => '',
            'country'  => '',
            'pref'     => '',
          ), Helper::get_post('delivery'));

          $this->set_template('members/profile-confirm');
          break;

        case 'save':
          $member_table = $wpdb->prefix . 'usces_member';
          $order_table = $wpdb->prefix . 'usces_order';

          $member_id = $_SESSION['usces_member']['ID'];
          $order_id = Helper::get_continuation_order_id($member_id);

          if (!$member_id || !$order_id)
          {
            wp_safe_redirect(home_url('members/profile/'));
            exit;
          }

          $member = $_SESSION['si_profile_data'];
          $custom_member = $_SESSION['si_profile_custom_data'];
          $delivery = $_SESSION['si_profile_delivery_data'];

          $password = !empty($member['password2']) ? usces_get_hash($member['password1']) : '';
          $birthday = sprintf('%04d', $custom_member['birthday_y']) . sprintf('%02d', $custom_member['birthday_m']) . sprintf('%02d', $custom_member['birthday_d']);

          $data = array(
            'mem_email'    => $member['mailaddress1'],
            'mem_name1'    => $member['name1'],
            'mem_name2'    => $member['name2'],
            'mem_name3'    => $member['name3'],
            'mem_name4'    => $member['name4'],
            'mem_zip'      => $member['zipcode'],
            'mem_pref'     => $member['pref'],
            'mem_address1' => $member['address1'],
            'mem_address2' => $member['address2'],
            'mem_address3' => $member['address3'],
            'mem_tel'      => $member['tel'],
          );

          if ($password) $data['mem_pass'] = $password;

          $result = $wpdb->update($member_table, $data, array('ID' => $member_id));

          if ($result === false)
          {
            wp_die('登録情報変更に失敗しました');
          }

          $usces->set_member_meta_value('csmb_birthday', $birthday, $member_id);

          $csmb_meta = usces_has_custom_field_meta('member');
          foreach ($custom_member as $k => $v)
          {
            if (!array_key_exists($k, $csmb_meta)) continue;
            $usces->set_member_meta_value('csmb_' . $k, $v, $member_id);
          }

          $result = $wpdb->update($order_table, array(
            'order_delivery' => serialize($delivery),
          ), array(
            'ID' => $order_id
          ));

          if ($result === false)
          {
            wp_die('配送先情報変更に失敗しました');
          }

          $this->set_session_data();

          do_action('si_profile_edit_complete', $member, $custom_member);

          wp_safe_redirect(wp_nonce_url(home_url('members/profile/complete/'), 'profile-edit-complete', '_nonce'));
          exit;

          break;
      }

      return;
    }

    wp_enqueue_script('usces_ajaxzip3', 'https://ajaxzip3.github.io/ajaxzip3.js');

    set_title('登録情報変更');
    $this->set_template('members/profile-edit');
  }

  public function action_profile_complete()
  {
    if (!isset($_GET['_nonce']) || !wp_verify_nonce($_GET['_nonce'], 'profile-edit-complete'))
    {
      wp_safe_redirect(home_url('members/profile/'));
      exit;
    }

    set_title('登録情報変更');
    $this->set_template('members/profile-complete');
  }

  public function action_card()
  {
    global $usces;

    if (get_query_var('si_param1') !== 'complete' || !isset($_GET['_nonce']) || !wp_verify_nonce($_GET['_nonce'], 'card-complete'))
    {
      wp_safe_redirect(home_url('members/profile/'));
      exit;
    }

    $member_id = Helper::get_current_member_id();
    $usces->set_member_meta_value('csmb_updated_card_date', date_i18n('Y-m-d H:i:s'), $member_id);

    $settle_status = $usces->get_member_meta_value('csmb_settle_status', $member_id);
    if ($settle_status === '決済失敗') $usces->set_member_meta_value('csmb_settle_status', '未決済', $member_id);

    set_title('カード情報変更');
    $this->set_template('members/card-complete');
  }

  public function action_cancel()
  {
    set_title('解約手続き');
    $this->set_template('members/cancel');
  }

  public function action_order()
  {
    set_title('配達情報');
    $this->set_template('members/order');
  }

  public function action_article()
  {
    global $wp_query, $post;

    $si_param1 = get_query_var('si_param1');

    if ($si_param1)
    {
      $post = get_page_by_path($si_param1, OBJECT, 'post');
      if (!$post) Helper::do_404();

      add_action('loop_start', function($query) use($post)
      {
        $query->posts = array($post);
      });

      set_title(get_the_title($post));
      $this->set_template('members/single');
      return;
    }

    set_title('会員限定記事一覧');
    $this->set_template('members/archive');
    return;
  }

  public function action_login()
  {
    global $usces;

    if (Helper::is_member_logged_in())
    {
      wp_safe_redirect(home_url('members/'));
      exit;
    }

    if (Helper::is_post())
    {
      if (!$this->validate_login()) return;

      if ($usces->member_login() === 'member')
      {
        $usces->get_current_member();
        $member_id = $usces->current_member['id'];

        if (Helper::is_continuation_member($member_id))
        {
          if ((int)Helper::get_post('remembermail') === 1)
          {
            $usces->set_cookie(array(
              'loginmail'    => Helper::get_post('loginmail'),
              'remembermail' => Helper::get_post('remembermail'),
            ), 'si_login');
          }

          $this->set_session_data();

          wp_safe_redirect(home_url('members/'));
          exit;
        }
      }

      $this->error->add('login', 'メールアドレス・パスワードが間違っている、<br>または会員登録されていません。');
      Helper::member_logout();
    }
  }

  public function action_logout()
  {
    Helper::member_logout();
    wp_safe_redirect(home_url('/'));
    exit;
  }

  public function action_forget()
  {
    global $wpdb;

    if (isset($_GET['_nonce']) && wp_verify_nonce($_GET['_nonce'], 'forget-password-complete'))
    {
      $this->set_template('members/forget-complete');
      return;
    }

    if (Helper::is_post())
    {
      $nonce = isset($_POST['_forget_password_nonce']) ? $_POST['_forget_password_nonce'] : '';

      if (!wp_verify_nonce($nonce, 'forget-password-form'))
      {
        wp_safe_redirect(home_url('forget/'));
        exit;
      }

      $loginmail = Helper::get_post('loginmail');

      if (!$loginmail)
      {
        $this->error->add('loginmail', 'メールアドレスを入力してください');
      }
      elseif (!is_email($loginmail))
      {
        $this->error->add('loginmail', '無効なメールアドレスです');
      }
      elseif (!Helper::is_member_exists($loginmail))
      {
        $this->error->add('loginmail', 'こちらのメールアドレスは登録されていません');
      }

      if (!$this->error->get_error_code())
      {
        $temporary_password = wp_generate_password(16, true);
        $temporary_password_hash = usces_get_hash($temporary_password);

        $member_table = $wpdb->prefix . 'usces_member';
        $result = $wpdb->update($member_table, array('mem_pass' => $temporary_password_hash), array('mem_email' => $loginmail));

        if (!$result) wp_die('パスワードを変更できませんでした');

        $result = false;
        $template = Config::get('mail_template', 'forget_password');

        if ($template)
        {
          $headers = array();
          $headers[] = 'From: ' . $template['from'];
          $subject = $template['subject'];
          $body = str_replace('[temporary_password]', $temporary_password, $template['body']);
          $to = $loginmail;

          $result = @wp_mail($to, $subject, $body, implode("\r\n", $headers));
        }

        if (!$result)
        {
          $this->error->add('loginmail', 'メールを送信できませんでした');
        }
        else
        {
          wp_safe_redirect(wp_nonce_url(home_url('forget/'), 'forget-password-complete', '_nonce'));
          exit;
        }
      }
    }

    set_title('パスワードを忘れた方');
    $this->set_template('members/forget');
  }

  public function validate_login()
  {
    if (!Helper::get_post('loginmail')) $this->error->add('loginmail', 'メールアドレスを入力してください');
    if (!Helper::get_post('loginpass')) $this->error->add('loginpass', 'パスワードを入力してください');
    return !$this->error->get_error_code();
  }

  public function validate_profile()
  {
    global $usces;

    if (!Helper::get_post('member.name1')) $this->error->add('name1', '必須項目です');
    if (!Helper::get_post('member.name2')) $this->error->add('name2', '必須項目です');
    if (!Helper::get_post('member.name3')) $this->error->add('name3', '必須項目です');
    if (!Helper::get_post('member.name4')) $this->error->add('name4', '必須項目です');
    if (!Helper::get_post('member.zipcode')) $this->error->add('zipcode', '必須項目です');
    if (!Helper::get_post('member.pref')) $this->error->add('pref', '必須項目です');
    if (!Helper::get_post('member.address1')) $this->error->add('address1', '必須項目です');
    if (!Helper::get_post('member.address2')) $this->error->add('address2', '必須項目です');

    if (!Helper::get_post('custom_member.gender')) $this->error->add('gender', '必須項目です');
    if (!Helper::get_post('custom_member.mail_magazine')) $this->error->add('mail_magazine', '必須項目です');
    if (!Helper::get_post('custom_member.size')) $this->error->add('size', '必須項目です');

    if ((int)Helper::get_post('delivery.delivery_flag') === 1)
    {
      if (!Helper::get_post('delivery.zipcode')) $this->error->add('delivery_zipcode', '必須項目です');
      if (!Helper::get_post('delivery.pref')) $this->error->add('delivery_pref', '必須項目です');
      if (!Helper::get_post('delivery.address1')) $this->error->add('delivery_address1', '必須項目です');
      if (!Helper::get_post('delivery.address2')) $this->error->add('delivery_address2', '必須項目です');
    }

    $tel = Helper::get_post('member.tel');

    if (!$tel)
    {
      $this->error->add('tel', '必須項目です');
    }
    else
    {
      $tel = mb_convert_kana($tel, 'as', 'UTF-8');
      $tel = str_replace('-', '', $tel);

      if (preg_match('/[^0-9]/', $tel) || strlen($tel) < 9 || strlen($tel) > 11)
      {
        $this->error->add('tel', '電話番号は数字9桁〜11桁で入力してください');
      }
      else
      {
        $_POST['member']['tel'] = $tel;
      }
    }

    $birth_y = Helper::get_post('custom_member.birthday_y');
    $birth_m = Helper::get_post('custom_member.birthday_m');
    $birth_d = Helper::get_post('custom_member.birthday_d');

    if (!$birth_y || !$birth_m || !$birth_d)
    {
      $this->error->add('birthday', '必須項目です');
    }
    elseif (!checkdate($birth_m, $birth_d, $birth_y))
    {
      $this->error->add('birthday', '無効な日付です');
    }

    $old_mailaddress = Helper::get_post('member.old_mailaddress');
    $mailaddress1 = Helper::get_post('member.mailaddress1');
    $mailaddress2 = Helper::get_post('member.mailaddress2');

    if ($old_mailaddress !== $mailaddress1)
    {
      if (!$mailaddress1)
      {
        $this->error->add('mailaddress1', '必須項目です');
      }
      elseif (!is_email($mailaddress1))
      {
        $this->error->add('mailaddress1', '無効なメールアドレスです');
      }

      if (!$mailaddress2)
      {
        $this->error->add('mailaddress2', '必須項目です');
      }
      elseif ($mailaddress1 !== $mailaddress2)
      {
        $this->error->add('mailaddress2', 'メールアドレスが一致しません');
      }

      if ($mailaddress1 === $mailaddress2 && Helper::is_member_exists($mailaddress1, Helper::get_current_member_id()))
      {
        $this->error->add('mailaddress1', sprintf('%s は既に登録済みです', $mailaddress1));
      }
    }

    $password1 = Helper::get_post('member.password1');
    $password2 = Helper::get_post('member.password2');

    if ($password1)
    {
      $password_rule_min = $usces->options['system']['member_pass_rule_min'];
      $password_rule_max = $usces->options['system']['member_pass_rule_max'];

      if ($password_rule_min && $password_rule_min > strlen($password1))
      {
        $this->error->add('password1', sprintf('パスワードは%s文字以上で入力してください', $password_rule_min));
      }
      elseif ($password_rule_max && $password_rule_min < strlen($password1))
      {
        $this->error->add('password1', sprintf('パスワードは%s文字以下で入力してください', $password_rule_max));
      }

      if (!$password2)
      {
        $this->error->add('password2', '必須項目です');
      }
      elseif ($password1 !== $password2)
      {
        $this->error->add('password2', 'パスワードが一致しません');
      }
    }

    return !$this->error->get_error_code();
  }

  public function template_redirect()
  {
    if ($this->template)
    {
      $tpl = $this->template;
      if (!locate_template("$tpl.php")) Helper::do_404();
      get_template_part($tpl);
      exit;
    }
  }

  public function adjust_members_article_link($permalink, $post)
  {
    if ($categories = get_the_category($post->ID))
    {
      $category = reset($categories);
      if (in_array($category->slug, $this->limited_category_slug))
      {
        $permalink = str_replace('%category%', 'members/article', $permalink);
      }
    }

    return $permalink;
  }

  public function set_session_data()
  {
    global $usces;

    $member = $usces->get_member();
    $usces->set_member_session_data($member['ID']);
    $order_id = Helper::get_continuation_order_id($member['ID']);
    $order = $usces->get_order_data($order_id, 'direct');

    if ($order)
    {
      $order_delivery = !empty($order['order_delivery']) ? unserialize($order['order_delivery']) : '';
      $_SESSION['usces_member']['delivery_flag'] = isset($order_delivery['delivery_flag']) ? (int)$order_delivery['delivery_flag'] : 0;
      $_SESSION['usces_member']['delivery_zipcode'] = isset($order_delivery['zipcode']) ? $order_delivery['zipcode'] : '';
      $_SESSION['usces_member']['delivery_pref'] = isset($order_delivery['pref']) ? $order_delivery['pref'] : '';
      $_SESSION['usces_member']['delivery_address1'] = isset($order_delivery['address1']) ? $order_delivery['address1'] : '';
      $_SESSION['usces_member']['delivery_address2'] = isset($order_delivery['address2']) ? $order_delivery['address2'] : '';
      $_SESSION['usces_member']['delivery_address3'] = isset($order_delivery['address3']) ? $order_delivery['address3'] : '';
    }
  }

  public function get_error_message($key)
  {
    return $this->error->get_error_message($key);
  }

  public function get_member()
  {
    global $usces;
    $member = $usces->get_member();
    return $member;
  }

  public function get_member_data($key = null)
  {
    $member = $this->get_member();
    if ($key === null) return $member;

    $data = null;

    if (isset($member[$key]))
    {
      $data = $member[$key];
    }
    elseif (isset($member['custom_member'][$key]))
    {
      $data = $member['custom_member'][$key];
    }

    return $data;
  }

  protected function set_template($template)
  {
    $this->template = $template;
  }

}

global $si_member;
$si_member = new Member;
