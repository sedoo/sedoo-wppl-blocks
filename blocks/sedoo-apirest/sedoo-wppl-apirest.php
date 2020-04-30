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
        $content_site_list[''] = 'Selectionner un site';
        $content_site_list[$site->blog_id] = get_blog_details($site->blog_id)->blogname;
    }

    $field['choices'] = $content_site_list;
    return $field;
}
add_filter('acf/load_field/name=site_a_recuperer', 'sedoo_labtools_acf_populate_sitelist');


// j'enregistre une variable dans la session car je me suis rendu compte qu'il me la fallait une fois que j'avais fini tout le merdi..
session_start();

function startsWith($string, $startString) { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

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
            // je check si c'est un cpt sedoo
            if(startsWith($cpt['slug'], "sedoo")) {
                $tableau_cpt[$cpt['rest_base']] = $cpt['name'];
                // j'enregistre un tableau des taxonomies par cpt pour l'utiliser sur le prochain select
                $tableau_ctx_par_cpt[$cpt['rest_base']] = $cpt['taxonomies'];    
            }
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
        $tableau_xtx_name_restbase;
        // je vais recuperer le name de chaque taxo plutot que le restbase
        foreach($taxo_tableau[$cpt] as $cpt_rest_base) {
                $taxo_url_for_name = $_SESSION['siteurl'].'/wp-json/wp/v2/taxonomies/'.$cpt_rest_base;
                $json_for_taxo_name = file_get_contents($taxo_url_for_name);
                $json_for_taxo_name = json_decode($json_for_taxo_name,true);  
                $tableau_xtx_name_restbase[$json_for_taxo_name['name']] = $cpt_rest_base;
        }

        echo json_encode($tableau_xtx_name_restbase);
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
        $cpt = $_REQUEST['cpt'];
        $taxo_url = $_SESSION['siteurl'].'/wp-json/wp/v2/taxonomies';
        $termlistjson = file_get_contents($taxo_url);
        $terms = json_decode($termlistjson,true);  
        $cpt_rest_base = $_SESSION['link_slug_rest_base_sedoo_cpt_name'];
        $taxo_api_name = $terms[$ctx]['rest_base'];
        $taxo_selectionnee_url = $taxo_url = $_SESSION['siteurl'].'/wp-json/wp/v2/'.$taxo_api_name;

        $term_list = file_get_contents($taxo_selectionnee_url);
        $term_list = json_decode($term_list,true); 
        foreach($term_list as $term_ctx) {

            // on fait un truc propre : afficher le nombre de contenu correspondant à chaque terme (c'est possible donc on le fait)
            $url_decompte = $_SESSION['siteurl'].'/wp-json/wp/v2/'.$cpt.'?'.$taxo_api_name.'='.$term_ctx['id'];
            $decomptejson = file_get_contents($url_decompte);
            $tab_decompte = json_decode($decomptejson, true);
            $i = 0;
            foreach($tab_decompte as $t) { $i++; }            
            $tableau_term[$term_ctx['id']] = $term_ctx['name'].' ('.$i.')';
        }
        echo json_encode($tableau_term);
    }

    die();
}
add_action( 'wp_ajax_sedoo_labtools_acf_populate_termlist', 'sedoo_labtools_acf_populate_termlist' );



/////////////
/////  TO DO
/////////////

//////
//
//  Soucis uniquement d'affichage :
//      - quelque fois le champs Terme se remet sur 'selectionner un terme' mais garde en mémoire le champs et l'url de requete change bien
//
//  Améliorer le système d'exclusion peut etre ?
//
//  A l'édition les données ne sont pas chargée en mode pas à pas
//      - en temps réel après l'avoir posé ok
//      - a l'édition post création aussi mais on doit refaire tous les champs