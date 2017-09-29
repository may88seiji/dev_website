<?php
global $exclude_id, $feature;
$tags = get_tags_for_her();
$sponsor = get_the_first_term(get_the_ID(), 'sponsor');
$series = get_the_first_term(get_the_ID(), 'series');
?>
<div class="l-main">
  <div class="main-inner">
    <div class="article-head">
      <?php if($feature):?><div class="article-head-lead c-cl-f_<?php the_field('color', $feature)?>"><?php the_field('year', $feature);?>年<?php the_field('month', $feature);?>月 特集：<?php echo $feature->name?></div><?php endif;?>
      <?php if($series):?><div class="article-head-lead">連載：<?php echo $series->name?></div><?php endif;?>
      <?php if($sponsor):?><div class="article-head-lead">SPONCORED：<?php echo $sponsor->name?></div><?php endif;?>
      <?php if(get_field('lead')):?><div class="article-head-staff"><?php the_field('credit');?></div><?php endif;?>

      <div class="article-head_flex">
        <ul class="article-head-tags ">
          <li class="cards-date"><?php echo get_post_time('M j.Y');?></li>
          <?php if($tags):foreach($tags as $tag):?><li><a href="<?php echo get_term_link($tag);?>">#<?php echo $tag->name?></a></li><?php endforeach; endif;?>
        </ul>

        <ul class="article-head-shareIcons">
          <li class="article-head-share">SHARE</li>
          <li><a class="article-head-tw icon-twitter" href="<?php echo get_tw_url();?>" target="_blank"></a></li>
          <li><a class="article-head-fb icon-facebook" href="<?php echo get_fb_url();?>" target="_blank"></a></li>
          <li><a data-pocket-label="pocket" data-pocket-count="vertical" data-lang="en" data-save-url="<?php the_permalink();?>" class="article-head-pocket icon-pocket" href="<?php echo get_pocket_url()?>" target="_blank"></a></li>
          <li><a class="article-head-line icon-line pc-hide" href="<?php echo get_line_url();?>"></a></li>
        </ul>
      </div>

    </div>

    <div class="wysiwyg">
      <?php echo the_content();?>
    </div>

    <?php si_link_page();?>
  </div>

  <?php get_template_part('partial/post-information');?>

  <section class="l-appendix appendix-relatedArticles">
    <?php if($related = get_field('related')):?><h1 class="heading_appendix">RELATED ARTICLES</h1>

    <?php foreach($related as $post): setup_postdata($post); ?><div class="appendix-content appendix-relatedArticle">
      <a href="<?php the_permalink();?>">
        <div class="appendix-inner">
          <?php if($img = get_field('list_image')):?><img class="js-lazyload" data-src="<?php echo $img['sizes']['si-square-medium']?>" alt="<?php echo strip_tags(get_the_title());?>"><?php endif;?>
          <div class="appendix-content-wrapTexts">
            <?php if($sponsor = get_the_first_term(get_the_ID(), 'sponsor')):?><p>SPONCORED：<?php echo $sponsor->name?></p><?php endif;?>
            <?php if($feature = get_the_first_term(get_the_ID(), 'feature')):?><p class="c-cl-f_<?php the_field('color', $feature)?>"><?php the_field('year', $feature);?>年<?php the_field('month', $feature);?>月 特集：<?php echo $feature->name?></p><?php endif;?>
            <?php if($series = get_the_first_term(get_the_ID(), 'series')):?><p>連載：<?php echo $series->name;?></p><?php endif;?>
            <div class="appendix-content-title"><?php the_title();?></div>
            <p><span><?php the_field('lead');?></span></p>
          </div>
        </div>
      </a>
    </div><?php endforeach; wp_reset_postdata(); endif;?>

    <div class="appendix-share">
      <?php if($img = get_field('share_image')):?><div class="appendix-share-img"><img class="js-lazyload" data-src="<?php echo $img['sizes']['si-share']?>" alt="<?php echo strip_tags(get_the_title());?>"></div><?php endif;?>
      <div class="appendix-share-content">
        <div class="appendix-content-wrapTexts">
          <p><span>SHARE!</span></p>
          <p><?php the_title();?></p>
        </div>
        <ul class="appendix-share-icon">
          <li class="icon-twitter"><a href="<?php echo get_tw_url();?>" target="_blank"></a></li>
          <li class="icon-facebook"><a href="<?php echo get_fb_url();?>" target="_blank"></a></li>
          <li class="icon-line pc-hide"><a href="<?php echo get_line_url();?>" target="_blank"></a></li>
        </ul>
        <div class="appendix-follow-content">
          <p>She isの最新情報は<br class="pc-hide">TwitterやFacebookをフォローして<br class="pc-hide">チェック！</p>
          <ul>
            <?php if(get_field('twitter_id', 'options')):?><li><a href="https://twitter.com/<?php the_field('twitter_id', 'options');?>" target="_blank" onClick="<?php echo ga_event_script('sns', 'twitter-article');?>"><i class="icon-twitter"></i>Follow</a></li><?php endif;?>
            <?php if(get_field('facebook_page_url', 'options')):?><li><a href="<?php the_field('facebook_page_url', 'options');?>" target="_blank" onClick="<?php echo ga_event_script('sns', 'facebook-article');?>"><i class="icon-facebook"></i>Like</a></li><?php endif;?>
          </ul>
        </div>
      </div>
    </div>
  </section>
</div>