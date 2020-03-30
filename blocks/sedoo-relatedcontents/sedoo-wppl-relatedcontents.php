<?php

function sedoo_relatedcontents_scripts() {
    wp_register_style( 'sedoo_relatedcontents', plugins_url('css/relatedcontents.css', __FILE__) );
    wp_enqueue_style( 'sedoo_relatedcontents' );
}
add_action('wp_enqueue_scripts','sedoo_relatedcontents_scripts');


if(!function_exists('sedoo_labtools_acf_populate_post_type')) {
    function sedoo_labtools_acf_populate_post_type($field) {
        
        $content_type_list = [];

        $args = array(
            // 'name' => array('sedoo-platform', 'sedoo-research-team'),
            // 'labels' => array('Research team', 'Platform'),
            'public'   => true,
            '_builtin' => true
        );
        $output = 'object'; // names or objects, note names is the default
        $operator = 'or'; // 'and' or 'or'
        
        $post_types = get_post_types( $args, $output, $operator );    
        foreach ( $post_types as $post_type ) {        
            // array_push($content_type_list, $post_type->label);
            $content_type_list[$post_type->name] = $post_type->label;
        }    
        
        $field['choices'] = $content_type_list;
        return $field;
    }
    add_filter('acf/load_field/name=relatedContentTypeOfContent', 'sedoo_labtools_acf_populate_post_type');

    function sedoo_labtools_acf_populate_taxonomies($field) {
        
        $taxonomies_list = [];

        $args = array(
            // 'name' => array('sedoo-platform', 'sedoo-research-team'),
            // 'labels' => array('Research team', 'Platform'),
            'public'   => true,
            '_builtin' => false
        );
        $output = 'object'; // names or objects, note names is the default
        $operator = 'and'; // 'and' or 'or'
        
        $taxonomies = get_taxonomies( $args, $output, $operator ); 
        // $taxonomies = get_taxonomies();
        foreach ( $taxonomies as $taxonomy ) {
            $taxonomies_list[$taxonomy->name] = $taxonomy->label;
        } 
        
        $field['choices'] = $taxonomies_list;
        return $field;
    }
    add_filter('acf/load_field/name=relatedContentTaxonomies', 'sedoo_labtools_acf_populate_taxonomies');
    // if (get_field_object('labstools_choose_taxonomy')){
    add_filter('acf/load_field/name=labstools_choose_taxonomy', 'sedoo_labtools_acf_populate_taxonomies');
}

if(!function_exists('sedoo_labtools_get_associate_content_arguments')) {
    function sedoo_labtools_get_associate_content_arguments($title, $type_of_content, $taxonomy, $post_number, $post_offset) {
        $categories_field = get_the_terms( get_the_id(), $taxonomy);  // recup des terms de la taxonomie $parameters['category']
        $terms_fields=array();
        if (is_array($categories_field) || is_object($categories_field))
        {
            foreach ($categories_field as $term_slug) {        
                array_push($terms_fields, $term_slug->slug);
            }
        }
        $parameters = array(
        'sectionTitle'    => $title,
        );
        if (function_exists('pll_current_language')) {
            $lang = pll_current_language();
        } else {
            $lang = 'fr';
        }

        if ($type_of_content== 'post') {
            $orderby = 'date';
            $order = 'DESC';
        } else {
            $orderby = 'title';
            $order = 'ASC';
        }

        $args = array(
        'post_type'             => $type_of_content,
        'post_status'           => array( 'publish' ),
        'posts_per_page'        => $post_number,            // -1 no limit
        'orderby'               => $orderby,
       // 'lang'			        => $lang,
        'order'                 => $order,
        'tax_query'             => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'slug',
                                    'terms'    => $terms_fields,
                                ),
                                ),
        );
        //exclude current post if not archive template
        if (!is_archive()) {
            $args['post__not_in']=array(get_the_id());
        }

        sedoo_labtools_get_associate_content($parameters, $args, $type_of_content);
    }
    function sedoo_labtools_get_associate_content($parameters, $args, $type_of_content) {
        $the_query = new WP_Query( $args );
        // The Loop
        if ( $the_query->have_posts() ) {
            echo '<h2>'.__( $parameters['sectionTitle'], 'sedoo-wppl-labtools' ).'</h2>';
            echo '<section role="listNews" class="post-wrapper sedoo-labtools-listCPT">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();

                $titleItem=mb_strimwidth(get_the_title(), 0, 65, '...');
                if (get_post_type()== "post") {
                    get_template_part( 'template-parts/content', get_post_type() );
                } else {
                include('template-parts/content-sedoo-cpt.php');
                }
            }
            echo '</section>';
            /* Restore original Post Data */
            wp_reset_postdata();
        } else {
            // no posts found
        }
    }
}

/**
 * Show related content
 * 
 */

include 'sedoo-wppl-relatedcontents-functions.php';
include 'sedoo-wppl-relatedcontents-acf.php';
include 'inc/sedoo-wppl-relatedcontents-acf-fields.php';
