<?php


function sedoo_blocks_apirest_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	$templateURL = plugin_dir_path(__FILE__) . "template-parts/blocks/apirest/apirest.php";
    // include a template part from within the "template-parts/block" folder
    
	if( file_exists( $templateURL)) {
		include $templateURL;
    }
}

function recuperationmedia($url) {
    $imageJson = json_decode(file_get_contents($url),true);
	$urlimage = $imageJson['guid']['rendered'];
	?>
	<div class="item-img">
		<img src="<?php echo $urlimage; ?>" alt="" />
	</div>
	<?php 
}