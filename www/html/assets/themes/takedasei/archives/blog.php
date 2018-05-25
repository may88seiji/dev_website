<?php 
$time = get_post_time('Y/n/j D'); 

get_header(); 
?>
 
  <div class="l-container blog">
    <div class="l-content">
      <div class="l-currentPage">blog</div>


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
              <a href="<?php the_permalink(); ?>">
                <span class="date"><?php echo $time ?></span>
                <h2><?php the_title();?>
                </h2>
              </a>
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