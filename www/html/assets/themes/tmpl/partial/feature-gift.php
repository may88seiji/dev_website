<?php
  global $feature, $gift_id;

  if($gift_id):?><div class="cards_banner">
  <a href="<?php echo get_the_permalink($gift_id)?>">
    <?php if($img = get_field('main_images', $gift_id)):?><div class="cards-img">
      <div class="cards-img-inner">
        <img class="js-lazyload" data-src="<?php echo $img[0]['image']['sizes']['si-keyvisual']?>" alt="今月のギフト">
      </div>
      <div class="cards-label">今月のギフト</div>
    </div><?php endif;?>
    <div class="cards-text c-bg-b_<?php the_field('color', $feature)?>">
      <h2 class="cards-text-heading">GIFT<small>特集をもっと楽しむギフト</small></h2>
      <p class="cards-lead"><?php the_field('lead', $gift_id);?></p>
    </div>
  </a>
</div><?php endif;?>