<?php

the_post();

$next_post = get_next_post();
$prev_poxt = get_previous_post();

get_header(); 
?>

<div class="l-container">
    <div class="l-content">
      <div class="l-currentPage">blog</div>

      <div class="l-side">
        <div class="l-side-inner">
          <?php get_sidebar(); ?>
        </div>
      </div>

      <div class="l-main js-getInnerHeight">
        <div class="main-inner">
          <div class="l-blog_detail">
            <div class="title"><?php the_title(); ?></div>
            <div class="wysiwyg">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </div>

      <div class="l-pager">
        <ul class="pager">
          <li><a href="<?php echo home_url('');?>/blog"><i class="icon-dots"></i></a></li>
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