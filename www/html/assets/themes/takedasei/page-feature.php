<?php
$terms = get_terms('feature');
get_template_part('partial/head');
?>
<div class="l-container page-list">

  <div class="l-content">
    <div class="l-main">
      <section class="l-section">
        <h1 class="heading_section_secondary">特集一覧</h1>
        <?php if($terms):?><ul class="cards_rect">

          <?php foreach($terms as $term):?><li>
            <a href="<?php echo get_term_link($term);?>">
              <?php
              $img_pc = get_field('list_image_pc', $term);
              $img_sp = get_field('list_image_sp', $term);
              if($img_pc && $img_sp):?><div class="cards_rect-img">
                <picture>
                  <source class="js-lazyload" media="(min-width: 768px)" data-srcset="<?php echo $img_pc['sizes']['si-wide']?>">
                  <img class="js-lazyload" data-src="<?php echo $img_sp['sizes']['si-wide-sp']?>" alt="<?php echo $term->name?>">
                </picture>
              </div><?php endif;?>
              <div class="cards_rect-text c-bd-b_<?php the_field('color', $term)?>">
                <div class="cards_rect-text-head">
                  <p class="cards_rect-lead c-cl-f_<?php the_field('color', $term)?>"><?php the_field('year', $term);?>年<?php the_field('month', $term);?>月 今月の特集</p>
                  <p class="cards_rect-title"><?php echo $term->name?></p>
                </div>
                <p class="cards_rect-description"><?php the_field('lead', $term)?></p>
              </div>
            </a>
          </li><?php endforeach;?>

        </ul><?php endif;?>
        <?php /*si_pagination();*/?>
      </section>
    </div>
  </div>
  <div class="l-aside">
    <?php get_template_part('partial/aside-latest');?>
  </div>

</div>

<footer class="l-footer">
  <div class="footer-crumb">
    <ul class="footer-crumb-list">
      <li><a href="<?php echo home_url('/')?>">HOME</a></li>
      <li class="is-current">特集一覧</li>
    </ul>
  </div>
<?php get_template_part('partial/foot');?>