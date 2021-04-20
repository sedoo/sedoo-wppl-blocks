<?php

function register_sedoo_listearticle_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'postlist',
        'title'             => __('Sedoo post list', 'sedoo-wppl-blocks'),
        'description'       => __('List post by categories and choose layout.', 'sedoo-wppl-blocks'),
        'render_callback'   => 'sedoo_blocks_listearticle_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'grid-view',
        'keywords'          => array( 'sedoo', 'articles', 'liste', 'post', 'grid', 'categories' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_listearticle_block_types');
}