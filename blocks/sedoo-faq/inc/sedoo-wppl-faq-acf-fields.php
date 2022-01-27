<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e6b9b19386e7',
        'title' => 'bloc FAQ',
        'fields' => array(
            array(
                'key' => 'field_5e6b9b7dad6c8',
                'label' => __('Categories', 'sedoo-wppl-blocks'),
                'name' => 'faq_categories',
                'type' => 'taxonomy',
                'instructions' => __('Filters askings by categories', 'sedoo-wppl-blocks'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'taxonomy' => 'sedoo_faq_categorie',
                'field_type' => 'multi_select',
                'allow_null' => 0,
                'add_term' => 1,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'id',
                'multiple' => 0,
            ),
            array(
                'key' => 'field_5e6b9bf78c761',
                'label' => __('Amount of FAQ', 'sedoo-wppl-blocks'),
                'name' => 'faq_nombre',
                'type' => 'text',
                'instructions' => __('Amount of FAQ displayed (0 for all)', 'sedoo-wppl-blocks'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/sedoo-faq',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
    
    endif;
?>