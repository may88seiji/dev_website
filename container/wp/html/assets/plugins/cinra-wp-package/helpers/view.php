<?php

/* ----------------------------------------------------------

  ￼Helpers > View

---------------------------------------------------------- */

if (!function_exists('get_archive_title'))
{
  function get_archive_title( $default = null )
  {
    $title = null;
    if ($obj = get_queried_object())
    {
      $title = $obj->name;
      if (is_post_type_archive()) $title = $obj->label;
    }
    return $title ? $title : $default;
  }
}



/* ----------------------------------------------------------

  ￼Simple Pagination

---------------------------------------------------------- */

if (!function_exists('wp_simple_paginate'))
{

  function wp_simple_paginate()
  {

    global $paged, $wp_query, $wp_rewrite;
    $paginate_base = get_pagenum_link(1);

    if ( strpos($paginate_base, '?') || !$wp_rewrite->using_permalinks() )
    {
      $paginate_format = '';
      $paginate_base = add_query_arg('paged','%#%');
    }
    else
    {
      $paginate_format = ( substr($paginate_base,-1,1) === '/' ? '' : '/' ) .
      user_trailingslashit('page/%#%/','paged');;
      $paginate_base .= '%_%';
    }

    $pages = paginate_links(array(
      'base'        => $paginate_base,
      'format'      => $paginate_format,
      'total'       => $wp_query->max_num_pages,
      'type'        => 'array',
      'mid_size'    => 4,
      'current'     => ($paged ? $paged : 1),
    ));

    if ($pages)
    {
      echo '<ul class="pagination">';
      foreach($pages as $page)
      {
        echo '<li>';
        echo $page;
        echo '</li>';
      }
      echo '</ul>';
    }

  }

}