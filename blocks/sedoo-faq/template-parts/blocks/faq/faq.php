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
    'tax_query' => array( $tax_query),
    )); 
?>

<nav class="faq-tabs <?php echo $className; ?>" role="tablist">
    <?php 
    foreach($questions as $question) {
    ?>
        <section id="<?php echo $question->ID;?>_section" class="faq<?php echo $question->ID;?>" >

                <div id="<?php echo $question->ID;?>Tab" class="accordion" role="tab" aria-controls="<?php echo $question->ID;?>panel">

                    <span class="arrowButton material-icons">arrow_circle_up</span>

                    <h3 id="<?php echo $question->ID;?>Tab"><?php echo $question->post_title;?></h3>
                 

                </div>
                <article class="panel" id="<?php echo $question->ID;?>panel" role="tabpanel" aria-labelledby="<?php echo $question->ID;?>Tab">
                    <?php echo $question->post_content; ?>
                </article>
        </section>
    <?php 
    }
    ?>
</nav>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("activeFaq");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

</script>
