<?php
global $wp_query;

if($wp_query->found_posts%3 > 0):
  $s = ($wp_query->found_posts > 3) ? $wp_query->found_posts%3 : 2 - (int)$wp_query->found_posts;
  for ($i=0; $i <= $s; $i++) get_template_part('partial/card-highlight-empty-single');
endif;
