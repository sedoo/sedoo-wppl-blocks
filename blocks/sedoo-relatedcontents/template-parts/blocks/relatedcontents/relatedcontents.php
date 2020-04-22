<?php

if(is_admin()) {
    echo '<div class="sedoo_related_block_admin_block"><h2> Related content block </h2> <span> Edit to display settings </span></div>';
} else {
    // Create id attribute allowing for custom "anchor" value.
    $id = 'sedoo_relatedcontents-' . $block['id'];
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'sedoo_blocks_relatedcontents';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }
    if( !empty($block['align']) ) {
        $className .= ' align' . $block['align'];
    }
    
    // if( get_field('relatedContentTitle') ):
    sedoo_labtools_get_associate_content_arguments( get_field('relatedContentTitle'), get_field('relatedContentTypeOfContent'), get_field('relatedContentTaxonomies'), get_field('post_number'), get_field('post_offset'), $className );
        
    // endif;
}
?>