<?php get_template_part('partial/head');?>

<div class="l-container page-mypage">
  <div class="l-billboard">
    <h1 class="heading_billboard">登録情報変更</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <div class="main-inner">
        <p class="text_message">更新が完了いたしました。</p>
        <p class="button_fill"><a href="<?php echo home_url('members/');?>">マイページトップに戻る</a></p>
      </div>
    </div>

    <?php get_template_part('partial/members-side');?>
  </div>
</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/');?>">HOME</a></li>
      <li><a href="<?php echo home_url('members/');?>">マイページ</a></li>
      <li class="is-current">登録情報変更</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>