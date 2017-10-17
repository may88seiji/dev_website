<?php
/* ----------------------------------------------------------
  ￼Init Post Types
---------------------------------------------------------- */
add_action('init',function()
{

  register_post_type('works', array(
    'labels' => array(
      'name'                  => 'works',
      'singular_name'         => 'works',
      'add_new'               => '新規追加',
      'add_new_item'          => 'worksを追加',
      'edit_item'             => 'worksを編集',
      'new_item'              => '新しいworks',
      'view_item'             => 'worksを見る',
      'search_items'          => 'worksを探す',
      'not_found'             => 'worksはありません',
      'not_found_in_trash'    => 'ゴミ箱にworksはありません',
      'parent_item_colon'     => ''
    ),
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'query_var'             => true,
    // 'rewrite'               => true,
    'capability_type'       => 'post',
    'hierarchical'          => false,
    'menu_position'         => 5,
    'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'author', 'comments', 'revisions'),
    'has_archive'           => true,
    'show_in_menu'          => true,
    'show_in_nav_menu'      => true,
    'menu_icon'             => 'dashicons-tickets-alt',
  ));

  register_post_type('news', array(
    'labels' => array(
      'name'                  => 'news',
      'singular_name'         => 'news',
      'add_new'               => '新規追加',
      'add_new_item'          => 'newsを追加',
      'edit_item'             => 'newsを編集',
      'new_item'              => '新しいnews',
      'view_item'             => 'newsを見る',
      'search_items'          => 'newsを探す',
      'not_found'             => 'newsはありません',
      'not_found_in_trash'    => 'ゴミ箱にnewsはありません',
      'parent_item_colon'     => ''
    ),
    'public'                => true,
    'publicly_queryable'    => true,
    'show_ui'               => true,
    'query_var'             => true,
    // 'rewrite'               => true,
    'capability_type'       => 'post',
    'hierarchical'          => false,
    'menu_position'         => 5,
    'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'author', 'comments', 'revisions'),
    'has_archive'           => true,
    'show_in_menu'          => true,
    'show_in_nav_menu'      => true,
    'menu_icon'             => 'dashicons-tickets-alt',
  ));

});
