<?php

if ( is_post_type_archive() )
{
  if ( isset($wp_query->query['post_type']) && in_array($wp_query->query['post_type'], array( 'works', 'news','blog')) )
  {
    get_template_part( 'archives/' . $wp_query->query['post_type'] );
    exit;
  }
}