<!DOCTYPE html>
<html lang="ja">
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="format-detection" content="telephone=no">
  <title><?php wp_title('｜', true, 'right')?><?php bloginfo('sitename')?></title>
  <link rel="icon" href="<?php echo get_template_directory_uri();?>/assets/img/favicon.ico"/>
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri();?>/assets/img/touch-icon.png">
  <?php wp_head()?>
</head>
<body>
  <div class="l-wrapper">
    <header class="l-header header_simple c-bg-b_<?php echo get_main_theme_color_key();?>">
      <h1 class="header-logo"><a href="<?php echo home_url('/');?>" title="She is" onClick="<?php echo ga_event_script('cv', get_query_var('si_action'). '-logo');?>"></a></h1>
      <h2 class="header-pagetitle">Members新規登録</h2>
    </header>
