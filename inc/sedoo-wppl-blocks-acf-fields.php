<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e6b87e3ec2fc',
        'title' => 'Activation des blocs',
        'fields' => array(
            array(
                'key' => 'field_5e6b87eb0bd85',
                'label' => 'Bloc Apirest',
                'name' => 'sedoo_activation_apirest',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc Apirest',
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
                'key' => 'field_5e6b87eb0bd91',
                'label' => 'Bloc Iframe',
                'name' => 'sedoo_activation_iframe',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc Iframe',
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
                'key' => 'field_5g6b87ed0bd25',
                'label' => 'Bloc RelatedContents',
                'name' => 'sedoo_activation_relatedcontents',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc RelatedContents',
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
                'key' => 'field_5e6b8e14c425a',
                'label' => 'Bloc Annuaire',
                'name' => 'sedoo_activation_annuaire',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc annuaire',
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
                'key' => 'field_5e6b96cac2e28',
                'label' => 'Bloc FAQ',
                'name' => 'sedoo_activation_faq',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc faq',
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
                'key' => 'field_5e6f560a64e4d',
                'label' => 'Bloc Liste d\'articles',
                'name' => 'sedoo_activation_listearticle',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc liste d\'articles',
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
                'key' => 'field_5e3b87eb6bd76',
                'label' => 'Bloc Liste de contenus',
                'name' => 'sedoo_activation_listecpt',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc liste de contenus',
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
                'key' => 'field_5e6b87eb0bd23',
                'label' => 'Bloc Liste de pages',
                'name' => 'sedoo_activation_listepages',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc liste de pages',
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
                'key' => 'field_5e73658813c94',
                'label' => 'Bloc boutons',
                'name' => 'sedoo_activation_boutons',
                'type' => 'true_false',
                'instructions' => 'Active ou désactive le bloc boutons',
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
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-activation-des-blocks',
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