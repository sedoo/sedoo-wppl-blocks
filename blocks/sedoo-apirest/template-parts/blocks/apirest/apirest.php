<?php

$url = get_field('url_de_recuperation');
$json = file_get_contents($url);
$donnees = json_decode($json,true);
$zonetitle = get_field('apiresttitle');

echo '<h2>'.$zonetitle.'</h2>';
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