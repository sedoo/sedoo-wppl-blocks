<?php

/**
 * ACF gutenberg Block
 */

function register_sedoo_relatedcontents_block_types() {

    // register related block content.
    acf_register_block_type(array(
        'name'              => 'sedoo_labtools_relatedBlock',
        'title'             => __('Sedoo Related Block', 'sedoo-wppl-blocks'),
        'description'       => __('Add related content.', 'sedoo-wppl-blocks'),
        'render_callback'	=> 'sedoo_blocks_relatedBlock_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'category',
        'keywords'          => array( 'sedoo', 'équipe', 'relation','plateforme', 'related' ),
    ));
}
// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_relatedcontents_block_types');
}

?>