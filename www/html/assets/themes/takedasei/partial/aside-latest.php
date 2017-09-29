<?php
global $exclude_id;
$category__not_in = array(get_category_id_by_slug('gift'), get_category_id_by_slug('item'), get_category_id_by_slug('notice'));
if(!in_category('limited')) $category__not_in[] = get_category_id_by_slug('limited');

$args = array(
              'category__not_in' => $category__not_in,
              'posts_per_page' => 3,
              'post__not_in' => $exclude_id,
              );
if ($posts = get_posts($args)):?>

<section class="l-section">
  <h1 class="heading_section_secondary">LATEST</h1>
  <ul class="cards"><?php
    foreach ($posts as $post): setup_postdata($post);
      get_template_part('partial/card');
    endforeach; wp_reset_postdata();?>
  </ul>
  <p class="button_fill"><a href="<?php echo home_url('/latest/')?>">MORE</a></p>
</section>

<?php endif;?>