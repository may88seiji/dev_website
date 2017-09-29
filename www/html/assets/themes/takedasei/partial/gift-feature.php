<?php global $feature;?>
<h1 class="heading_tertiary">特集の記事を読んで、ギフトをもっと楽しむ！</h1>
  <ul class="cards_rect">
    <li>
      <a href="<?php echo get_term_link($feature)?>">
        <?php
        $img_pc = get_field('list_image_pc', $feature);
        $img_sp = get_field('list_image_sp', $feature);
        if($img_pc && $img_sp):?><div class="cards_rect-img">
          <picture>
            <source class="js-lazyload" media="(min-width: 768px)" data-srcset="<?php echo $img_pc['sizes']['si-wide']?>">
            <img class="js-lazyload" data-src="<?php echo $img_sp['sizes']['si-wide-sp']?>" alt="<?php echo $feature->name?>">
          </picture>
        </div><?php endif;?>
        <div class="cards_rect-text c-bd-b_<?php the_field('color', $feature)?>">
          <div class="cards_rect-text-head">
            <p class="cards_rect-lead c-cl-f_<?php the_field('color', $feature)?>"><?php the_field('year', $feature);?>年<?php the_field('month', $feature);?>月 今月の特集</p>
            <p class="cards_rect-title"><?php echo $feature->name?></p>
          </div>
          <?php if(get_field('lead', $feature)):?><p class="cards_rect-description"><?php the_field('lead', $feature)?></p><?php endif;?>
        </div>
      </a>
    </li>
  </ul>