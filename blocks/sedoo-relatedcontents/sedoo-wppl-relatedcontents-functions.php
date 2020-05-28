<?php


function sedoo_blocks_relatedBlock_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	$templateURL = plugin_dir_path(__FILE__) . "template-parts/blocks/relatedcontents/relatedcontents.php";
    // include a template part from within the "template-parts/block" folder
    
	if( file_exists( $templateURL)) {
		include $templateURL;
    }
}

setcookie('related_Admin', 0);
function set_admin_or_not_var_for_relatedblock() {
    // Do stuff. Say we will echo "Hello World".
    setcookie('related_Admin', 1);
}
add_action( 'admin_init', 'set_admin_or_not_var_for_relatedblock' );