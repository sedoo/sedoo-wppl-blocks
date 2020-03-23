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
<div class="sedoo-button-block-group sedoo_button_display_<?php echo $display; ?>">
<?php
while( have_rows('sedoo_blocks_vectorbutton_group') ): the_row();

    $borderStyle = "";
    // --------   One Block button   -----------/

    $text = get_sub_field('sedoo_blocks_vectorButton_text');
    $link = get_sub_field('sedoo_blocks_vectorButton_link');

    if ( get_sub_field('sedoo_blocks_vectorButton_svg') ) { 
        $icon = get_sub_field('sedoo_blocks_vectorButton_svg');
        $svg_file = file_get_contents($icon['url']);
        $find_string   = '<svg';
        $position = strpos($svg_file, $find_string);

        $svg_file_new = substr($svg_file, $position);
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
            echo $svg_file_new ; 
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