<?php

global $wp_query, $exclude_id, $feature, $gift_id;

$exclude_id = array();
$feature = $wp_query->queried_object;
$gift_id = get_gift_from_feature($feature->term_id);

get_template_part('partial/head');
?>
<div class="l-container page-detail_feature c-bg-b_<?php the_field('color', $feature)?>">
  <div class="l-billboard">
    <div class="billboard_feature">
      <?php if($img = get_field('main_image', $feature)):?><div class="billboard-image">
        <div class="billboard-image-inner">
          <img src="<?php echo $img['sizes']['si-keyvisual']?>" alt="<?php echo $feature->name?>">
        </div>
        <?php if($gift_id):?><div class="billboard-gift">
          <a href="<?php echo get_the_permalink($gift_id)?>">
            <?php if($img = get_field('list_image', $gift_id)):?><div class="billboard-gift-img"><img class="js-lazyload" data-src="<?php echo $img['sizes']['si-square-medium']?>" alt="今月のギフト"></div><?php endif;?>
            <div class="billboard-gift-text">
              <i class="icon-membersonly"></i>
              <p class="billboard-gift-text-lead">今月のギフト</p>
            </div>
          </a>
        </div><?php endif;?>
      </div><?php endif;?>
      <div class="billboard_feature-preamble">
        <p class="billboard_feature-lead c-cl-f_<?php the_field('color', $feature)?>"><?php the_field('year', $feature);?>年<?php the_field('month', $feature);?>月 今月の特集</p>
        <h2 class="billboard_feature-title">「<?php echo $feature->name?>」</h2>
        <div class="billboard_feature-text js-animLine"><?php the_field('content', $feature)?></div>
      </div>
    </div>
  </div>
  <?php if(have_posts()):?><div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <h1 class="heading_section_secondary">ARTICLES</h1>
        <ul class="cards_highlight">
          <?php while(have_posts()): the_post();
            $exclude_id[] = get_the_ID();
            get_template_part('partial/card-highlight');
          endwhile;
          get_template_part('partial/card-highlight-empty');?>
        </ul>
      </section>
    </div>
  </div><?php endif;?>

  <div class="l-aside">
    <section class="l-section">
      <?php get_template_part('partial/feature-gift');?>
      <?php get_template_part('partial/feature-limited');?>
    </section>

    <?php get_template_part('partial/aside-pastfeature');?>
    <?php get_template_part('partial/aside-latest');?>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li><a href="<?php echo home_url('/feature/')?>">特集一覧</a></li>
      <li class="is-current"><?php the_field('month', $feature);?>月の特集</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>