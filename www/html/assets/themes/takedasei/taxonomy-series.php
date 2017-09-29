<?php

global $wp_query, $exclude_id;
$series = $wp_query->queried_object;

$exclude_id = array();

get_template_part('partial/head');
?>
<div class="l-container page-list">

  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
      <h1 class="heading_section_secondary"><?php echo $series->name?></h1>
      <?php if(have_posts()):?><ul class="cards">

        <?php while(have_posts()): the_post();
          $exclude_id[] = get_the_ID();
          get_template_part('partial/card');
        endwhile;?>

      </ul>
      <?php else:?><p class="text_message">該当の記事はありません。</p>
      <?php endif;?>
      <?php si_pagination();?>
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
      <li><a href="<?php echo home_url('/series/')?>">連載一覧</a></li>
      <li class="is-current"><?php echo $series->name?></li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>