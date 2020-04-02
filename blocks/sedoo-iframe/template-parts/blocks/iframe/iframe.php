<?php

$url = get_field('url');
$requete = get_field('requete');
$hauteur = get_field('hauteur');
$largeur = get_field('largeur');
$scrolling = get_field('scrolling');
$attributs = get_field('attributs_supplementaires');

if($requete != NULL && $requete != "") {
    $url = $url.'?'.$requete;
}

// get GET parameters in url 
if (isset($_SERVER['QUERY_STRING']) && ($_SERVER['QUERY_STRING']!=="")) {
    if($requete != NULL && $requete != "") {
        $url .='&'.$_SERVER['QUERY_STRING'];
    } else {
        $url =$url.'?'.$_SERVER['QUERY_STRING'];
    }   
}

if($scrolling == false) {
    $scrollable_iframe = 'no';
} else {
    $scrollable_iframe = 'yes';
}

if($attributs != NULL && $attributs != "") {
    $attributsiframe = $attributs;
}

echo '<iframe src="'. $url .'" width="'. $largeur .'%" height="'. $hauteur .'px" '.$attributsiframe.' frameborder="0" scrolling='.$scrollable_iframe.'></iframe>';

?>