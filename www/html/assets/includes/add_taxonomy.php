<?php

function register_taxonomy_sheis()
{

  $post_labels = array(
                  // 'section' => array(
                  //           'name'                => 'セクション',
                  //           'singular_name'       => 'セクション',
                  //           'search_items'        => 'セクションを検索',
                  //           'popular_items'       => 'よく使われているセクション',
                  //           'all_items'           => 'すべてのセクション',
                  //           'parent_item'         => null,
                  //           'parent_item_colon'   => null,
                  //           'edit_item'           => 'セクションの編集',
                  //           'update_item'         => '更新',
                  //           'add_new_item'        => '新規セクション',
                  //           'new_item_name'       => '新しいセクション'
                  //           ),
                  'feature' => array(
                            'name'                => '特集名',
                            'singular_name'       => '特集名',
                            'search_items'        => '特集名を検索',
                            'popular_items'       => 'よく使われている特集名',
                            'all_items'           => 'すべての特集名',
                            'parent_item'         => null,
                            'parent_item_colon'   => null,
                            'edit_item'           => '特集名の編集',
                            'update_item'         => '更新',
                            'add_new_item'        => '新規特集名',
                            'new_item_name'       => '新しい特集名'
                            ),
                  'series' => array(
                            'name'                => '連載名',
                            'singular_name'       => '連載名',
                            'search_items'        => '連載名を検索',
                            'popular_items'       => 'よく使われている連載名',
                            'all_items'           => 'すべての連載名',
                            'parent_item'         => null,
                            'parent_item_colon'   => null,
                            'edit_item'           => '連載名の編集',
                            'update_item'         => '更新',
                            'add_new_item'        => '新規連載名',
                            'new_item_name'       => '新しい連載名'
                            ),
                  'sponsor' => array(
                            'name'                => 'スポンサー名',
                            'singular_name'       => 'スポンサー名',
                            'search_items'        => 'スポンサー名を検索',
                            'popular_items'       => 'よく使われているスポンサー名',
                            'all_items'           => 'すべてのスポンサー名',
                            'parent_item'         => null,
                            'parent_item_colon'   => null,
                            'edit_item'           => 'スポンサー名の編集',
                            'update_item'         => '更新',
                            'add_new_item'        => '新規スポンサー名',
                            'new_item_name'       => '新しいスポンサー名'
                            ),
                  'girlfriend' => array(
                            'name'                => 'GIRLFRIEND',
                            'singular_name'       => 'GIRLFRIEND',
                            'search_items'        => 'GIRLFRIENDを検索',
                            'popular_items'       => 'よく使われているGIRLFRIEND',
                            'all_items'           => 'すべてのGIRLFRIEND',
                            'parent_item'         => null,
                            'parent_item_colon'   => null,
                            'edit_item'           => 'GIRLFRIENDの編集',
                            'update_item'         => '更新',
                            'add_new_item'        => '新規GIRLFRIEND',
                            'new_item_name'       => '新しいGIRLFRIEND'
                            ),
  );

  foreach($post_labels as $key => $label)
  {
    $args = array(
      'label'               => $label['name'],
      'labels'              => $label,
      'hierarchical'        => true,
      'show_ui'             => true,
      'show_in_nav_menus'   => true,
      'query_var'           => true,
      'show_admin_column'   => true,
      // 'rewrite'             => array('slug' => $key, 'with_front' => true),
      'rewrite'             => true,
      'show_in_rest'        => true,
    );

    $obj = ($key == 'girlfriend') ? array('post', 'news') : array('post');
    register_taxonomy($key, $obj, $args);
  }

  //register_post_type
  $params = array(
            'news' => array(
              'labels' => array(
                      'name' => 'お知らせ',
                      'singular_name' => 'お知らせ',
                      'add_new' => '新規追加',
                      'add_new_item' => 'お知らせを新規追加',
                      'edit_item' => 'お知らせを編集する',
                      'new_item' => '新規お知らせ',
                      'all_items' => 'お知らせ一覧',
                      'view_item' => 'お知らせの説明を見る',
                      'search_items' => '検索する',
                      'not_found' => 'お知らせが見つかりませんでした。',
                      'not_found_in_trash' => 'ゴミ箱内にお知らせが見つかりませんでした。'
              ),
              'public' => true,
              'has_archive' => true,
              'menu_icon' => 'dashicons-megaphone',
              'supports' => array(
                      'title',
                      'editor',
                      'author',
              ),
            ),
  );

  foreach($params as $key => $param)
  {
    register_post_type($key, $param);
  }
  // flush_rewrite_rules(false);
}


add_action('init', 'register_taxonomy_sheis', 0);


