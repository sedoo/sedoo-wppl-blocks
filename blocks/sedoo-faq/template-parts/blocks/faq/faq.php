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
        <section id="<?php echo $question->ID;?>_section" class="intranet-tile-faq faq_<?php echo $question->ID;?>" >

                <div class="accordion"  onclick="JouerSon()">

                    <span class="plusIcon">+</span>

                    <!--<span class="toggleButton">
                        <span>+</span>
                    </span>-->
                    <span class="arrowButton material-icons"">
                    arrow_circle_up
                    </span>

                    <h2 id="<?php echo $question->ID;?>Tab"><?php echo $question->post_title;?></h2>
                 

                </div>
                <article class="panel">

                    <p><?php echo $question->post_content; ?></p>

                    <a class="bouton" href="<?php echo get_permalink($question->ID); ?>">En savoir plus</a>

                </article>
        </section>
    <?php 
    }
    ?>
</nav>
<audio autoplay="false" id="beep" src="http://localhost/INTRANET/wp-content/plugins/sedoo-wppl-blocks/blocks/sedoo-faq/sound/191238-Modular_UI_-Confirm_ToneFM-063.mp3">
<audio autoplay="false" id="beep2" src="http://localhost/INTRANET/wp-content/plugins/sedoo-wppl-blocks/blocks/sedoo-faq/sound/mixkit-retro-game-notification-212.mp3">

<script>
    function JouerSon() {
            var sound = document.getElementById("beep");
            var sound2 = document.getElementById("beep2");
            const divActiv = document.querySelector(".accordion");
            if (divActiv.classList.contains('activeFaq')) {
                sound2.play();
               
            }else{
                sound.play();
            }
            
        }
</script>
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
