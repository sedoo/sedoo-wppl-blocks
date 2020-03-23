<?php

function sedoo_listearticle_scripts() {
    wp_register_style( 'sedoo_listearticle', plugins_url('css/listearticle.css', __FILE__) );
    wp_enqueue_style( 'sedoo_listearticle' );
}
add_action('wp_enqueue_scripts','sedoo_listearticle_scripts');

include 'sedoo-wppl-listearticle-functions.php';
include 'sedoo-wppl-listearticle-acf.php';
include 'inc/sedoo-wppl-listearticle-acf-fields.php';
