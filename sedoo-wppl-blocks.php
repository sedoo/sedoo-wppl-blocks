<?php
/**
 * Plugin Name: Sedoo - Blocks
 * Description: Blocs d'édition : annuaire, boutons SVG, FAQ, liste d'articles, iframe, contenus en relation
 * Version: 1.1.15
 * Author: Nicolas Gruwe & Pierre Vert - SEDOO DATA CENTER
 * Author URI:      https://www.sedoo.fr 
 * GitHub Plugin URI: sedoo/sedoo-wppl-blocks
 * GitHub Branch:     master
 * Text Domain:     sedoo-wppl-blocks
 * Domain Path:     /languages
 */

if ( ! function_exists('get_field') ) {
        
	add_action( 'admin_init', 'sb_plugin_deactivate');
	add_action( 'admin_notices', 'sb_plugin_admin_notice');

	//Désactiver le plugin
	function sb_plugin_deactivate () {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
	
	// Alerter pour expliquer pourquoi il ne s'est pas activé
	function sb_plugin_admin_notice () {
		
		echo '<div class="error">Le plugin requiert ACF Pro pour fonctionner <br><strong>Activez ACF Pro ci-dessous</strong> ou <a href=https://wordpress.org/plugins/advanced-custom-fields/> Téléchargez ACF Pro &raquo;</a><br></div>';

		if ( isset( $_GET['activate'] ) ) 
			unset( $_GET['activate'] );	
	}
} else {

	/***
	 * ATTENTION, toutes les functions doivent aller ici 
	 */

	if( function_exists('acf_add_options_page') ) {
	
		acf_add_options_page(array(
			'page_title' 	=> __( 'Blocks settings', 'sedoo-wppl-blocks' ),
			'menu_title'	=> 'Gestion de Blocs',
			'menu_slug' 	=> 'sedoo-blocks-settings',
			'redirect'		=> true
		));
		
		acf_add_options_sub_page(array(
			'page_title' 	=> __( 'Blocks activation', 'sedoo-wppl-blocks' ),
			'menu_title'	=> 'Activation des blocks',
			'parent_slug'	=> 'sedoo-blocks-settings',
		));
	}

	add_action( 'admin_menu', 'reusable_block_link_function' );
    function reusable_block_link_function() {
  	  add_menu_page( 'linked_url', 'Blocs réutilisables', 'read', 'reusable_blocks_link', '', 'dashicons-text', 95 );
    }

    add_action( 'admin_menu' , 'adminreusablebloc_function' );
    function adminreusablebloc_function() {
		global $menu;
		$menu[95][2] = site_url()."/wp-admin/edit.php?post_type=wp_block";
    }

	if(get_field('sedoo_activation_iframe', 'option') == 1) {
		include 'blocks/sedoo-iframe/sedoo-wppl-iframe.php';
	}
	if(get_field('sedoo_activation_apirest', 'option') == 1) {
		include 'blocks/sedoo-apirest/sedoo-wppl-apirest.php';
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

	if(get_field('sedoo_activation_listepages', 'option') == 1) {
		include 'blocks/sedoo-listepages/sedoo-wppl-listepages.php';
	}

	if(get_field('sedoo_activation_boutons', 'option') == 1) {
		include 'blocks/sedoo-buttons/sedoo-wppl-buttons.php';
	}

	if(get_field('sedoo_activation_relatedcontents', 'option') == 1) {
		include 'blocks/sedoo-relatedcontents/sedoo-wppl-relatedcontents.php';
	}

	if(get_field('sedoo_activation_listecpt', 'option') == 1) {
		include 'blocks/sedoo-listecpt/sedoo-wppl-listecpt.php';
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

}

// LOAD LANGUAGES FILES
function sedoo_blocks_load_language() {
    load_plugin_textdomain( 'sedoo-wppl-blocks', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'sedoo_blocks_load_language' );