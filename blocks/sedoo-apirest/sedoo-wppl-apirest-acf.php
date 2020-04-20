<?php

function register_sedoo_apirest_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'sedoo_apirest',
        'title'             => __('Sedoo apirest'),
        'description'       => __('Ajoute un bloc apirest'),
        'render_callback'   => 'sedoo_blocks_apirest_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'format-chat',
        'keywords'          => array( 'apirest', 'sedoo' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_apirest_block_types');
}