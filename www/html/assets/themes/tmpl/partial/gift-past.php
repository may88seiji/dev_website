<?php
global $wp_query, $exclude_id;
$args = array(
              'category_name' => 'gift',
              'posts_per_page' => 3,
              'post__not_in' => $exclude_id,
              );
$q = new WP_Query($args);
if ($q->have_posts()):?>

<section class="l-section gift-past">
  <h1 class="heading_section_secondary">ARCHIVES</h1>
  <p class="text_headingDescription_secondary">これまでのギフト</p>
  <ul class="cards_highlight"><?php
    while ($q->have_posts()):$q->the_post();
      get_template_part('partial/card-highlight');
    endwhile; wp_reset_postdata();?>
  </ul>
  <p class="button_fill"><a href="<?php echo home_url('/gift/');?>">ALL</a></p>
</section>

<?php endif;?>