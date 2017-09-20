<div class="l-billboard">
  <div class="billboard_detail">
    <?php if(!in_category(array('voice', 'hottopic')) && $img = get_field('main_images')):?><div class="billboard-image js-billboardImg">
      <div class="billboard-image-inner">
        <img src="<?php echo $img[0]['image']['sizes']['si-keyvisual']?>" alt="<?php echo strip_tags(get_the_title());?>">
      </div>
      <div class="scrollable js-scrollable"><i></i></div>
    </div><?php endif;?>
    <div class="billboard-title">
      <h1 class="heading_detail_primary"><?php the_title();?></h1>
      <p class="text_summary"><?php the_field('lead');?></p>
    </div>
  </div>
</div>