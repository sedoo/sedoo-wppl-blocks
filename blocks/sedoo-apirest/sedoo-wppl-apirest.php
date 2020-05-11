<?php

include 'sedoo-wppl-apirest-acf.php';
include 'sedoo-wppl-apirest-functions.php';
include 'inc/sedoo-wppl-apirest-acf-fields.php';

function enqueuapirestscript() {
    // le fichier js qui contient les fonctions tirgger au change des select
    $src_ctp = plugins_url().'/sedoo-wppl-blocks/blocks/sedoo-apirest/js/populatecpt.js';
    wp_enqueue_script('sedoo_apirest', $src_ctp,  array ( 'jquery' ));
    wp_localize_script( 'sedoo_apirest', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action( 'admin_head', 'enqueuapirestscript' );

//
// la fonction qui remplis le select site
//
// je recupere la liste des sites
// je l'envoi et je la retourne, vraiment tranquilou celui la ca commence doucement
function sedoo_labtools_acf_populate_sitelist($field) {
    $content_site_list = [];
    $sites = get_sites();   
    foreach($sites as $site) {
        $content_site_list[''] = 'Selectionner un site';
        $site_url = get_blog_details($site->blog_id)->siteurl; 
        $content_site_list[$site_url] = get_blog_details($site->blog_id)->blogname;
    }

    $field['choices'] = $content_site_list;
    return $field;
}
add_filter('acf/load_field/name=site_a_recuperer', 'sedoo_labtools_acf_populate_sitelist');
