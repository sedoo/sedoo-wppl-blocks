<?php

function sedoo_relatedcontents_scripts() {
    wp_register_style( 'sedoo_relatedcontents', plugins_url('css/relatedcontents.css', __FILE__) );
    wp_enqueue_style( 'sedoo_relatedcontents' );
}
add_action('wp_enqueue_scripts','sedoo_relatedcontents_scripts');


function enqueue_search_script_relatedjs() {
    // le fichier js qui contient les fonctions tirgger au change des select
    $scrpt_search = plugins_url('js/relatedcontent.js', __FILE__);
    wp_enqueue_script('sedoo_related', $scrpt_search,  array ( 'jquery' ));                    
}
add_action( 'wp_head', 'enqueue_search_script_relatedjs' );


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
            'public'   => true
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
    add_action('wp_ajax_nopriv_sedoo_labtools_get_associate_content_arguments_ajax', 'sedoo_labtools_get_associate_content_arguments_ajax');
    add_action('wp_ajax_sedoo_labtools_get_associate_content_arguments_ajax', 'sedoo_labtools_get_associate_content_arguments_ajax');
    function sedoo_labtools_get_associate_content_arguments_ajax() {
        $cpt = $_POST['cpt'];
        $offset = $_POST['offset'];
        $orderby = $_POST['orderby'];
        $order = $_POST['order'];
        $taxo = $_POST['taxo'];
        $sm = $_POST['sm']; // show more
        $terms = explode(', ' , $_POST['terms']);
        $post_number = $_POST['post_number'];
        $layout = $_POST['layout'];
        $args = array(
            'post_type'             => $cpt,
            'post_status'           => array( 'publish' ),
            'posts_per_page'        => $post_number,            // -1 no limit
            'orderby'               => $orderby,
            'order'                 => $order,
            'offset'                => $offset,
            'tax_query'             => array(
                                    array(
                                        'taxonomy' => $taxo,
                                        'field'    => 'slug',
                                        'terms'    => $terms,
                                    ),
                                ),
            );

            $the_query = new WP_Query( $args );
            // The Loop
            if ( $the_query->have_posts() ) {
                $offset_for_js = $offset;
                ?>
                <?php
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    include('template-parts/content-sedoo-cpt.php');
                    $offset_for_js++;
                }
               
                /* Restore original Post Data */
                wp_reset_postdata();
              
                if($sm == 1) { // show more
                    $sm_text = $_POST['sm_text'];
                    $sm_taxo = $args['tax_query'][0]['taxonomy'];
                    $sm_order = $args['order'];
                    $sm_post_number = $args['posts_per_page'];
                    $sm_order_by = $args['orderby'];
                    $sm_terms = implode(", ", $args['tax_query'][0]['terms']);
                    echo '<div class="wp-block-button aligncenter sedoo_load_more" id="show_more"><a class="wp-block-button__link" order="'.$sm_order.'" layout="'.$layout.'" cpt="'.$cpt.'" terms="'.$sm_terms.'" orderby="'.$sm_order_by.'"  post_number="'.$sm_post_number.'" taxo="'.$sm_taxo.'" offset="'.$offset_for_js.'" sm="'.$sm.'" smt="'.$sm_text.'" cpt="'.$type_of_content.'">'.$sm_text.'</a></div>';
                }
            } else {
                // no posts found
            }
            wp_die();
    }
    
    function sedoo_labtools_get_associate_content_arguments($title, $type_of_content, $taxonomy, $post_number, $post_offset, $layout, $className, $show_more, $show_more_text) {

        switch ($layout) {
            case "grid":
                $listingClass = "post-wrapper";
                break;
    
            case "grid-noimage":
                $listingClass = "post-wrapper noimage";
                break;
            
            case "list":
                $listingClass = "content-list";
                break;
            
            case "list-full":
                $listingClass = "content-list";
                break;
                 
            default:
                $listingClass = "post-wrapper";
        }

        $parameters = array(
        'sectionTitle'       => $title,
        'className'          => $className,
        'layout'             => $layout,
        'listingClass'       => $listingClass,
        );
        if (function_exists('pll_current_language')) {
            $args['lang']=pll_current_language();
        }

        if ($type_of_content== 'post') {
            $orderby = 'date';
            $order = 'DESC';
        } else {
            $orderby = 'title';
            $order = 'ASC';
        }

        $terms_fields=array();
        
        if (!is_archive()) {
            $args['post__not_in']=array(get_the_id()); //exclude current post if not archive template

            $categories_field = get_the_terms( get_the_id(), $taxonomy);  // get terms of taxonomy
            if (is_array($categories_field) || is_object($categories_field))
            {
            foreach ($categories_field as $term_slug) {        
                array_push($terms_fields, $term_slug->slug);
                }
            }
        } else {
            // If archive, get only term slug , not post ID! 
            $term = get_queried_object();
            array_push($terms_fields, $term->slug);
        }    

        $affichage_full_content = get_field('tout_afficher_en_une_page');
        $limite = get_field('sedoo_related_showmlimit');

        if ($post_number == 0 ) {
            $post_number = -1;
        } 
        if($affichage_full_content == 1 && $limite != 0 ) {
            $post_number = $limite;
        }
        $args = array(
        'post_type'             => $type_of_content,
        'post_status'           => array( 'publish' ),
        'posts_per_page'        => $post_number,            // -1 no limit
        'orderby'               => $orderby,
        'order'                 => $order,
        'tax_query'             => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field'    => 'slug',
                                    'terms'    => $terms_fields,
                                ),
                                ),
        );

        sedoo_labtools_get_associate_content($parameters, $args, $type_of_content, $show_more, $show_more_text, $post_offset);
    }
    
    function sedoo_labtools_get_associate_content($parameters, $args, $type_of_content, $show_more, $show_more_text, $post_offset) {

        $the_query = new WP_Query( $args );
        // The Loop
        if ( $the_query->have_posts() ) {
            echo '<h2>'.__( $parameters['sectionTitle'], 'sedoo-wppl-labtools' ).'</h2>';
            $offset_for_js = $post_offset;
            ?>
            <section role="listNews" class="sedoo-labtools-listCPT <?php echo $parameters['className'].' '; if ($type_of_content!=="post"){echo $type_of_content;}?> <?php echo $parameters['listingClass'];?>">

            <?php
            $layout = $parameters['layout'];
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $titleItem=mb_strimwidth(get_the_title(), 0, 65, '...');
                get_template_part('template-parts/content', 'sedoo-cpt');
                $offset_for_js++;
            }
            if($show_more == 1 && $the_query->max_num_pages > 1) {
                $sm_taxo = $args['tax_query'][0]['taxonomy'];
                $sm_order = $args['order'];
                $sm_post_number = $args['posts_per_page'];
                $sm_order_by = $args['orderby'];
                $sm_terms = implode(", ", $args['tax_query'][0]['terms']);
                echo '<div class="wp-block-button aligncenter sedoo_load_more" id="show_more"><a class="wp-block-button__link" order="'.$sm_order.'" layout="'.$layout.'" terms="'.$sm_terms.'" orderby="'.$sm_order_by.'"  post_number="'.$sm_post_number.'" taxo="'.$sm_taxo.'" offset="'.$offset_for_js.'" sm="'.$show_more.'" smt="'.$show_more_text.'" cpt="'.$type_of_content.'"> '.$show_more_text.'</a></div>';
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
