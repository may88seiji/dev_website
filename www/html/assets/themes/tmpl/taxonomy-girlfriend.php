<?php

global $wp_query, $exclude_id;
$girlfriend = $wp_query->queried_object;

$exclude_id = array();

get_template_part('partial/head');
?>
<div class="l-container page-detail_girlfriends">

  <div class="l-content">
    <div class="l-main">
      <section class="l-section detail_girlfriends">
        <h1 class="heading_section_secondary">GIRLFRIENDS</h1>

        <div class="detail_girlfriend">
          <div class="detail_girlfriend-inner">
            <?php if($img = get_field('image', $girlfriend)):?><div class="detail_girlfriend-img"><img class="js-lazyload" data-src="<?php echo $img['sizes']['si-square-large']?>" alt=""></div><?php endif;?>
            <div class="detail_girlfriend-textBox">
              <?php if(get_field('en_title', $girlfriend)):?><div class="detail_girlfriend-furigana sp-hide"><?php the_field('en_title', $girlfriend);?></div><?php endif;?>
              <div class="detail_girlfriend-wrapName">
                <div class="detail_girlfriend-name">
                  <?php echo $girlfriend->name;?>
                  <?php if(get_field('en_title', $girlfriend)):?><span class="detail_girlfriend-furigana pc-hide"><?php the_field('en_title', $girlfriend);?></span><?php endif;?>
                </div>
                <ul class="detail_girlfriend-sns">
                  <?php if(get_field('url', $girlfriend)):?><li><a class="icon-home" href="<?php the_field('url', $girlfriend);?>" target="_blank"></a></li><?php endif;?>
                  <?php if(get_field('url_sub', $girlfriend)):?><li><a class="icon-home" href="<?php the_field('url_sub', $girlfriend);?>" target="_blank"></a></li><?php endif;?>
                  <?php if(get_field('twitter_id', $girlfriend)):?><li><a class="icon-twitter" href="https://twitter.com/<?php the_field('twitter_id', $girlfriend);?>" target="_blank"></a></li><?php endif;?>
                  <?php if(get_field('twitter_id_sub', $girlfriend)):?><li><a class="icon-twitter" href="https://twitter.com/<?php the_field('twitter_id_sub', $girlfriend);?>" target="_blank"></a></li><?php endif;?>
                  <?php if(get_field('insta_id', $girlfriend)):?><li><a class="icon-instagram" href="https://www.instagram.com/<?php the_field('insta_id', $girlfriend);?>" target="_blank"></a></li><?php endif;?>
                  <?php if(get_field('insta_id_sub', $girlfriend)):?><li><a class="icon-instagram" href="https://www.instagram.com/<?php the_field('insta_id_sub', $girlfriend);?>" target="_blank"></a></li><?php endif;?>
                </ul>
              </div>
              <?php if(get_field('profile', $girlfriend)):?><div class="detail_girlfriend-text"><?php the_field('profile', $girlfriend);?></div><?php endif;?>
            </div>
          </div>
        </div>
      </section>

      <?php if(have_posts()):?><section class="l-section detail_girlfriends_related">
        <h1 class="heading_section_secondary"><?php echo $girlfriend->name;?>が関わっている記事</h1>

        <ul class="cards">
          <?php while(have_posts()): the_post();
            if(in_category('limited', $post)):
              $limited_posts[] = $post;
            else:
              $exclude_id[] = get_the_ID();
              get_template_part('partial/card');
            endif;
          endwhile;?>
        </ul>
      </section><?php endif;?>

      <section class="l-section detail_girlfriends_other">
        <h1 class="heading_section_secondary">OTHER GIRLFRIENDS</h1>
        <?php get_template_part('partial/pickup-girlfriends');?>
      </section>
    </div>
  </div>

  <div class="l-aside">
    <?php get_template_part('partial/aside-latest');?>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li><a href="<?php echo home_url('/girlfriends/')?>">GIRLFRIENDS</a></li>
      <li class="is-current"><?php echo $girlfriend->name;?></li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>