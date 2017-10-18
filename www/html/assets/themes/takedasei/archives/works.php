<?php
$count_custom = wp_count_posts('works');
$custom_posts = $count_custom->publish;
$custom_posts += 1;

get_header(); ?>
  <div class="l-container about">
    <div class="l-content">
      <div class="l-currentPage">works</div>


      <div class="l-side">
        <div class="l-side-inner">
          <?php get_sidebar(); ?>
        </div>
      </div>

      <div class="l-main">
        <div class="main-inner">
          <ol class="olWorks reversed" style="counter-reset:item <?php echo $custom_posts?>">
            <?php while( have_posts() ): the_post();?>
              <li><a href="<?php the_permalink(); ?>"><p><?php the_title(); ?></p></a></li>
            <?php endwhile;?>
          </ol>
        </div>
      </div>

        <footer class="l-footer">
          <div class="copyright">© Takeda Sei.</div>
        </footer>


      </div>
    </div>

<?php get_footer();