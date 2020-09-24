<?php
/**
 * Template part for displaying posts - simple list
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class('listpages_list'); ?>>
<?php //the_permalink(); ?>
	<header class="entry-header">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
        if ($term_displayed == 1 && $term_displayed != false) {
        ?>
         <?php 
        $categories = get_the_category();
        if (( ! empty( $categories ) )&&(!is_archive())) {
            echo "<p>".esc_html( $categories[0]->name )."</p>";   
        }; ?>
        <?php
        }
        ?>
	</header><!-- .entry-header -->
    <div class="group-content">
        <div class="entry-content">
            <?php the_excerpt(); ?>
            <p class="date"><?php the_date('M / d / Y') ?>
            <a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'sedoo-wpth-labs'); ?> →</a>
        </div><!-- .entry-content -->
        <?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'labs-by-sedoo' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
    </div>
</article><!-- #post-->