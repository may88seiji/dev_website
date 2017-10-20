<?php get_header(); ?>
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
          <li class="sp-hide"><a href=""><i class="icon-arrow_left"></i></a></li>
          <li class="sp-hide"><a href=""><i class="icon-arrow_right"></i></a></li>
        </ul>
      </div>

        <footer class="l-footer">
          <div class="copyright">© Takeda Sei.</div>
        </footer>


      </div>
    </div>

<?php get_footer();