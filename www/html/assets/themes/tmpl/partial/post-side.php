<div class="l-side">
  <div class="l-side-inner">
    <?php if($girlfriends = get_the_terms(get_the_ID(), 'girlfriend')):?><div class="side-girlfriends">
      <div class="side-girlfriends-title">GIRLFRIENDS</div>
      <div class="side-girlfriends-description">この記事に関係するGirlfriends</div>
      <ul>
        <?php foreach($girlfriends as $girlfriend):?><li>
          <a href="<?php echo get_term_link($girlfriend);?>">
            <?php if($img = get_field('image', $girlfriend)):?><div class="list_octagon-img">
            <svg><image xlink:href="<?php echo $img['sizes']['si-square-xsmall']?>" width="100%" height="100%" /></image></svg>
            </div><?php endif;?>
            <p class="list_octagon-text"><?php echo $girlfriend->name?></p>
          </a>
        </li><?php endforeach;?>
      </ul>
    </div><?php endif;?>

    <?php if($main_feature = get_main_feature()):?><div class="featureOfTheMonth c-bg-b_<?php the_field('color', $main_feature)?>">
      <a href="<?php echo get_term_link($main_feature)?>">
        <div class="featureOfTheMonth-sub c-cl-f_<?php the_field('color', $main_feature)?>"><?php the_field('year', $main_feature);?>年<?php the_field('month', $main_feature);?>月 今月の特集</div>
        <div class="featureOfTheMonth-title"><?php echo $main_feature->name?></div>
        <?php if($img = get_field('list_image_square', $main_feature)):?><div class="featureOfTheMonth-img"><img class="js-lazyload" data-src="<?php echo $img['sizes']['si-square-medium']?>" alt="<?php echo $main_feature->name;?>"><div class="button_lineWhite"><span>FEATURE</span></div></div><?php endif;?>
        <?php if(get_field('lead', $main_feature)):?><div class="featureOfTheMonth-text"><?php the_field('lead', $main_feature)?></div><?php endif;?>
      </a>
    </div>

    <div class="featureOfTheMonth featureOfTheMonth_gift ">
      <a href="<?php echo get_the_permalink(get_main_gift());?>">
        <div class="featureOfTheMonth-sub c-cl-f_<?php the_field('color', $main_feature)?>"><?php the_field('year', $main_feature);?>年<?php the_field('month', $main_feature);?>月</div>
        <div class="featureOfTheMonth-title">今月のギフト</div>
        <?php if($img = get_field('list_image', get_main_gift())):?><div class="featureOfTheMonth-img"><img class="js-lazyload" data-src="<?php echo $img['sizes']['si-square-medium']?>" alt="<?php echo strip_tags(get_the_title());?>"><div class="button_border"><span>GIFT</span></div></div><?php endif;?>
        <div class="featureOfTheMonth-text"><?php the_field('lead', get_main_gift());?></div>
      </a>
    </div><?php endif;?>

    <?php get_template_part('partial/banner-side');?>

  </div>
</div>
