<?php if($banners = get_field('banners_top', 'options')):?>
<li class="is-ad sp-hide">
  <a href="<?php echo $banners[0]['url']?>" onClick="<?php echo ga_event_script('banner', $banners[0]['alt'].'-top');?>">
    <?php if($img = $banners[0]['image']):?><div class="cards-img">
      <img src="<?php echo $img['sizes']['si-square-small']?>" alt="<?php echo $banners[0]['alt']?>">
    </div><?php endif;?>
  </a>
</li>
<?php endif;?>