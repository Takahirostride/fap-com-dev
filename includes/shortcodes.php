<?php

// Remove automated paragraphs around the shortcodes
function pixelglow_shortcodes_formatter($content) {
	$block = join("|",array(
		"team_member",
		"section",
		"button",
		"prettycol",
		"portfolio",
		"row",
		"col",
		"service",
		"tab",
		"tabs",
		"carousel",
		"carousel_item",
		"features",
		"feature",
		"contact_form",
		"googlemap",
		"social_icons",
		"progress",
		"iconbox",
		"separator",
		"promobox",
		"pricing_col",
		"dropcap",
		"emphasize",
		"image_slider",
		"slide",
		"cf_section",
		"special_title",
		"tagline"
	));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);

	return $rep;
}

add_filter('the_content', 'pixelglow_shortcodes_formatter');
add_filter('widget_text', 'pixelglow_shortcodes_formatter');




/* =====================================================================
Shortcode: Home sections shortcode
Author: Silviu Stefu
Description: Shortcodes to insert pages into home pages as sections
===================================================================== */

function home_sections($atts) {

	global $post;

	extract(shortcode_atts(array(
		'page'			=> '',
		'id'			=> '',
		'show_on_menu'	=> '',
		'menu_label'	=> '',
	), $atts));

	// Get the page slug by ID
	if(function_exists('icl_object_id')) {
		$post = get_post(icl_object_id($page,'page',true));
	} else {
		$post = get_post($page);
	}

	// Prepare title and slug
	$page_title = str_ireplace('"', '', trim($post->post_title));
	$slug = (isset($id) && $id !== "") ? $id : $post->post_name;


	// Get all options from page
	if ( function_exists( 'ot_get_option' ) ) {
		$custom_title = get_post_meta( $post->ID, 'custom_page_title', true );
		// $custom_title = get_post_meta(icl_object_id($post->ID, 'page', true), "custom_page_title", true);
		$special_heading = get_post_meta( $post->ID, 'activate_special_heading', true );
		$show_title = get_post_meta( $post->ID, 'show_page_title', true );
		$tagline = get_post_meta( $post->ID, 'page_tagline', true );
		$content_color = get_post_meta( $post->ID, 'page_content_color', true );
		$bg = get_post_meta( $post->ID, 'custom_page_background', true );
		$bg_parallax = get_post_meta( $post->ID, 'activate_page_parallax', true );
		$activate_overlay = get_post_meta( $post->ID, 'activate_page_overlay', true );
		$overlay_color = get_post_meta( $post->ID, 'page_overlay_color', true );
		$overlay_opacity = get_post_meta( $post->ID, 'page_overlay_opacity', true );
		$page_width = get_post_meta( $post->ID, 'page_content_width', true );
		$page_padding = get_post_meta( $post->ID, 'page_padding', true );

	}

	// Prepare content classes
	if ( $content_color == "dark" ) {
		$content_class = " dark-content";
		if ($special_heading == "on") {
			$title_class = " special-heading dark-special";
		} else {
			$title_class = " dark-section-title";
		}
	} elseif ( $content_color == "light" ) {
		$content_class = " light-content";
		if ($special_heading == "on") {
			$title_class = " special-heading light-special";
		} else {
			$title_class = " light-section-title";
		}
	}

	// Prepare background
	if (!empty($bg['background-image']) && $content_color == "dark") {
		$bg_class = ' photo-section light-section';
	} elseif (!empty($bg['background-image']) && $content_color == "light") {
		$bg_class = ' photo-section dark-section';
	} elseif (empty($bg['background-image']) && $content_color == "dark") {
		$bg_class = ' light-section';
	} elseif (empty($bg['background-image']) && $content_color == "light") {
		$bg_class = ' dark-section';
	}

	if (isset($bg)) {
		if (isset($bg['background-color'])) {
			$bgColor = $bg['background-color'];
		}
		if (isset($bg['background-image'])) {
			$bgImage = $bg['background-image'];
		}
		if (isset($bg['background-repeat'])) {
			$bgRepeat = $bg['background-repeat'];
		}
		$cssBg = '';
		if ( ! empty($bgImage) ) {
			$cssBg .= 'background-image: url('.$bgImage.'); background-repeat:'.$bgRepeat.';';
		} elseif ( ! empty($bgColor) ){
			$cssBg .= 'background-color:'.$bgColor.'; background-image:none;';
		} else {
			$cssBg .= '';
		}
	}

	if (isset($bg_parallax) && $bg_parallax == 'on') {
		$bg_class .= ' parallax';
	}

	if ( isset($activate_overlay) && $activate_overlay == 'on' && !empty($bg['background-image']) ) {
		$ovColor = (! empty($overlay_color)) ? 'background-color: '.$overlay_color.';' : '' ;
		$overlay_opacity_ie = (! empty($overlay_opacity)) ? substr($overlay_opacity, 2).'0' : '40' ;
		$ovOpacity = (! empty($overlay_opacity)) ? ' opacity: '.$overlay_opacity.'; -ms-filter: &quot;progid:DXImageTransform.Microsoft.Alpha(Opacity='.$overlay_opacity_ie.')&quot; ;' : '' ;
		$ovStyle = ( !empty($ovColor) || !empty($ovOpacity) ) ? ' style="'.$ovColor.$ovOpacity.'"' : '' ;
		$overlay = '<div class="bg-overlay"'.$ovStyle.'></div>';
	}

	// Show section on menu
	if (isset($show_on_menu) && $show_on_menu == "true") {
		$dataMenu = ' data-menu="true"';
		$dataLabel = (isset($menu_label) && $menu_label) ? ' data-label="'.$menu_label.'"' : ' data-label="'.(isset($custom_title) && $custom_title !== "" ? $title = str_ireplace('"', '', trim($custom_title)) : $page_title).'"';
	} else {
		$dataMenu = ' data-menu="false"';
		$dataLabel = '';
	}

	// Prepare tagline
	if (isset($tagline) && $tagline !== "") {
		$page_description = '<div class="section-description">'.$tagline.'</div>';
	}

	// Prepare displayed title
	$section_title = (isset($show_title) && $show_title !== 'off') ? 
		'<h1 class="'.$title_class.'">'.(isset($custom_title) && $custom_title !== "" ? $title = str_ireplace('"', '', trim($custom_title)) : $page_title).'</h1>' :
		'' ;

	// Prepare header
	$section_header = ($show_title !== 'off') ?
		'<div class="row">
			<div class="col-md-8 col-md-offset-2 page-section-head">'
				.( (isset($section_title)) ? $section_title : '' ).( (isset($page_description)) ? $page_description : '' ).
			'</div>
		</div>' : '';

	// Prepare section padding
	$section_padding = (isset($page_padding) && $page_padding !== "no") ? ' page-no-padding' : '' ;

	
	// Render the home sections
	if ($page !== "") {

		$include = get_pages('include='.$page);
		$content = apply_filters('the_content',$include[0]->post_content);

		if (isset($page_width) && $page_width == "full_width") {
			$output = '<section id="'.$slug.'" class="page-section'.$section_padding.$bg_class.$content_class.'"'.$dataMenu.$dataLabel.' style="'.$cssBg.'">'
				.((isset($overlay)) ? $overlay : '' ).
				$section_header.
				'<div class="section-page-content">'.$content.'</div>
			</section>';
		} else {
			$output = '<section id="'.$slug.'" class="page-section'.$section_padding.$bg_class.$content_class.'"'.$dataMenu.$dataLabel.' style="'.$cssBg.'">'
				.((isset($overlay)) ? $overlay : '' ).
				'<div class="container">'
					.$section_header.
					'<div class="section-page-content">'.$content.'</div>
				</div>
			</section>';
		}
		

		echo $output;

		// wp_reset_query();

	}
}
add_shortcode('section', 'home_sections');



// We need to be able to figure out the attributes of a wrapped shortcode
function bs_attribute_map($str, $att = null) {
    $res = array();
    $return = array();
    $reg = get_shortcode_regex();
    preg_match_all('~'.$reg.'~',$str, $matches);
    foreach($matches[2] as $key => $name) {
        $parsed = shortcode_parse_atts($matches[3][$key]);
        $parsed = is_array($parsed) ? $parsed : array();

            $res[$name] = $parsed;
            $return[] = $res;
        }
    return $return;
}



/* =====================================================================
Shortcode: Font Awesome
Author: Silviu Stefu
Description: Shortcodes to insert Font Awesome icons
===================================================================== */

function addscFontAwesome($atts) {
	extract(shortcode_atts(array(
		'type'  => '',
		'size' => '',
		'rotate' => '',
		'flip' => '',
		'pull' => '',
		'spin' => '',
	), $atts));
     
	$type = ($type) ? 'fa fa-'.$type. '' : 'fa-star';
	$size = ($size) ? ' fa-'.$size. '' : '';
	$rotate = ($rotate) ? ' fa-rotate-'.$rotate. '' : '';
	$flip = ($flip) ? ' fa-flip-'.$flip. '' : '';
	$pull = ($pull) ? ' pull-'.$pull. '' : '';
	$animated = (isset($spin) && $spin == 'true') ? ' fa-spin' : '';
 
	$theAwesomeFont = '<i class="'.$type.$size.$rotate.$flip.$pull.$animated.'"></i>';

	return $theAwesomeFont;
}

add_shortcode('icon', 'addscFontAwesome');



/* =====================================================================
Shortcode: Buttons
Author: Silviu Stefu
Description: Shortcodes to insert buttons
===================================================================== */

function display_buttons($atts) {
	extract(shortcode_atts(array(
	'size'  => '',
	'color' => '',
	'outlines' => 'false',
	'text' => '',
	'href' => ''
	), $atts));

	$classes = "btn";
	$size = ($size) ? ' btn-'.$size. '' : ' btn-small';
	if (isset($color) && $color == "default") {
		$colorClass = ' btn-default';
	} elseif (isset($color) && $color) {
		$colorClass = ' btn-'.$color;
	} else {
		$colorClass = ' btn-darkblue';
	}
	
	$outlines = ($outlines == 'true') ? ' btn-outline' : '';
	$classes .= $size.$colorClass.$outlines;
 
	$button = '<a class="'.$classes.'" href="'.$href.'" >'.$text.'</a>';
     
	return $button;
}
add_shortcode('button', 'display_buttons');




/* =====================================================================
Shortcode: Bootstrap Row and Columns
Author: Silviu Stefu
Description: Shortcodes to insert Bootstrap columns inside ROW shortcode
===================================================================== */

function bootstrapColumns($atts, $content = null) {
	extract(shortcode_atts(array(
		'columns' => '',
		'offset' => '',
		'breakpoint' => ''
	), $atts));

	$col = ($breakpoint && $columns) ? 'col-'.$breakpoint.'-'.$columns : '' ;
	$off = ($breakpoint && $offset) ? ' col-'.$breakpoint.'-offset-'.$offset : '' ;
	$class = ($col || $off) ? ' class="'.$col.$off.'"' : '' ;

	$string = '<div'.$class.'>'.do_shortcode($content).'</div>';

	return $string;
}
add_shortcode('col', 'bootstrapColumns');


function display_row($atts, $content = null) {
	extract( shortcode_atts( array(
		'extra_class'	 => '',
	), $atts ) );

	$return_string = '<div class="row '.$extra_class.'">'.do_shortcode($content).'</div>';

	return $return_string;
}
add_shortcode("row", "display_row");




/* =====================================================================
Shortcode: Bootstrap Tabs
Author: Silviu Stefu
Description: Add Bootstrap tabs shortcode
===================================================================== */

// Bootstrap Tab wrapper
function tabs( $atts, $content = null ) {

	if( isset( $GLOBALS['tabs_count'] ) )
		$GLOBALS['tabs_count']++;
	else
		$GLOBALS['tabs_count'] = 0;

	$GLOBALS['tabs_default_count'] = 0;
      
	extract( shortcode_atts( array(
		"type"   => false,
		"xclass" => false
	), $atts ) );
 
	$ul_class  = 'nav';
	$ul_class .= ( $type )     ? ' nav-'.$type : ' nav-tabs';
	$ul_class .= ( $xclass )   ? ' '.$xclass : '';

	$div_class = 'tab-content';

	$id = 'custom-tabs-'. $GLOBALS['tabs_count'];

	$atts_map = bs_attribute_map( $content );

	// Extract the tab titles for use in the tab widget.
	if ( $atts_map ) {
		$tabs = array();
		$GLOBALS['tabs_default_active'] = true;
		foreach( $atts_map as $check ) {
			if( !empty($check["tab"]["active"]) ) {
				$GLOBALS['tabs_default_active'] = false;
			}
		}
		$i = 0;
		foreach( $atts_map as $tab ) {
			$tabs[] = sprintf(
				'<li%s><a href="#%s" data-toggle="tab">%s</a></li>',
				( !empty($tab["tab"]["active"]) || ($GLOBALS['tabs_default_active'] && $i == 0) ) ? ' class="active"' : '',
				'custom-tab-' . $GLOBALS['tabs_count'] . '-' . sanitize_title( $tab["tab"]["title"] ),
				$tab["tab"]["title"]
			);
			$i++;
		}
	}

	$ul_class = esc_attr( $ul_class );
	$id = esc_attr( $id );
	$tabs = ( $tabs )  ? implode( $tabs ) : '';
	$div_class = esc_attr( $div_class );
	
	$output = '<div class="tabbed-content"><ul class="'.$ul_class.'" id="'.$id.'">'.$tabs.'</ul><div class="'.$div_class.'">'.do_shortcode( $content ).'</div></div>';

	return $output;
}
add_shortcode("tabs", "tabs");


// Bootstrap Tab
function tab( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'title'   => false,
		'active'  => false,
		'fade'    => '',
		'xclass'  => false,
	), $atts ) );
    
	if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
		$active = true;
	}
	$GLOBALS['tabs_default_count']++;

	$class  = 'tab-pane';
	$class .= ( $fade && $fade == 'true') ? ' fade' : '';
	$class .= ( $active && $active == 'true') ? ' active' : '';
	$class .= ( $active && $fade ) ? ' in' : '';

	$id = 'custom-tab-'. $GLOBALS['tabs_count'] . '-'. sanitize_title( $title );

	return sprintf( 
		'<div id="%s" class="%s">%s</div>',
		esc_attr( $id ),
		esc_attr( $class ),
		do_shortcode( $content )
	);

}
add_shortcode("tab", "tab");




/* =====================================================================
Shortcode: Bootstrap Collapslibles
Author: Silviu Stefu
Description: Bootstrap Collapsibles Shortcode - use it with Collapse shortcode
===================================================================== */

// Bootstrap Collapsibles Wrapper
function display_collapsibles( $atts, $content = null ) {

	if( isset($GLOBALS['collapsibles_count']) )
		$GLOBALS['collapsibles_count']++;
	else
		$GLOBALS['collapsibles_count'] = 0;

	extract( shortcode_atts( array(
		"xclass" => false
	), $atts ) );
      
	$class = 'panel-group';
	$class .= ( $xclass )   ? ' ' . $xclass : '';

	$id = 'custom-collapse-'. $GLOBALS['collapsibles_count'];

	return sprintf( 
		'<div class="%s" id="%s">%s</div>',
		esc_attr( $class ),
		esc_attr( $id ),
		do_shortcode( $content )
	);

}
add_shortcode("collapsibles", "display_collapsibles");


// Bootstrap collapsible
function display_collapse( $atts, $content = null ) {

	extract( shortcode_atts( array(
		"title"   => false,
		"type"    => false,
		"active"  => false,
		"xclass"  => false,
	), $atts ) );

	$panel_class = 'panel';
	$panel_class .= ( $type )     ? ' panel-' . $type : ' panel-default';
	$panel_class .= ( $xclass )   ? ' ' . $xclass : '';

	$collapse_class = 'panel-collapse';
	$collapse_class .= ( $active )  ? ' in' : ' collapse';

	$parent = 'custom-collapse-'. $GLOBALS['collapsibles_count'];
	$current_collapse = $parent . '-'. sanitize_title( $title );
      
	return sprintf( 
		'<div class="%1$s">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#%2$s" href="#%3$s">%4$s</a>
				</h4>
			</div>
			<div id="%3$s" class="%5$s">
				<div class="panel-body">%6$s</div>
			</div>
		</div>',
		esc_attr( $panel_class ),
		$parent,
		$current_collapse,
		$title,
		esc_attr( $collapse_class ),
		do_shortcode( $content )
	);
}
add_shortcode("collapse", "display_collapse");




/* =====================================================================
Shortcode: Google Map
Author: Silviu Stefu
Description: Insert Google Maps shortcode
===================================================================== */

function googleMap($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => 'myMap',
		"type" => 'road',
		"latitude" => '36.394757',
		"longitude" => '-105.600586',
		"zoom" => '16',
		"message" => __('This is the message...', 'craftowp'),
		"width" => '100%',
		"height" => '400',
		"hue" => '',
	), $atts));

	$mapType = '';
	if($type == "satellite") 
		$mapType = "SATELLITE";
	else if($type == "terrain")
		$mapType = "TERRAIN";  
	else if($type == "hybrid")
		$mapType = "HYBRID";
	else
		$mapType = "ROADMAP";

echo '<!-- Google Map -->
	<script type="text/javascript">  
		jQuery(document).ready(function() {

			function initializeGoogleMap() {
				var myLatlng = new google.maps.LatLng('.$latitude.','.$longitude.');
				var myOptions = {
					center: myLatlng,  
					zoom: '.$zoom.',
					mapTypeControl: false,
					mapTypeId: google.maps.MapTypeId.'.$mapType.',
					panControl: false,
					zoomControl: true,
					scaleControl: true,
					streetViewControl: false,
					scrollwheel: false
				};

			var styles = [{
				stylers: [
					{ hue: "'.$hue.'" },
					{ saturation: -10 }
				]},{
				featureType: "road",
				elementType: "geometry",
				stylers: [
					{ lightness: 50 },
					{ visibility: "simplified" },
					{ gamma: 2 }
				]
			}];

			var map = new google.maps.Map(document.getElementById("'.$id.'"), myOptions);
			map.setOptions({styles: styles});

			var contentString = "'.$message.'";
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});

			var marker = new google.maps.Marker({
				position: myLatlng,
				center: myLatlng
			});

			google.maps.event.addListener(marker, "click", function() {
				infowindow.open(map,marker);
			});

			google.maps.event.addDomListener(window, "resize", function() {
				map.setCenter(myLatlng);
			});

			marker.setMap(map);

			}
			initializeGoogleMap();

		});
	</script>';

return '<div id="'.$id.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
}
add_shortcode('googlemap','googleMap');




/* =====================================================================
Shortcode: Recent portfolio posts
Author: Silviu Stefu
Description: Shortcode to output recent posts from Portfolio
===================================================================== */

function display_latest_portfolio($atts) {

	extract( shortcode_atts( array(
		"posts"				=> '',
		"show_filters"		=> 'true',
		"filters_color"		=> 'darkblue',
		"filters_size"		=> 'medium',
		"filters_outlines"	=> 'true',
		"more_button"		=> 'true',
		"more_url"			=> '',
		"more_text"			=> '',
		"more_target"		=> '',
		"post_links"		=> '',
		"animated"			=> '',
	), $atts ) );

	global $post;

	$output = '';

	$color_classes = array("blue","darkblue","red","green","orange","white","gray","lightgray");
	$show_links = (isset($post_links) && $post_links == "true") ? ' data-postlinks="yes"' : ' data-postlinks="no"' ;
	$animated = (isset($animated) && $animated == "yes") ? ' animated' : '' ;

	// Show Filters or not
	if ($show_filters == "true") :
		$categories = get_terms( 'portfoliocats', array( 'hide_empty' => true ));

		$filters_classes = " btn";
		$size = ($filters_size) ? ' btn-'.$filters_size. '' : ' btn-medium';
		$color = ($filters_color && in_array($filters_color, $color_classes)) ? ' btn-'.$filters_color. '' : ' btn-darkblue';
		$outlines = ($filters_outlines == 'true') ? ' btn-outline' : '';
		$filters_classes .= $size.$color.$outlines;

		$target = ($more_target == "blank") ? "blank" : "self";
		$moreButton = ($more_button !== "false") ? '<a href="'.$more_url.'" class="'.$filters_classes.' more-work" target="_'.$target.'">'.$more_text.'</a>' : '';

		$catli = '';
		foreach ($categories as $category) {
			$slug = $category -> slug;
			$name = $category -> name;
			$catli .= '<li class="'.$filters_classes.' filter portfolio-filter" data-id="'.$slug.'">'.$name.'</li>';
		}

		$output .= '<div class="filter-bar clearfix">
				<ul class="filter-list">
					<li class="'.$filters_classes. ' filter active" data-id="all">'.__('All', 'craftowp').'</li>
					'.$catli.'
				</ul>
				'.$moreButton.'
			</div>';
	endif;

	// Query posts
	$args = array(
		'post_type' 	=> 'portfolio',
		'showposts'		=> $posts,
	);
	$query = query_posts($args);

	$output .= '<div class="main">
			<ul id="og-grid" class="og-grid">';

	if (have_posts()) : while (have_posts()) : the_post();

		$title = str_ireplace('"', '', trim(get_the_title()));
		$desc = string_limit_words(get_the_content(), 25);
		$terms = get_the_terms($post->ID, 'portfoliocats');
		$permalink = get_permalink( $post->ID );

		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src($thumb_id,'portfolio', true);
		$thumb = $thumb_url[0];


		$video_link = get_post_meta($post->ID, 'portfolio_video', true);
		$vid = video_id_from_link($video_link);


		if ( $terms && ! is_wp_error( $terms ) ) : 
			$portfolio_links = array();
			$portfolio_names = array();
			$parent = array();
			foreach ( $terms as $term ) {
				$portfolio_links[] = $term->slug;
				$portfolio_names[] = $term->name;
				$parent[] = $term->parent;
			}			
			$slug = join( " ", $portfolio_links );
			$parent_slug = get_term_by('id', $parent[0], 'portfoliocats');
			$final_parent = $parent_slug['slug'];
			$slug .= " ".$final_parent;

			$name = join( ", ", $portfolio_names );
			$final_parent_name = $parent_slug['name'];
			$name .= ", ".$final_parent_name;
		endif;

				$output .= '<li class="portfolio-item visible-item'.$animated.'" data-id="'.$slug.'">
					<a href="'.$permalink.'"'.$show_links.' data-largesrc="'.$thumb.'" data-video="'.( ($vid) ? $vid : '' ).'" data-category="'.$name.'" data-date="'.get_the_date().'" data-title="'.$title.'" data-description="'.htmlentities(wpautop( do_shortcode(get_the_content()), true )).'">
						<img src="'.$thumb.'" alt="'.$title.'"/>
						<div class="overlay-content">
							<h4>'.$title.'</h4>
							<p>'.strip_shortcodes(strip_tags($desc)).' ... </p>
						</div>
					</a>
				</li>';
	endwhile; endif;

	wp_reset_query();

		$output .= '</ul>
	</div>';

	return $output;
}
add_shortcode( 'portfolio', 'display_latest_portfolio' );




/* =====================================================================
Shortcode: Testimonials
Author: Silviu Stefu
Description: Shortcode to output testimonials
===================================================================== */
function display_testimonials($atts) {

	global $post;

	extract( shortcode_atts( array(
		"posts_count"	 => '',
		"categories" => '',
		"only_posts" => ''
	), $atts ) );

	if ( ! empty($only_posts)) {
		$posts_count = -1;
		$categories = "";
		$include_posts = explode(',', $only_posts);
	}

		$output = '<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="quote-separator"><i class="fa fa-quote-right fa-3x"></i></div>';

	// Query posts
	$the_query = new WP_Query(array(
		'post_type' => 'testimonial',
		'taxonomy' => 'testimonials',
		'posts_per_page' => ( ! empty($posts_count)) ? $posts_count : '' ,
		'post__in' => ( ! empty($include_posts)) ? $include_posts : '',
		'testimonials' => ( ! empty($categories)) ? $categories : '',
	));

				// The Loop
				if ( $the_query->have_posts() ) {
					$output .= '<div id="testimonials-rotator" class="testimonials-rotator">';
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$output .= '<div class="testimonial">
							<blockquote>
								<p>'.strip_tags(wpautop(get_the_content())).'</p>
								<footer>'.get_the_title().'</footer>
							</blockquote>
						</div>';
					}
					$output .= '</div>';
				} else {
					// no posts found
				}

			$output .= '</div>
		</div>';

	/* Restore original Post Data */
	wp_reset_postdata();

	return $output;
}
add_shortcode( 'testimonials', 'display_testimonials' );




/* =====================================================================
Shortcode: Team Section
Author: Silviu Stefu
Description: Shortcodes to output team section
===================================================================== */

function display_team_member($atts, $content = null) {
	extract( shortcode_atts( array(
		'picture'				=> '',
		'name'					=> '',
		'link'					=> '',
		'title'					=> '',
		'animated'				=> '',
		'social_icons_style'	=> '',
		'email'					=> '',
		'facebook'				=> '',
		'twitter'				=> '',
		'google'				=> '',
		'linkedin'				=> '',
		'pinterest'				=> '',
		'youtube'				=> '',
		'dribbble'				=> '',
		'github'				=> '',
		'digg'					=> '',
		'delicious'				=> '',
		'tumblr'				=> '',
		'skype'					=> '',
		'soundcloud'			=> '',
		'vimeo'					=> '',
		'flickr'				=> '',
		'vk'					=> '',

	), $atts ) );

	$output = '';

	// Prepare social icons
	$social_style = (isset($social_icons_style) && $social_icons_style == "dark") ? ' dark-team-icons' : ' light-team-icons';
	$social_icons = '';
	if (isset($email) && $email) {
		$social_icons .= '<a href="mailto:'.$email.'?Subject=Hello%20there"><i class="fa fa-envelope"></i></a>';
	}
	if (isset($facebook) && $facebook) {
		$social_icons .= '<a href="'.$facebook.'" target="_blank"><i class="fa fa-facebook"></i></a>';
	}
	if (isset($twitter) && $twitter) {
		$social_icons .= '<a href="'.$twitter.'" target="_blank"><i class="fa fa-twitter"></i></a>';
	}
	if (isset($google) && $google) {
		$social_icons .= '<a href="'.$google.'" target="_blank"><i class="fa fa-google-plus"></i></a>';
	}
	if (isset($linkedin) && $linkedin) {
		$social_icons .= '<a href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin"></i></a>';
	}
	if (isset($pinterest) && $pinterest) {
		$social_icons .= '<a href="'.$pinterest.'" target="_blank"><i class="fa fa-pinterest"></i></a>';
	}
	if (isset($youtube) && $youtube) {
		$social_icons .= '<a href="'.$youtube.'" target="_blank"><i class="fa fa-youtube"></i></a>';
	}
	if (isset($dribbble) && $dribbble) {
		$social_icons .= '<a href="'.$dribbble.'" target="_blank"><i class="fa fa-dribbble"></i></a>';
	}
	if (isset($github) && $github) {
		$social_icons .= '<a href="'.$github.'" target="_blank"><i class="fa fa-github"></i></a>';
	}
	if (isset($digg) && $digg) {
		$social_icons .= '<a href="'.$digg.'" target="_blank"><i class="fa fa-digg"></i></a>';
	}
	if (isset($delicious) && $delicious) {
		$social_icons .= '<a href="'.$delicious.'" target="_blank"><i class="fa fa-delicious"></i></a>';
	}
	if (isset($tumblr) && $tumblr) {
		$social_icons .= '<a href="'.$tumblr.'" target="_blank"><i class="fa fa-tumblr"></i></a>';
	}
	if (isset($skype) && $skype) {
		$social_icons .= '<a href="'.$skype.'" target="_blank"><i class="fa fa-skype"></i></a>';
	}
	if (isset($soundcloud) && $soundcloud) {
		$social_icons .= '<a href="'.$soundcloud.'" target="_blank"><i class="fa fa-soundcloud"></i></a>';
	}
	if (isset($vimeo) && $vimeo) {
		$social_icons .= '<a href="'.$vimeo.'" target="_blank"><i class="fa fa-vimeo-square"></i></a>';
	}
	if (isset($flickr) && $flickr) {
		$social_icons .= '<a href="'.$flickr.'" target="_blank"><i class="fa fa-flickr"></i></a>';
	}
	if (isset($vk) && $vk) {
		$social_icons .= '<a href="'.$vk.'" target="_blank"><i class="fa fa-vk"></i></a>';
	}

	// Prepare name
	if (isset($name) && $name) {
		if (isset($link) && $link) {
			$render_name = '<h3><a href="'.$link.'">'.$name.'</a></h3>';
		} else {
			$render_name = '<h3>'.$name.'</h3>';
		}
	}

	$animated = (isset($animated) && $animated == "yes") ? ' animated' : '' ;

	$output .= '<div class="col-md-4">
		<div class="team-member">
			<div class="profile-picture'.$animated.'">
				<figure><img src="'.$picture.'" alt="'.$name.'"></figure>
				<div class="profile-overlay"></div>
				<div class="profile-social'.$social_style.'">
					<div class="icons-wrapper">'
						.$social_icons.
					'</div>
				</div>
			</div>'
			.((isset($render_name) && $render_name !== '') ? $render_name : '' ).
			'<span>'.$title.'</span>
			<div class="team-bio">
				<p>'.$content.'</p>
			</div>
		</div>
	</div>';

	return $output;

}
add_shortcode( 'team_member', 'display_team_member' );




/* =====================================================================
Shortcode: Pretty Column
Author: Silviu Stefu
Description: Shortcodes to output a pretty column containing an icon and a description
===================================================================== */
function pretty_column( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'title'		=> '',
		'link'		=> '',
		'icon'		=> '',
		'width'		=> '',
		'animated'	=> '',
	),$atts ) );

	// global $post;

	$output = '';
	
	// if (isset($link) && $link !== '') {
	// 	$postid = url_to_postid( $link );
	// 	$ct = get_post_field('post_content', $postid);
	// 	$ct = strip_shortcodes( $ct );
	// }

	// wp_reset_postdata( $post );

	// Prepare title
	$renderTitle = (isset($link) && $link) ? '<h2><a href="'.$link.'">'.$title.'</a></h2>' : '<h2>'.$title.'</h2>';

	// Animation
	$animated = (isset($animated) && $animated) ? ' animated' : '' ;

			$output .= '<div class="col-md-'.$width.'">
				<div class="pretty-col'.$animated.'">
					<div class="pretty-icon">
						<figure><i class="fa fa-'.$icon.'"></i></figure>
					</div>'
					.$renderTitle.
					'<p>'.$content.'</p>
				</div>
			</div>';

	return $output;
}
add_shortcode( 'prettycol','pretty_column' );




/* =====================================================================
Shortcode: Recent posts
Author: Silviu Stefu
Description: Shortcodes to output the latest blog posts
===================================================================== */
function display_blog_posts( $atts ) {
	$atts = extract( shortcode_atts( array(
		'posts'					=> '',
		'onlyposts'				=> '',
		'exclude_posts'			=> '',
		'onlycats'				=> '',
		'exclude_cats'			=> '',
		'onlytags'				=> '',
		'exclude_tags'			=> '',
		'more_button'			=> '',
		'more_text'				=> '',
		'more_link'				=> '',
		'more_target'			=> '',
		'post_width'			=> '',
		'description_length'	=> '25',
		'show_image'			=> '',
		'layout'				=> '',
		'animated'				=> '',

	),$atts ) );

	global $post;


	// Prepare "more" button
	$more_link_target = (isset($more_target) && $more_target == "blank") ? ' blank="_blank"' : ' blank="_self"';
	$more_button = (isset($more_button) && $more_button == 'true') ?
		'<a href="'.$more_link.'" class="btn btn-outline btn-darkblue more-blog"'.$more_link_target.'>'.$more_text.'</a>' : '';

	// Prepare layout
	$renderLayout = (isset($layout) && $layout == "horizontal") ? ' horizontal-col' : ' vertical-col';

		$output = '<div class="row recent-posts">';

	// Query posts
	$args = array(
		'posts_per_page'	=> $posts,
		'post__in'			=> $onlyposts = (isset($onlyposts) && $onlyposts) ? explode(',', $onlyposts) : '',
		'post__not_in'		=> $exclude_posts = (isset($exclude_posts) && $exclude_posts) ? explode(',', $exclude_posts) : '',
		'category__in'		=> $onlycats = (isset($onlycats) && $onlycats) ? explode(',', $onlycats) : '',
		'category__not_in'	=> $exclude_cats = (isset($exclude_cats) && $exclude_cats) ? explode(',', $exclude_cats) : '',
		'tag__in'			=> $onlytags,
		'tag__not_in'		=> $exclude_tags,
		'post_type'			=> 'post',
		'post_status'		=> 'publish',
	);

	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) {
			$query->the_post();

			// Prepare image
			if (isset($show_image) && $show_image == "true") {
				if (isset($layout) && $layout == "horizontal") {
					$renderImage = (has_post_thumbnail( $post->ID )) ? '<figure>'.get_the_post_thumbnail($post->ID, 'thumbnail').'</figure>' : '';
				} else {
					$renderImage = (has_post_thumbnail( $post->ID )) ? '<figure>'.get_the_post_thumbnail($post->ID, 'portfolio').'</figure>' : '';
				}
			}

			$title = str_ireplace('"', '', trim(get_the_title()));
			$permalink = get_permalink( $post->ID );
			$descCount = (isset($description_length) && $description_length) ? $description_length : '25';
			$desc = string_limit_words(strip_tags(get_the_excerpt()), $descCount);
			$animated = (isset($animated) && $animated) ? ' animated' : '' ;

			$output .= '<div class="col-sm-'.$post_width.' post-col'.$renderLayout.$animated.'">'
				.$renderImage.
				'<div class="post-col-content">
					<h2>'.$title.'</h2>
					<p>'.$desc.'</p>
					<a href="'.$permalink.'" class="btn read-more">'.__('Read More', 'craftowp').'</a>
				</div>
			</div>';
		}

	} else {
		echo '<h2>'.__('No posts found!', 'craftowp').'</h2>';
	}
	/* Restore original Post Data */
	wp_reset_postdata();

		$output .= $more_button;

	$output .= '</div>';

	return $output;
		
}
add_shortcode( 'latest_posts','display_blog_posts' );




/* =====================================================================
Shortcode: Clients carousel
Author: Silviu Stefu
Description: Shortcodes to build an image carousel for clients logos
===================================================================== */

function display_image_carousel( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'show_bullets' => '',
		'show_arrows' => '',
		'infinite' => 'true',
		'speed' => '',
		'slides_to_show' => '4',
		'slides_to_scroll' => '1',
		'extra_class' => '',
		'id' => '',
	),$atts ) );

	$bullets = (isset($show_bullets) && $show_bullets == "false") ? ' data-bullets="false"' : ' data-bullets="true"' ;
	$arrows = (isset($show_arrows) && $show_arrows == "false") ? ' data-arrows="false"' : ' data-arrows="true"' ;
	$infinite = (isset($infinite) && $infinite == "false") ? ' data-infinite="false"' : ' data-infinite="true"' ;
	$speed = (isset($speed) && $speed !== "") ? ' data-speed="'.$speed.'"' : ' data-speed="800"' ;
	$show = (isset($slides_to_show) && $slides_to_show !== "") ? ' data-show="'.$slides_to_show.'"' : ' data-show="4"' ;
	$scroll = (isset($slides_to_scroll) && $slides_to_scroll !== "") ? ' data-scroll="'.$slides_to_scroll.'"' : ' data-scroll="1"' ;
	$extra_class = (isset($extra_class) && $extra_class !== "") ? ' '.$extra_class : '' ;

			$output = '<div class="carousel'.$extra_class.'"'.$bullets.$arrows.$speed.$show.$scroll.$infinite.'>'.do_shortcode($content).'</div>';

			return $output;
}
add_shortcode( 'carousel','display_image_carousel' );


function display_carousel_item( $atts ) {
	$atts = extract( shortcode_atts( array(
		'name'			=> '',
		'image'			=> '',
		'lightbox'		=> 'false',
		'lightbox_src'	=> '',
		'link'			=> '',
		'link_target'	=> '',
		'alt'			=> '',
		'animated'		=> '',
	),$atts ) );

	$animated = (isset($animated) && $animated == "yes") ? ' animated' : '' ;

			if (isset($lightbox) && $lightbox !== "false") {
				$nameLb = (isset($name) && $name) ? ' data-title="'.$name.'"' : '' ;
				$imageBig = (isset($lightbox_src) && $lightbox_src) ? $lightbox_src : '' ;

				$output = '<div class="carousel-slide'.$animated.'">
					<a href="'.$lightbox_src.'" rel="prettyPhoto"'.$nameLb.'>
						<span class="car-image"><img src="'.$image.'" alt="'.$alt.'" /></span>
					</a>
				</div>';

			} else {
				if (isset($link) && $link) {
					$target = (isset($link_target) && $link_target == "blank") ? ' target="_blank"' : '' ;
					$linkName = (isset($name) && $name) ? 'title="'.$name.'"' : '';
					$output = '<div class="carousel-slide'.$animated.'">
						<a href="'.$link.'"'.$target.$linkName.'>
							<span class="car-image"><img src="'.$image.'" alt="'.$alt.'" /></span>
						</a>
					</div>';
				} else {
					$output = '<div class="carousel-slide'.$animated.'">
						<span class="car-image"><img src="'.$image.'" alt="'.$alt.'" /></span>
					</div>';
				}
				
			}
			
				return $output;
}
add_shortcode( 'carousel_item','display_carousel_item' );




/* =====================================================================
Shortcode: Features columns
Author: Silviu Stefu
Description: Shortcodes to show features columns with icons
===================================================================== */

function display_features_row( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'extra_class' => '',
		'style' => '',
	),$atts ) );

	$extra_class = (isset($extra_class) && $extra_class !== "") ? ' '.$extra_class : '' ;
	$style = (isset($style) && $style == "vertical") ? ' vertical-features' : ' horizontal-features';

	return '<div class="row features-row'.$style.$extra_class.'">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'features','display_features_row' );


function display_feature( $atts ) {
	$atts = extract( shortcode_atts( array(
		'icon'  		=> 'desktop',
		'color' 		=> '',
		'description'	=> '',
		'width'			=> '4',
		'breakpoint'	=> 'sm',
		'offset'		=> '',
		'animated'		=> '',
	),$atts ) );

	$col = 'col-'.$breakpoint.'-'.$width;
	$off = (isset($offset) && $offset) ? ' col-'.$breakpoint.'-offset-'.$offset.'"' : '' ;
	$color = (isset($color) && $color) ? 'style="color: '.$color.'"' : '' ;
	$animated = (isset($animated) && $animated == "yes") ? ' animated' : '' ;

	$output = '<div class="'.$col.$off.'">
		<div class="feature-col'.$animated.' clearfix">
			<i class="fa fa-'.$icon.'"'.$color.'></i>
			<span>'.$description.'</span>
		</div>
	</div>';

	return $output;
}
add_shortcode( 'feature','display_feature' );




/* =====================================================================
Shortcode: Social icons
Author: Silviu Stefu
Description: Shortcodes to show features columns with icons
===================================================================== */

function display_social_icons( $atts ) {
	$atts = extract( shortcode_atts( array(
		'color'	=> '',
		'style'	=> ''
	),$atts ) );

	$icons_color = (isset($color) && $color == "light") ? ' light-icons' : ' dark-icons' ;
	$icons_style = (isset($style) && $style == "round") ? ' round-icons' : ' square-icons' ;

	if ( function_exists( 'ot_get_option' ) ) {
		$social_links = ot_get_option( 'social_profiles' );
	}

	$output = '<div class="social-icons'.$icons_color.$icons_style.'">';

	if ($social_links != "") {
		foreach ($social_links as $key => $values) {
			$the_urls = array($values['profile_url']);
			$social_profile = array($values['social_profile']);
			$the_titles = array($values['title']);

			foreach ($the_urls as $index => $url) {
				$output .= '<a class="icon-social" href="'.$url.'" target="_blank"><i class="fa '.$social_profile[$index].'"></i></a>';
			}
		}
	}

	$output .= '</div>';

	return $output;
}
add_shortcode( 'social_icons','display_social_icons' );



/* =====================================================================
Shortcode: Progress circle
Author: Silviu Stefu
Description: Shortcodes to show progress circless with animation
===================================================================== */

function display_progress_circle( $atts ) {
	$a = extract(shortcode_atts( array(
		'title'			=> '',
		'value'			=> '',
		'animated'		=> '',
		'min'			=> '',
		'max'			=> '',
		'step'			=> '',
		'angle_offset'	=> '',
		'angle_arc'		=> '',
		'rotation'		=> '',
		'cursor'		=> '',
		'thickness'		=> '',
		'line_cap'		=> '',
		'width'			=> '',
		'fg_color'		=> '',
		'counter_color'	=> '',
		'bg_color'		=> ''
	), $atts ));

	$animated = (isset($animated) && $animated == "false") ? '' : ' animated' ;
	$title = (isset($title) && $title) ? '<h3>'.$title.'</h3>' : '' ;

	$data = '';
	$data .= (isset($value) && $value !== '') ? ' value="'.intval($value).'"' : '0' ;
	$data .= (isset($min) && $min) ? ' data-min="'.$min.'"' : '' ;
	$data .= (isset($max) && $max) ? ' data-max="'.$max.'"' : '' ;
	$data .= (isset($step) && $step) ? ' data-step="'.$step.'"' : '' ;
	$data .= (isset($angle_offset) && $angle_offset) ? ' data-angleoffset="'.$angle_offset.'"' : '' ;
	$data .= (isset($angle_arc) && $angle_arc) ? ' data-anglearc="'.$angle_arc.'"' : '' ;
	$data .= (isset($rotation) && $rotation) ? ' data-rotation="'.$rotation.'"' : '' ;
	$data .= (isset($cursor) && $cursor) ? ' data-cursor="'.$cursor.'"' : '' ;
	$data .= (isset($thickness) && $thickness) ? ' data-thickness="'.$thickness.'"' : '' ;
	$data .= (isset($line_cap) && $line_cap) ? ' data-linecap="'.$line_cap.'"' : '' ;
	$data .= (isset($width) && $width) ? ' data-width="'.$width.'" data-height="'.$width.'"' : '' ;
	$data .= (isset($fg_color) && $fg_color) ? ' data-fgcolor="'.$fg_color.'"' : '' ;
	$data .= (isset($counter_color) && $counter_color) ? ' data-inputcolor="'.$counter_color.'"' : '' ;
	$data .= (isset($bg_color) && $bg_color) ? ' data-bgcolor="'.$bg_color.'"' : '' ;

	$output = '<div class="progress-circle">
		<input class="knob'.$animated.'" type="text" data-readonly="true"'.$data.' />'
		.$title.
	'</div>';

	return $output;
}
add_shortcode( 'progress','display_progress_circle' );




/* =====================================================================
Shortcode: Iconbox
Author: Silviu Stefu
Description: Shortcodes to show features columns with icons
===================================================================== */

function display_iconbox( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'icon'			=> '',
		'url'			=> '',
		'link_target'	=> '',
		'button_label'	=> '', 
		'title'			=> '',
		'color'			=> '',
		'style'			=> '',
		'disable_box'	=> '',
	),$atts ) );

	$target = (isset($link_target) && $link_target == "blank") ? ' target="_blank"' : ' target="_self"';
	$anchor = (isset($url) && $url) ? '<a class="iconbox-more" href="'.$url.'"'.$target.'>'.$button_label.'</a>' : '' ;
	$color = (isset($color) && $color == "dark") ? ' iconbox-dark' : ' iconbox-light' ;
	$style = (isset($style) && $style == "left") ? ' iconbox-left' : ' iconbox-center' ;
	$disBox = (isset($disable_box) && $disable_box == "true") ? ' style="background:none; box-shadow:none;"' : '' ;

	$output = '<div class="iconbox'.$color.$style.'">
		<div class="iconbox-wrapper" '.$disBox.'>
			<div class="iconbox-icon"><i class="fa fa-'.$icon.'"></i></div>
			<div class="iconbox-content">
				<h3>'.$title.'</h3>
				<p>'.$content.'</p>'
				.$anchor.
			'</div>
		</div>
	</div>';

	return $output;
}
add_shortcode( 'iconbox','display_iconbox' );



/* =====================================================================
Shortcode: Separator
Author: Silviu Stefu
Description: Shortcodes to show features columns with icons
===================================================================== */

function display_separator( $atts ) {
	$atts = extract( shortcode_atts( array(
		'top'		=> '',
		'bottom'	=> '',
		'length'	=> '',
		'ornament'	=> '',
		'invisible'	=> '',
	),$atts ) );

	if ($top !== '' && $bottom == '') {
		$style = ' style="margin-top: '.$top.'px;"';
	} elseif ($top == '' && $bottom !== '') {
		$style = ' style="margin-bottom: '.$bottom.'px;"';
	} elseif ($top !== '' && $bottom !== '') {
		$style = ' style="margin-bottom: '.$bottom.'px; margin-top:'.$top.'px;"';
	}
	
	$length = (isset($length) && $length == "short") ? ' sep-short' : ' sep-long' ;
	$ornament = (isset($ornament) && $ornament == "yes") ? '<div class="sep-ornament"></div>' : '' ;
	$innerInv = (isset($invisible) && $invisible == "yes") ? ' sep-inner-invisible' : '' ;
	$sepInv = (isset($invisible) && $invisible == "yes") ? ' sep-invisible' : '' ;

	$output = '<div class="separator'.$sepInv.'"'.$style.'>
		<div class="sep-inner'.$length.$innerInv.'">'.$ornament.'</div>
	</div>';

	return $output;
}
add_shortcode( 'separator','display_separator' );



/* =====================================================================
Shortcode: Promobox
Author: Silviu Stefu
Description: Shortcodes to show features columns with icons
===================================================================== */

function display_promobox( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'title'			=> '',
		'style'			=> '',
		'url'			=> '',
		'link_target'	=> '',
		'button_label'	=> '',
		'fill_color'	=> '',
		'border_color'	=> '',
		'display_as'	=> '',
		'content_color'	=> '',
		'animated'		=> '',
	),$atts ) );

	// Prepare variables
	$title = ($title) ? '<h3>'.$title.'</h3>' : '' ;
	$link_target = ($link_target == "blank") ? ' target="_blank"' : '' ;
	$button = (isset($url) && $url) ? '<a href="'.$url.'" class="btn btn-big btn-gray"'.$link_target.'>'.$button_label.'</a>' : '' ;

	$noPadding = ( $border_color == "" && $fill_color == "") ? ' promobox-no-padding' : '' ;
	$border = ($border_color) ? ' style="border: 3px solid '.$border_color.';"' : '' ;
	if ( isset($fill_color) && $fill_color !== '' ) {
		$border = '';
		$fill = ' style="background: '.$fill_color.';"';
	}
	$style = (isset($style) && $style == "vertical") ? ' promobox-vertical' : '' ;
	$content_color = (isset($content_color) && $content_color == "light") ? ' promobox-light-content' : '' ;

	$animated = (isset($animated) && $animated) ? ' animated' : '' ;
	

	if (isset($display_as) && $display_as == "section") {
		$output = '<section class="promobox'.( (isset($animated)) ? $animated : '' ).( (isset($style)) ? $style : '' ).( (isset($content_color)) ? $content_color : '' ).'"'.( (isset($border)) ? $border : '' ).( (isset($fill)) ? $fill : '' ).'>
			<div class="container">
				<div class="row promobox-wrapper">
					<div class="col-md-9 promobox-content">'
						.$title.
						'<p>'.$content.'</p>
					</div>
					<div class="col-md-3 promobox-btn">'
						.$button.
					'</div>
				</div>
			</div>
		</section>';
	} else {
		$output = '<div class="promobox'.( (isset($animated)) ? $animated : '' ).( (isset($style)) ? $style : '' ).( (isset($content_color)) ? $content_color : '' ).( (isset($noPadding)) ? $noPadding : '' ).'"'.$border.( (isset($fill)) ? $fill : '' ).'>
			<div class="row promobox-wrapper">
				<div class="col-md-9 promobox-content">'
					.$title.
					'<p>'.$content.'</p>
				</div>
				<div class="col-md-3 promobox-btn">'
					.$button.
				'</div>
			</div>
		</div>';
	}
	
	return $output;
}
add_shortcode( 'promobox','display_promobox' );




/* =====================================================================
Shortcode: Pricing table
Author: Silviu Stefu
Description: Shortcodes to show features columns with icons
===================================================================== */

function display_pricing_column( $atts ) {
	$atts = extract( shortcode_atts( array(
		'plan'			=> '',
		'plan_color'	=> '',
		'price'			=> '',
		'currency'		=> '',
		'price_symbol'	=> '',
		'frequency'		=> '',
		'features'		=> '',
		'url'			=> '',
		'link_target'	=> '',
		'button_label'	=> '',
		'breakpoint'	=> 'md',
		'size'			=> '4',
		'featured'		=> 'no',
		'animated'		=> '',
	),$atts ) );

	$featured = (isset($featured) && $featured == "yes") ? ' pricing-featured' : '' ;
	$target = (isset($link_target) && $link_target == "blank") ? ' target="_blank"' : '' ;
	$button = (isset($url) && $url) ? '<li class="pricing-button"><a href="'.$url.'" class="btn btn-medium btn-darkblue btn-outline"'.$target.'>'.$button_label.'</a></li>' : '' ;
	if (isset($features) && $features) {
		$feat_arr = explode('-/-', $features);
		$feat_list = '';
		foreach ($feat_arr as $feature) {
			$feat_list .= '<li>'.$feature.'</li>';
		}
	}
	$plan_color = (isset($plan_color) && $plan_color !== "") ? ' style="background:'.$plan_color.'"' : '' ;
	$animated = (isset($animated) && $animated == "yes") ? ' animated' : '' ;

	$output = '<div class="col-'.$breakpoint.'-'.$size.'">
		<ul class="pricing-col'.$featured.$animated.'">
			<li class="pricing-plan"><h3>'.$plan.'</h3></li>
			<li class="pricing-price"'.$plan_color.'>
				<span class="pricing-symbol">'.$price_symbol.'</span>'
				.$price.
				'<span class="pricing-currency">'.$currency.'</span>
				<span class="pricing-frequency">'.$frequency.'</span>
			</li>'
			.$feat_list
			.$button.
		'</ul>
	</div>';

	return $output;
}
add_shortcode( 'pricing_col','display_pricing_column' );



/* =====================================================================
Shortcode: Dropcap
Author: Silviu Stefu
Description: Shortcodes to show features columns with icons
===================================================================== */
function display_dropcap($atts, $content = null) {
	$atts = extract( shortcode_atts( array(
		'color'	=> '',
	),$atts ) );

	$color = (isset($color) && !empty($color)) ? ' style=" color:'.$color.'"' : '' ;

	return '<span class="dropcap"'.$color.'>'.$content.'</span>';
}
add_shortcode('dropcap', 'display_dropcap');



/* =====================================================================
Shortcode: Emphasize
Author: Silviu Stefu
Description: Shortcodes to emphasize text
===================================================================== */
function display_emphasize($atts, $content = null) {
	$atts = extract( shortcode_atts( array(
		'color'	=> '',
		'bold'	=> '',
	),$atts ) );

	$color = (isset($color) && !empty($color)) ? ' style="color:'.$color.'"' : '' ;
	$bold = (isset($bold) && $bold == "yes") ? ' em-bold' : '' ;

	return '<em class="emphasize'.$bold.'"'.$color.'>'.$content.'</em>';
}
add_shortcode('emphasize', 'display_emphasize');



/* =====================================================================
Shortcode: Image slider
Author: Silviu Stefu
Description: Shortcodes to create responsive sliders
Since: CraftoWP v2.0
===================================================================== */
function display_image_slider( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'show_bullets'	=> '',
		'show_arrows'	=> '',
		'speed'			=> '',
		'extra_class'	=> '',
		'height'		=> '500',
		'autoplay'		=> '',
		'autospeed'		=> '',
		'transition'	=> ''
	),$atts ) );

	$bullets = (isset($show_bullets) && $show_bullets == "false") ? ' data-bullets="false"' : ' data-bullets="true"' ;
	$arrows = (isset($show_arrows) && $show_arrows == "false") ? ' data-arrows="false"' : ' data-arrows="true"' ;$infinite = (isset($infinite) && $infinite == "false") ? ' data-infinite="false"' : ' data-infinite="true"' ;
	$speed = (isset($speed) && $speed !== "") ? ' data-speed="'.$speed.'"' : ' data-speed="800"' ;
	$autoplay = (isset($autoplay) && $autoplay == "false") ? ' data-autoplay="false"' : ' data-autoplay="true"' ;
	$autospeed = (isset($autospeed) && $autospeed !== "") ? ' data-autospeed="'.$autospeed.'"' : ' data-autospeed="5000"' ;
	$transition = (isset($transition) && $transition == "fade") ? ' data-fade="true"' : ' data-fade="false"' ;
	$extra_class = (isset($extra_class) && $extra_class !== "") ? ' '.$extra_class : '' ;

			$output = '<div class="image-slider'.$extra_class.'" style="height: '.$height.'px;"'.$bullets.$arrows.$speed.$autoplay.$autospeed.$transition.'>'.do_shortcode($content).'</div>';

			return $output;
}
add_shortcode( 'image_slider','display_image_slider' );


function display_slider_item( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'background_image'			=> '',
		'background_color'			=> '',
		'background_repeat'			=> '',
		'background_position'		=> '',
		'background_attachment'		=> '',
		'content_color'				=> '',
		'fullwidth_content'			=> '',
		'overlay_color'				=> '',
		'overlay_opacity'			=> '',
		'animation'					=> '',
		'parallax'					=> '',
	),$atts ) );

	// Build the style
	$style = ' style="';
	$style .= (isset($background_image) && $background_image !== '') ? ' background-image: url('.$background_image.');' : '' ;
	$style .= (isset($background_color) && $background_color !== '') ? ' background-color: '.$background_color.';' : '' ;
	$style .= (isset($background_repeat) && $background_repeat !== '') ? ' background-repeat: '.$background_repeat.';' : ' background-repeat: no-repeat;' ;
	$style .= (isset($background_position) && $background_position !== '') ? ' background-position: '.$background_position.';' : ' background-position: top center;' ;
	$style .= (isset($background_attachment) && $background_attachment == 'fixed') ? ' background-attachment: fixed;' : (isset($parallax) && $parallax == 'true') ? ' background-attachment: fixed;' : ' background-attachment: scroll;' ;
	$style .= (isset($content_color) && $content_color !== '') ? ' color: '.$content_color.';' : '' ;
	$style .= '"';

	// Animation
	$animation = (isset($animation) && $animation !== '') ? ' data-animation="'.$animation.'"' : '' ;

	// Parallax
	$parallax = (isset($parallax) && $parallax == 'true') ? ' parallax' : '' ;

	// Build the overlay
	$ovOpacity = (! empty($overlay_opacity)) ? ' opacity: '.$overlay_opacity.'; -ms-filter: &quot;progid:DXImageTransform.Microsoft.Alpha(Opacity='.((! empty($overlay_opacity)) ? substr($overlay_opacity, 2).'0' : '40' ).')&quot; ;' : 'opacity: 0.4; -ms-filter: &quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=40)&quot; ; ' ;
	$overlay = (isset($overlay_color) && $overlay_color !== '') ? '<div class="slide-overlay" style="background-color: '.$overlay_color.';'.$ovOpacity.'"></div>' : '' ;

	$output = '<div class="slider-item'.$parallax.'"'.$style.'>
		'.$overlay.'
		<div class="slide-content"'.$animation.'>
			'.((isset($fullwidth_content) && $fullwidth_content !== 'true') ? '<div class="container">' : '' ).do_shortcode($content).((isset($fullwidth_content) && $fullwidth_content !== 'true') ? '</div>' : '' ).'
		</div>
	</div>';

	return $output;
}
add_shortcode( 'slide','display_slider_item' );



/* =====================================================================
Shortcode: Section
Author: Silviu Stefu
Description: Shortcodes to build page sections
Since: CraftoWP v2.0
===================================================================== */
function display_section( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'background_image'		=> '',
		'background_color'		=> '',
		'background_repeat'		=> '',
		'background_attachment'	=> '',
		'background_position'	=> '',
		'background_size'		=> '',
		'fullwidth_content'		=> '',
		'content_color'			=> '',
		'parallax'				=> '',
		'padding_top'			=> '90',
		'padding_bottom'		=> '90',
		'background_overlay'	=> '',
		'overlay_color'			=> '',
		'overlay_opacity'		=> '',
		'id'					=> '',
	),$atts ) );


	// Build the style
	$style = ' style="';
	$style .= (isset($background_image) && $background_image !== '') ? ' background-image: url('.$background_image.');' : '' ;
	$style .= (isset($background_color) && $background_color !== '') ? ' background-color: '.$background_color.';' : '' ;
	$style .= (isset($background_repeat) && $background_repeat !== '') ? ' background-repeat: '.$background_repeat.';' : ' background-repeat: no-repeat;' ;
	$style .= (isset($background_position) && $background_position !== '') ? ' background-position: '.$background_position.';' : ' background-position: top center;' ;
	$style .= (isset($background_size) && $background_size == 'cover') ? ' background-size: cover;' : ' background-size: auto' ;
	$style .= (isset($background_attachment) && $background_attachment == 'fixed') ? ' background-attachment: fixed;' : (isset($parallax) && $parallax == 'true') ? ' background-attachment: fixed;' : ' background-attachment: scroll;' ;
	$style .= (isset($content_color) && $content_color !== '') ? ' color: '.$content_color.';' : '' ;
	$style .= (isset($padding_top) && $padding_top !== '') ? ' padding-top: '.$padding_top.'px;' : '' ;
	$style .= (isset($padding_bottom) && $padding_bottom !== '') ? ' padding-bottom: '.$padding_bottom.'px;' : '' ;
	$style .= '"';

	// Parallax
	$parallax = (isset($parallax) && $parallax == 'true') ? ' parallax' : '' ;

	// Build the overlay
	$ovOpacity = (! empty($overlay_opacity)) ? ' opacity: '.$overlay_opacity.'; -ms-filter: &quot;progid:DXImageTransform.Microsoft.Alpha(Opacity='.((! empty($overlay_opacity)) ? substr($overlay_opacity, 2).'0' : '40' ).')&quot; ;' : 'opacity: 0.4; -ms-filter: &quot;progid:DXImageTransform.Microsoft.Alpha(Opacity=40)&quot; ; ' ;
	$overlay = (isset($overlay_color) && $overlay_color !== '') ? '<div class="crafto-section-overlay" style="background-color: '.$overlay_color.';'.$ovOpacity.'"></div>' : '' ;

	$output = '<section '.((isset($id) && $id !== '') ? 'id="'.$id.'"' : '').' class="crafto-section'.$parallax.'"'.$style.'">
		'.$overlay.'
		'.((isset($fullwidth_content) && $fullwidth_content !== 'true') ? '<div class="container">' : '' ).'
			<div class="crafto-section-content">
				'.do_shortcode( $content ).'
			</div>
		'.((isset($fullwidth_content) && $fullwidth_content !== 'true') ? '</div>' : '' ).'
	</section>';

	return $output;
}
add_shortcode( 'cf_section','display_section' );



/* =====================================================================
Shortcode: Special title
Author: Silviu Stefu
Description: Shortcodes to display the headings as special titles
Since: CraftoWP v2.0
===================================================================== */
function display_special_title( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
		'color'				=> '#444',
		'heading'			=> 'h2',
		'align'				=> '',
		'padding_top'		=> '',
		'padding_bottom'	=> '',
	),$atts ) );

	// Style container
	$sc = 'style="';
	$sc .= ($align) ? 'text-align:'.$align.';' : '' ;
	$sc .= ($padding_top) ? ' padding-top:'.$padding_top.'px;' : ' padding-top: 0px;' ;
	$sc .= ($padding_bottom) ? ' padding-bottom:'.$padding_bottom.'px;' : ' padding-bottom: 0px;' ;
	$sc .= '"';

	// Style heading
	$style = 'style="';
	$style .= ($color) ? 'color: '.$color.';' : '' ;
	$style .= ($color) ? 'border-color: '.$color.';' : '' ;
	$style .= '"';

	$output = '<div class="special-heading-container" '.$sc.' '.(($color) ? 'data-color="'.$color.'"' : '' ).'>
		<'.$heading.' class="special-heading" '.$style.'>'.$content.'</'.$heading.'>
	</div>';

	return $output;
}
add_shortcode( 'special_title','display_special_title' );



/* =====================================================================
Shortcode: Tagline
Author: Silviu Stefu
Description: Shortcodes to display the tagline
Since: CraftoWP v2.2
===================================================================== */
function display_tagline( $atts, $content = null  ) {
	$atts = extract( shortcode_atts( array(
		'align'			=> '', //left, center, right
		'margin_top'	=> '', //number
		'margin_bottom'	=> '', //number
		'font_weight'	=> '', //300, 400, 500, 600, 700, 800
	), $atts ) );

	// Prepare styles
	$style = ' style="';
	$style .= (isset($align) && $align !== '') ? 'text-align: '.$align.';' : '' ;
	$style .= (isset($margin_top) && $margin_top !== '') ? ' margin-top: '.$margin_top.'px;' : '' ;
	$style .= (isset($margin_bottom) && $margin_bottom !== '') ? ' margin-bottom: '.$margin_bottom.'px;' : '' ;
	$style .= (isset($font_weight) && $font_weight !== '') ? ' font-weight: '.$font_weight.';' : '' ;
	$style .= '"';

	$output = '<div class="tagline"'.$style.'>'.$content.'</div>';

	return $output;
}
add_shortcode( 'tagline','display_tagline' );

?>