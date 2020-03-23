<?php

$titre = get_field('sedoo_annuaire_titre');
$phrase = get_field('sedoo_annuaire_phrase');
$placeholder = get_field('sedoo_annuaire_placeholder');
$laboratoire = get_field('sedoo_annuaire_laboratoire');
$bouton = get_field('sedoo_annuaire_bouton');

?>

<section class="search-annuaire">
    <h2><?php echo $titre; ?></h2>
    <p><?php echo $phrase; ?></p>
    <form method="get" action="<?php echo get_site_url(); ?>/resultat-de-recherche-dans-lannuaire/">
        <label for="searchUser" class="screen-reader-text">Recherche dans l'annuaire</label>
        <input type="search" id="searchUser" placeholder="<?php echo $placeholder; ?>" name="searchUser">
        <input type="hidden" name="searchLabo" value="<?php echo strtoupper($laboratoire); ?>">
        <button type="submit"><?php echo $bouton; ?></button>
    </form>
</section>