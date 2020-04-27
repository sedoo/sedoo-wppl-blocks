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
                </div><!-- .entry-content -->
                <footer class="entry-footer">
                    <a href="<?php echo $url; ?>"><?php echo __('Read more', 'sedoo-wpth-labs'); ?> →</a>
                </footer><!-- .entry-footer -->
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
                    <a href="<?php echo $url; ?>"><?php echo __('Read more', 'sedoo-wpth-labs'); ?> →</a>
                </div><!-- .entry-content -->
            </div>
        </article><!-- #post-->
    <?php 
    }
}
echo '</section>';