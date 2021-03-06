<?php

acf_add_local_field_group(array (
  'key' => 'group_5989723fdbf45',
  'title' => 'GIFT',
  'fields' => array (
    array (
      'key' => 'field_5989724d2968b',
      'label' => 'GIRLFRIEND',
      'name' => 'tx_girlfriend',
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
      'layout' => 'row',
      'button_label' => '行を追加',
      'sub_fields' => array (
        array (
          'key' => 'field_598972622968c',
          'label' => 'GIRLFRIEND',
          'name' => 'girlfriend',
          'type' => 'taxonomy',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array (
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'taxonomy' => 'girlfriend',
          'field_type' => 'radio',
          'allow_null' => 0,
          'add_term' => 1,
          'save_terms' => 0,
          'load_terms' => 0,
          'return_format' => 'object',
          'multiple' => 0,
        ),
        array (
          'key' => 'field_5989728b2968d',
          'label' => 'コメント',
          'name' => 'comment',
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
          'rows' => '',
          'new_lines' => 'br',
          'readonly' => 0,
          'disabled' => 0,
        ),
      ),
    ),
    array (
      'key' => 'field_59a8ccc137589',
      'label' => 'お届け時期',
      'name' => 'shipping_month',
      'type' => 'text',
      'instructions' => '例）11月下旬',
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
      'key' => 'field_59b4e1d1b9e49',
      'label' => '課金予定日',
      'name' => 'charge_date',
      'type' => 'text',
      'instructions' => '例）11月1日',
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
  ),
  'location' => array (
    array (
      array (
        'param' => 'post_category',
        'operator' => '==',
        'value' => 'category:gift',
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