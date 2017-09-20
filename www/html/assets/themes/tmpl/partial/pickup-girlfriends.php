<?php $girlfriends = get_field('pickup_girlfriends', 'options');?>

<ul class="list_octagon js-matchHeight">
  <?php foreach($girlfriends as $girlfriend):?><li>
    <a href="<?php echo get_term_link($girlfriend['tx_girlfriend']);?>">
      <?php if($img = get_field('image', $girlfriend['tx_girlfriend'])):?><div class="list_octagon-img">
        <svg><image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo $img['sizes']['si-square-xsmall']?>" width="100%" height="100%"></image></svg>
      </div><?php endif;?>
      <p class="list-octagon-text"><?php echo $girlfriend['tx_girlfriend']->name?></p>
    </a>
  </li><?php endforeach;?>
</ul>
<p class="button_fill"><a href="<?php echo home_url('/girlfriends/');?>">ALL</a></p>