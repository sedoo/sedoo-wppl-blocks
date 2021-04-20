<?php

function register_sedoo_listepages_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'sedoo_pageslist',
        'title'             => __('Sedoo page list', 'sedoo-wppl-blocks'),
        'description'       => __('List pages.', 'sedoo-wppl-blocks'),
        'render_callback'   => 'sedoo_blocks_listepages_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'grid-view',
        'keywords'          => array( 'sedoo', 'pages', 'liste', 'grid', 'categories' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_listepages_block_types');
}