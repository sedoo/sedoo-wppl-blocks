<?php

function register_sedoo_iframe_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'sedoo_iframe',
        'title'             => __('Sedoo Iframe'),
        'description'       => __('Ajoute une Iframe personnalisable'),
        'render_callback'   => 'sedoo_blocks_iframe_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'welcome-widgets-menus',
        'keywords'          => array( 'iframe', 'sedoo' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_iframe_block_types');
}