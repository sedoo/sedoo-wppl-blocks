<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5de8dcab4b989',
        'title' => 'Block : vectorButton',
        'fields' => array(
            array(
                'key' => 'field_5de9245ec8a46',
                'label' => 'Button group',
                'name' => 'sedoo_blocks_vectorbutton_group',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => 'field_5de8dcc701ac2',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add button',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5de8dcc701ac2',
                        'label' => 'Text',
                        'name' => 'sedoo_blocks_vectorButton_text',
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
                        'key' => 'field_5de8dd7601ac3',
                        'label' => 'link',
                        'name' => 'sedoo_blocks_vectorButton_link',
                        'type' => 'link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_5de8ddd101ac4',
                        'label' => 'Icon SVG',
                        'name' => 'sedoo_blocks_vectorButton_svg',
                        'type' => 'file',
                        'instructions' => 'Require a SVG icon !<br>
    To override CSS fill color in your theme :
    div.sedoo-button-block-group a.sedoo-button-block > svg {
            fill:YOUR_COLOR;
    }
    div.sedoo-button-block-group a.sedoo-button-block:hover > svg {
            fill:YOUR_COLOR;
    }',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'library' => 'all',
                        'min_size' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_5de91cc2b2ab8',
                        'label' => 'Border',
                        'name' => 'sedoo_blocks_vectorButton_border',
                        'type' => 'true_false',
                        'instructions' => 'To override default border style, use this CSS rule in your theme :
    div.sedoo-button-block-group a.sedoo-button-block.border-on {
            border:1px solid #000;
    }',
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
                        'key' => 'field_5de91d9fb2ab9',
                        'label' => 'Border rounded',
                        'name' => 'sedoo_blocks_vectorButton_borderStyle',
                        'type' => 'true_false',
                        'instructions' => 'Square by default.
    To override default rounded border, use this CSS rule in your theme :
    div.sedoo-button-block-group a.sedoo-button-block.border-on.rounded {
            border-radius:5px;
    }',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_5de91cc2b2ab8',
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
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 1,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/sedoo-blocks-vectorbutton',
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