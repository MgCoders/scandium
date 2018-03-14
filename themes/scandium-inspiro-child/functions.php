<?php
/**
 * Created by IntelliJ IDEA.
 * User: goja288
 * Date: 13/03/18
 * Time: 05:39 PM
 */

function my_theme_enqueue_styles() {

    $parent_style = 'inspiro-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap_css', get_stylesheet_directory_uri() . '/css/bootstrap.css' );
    wp_enqueue_style( 'bootstrap-grid_css', get_stylesheet_directory_uri() . '/css/bootstrap-grid.css' );
    wp_enqueue_style( 'bootstrap-reboot_css', get_stylesheet_directory_uri() . '/css/bootstrap-reboot.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );





}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );



function theme_js() {

    //global $wp_scripts;

    wp_enqueue_script( 'bootstrap_js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js' );
    //wp_enqueue_script( 'my_custom_js', get_template_directory_uri() . '/js/scripts.js');

}

add_action( 'wp_enqueue_scripts', 'theme_js');

?>