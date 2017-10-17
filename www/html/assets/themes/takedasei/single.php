<?php
if (is_single())
{
  if (in_array(get_post_type(), array('works', 'news')))
  {
    get_template_part( 'singles/' . get_post_type() );
    exit;
  }
}