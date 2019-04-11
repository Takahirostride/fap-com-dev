<?php

add_action('init', 'testimonials_register');  
   
function testimonials_register() {

	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name', 'craftowp' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name', 'craftowp' ),
		'menu_name'          => _x( 'Testimonials', 'admin menu', 'craftowp' ),
		'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'craftowp' ),
		'add_new'            => _x( 'Add New', 'testimonial', 'craftowp' ),
		'add_new_item'       => __( 'Add New Testimonial', 'craftowp' ),
		'new_item'           => __( 'New Testimonial', 'craftowp' ),
		'edit_item'          => __( 'Edit Testimonial', 'craftowp' ),
		'view_item'          => __( 'View Testimonial', 'craftowp' ),
		'all_items'          => __( 'All Testimonials', 'craftowp' ),
		'search_items'       => __( 'Search Testimonials', 'craftowp' ),
		'parent_item_colon'  => __( 'Parent Testimonials:', 'craftowp' ),
		'not_found'          => __( 'No Testimonials found.', 'craftowp' ),
		'not_found_in_trash' => __( 'No Testimonials found in Trash.', 'craftowp' ),
	);

	$args = array(  
		'labels'             => $labels,
		'public'             => true,
		'menu_icon'          => 'dashicons-editor-quote',
		'show_ui'            => true,  
		'capability_type'    => 'post',  
		'hierarchical'       => false,  
		'has_archive'=>true,
		'rewrite' => array(
			'slug'=>'testimonial',
			'with_front'=> false,
			'feed'=> true,
			'pages'=> true
		),  
		'supports'           => array('title', 'editor', 'thumbnail')  
	);  
   
	register_post_type( 'testimonial' , $args );  

	flush_rewrite_rules( false );
}


// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_testimonial_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_testimonial_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Testimonial Category', 'taxonomy general name', 'craftowp' ),
		'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'craftowp' ),
		'search_items'      => __( 'Search Testimonial Categories', 'craftowp' ),
		'all_items'         => __( 'All Testimonial Categories', 'craftowp' ),
		'parent_item'       => __( 'Parent Testimonial Category', 'craftowp' ),
		'parent_item_colon' => __( 'Parent Testimonial Category:', 'craftowp' ),
		'edit_item'         => __( 'Edit Testimonial Category', 'craftowp' ),
		'update_item'       => __( 'Update Testimonial Category', 'craftowp' ),
		'add_new_item'      => __( 'Add New Testimonial Category', 'craftowp' ),
		'new_item_name'     => __( 'New Testimonial Name', 'craftowp' ),
		'menu_name'         => __( 'Testimonial Categories', 'craftowp' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
	);

	register_taxonomy( 'testimonials', array( 'testimonial' ), $args );
}

?>