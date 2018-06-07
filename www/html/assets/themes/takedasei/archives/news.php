<?php 

$time = get_post_time('Y/n/j D'); 

get_header(); 
?>
 
  <div class="l-container about">
    <div class="l-content">
      <div class="l-currentPage">news</div>


      <div class="l-side">
        <div class="l-side-inner">
          <?php get_sidebar(); ?>
        </div>
      </div>

      <div class="l-main">
        <div class="main-inner">
          <ul class="news">

            <?php while( have_posts() ): the_post();?>
            <li>
              <span class="date"><?php echo get_post_time('Y.m.d D'); ?></span>
              <h2><?php
                $this_content = $post->post_content;
                echo $this_content;?>
              </h2>
            </li>
            <?php endwhile;?>

          </ul>
        </div>
      </div>

        <footer class="l-footer">
          <div class="copyright">© Takeda Sei.</div>
        </footer>


      </div>
    </div>

<?php get_footer();