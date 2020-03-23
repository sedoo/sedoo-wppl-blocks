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

function register_sedoo_buttons_block_types() {

    // register related block content.
    acf_register_block_type(array(
        'name'              => 'sedoo_blocks_vectorButton',
        'title'             => __('Sedoo Boutons'),
        'description'       => __('Ajouter un bouton avec icone SVG'),
        'render_callback'	=> 'sedoo_blocks_buttons_render_callback',
        'category'          => 'sedoo-block-category',
        'icon'              => 'button',
        'keywords'          => array( 'button', 'svg' , 'sedoo'),
    ));

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_sedoo_buttons_block_types');
}

?>