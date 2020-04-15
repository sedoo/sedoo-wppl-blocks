<?php 
if( function_exists('acf_add_local_field_group') ):
	// GROUP : Custom block Related Content
    acf_add_local_field_group(array(
        'key' => 'group_5d80ab6e372f7',
        'title' => 'Custom block Related Content',
        'fields' => array(
            array(
                'key' => 'field_5d80ab6e4602c',
                'label' => 'Titre de la zone',
                'name' => 'relatedContentTitle',
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
                'key' => 'field_5d80ab6e46017',
                'label' => 'Type de contenu',
                'name' => 'relatedContentTypeOfContent',
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
                    'location' => 'Emplacements',
                    'event' => 'Évènements',
                    'feedzy_categories' => 'Feed Categories',
                    'sedoo-platform' => 'Plateformes',
                    'sedoo-research-team' => 'Équipes de recherche',
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
                'key' => 'field_5d80ab6e46031',
                'label' => 'Taxonomie',
                'name' => 'relatedContentTaxonomies',
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
                    'event-tags' => 'Étiquettes d’évènement',
                    'event-categories' => 'Catégories',
                    'sedoo-theme-labo' => 'Thématiques',
                    'sedoo-platform-tag' => 'Platform Tags',
                    'sedoo-research-team-tag' => 'Research Team Tags',
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
                'key' => 'field_5d80ab6e46036',
                'label' => 'Nombre de posts',
                'name' => 'post_number',
                'type' => 'range',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'min' => '',
                'max' => '',
                'step' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_5d80ab6e4603c',
                'label' => 'Offset',
                'name' => 'post_offset',
                'type' => 'number',
                'instructions' => '',
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
                    'value' => 'acf/sedoo-labtools-relatedblock',
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