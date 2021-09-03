<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'sedoo_faq-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sedoo_blocks_faq';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$categorie = get_field('faq_categories');
$nombre = get_field('faq_nombre');

// si pas de categories
if($categorie == false) {
    $tax_query = '';
} else {
    $categories = $categorie;
    $tax_query = array(
        'taxonomy' => 'sedoo_faq_categorie',
        'field' => 'id',
        'terms' => $categories
    );
}

if($nombre == 0) {
    $nombre = -1;
}

$questions = get_posts(array(
    'post_type' => 'faq',
    'orderby' => 'title',
    'order'          => 'ASC',
    'numberposts' => $nombre,
    'tax_query' => array( $tax_query
    )
));
?>

<nav class="faq-tabs <?php echo $className; ?>" role="tablist">
    <?php 
    foreach($questions as $question) {
    ?>
        <section id="<?php echo $question->ID;?>_section">
            <input type="radio" name="tabs" class="input_<?php echo $question->ID;?>" id="<?php echo $question->ID;?>" />
            <label data_q="<?php echo $question->ID;?>" for="<?php echo $question->ID;?>" id="<?php echo $question->ID;?>Tab" role="tab" aria-controls="<?php echo $question->ID;?>panel"><span class="dashicons dashicons-arrow-right-alt2"></span><?php echo $question->post_title;?></label>
            <article id="<?php echo $question->ID;?>panel" role="tabpanel" aria-labelledby="<?php echo $question->ID;?>Tab">
                <p><?php echo $question->post_content; ?></p>
            </article>
        </section>
    <?php 
    }
    ?>
</nav>
<script>

jQuery('.sedoo_blocks_faq label').click(function() {
    var faq_id = jQuery(this).attr('data_q');
    if(jQuery( "#"+faq_id+"panel" ).css('display') !== 'none') {
        jQuery( "#"+faq_id+"panel" ).hide();
        jQuery( this).children('span').css('transform', 'rotate(0deg)');
    } else {
        jQuery( "#"+faq_id+"panel" ).show();
        jQuery( this).children('span').css('transform', 'rotate(90deg)');
    }
});
</script>
