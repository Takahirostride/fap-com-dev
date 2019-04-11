<?php

add_action('init', 'portfolio_register');  
   
function portfolio_register() {

	$labels = array(
		'name'               => _x( 'Portfolio items', 'post type general name', 'craftowp' ),
		'singular_name'      => _x( 'Portfolio item', 'post type singular name', 'craftowp' ),
		'menu_name'          => _x( 'Portfolio', 'admin menu', 'craftowp' ),
		'name_admin_bar'     => _x( 'Portfolio item', 'add new on admin bar', 'craftowp' ),
		'add_new'            => _x( 'Add New', 'portfolio', 'craftowp' ),
		'add_new_item'       => __( 'Add New Portfolio item', 'craftowp' ),
		'new_item'           => __( 'New Portfolio item', 'craftowp' ),
		'edit_item'          => __( 'Edit Portfolio item', 'craftowp' ),
		'view_item'          => __( 'View Portfolio item', 'craftowp' ),
		'all_items'          => __( 'All Portfolio items', 'craftowp' ),
		'search_items'       => __( 'Search Portfolios items', 'craftowp' ),
		'parent_item_colon'  => __( 'Parent Portfolios item:', 'craftowp' ),
		'not_found'          => __( 'No Portfolio items found.', 'craftowp' ),
		'not_found_in_trash' => __( 'No Portfolios items found in Trash.', 'craftowp' ),
	);

	$args = array(  
		'labels'             => $labels,
		'public'             => true,
		'menu_icon'          => 'dashicons-portfolio',
		'show_ui'            => true,  
		'capability_type'    => 'post',  
		'hierarchical'       => false,  
		'has_archive'=>true,
		'rewrite' => array(
			'slug'=>'portfolio',
			'with_front'=> false,
			'feed'=> true,
			'pages'=> true
		),
		'supports'           => array('title', 'editor', 'thumbnail')  
	);  
   
	register_post_type( 'portfolio' , $args );

	flush_rewrite_rules( false );
}


// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_portfolio_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_portfolio_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Portfolio Category', 'taxonomy general name', 'craftowp' ),
		'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'craftowp' ),
		'search_items'      => __( 'Search Portfolio Categories', 'craftowp' ),
		'all_items'         => __( 'All Portfolio Categories', 'craftowp' ),
		'parent_item'       => __( 'Parent Portfolio Category', 'craftowp' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'craftowp' ),
		'edit_item'         => __( 'Edit Portfolio Category', 'craftowp' ),
		'update_item'       => __( 'Update Portfolio Category', 'craftowp' ),
		'add_new_item'      => __( 'Add New Portfolio Category', 'craftowp' ),
		'new_item_name'     => __( 'New Portfolio Name', 'craftowp' ),
		'menu_name'         => __( 'Portfolio Categories', 'craftowp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
	);

	register_taxonomy( 'portfoliocats', array( 'portfolio' ), $args );
}

?>