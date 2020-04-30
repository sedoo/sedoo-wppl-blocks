<?php

include 'sedoo-wppl-apirest-acf.php';
include 'sedoo-wppl-apirest-functions.php';
include 'inc/sedoo-wppl-apirest-acf-fields.php';

// le fichier js qui contient les fonctions tirgger au change des select
$src_ctp = plugins_url().'/sedoo-wppl-blocks/blocks/sedoo-apirest/js/populatecpt.js';
wp_enqueue_script('sedoo_apirest', $src_ctp);
wp_localize_script( 'sedoo_apirest', 'ajaxurl', admin_url( 'admin-ajax.php' ) );


//
// la fonction qui remplis le select site
//
// je recupere la liste des sites
// je l'envoi et je la retourne, vraiment tranquilou celui la ca commence doucement
function sedoo_labtools_acf_populate_sitelist($field) {
    $content_site_list = [];
    $sites = get_sites();   
    foreach($sites as $site) {
        $content_site_list[$site->blog_id] = get_blog_details($site->blog_id)->blogname;
    }

    $field['choices'] = $content_site_list;
    return $field;
}
add_filter('acf/load_field/name=site_a_recuperer', 'sedoo_labtools_acf_populate_sitelist');


// j'enregistre une variable dans la session car je me suis rendu compte qu'il me la fallait une fois que j'avais fini tout le merdi..
session_start();



//
// la fonction qui remplis le select cpt en fonction du site
//
// je recupere le site envoyé depuis js et en sors le site_url
// je butine l'url types du site pour recuperer les posts types (necessite de recuperer uniquement les ctp)
// je crée un tableau des ctp ($tableau_cpt)
// je recupere les taxonomies par post type pour plus tard ($tableau_ctx_par_cpt)
// j'encode et je renvoie les deux tableaux
function sedoo_labtools_acf_populate_cptlist() {
    // The $_REQUEST contains all the data sent via ajax
    if ( isset($_REQUEST) ) {
        $siteId = $_REQUEST['website'];
        $site_url = get_blog_details($siteId)->siteurl; 
        $_SESSION['siteurl'] = $site_url;
        $cpt_path = $site_url.'/wp-json/wp/v2/types';
        $json = file_get_contents($cpt_path);
        $liste_cpt = json_decode($json,true);  
        $tableau_cpt;
        $tableau_ctx_par_cpt;
        foreach($liste_cpt as $cpt) {
            $tableau_cpt[$cpt['rest_base']] = $cpt['name'];
            // j'enregistre un tableau des taxonomies par cpt pour l'utiliser sur le prochain select
            $tableau_ctx_par_cpt[$cpt['rest_base']] = $cpt['taxonomies'];
        }
        
        echo json_encode(array($tableau_cpt, $tableau_ctx_par_cpt));
    }
     
    // Always die in functions echoing ajax content
   die();
}
add_action( 'wp_ajax_sedoo_labtools_acf_populate_cptlist', 'sedoo_labtools_acf_populate_cptlist' );

//
// la fonction qui remplis le select ctx en fonction du cpt (je travaille sur le tableau $tableau_ctx_par_cpt que j'ai crée avant)
//
function sedoo_labtools_acf_populate_ctxlist() {
    if ( isset($_REQUEST) ) {
        $cpt = $_REQUEST['cpt'];
        $taxo_tableau = $_REQUEST['taxo_tableau'];
        echo json_encode($taxo_tableau[$cpt]);
    }
    die();
}
add_action( 'wp_ajax_sedoo_labtools_acf_populate_ctxlist', 'sedoo_labtools_acf_populate_ctxlist' );


//
// la fonction qui remplis le select term en fonction du ctx. 
// - je recupere le slug de la ctx envoyé depuis js
// - je butine dans toutes les taxo afin d'avoir une liste de toutes les ctx (a optimiser) et les met dans un tableau
// - je recupere dans ce tableau le rest_base (car il était différent du slug dans 0.8.2 de labtools, normalement corrigé en 0.8.3) de la ctx envoyé depuis le js 
// - je butine sur cette taxo et en recupere la liste des termes
// - je fais mon tableau de terme
// j'encode et j'envoie mon tableau
//
function sedoo_labtools_acf_populate_termlist() {
    if ( isset($_REQUEST) ) {
        $ctx = $_REQUEST['ctx'];
        $taxo_url = $_SESSION['siteurl'].'/wp-json/wp/v2/taxonomies';
        $termlistjson = file_get_contents($taxo_url);
        $terms = json_decode($termlistjson,true);  
        $cpt_rest_base = $_SESSION['link_slug_rest_base_sedoo_cpt_name'];
        $taxo_api_name = $terms[$ctx]['rest_base'];
        $taxo_selectionnee_url = $taxo_url = $_SESSION['siteurl'].'/wp-json/wp/v2/'.$taxo_api_name;
        $term_list = file_get_contents($taxo_selectionnee_url);
        $term_list = json_decode($term_list,true); 
        foreach($term_list as $term_ctx) {
            $tableau_term[$term_ctx['id']] = $term_ctx['name'];
        }
        echo json_encode($tableau_term);
    }

    die();
}
add_action( 'wp_ajax_sedoo_labtools_acf_populate_termlist', 'sedoo_labtools_acf_populate_termlist' );



/////////////
/////  TO DO
/////////////

///
// Edition du block en mode normal
//  - Bug à l'édition (obligé de delete et remettre le bloc car les infos ne sont pas changées, et ne sont pas chargées car non existantes dans les select surement)
//  - Afficher le nom des taxo et non le slug
// 
// Ajout du block
//  - Lenteur à l'ajout car il doit charger les sites, possibilité d'accelerer le process ? (problème apparu après l'ajout du champs titre)
//
// Affichage liste
//  - Retour à la ligne
//  Affichage image grille
// - Image par défaut