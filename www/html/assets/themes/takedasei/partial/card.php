<?php
$feature = get_the_first_term(get_the_ID(), 'feature');
$sponsor = get_the_first_term(get_the_ID(), 'sponsor');
$series = get_the_first_term(get_the_ID(), 'series');

$tags = get_tags_for_her();
?>
<li<?php if($sponsor):?> class="is-sponsored"<?php endif;?>>
  <a href="<?php the_permalink()?>">
    <div class="cards-img<?php if($feature):?> c-bd-b_<?php the_field('color', $feature); endif;?>">
      <img src="<?php echo ($img = get_field('list_image')) ? $img['sizes']['si-square-small'] : get_template_directory_uri(). '/assets/img/noimg-article.png'?>" alt="<?php echo strip_tags(get_the_title());?>">
    </div>
    <div class="cards-text<?php if($feature):?> c-bd-b_<?php the_field('color', $feature); endif;?>">
      <?php if($sponsor):?><div class="cards-lead">SPONCORED：<?php echo $sponsor->name?></div><?php endif;?>
      <?php if($feature):?><div class="cards-lead c-cl-f_<?php the_field('color', $feature)?>"><?php the_field('year', $feature);?>年<?php the_field('month', $feature);?>月 特集：<?php echo $feature->name?></div><?php endif;?>
      <?php if($series):?><div class="cards-lead">連載：<?php echo $series->name?></div><?php endif;?>

      <div class="cards-title"><?php echo strip_tags(get_the_title());?></div>
      <div class="cards-description"><?php the_field('lead');?></div>
      <ul class="cards-tags sp-hide">
        <li class="cards-date"><?php echo get_post_time('M j.Y');?></li>
        <?php if($tags):foreach($tags as $tag):?><li>#<?php echo $tag->name?></li><?php endforeach; endif;?>
      </ul>
    </div>
  </a>
</li>