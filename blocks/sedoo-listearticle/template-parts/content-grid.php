<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
if (has_post_thumbnail()) {
    $postThumbnail = "<figure>";
    if (has_post_thumbnail()) {
        $postThumbnail .= get_the_post_thumbnail($post->ID, 'thumbnail-loop');
    }
    $postThumbnail .= "</figure>";
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>"></a>
	<header class="entry-header">
        <?php 
        if (isset($postThumbnail)){ echo $postThumbnail; }
        ?>
        <?php
        if (!is_front_page()) {
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
            <?php if($button == true) { ?>
                <a href="<?php the_permalink(); ?>"><?php echo $buttonLabel; ?> →</a>
            <?php } ?>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-->