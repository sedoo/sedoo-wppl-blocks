<?php 
if( function_exists('acf_add_local_field_group') ):
	
	acf_add_local_field_group(array(
		'key' => 'group_5f6c87db01f67',
		'title' => 'Field for pagelist',
		'fields' => array(
			array(
				'key' => 'field_5f6c8800c7209',
				'label' => __('Display only child pages ?', 'sedoo-wppl-blocks'),
				'name' => 'ajouter_toutes_les_pages_enfants_',
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
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5f6c87e6c7208',
				'label' => __('Pages to display', 'sedoo-wppl-blocks'),
				'name' => 'pages_a_inserer',
				'type' => 'relationship',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5f6c8800c7209',
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
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => '',
				'filters' => array(
					0 => 'search',
					1 => 'post_type',
					2 => 'taxonomy',
				),
				'elements' => '',
				'min' => '',
				'max' => '',
				'return_format' => 'id',
			),
			array(
				'key' => 'field_5gv2cdab4dce9',
				'label' => __('Order', 'sedoo-wppl-blocks'),
				'name' => 'sedoo-block-pages-list-order',
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
					'ASC' => __('ASC', 'sedoo-wppl-blocks'),
					'DESC' => __('DESC', 'sedoo-wppl-blocks'),
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'ASC',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5gx2cdab4dce9',
				'label' => __('Order by', 'sedoo-wppl-blocks'),
				'name' => 'sedoo-block-pages-list-orderby',
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
					'title' => __('Title', 'sedoo-wppl-blocks'),
					'date' => __('Date', 'sedoo-wppl-blocks'),
					'rand' => __('Random', 'sedoo-wppl-blocks'),
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'title',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_5gt2cdab4dce9',
				'label' => __('Layout', 'sedoo-wppl-blocks'),
				'name' => 'sedoo-block-pages-list-layout',
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
					'grid-noimage' => __('Grid no image', 'sedoo-wppl-blocks'),
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'default_value' => 'list',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/sedoo-pageslist',
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