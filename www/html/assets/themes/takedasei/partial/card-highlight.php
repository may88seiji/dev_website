<?php
$feature = get_the_first_term(get_the_ID(), 'feature');
$tags = get_tags_for_her();
?>
<li<?php if(in_category('gift')):?> class="is-limited"<?php endif;?>>
  <a href="<?php the_permalink()?>">
    <div class="cards-img">
      <div class="cards-img-inner c-bd-b_<?php the_field('color', $feature)?>">
        <?php if(!in_category('gift')):?><div class="cards-img-inner-text">
          <p class="cards-img-date"><?php echo get_post_time('M j.Y');?></p>
          <p class="cards-img-title"><?php the_title();?></p>
        </div><?php endif;?>

        <?php if($img = get_field('list_image')):?><img src="<?php echo $img['sizes']['si-square-medium']?>" alt="<?php echo strip_tags(get_the_title());?>"><?php endif;?>

        <?php if(in_category('gift')):?>
          <div class="cards-label"><?php the_field('month', $feature);?>月のギフト<small>（<?php the_field('year', $feature);?>）</small></div>
        <?php endif;?>
      </div>
    </div>
    <div class="cards-text c-bd-b_<?php the_field('color', $feature)?>">
      <?php if($feature && !in_category('gift')):?><div class="cards-lead c-cl-f_<?php the_field('color', $feature)?>"><?php the_field('year', $feature);?>年<?php the_field('month', $feature);?>月 特集：<?php echo $feature->name?></div><?php endif;?>

      <div class="cards-description"><?php the_field('lead');?></div>

      <?php if(!in_category('gift')):?><ul class="cards-tags">
        <li class="cards-date"><?php echo get_post_time('M j.Y');?></li>
        <?php if($tags):foreach($tags as $tag):?><li>#<?php echo $tag->name?></li><?php endforeach; endif;?>
      </ul><?php endif;?>
    </div>
  </a>
</li>