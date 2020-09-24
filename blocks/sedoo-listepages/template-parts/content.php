<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wppl_blocks
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
    <a href="<?php the_permalink(); ?>"></a>
	<header class="entry-header">
        <figure>
            <?php 
            if (has_post_thumbnail()) {
                the_post_thumbnail('thumbnail-loop');
            } else {
                labs_by_sedoo_catch_that_image();                
            }?>            
        </figure>
        <?php     
        $categories = get_the_category();
            if ( ! empty( $categories ) ) {
            echo "<p>".esc_html( $categories[0]->name )."</p>";   
        }; ?>
	</header><!-- .entry-header -->
    <div class="group-content">
        <div class="entry-content">
            <h2><?php the_title(); ?></h2>
            <?php //the_excerpt(); ?>
        </div><!-- .entry-content -->
        <footer class="entry-footer">
            <?php
            if ( 'post' === get_post_type() ) :
                ?>
                <p><?php the_date('d.m.Y') ?></p>
            <?php endif; ?>
            <!--
            <a href="<?php //the_permalink(); ?>"><?php //echo __('See more', 'sedoo-wpth-labs'); ?> →</a>-->
        </footer><!-- .entry-footer -->
    </div>
    </a>
</article><!-- #post-->