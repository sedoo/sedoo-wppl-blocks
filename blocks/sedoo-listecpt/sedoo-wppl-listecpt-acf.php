<?php

function register_sedoo_listecpt_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'sedoo_listecpt',
        'title'             => __('Sedoo Liste de contenus'),
        'description'       => __('List custom post types.'),
        'render_callback'   => 'sedoo_blocks_listecpt_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'grid-view',
        'keywords'          => array( 'sedoo', 'cpt', 'liste', 'grid', 'categories' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_listecpt_block_types');
}