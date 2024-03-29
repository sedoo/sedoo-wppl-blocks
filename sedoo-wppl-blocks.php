<?php
/**
 * Plugin Name: Sedoo - Blocks
 * Description: Blocs d'édition : annuaire, boutons SVG, FAQ, liste d'articles, iframe, contenus en relation
 * Version: 1.8.1
 * Author: Pierre Vert, Nicolas Gruwe - SEDOO DATA CENTER
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
	include 'inc/sedoo-wppl-blocks-acf-fields.php';

	if( function_exists('acf_add_options_page') ) {
		// check if multisite instance for capabilities
		if ( is_multisite() ) 
    	{ $capability = 'manage_network'; } else { $capability = 'update_core'; }

		acf_add_options_page(array(
			'page_title' 	=> __( 'Blocks settings', 'sedoo-wppl-blocks' ),
			'menu_title'	=> 'Gestion de Blocs',
			'menu_slug' 	=> 'sedoo-blocks-settings',
			'capability'	=> $capability,
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

	/**
	 * Set default options
	 */
	if(get_field('sedoo_activation_iframe', 'option') == "") {
		update_field('sedoo_activation_iframe', '1', 'option');
	}
	if(get_field('sedoo_activation_listearticle', 'option') == "") {
		update_field('sedoo_activation_listearticle', '1', 'option');
	}
	if(get_field('sedoo_activation_listepages', 'option') == "") {
		update_field('sedoo_activation_listepages', '1', 'option');
	}
	if(get_field('sedoo_activation_juxtapose', 'option') == "") {
		update_field('sedoo_activation_juxtapose', '1', 'option');
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

	if(get_field('sedoo_activation_juxtapose', 'option') == 1) {
		include 'blocks/sedoo-juxtapose/sedoo-wppl-juxtapose.php';
	}

	function sedoo_block_category( $block_categories, $editor_context ) {
		if ( ! empty( $editor_context->post ) ) {
			array_push(
				$block_categories,
				array(
					'slug'  => 'sedoo-block-category',
					'title' => __( 'Blocs Sedoo', 'sedoo-wppl-blocks' ),
					'icon'  => 'admin-tools',
				)
			);
		}
		return $block_categories;
	}
	add_filter( 'block_categories_all', 'sedoo_block_category', 10, 2 );

}

// LOAD LANGUAGES FILES
function sedoo_blocks_load_language() {
	load_plugin_textdomain( 'sedoo-wppl-blocks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'sedoo_blocks_load_language' );

// load template part layout
function sedoo_layout_display_items($layout, $term_displayed) {
	$template_arg=array( 'term_displayed' => $term_displayed);
	get_template_part('template-parts/content', $layout, $template_arg);
    // switch ($layout) {
    //     case 'grid':
    //         // include plugin_dir_path(__FILE__) ."template-parts/content-grid.php";
	// 		// get_template_part('template-parts/content', 'grid', $template_arg);
	// 		get_template_part('template-parts/content', 'grid', $template_arg);
    //         break;
    //     case 'grid-noimage':
    //         include plugin_dir_path(__FILE__) ."template-parts/content-grid-noimage.php";
    //         break;
    //     case 'list':
    //         include plugin_dir_path(__FILE__) ."template-parts/content-list.php";
    //     break;
    //     default:
    //         break;
    // }
}