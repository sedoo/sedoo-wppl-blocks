<?php


function sedoo_blocks_listearticle_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

	$templateURL = plugin_dir_path(__FILE__) . "template-parts/blocks/listearticle/listearticle.php";
    // include a template part from within the "template-parts/block" folder
    
	if( file_exists( $templateURL)) {
		include $templateURL;
    }
}



function sedoo_listeposte_display($title, $term, $layout, $limit, $offset, $buttonLabel, $button) {
    global $post;
    
    $argsListPost = array(
        'posts_per_page'   => $limit,
        'offset'           => $offset,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true 
    );

    if ($term !== "all") {
        $argsListPost['tax_query'] = array(
                        array(
                            "taxonomy" => "category",
                            "field"    => "slug",
                            "terms"    => $term,
                        )
                        );
        $url = get_term_link($term, 'category');
        } else {
        $url = get_permalink( get_option( 'page_for_posts' ) );
        }

    switch ($layout) {
        case "grid" :
            $listingClass = "post-wrapper";
            break;

        case "grid-noimage" :
            $listingClass = "post-wrapper noimage";
            break;

        default:
            $listingClass = "content-list";
    }    

    $postsList = get_posts ($argsListPost);
    
    if ($postsList){       
    ?>
    <h2><?php echo __($title, 'sedoo-wpth-labs') ?></h2>
    <section role="listNews" class="<?php echo $listingClass;?>">
        
        <?php
        foreach ($postsList as $post) :
         // setup_postdata( $post );
            ?>
            <?php
     			include('template-parts/content-'.$layout.'.php');
            ?>
            <?php
        endforeach;
        ?>	
    </section>
    <?php if ($button == 1) { ?>    
        <div class="wp-block-button aligncenter">
            <a href="<?php echo $url; ?>" class="wp-block-button__link btn"><?php echo $buttonLabel; ?></a>
        </div>
    <?php
        }
    ?>
    
    <?php 
    the_posts_navigation();
    wp_reset_postdata();
    }
}