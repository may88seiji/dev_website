<?php 
$customPosts = get_custom_post(2, 'news');
$time = get_post_time('Y/n/j D'); 

get_header(); 
?>

<div class="l-container top">
  <div class="l-content js-getInnerHeight">

    <div class="l-side">
      <div class="l-side-inner">
        <?php get_sidebar(); ?>
      </div>
    </div>
    
    <div class="l-topNews">
      <ul class="topNews">
        <?php if($customPosts) : foreach($customPosts as $post) : setup_postdata( $post ); ?>
          <li>
            <a href="<?php echo home_url('');?>/news"><span class="date"><?php echo $time ?></span><br>
              <?php the_excerpt(); ?>
            </a>
          </li>
        <?php endforeach; endif; wp_reset_postdata(); //クエリのリセット ?>
      </ul>
    </div>
    
    <div class="l-topArticle">
      <div class="topArticle">
        <a href="detail.html"><p>傷のかたち<br><br>ひかりは傷をつくると<br>昨日まで<br>忘れていた</p></a>
      </div>
    </div>
    
    <footer class="l-footer sp-hide">
      <div class="copyright">© Takeda Sei.</div>
    </footer>


  </div>
</div>

<?php get_footer(); ?>