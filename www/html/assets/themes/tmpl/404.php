<?php get_template_part('partial/head');?>
<div class="l-container page-404">
  <div class="l-billboard">
    <h1 class="heading_billboard">404 not found</h1>
  </div>

  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <div class="section-content">
          <h2 class="heading_tertiary">ページが見つかりません</h2>
          <p class="text_message">検索中のページは、削除された、名前が変更された、または現在利用できない可能性があります。恐れ入りますが、正しくアドレスが入力されているかもう一度ご確認いただくか、下記のボタンをクリックしてトップページから改めてお探しください。</p>
          <p class="button_fill"><a href="<?php echo home_url('/')?>">トップページに戻る</a></p>
        </div>
      </section>
    </div>
  </div>

  <div class="l-aside">
    <?php get_template_part('partial/aside-latest');?>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">Not Found</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>