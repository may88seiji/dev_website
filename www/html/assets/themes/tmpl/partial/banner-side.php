<?php if($banners = get_field('banners_side', 'options')):?>
<div class="advertisement">
  <a href="<?php echo $banners[0]['url']?>" onClick="<?php echo ga_event_script('banner', $banners[0]['alt'].'-side');?>">
    <?php if($img = $banners[0]['image']):?><img src="<?php echo $img['url']?>" alt="<?php echo $banners[0]['alt']?>"><?php endif;?>
  </a>
</div>
<?php endif;?>