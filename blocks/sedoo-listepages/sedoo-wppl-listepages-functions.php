<?php


function sedoo_blocks_listepages_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	$templateURL = plugin_dir_path(__FILE__) . "template-parts/blocks/listepages/listepages.php";
    // include a template part from within the "template-parts/block" folder
    
	if( file_exists( $templateURL)) {
		include $templateURL;
    }
}

function sedoo_listpages_display_items($layout) {
    switch ($layout) {
        case 'grid':
            include plugin_dir_path(__FILE__) ."../../template-parts/content-grid.php";
            break;
        case 'grid-noimage':
            include plugin_dir_path(__FILE__) ."../../template-parts/content-grid-noimage.php";
            break;
        case 'list':
            include plugin_dir_path(__FILE__) ."../../template-parts/content-list.php";
        break;
        default:
            break;
    }
}