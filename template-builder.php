<?php
/*
Template Name: Builder Page
*/
?>

<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	
	<?php
		if ( function_exists( 'ot_get_option' ) ) {
			$builder_array = get_post_meta( $post->ID, 'builder_sections', true );
			$builder_choice = get_post_meta( $post->ID, 'deactivate_builder', true );
		}

		if ($builder_array && $builder_choice == 'active') {
			$sections = '';
			foreach ($builder_array as $section) {
				echo do_shortcode( '[section page="'.$section['builder_section_page'].'" id="'.$section['builder_section_id'].'" show_on_menu="false" menu_label=""]' );
			}
		} else {
			do_shortcode( the_content() );
		}
		
	?>

<?php endwhile; ?>

<?php get_footer(); ?>