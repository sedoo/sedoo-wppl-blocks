<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'sedoo_blocks_apirest-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sedoo_blocks_apirest';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

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
}

$json = file_get_contents($url);
$donnees = json_decode($json,true);
$api_rest_title = get_field('sedoo-apirest-block-list-title');
$affichagebouton = get_field('afficher_bouton_en_savoir_plus_');
$affichageextrait = get_field('afficher_lextrait_');


$exclusion = get_field('exclusion_de_contenu');
$tableau_exclusion = explode(",", $exclusion);
    
if($api_rest_title != '') {
    echo '<h2 class="'.$className.'">'.__($api_rest_title, 'sedoo-wpth-labs').'</h2>';
}
echo '<section role="listNews" class="post-wrapper sedoo-labtools-listCPT '.$className.'">';
foreach($donnees as $donnee) {

    // si la donnée est dans la liste d'exclusion
    if(!in_array($donnee['id'], $tableau_exclusion)) {
        $url = $donnee['link'];
        $title = $donnee['title']['rendered'];
        $extrait = $donnee['excerpt']['rendered'];
        $urlJsonThumbnail = $donnee["_links"]['wp:featuredmedia'][0]['href'];

        $layout = get_field('sedoo-apirest-list-layout');
        
        ?>
        <?php 
        if($layout == 'grid' || $layout == "grid-noimage"){
            ?>
            <article class="post type-post">
                <a href="<?php echo $url; ?>"></a>
                <header class="entry-header">
                    <figure>
                    <?php if($layout == 'grid' ) { 
                        recuperationmedia($urlJsonThumbnail);
                        } 
                    ?>          
                    </figure>
                </header><!-- .entry-header -->
                <div class="group-content">
                    <div class="entry-content">
                        <h2><?php echo $title; ?></h2>
                        <?php 
                        if($affichageextrait == true) {
                            echo $extrait;
                        }
                        ?>
                    </div><!-- .entry-content -->
                    <?php 
                    if($affichagebouton == true) {
                    ?>
                    <footer class="entry-footer">
                        <a href="<?php echo $url; ?>"><?php echo __('Read more', 'sedoo-wpth-labs'); ?> →</a>
                    </footer><!-- .entry-footer -->
                    <?php 
                    }
                    ?>
                </div>
            </article><!-- #post-->
            <?php 
        } 
        elseif($layout == 'list') {
        ?>
            <article <?php post_class(); ?>>
                <header class="entry-header">
                    <?php     
                    // $categories = get_the_category();
                    // if ( ! empty( $categories ) ) {
                    // echo esc_html( $categories[0]->name );   
                    // }; 
                    ?>
                    <h2><a href="<?php echo $url; ?>"><?php echo $title; ?></a></h2>
                </header><!-- .entry-header -->
                <div class="group-content"> 
                    <div class="entry-content">
                        <?php 
                        if($affichageextrait == true) {
                            echo $extrait;
                        }
                        ?>
                    </div>
                    <?php 
                    if($affichagebouton == true) {
                    ?>
                    <footer class="entry-footer">
                        <a href="<?php echo $url; ?>"><?php echo __('Read more', 'sedoo-wpth-labs'); ?> →</a>
                    </footer><!-- .entry-footer -->
                    <?php 
                    }
                    ?>
                </div>
            </article><!-- #post-->
        <?php 
        }
    }
}
echo '</section>';