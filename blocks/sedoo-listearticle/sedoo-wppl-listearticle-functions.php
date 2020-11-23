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



function sedoo_listeposte_display($title, $term, $layout, $limit, $offset, $buttonLabel, $button, $className, $term_displayed, $tag) {
    global $post;
    if ($limit == 0) {
        $limit = -1;
    }
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
    if ($tag !== "all") {
        $argsListPost['tax_query'][] =
            array(
                "taxonomy" => "post_tag",
                "field"    => "slug",
                "terms"    => $tag,
        );
        $url = get_term_link($tag, 'post_tag');
    } else {
        $url = get_permalink( get_option( 'page_for_posts' ) );
    }

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

    $postsList = get_posts ($argsListPost);
    
    if ($postsList) {      
        if ($title !== "") {
        ?>
        <h2><?php echo __($title, 'sedoo-wpth-labs') ?></h2>
        <?php
        }
        ?>
        <section role="listNews" class="<?php echo $listingClass." ".$className;?>">
            <?php
            foreach ($postsList as $post) :
                ?>
                <?php
                    setup_postdata( $post );
                    include plugin_dir_path(__FILE__) ."../../template-parts/content-".$layout.".php";
                    // get_template_part('template-parts/content', $layout);
                    wp_reset_postdata();
                ?>
                <?php
            endforeach;
            ?>	
        </section>
        <?php 
        if ($button == 1) { ?>    
            <div class="wp-block-button aligncenter">
                <a href="<?php echo $url; ?>" class="wp-block-button__link"><?php echo $buttonLabel; ?></a>
            </div>
        <?php
        }
    } 
    //the_posts_navigation();
    
}
