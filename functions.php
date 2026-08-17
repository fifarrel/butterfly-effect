<?php
function yourtheme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu' ),
    ) );
}
add_action( 'after_setup_theme', 'yourtheme_setup' );

function yourtheme_enqueue_assets() {
    wp_enqueue_style( 'yourtheme-style', get_stylesheet_uri() );
    wp_enqueue_script( 'yourtheme-testimonials', get_template_directory_uri() . '/assets/js/testimonials.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'yourtheme_enqueue_assets' );