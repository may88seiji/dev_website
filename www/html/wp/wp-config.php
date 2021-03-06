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
define('DB_NAME', 'dev_website');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'root');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'root');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '5nc|Ya1VW14U^r^Non4JDAC:%QwD2nut3LEbDm19_a;g+@5noq$e:Zq?7s.zBee~');
define('SECURE_AUTH_KEY',  'VQ,BS>N[lpseo4:dY8{Cy+RB5x*h9%s_Vg|X6s(246k|XsQl&Ls)OT.n@-4;[3(r');
define('LOGGED_IN_KEY',    'ZTmpz8],;9%d(NW$Ku )=[xj,=8!!.lks%)8P8Mh~%nXd%Q0bC-lZ}@=j)$5IVs8');
define('NONCE_KEY',        'x?=LF2-46V:t3|]#^4?8bU|Is5P.8I{^z^6zUs-9nf6$F*6do/wef< VVoYY`O<H');
define('AUTH_SALT',        '=5~gmJk v-qlG/K][P:V$uggaiMc(?m{=t4<C F%w@F>*;,jk)C*t8/[f*D`*Yi+');
define('SECURE_AUTH_SALT', 'K#`q?QM/ ul?[!QqC0eIgX`YxW:5.T#@F7J6^UOc9ivc ~VK#l/km]gqKd3,<Th+');
define('LOGGED_IN_SALT',   'T.5_Jmmf$mi{,y@>gmEyB#^/=sUFmW(k%f;^%2}m,`gdKARQ`*i>JC;MnPqr6$Ye');
define('NONCE_SALT',       '?xS]HtpL;=?gYxzREK=]`]vK{;Vy+ cat%1#/!h5LmYm,h|Z@]k}%V=q9vJ]7T].');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
// $table_prefix  = 'sit_';
$table_prefix  = 'wp_';

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
