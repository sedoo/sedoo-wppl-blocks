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

switch (get_field('type_de_filtre')) {
    case 'cestag':
            $term = get_field( 'sedoo-block-post-list-tags' );
        break;
    case 'post_tag':  
        $term = get_field( 'sedoo-block-post-list-posttags' );
        break;
    case 'category':
        $term = get_field( 'sedoo-block-post-list-categories' );
        break;
}

if (empty($term)) {
    $term = "all";
} else {
    $term = $term->slug;
}

$filter = get_field('type_de_filtre');
$layout = get_field( 'sedoo-block-post-list-layout' );
$limit = get_field( 'sedoo-block-post-list-limit' );
$offset = get_field( 'sedoo-block-post-list-offset' );
$buttonLabel = get_field( 'sedoo-block-post-list-showmore-button-label' );
$button = get_field( 'sedoo-block-post-list-showmore-button' );


if (empty($buttonLabel)) {
    $buttonLabel = "More";
}

$terms = get_field('sedoo-block-post-list-showterms-button');
// Display POST LIST
sedoo_list_post_display($title, $term, $layout, $limit, $offset, $buttonLabel, $button, $className, $terms, $filter);

?>