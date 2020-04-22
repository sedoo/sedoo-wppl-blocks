<?php

$mode_edition = get_field('mode_dedition');


// si le mode d'édition est  en mode avancé
if($mode_edition == true) {
    $url = get_field('url_de_recuperation');
} else {
    $site = get_field('site_a_recuperer');
    $site_url = get_blog_details($site);
    $cpt = get_field('contenus_a_recuperer');
    $ctx = get_field('taxonomie_a_recuperer');
    $term = get_field('term_a_recuperer');
    $url = $site_url->siteurl.'/wp-json/wp/v2/'.$cpt.'?'.$ctx.'='.$term;

        echo $url;
}

$json = file_get_contents($url);
$donnees = json_decode($json,true); 

$zonetitle = get_field('sedoo-apirest-block-list-title');
    
echo '<h2>'.__($zonetitle, 'sedoo-wpth-labs').'</h2>';
echo '<section role="listNews" class="post-wrapper sedoo-labtools-listCPT">'; 

foreach($donnees as $donnee) {
    $url = $donnee['link'];
    $title = $donnee['title']['rendered'];
    $urlJsonThumbnail = $donnee["_links"]['wp:featuredmedia'][0]['href'];


    $layout = get_field('sedoo-apirest-list-layout');
    if($layout == 'grid' || $layout == "grid-noimage"){
        ?>
        <a class="item-link" href="<?php echo $url; ?>" title="<?php echo $title; ?>"> 
            <?php if($layout == 'grid' ) { 
              recuperationmedia($urlJsonThumbnail);
            } ?>
            <h3><?php echo $title; ?></h3>
        </a>    
        <?php 
    } 
    elseif($layout == 'list') {
    ?>
        <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"> 
            <h3><?php echo $title; ?></h3>
        </a>   
    <?php 
    }
}
echo '</section>';