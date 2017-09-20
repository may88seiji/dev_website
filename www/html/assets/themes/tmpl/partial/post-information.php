<?php if($arr_profile = get_field('profile')):?><section class="l-appendix">
  <h1 class="heading_appendix">PROFILE</h1>
  <?php foreach($arr_profile as $profile):?><div class="appendix-content">
    <div class="appendix-inner">
      <?php if($img = $profile['image']):?><div class="appendix-inner-img"><img class="js-lazyload" data-src="<?php echo $img['url']?>" alt="<?php echo $profile['title']?>"></div><?php endif;?>
      <div class="appendix-content-wrapTexts">
        <div class="appendix-content-title"><?php echo $profile['title']?></div>
        <?php if($profile['description']):?><p class="appendix-content-text"><?php echo $profile['description']?></p><?php endif;?>
        <?php if($profile['site_url'] || $profile['tw_url'] || $profile['insta_url'] || $profile['fb_url']):?><ul class="appendix-content-icon">
          <?php if($profile['site_url']):?><li><a class="icon-home" href="<?php echo $profile['site_url'];?>" target="_blank"></a></li><?php endif;?>
          <?php if($profile['tw_url']):?><li><a class="icon-twitter" href="<?php echo $profile['tw_url'];?>" target="_blank"></a></li><?php endif;?>
          <?php if($profile['insta_url']):?><li><a class="icon-instagram" href="<?php echo $profile['insta_url'];?>" target="_blank"></a></li><?php endif;?>
          <?php if($profile['fb_url']):?><li><a class="icon-facebook" href="<?php echo $profile['fb_url'];?>" target="_blank"></a></li><?php endif;?>
        </ul><?php endif;?>
      </div>
    </div>
  </div><?php endforeach;?>
</section><?php endif;?>

<?php if($arr_information = get_field('information')):?><section class="l-appendix">
  <h1 class="heading_appendix">INFORMATION</h1>
  <?php foreach($arr_information as $info):?><div class="appendix-content">
    <?php if($info['title']):?><div class="appendix-lead"><?php echo $info['title']?></div><?php endif;?>
    <div class="appendix-inner">
      <?php if($img = $info['image']):?><div class="appendix_releaseInfo-img"><img class="js-lazyload" data-src="<?php echo $img['sizes']['si-square-medium']?>" alt="<?php echo $info['title']?>"></div><?php endif;?>
      <div class="appendix-content-wrapTexts">
        <?php if($info['subtitle']):?><div class="appendix-content-title"><?php echo $info['subtitle']?></div><?php endif;?>
        <?php if($info['description']):?><p><?php echo $info['description']?></p><?php endif;?>
      </div>
    </div>
  </div><?php endforeach;?>
</section><?php endif;?>