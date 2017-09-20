<?php
global $exclude_id;
$exclude_id = array();

get_template_part('partial/head');

?>
<div class="l-container page-list">

  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <h1 class="heading_section_secondary">お知らせ</h1>

        <?php if(have_posts()):?><ul class="list_notice">

          <?php while(have_posts()): the_post();?><li>
            <a href="<?php the_permalink()?>">
               <div class="list_notice-inner">
                <div class="list_notice-img"><img class="js-lazyload" data-src="<?php echo ($img = get_field('list_image')) ? $img['sizes']['si-square-small'] : get_template_directory_uri(). '/assets/img/noimg-news.png'?>" alt="<?php echo strip_tags(get_the_title()); ?>"></div>
                <div class="list_notice-textBox">
                  <div class="list_notice-title"><?php the_title();?></div>
                  <div class="list_notice-description"><?php the_field('lead');?></div>
                  <div class="list_notice-date"><?php echo get_post_time('M j.Y');?></div>
                </div>
              </div>
            </a>
          </li><?php endwhile;?>
        </ul><?php endif;?>

        <?php si_pagination();?>

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
      <li class="is-current">お知らせ</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>