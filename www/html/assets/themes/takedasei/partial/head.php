<!DOCTYPE html>
<html lang="ja"<?php if (Sheis\Welcart\Extension\Helper::is_member_logged_in()):?> class="is-login"<?php endif;?>>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="format-detection" content="telephone=no">
  <title><?php wp_title('', true, 'right')?></title>
  <link rel="icon" href="<?php echo get_template_directory_uri();?>/assets/img/favicon.ico"/>
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri();?>/assets/img/touch-icon.png">
  <?php wp_head()?>
</head>
<body>
  <?php if(!IS_LOCAL) get_template_part('partial/ga');?>
  <div class="l-wrapper">
    <header class="l-header c-bg-b_<?php echo get_main_theme_color_key();?> js-fixedNavi<?php if(is_front_page()):?> header_top<?php endif;?>">
      <h1 class="header-logo"><a href="<?php echo home_url('/');?>" title="She is"></a></h1>
      <ul class="header-navi_feature pc-hide">
        <li><a href="<?php echo home_url('/about/');?>">ABOUT</a></li>
        <li><a href="<?php echo get_the_permalink(get_main_gift());?>">GIFT</a></li>
      </ul>
      <div class="header-humberger js-spNavi_open"><i></i></div>
      <div class="header-navi js-spNavi">
        <div class="header-navi-inner">
          <div class="header-navi-close js-spNavi_close pc-hide"><i></i></div>
          <ul class="header-navi-main">
            <li><a href="<?php echo get_main_feature('permalink')?>">FEATURE</a></li>
            <li><a href="<?php echo get_the_permalink(get_main_gift());?>">GIFT</a></li>
            <li><a href="<?php echo home_url('/girlfriends/');?>">GIRLFRIENDS</a></li>
            <li><a href="<?php echo home_url('/about/');?>">ABOUT</a></li>
          </ul>
          <?php if($links = get_headernavi_links()):?><ul class="header-navi-tags">
            <?php foreach($links as $link):?><li><a href="<?php echo $link['href']?>">#<?php echo $link['label']?></a></li><?php endforeach;?>
          </ul><?php endif;?>
          <ul class="header-navi-register pc-hide">
            <?php if (Sheis\Welcart\Extension\Helper::is_member_logged_in()):?>
            <li><a href="<?php echo home_url('/members/')?>">マイページ</a></li>
            <li><a href="<?php echo home_url('/logout/')?>">ログアウト</a></li>
            <?php else:?>
            <li><a href="<?php echo home_url('/login/')?>">ログイン</a></li>
            <li><a href="<?php echo home_url('/registration/')?>" onClick="<?php echo ga_event_script('cv', 'pre-spmenu');?>">新規登録</a></li>
            <?php endif;?>
          </ul>
          <div class="header-navi-search pc-hide">
            <form method="get" action="<?php echo home_url('/search/')?>">
              <input type="text" name="q" title="検索" autocomplete="off" />
              <button type="submit" class="header-search-button"><i></i></button>
            </form>
          </div>
          <ul class="header-navi-sns pc-hide">
            <?php get_template_part('partial/sns-links');?>
            <li class="header-navi-sns-info"><a href="<?php echo home_url('/news/');?>">お知らせ</a></li>
          </ul>
        </div>
      </div>
      <div class="header-utility sp-hide">
        <ul class="header-utility-info">
          <li class="header-utility-info-news"><a href="<?php echo home_url('/news');?>">お知らせ</a></li>
          <li class="header-utility-info-search js-headerSearch c-bg-b_<?php echo get_main_theme_color_key();?>">
            <form method="get" action="<?php echo home_url('/search/')?>">
              <span>SEARCH</span><input type="text" name="q" title="検索" autocomplete="off" />
              <button type="submit" class="header-search-button"><i></i></button>
            </form>
          </li>
        </ul>
        <ul class="header-utility-sns">
          <?php get_template_part('partial/sns-links');?>
        </ul>
        <ul class="header-utility-register">
          <?php if (Sheis\Welcart\Extension\Helper::is_member_logged_in()):?>
          <li class="button_fill"><a href="<?php echo home_url('/members/')?>">マイページ</a></li>
          <li class="button_fill"><a href="<?php echo home_url('/logout/')?>">ログアウト</a></li>
          <?php else:?>
          <li class="button_fill"><a href="<?php echo home_url('/login/')?>">ログイン</a></li>
          <li class="button_fill"><a href="<?php echo home_url('/registration/')?>" onClick="<?php echo ga_event_script('cv', 'pre-header');?>">新規登録</a></li>
          <?php endif;?>
        </ul>
      </div>
    </header>
    <div class="js-header_ghost"></div>