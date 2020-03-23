<?php

function register_sedoo_annuaire_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'sedoo_blocks_annuaire',
        'title'             => __('Annuaire'),
        'description'       => __('Ajoute un block annuaire'),
        'render_callback'   => 'sedoo_blocks_annuaireHome_render_callback',
        'enqueue_style'     => plugin_dir_url( __FILE__ ) . 'template-parts/blocks/annuaire/annuaire.css',
        'category'          => 'sedoo-block-category',
        'icon'              => 'media-text',
        'keywords'          => array( 'annuaire', 'sedoo' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_annuaire_block_types');
}