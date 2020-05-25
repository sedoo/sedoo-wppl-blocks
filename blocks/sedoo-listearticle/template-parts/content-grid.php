<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
$postType=get_post_type();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>"></a>
	<header class="entry-header">
        <?php 
        // if (isset($postThumbnail)){ echo $postThumbnail; }
        ?>
        <figure>
        <?php 
            if (has_post_thumbnail()) {
                the_post_thumbnail('thumbnail-loop');
            } else {
                if (labs_by_sedoo_catch_that_image() ==  "no_image" ){
                   ?>
                   <img src="<?php echo get_template_directory_uri().'/images/empty-mode-'.$postType.'.svg'; ?>" alt="" />
                   <?php
                } else {
                    echo '<img src="';
                    echo labs_by_sedoo_catch_that_image();
                    echo '" alt="" />'; 
                } 
            }?>            
        </figure>

        <?php
        if ($term_displayed == 1 && $term_displayed != false) {
        ?>
        <p>
        <?php     $categories = get_the_category();
            if ( ! empty( $categories ) ) {
            echo esc_html( $categories[0]->name );   
        }; ?>
        </p>
        <?php
        }
        ?>
	</header><!-- .entry-header -->
    <div class="group-content">
        <div class="entry-content">
            <h2><?php the_title(); ?></h2>
            <?php the_excerpt(); ?>
        </div><!-- .entry-content -->
        <footer class="entry-footer">
            <?php
            if ( 'post' === get_post_type() ) :
                ?>
                <p><?php the_date('M / d / Y') ?></p>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'sedoo-wpth-labs'); ?> →</a>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-->