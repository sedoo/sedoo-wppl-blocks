<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e9dbc5e2e479',
        'title' => 'apirest',
        'fields' => array(
            array(
                'key' => 'field_5d80ay7e4602c',
                'label' => 'Titre de la zone',
                'name' => 'apiresttitle',
                'type' => 'text',
                'instructions' => '',
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
                'label' => 'Mode d\'édition',
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
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'Avancé',
                'ui_off_text' => 'Pas à Pas',
            ),
            array(
				'key' => 'field_5dd2cdhg2dca8',
				'label' => 'Affichage',
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
					'list' => 'Liste',
					'grid' => 'Grille',
					'grid-noimage' => 'Grille sans image',
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'list',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
            array(
                'key' => 'field_5e9dbc82cb644',
                'label' => 'Url de récupération',
                'name' => 'url_de_recuperation',
                'type' => 'text',
                'instructions' => 'Insérez ici l\'url sur laquelle sera effectuée la requête.',
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