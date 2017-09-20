<div class="cards_share">
  <?php if($img = get_field('main_images')):?><div class="cards-img"><img class="js-lazyload" data-src="<?php echo $img[0]['image']['sizes']['si-share']?>" alt="SHARE！"></div><?php endif;?>
  <div class="cards_share-content">
    <h2 class="cards_share-heading">SHARE!</h2>
    <p class="cards_share-description">ギフトが気になったら<br />友だちにシェア
</p>
    <ul class="icons_share">
      <li><a href="<?php echo get_tw_url();?>" target="_blank"><i class="icon-twitter"></i></a></li>
      <li><a href="<?php echo get_fb_url();?>" target="_blank"><i class="icon-facebook"></i></a></li>
      <li class="pc-hide"><a href="<?php echo get_line_url();?>" target="_blank"><i class="icon-line"></i></a></li>
    </ul>
  </div>
</div>