<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

    <a href="<?php the_permalink(); ?>"></a>
    <div class="group-content">
        <div class="entry-content">
            <h3><?php the_title(); ?></h3>
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