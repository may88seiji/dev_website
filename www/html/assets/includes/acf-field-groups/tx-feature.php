<?php

acf_add_local_field_group(array (
  'key' => 'group_598964b9190fc',
  'title' => 'FEATURE',
  'fields' => array (
    array (
      'key' => 'field_59896864af2a3',
      'label' => 'カラー',
      'name' => '',
      'type' => 'tab',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'placement' => 'top',
      'endpoint' => 0,
    ),
    array (
      'key' => 'field_5989663ea6113',
      'label' => 'テーマカラー',
      'name' => 'color',
      'type' => 'radio',
      'instructions' => '',
      'required' => 1,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => get_colorset_options(),
      'default_value' => array (
      ),
      'allow_null' => 0,
      'multiple' => 0,
      'ui' => 0,
      'ajax' => 0,
      'placeholder' => '',
      'disabled' => 0,
      'readonly' => 0,
    ),
    array (
      'key' => 'field_59896876af2a4',
      'label' => 'テキスト',
      'name' => '',
      'type' => 'tab',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'placement' => 'top',
      'endpoint' => 0,
    ),
    array (
      'key' => 'field_599d8ba412c68',
      'label' => '年',
      'name' => 'year',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => 2017,
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_599a8e4298010',
      'label' => '月',
      'name' => 'month',
      'type' => 'text',
      'instructions' => '例）9・10, 11, 12 ※「月」はつけない',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_598965036de3e',
      'label' => 'リード文',
      'name' => 'lead',
      'type' => 'textarea',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => 2,
      'new_lines' => 'br',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_598965236de3f',
      'label' => '本文（アニメーションテキスト）',
      'name' => 'content',
      'type' => 'textarea',
      'instructions' => 'HTMLタグで記入',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => 10,
      'new_lines' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_5989654a6de40',
      'label' => '画像',
      'name' => '',
      'type' => 'tab',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'placement' => 'top',
      'endpoint' => 0,
    ),
    array (
      'key' => 'field_5989655b6de41',
      'label' => 'トップページ用イメージ',
      'name' => 'top_images',
      'type' => 'repeater',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'collapsed' => '',
      'min' => '',
      'max' => '',
      'layout' => 'table',
      'button_label' => '行を追加',
      'sub_fields' => array (
        array (
          'key' => 'field_599266657e953',
          'label' => '画像',
          'name' => 'image',
          'type' => 'image',
          'instructions' => '1745x635',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'return_format' => 'array',
          'preview_size' => 'thumbnail',
          'library' => 'all',
          'min_width' => '',
          'min_height' => '',
          'min_size' => '',
          'max_width' => '',
          'max_height' => '',
          'max_size' => '',
          'mime_types' => '',
        ),
        array (
          'key' => 'field_599267616f435',
          'label' => 'キャプション',
          'name' => 'caption',
          'type' => 'text',
          'instructions' => '',
          'required' => '',
          'conditional_logic' => '',
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
          'readonly' => 0,
          'disabled' => 0,
        ),
      ),
    ),
    array (
      'key' => 'field_598965856de42',
      'label' => 'メインイメージ',
      'name' => 'main_image',
      'type' => 'image',
      'instructions' => '1745x635',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'preview_size' => 'thumbnail',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
    array (
      'key' => 'field_598965906de43',
      'label' => '一覧用イメージ PC',
      'name' => 'list_image_pc',
      'type' => 'image',
      'instructions' => '1960x760',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'preview_size' => 'thumbnail',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
    array (
      'key' => 'field_5996b8823341d',
      'label' => '一覧用イメージ SP',
      'name' => 'list_image_sp',
      'type' => 'image',
      'instructions' => '680x446',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'preview_size' => 'thumbnail',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
    array (
      'key' => 'field_59b0b0040a1b9',
      'label' => 'サイドカラム用スクエア',
      'name' => 'list_image_square',
      'type' => 'image',
      'instructions' => '600x600',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'preview_size' => 'thumbnail',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'taxonomy',
        'operator' => '==',
        'value' => 'feature',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

function get_colorset_options()
{
  $color_set = get_field('colorset', 'options');
  if(!$color_set) return false;

  $options = array();
  foreach($color_set as $key => $value)
  {
    $options[$key] = $value['label'];
  }
  if($options) return $options;
}