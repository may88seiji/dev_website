<div class="l-side">
  <div class="l-side-inner">
    <h3 class="heading_mypage">MENU</h3>
    <ul class="list_mypage-menu">
      <li class="button_border_block"><a href="<?php echo home_url('members/profile/');?>">登録情報</a></li>
      <li class="button_border_block"><a href="<?php echo home_url('members/order/');?>">配達状況一覧</a></li>
      <li class="button_border_block"><a href="<?php echo home_url('members/article/');?>">MEMBERS 限定記事一覧</a></li>
    </ul>

    <?php if (get_query_var('si_action') !== 'profile'):
      $args = array(
        'category_name'      => 'notice',
        'posts_per_page' => 3,
      );

      if ($posts = get_posts($args)): ?><h3 class="heading_mypage">お知らせ</h3>
    <ul class="list_mypage-news">
      <?php foreach ($posts as $post): setup_postdata($post); ?><li>
        <p class="list_mypage-news-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></p>
        <p class="list_mypage-news-date"><?php echo get_post_time('M j. Y');?></p>
      </li><?php endforeach; wp_reset_postdata();?>
    </ul>
    <?php /*if ((int)$q->found_posts > 3):?><p class="button_fill"><a href="<?php echo home_url('news/');?>">お知らせ一覧</a></p><?php endif;*/?>
    <?php endif;
    endif;?>

  </div>
</div>
