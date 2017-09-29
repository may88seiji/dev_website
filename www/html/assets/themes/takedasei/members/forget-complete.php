<?php get_template_part('partial/head');?>

<div class="l-container page-reminder">
  <div class="l-billboard">
    <h1 class="heading_billboard">パスワードを忘れた方</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <div class="l-section">
        <section class="reminder-section">
          <p class="text_message">
            仮パスワードをメールにてお送りいたしました。メールに記載の仮パスワードから再度ログインし、お早めに新しいパスワードに変更してください。<br /><br />メールが到着しなかった場合は、入力していただいたメールアドレスが間違っている可能性がございます。恐れ入りますが、<a href="<?php echo home_url('contact/');?>">お問い合わせページ</a>からお問い合わせください。</p>
          <p class="button_fill"><a href="<?php echo home_url('login/');?>">ログインページに戻る</a></p>
        </section>
      </div>
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