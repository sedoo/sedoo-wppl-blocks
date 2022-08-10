<?php

// Create id attribute allowing for custom "anchor" value.
$id = 'sedoo_juxtapose-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sedoo_blocks_juxtapose';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// $startingposition = get_field('sedoo_juxtapose_startingposition');
$showLegend = get_field('sedoo_juxtapose_legend');

if ($showLegend == "1") {
    $showLegend = "true";
} else {
    $showLegend = "false";    
}
$animate = get_field('sedoo_juxtapose_animate');
if ($animate == "1") {
    $animate = "true";
} else {
    $animate = "false";    
}

$image1 = get_field('sedoo_juxtapose_image_1');
$imageLabel1 = get_field('sedoo_juxtapose_image_1_label');
$image2 = get_field('sedoo_juxtapose_image_2');
$imageLabel2 = get_field('sedoo_juxtapose_image_2_label');

// Image variables.
$url1 = $image1['url'];
$title1 = $image1['title'];
$alt1 = $image1['alt'];
$caption1 = $image1['caption'];

$url2 = $image2['url'];
$title2 = $image2['title'];
$alt2 = $image2['alt'];
$caption2 = $image2['caption'];

?>
<link rel="stylesheet" href="//s3.amazonaws.com/cdn.knightlab.com/libs/juxtapose/latest/css/juxtapose.css">
<div class="juxtapose sedoo_juxtapose" data-startingposition="<?php the_field('sedoo_juxtapose_startingposition');?>" data-showlabels="<?php echo $showLegend;?>" data-showcredits="true" data-animate="<?php echo $animate;?>" data-mode="<?php the_field('sedoo_juxtapose_mode');?>">
  <img src="<?php echo $url1;?>" data-label="<?php echo $caption1;?>" data-credit="crédit 1">
  <img src="<?php echo $url2;?>" data-label="<?php echo $caption2;?>" data-credit="crédit 2">
</div>
<script src="https://s3.amazonaws.com/cdn.knightlab.com/libs/juxtapose/latest/js/juxtapose.js"></script>
