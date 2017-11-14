<?php 
$customPosts_news = get_custom_post(2, 'news');
$customPosts_works = get_custom_post(1, 'works');
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
        <?php if($customPosts_news) : foreach($customPosts_news as $post) : setup_postdata( $post ); ?>
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
        <?php if($customPosts_works) : foreach($customPosts_works as $post) : setup_postdata( $post ); ?>
        <a href="<?php the_permalink(); ?>">
          <p><span class="title"><?php the_title(); ?></span><br><br>
           <?php  $this_content = $post->post_content;  echo $this_content;  ?>
          </p>
        </a>
        <?php endforeach; endif; wp_reset_postdata(); ?>
      </div>
    </div>
    
    <footer class="l-footer sp-hide">
      <div class="copyright">© Takeda Sei.</div>
    </footer>


  </div>
</div>

<?php get_footer();