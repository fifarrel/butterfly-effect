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
    wp_enqueue_style( 'butterfly-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@400;500;600;700&display=swap', array(), null );
    wp_enqueue_style( 'yourtheme-style', get_stylesheet_uri(), array( 'butterfly-fonts' ) );
    wp_enqueue_script( 'yourtheme-testimonials', get_template_directory_uri() . '/assets/js/testimonials.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'yourtheme_enqueue_assets' );

function yourtheme_font_preconnect( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'yourtheme_font_preconnect', 10, 2 );