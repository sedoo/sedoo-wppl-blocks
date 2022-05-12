<?php 

// Create id attribute allowing for custom "anchor" value.
$id = 'sedoo_listepages-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sedoo_blocks_listepages';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$pages_a_afficher = get_field('pages_a_inserer');
$afficher_enfants = get_field('ajouter_toutes_les_pages_enfants_');
$layout = get_field('sedoo-block-pages-list-layout');
$order = get_field('sedoo-block-pages-list-order');
$orderby = get_field('sedoo-block-pages-list-orderby');
?>

<section class="post-wrapper <?php echo $className; ?>">
<?php 
if(!empty($pages_a_afficher)) {
    $args = array(
        'post_type'      => 'page',
        'post__in'       => $pages_a_afficher,
        'orderby'        => 'post__in'
    );
    
    $displayed = new WP_Query( $args );

    if ( $displayed->have_posts() ) :
        while ( $displayed->have_posts() ) : $displayed->the_post();
            sedoo_listpages_display_items($layout);
        endwhile;
    endif; 
    wp_reset_postdata();
}

if($afficher_enfants == true) {
  
    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => get_the_ID(),
        'order'          => $order,
        'orderby'        => $orderby
    );


    $parent = new WP_Query( $args );

    if ( $parent->have_posts() ) :
        while ( $parent->have_posts() ) : $parent->the_post();
            sedoo_listpages_display_items($layout);
        endwhile;
    endif; 
    wp_reset_postdata();
}
?>
</section>