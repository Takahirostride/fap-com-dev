<?php

/* Include some external files */
include_once('includes/theme-setup.php');
include_once('includes/portfolio-type.php');
include_once('includes/testimonial-type.php');
include_once('includes/tinymce-plugin.php');
require_once('includes/class-tgm-plugin-activation.php');

function get_the_content_by_id($post_id) {
  $page_data = get_page($post_id);
  if ($page_data) {
    return $page_data->post_content;
  }
  else return false;
}


/* ----------------------------- Option Tree filters ----------------------------- */


//ショートコードを使ったphpファイルの呼び出し方法
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}
add_shortcode('myphp', 'Include_my_php');

//サイト内検索　投稿記事（除外カテゴリ以外）のみ対象
function SearchFilter($query) {
	if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
		$query->set('post_type', 'post');
        $query->set('category__not_in', array(17,12));//カテゴリーIDを指定
	}
	return $query;
}
add_filter('pre_get_posts','SearchFilter');

//サムネイル変更
//if ( function_exists( 'add_image_size' ) ) { 
	//add_image_size( 'article-thumb', 735, 460, true ); //(切り抜かれた大きさ)
//}

/* =================================================================================
Show only image upload, color field and background repeat fields on Background Option
================================================================================== */
function filter_background_fields( $array, $field_id ) {
	if ( $field_id == "home_background" || $field_id == 'footer_background' || $field_id == 'custom_page_background')  {
		$array = array( 'background-color', 'background-image', 'background-repeat');
	}
	return $array;
}
add_filter( 'ot_recognized_background_fields', 'filter_background_fields', 10, 2 );




/* ----------------------------- Other Functions ----------------------------- */


/* =================================================================================
Social icons rendering
================================================================================== */
function insertSocialIcons( $type = "dark-icons" ) {
	if ( function_exists( 'ot_get_option' ) ) {
		$social_links = ot_get_option( 'social_profiles' );
	}

	echo '<div class="social-icons '.$type.'">';
	if ($social_links != "") {
		foreach ($social_links as $key => $values) {
			$the_urls = array($values['profile_url']);
			$social_profile = array($values['social_profile']);
			$the_titles = array($values['title']);

			foreach ($the_urls as $index => $url) {
				echo '<a class="icon-social" href="'.$url.'" target="_blank"><i class="fa '.$social_profile[$index].'"></i></a>';
			}
		}
	}
	echo '</div>';
}



/* =================================================================================
Custom Bakcground CSS
================================================================================== */
function custom_bg_section( $section ) {

	if ( function_exists( 'ot_get_option' ) && ot_get_option( $section ) != '') {
		$background = ot_get_option( $section );
		$color = $background['background-color'];
		$image = $background['background-image'];
		$repeat = $background['background-repeat'];
	}

	$output = '';

	if ($image) {
		$output .= "background-image: url($image);\nbackground-repeat:$repeat;\n";
	} elseif ($background['background-color']){
		$output .= "background-color:$color;\nbackground-image:none;\n";
	} else {
		return;
	}

	if ($output <> '') {
		echo $output;
		}
}


/* =================================================================================
Get categories for custom post types
================================================================================== */
function get_the_category_bytax( $id = false, $tcat = 'category' ) {
	$categories = get_the_terms( $id, $tcat );
	if ( ! $categories )
		$categories = array();
		$categories = array_values( $categories );

		foreach ( array_keys( $categories ) as $key ) {
			_make_cat_compat( $categories[$key] );
		}

// Filter name is plural because we return alot of categories (possibly more than #13237) not just one
return apply_filters( 'get_the_categories', $categories );
}


/* =================================================================================
Limit post excerpts. Within theme files used as print string_limit_words(get_the_excerpt(), 20);
================================================================================== */
function string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}


/* =============================================================================
	Include the Option-Tree Google Fonts Plugin
	========================================================================== */
// load the ot-google-fonts plugin if the loader class is available
if( class_exists( 'OT_Loader' ) ):

	global $ot_options;
	
	$ot_options = get_option( 'option_tree' );
	if ( ! empty($ot_options)) {
		$fonts_api = ((isset($ot_options['fonts_api'])) ? $ot_options['fonts_api'] : '' );
	}

	// default fonts used in this theme, even though there are no google fonts
	$default_theme_fonts = array(
		'arial' => 'Arial, Helvetica, sans-serif',
		'helvetica' => 'Helvetica, Arial, sans-serif',
		'georgia' => 'Georgia, "Times New Roman", Times, serif',
		'tahoma' => 'Tahoma, Geneva, sans-serif',
		'times' => '"Times New Roman", Times, serif',
		'trebuchet' => '"Trebuchet MS", Arial, Helvetica, sans-serif',
		'verdana' => 'Verdana, Geneva, sans-serif',
	);

	defined('OT_FONT_DEFAULTS') or define('OT_FONT_DEFAULTS', serialize($default_theme_fonts));
	defined('OT_FONT_API_KEY') or define('OT_FONT_API_KEY', (isset($fonts_api) && $fonts_api !== '') ? $fonts_api : '' ); // enter your own Google Font API key here
	defined('OT_FONT_CACHE_INTERVAL') or define('OT_FONT_CACHE_INTERVAL', 0); // Checking once a week for new Fonts. The time interval for the remote XML cache in the database (21600 seconds = 6 hours)

	// get the OT-Google-Font plugin file
	include_once( get_template_directory().'/option-tree-google-fonts/ot-google-fonts.php' );

	// get the google font array - build in ot-google-fonts.php
	$google_font_array = ot_get_google_font(OT_FONT_API_KEY, OT_FONT_CACHE_INTERVAL);

	// Now apply the fonts to the font dropdowns in theme options with the build in OptionTree hook
	function ot_filter_recognized_font_families( $array, $field_id ) {

		global $google_font_array;

		// loop through the cached google font array if available and append to default fonts
		$font_array = array();
		if($google_font_array){
				foreach($google_font_array as $index => $value){
						$font_array[$index] = $value['family'];
				}
		}

		// put both arrays together
		$array = array_merge(unserialize(OT_FONT_DEFAULTS), $font_array);

		return $array;

	}
	add_filter( 'ot_recognized_font_families', 'ot_filter_recognized_font_families', 1, 2 );

endif;

remove_action( 'admin_notices', 'notice_new_fonts_added', 99);
remove_action( 'admin_notices', 'msg_no_connection_possible', 99);



/* This function creates the pagination */
if ( ! function_exists( 'craftowp_pagination' ) ) :

function craftowp_pagination($pages = '', $range = 2) {

	$showitems = ($range * 2)+1;  

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
		 $pages = 1;
		}
	}

	if(1 != $pages) {
		echo "<div class='pagination'>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

		for ($i=1; $i <= $pages; $i++) { 
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
			}
		}

		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</div>\n";
	}
}
endif;




/* =============================================================================
	Include the TGM_Plugin_Activation class
	========================================================================== */

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		/** This is an example of how to include a plugin from the WordPress Plugin Repository */
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
		),
		array(
			'name' => 'Really Simple Captcha',
			'slug' => 'really-simple-captcha',
		),
	);

	$theme_text_domain = 'craftowp';

	/**
	 * Array of configuration settings. Uncomment and amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * uncomment the strings and domain.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       => $theme_text_domain,         // Text domain - likely want to be the same as your theme.
		'default_path' => '',                         // Default absolute path to pre-packaged plugins
		'menu'         => 'install-craftowp-plugins', // Menu slug
		'strings'      	 => array(
			'page_title'             => __( 'Install Required Plugins', $theme_text_domain ), 
			'menu_title'             => __( 'Install Plugins', $theme_text_domain ),
			'instructions_install'   => __( 'The %1$s plugin is required for this theme. Click on the big blue button below to install and activate %1$s.', $theme_text_domain ), // %1$s = plugin name 
			'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', $theme_text_domain ), // %1$s = plugin name, %2$s = plugins page URL 
			'button'                 => __( 'Install %s Now', $theme_text_domain ), // %1$s = plugin name
			'installing'             => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                   => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install'     => __( 'This theme requires the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', $theme_text_domain ), // %1$s = plugin name, %2$s = TGMPA page URL 
			'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', $theme_text_domain ), // %1$s = plugin name
			'notice_can_activate'    => __( 'This theme requires the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', $theme_text_domain ), // %1$s = plugin name, %2$s = plugins page URL
			'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', $theme_text_domain ), // %1$s = plugin name
			'return'                 => __( 'Return to Required Plugins Installer', $theme_text_domain ),
		),
	);

	tgmpa( $plugins, $config );

}



/* =============================================================================
	Hide Url field on comments 
	========================================================================== */
add_filter('comment_form_default_fields', 'craftowp_remove_url');
function craftowp_remove_url($arg) {
	$arg['url'] = '';
	return $arg;
}



/* =============================================================================
	Print the Comments. This is the function called from comments.php 
	========================================================================== */
if ( ! function_exists( 'craftowp_comment' ) ) :

	function craftowp_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="comment-author vcard">
					<?php printf( __( '%s %ssays:%s', 'craftowp' ), sprintf( '<i class="fa fa-user"></i><cite class="fn">%s</cite>', get_comment_author_link() ), '<span class="says">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<div class="comment-meta commentmetadata">
					<?php
						$comm_date = get_comment_date('F jS, Y');
						echo '<span class="comment-date"><i class="fa fa-calendar"></i>'.$comm_date.'</span>';
						echo edit_comment_link( __( 'Edit comment', 'craftowp' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation">
						<i class="fa fa-exclamation"></i>
						<?php _e( 'Your comment is awaiting moderation.', 'craftowp' ); ?>
					</em>
					<br />
				<?php endif; ?>

				<div class="comment-body"><?php comment_text(); ?></div>

			</div><!-- #comment-##  -->

		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'craftowp' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'craftowp' ), ' ' ); ?></p>
		<?php
				break;
		endswitch;
	}

endif;



/* =============================================================================
	Adds gallery shortcode defaults of size="medium" and columns="2" 
	========================================================================== */
function amethyst_gallery_atts( $out, $pairs, $atts ) {
   
    $atts = shortcode_atts( array(
        'size' => 'medium',
         ), $atts );
    $out['size'] = $atts['size'];

    return $out;

}
add_filter( 'shortcode_atts_gallery', 'amethyst_gallery_atts', 10, 3 );



/* =============================================================================
	Add rel attribute to gallery for lightbox
	========================================================================== */
function rc_add_rel_attribute($link) {
	global $post;
	return str_replace('<a href', '<a rel="prettyPhoto[craftowp_gal]" href', $link);
}
add_filter('wp_get_attachment_link', 'rc_add_rel_attribute');



/* =============================================================================
	Get Youtube and Vimeo video ID from link
	========================================================================== */
function video_id_from_link($url) {
	preg_match('/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\">]+)/', $url, $matches_y);
	preg_match('/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/', $url, $matches_v);
	if (isset($matches_y[1]) && $matches_y[1] !== '') {
		return 'y_'.$matches_y[1];
	} else if (isset($matches_v[2]) && $matches_v[2] !== '') {
		return 'v_'.$matches_v[2];
	} else {
		return;
	}
}



/* =============================================================================
	Get the Post ID from attached image
	========================================================================== */
function pixelglow_get_attachment_id( $attachment_url = '' ) {
	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url )
		return;

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif|webp)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}


//-----------------------------------------------------
// WordPress Importer Filter
// Helper function to clean up data from XML
// 1) Update the domain URL from the source to the local
// 2) Watch out for serialized data with line breaks!
//----------------------------------------------------- 

add_filter( 'wp_import_post_meta', 'themo_import_post_meta', 10, 3 );

function themo_import_post_meta( $postmeta, $post_id, $post ) {

    // Sometimes you want to import files from a source domain. If we do this, we need to replace the URL in the meta data.
    $find = 'http://www.picseel.com/themes/craftowp-v2.2/wp-content/uploads'; // Search url
    $upload_dir = wp_upload_dir(); // Replace URL
    $replace = $upload_dir['baseurl']; // upload url of the local site.

    // Watch out for newlines inside of serialized data when importing from XML, they will break the import.
    // I've found that the XML leaves a discrepancy of how many chars are in the serialized string. I add 1 extra for each line break.
    $find2 = "\n"; // look for newline
    $replace2 = "\n "; // replace newline + 1 extra char (Hack you say? Yes I am aware.)

    // Multidimensional array loop
    foreach ($postmeta as $key => $value){
        foreach ($value as $sub_key => $sub_value){

            // If this is serialized data we need to unserialize to find / replace.
            if (is_serialized($sub_value)){
                $reserialize = true;
                $sub_value = str_replace($find2, $replace2, $sub_value); // Clean up
                $sub_value = unserialize($sub_value); // unserialize
            }else{
                $reserialize = false;
            }

            $sub_value  = str_replace($find, $replace, $sub_value); // Find / replace value 1

            if(is_array($sub_value)){ // We may nned to go even deeper...

                foreach ($sub_value as $sub_sub_key => $sub_sub_value){                         

                    $sub_value[$sub_sub_key] = str_replace($find, $replace, $sub_sub_value); // Find and replace value 1
                    $sub_value[$sub_sub_key] = str_replace($find2, $replace2, $sub_value[$sub_sub_key]); // Find and replace value 2

                    if(is_array($sub_sub_value)){ // We may nned to go even DEEPER..!
                        foreach ($sub_sub_value as $sub_sub_sub_key => $sub_sub_sub_value){

                            $sub_value[$sub_sub_key][$sub_sub_sub_key]  = str_replace($find, $replace, $sub_sub_sub_value); // Find and replace value 1
                            $sub_value[$sub_sub_key][$sub_sub_sub_key] = str_replace($find2, $replace2, $sub_value[$sub_sub_key][$sub_sub_sub_key]); // Find and replace value 2


                        }
                    }                   
                }
            }

            // If we unserialized then serialize back up again.
            if($reserialize){
                $value[$sub_key] = serialize($sub_value);
            }else{
                $value[$sub_key] = $sub_value;
            }
        }
        $postmeta[$key] = $value;
    }

    return $postmeta;
}



/* =============================================================================
	Custom WPML language switcher - since CraftoWP v2.2
	========================================================================== */
if (!function_exists('language_selector_flags')) {
	function language_selector_flags($type){
		if (function_exists('icl_get_languages')) {
			$languages = icl_get_languages('skip_missing=0&orderby=code');
			if(!empty($languages)){
				echo '<div class="languages">';
					foreach ($languages as $lang) {
						if($lang['active'] == 1) {
							echo '<span class="current-language">'.((isset($type) && $type == 'code') ? $lang['language_code'] : '<img src="'.$lang['country_flag_url'].'" alt="'.$lang['language_code'].'" >' ).'</span>';
						}
					}
					echo '<ul class="language-choices">';
					foreach($languages as $l){
						if(!$l['active'] && $type == 'code') {
							echo '<li><a class="language-inactive" href="'.$l['url'].'">'.$l['language_code'].'</a></li>';
						} else if (!$l['active'] && $type == 'flag') {
							echo '<li><a class="language-inactive" href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" alt="'.$l['language_code'].'" /></a></li>';
						}
					}
					echo '</ul>';
				echo '</div>';
			}	
		}
	}
}


include_once('includes/shortcodes.php');


?>