	<?php
/**
 * Plugin Name: Sedoo - Blocks
 * Description: Permet l'ajout de différents blocks
 * Version: 0.2.2
 * Author: Nicolas Gruwe 
 * GitHub Plugin URI: sedoo/sedoo-wppl-blocks
 * GitHub Branch:     master
 */

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Gestion de Blocs',
		'menu_title'	=> 'Gestion de Blocs',
		'menu_slug' 	=> 'sedoo-blocks-settings',
		'redirect'		=> true
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Activation des blocks',
		'menu_title'	=> 'Activation des blocks',
		'parent_slug'	=> 'sedoo-blocks-settings',
	));
	
}

if ( ! function_exists('get_field') ) {
        
	add_action( 'admin_init', 'sb_plugin_deactivate');
	add_action( 'admin_notices', 'sb_plugin_admin_notice');

	//Désactiver le plugin
	function sb_plugin_deactivate () {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
	
	// Alerter pour expliquer pourquoi il ne s'est pas activé
	function sb_plugin_admin_notice () {
		
		echo '<div class="error">Le plugin "Aeris Team Member" requiert ACF Pro pour fonctionner <br><strong>Activez ACF Pro ci-dessous</strong> ou <a href=https://wordpress.org/plugins/advanced-custom-fields/> Téléchargez ACF Pro &raquo;</a><br></div>';

		if ( isset( $_GET['activate'] ) ) 
			unset( $_GET['activate'] );	
	}
} else {

	if(get_field('sedoo_activation_iframe', 'option') == 1) {
		include 'blocks/sedoo-iframe/sedoo-wppl-iframe.php';
	}
	
	if(get_field('sedoo_activation_annuaire', 'option') == 1) {
		include 'blocks/sedoo-annuaire/sedoo-wppl-annuaire.php';
	}
	
	if(get_field('sedoo_activation_faq', 'option') == 1) {
		include 'blocks/sedoo-faq/sedoo-wppl-faq.php';
	}

	if(get_field('sedoo_activation_listearticle', 'option') == 1) {
		include 'blocks/sedoo-listearticle/sedoo-wppl-listearticle.php';
	}

	if(get_field('sedoo_activation_boutons', 'option') == 1) {
		include 'blocks/sedoo-buttons/sedoo-wppl-buttons.php';
	}
}

function sedoo_block_category( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'sedoo-block-category',
                'title' => __( 'Blocs Sedoo', 'sedoo-wppl-blocks' ),
                'icon'  => '',
            ),
        )
    );
}
add_filter( 'block_categories', 'sedoo_block_category', 10, 2 );

include 'inc/sedoo-wppl-blocks-acf-fields.php';