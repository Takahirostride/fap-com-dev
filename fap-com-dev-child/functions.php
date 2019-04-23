<?php 
    add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' ); 
    function theme_enqueue_styles() {
         wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
         wp_enqueue_style( 'child-style', get_stylesheet_directory_uri(). '/style.css' );
    }

    register_nav_menus( array('fa-products-corp-menu-1'=>'グローバルナビゲーション：会社概要'));
    register_nav_menus( array('fa-products-corp-menu-5'=>'グローバルナビゲーション：採用情報'));

?>