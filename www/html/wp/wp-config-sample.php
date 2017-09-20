<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'sheis');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'sheis');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'n7UDxHTX-zCJdTcJk');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'g#p-?}H:A&7h|MhR,4/|})-n+7j{mp4<Y^rXW5~BJz9 yfqB24%p_:1O|M!5<GH1');
define('SECURE_AUTH_KEY',  'vv#1rDJ,1lxseiem4|8+}hRpt_RVJw?E&F<U6+Lv{U{R_nbmg-A-IE}${`g1SYQq');
define('LOGGED_IN_KEY',    '6U~UW#UiqRk:aWU3VA4@@67Aj5^~zVMA])(?_bTyeGUaFL>w$Rw5qt+v~t~@wzud');
define('NONCE_KEY',        'j=l:s:XiP[*o-ab?tQqHz{p}dw-E(cfLV6Z_Y[|z,A7HHvkiq?Co^vKCb5m+_~xJ');
define('AUTH_SALT',        '<S|r3?`,tPrGi]_=A#[e04nOZPp2IP-s!ybV3*,H^J#m6^0_BM`DJI(_C2 #7V~R');
define('SECURE_AUTH_SALT', 'Az&]7THB^<E$PlFq(RkrcAJ+(},I`|#y-NG>q<j&^]Qo1gFr}B74~N!^xv6>VOL`');
define('LOGGED_IN_SALT',   'j;e:njY K]-?lFYMHvizy)?&~.4sFg0n0+9ng.wLR+um.)Ti,G+v2hO`nFtO9|2a');
define('NONCE_SALT',       'Z-qP0h)7;%n4A:UnJaN<v}&4tgNj3))k+]{I.g~D&dykh@kzUm!bRm!U%mpffm<N');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
// $table_prefix  = 'sit_';
$table_prefix  = 'si_';#本サイト

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', true);

define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/assets');
define('WP_CONTENT_URL', 'http://'.$_SERVER["HTTP_HOST"].'/assets');
define('IS_LOCAL', true);
define ('SAVEQUERIES', true);
define('SHEIS_MAILCHIMP_API_KEY', '');
define('SHEIS_MAILCHIMP_LIST_ID', '');

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
