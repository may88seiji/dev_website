<?php

global $si_member;

get_template_part('partial/head');?>

<div class="l-container page-mypage">
  <div class="l-billboard">
    <h1 class="heading_billboard">マイページ</h1>
  </div>
  <div class="l-content">
    <div class="l-main">
      <div class="main-inner">
        <div class="cards_mypage">
          <div class="cards_mypage-body">
            <p class="cards_mypage-heading">登録情報</p>
            <p class="cards_mypage-name"><?php echo esc_html($si_member->get_member_data('name1') . ' ' . $si_member->get_member_data('name2'));?> さん</p>
            <p class="cards_mypage-mail"><?php echo esc_html($si_member->get_member_data('mailaddress1'));?></p>
          </div>
          <div class="cards_mypage-button">
            <p class="button_fill"><a href="<?php echo home_url('members/profile/');?>">登録情報</a></p>
          </div>
        </div>

        <?php /* 10月末までの表示を仮実装 TODO: #376 */if($main_feature = get_main_feature()):?><div class="cards_mypage">
          <div class="cards_mypage-body">
            <p class="cards_mypage-heading">配送状況</p>
            <p class="cards_mypage-text">
              <span class="c-cl-f_<?php echo get_main_theme_color_key();?>"><?php the_field('year', $main_feature);?>年<?php the_field('month', $main_feature);?>月のギフト</span>：<br><?php the_field('shipping_month', get_main_gift())?>のお届け</p>
          </div>
          <div class="cards_mypage-button">
            <p class="button_fill"><a href="<?php echo home_url('members/order/');?>">配送状況一覧</a></p>
          </div>
        </div><?php endif;?>

        <?php
        $q = new WP_Query(array(
          'post_type'      => 'post',
          'posts_per_page' => 3,
          'category_name'  => 'note',
        ));

        if ($q->have_posts()):?><h2 class="heading_mypage">MEMBERS 限定記事</h2>
        <ul class="cards_article">
          <?php while ($q->have_posts()): $q->the_post();
            get_template_part('partial/card-article');
          endwhile; wp_reset_postdata();?>
        </ul>
        <p class="button_fill"><a href="<?php echo home_url('members/article/');?>">MEMBERS 限定記事一覧</a></p>
        <?php endif;?>

      </div>
    </div>

    <?php get_template_part('partial/members-side');?>
  </div>
</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/');?>">HOME</a></li>
      <li class="is-current">マイページ</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>