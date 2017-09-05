<?php get_template_part( 'partials/head' )?>

<div class="row">
  <div class="col-md-12">
    <?php if(have_posts()):?>
    <table class="table table-striped">
    <tr>
      <th>タイトル</th>
      <th>作成日</th>
    </tr>
    <?php
    while(have_posts()):
    the_post();
    ?>
    <tr>
      <td><strong><a href="<?php the_permalink()?>"><?php the_title()?></a></strong></td>
      <td><?php echo get_the_date()?></td>
    </tr>
    <?php endwhile?>
    </table>
    <?php endif?>
  </div>
</div>

<?php get_template_part( 'partials/foot' )?>