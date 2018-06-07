<?php

include_once( WP_CONTENT_DIR . '/includes/global.php' );

/* ----------------------------------------------------------

  概要（抜粋）の文字数調整

---------------------------------------------------------- */
function my_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', 'my_excerpt_length');
function new_excerpt_more($more) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* パブリサイズ共有カスタム投稿
========================================================= */
function cpt_publicize_share() {
  add_post_type_support( 'blog', 'publicize' );
  add_post_type_support( 'works', 'publicize' );
}
add_action( 'init', 'cpt_publicize_share' );