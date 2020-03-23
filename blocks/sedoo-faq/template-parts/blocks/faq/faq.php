<?php

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
    'numberposts' => $nombre,
    'tax_query' => array( $tax_query
    )
));
?>

<nav class="faq-tabs" role="tablist">
    <?php 
    foreach($questions as $question) {
    ?>
        <section id="<?php echo $question->ID;?>_section">
            <input type="radio" name="tabs" id="<?php echo $question->ID;?>" />
            <label for="<?php echo $question->ID;?>" id="<?php echo $question->ID;?>Tab" role="tab" aria-controls="<?php echo $question->ID;?>panel"><span class="dashicons dashicons-arrow-right-alt2"></span><?php echo $question->post_title;?></label>
            <article id="<?php echo $question->ID;?>panel" role="tabpanel" aria-labelledby="<?php echo $question->ID;?>Tab">
                <?php echo $question->post_content; ?>
            </article>
        </section>
    <?php 
    }
    ?>
</nav>