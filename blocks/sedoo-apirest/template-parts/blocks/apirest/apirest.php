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
    $cpt = get_field('contenus_a_recuperer');
    $ctx = get_field('taxonomie_a_recuperer');
    $term = get_field('term_a_recuperer');
    $url = get_field('site_a_recuperer').'/wp-json/wp/v2/'.$cpt.'?'.$ctx.'='.$term;
}

$affichagebouton = get_field('afficher_bouton_en_savoir_plus_');
$affichageextrait = get_field('afficher_lextrait_');
$exclusion = get_field('exclusion_de_contenu');
$layout = get_field('sedoo-apirest-list-layout');
$tableau_exclusion = explode(",", $exclusion);

echo '<section id="sedoo-blocks-apirest-content" role="listNews" class="post-wrapper sedoo-labtools-listCPT '.$className.'">';
echo '</section>';
?>


<script>
var url = <?php echo json_encode($url); ?>;
var tableau_exclusion = <?php echo json_encode($tableau_exclusion); ?>;
var layout = <?php echo json_encode($layout); ?>;
var affichagebouton = <?php echo json_encode($affichagebouton); ?>;
var affichageextrait = <?php echo json_encode($affichageextrait); ?>;

jQuery.ajax({
        url: url,
        dataType:'text', 
        success:function(donnees) {
            donnees = JSON.parse(donnees);
            var arrayLength = donnees.length;
            for (var i = 0; i < arrayLength; i++) {
                if(tableau_exclusion.includes(donnees[i].id.toString())) {} 
                else {
                    var url = donnees[i].link;
                    var title = donnees[i].title.rendered;
                    var extrait = '';
                    if(affichageextrait == true) {
                        extrait = donnees[i].excerpt.rendered;
                    }
                    var bouton = '';
                    if(affichagebouton == true) {
                        bouton =  '<a href="'+url+'">Lire plus →</a> ';
                    }
                    var urlJsonThumbnail = donnees[i]._links['wp:featuredmedia'][0].href;

                    if(layout == 'grid' ) {
                        jQuery.ajax({
                            url: urlJsonThumbnail,
                            async: false,
                            dataType:'text', 
                            success:function(donneesimg) {
                                var urlimage = JSON.parse(donneesimg).guid.rendered;
                                jQuery('#sedoo-blocks-apirest-content').append('<article class="post type-post"> \
                                    <a href="'+url+'"></a>\
                                    <header class="entry-header">\
                                       <img src="'+urlimage+'">\
                                    </header>\
                                    <div class="group-content"> \
                                        <h2>'+title+'</h2>\
                                        <div class="entry-content">'+extrait+'\
                                        </div> \
                                        <footer class="entry-footer">\
                                            '+bouton+'\
                                        </footer>\
                                    </div>\
                                </article><!-- #post-->');
                            }
                        });
                    }
                    if(layout == "grid-noimage") {
                        jQuery('#sedoo-blocks-apirest-content').append('<article class="post type-post"> \
                            <a href="'+url+'"></a>\
                            <div class="group-content"> \
                                <h2>'+title+'</h2>\
                                <div class="entry-content">'+extrait+'\
                                </div> \
                                <footer class="entry-footer">\
                                    '+bouton+'\
                                </footer>\
                            </div>\
                        </article><!-- #post-->');
                    }
                    if(layout == 'list') {
                        jQuery('#sedoo-blocks-apirest-content').append('<article>\
                            <header class="entry-header">\
                                <h2><a href="'+url+'">'+title+'</a></h2>\
                            </header><!-- .entry-header -->\
                            <div class="group-content"> \
                                <div class="entry-content">'+extrait+'\
                                </div> \
                                <footer class="entry-footer">\
                                   '+bouton+'\
                                </footer>\
                            </div>\
                        </article><!-- #post-->');
                    }
                }
            }
        }
});
</script>