<?php 

// Create id attribute allowing for custom "anchor" value.
$id = 'sedoo_listearticle-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sedoo_blocks_listearticle';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$title = get_field( 'sedoo-block-post-list-title');
$term = get_field( 'sedoo-block-post-list-categories' );
if (empty($term)) {
    $term = "all";
} else {
    $term = $term->slug;
}
$tags = get_field( 'sedoo-block-post-list-tags' );
if (empty($tags)) {
    $tags = "all";
} else {
    $tags = $tags->slug;
}
$layout = get_field( 'sedoo-block-post-list-layout' );
$limit = get_field( 'sedoo-block-post-list-limit' );
$offset = get_field( 'sedoo-block-post-list-offset' );
$buttonLabel = get_field( 'sedoo-block-post-list-showmore-button-label' );
$button = get_field( 'sedoo-block-post-list-showmore-button' );


if (empty($buttonLabel)) {
    $buttonLabel = "More";
}

$filter = get_field('sedoo-block-post-list-showterms-button');
if(empty($filter)) {
    $filter = 'category';
}
$terms = get_field('sedoo-block-post-list-showterms-button');
// SHOW POST LIST
sedoo_listeposte_display($title, $term, $layout, $limit, $offset, $buttonLabel, $button, $className, $terms, $tags, $filter);

?>