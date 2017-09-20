<?php

namespace Sheis\Welcart\Extension;

defined('SHEIS_MAILCHIMP_API_KEY') || define('SHEIS_MAILCHIMP_API_KEY', '');
defined('SHEIS_MAILCHIMP_LIST_ID') || define('SHEIS_MAILCHIMP_LIST_ID', '');

class Config
{

  public static function get($name, $key = null)
  {
    if (!$name || !isset(self::$configs[$name])) return false;

    $config = self::$configs[$name];

    $value = '';

    if ($key === null)
    {
      $value = $config;
    }
    elseif($key !== null && isset($config[$key]))
    {
      $value = $config[$key];
    }

    return $value;
  }

  public static $configs = array(

    'members_limited_category_slug' => array('note'),

    'mailchimp' => array(
      'api_key' => SHEIS_MAILCHIMP_API_KEY,
      'list_id' => SHEIS_MAILCHIMP_LIST_ID,
    ),

    'mail_template' => array(
      'reregistraion' => array(
        'from'    => 'She is <support@sheishere.jp>',
        'subject' => '【She is】決済情報未登録のご連絡',
        'body'    => '[member_name]　様

こんにちは！ She is編集部です。

大変恐縮でございますが、
Membersへの新規登録の際に、お客さまのクレジットカード情報のご登録が
正常に完了しなかったようですので、ご連絡をさせていただきました。

クレジットカード登録画面で途中でブラウザを閉じたり、
ブラウザのバック機能を使った場合などに発生いたします。

お手数おかけいたしますが、下記のURLから再度ご登録をお願いできますでしょうか？
先ほどご登録いただいた内容は、すべてデータベースから削除されております。
ご入力のお手間をおかけいたしますが、どうぞよろしくお願いいたします。

▼Members新規登録ページ
https://sheishere.jp/registration/

もし、あらためて登録し直そうとされた方がいらっしゃいましたら、
システムの関係上、しばらく同じメールアドレスでは登録ができないご不便をおかけし、
誠にご迷惑をおかけいたしました。

ご不明な点がございましたら、下記までご連絡いただけますと幸いです。
support@sheishere.jp

なお、心当たりのない方はお手数ですが、その旨を本メールに
ご返信いただけますよう、お願い申し上げます。

今後とも、She isをよろしくお願いいたします。



株式会社CINRA
She is編集部
〒150-0043
東京都渋谷区道玄坂1-20-8 寿パークビル5F
TEL 03-5784-4560　FAX 03-5784-4561
10:00〜18:00（土日祝は除く）
support@sheishere.jp
http://sheishere.jp/',
      ),

      'forget_password' => array(
        'from'    => 'She is <support@sheishere.jp>',
        'subject' => '【She is】仮パスワード発行のご連絡',
        'body'    => '「She is」の仮パスワードの発行の申請を受け付けました。

仮パスワード: [temporary_password]

このパスワードは一時的なものになりますので、
サイトにログイン後、お早めにパスワードをご変更ください。

▼ログインはこちらから
https://sheishere.jp/login/

なお、心当たりのない方はお手数ですが、その旨を本メールに
ご返信いただけますよう、お願い申し上げます。

今後とも、She isをよろしくお願いいたします。


株式会社CINRA
She is編集部
〒150-0043
東京都渋谷区道玄坂1-20-8 寿パークビル5F
TEL 03-5784-4560　FAX 03-5784-4561
support@sheishere.jp
http://sheishere.jp/',
      ),
    ),

  );

}
