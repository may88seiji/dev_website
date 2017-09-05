<?php get_template_part( 'partials/head' )?>

<div class="row">
  <div class="col-md-12">
    <h1><?php the_title()?></h1>
    <hr>
    <h2>固定ページ</h2>
    <h2>標準テンプレート</h2>
    <hr>
    <div class="wysiwyg"><?php the_content()?></div>
  </div>
</div>

<?php get_template_part( 'partials/foot' )?>