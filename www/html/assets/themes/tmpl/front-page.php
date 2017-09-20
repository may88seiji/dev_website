<?php
$main_feature = get_main_feature();
$news = get_posts(array('post_type' => 'news', 'posts_per_page' => 1));

$exclude_id = array();

$pickup = null;
$get_pickup = get_field('pickup_post', 'options');
if(isset($get_pickup[0]))
{
  $pickup = $get_pickup[0];
  $exclude_id[] = $pickup->ID;
}

get_template_part('partial/head');
?>

<div class="l-container page-top c-bg-b_<?php echo get_main_theme_color_key();?>">
<?php if($main_feature):?><div class="l-billboard">
  <div class="billboard_top">
    <a href="<?php echo get_term_link($main_feature);?>">
      <div class="billboard-image js-billboardImg"><?php
        if($top_images = get_field('top_images', $main_feature)):
        $img = $top_images[0]['image'];
        ?><div class="billboard-image-inner">
          <img src="<?php echo $img['sizes']['si-keyvisual']?>" alt="<?php echo $top_images[0]['caption']?>">
          <div class="scrollable js-scrollable"><i></i></div>
        </div><?php endif;?>
        <div class="billboard-textBox">
          <p class="billboard-textBox-lead c-cl-f_<?php the_field('color', $main_feature)?>"><?php the_field('year', $main_feature);?>年<?php the_field('month', $main_feature);?>月 今月の特集</p>
          <h2 class="billboard-textBox-title"><?php echo $main_feature->name?></h2>
          <?php if(get_field('lead', $main_feature)):?><p class="billboard-textBox-description"><?php the_field('lead', $main_feature)?></p>
          <p class="button_fill"><span>FEATURE</span></p><?php endif;?>
        </div>
      </div>
    </a>
    <p class="billboard-note sp-hide"><?php echo $top_images[0]['caption']?></p>
  </div>
</div><?php endif;?>
<div class="l-content">
  <div class="l-main">
    <?php if(isset($news[0])):?><div class="news">
      <a href="<?php echo get_the_permalink($news[0]->ID);?>">
      <h2 class="news-heading">お知らせ</h2>
      <p class="news-text"><span class="news-text-date"><?php echo get_post_time('Y.n.j', $news[0]->ID);?></span><br class="pc-hide"><?php echo $news[0]->post_title?></p>
      </a>
    </div><?php endif;?>
    <?php if($main_feature):?>
    <ul class="cards_highlight"><?php
    $feature_args = array(
              'tax_query' => array(
                                   'relation' => 'AND',
                                   array(
                                         'taxonomy' => 'feature',
                                         'field' => 'slug',
                                         'terms' => $main_feature->slug,
                                         ),
                                   ),
              'category__not_in' => array(get_category_id_by_slug('gift'), get_category_id_by_slug('limited'), get_category_id_by_slug('item')),
              'posts_per_page' => 2,
              );
    $q = new WP_Query($feature_args);
    if ($q->have_posts()):
      while ($q->have_posts()):$q->the_post();
        get_template_part('partial/card-highlight');
      endwhile; wp_reset_postdata();

      if((int)$q->found_posts === 1) get_template_part('partial/card-highlight-empty-single');
    endif;?>

      <?php if(get_main_gift()):?><li class="is-limited">
        <a href="<?php echo get_the_permalink(get_main_gift());?>">
          <div class="cards-img">
            <div class="cards-img-inner c-bd-b_<?php echo get_main_theme_color_key();?>">
              <?php if($img = get_field('list_image', get_main_gift())):?><img src="<?php echo $img['sizes']['si-square-medium']?>" alt="<?php echo strip_tags(get_the_title(get_main_gift()));?>"><?php endif;?>
              <div class="cards-label">今月のギフト</div>
            </div>
          </div>
          <div class="cards-text">
            <div class="cards-description"><?php the_field('lead', get_main_gift());?></div>
          </div>
        </a>
      </li><?php endif;?>
    </ul><?php endif;?>
    <?php
    $latest_args = array(
              'category__not_in' => array(get_category_id_by_slug('gift'), get_category_id_by_slug('limited'), get_category_id_by_slug('item')),
              'posts_per_page' => 15,
              'post__not_in' => $exclude_id,
              );
    $q = new WP_Query($latest_args);
    if ($q->have_posts()): $count = 1;?>
    <section class="l-section">
      <h1 class="heading_section_secondary">LATEST</h1>
      <ul class="cards"><?php
        while ($q->have_posts()):$q->the_post();
          if(($count == 5 && get_field('banners_top', 'options'))):
            get_template_part('partial/banner-top-sp');
          elseif(($count == 6 && get_field('banners_top', 'options'))):
            get_template_part('partial/banner-top-pc');
          else:
            get_template_part('partial/card');
            $exclude_id[] = get_the_ID();
            $count++;
          endif;
        endwhile; wp_reset_postdata();
        if($q->found_posts < 5) get_template_part('partial/banner-top-sp');
        if($q->found_posts < 6) get_template_part('partial/banner-top-pc');?>
      </ul>
    </section><?php endif;?>
    <section class="l-section">
      <?php if($pickup): setup_postdata($pickup); ?><header class="headBoard">
        <a href="<?php echo get_the_permalink($pickup->ID)?>">
          <?php $img = get_field('main_images', $pickup->ID);?>
          <div class="headBoard-img" style="background-image:url(<?php echo $img[0]['image']['sizes']['si-keyvisual']?>)">
            <div class="headBoard-inner">
              <?php if($series = get_the_first_term($pickup->ID, 'series')):?><p class="headBoard-lead">連載：<?php echo $series->name;?></p><?php endif;?>
              <h1 class="headBoard-title"><?php echo get_the_title($pickup->ID);?></h1>
              <p class="headBoard-description sp-hide"><?php the_field('lead', $pickup->ID)?></p>
              <ul class="headBoard-tags sp-hide">
                <li class="headBoard-date"><?php echo get_post_time('M j.Y', $pickup->ID);?></li>
                <?php if($tags = get_tags_for_her($pickup->ID)):foreach($tags as $tag):?><li>#<?php echo $tag->name?></li><?php endforeach; endif;?>
              </ul>
            </div>
          </div>
          <p class="headBoard-description pc-hide"><?php the_field('lead', $pickup->ID)?></p>
        </a>
      </header><?php endif;?>
      <?php
      $latest_args = array(
                'category__not_in' => array(get_category_id_by_slug('gift'), get_category_id_by_slug('limited'), get_category_id_by_slug('item')),
                'posts_per_page' => 6,
                'post__not_in' => $exclude_id,
                );
      $q = new WP_Query($latest_args);
      if ($q->have_posts()): $count = 1;?>
      <ul class="cards"><?php
        while ($q->have_posts()):$q->the_post();
          get_template_part('partial/card');
          $exclude_id[] = get_the_ID();
        endwhile; wp_reset_postdata();?>
      </ul>

      <p class="button_fill"><a href="<?php echo home_url('/latest/')?>">MORE</a></p><?php endif;?>
    </section>
    <?php if(get_field('pickup_girlfriends', 'options')):?><section class="l-section">
      <h1 class="heading_section_primary">GIRLFRIENDS</h1>
      <p class="text_headingDescription">"She is"は、さまざまな仲間（Girlfriends）たちと<span class="sp-hide">、</span><br class="pc-hide">場所をつくっています。</p>
      <?php get_template_part('partial/pickup-girlfriends');?>
    </section><?php endif;?>
  </div>
</div>

</div>
<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>