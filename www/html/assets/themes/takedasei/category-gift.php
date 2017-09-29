<?php
get_template_part('partial/head');?>

<div class="l-container page-list_gift">

  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <h1 class="heading_section_secondary">PAST GIFT</h1>
        <?php if(have_posts()):?><ul class="cards_highlight">
          <?php while(have_posts()): the_post();
            get_template_part('partial/card-highlight');
          endwhile; wp_reset_postdata();

          get_template_part('partial/card-highlight-empty');?>
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
      <li><a href="<?php echo home_url();?>">HOME</a></li>
      <li class="is-current">ギフト一覧</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>