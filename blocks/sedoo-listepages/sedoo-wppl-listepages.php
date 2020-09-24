<?php

function sedoo_listepages_scripts() {
    wp_register_style( 'sedoo_listepages', plugins_url('css/listepages.css', __FILE__) );
    wp_enqueue_style( 'sedoo_listepages' );
}
add_action('wp_enqueue_scripts','sedoo_listepages_scripts');

include 'sedoo-wppl-listepages-functions.php';
include 'sedoo-wppl-listepages-acf.php';
include 'inc/sedoo-wppl-listepages-acf-fields.php';
