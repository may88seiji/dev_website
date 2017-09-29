<?php

global $exclude_id, $feature;

the_post();
$feature = get_the_first_term(get_the_ID(), 'feature');
$exclude_id[] = get_the_ID();

get_template_part('partial/head');?>

<div class="l-container page-detail">

  <?php get_template_part('partial/post-billboard');?>

  <div class="l-content">
    <?php get_template_part('partial/post-main');?>
    <?php get_template_part('partial/members-side');?>
  </div>

  <div class="l-aside">
    <?php get_template_part('partial/aside-recommend');?>
    <?php get_template_part('partial/aside-latest');?>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/');?>">HOME</a></li>
      <li><a href="<?php echo home_url('members/');?>">マイページ</a></li>
      <?php if(in_category('note')):?><li><a href="<?php echo home_url('members/article/');?>">MEMBERS限定記事一覧</a></li><?php endif;?>
      <li class="is-current"><?php echo strip_tags(get_the_title())?></li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>