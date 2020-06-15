<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Data-Terra
 */

$titleItem=mb_strimwidth(get_the_title(), 0, 70, '...');  
$postType=get_post_type();
if ( get_post_type() !== 'post') { $classParameter="isNotPost";} else { $classParameter="post";};

if($layout == 'grid' || $layout == "grid-noimage"){
    ?>
   <article id="post-<?php the_ID(); ?>" <?php post_class('post '.$classParameter.''); ?>>
    <a href="<?php the_permalink(); ?>"></a>
        <header class="entry-header">
            <?php if($layout == 'grid') { ?>
            <figure>
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('thumbnail-loop');
                } else {
                    labs_by_sedoo_catch_that_image();                
                }?>            
            </figure>
            <?php } ?>
            <?php     
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
            ?> 
            <p>
                <?php 
                echo esc_html( $categories[0]->name );   
                ?>
            </p>
            <?php
            }; 
            ?>
        </header><!-- .entry-header -->
        <div class="group-content">
            <div class="entry-content">
                <h3><?php the_title(); ?></h3>
                <?php
                if ( 'post' === get_post_type() ) :
                ?>
                <?php the_excerpt(); ?>
                <?php endif; ?>
            </div><!-- .entry-content -->
            <?php
            if ( 'post' === get_post_type() ) :
            ?>
            <footer class="entry-footer">
                <p><?php the_date('d.m.Y') ?></p>
                <a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'sedoo-wpth-labs'); ?> →</a>
            </footer><!-- .entry-footer -->
            <?php endif; ?>
            </footer><!-- .entry-footer -->
        </div>
</article><!-- #post-->

    <?php 
} 
elseif($layout == 'list') {
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('post '.$classParameter.''); ?>>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
            <h3><?php echo $titleItem; ?></h3>
        </a>
    </article>
<?php 
}
// pour les blocks déja posés qui n'ont pas d'affichage je met en grid par défaut
else {
?>
   <article id="post-<?php the_ID(); ?>" <?php post_class('post '.$classParameter.''); ?>>
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
            ?> 
            <p>
                <?php 
                echo esc_html( $categories[0]->name );   
                ?>
            </p>
            <?php
        }; ?>
	</header><!-- .entry-header -->
    <div class="group-content">
        <div class="entry-content">
            <h3><?php the_title(); ?></h3>
            <?php
            if ( 'post' === get_post_type() ) :
                ?>
            <?php the_excerpt(); ?>
            <?php endif; ?>
        </div><!-- .entry-content -->
        <?php
        if ( 'post' === get_post_type() ) :
        ?>
        <footer class="entry-footer">
                <p><?php the_date('d.m.Y') ?></p>
            <a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'sedoo-wpth-labs'); ?> →</a>
        </footer><!-- .entry-footer -->
        <?php endif; ?>
    </div>
</article><!-- #post--> 
<?php 
}
?>