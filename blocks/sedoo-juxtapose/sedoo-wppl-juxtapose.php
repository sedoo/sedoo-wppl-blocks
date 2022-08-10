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

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_juxtapose_block_types');
}

function sedoo_blocks_juxtapose_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	$templateURL = plugin_dir_path(__FILE__) . "template-parts/blocks/juxtapose/juxtapose.php";
    // include a template part from within the "template-parts/block" folder
    
	if( file_exists( $templateURL)) {
		include $templateURL;
    }
}



