<?php

global $exclude_id, $feature;

the_post();
$feature = get_the_first_term(get_the_ID(), 'feature');
$exclude_id[] = get_the_ID();

get_template_part('partial/head');
?>
<div class="l-container page-detail">

  <?php get_template_part('partial/post-billboard');?>

  <div class="l-content">
    <?php get_template_part('partial/post-main');?>
    <?php get_template_part('partial/post-side');?>
  </div>

  <div class="l-aside">
    <?php get_template_part('partial/aside-recommend');?>
    <?php get_template_part('partial/aside-latest');?>
  </div>

</div>

<?php
$category = get_the_first_term(get_the_ID(), 'category');
$post_type = get_post_type_object(get_post_type());
$parent_slug = ($category) ? $category->slug : $post_type->name;
$parent_label = ($category) ? $category->name : $post_type->label;
?>
<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li><a href="<?php echo home_url('/'. $parent_slug. '/')?>"><?php echo $parent_label?></a></li>
      <li class="is-current"><?php echo strip_tags(get_the_title())?></li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>
