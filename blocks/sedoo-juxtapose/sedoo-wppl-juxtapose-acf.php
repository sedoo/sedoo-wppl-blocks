<?php
function register_sedoo_juxtapose_block_types() {

    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'sedoo_juxtapose',
        'title'             => __('Sedoo juxtapose image', 'sedoo-wppl-blocks'),
        'description'       => __('Add a customizable juxtapose', 'sedoo-wppl-blocks'),
        'render_callback'   => 'sedoo_blocks_juxtapose_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'welcome-widgets-menus',
        'keywords'          => array( 'juxtapose', 'sedoo' ),
    ));
}
?>