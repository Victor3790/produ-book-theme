<?php

add_action( 'after_setup_theme', 'add_features' );

function add_features() 
{

    // New features 
    add_theme_support( 'post-thumbnails' );

    // Custom image sizes 
    add_image_size( 'my_theme_thumbnail', 700, 350, true );
    add_image_size( 'my_theme_feature_image', 900, 400, true );

}

add_action( 'wp_enqueue_scripts', 'add_assets' );

function add_assets()
{

    wp_enqueue_style( 
        'my-blog-style', 
        get_stylesheet_uri() 
    );

    wp_enqueue_style( 
        'my-blog-home-style', 
        get_template_directory_uri() . '/css/home.css' 
    );

    wp_enqueue_script( 
        'my-blog-bootstrap', 
        'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', 
        array(), 
        false, 
        true 
    );

}

add_action( 'parse_query', 'sanitize_search' );

function sanitize_search( $query_object ) 
{

    if( ! is_search() )
        return; 

    $sanitized_query = wp_kses( $query_object->get('s'), array() ); 

    $query_object->set( 's', $sanitized_query );

}
