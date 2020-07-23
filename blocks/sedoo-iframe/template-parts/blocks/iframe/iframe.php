<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'sedoo_iframe-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sedoo_blocks_iframe';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$url = get_field('url');
$requete = get_field('requete');
$hauteur = get_field('hauteur');
$largeur = get_field('largeur');
$scrolling = get_field('scrolling');
$attributs = get_field('attributs_supplementaires');
$cont_class = get_field('classe_du_container');

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

echo '<div class="sedoo_iframe '.$cont_class.'"><iframe src="'. $url .'" width="'. $largeur .'%" height="'. $hauteur .'px" '.$attributsiframe.' frameborder="0" scrolling='.$scrollable_iframe.' class="'.$className.'"></iframe></div>';

?>