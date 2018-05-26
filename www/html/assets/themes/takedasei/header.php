<!DOCTYPE html>
<html lang="ja">
  <head>
    <title><?php wp_title('', true, 'right')?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="takedaseiのウェブサイトです">
    <meta name="keywords" content="takedasei 詩">
    <meta name="format-detection" content="telephone=no">
    <meta property="og:title" content="Takeda Sei">
    <meta property="og:description" content="takedaseiのウェブサイトです">
    <meta property="og:url" content="http://takedasei.com/">
    <meta property="og:image" content="<?php echo home_url('');?>/assets/themes/takedasei/ogimg.png">
    <meta property="og:site_name" content="Takeda Sei">
    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="">
    <meta name="twitter:site" content="site">
    <meta name="twitter:title" content="Takeda Sei">
    <meta name="twitter:description" content="takedaseiのウェブサイトです。">
    <meta name="twitter:url" content="http://takedasei.com/">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="<?php echo home_url('');?>/assets/themes/takedasei/ogimg.png">
    <link rel="icon" href="<?php echo home_url('');?>/assets/themes/takedasei/favicon.png"/>
    <link rel="apple-touch-icon" href="<?php echo home_url('');?>/assets/themes/takedasei/touch-icon.png">
    <style>
    </style>
    <?php wp_head(); ?>
  </head>
  <body>
    <?php if(!IS_LOCAL) get_template_part('partial/ga');?>
    <div class="l-wrapper">
      <header class="l-header pc-hide">
        <div class="header-inner">
          <h1 class="header-logo"><a href="<?php echo home_url('');?>">Takeda Sei</a></h1>

          <div class="l-menu pc-hide js-navi">
            <a class="menu-trigger" href="#">
              <span></span>
              <span></span>
              <span></span>
            </a>

            <div class="menu-content">
              <ul>
                <li class="<?php if ( is_home() ) { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>">home</a></li>
                <li class="<?php if ( is_page('about') ) { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>/about">about</a></li>
                <li class="<?php if ( $pt == 'news') { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>/news">news</a></li>
                <li class="<?php if ( $pt == 'works') { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>/works">works</a></li>
                <li class="<?php if ( $pt == 'blog') { echo 'is-current'; } ?>"><a href="<?php echo home_url('');?>/blog">blog</a></li>
                <li><a href="mailto:takedasei.ishere@gmail.com">contact</a></li>
                <ul class="menu-utility-sns">
                  <li><a href="https://twitter.com/takedaseiishere"><i class="icon-twitter"></i></a></li>
                  <li><a href="https://www.instagram.com/takedasei.ishere/?hl=ja"><i class="icon-instagram"></i></a></li>
                  <li><a href='https://feedly.com/i/subscription/feed%2Fhttp%3A%2F%2Ftakedasei.com%2Ffeed%2F%20'  target='blank'><img id='feedlyFollow' src='http://s3.feedly.com/img/follows/feedly-follow-logo-black_2x.png' alt='follow us in feedly' width='20' height='20'></a></li>
                </ul>
              </ul>

              <div class="copyright">© Takeda Sei.</div>

            </div>
          </div>

        </div>
      </header>