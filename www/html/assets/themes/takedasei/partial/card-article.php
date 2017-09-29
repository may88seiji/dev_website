<?php

$category = get_the_first_term(get_the_ID(), 'category');

?>
<li>
  <dl>
    <dt class="cards_article-img"><img class="js-lazyload" data-src="<?php echo ($img = get_field('list_image')) ? $img['sizes']['si-limited-list'] : get_template_directory_uri(). '/assets/img/noimg-article.png'?>" alt="<?php the_title();?>"></dt>
    <dd class="cards_article-body">
      <h1 class="cards_article-subtitle"><?php echo esc_html($category->name);?></h1>
      <p class="cards_article-heading"><?php echo strip_tags(get_the_title());?></p>
      <p class="cards_article-text"><?php the_field('lead');?></p>
      <p class="button_fill"><a href="<?php the_permalink()?>">READ</a></p>
    </dd>
  </dl>
</li>
