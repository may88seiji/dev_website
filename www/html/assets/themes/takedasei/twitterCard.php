<?php
if (is_singular()){//投稿・固定ページの場合
  if(have_posts()): while(have_posts()): the_post();
  echo '<meta name="twitter:description" content="'.mb_substr(get_the_excerpt(), 0, 100).'">';echo "\n";//抜粋を表示
  endwhile; endif;
  echo '<meta name="twitter:title" content="'; the_title(); echo '">';echo "\n";//単一記事タイトルを表示
  echo '<meta name="twitter:url" content="'; the_permalink(); echo '">';echo "\n";//単一記事URLを表示
} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
  echo '<meta name="twitter:description" content="'; bloginfo('description'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログの説明文を表示
  echo '<meta name="twitter:title" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのタイトルを表示
  echo '<meta name="twitter:url" content="'; bloginfo('url'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのURLを表示
}
$str = $post->post_content;
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿にイメージがあるか調べる
if (is_singular()){//投稿・固定ページの場合
  if (has_post_thumbnail()){//投稿にサムネイルがある場合の処理
    $image_id = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src( $image_id, 'full');
    $img_url = $image[0];
    echo '<meta name="twitter:image" content="'.$image[0].'">';echo "\n";
  } else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//投稿にサムネイルは無いが画像がある場合の処理
    $img_url = $imgurl[2];
    echo '<meta name="twitter:image" content="'.$imgurl[2].'">';echo "\n";
  } else {//投稿にサムネイルも画像も無い場合の処理
    $ogp_image = get_template_directory_uri().'/images/og-image.jpg';
    $img_url = $ogp_image;
    echo '<meta name="twitter:image" content="'.$ogp_image.'">';echo "\n";
  }
} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
  if (get_header_image()){//ヘッダーイメージがある場合は、ヘッダーイメージを
    $img_url = get_header_image();
    echo '<meta name="twitter:image" content="'.$img_url.'">';echo "\n";

  } else {//ヘッダーイメージがない場合は、テーマのスクリーンショット
    $img_url = get_template_directory_uri().'/screenshot.png';
    echo '<meta name="twitter:image" content="'.$img_url.'">';echo "\n";
  }
}
//ドメイン情報を$results[1]に取得する
preg_match( '/https?:\/\/(.+?)\//i', admin_url(), $results );
//画像の縦横幅を取得
list($width,$height) = getimagesize($img_url);
?>