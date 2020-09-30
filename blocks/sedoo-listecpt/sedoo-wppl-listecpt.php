<?php

function sedoo_listecpt_scripts() {
    wp_register_style( 'sedoo_listecpt', plugins_url('css/listecpt.css', __FILE__) );
    wp_enqueue_style( 'sedoo_listecpt' );
}
add_action('wp_enqueue_scripts','sedoo_listecpt_scripts');

function enqueu_sedoo_listecpt_script() {
    // le fichier js qui contient les fonctions tirgger au change des select
    $src_ctp = plugins_url().'/sedoo-wppl-blocks/blocks/sedoo-listecpt/js/listecpt.js';
    wp_enqueue_script('sedoo_listecptback', $src_ctp,  array ( 'jquery' ));                 
    wp_localize_script( 'sedoo_listecptback', 'ajaxurl', admin_url( 'admin-ajax.php' ) );      
}
add_action( 'admin_head', 'enqueu_sedoo_listecpt_script' );


include 'sedoo-wppl-listecpt-functions.php';
include 'sedoo-wppl-listecpt-acf.php';
include 'inc/sedoo-wppl-listecpt-acf-fields.php';
