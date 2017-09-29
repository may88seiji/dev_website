<?php

use Sheis\Welcart\Extension\Helper;

global $si_member, $usces;

$cookie = $usces->get_cookie('si_login');

get_template_part('partial/head');?>

<div class="l-container page-login">

  <div class="l-billboard">
    <h1 class="heading_billboard">ログイン</h1>
  </div>

  <div class="l-content">
    <div class="l-main">
      <div class="login-box-wrap">
        <div class="login-box_2col">
          <form action="<?php echo home_url('login/');?>" method="post">
            <div class="login-box js-matchHeight_notSP">
              <h2 class="heading_tertiary">会員登録がお済みの方</h2>
              <p class="text_formDescription sp-hide">お帰りなさい！<br />登録済みの方はこちらからお入りください。</p>

              <div class="l-form">
                <dl class="form-item">
                  <dt class="heading_formTitle">メールアドレス</dt>
                  <dd>
                    <div class="form-item-wrap">
                      <input type="email" name="loginmail" value="<?php echo esc_attr(Helper::get_post('loginmail', isset($cookie['loginmail']) ? $cookie['loginmail'] : ''));?>" placeholder="入力してください" />
                      <?php if ($message = $si_member->get_error_message('loginmail')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                      <?php if ($message = $si_member->get_error_message('login')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                    </div>
                    <div class="form-item_check_s form-item-wrap">
                      <input type="checkbox" name="remembermail" value="1"<?php if ((int)Helper::get_post('remembermail', isset($cookie['remembermail']) ? $cookie['remembermail'] : '') === 1) echo ' checked';?>>
                      <label>メールアドレスを保存する</label>
                    </div>
                  </dd>
                </dl>
                <dl class="form-item">
                  <dt class="heading_formTitle">パスワード</dt>
                  <dd>
                    <input type="password" name="loginpass" value="" placeholder="入力してください" />
                    <?php if ($message = $si_member->get_error_message('loginpass')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                    <?php if ($message = $si_member->get_error_message('login')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
                  </dd>
                </dl>
              </div>
              <p class="button_next"><input type="submit" class="button_next" value="ログイン" />ログイン</p>
            </div>
          </form>
          <p class="text_formDescription">
            <small>※パスワードを忘れた方は<a href="<?php echo home_url('forget/');?>">こちら</a>からパスワードの再発行を行ってください。<br />
            ※メールアドレスを忘れた方は、お手数ですが、<a href="<?php echo home_url('contact/');?>">お問い合わせページ</a>からお問い合わせください。</small>
          </p>
        </div>
        <div class="login-box_2col">
          <div class="login-box js-matchHeight_notSP">
            <h2 class="heading_tertiary">まだMembers登録されていない方</h2>
            <p class="text_formDescription">She isは参加型のコミュニティです。<br />私たちと"She is"をつくってみませんか？<br />登録すれば、ギフトやイベントなど<br class="ps-hide"/>特典がたくさん！</p>
            <ul class="list_memberPrivilege">
              <li>ギフトが<br />届く</li>
              <li>イベントの優待が<br />受けられる</li>
              <li>Members限定記事<br />が読める</li>
              <li>メールマガジンが<br />受け取れる</li>
            </ul>
            <a href="<?php echo home_url('registration/');?>" class="button_next" onClick="<?php echo ga_event_script('cv', 'pre-login');?>">MEMBERS 新規登録</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">ログイン</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>