<?php
if( function_exists('acf_add_local_field_group') ):


    acf_add_local_field_group(array(
        'key' => 'group_5e9dbc5e2e479',
        'title' => 'apirest',
        'fields' => array(
            array(
				'key' => 'field_5gd2c8342dce6',
				'label' => __('Title', 'sedoo-wppl-blocks'),
				'name' => 'sedoo-apirest-block-list-title',
				'type' => 'text',
				'instructions' => __('Not show if empty', 'sedoo-wppl-blocks'),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
            array(
                'key' => 'field_5e9dbc61cb643',
                'label' => __('Setting mode', 'sedoo-wppl-blocks'),
                'name' => 'mode_dedition',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => __('Expert', 'sedoo-wppl-blocks'),
                'ui_off_text' => __('Beginner', 'sedoo-wppl-blocks'),
            ),
            array(
                'key' => 'field_5e9dbc82cb644',
                'label' => __('URl', 'sedoo-wppl-blocks'),
                'name' => 'url_de_recuperation',
                'type' => 'text',
                'instructions' => __('Insert here the url where the request will be done.', 'sedoo-wppl-blocks'),
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5e9dbc61cb643',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
				'key' => 'field_5dd2cdhg2dca8',
				'label' => __('Layout', 'sedoo-wppl-blocks'),
				'name' => 'sedoo-apirest-list-layout',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'list' => __('List', 'sedoo-wppl-blocks'),
					'grid' => __('Grid', 'sedoo-wppl-blocks'),
					'grid-noimage' => __('Grid noimage', 'sedoo-wppl-blocks'),
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'list',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
            ),
            array(
                'key' => 'field_5e9eb8bab097a',
                'label' => __('Website', 'sedoo-wppl-blocks'),
                'name' => 'site_a_recuperer',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5e9dbc61cb643',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                ),
                'default_value' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5e9ec0daae508',
                'label' => __('Content', 'sedoo-wppl-blocks'),
                'name' => 'contenus_a_recuperer',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5e9dbc61cb643',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                ),
                'default_value' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5e9ef4bfb9e24',
                'label' => __('Taxonomy', 'sedoo-wppl-blocks'),
                'name' => 'taxonomie_a_recuperer',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5e9dbc61cb643',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                ),
                'default_value' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5e9efed45552f',
                'label' => __('Term', 'sedoo-wppl-blocks'),
                'name' => 'term_a_recuperer',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5e9dbc61cb643',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                ),
                'default_value' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5ea7ecfb22c80',
                'label' => __('Display "Show more" button ?', 'sedoo-wppl-blocks'),
                'name' => 'afficher_bouton_en_savoir_plus_',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_5ea7ed0f22c81',
                'label' => __('Show excerpt ?', 'sedoo-wppl-blocks'),
                'name' => 'afficher_lextrait_',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_5eaacc52d53f4',
                'label' => __('Exclude content', 'sedoo-wppl-blocks'),
                'name' => 'exclusion_de_contenu',
                'type' => 'text',
                'instructions' => __('By ID, split by ,      Ex : 25,17,18', 'sedoo-wppl-blocks'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
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
                    'value' => 'acf/sedoo-apirest',
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