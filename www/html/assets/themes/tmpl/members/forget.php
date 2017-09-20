<?php

use Sheis\Welcart\Extension\Helper;

global $si_member;

get_template_part('partial/head');?>

<div class="l-container page-reminder">
  <div class="l-billboard">
    <h1 class="heading_billboard">パスワードを忘れた方</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <section class="reminder-section">
        <div class="text_formDescription">
          ご入力いただいたメールアドレス宛に仮パスワードをお送りします。メールに記載の仮パスワードから再度ログインし、お早めに仮パスワードを変更してください。<br>
          ※数時間経過してもメールが届かない場合は、お手数ですが<a href="<?php echo home_url('contact/');?>">お問い合わせ</a>よりお問い合わせください。
        </div>
        <form method="post" action="<?php echo home_url('forget/');?>">
          <?php wp_nonce_field('forget-password-form', '_forget_password_nonce');?>

          <div class="l-form">
            <dl class="form-item">
              <dt class="heading_formTitle">メールアドレス<span>＊</span></dt>
              <dd>
                <input type="email" name="loginmail" value="<?php echo Helper::get_post('loginmail');?>" placeholder="入力してください" />
                <?php if ($message = $si_member->get_error_message('loginmail')):?><p class="text-formError"><?php echo $message;?></p><?php endif;?>
              </dd>
            </dl>
          </div>
          <div class="pager_simple">
            <a href="<?php echo home_url('login/');?>" class="button_back">BACK</a>
            <div class="button_next-wrap">
              <input type="submit" class="button_next" value="送信する">
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/');?>">HOME</a></li>
      <li class="is-current">パスワードを忘れた方</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>