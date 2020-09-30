<?php


function sedoo_blocks_listecpt_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	$templateURL = plugin_dir_path(__FILE__) . "template-parts/blocks/listecpt/listecpt.php";
    // include a template part from within the "template-parts/block" folder
    
	if( file_exists( $templateURL)) {
		include $templateURL;
    }
}

function sedoo_listcpt_display_items($layout) {
    switch ($layout) {
        case 'grid':
            include plugin_dir_path(__FILE__) ."../../template-parts/content-grid.php";
            break;
        case 'grid-noimage':
            include plugin_dir_path(__FILE__) ."../../template-parts/content-grid-noimage.php";
            break;
        case 'list':
            include plugin_dir_path(__FILE__) ."../../template-parts/content-list.php";
        break;
        default:
            break;
    }
}



////////////////////
// LOAD ALL POST TYPE FOR THE FIRST FIELD
//////////////
function sedoo_listecpt_blocks_acf_populate_cptlist($field) {
    $get_cpt_args = array(
        'public'   => true
    );
    $post_types = get_post_types( $get_cpt_args, 'object' ); // use 'names' if you want to get only name of the post type.

    $cpt_list[''] = 'Selectionner un type de contenu';
    // do something with array
    if ( $post_types ) {
        foreach ( $post_types as $post_type) {
            $cpt_list[$post_type->name] = $post_type->label;
        }
    }

    $field['choices'] = $cpt_list;
    return $field;
}
add_filter('acf/load_field/name=type_de_contenu_a_lister', 'sedoo_listecpt_blocks_acf_populate_cptlist');
////////////////////
////////////////////


function sedoo_listecpt_prefill_tags($field) {
    var_dump($field);
}
add_filter('acf/load_field/name=sedoo_listecpt_tags_liste', 'sedoo_listecpt_prefill_tags');



////////////////////
// LOAD ALL CATEGORIES TERM FOR THE SELECTED POST TYPE
//////////////
add_action( 'wp_ajax_nopriv_sedoo_listecpt_blocks_acf_populate_categorieslist', 'sedoo_listecpt_blocks_acf_populate_categorieslist' );
add_action( 'wp_ajax_sedoo_listecpt_blocks_acf_populate_categorieslist', 'sedoo_listecpt_blocks_acf_populate_categorieslist' );

function sedoo_listecpt_blocks_acf_populate_categorieslist() {
    $cpt = $_POST['post_type'];
    $term_categories = get_categories('taxonomy=category&type='+$cpt+'');
    $tableau_term_categories;
    
    foreach($term_categories as $term) {
       $tableau_term_categories[$term->slug] = $term->name;
    }
    echo json_encode($tableau_term_categories);
    wp_die();
}
////////////////////
////////////////////



////////////////////
// LOAD ALL TAGS TERM FOR THE SELECTED POST TYPE
//////////////
add_action( 'wp_ajax_nopriv_sedoo_listecpt_blocks_acf_populate_tagslist', 'sedoo_listecpt_blocks_acf_populate_tagslist' );
add_action( 'wp_ajax_sedoo_listecpt_blocks_acf_populate_tagslist', 'sedoo_listecpt_blocks_acf_populate_tagslist' );

function sedoo_listecpt_blocks_acf_populate_tagslist() {
    $cpt = $_POST['post_type'];
    $term_tags = get_tags(array(
        'hide_empty' => 'false'
      ));
    $tableau_term_tags;
   
    foreach($term_tags as $term) {
       $tableau_term_tags[$term->slug] = $term->name;
    }
    echo json_encode($tableau_term_tags);
    wp_die();
}
////////////////////
////////////////////