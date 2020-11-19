<?php 

// Create id attribute allowing for custom "anchor" value.
$id = 'sedoo_listecpt-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sedoo_blocks_listecpt';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$post_Type = get_field('type_de_contenu_a_lister');
$type_filtre = get_field('type_de_filtres');


if($type_filtre == true) {
    $taxonomie = 'cestag';
    $term = get_field('sedoo_listecpt_tags_liste');
} else {
    $taxonomie = 'category';
    $term = get_field('sedoo_listecpt_categories_liste');
}

$limit = -1;
if(get_field('sedoo_listecpt_limit')) {
    $limit = get_field('sedoo_listecpt_limit');
}
$display = get_field('sedoo_listecpt_mode_daffichage');

?>

<section class="post-wrapper <?php echo $className; ?>">
    <?php
        $args = array(
            'post_type'             => $post_Type,
            'post_status'           => array( 'publish' ),
            'posts_per_page'        => $limit, 
            'tax_query'             => array(
                                array(
                                    'taxonomy' => $taxonomie,
                                    'field'    => 'slug',
                                    'terms'    => $term,
                                ),
                            ),
        );

        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            if($display == 'minilist') {
                echo '<ul>';
            }
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                echo sedoo_listcpt_display_items($display);
            }
            if($display == 'minilist') {
                echo '</ul>';
            }
        wp_reset_postdata();
        }
    ?>
</section>