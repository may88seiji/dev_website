<?php
$next_post = get_next_post();
$prev_poxt = get_previous_post();

get_header(); 
?>

<div class="l-container detail js-detail">
    <div class="l-content">
      <div class="l-currentPage">works</div>


      <div class="l-side">
        <div class="l-side-inner">
          <?php get_sidebar(); ?>
        </div>
      </div>

      <div class="l-main js-getInnerHeight js-startRight js-scrollX">
        <div class="main-inner">
          <div class="l-works_detail">
            <div class="wysiwyg">
              <p >
                <span class="title"><?php the_title(); ?></span>
                <?php
                $this_content = $post->post_content;
                echo $this_content;
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="l-pager">
        <ul class="pager">
          <li><a href="<?php echo home_url('');?>/works"><i class="icon-dots"></i></a></li>
          <?php if (!empty( $next_post )): ?>
          <li class="sp-hide"><a href="<? echo get_permalink( $next_post->ID );?>"><i class="icon-arrow_left"></i></a></li>
          <?php endif;
          if (!empty( $prev_poxt  )): ?>
          <li class="sp-hide"><a href="<?php echo get_permalink( $prev_poxt->ID );?>"><i class="icon-arrow_right"></i></a></li>
          <?php endif; ?>
         
        </ul>
      </div>

        <footer class="l-footer">
          <div class="copyright">© Takeda Sei.</div>
        </footer>


      </div>
    </div>

<?php get_footer();