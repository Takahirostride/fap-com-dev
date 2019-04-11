<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

<?php
	if ( function_exists( 'ot_get_option' ) ) {
		$home_array = ot_get_option( 'pages_on_home' );
	}

	if (isset($home_array) && $home_array) {
		$sections = '';
		foreach ($home_array as $section) {
			echo do_shortcode( '[section page="'.$section['home_section_page'].'" id="'.$section['home_section_id'].'" show_on_menu="'.$section['home_section_menu_choice'].'" menu_label="'.$section['home_section_label'].'"]' );
		}
	} else {
		echo '<h3 style="display:block; text-align:center; margin: 300px 0; z-index: 10; color: #bbb;">'.__('You need to add sections to Theme Options -> Home Sections', 'craftowp').'</h3>';
	}
	
?>

<?php get_footer(); ?>