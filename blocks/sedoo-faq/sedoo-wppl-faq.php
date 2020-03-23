<?php

function register_sedoo_faq() {
    $args = array(
        'public'    => true,
        'label'     => __( 'FAQ', 'textdomain' ),
        'menu_icon' => 'dashicons-format-chat',
    );
    register_post_type( 'faq', $args );

    register_taxonomy(
        'sedoo_faq_categorie',
        'faq',
        array(
            'label' => __( 'Categories' ),
            'rewrite' => array( 'slug' => 'faq_cat' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'register_sedoo_faq' );

function sedoo_faq_scripts() {
    wp_register_style( 'sedoo_faq', plugins_url('css/faq.css', __FILE__) );
    wp_enqueue_style( 'sedoo_faq' );
}
add_action('wp_enqueue_scripts','sedoo_faq_scripts');

include 'sedoo-wppl-faq-acf.php';
include 'sedoo-wppl-faq-functions.php';
include 'inc/sedoo-wppl-faq-acf-fields.php';