<?php

function register_sedoo_faq_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'sedoo_faq',
        'title'             => __('Sedoo FAQ'),
        'description'       => __('Ajoute un bloc FAQ'),
        'render_callback'   => 'sedoo_blocks_faq_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'format-chat',
        'keywords'          => array( 'FAQ', 'sedoo' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_faq_block_types');
}