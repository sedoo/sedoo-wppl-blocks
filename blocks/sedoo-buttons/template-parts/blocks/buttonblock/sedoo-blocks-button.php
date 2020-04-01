<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'sedoo_blocks_vectorButton-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sedoo_blocks_vectorButton';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$display = get_field('sedoo_blocks_vectorButton_display');


// ---------------  REPEATER FIELD LOOP  -----------/
if( have_rows('sedoo_blocks_vectorbutton_group') ) {
?>
<div class="sedoo-button-block-group sedoo_button_display_<?php echo $display; ?> <?php echo $className; ?>">
<?php
while( have_rows('sedoo_blocks_vectorbutton_group') ): the_row();

    $borderStyle = "";
    // --------   One Block button   -----------/

    $text = get_sub_field('sedoo_blocks_vectorButton_text');
    $link = get_sub_field('sedoo_blocks_vectorButton_link');

    if ( get_sub_field('sedoo_blocks_vectorButton_svg') ) { 
        $icon = get_sub_field('sedoo_blocks_vectorButton_svg');
        $svg_file = wp_remote_get($icon['url']);
        if ( is_array( $svg_file ) && ! is_wp_error( $svg_file ) ) {
            //$headers = $svg_file['headers']; // array of http header lines
            $bodySVG    = $svg_file['body']; // use the content
        }
    } 
    if ( get_sub_field( 'sedoo_blocks_vectorButton_border' ) == 1 ) { 
    $borderStyle = "border-on";
    }
    if ( get_sub_field( 'sedoo_blocks_vectorButton_borderStyle' ) == 1 ) { 
    $borderStyle .= " rounded";
    }
    ?>
        <a class="sedoo-button-block <?php echo $borderStyle; ?>" href="<?php echo $link; ?>">
            <?php 
            if ( get_sub_field('sedoo_blocks_vectorButton_svg') ) { 
            echo $bodySVG ; 
            }
            ?>
            <span><?php echo $text; ?></span>
        </a>
<?php
endwhile;
?>
</div>
<?php
}
?>