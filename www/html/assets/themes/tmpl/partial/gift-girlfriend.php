<?php if($get_field = get_field('tx_girlfriend')):?>
  <section class="l-section">
    <h1 class="heading_section_primary">GIRLFRIENDS</h1>
    <p class="text_headingDescription">今回のギフトに関わったGirlfriends</p>
    <ul class="list_octagon js-matchHeight">
      <?php foreach($get_field as $field):?><li><a href="<?php echo get_term_link($field['girlfriend']);?>">
        <?php if($img = get_field('image', $field['girlfriend'])):?><div class="list_octagon-img">
          <svg><image xlink:href="<?php echo $img['sizes']['si-square-xsmall']?>" width="100%" height="100%" /></image></svg>
        </div><?php endif;?>
        <p class="list_octagon-text"><?php echo $field['girlfriend']->name?></p></a>
        <p class="list_octagon-summary"><?php echo $field['comment']?></p>
      </li><?php endforeach;?>
    </ul>
  </section>
<?php endif;?>