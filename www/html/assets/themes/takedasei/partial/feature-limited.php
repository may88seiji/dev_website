<?php
$limited_args = array(
          'category_name' => 'note',
          'posts_per_page' => -1,
          );
$q = new WP_Query($limited_args);
if ($q->have_posts()):?><ul class="cards_article">
  <?php while ($q->have_posts()):$q->the_post();?><li class="is-limited">
    <dl>
      <?php if($img = get_field('list_image')):?><dt class="cards_article-img"><img class="js-lazyload" data-src="<?php echo $img['sizes']['si-limited-list']?>" alt="<?php the_title();?>"></dt><?php endif;?>
      <dd class="cards_article-body">
        <h1 class="cards_article-subtitle">編集後記</h1>
        <p class="cards_article-heading"><?php the_title();?></p>
        <p class="cards_article-text"><?php the_field('lead');?></p>
        <p class="button_fill"><a href="<?php the_permalink();?>">READ</a></p>
      </dd>
    </dl>
  </li><?php endwhile; wp_reset_postdata();?>
</ul><?php endif;?>