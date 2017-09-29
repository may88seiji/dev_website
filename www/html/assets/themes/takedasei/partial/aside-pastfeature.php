<?php
global $feature;

if($terms = get_terms('feature', array('exclude' => $feature->term_id, 'number' => 4))):?><section class="l-section">
      <h1 class="heading_section_secondary">PAST FEATURES</h1>
      <p class="text_headingDescription_secondary">これまでの特集</p>
      <ul class="cards_rect">
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
      </ul>
      <p class="button_fill"><a href="<?php echo home_url('/taxonomy/'. $term->slug)?>">ALL</a></p>
    </section><?php endif;?>