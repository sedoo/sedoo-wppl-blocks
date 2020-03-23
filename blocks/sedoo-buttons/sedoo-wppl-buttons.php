<?php


function sedoo_buttons_scripts() {
    wp_register_style( 'sedoo_button', plugins_url('template-parts/blocks/buttonblock/buttonblock.css', __FILE__) );
    wp_enqueue_style( 'sedoo_button' );
}
add_action('wp_enqueue_scripts','sedoo_buttons_scripts');

include 'sedoo-wppl-buttons-functions.php';
include 'sedoo-wppl-buttons-acf.php';
include 'inc/sedoo-wppl-buttons-acf-fields.php';
