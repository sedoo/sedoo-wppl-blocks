<?php 
if( function_exists('acf_add_local_field_group') ):
	
	
		acf_add_local_field_group(array(
			'key' => 'group_5f733cd924e86',
			'title' => 'liste cpt',
			'fields' => array(
				array(
					'key' => 'field_5f733cdde91f9',
					'label' => __('Content type to show', 'sedoo-wppl-blocks'),
					'name' => 'type_de_contenu_a_lister',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
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
					'key' => 'field_5f733dffe91fa',
					'label' => __('Filter type', 'sedoo-wppl-blocks'),
					'name' => 'type_de_filtres',
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
					'ui_on_text' => 'Tags',
					'ui_off_text' => 'Catégories',
				),
				array(
					'key' => 'field_5f733e10e91fb',
					'label' => __('Categories', 'sedoo-wppl-blocks'),
					'name' => 'sedoo_listecpt_categories_liste',
					'type' => 'select',
					'instructions' => __('Only non-empty categories will be shown', 'sedoo-wppl-blocks'),
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_5f733dffe91fa',
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
					'default_value' =>  array(
						0 => __('Choose a category', 'sedoo-wppl-blocks'),
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'key' => 'field_5f733e28e91fc',
					'label' => 'Tags',
					'name' => 'sedoo_listecpt_tags_liste',
					'type' => 'select',
					'instructions' => __('Only non-empty tags will be shown', 'sedoo-wppl-blocks'),
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_5f733dffe91fa',
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
					'choices' => array(
					),
					'default_value' =>  array(
						0 => __('Choose a tag', 'sedoo-wppl-blocks'),
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
				array(
					'key' => 'field_5f7471d74d0a1',
					'label' => __('Layout', 'sedoo-wppl-blocks'),
					'name' => 'sedoo_listecpt_mode_daffichage',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'grid' => __('Grid', 'sedoo-wppl-blocks'),
						'grid-noimage' => __('Grid no image', 'sedoo-wppl-blocks'),
						'list' => __('List', 'sedoo-wppl-blocks'),
						'minilist' => __('Mini list', 'sedoo-wppl-blocks'),
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
					'key' => 'field_5fb6464a01a8e',
					'label' => __('Limit', 'sedoo-wppl-blocks'),
					'name' => 'sedoo_listecpt_limit',
					'type' => 'number',
					'instructions' => __('Amount of posts to show', 'sedoo-wppl-blocks'),
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
					'min' => '',
					'max' => '',
					'step' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/sedoo-listecpt',
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