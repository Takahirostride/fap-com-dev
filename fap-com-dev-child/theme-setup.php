<?php 

/* =================================================================================
Theme Setup
================================================================================== */

if ( ! function_exists( 'craftowp_setup' ) ) :
function craftowp_setup() {

	// launching operation cleanup
	add_action( 'init', 'craftowp_head_cleanup' );
	// remove WP version from RSS
	add_filter( 'the_generator', 'craftowp_rss_version' );
	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'craftowp_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action( 'wp_head', 'craftowp_remove_recent_comments_style', 1 );
	// clean up gallery output in wp
	add_filter( 'gallery_style', 'craftowp_gallery_style' );

	// enqueue base scripts and styles
	add_action('wp_enqueue_scripts', 'crafto_scripts_styles');

	// Make craftowp available for translation.
	load_theme_textdomain( 'craftowp', get_template_directory() . '/languages' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' ); // This feature enables post-thumbnail support for a theme
    set_post_thumbnail_size( 360, 236, true ); // Normal post thumbnails
    add_image_size( 'portfolio', 670, 440, true ); // Hard Crop Mode
    add_image_size( 'blog', 750, 320, true ); // Hard Crop Mode
    add_image_size( 'article-thumb', 357, 224, true ); 
    add_image_size( 'news-thumb', 163, 115, true ); 
    
    // Image sizes
	update_option('thumbnail_size_w', 240);
	update_option('thumbnail_size_h', 240);
	update_option('thumbnail_crop', 1);
	update_option('medium_size_w', 750);
	update_option('medium_size_h', 440);
	update_option('large_size_w', 1340);
	update_option('large_size_h', 880);

	// This theme uses wp_nav_menu() in two locations.
	// Please note that the home page menu is just for additional links on menu as the links are generated automaticaly.
	register_nav_menus( array(
		'home_menu'   => __( 'Home Page Menu', 'craftowp' ),
		'pages_menu'   => __( 'Inner Pages Menu', 'craftowp' ),
	) );

}
endif; // craftowp_setup
add_action( 'after_setup_theme', 'craftowp_setup' );



/* =================================================================================
Enqueues scripts and styles for front end.
================================================================================== */

function crafto_scripts_styles() {

	// Register Javascript files.
	wp_register_script('jquery','https://code.jquery.com/jquery-latest.min.js', array(), '', true );
	wp_register_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'),'3.2.0', true );
	wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'),'2.7.1', false );
	wp_register_script('modernizr_ie', get_template_directory_uri() . '/js/modernizr-ie.js', array('jquery'),'', true );
	wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.min.js', array('jquery'),'1.3', true );
	wp_register_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'),'1.6.2', true );
	wp_register_script('simple_text_rotator', get_template_directory_uri() . '/js/jquery.simple-text-rotator.min.js', array('jquery'),'', true );
	wp_register_script('nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array('jquery'),'3.5.4', true );
	wp_register_script('slick_carousel', get_template_directory_uri() . '/js/slick.min.js', array('jquery'),'', true );
	wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), null, true );
	wp_register_script('googlemaps', ('https://maps.google.com/maps/api/js?sensor=false'), false, null, true);
	wp_register_script('knob', get_template_directory_uri() . '/js/jquery.knob.min.js', array('jquery'), '1.2.10', true );
	wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.1', true );
	wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true );

	// Loads Javascript files.
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap_js');
	wp_enqueue_script('modernizr');
	wp_enqueue_script('modernizr_ie');
	wp_enqueue_script('easing');
	wp_enqueue_script('waypoints');
	wp_enqueue_script('simple_text_rotator');
	wp_enqueue_script('nicescroll');
	wp_enqueue_script('slick_carousel');
	wp_enqueue_script('prettyPhoto');
	wp_enqueue_script('knob');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('googlemaps');
	wp_enqueue_script('scripts');

	// Localize scripts
	$theme_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
	wp_localize_script( 'scripts', 'theme_path', $theme_array );

	// Loads CSS files.
	wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', false, '3.3.1');
	wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), null, false);
	wp_enqueue_style('lightbox', get_stylesheet_directory_uri() . '/css/prettyPhoto.css', false, '1.0');
	wp_enqueue_style('animate', get_stylesheet_directory_uri() . '/css/animate.css', false, '1.0');
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/css/style.css', false, '2.0.1');
}



/* =================================================================================
Option Tree Setup
================================================================================== */

// Required: set 'ot_theme_mode' filter to true.
add_filter( 'ot_theme_mode', '__return_true' );

// Required: include OptionTree.
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

// Meta Boxes
load_template( trailingslashit( get_template_directory() ) . 'includes/meta-boxes.php' );

// Theme Options
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-options.php' );

// Show Settings Import
// add_filter( 'ot_show_settings_import', '__return_false' );
add_filter( 'ot_show_options_ui', '__return_false' );
// add_filter( 'ot_show_settings_export', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
// add_filter( 'ot_show_docs', '__return_false' );

// Theme Style Option Tree - disable UI builder
add_filter( 'ot_show_pages', '__return_false' );

// Change Option Tree Header
add_filter('ot_header_version_text', 'option_tree_custom_title');
function option_tree_custom_title() {
	return 'CraftoWP v2.2 - Options Page';
}
add_filter('ot_header_logo_link', 'option_tree_remove_logo');
function option_tree_remove_logo() {
	return '';
}
add_filter('ot_upload_text', 'option_tree_custom_upload');
function option_tree_custom_upload() {
	return 'Send to field';
}

/**
* Filters the required title field's label.
*/
function filter_list_item_title_label( $label, $id ) {
	if ( $id == 'pages_on_home' ) {
		$label = __( 'Section name', 'craftowp' );
	}
	return $label;
}
add_filter( 'ot_list_item_title_label', 'filter_list_item_title_label', 10, 2 );

/**
* Filters the required title field's description.
*/
function filter_list_item_title_desc( $label, $id ) {
	if ( $id == 'pages_on_home' ) {
		$label = __( 'Add a name for your section. Only you will see this.', 'craftowp' );
	}
	return $label;
}
add_filter( 'ot_list_item_title_desc', 'filter_list_item_title_desc', 10, 2 );


// Show only font selection field for typography fields on Theme Options
function filter_typography_fields( $array, $field_id ) {
	
	$heading_ids = array(
		'heading_one_font',
		'heading_two_font',
		'heading_three_font',
		'heading_four_font',
		'heading_five_font',
		'heading_six_font',
		'welcome_heading_one',
		'welcome_description_font',
		'page_tagline_font'
	);

	if ( $field_id == "body_font" || $field_id == "menu_font") {
		$array = array( 'font-family', 'font-size');
	} else if ( in_array($field_id, $heading_ids) ) {
		$array = array( 'font-family', 'font-size', 'font-weight', 'letter-spacing', 'text-decoration', 'text-transform');
	}

	return $array;

}
add_filter( 'ot_recognized_typography_fields', 'filter_typography_fields', 10, 2 );



// Filter the images for Radio Image field
function filter_radio_images( $array, $field_id ) {

	/* only run the filter where the field ID is spinner_type */
	if ( $field_id == 'spinner_type' ) {
		$array = array(
			array(
				'value'   => 'spinner1',
				'label'   => __( 'Spinner 1', 'option-tree' ),
				'src'     => OT_THEME_URL . '/admin/images/spinner1.png'
			),
			array(
				'value'   => 'spinner2',
				'label'   => __( 'Spinner 2', 'option-tree' ),
				'src'     => OT_THEME_URL . '/admin/images/spinner2.png'
			),
			array(
				'value'   => 'spinner3',
				'label'   => __( 'Spinner 3', 'option-tree' ),
				'src'     => OT_THEME_URL . '/admin/images/spinner3.png'
			),
			array(
				'value'   => 'spinner4',
				'label'   => __( 'Spinner 4', 'option-tree' ),
				'src'     => OT_THEME_URL . '/admin/images/spinner4.png'
			)
		);
	}

	return $array;
  
}
add_filter( 'ot_radio_images', 'filter_radio_images', 10, 2 );


// Add WPML options to Option Tree page if WPML is active
function lang_ot_settings( $custom_settings ) {

	if (function_exists('icl_get_languages')) {

		// Add section
		if ( isset( $custom_settings['sections'] ) ) {
			$custom_settings['sections'][] = array(
				'id'            => 'language_settings',
				'title'         => 'Multilanguage'
			);
		}

		// Add settings
		if ( isset( $custom_settings['settings'] ) ) {
			$custom_settings['settings'][] = array(
				'id'            => 'show_lang_switcher',
				'label'         => __( 'Show WPML switcher', 'craftowp' ),
				'desc'          => __( 'Show the custom switcher for WPML plugin', 'craftowp' ),
				'std'           => 'off',
				'type'          => 'on-off',
				'section'       => 'language_settings',
				'rows'          => '',
				'post_type'     => '',
				'taxonomy'      => '',
				'min_max_step'  => '',
				'class'         => '',
				'condition'     => '',
			);

			$custom_settings['settings'][] = array(
				'id'            => 'lang_switcher_type',
				'label'         => __( 'WPML switcher type', 'craftowp' ),
				'desc'          => __( 'Choose the type of the custom WPML switcher', 'craftowp' ),
				'std'           => 'code',
				'type'          => 'radio',
				'section'       => 'language_settings',
				'rows'          => '',
				'post_type'     => '',
				'taxonomy'      => '',
				'min_max_step'  => '',
				'class'         => '',
				'condition'     => '',
				'choices'     => array(
					array(
						'value'       => 'code',
						'label'       => __( 'Language code', 'craftowp' ),
						'src'         => ''
					),
					array(
						'value'       => 'flag',
						'label'       => __( 'Country flag', 'craftowp' ),
						'src'         => ''
					)
				)
			);
		}
	}
	return $custom_settings;
}
add_filter( 'option_tree_settings_args', 'lang_ot_settings' );




// IMPORT EXPORT THEME OPTIONS
add_action( 'init', 'register_options_pages' );

function register_options_pages() {

	// Only execute in admin & if OT is installed
	if ( is_admin() && function_exists( 'ot_register_settings' ) ) {

		// Register the pages
		ot_register_settings( 
			array(
				array( 
					'id'              => 'import_export',
					'pages'           => array(
						array(
							'id'              => 'import_export',
							'parent_slug'     => 'themes.php',
							'page_title'      => 'Theme Options Backup/Restore',
							'menu_title'      => 'Options Backup',
							'capability'      => 'edit_theme_options',
							'menu_slug'       => 'pixelglow-theme-backup',
							'icon_url'        => null,
							'position'        => null,
							'updated_message' => 'Options updated.',
							'reset_message'   => 'Options reset.',
							'button_text'     => 'Save Changes',
							'show_buttons'    => false,
							'screen_icon'     => 'themes',
							'contextual_help' => null,
							'sections'        => array(
								array(
									'id'          => 'pixelglow_import_export',
									'title'       => __( 'Import/Export', 'orbitnews' )
								)
							),
							'settings'        => array(
								array(
									'id'          => 'import_data_text',
									'label'       => 'Import Theme Options',
									'desc'        => '',
									'std'         => '',
									'type'        => 'import-data',
									'section'     => 'pixelglow_import_export',
									'rows'        => '',
									'post_type'   => '',
									'taxonomy'    => '',
									'class'       => ''
								),
								array(
									'id'          => 'export_data_text',
									'label'       => 'Export Theme Options',
									'desc'        => '',
									'std'         => '',
									'type'        => 'export-data',
									'section'     => 'pixelglow_import_export',
									'rows'        => '',
									'post_type'   => '',
									'taxonomy'    => '',
									'class'       => ''
								)
							)
						)
					)
				)
			)
		);
	}
}


// Import Data option type.

if ( ! function_exists( 'ot_type_import_data' ) ) {

	function ot_type_import_data() {

	echo '<form method="post" id="import-data-form">';

		/* form nonce */
		wp_nonce_field( 'import_data_form', 'import_data_nonce' );

		/* format setting outer wrapper */
		echo '<div class="format-setting type-textarea has-desc">';

		/* description */
		echo '<div class="description">';

			if ( OT_SHOW_SETTINGS_IMPORT ) echo '<p>' . __( 'Only after you\'ve imported the Settings should you try and update your Theme Options.', 'option-tree' ) . '</p>';

			echo '<p>' . __( 'To import your Theme Options copy and paste what appears to be a random string of alpha numeric characters into this textarea and press the "Import Theme Options" button.', 'option-tree' ) . '</p>';

			/* button */
			echo '<button class="option-tree-ui-button button button-primary right hug-right">' . __( 'Import Theme Options', 'option-tree' ) . '</button>';

		echo '</div>';

		/* textarea */
		echo '<div class="format-setting-inner">';

			echo '<textarea rows="10" cols="40" name="import_data" id="import_data" class="textarea"></textarea>';

		echo '</div>';

		echo '</div>';

	echo '</form>';

	}

}


//Export Data option type.

if ( ! function_exists( 'ot_type_export_data' ) ) {

	function ot_type_export_data() {

		/* format setting outer wrapper */
		echo '<div class="format-setting type-textarea simple has-desc">';

			/* description */
			echo '<div class="description">';

				echo '<p>' . __( 'Export your Theme Options data by highlighting this text and doing a copy/paste into a blank .txt file. Then save the file for importing into another install of WordPress later. Alternatively, you could just paste it into the <code>OptionTree->Settings->Import</code> <strong>Theme Options</strong> textarea on another web site.', 'option-tree' ) . '</p>';

			echo '</div>';

			/* get theme options data */
			$data = get_option( ot_options_id() );
			$data = ! empty( $data ) ? ot_encode( serialize( $data ) ) : '';

			echo '<div class="format-setting-inner">';
				echo '<textarea rows="10" cols="40" name="export_data" id="export_data" class="textarea">' . $data . '</textarea>';
			echo '</div>';

		echo '</div>';

	}

}





/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function craftowp_head_cleanup() {
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'craftowp_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'craftowp_remove_wp_ver_css_js', 9999 );

} /* end craftowp head cleanup */

// remove WP version from RSS
function craftowp_rss_version() { return ''; }

// remove WP version from scripts
function craftowp_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function craftowp_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function craftowp_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
function craftowp_gallery_style($css) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

?>