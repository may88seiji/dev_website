<?php
global $exclude_id;
if($recommend = get_field('recommend_post', 'options')):?>
<section class="l-section">
  <h1 class="heading_section_secondary">RECOMMENDED</h1>

  <ul class="cards">
    <?php foreach($recommend as $post): setup_postdata($post);
      get_template_part('partial/card');
      $exclude_id[] = get_the_ID();
    endforeach; wp_reset_postdata();?>
  </ul>
</section>
<?php endif;?>