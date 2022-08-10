<?php
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

function sedoo_juxtapose_css() {
    wp_register_style( 'sedoo-juxtapose', 'https://s3.amazonaws.com/cdn.knightlab.com/libs/juxtapose/latest/css/juxtapose.css' );
    wp_enqueue_style( 'sedoo-juxtapose' );
}
add_action('wp_enqueue_scripts','sedoo_juxtapose_css');

function sedoo_juxtapose_scripts() {
    echo '<script src="https://s3.amazonaws.com/cdn.knightlab.com/libs/juxtapose/latest/js/juxtapose.js"></script>';
}
add_action( 'wp_footer', 'sedoo_juxtapose_scripts' );


?>