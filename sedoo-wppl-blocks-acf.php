<?php

/**
 * Options du plugin
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Sedoo Blocks Settings',
		'menu_title'	=> 'Sedoo Blocks Settings',
		'menu_slug' 	=> 'sedoo-blocks-settings',
		'capability'	=> 'activate_plugins',
		'redirect'		=> true
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Vector buttons',
		'menu_title'	=> 'Vector buttons ',
		'parent_slug'	=> 'lab-tools-settings',
	));

}


/**
 * ACF gutenberg Block
 */

function sedoo_blocks_register_acf_block_types() {

    // register related block content.
    acf_register_block_type(array(
        'name'              => 'sedoo_blocks_vectorButton',
        'title'             => __('Sedoo button'),
        'description'       => __('Add button with SVG icon.'),
        'render_callback'	=> 'sedoo_blocks_vectorButton_render_callback',
        'enqueue_style'     => plugin_dir_url( __FILE__ ) . 'template-parts/blocks/buttonblock/buttonblock.css',
        'category'          => 'widgets',
        'icon'              => 'button',
        'keywords'          => array( 'button', 'svg' ),
    ));

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'sedoo_blocks_register_acf_block_types');
}

?>