<?php

add_action('init', function()
{
  if (function_exists("acf_add_local_field_group"))
  {
    foreach (glob(__DIR__ . '/acf-field-groups/*') as $file)
    {
      include_once $file;
    }
  }
});


add_action('init', function()
{
  if (function_exists('acf_add_options_page'))
  {
    acf_add_options_page(array(
        'page_title' => 'Options',
        'menu_title' => 'Options',
        'menu_slug'  => 'options',
        'capability' => 'administrator',
        'redirect'   => false,
    ));
  }

  if (function_exists('acf_add_options_sub_page'))
  {
    acf_add_options_sub_page(array(
        'page_title'  => 'バナー',
        'menu_title'  => 'バナー',
        'menu_slug'   => 'banners',
        'parent_slug' => 'options',
        'capability'  => 'administrator',
        'redirect'    => false,
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'PICK UP',
        'menu_title'  => 'PICK UP',
        'menu_slug'   => 'pickup',
        'parent_slug' => 'options',
        'capability'  => 'administrator',
        'redirect'    => false,
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'SNSアカウント',
        'menu_title'  => 'SNSアカウント',
        'menu_slug'   => 'sns-account',
        'parent_slug' => 'options',
        'capability'  => 'administrator',
        'redirect'    => false,
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'カラーセット',
        'menu_title'  => 'カラーセット',
        'menu_slug'   => 'colorset',
        'parent_slug' => 'options',
        'capability'  => 'administrator',
        'redirect'    => false,
    ));

  }
});
