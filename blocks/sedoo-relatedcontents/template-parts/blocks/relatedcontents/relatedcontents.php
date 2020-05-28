<?php
$admin_or_not = $_COOKIE['related_Admin'];
if($admin_or_not == 1) {
    echo '<div class="sedoo_related_block_admin_block"><h2> Related content block </h2> <span> Edit to display settings </span></div>';
} else {
    ?>
    <script>
       var ajaxurl = "<?php  echo admin_url('admin-ajax.php'); ?>";
    </script>
    <?php 
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
    
    $show_more = get_field('sedoo_related_showmorecontent');
    $show_more_text = get_field('sedoo_related_showmorecontent_text');
    $layout = get_field('sedoo-relatedcontent-list-layout');
    // if( get_field('relatedContentTitle') ):
    sedoo_labtools_get_associate_content_arguments( get_field('relatedContentTitle'), get_field('relatedContentTypeOfContent'), get_field('relatedContentTaxonomies'), get_field('post_number'), get_field('post_offset'), $layout, $className, $show_more, $show_more_text );
        
    // endif;
}
?>