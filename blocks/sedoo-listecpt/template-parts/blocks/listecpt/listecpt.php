<?php 

            // Create id attribute allowing for custom "anchor" value.
            $id = 'sedoo_listecpt-' . $block['id'];
            if( !empty($block['anchor']) ) {
                $id = $block['anchor'];
            }
            
            // Create class attribute allowing for custom "className" and "align" values.
            $className = 'sedoo_blocks_listecpt';
            if( !empty($block['className']) ) {
                $className .= ' ' . $block['className'];
            }
            if( !empty($block['align']) ) {
                $className .= ' align' . $block['align'];
            }
            
            $post_Type = get_field('type_de_contenu_a_lister');
            $type_filtre = get_field('type_de_filtres');
            
            
            if($type_filtre == true) {
                $taxonomie = 'cestag';
                $term = get_field('sedoo_listecpt_tags_liste');
            } else {
                $taxonomie = 'category';
                $term = get_field('sedoo_listecpt_categories_liste');
            }
            
            // $limit = 6;
            if(get_field('sedoo_listecpt_limit')) {
                $limit = get_field('sedoo_listecpt_limit');
            }
            $layout = get_field('sedoo_listecpt_mode_daffichage');
            
            if($term != NULL) {
                $tax_query = array(
                    array(
                        'taxonomy' => $taxonomie,
                        'field'    => 'slug',
                        'terms'    => $term,
                    ));
            } else {
                $tax_query = '';
            }
            
            ?>
            
            <section class="post-wrapper <?php echo $className; ?>">
                <?php
                if($post_Type == 'tribe_events') {
                    $args = array(
                        'post_type'             => $post_Type,
                        'post_status'           => array( 'publish' ),
                        'posts_per_page'        => $limit, 
                        'meta_query' => array( 
                            array(
                                'key' => '_EventEndDate', 
                                'value' => date("Y-m-d"), 
                                'compare' => '>=', 
                                'type' => 'NUMERIC,' 
                            )
                        ),
                        'orderby' =>'meta_value',
                        'meta_key' => '_EventStartDate',
                        'order'=> 'ASC',
                        'tax_query'             => $tax_query
                    );
                } else {
                    $args = array(
                        'post_type'             => $post_Type,
                        'post_status'           => array( 'publish' ),
                        'posts_per_page'        => $limit, 
                        'tax_query'             => $tax_query
                    );
                }
            
                    $the_query = new WP_Query( $args );
                    if ( $the_query->have_posts() ) {
                        if($layout == 'minilist') {
                            echo '<ul>';
                        }
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            sedoo_layout_display_items($layout, $term);
                        }
                        if($layout == 'minilist') {
                            echo '</ul>';
                        }
                    wp_reset_postdata();
                    }
                ?>
            </section>