<?php
/**
 * Plugin Name:     Sedoo Gutenberg blocks
 * Plugin URI:      https://github.com/sedoo/sedoo-wppl-blocks
 * Description:     custom blocks gutenberg
 * Author:          Pierre VERT - SEDOO DATA CENTER
 * Author URI:      https://www.sedoo.fr 
 * Text Domain:     sedoo-wppl-blocks
 * Domain Path:     /languages
 * Version:         0.1.0
 * GitHub Plugin URI: sedoo/sedoo-wppl-blocks
 * GitHub Branch:     master
 * @package         Sedoo_Wppl_Labtools
 */

/* 
* LOAD TEXT DOMAIN FOR TEXT TRANSLATIONS
*/

// function sedoo_blocks_load_plugin_textdomain() {
//     $domain = 'sedoo-wppl-blocks';
//     $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
//     // wp-content/languages/plugin-name/plugin-name-fr_FR.mo
//     load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
//     // wp-content/plugins/plugin-name/languages/plugin-name-fr_FR.mo
//     load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
    
// }
function sedoo_blocks_load_plugin_textdomain() {
    load_plugin_textdomain( 'sedoo-wppl-blocks', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'sedoo_blocks_load_plugin_textdomain' );

include 'inc/sedoo-wppl-blocks-acf.php';
include 'inc/sedoo-wppl-blocks-acf-fields.php';
