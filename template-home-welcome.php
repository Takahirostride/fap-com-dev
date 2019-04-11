<?php
/*
Template Name: Home Page Welcome
*/
?>

<?php get_header(); ?>

<?php if (function_exists( 'ot_get_option' )) {
	$value = ot_get_option( 'home_content_color' );
	if ( $value == 'dark' ) {
		$content_class = 'dark-content';
		$title_class = 'dark-special';
		$icons_class = 'dark-icons';
	} elseif ( $value == 'light' ) {
		$content_class = 'light-content';
		$title_class = 'light-special';
		$icons_class = 'light-icons';
	}
} ?>

<section id="home" class="parallax welcome-section photo-section dark-section <?php echo $content_class ?>">
	<div class="bg-overlay"></div>
	<div class="container">
		<div class="content-wrapper">
			<div class="welcome-content">

				<h1 class="special-heading <?php echo $title_class ?>">
				<?php if ( function_exists( 'ot_get_option' ) ) {
					$home_title = ot_get_option( 'home_title' );
					$blog_title = get_bloginfo('name');
					if ( ! empty($home_title) ) {
						echo $home_title;
					} else {
						_e('We are '.$blog_title , 'planuswp');
					}
				} ?>
				</h1>

				<p>
					<span>
					<?php if ( function_exists( 'ot_get_option' ) ) {
						$home_main_text = ot_get_option( 'home_main_text' );
						if ( ! empty($home_main_text) ) {
							echo $home_main_text;
						} else {
							_e( 'Our daily purpose is to build your web experience by', 'craftowp' );
						}
					} ?>
					</span>
					
					<span class="rotating-words">
					<?php if ( function_exists( 'ot_get_option' ) ) {
						$home_rotating_words = ot_get_option( 'home_rotating_words' );

						if ( ! empty($home_rotating_words) ) {
							$rotating_string = '';
							foreach ($home_rotating_words as $key => $value) {
								$rotating_string .= $value['rotating_sequence'].',';
							}
							echo rtrim($rotating_string, ',');
						} else {
							_e( 'creating your image, building your presence, boosting your income', 'craftowp' );
						}
					} ?>
					</span>
				</p>

				<?php insertSocialIcons($icons_class); ?>

				<div class="scroll-more"><span>
					<?php if ( function_exists( 'ot_get_option' ) ) {
						$scroll_text = ot_get_option( 'scroll_down' );
						if ( ! empty($scroll_text) ) {
							echo $scroll_text;
						} else {
							_e( 'Scroll Down', 'craftowp' );
						}
					} ?></span>
					<i class="scroll-arrow"></i>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End of Welcome Section -->

<?php
	if ( function_exists( 'ot_get_option' ) ) {
		$home_array = ot_get_option( 'pages_on_home' );
	}

	if (isset($home_array) && $home_array) {
		$sections = '';
		foreach ($home_array as $section) {
			$sc_page = (isset($section['home_section_page'])) ? $section['home_section_page'] : '' ;
			$sc_id = (isset($section['home_section_id'])) ? $section['home_section_id'] : '' ;
			$sc_show_on_menu = (isset($section['home_section_menu_choice'])) ? $section['home_section_menu_choice'] : '' ;
			$sc_menu_label = (isset($section['home_section_label'])) ? $section['home_section_label'] : '' ;
			echo do_shortcode( '[section page="'.$sc_page.'" id="'.$sc_id.'" show_on_menu="'.$sc_show_on_menu.'" menu_label="'.$sc_menu_label.'"]' );
		}
	} else {
		echo '<h3 style="display:block; text-align:center; margin: 100px 0; z-index: 10; color: #bbb;">'.__('You need to add sections to Theme Options -> Home Sections', 'craftowp').'</h3>';
	}
	
?>

<?php get_footer(); ?>