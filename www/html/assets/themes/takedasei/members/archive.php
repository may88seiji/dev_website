<?php

$q = new WP_Query(array(
  'post_type'     => 'post',
  'category_name' => 'note',
));

get_template_part('partial/head');?>

<div class="l-container page-list">
  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <h1 class="heading_section_secondary">MEMBERS限定記事一覧</h1>
        <?php if ($q->have_posts()):?><ul class="cards">
          <?php while ($q->have_posts()): $q->the_post();
            get_template_part('partial/card');
          endwhile; wp_reset_postdata();?>
        </ul>
        <?php si_pagination();?>
        <?php else:?><p class="text_message">準備中！</p>
        <?php endif;?>
      </section>
    </div>
  </div>
</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/');?>">HOME</a></li>
      <li><a href="<?php echo home_url('members/');?>">マイページ</a></li>
      <li class="is-current">MEMBERS限定記事一覧</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>