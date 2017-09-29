<?php

$args = array(
              'category__not_in' => array(get_category_id_by_slug('gift'), get_category_id_by_slug('limited'), get_category_id_by_slug('item')),
              'posts_per_page' => -1,
              );
$q = new WP_Query($args);

get_template_part('partial/head');

?>
<div class="l-container page-list">

  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
      <h1 class="heading_section_secondary">LATEST</h1>
      <?php if($q->have_posts()):?><ul class="cards">

        <?php while($q->have_posts()): $q->the_post();
          get_template_part('partial/card');
        endwhile; wp_reset_postdata();?>

      </ul>
      <?php else:?><p class="text_message">該当の記事はありません。</p>
      <?php endif;?>
      <?php si_pagination();?>
      </section>
    </div>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url();?>">HOME</a></li>
      <li class="is-current">LATEST</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>