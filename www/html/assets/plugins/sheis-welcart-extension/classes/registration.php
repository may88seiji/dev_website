<?php

namespace Sheis\Welcart\Extension;

class Registration
{
  protected $data = array();
  protected $custom_data = array();
  protected $delivery_data = array();
  protected $template;
  protected $error;

  public function __construct()
  {
    add_action('wp', array($this, 'controller'));
    add_action('template_redirect', array($this, 'template_redirect'));

    // 2017-11-01 以前の登録の場合は初回決済日を調整
    add_filter('dlseller_filter_first_charging', array($this, 'adjust_first_charging_date'));

    $this->error = new \WP_Error();
  }

  public function controller()
  {
    if (!is_page('registration')) return;

    $this->data = isset($_SESSION['registration_data']) ? $_SESSION['registration_data'] : array();
    $this->custom_data = isset($_SESSION['registration_custom_data']) ? $_SESSION['registration_custom_data'] : array();
    $this->delivery_data = isset($_SESSION['registration_delivery_data']) ? $_SESSION['registration_delivery_data'] : array();

    switch(get_query_var('si_action'))
    {
      case 'registration':
        $this->init_session();
        break;

      case 'step1':
        $this->check_request();
        $this->action_step1();
        $this->set_session_registration();
        break;

      case 'step2':
        $this->check_request();
        $this->action_step2();
        $this->set_session_registration();
        break;

      case 'step3':
        $this->check_request();
        $this->action_step3();
        $this->set_session_registration();
        break;

      case 'confirm':
        $this->check_request(home_url('registration/error/'));
        $this->action_confirm();
        $this->set_session_registration();
        break;

      case 'thankyou':
        $this->action_thankyou();
        break;

      case 'error':
        $this->action_error();
        break;
    }
  }

  public function action_step1()
  {
    if (Helper::is_member_logged_in())
    {
      wp_safe_redirect(home_url('members/'));
      exit;
    }

    if (Helper::is_post()) $this->clear_data();
    $this->set_template('step1');
  }

  public function action_step2()
  {
    if (Helper::is_post())
    {
      $this->data = array_merge($this->data, array_map('trim', $_POST['member']));
      $this->custom_data = array_merge($this->custom_data, array_map('trim', $_POST['custom_member']));

      if (!$this->validate_step1())
      {
        $this->set_template('step1');
        return;
      }
    }

    $this->set_template('step2');
  }

  public function action_step3()
  {
    global $usces;

    if (Helper::is_post())
    {
      $this->data = array_merge($this->data, array_map('trim', $_POST['member']));
      if (isset($_POST['delivery']))
      {
        $this->delivery_data = array_merge($this->delivery_data, array_map('trim', $_POST['delivery']));

        /**
         * Welcart対策
         * usc-e-shop/classes/cart.class.php L405-412
        **/
        $_POST['delivery']['delivery_flag'] = 1;
      }

      if (!$this->validate_step2())
      {
        $this->set_template('step2');
        return;
      }

      $usces->cart->entry();
    }

    $this->set_template('step3');
  }

  public function action_confirm()
  {
    global $usces, $wpdb;

    if (Helper::is_post())
    {
      $this->custom_data = array_merge($this->custom_data, array_map('trim', $_POST['custom_member']));

      if (!$this->validate_step3())
      {
        $this->set_template('step3');
        return;
      }

      // 会員登録
      $member_table = $wpdb->prefix . 'usces_member';

      $point = $usces->options['start_point'];
      $password = usces_get_hash($this->data['password1']);
      $birthday = sprintf('%04d', $this->custom_data['birthday_y']) . sprintf('%02d', $this->custom_data['birthday_m']) . sprintf('%02d', $this->custom_data['birthday_d']);

      $result = $wpdb->insert($member_table, array(
        'mem_email'         => $this->get_value('mailaddress1'),
        'mem_pass'          => $password,
        'mem_status'        => 0,
        'mem_cookie'        => '',
        'mem_point'         => $point,
        'mem_name1'         => $this->get_value('name1'),
        'mem_name2'         => $this->get_value('name2'),
        'mem_name3'         => $this->get_value('name3'),
        'mem_name4'         => $this->get_value('name4'),
        'mem_zip'           => $this->get_value('zipcode'),
        'mem_pref'          => $this->get_value('pref'),
        'mem_address1'      => $this->get_value('address1'),
        'mem_address2'      => $this->get_value('address2'),
        'mem_address3'      => $this->get_value('address3'),
        'mem_tel'           => $this->get_value('tel'),
        'mem_fax'           => $this->get_value('fax'),
        'mem_delivery_flag' => '',
        'mem_delivery'      => '',
        'mem_registered'    => get_date_from_gmt(gmdate('Y-m-d H:i:s', time())),
        'mem_nicename'      => '',
      ));

      if ($result === false)
      {
        wp_die('会員登録に失敗しました');
      }

      $this->data['ID'] = $wpdb->insert_id;

      $usces->set_member_meta_value('customer_country', 'JP', $this->data['ID']);
      $usces->set_member_meta_value('csmb_birthday', $birthday, $this->data['ID']);

      $csmb_meta = usces_has_custom_field_meta('member');

      foreach ($this->custom_data as $k => $v)
      {
        if (!array_key_exists($k, $csmb_meta)) continue;
        $usces->set_member_meta_value('csmb_' . $k, $v, $this->data['ID']);
      }
    }

    if ('login' === $usces->member_just_login($this->data['mailaddress1'], $this->data['password1']))
    {
      wp_safe_redirect(home_url('registration/'));
      exit;
    }

    if (false === $usces->cart->num_row())
    {
      wp_safe_redirect(home_url('registration/'));
      exit;
    }

    $usces->cart->entry();

    if ('' !== $usces->zaiko_check())
    {
      wp_safe_redirect(home_url('registration/'));
      exit;
    }

    if(usces_is_member_system() && usces_is_member_system_point() && $usces->is_member_logged_in())
    {
      $member_table = $wpdb->prefix . 'usces_member';
      $query = $wpdb->prepare("SELECT mem_point FROM $member_table WHERE ID = %d", $_SESSION['usces_member']['ID']);
      $mem_point = $wpdb->get_var( $query );
      $_SESSION['usces_member']['point'] = $mem_point;
    }

    usces_get_entries();
    usces_get_carts();
    usces_get_members();

    $this->set_template('confirm');
  }

  public function action_thankyou()
  {
    global $usces;

    if ($usces->cart->num_row() === false)
    {
      wp_safe_redirect(home_url('registration/'));
      exit;
    }

    $_GET['acting'] = 'remise_card';
    $_REQUEST['acting_return'] = 1;

    $payment_results = usces_check_acting_return();

    if (!$this->data || (isset($payment_results[0]) && $payment_results[0] === 'duplicate'))
    {
      wp_safe_redirect(home_url('registration/'));
      exit;
    }
    elseif (isset($payment_results[0]) && $payment_results[0])
    {
      if ($payment_results['reg_order'])
      {
        // Order登録時に受注メールを送信しないための対応
        add_action('usces_post_reg_orderdata', function($order_id, $result) use($usces)
        {
          if ($order_id)
          {
            if (isset($_REQUEST['wctid'])) usces_ordered_acting_data($_REQUEST['wctid']);
            do_action('si_registration_complete', $this->data, $this->custom_data);
            usces_send_regmembermail($this->data);
            $usces->cart->clear_cart();
            $this->clear_data();

            get_template_part('registration/thankyou');
          }
          else
          {
            wp_safe_redirect(home_url('registration/error/'));
          }

          exit;
        }, 9999, 2);

        $usces->order_processing($payment_results);
      }

      do_action('si_registration_complete', $this->data, $this->custom_data);
      usces_send_regmembermail($this->data);
    }

    $usces->cart->clear_cart();
    $this->clear_data();

    $this->set_template('thankyou');
  }

  public function action_error()
  {

    $this->set_template('error');
  }

  public function validate_step1()
  {
    global $usces;

    if (!$this->get_value('name1')) $this->error->add('name1', '必須項目です');
    if (!$this->get_value('name2')) $this->error->add('name2', '必須項目です');
    if (!$this->get_value('name3')) $this->error->add('name3', '必須項目です');
    if (!$this->get_value('name4')) $this->error->add('name4', '必須項目です');
    if (!$this->get_value('gender')) $this->error->add('gender', '必須項目です');
    if (!$this->get_value('mail_magazine')) $this->error->add('mail_magazine', '必須項目です');

    $birth_y = $this->get_value('birthday_y');
    $birth_m = $this->get_value('birthday_m');
    $birth_d = $this->get_value('birthday_d');

    if (!$birth_y || !$birth_m || !$birth_d)
    {
      $this->error->add('birthday', '必須項目です');
    }
    elseif (!checkdate($birth_m, $birth_d, $birth_y))
    {
      $this->error->add('birthday', '無効な日付です');
    }

    $mailaddress1 = $this->get_value('mailaddress1');
    $mailaddress2 = $this->get_value('mailaddress2');

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

    if ($mailaddress1 === $mailaddress2 && Helper::is_member_exists($mailaddress1))
    {
      $this->error->add('mailaddress1', sprintf('%s は既に登録済みです', $mailaddress1));
    }

    $password1 = $this->get_value('password1');
    $password2 = $this->get_value('password2');

    $password_rule_min = $usces->options['system']['member_pass_rule_min'];
    $password_rule_max = $usces->options['system']['member_pass_rule_max'];

    if (!$password1)
    {
      $this->error->add('password1', '必須項目です');
    }
    elseif ($password_rule_min && $password_rule_min > strlen($password1))
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

    return !$this->error->get_error_code();
  }

  public function validate_step2()
  {
    if (!$this->get_value('zipcode')) $this->error->add('zipcode', '必須項目です');
    if (!$this->get_value('pref')) $this->error->add('pref', '必須項目です');
    if (!$this->get_value('address1')) $this->error->add('address1', '必須項目です');
    if (!$this->get_value('address2')) $this->error->add('address2', '必須項目です');

    $tel = $this->get_value('tel');

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
        $this->data['tel'] = $tel;
      }
    }

    if ($this->get_delivery_value('delivery_flag'))
    {
      if (!$this->get_delivery_value('zipcode')) $this->error->add('delivery_zipcode', '必須項目です');
      if (!$this->get_delivery_value('pref')) $this->error->add('delivery_pref', '必須項目です');
      if (!$this->get_delivery_value('address1')) $this->error->add('delivery_address1', '必須項目です');
      if (!$this->get_delivery_value('address2')) $this->error->add('delivery_address2', '必須項目です');
    }

    return !$this->error->get_error_code();
  }

  public function validate_step3()
  {
    if (!$this->get_value('size')) $this->error->add('size', '必須項目です');
    return !$this->error->get_error_code();
  }

  public function get_value($key)
  {
    if (isset($this->data[$key])) return $this->data[$key];
    if (isset($this->custom_data[$key])) return $this->custom_data[$key];
  }

  public function get_delivery_value($key)
  {
    if (isset($this->delivery_data[$key])) return $this->delivery_data[$key];
  }

  public function get_error_message($key)
  {
    return $this->error->get_error_message($key);
  }

  public function template_redirect()
  {
    if ($this->template)
    {
      $tpl = "registration/{$this->template}";
      if (!locate_template("$tpl.php")) do_404();
      get_template_part($tpl);
      exit;
    }
  }

  public function adjust_first_charging_date($time)
  {
    if (date_i18n('Ymd') < '20171101') $time = strtotime('20171101');
    return $time;
  }

  protected function check_request($redirect = '')
  {
    $nonce = '';

    if (Helper::is_post())
    {
      $nonce = isset($_POST['_registration_form_nonce']) ? $_POST['_registration_form_nonce'] : '';
    }
    else
    {
      $nonce = isset($_GET['_nonce']) ? $_GET['_nonce'] : '';
    }

    if (!wp_verify_nonce($nonce, 'registration-form'))
    {
      if (!$redirect) $redirect = home_url('registration/');
      wp_safe_redirect($redirect);
      exit;
    }
  }

  protected function set_template($template)
  {
    if ($template === 'step2') wp_enqueue_script('usces_ajaxzip3', 'https://ajaxzip3.github.io/ajaxzip3.js');
    $this->template = $template;
  }

  protected function init_session()
  {
    $_SESSION['registration_data'] = array();
    $_SESSION['registration_custom_data'] = array();
    $_SESSION['registration_delivery_data'] = array();
  }

  protected function set_session_registration()
  {
    $_SESSION['registration_data'] = $this->data;
    $_SESSION['registration_custom_data'] = $this->custom_data;
    $_SESSION['registration_delivery_data'] = $this->delivery_data;
  }

  protected function unset_session()
  {
    unset($_SESSION['registration_data'], $_SESSION['registration_custom_data'], $_SESSION['registration_delivery_data']);
  }

  protected function clear_data()
  {
    $this->data = array();
    $this->custom_data = array();
    $this->delivery_data = array();
    $this->unset_session();
  }
}

global $si_registration;
$si_registration = new Registration;
