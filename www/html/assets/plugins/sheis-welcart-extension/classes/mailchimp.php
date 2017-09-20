<?php

namespace Sheis\Welcart\Extension;

class Mailchimp
{
  protected $client;
  protected $list_id;

  public function __construct()
  {
    add_action('init', array($this, 'initialize'));
  }

  public function initialize()
  {
    if (!file_exists(SHEIS_WELCART_EX_PATH . 'vendor/autoload.php'))
    {
      add_action('admin_notices', function() {
        echo '<div class="error"><p><b>"Sheis Welcart Extension"</b> plugin has an error. Composer is not installed.<br>Please run "./composer.phar install" in the plugin directory.</p></div>';
      });

      return;
    }

    add_action('si_registration_complete', array($this, 'registration'), 10, 2);
    add_action('si_profile_edit_complete', array($this, 'profile_edit'), 10, 2);
  }

  public function registration($data, $custom_data)
  {
    if (!isset($custom_data['mail_magazine']) || $custom_data['mail_magazine'] !== '希望する') return;
    $this->add($data['mailaddress1']);
  }

  public function profile_edit($data, $custom_data)
  {
    if (!isset($custom_data['mail_magazine']) || empty($data['old_mailaddress'])) return;

    $result = $this->get($data['old_mailaddress']);

    if ($custom_data['mail_magazine'] === '希望する')
    {
      // Mailchimpに登録なし
      if (!$result)
      {
        $this->add($data['mailaddress1']);
      }
      // メールアドレス変更
      elseif ($result['email_address'] !== $data['mailaddress1'])
      {
        $this->update($result['email_address'], $data['mailaddress1']);
      }
    }
    else
    {
      // Mailchimpに登録あり
      if ($result !== false)
      {
        $this->delete($result['email_address']);
      }
    }
  }

  public function get($mailaddress)
  {
    $client = $this->get_client();
    if (!$client) return false;

    $hash = $client->subscriberHash($mailaddress);
    $result = $client->get('lists/' . $this->get_list_id() . '/members/' . $hash);

    return $client->success() ? $result : false;
  }

  public function add($mailaddress)
  {
    $client = $this->get_client();
    if (!$client) return false;

    $result = $client->post('lists/' . $this->get_list_id() . '/members', array(
      'email_address' => $mailaddress,
      'status'        => 'subscribed',
    ));

    $log = array(
      'email_address' => $mailaddress,
      'result'        => $result,
    );

    usces_log('mailchimp create data : ' . print_r($log, true), 'mailchimp.log');
  }

  public function update($old_mailaddress, $new_mailaddress)
  {
    $client = $this->get_client();
    if (!$client) return false;

    $hash = $client->subscriberHash($old_mailaddress);
    $result = $client->patch('lists/' . $this->get_list_id() . '/members/' . $hash, array(
      'email_address' => $new_mailaddress,
    ));

    $log = array(
      'old_email_address' => $old_mailaddress,
      'new_email_address' => $new_mailaddress,
      'result'            => $result,
    );

    usces_log('mailchimp update data : ' . print_r($log, true), 'mailchimp.log');
  }

  public function delete($mailaddress)
  {
    $client = $this->get_client();
    if (!$client) return false;

    $hash = $client->subscriberHash($mailaddress);
    $result = $client->delete('lists/' . $this->get_list_id() . '/members/' . $hash);

    $log = array(
      'email_address' => $mailaddress,
      'result'        => $result,
    );

    usces_log('mailchimp delete data : ' . print_r($log, true), 'mailchimp.log');
  }

  protected function get_client()
  {
    if (is_a($this->client, '\DrewM\MailChimp\MailChimp')) return $this->client;

    require_once SHEIS_WELCART_EX_PATH . 'vendor/autoload.php';

    $config = Config::get('mailchimp');
    if (empty($config['api_key']) || empty($config['list_id'])) return false;

    return new \DrewM\MailChimp\MailChimp($config['api_key']);
  }

  protected function get_list_id()
  {
    if (!empty($this->list_id)) return $this->list_id;

    $config = Config::get('mailchimp');
    return !empty($config['list_id']) ? $config['list_id'] : false;
  }
}

new Mailchimp;
