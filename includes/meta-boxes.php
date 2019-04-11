<?php 
/**
 * Initialize the meta boxes. 
 */

/* =================================================================================
Meta boxes for portfolio post type
================================================================================== */
function portfolio_meta_boxes() {

	$upload_portfolio = array(
		'id'        => 'upload_images',
		'title'     => 'Gallery Images',
		'desc'      => '',
		'pages'     => array( 'portfolio' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'portfolio_images',
				'label'       => __('Portfolio Images', 'craftowp'),
				'desc'        => __('Add your portfolio images for displaying in gallery. The final size will be 750 x 440 px, so be shure to upload bigger images.', 'craftowp'),
				'std'         => '',
				'type'        => 'list-item',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'settings'    => array( 
					array(
						'id'          => 'upload_portfolio_image',
						'label'       => __('Upload image', 'craftowp'),
						'desc'        => '',
						'std'         => '',
						'type'        => 'upload',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => ''
					)
				)
			),
			array(
				'id'          => 'portfolio_video',
				'label'       => __('Video link', 'craftowp'),
				'desc'        => __('Add Youtube or Vimeo link for your portfolio post. Please do not add any embed code. The URL is enough.', 'craftowp'),
				'std'         => '',
				'type'        => 'text',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'show_video',
				'label'       => __('Show video on portfolio post', 'craftowp'),
				'desc'        => __('Check this if you want to show the video instead of portfolio featured image/slider', 'craftowp'),
				'std'         => 'false',
				'type'        => 'radio',
				'class'       => '',
				'choices'     => array( 
					array(
						'value'       => 'true',
						'label'       => __( 'Yes', 'craftowp' ),
						'src'         => ''
					),
					array(
						'value'       => 'false',
						'label'       => __( 'No', 'craftowp' ),
						'src'         => ''
					)
		        )
			),
		)
	);
	ot_register_meta_box( $upload_portfolio );
}
add_action( 'admin_init', 'portfolio_meta_boxes' );


/* =================================================================================
Meta boxes for pages
================================================================================== */
function page_meta_boxes() {

	$page_options = array(
		'id'        => 'custom_page_meta',
		'title'     => __('Page options', 'craftowp'),
		'desc'      => __('This will set the background and content color for this page. Keep in mind that these options will take effect only if this page will be displayed as section on the home page.', 'craftowp'),
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'custom_page_title',
				'label'       => __('Custom page title', 'craftowp'),
				'desc'        => __('Set a custom title for this page. This title will be visible on home page if you choose to show this page as a section on home page. If you leave this field blanc, the page title will be used.', 'craftowp'),
				'std'         => '',
				'type'        => 'text',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'activate_special_heading',
				'label'       => __('Activate special heading', 'craftowp'),
				'desc'        => __('Activate the special header page/home section title.', 'craftowp'),
				'std'         => 'on',
				'type'        => 'on-off',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'show_page_title',
				'label'       => __('Show/Hide page title', 'craftowp'),
				'desc'        => __('Choose whether to show or hide the page title when the page is displayed on home.', 'craftowp'),
				'std'         => 'on',
				'type'        => 'on-off',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'page_tagline',
				'label'       => __('Page tagline', 'craftowp'),
				'desc'        => __('This is the tagline/description of your page/section. If you fill this field will be displayed under section title.', 'craftowp'),
				'std'         => '',
				'type'        => 'text',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'page_content_color',
				'label'       => __('Content color', 'craftowp'),
				'desc'        => __('Choose the content color according to your background.', 'craftowp'),
				'std'         => 'dark',
				'type'        => 'radio',
				'class'       => '',
				'choices'     => array( 
					array(
						'value'       => 'dark',
						'label'       => __('Dark', 'craftowp'),
						'src'         => ''
					),
					array(
						'value'       => 'light',
						'label'       => __('Light', 'craftowp'),
						'src'         => ''
					)
				)
			),
			array(
				'id'          => 'custom_page_background',
				'label'       => __('Page Background', 'craftowp'),
				'desc'        => __('Set the background for your page.', 'craftowp'),
				'std'         => '',
				'type'        => 'background',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'activate_page_parallax',
				'label'       => __('Parallax effect on background image', 'craftowp'),
				'desc'        => __('If you choose to have an image as section background, you can add parallax effect on it.', 'craftowp'),
				'std'         => 'off',
				'type'        => 'on-off',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'activate_page_overlay',
				'label'       => __('Activate overlay', 'craftowp'),
				'desc'        => __('Add a color layer over the background. You can set the color and transparency below. Default color is #444', 'craftowp'),
				'std'         => 'off',
				'type'        => 'on-off',
				'class'       => '',
				'choices'     => array()
			),
			array(
				'id'          => 'page_overlay_color',
				'label'       => __('Overlay color', 'craftowp'),
				'desc'        => __('Here you can set the color of your overlay', 'craftowp'),
				'std'         => '',
				'type'        => 'colorpicker',
				'class'       => '',
			),
			array(
				'id'          => 'page_overlay_opacity',
				'label'       => __('Overlay opacity', 'craftowp'),
				'desc'        => __('Here you can set the opacity of your overlay', 'craftowp'),
				'std'         => '0.1',
				'type'        => 'numeric-slider',
				'min_max_step'=> '0,1,0.1',
				'class'       => ''
			),
			array(
				'id'          => 'page_content_width',
				'label'       => __('Page content width', 'craftowp'),
				'desc'        => __('Choose the page width. e.g. - choose Full Width for map page.', 'craftowp'),
				'std'         => 'paged',
				'type'        => 'radio',
				'class'       => '',
				'choices'     => array( 
					array(
						'value'       => 'paged',
						'label'       => __('Paged', 'craftowp'),
						'src'         => ''
					),
					array(
						'value'       => 'full_width',
						'label'       => __('Full Width', 'craftowp'),
						'src'         => ''
					)
				)
			),
			array(
				'id'          => 'page_padding',
				'label'       => __('Deactivate section padding', 'craftowp'),
				'desc'        => __('This is removing the page/section padding so you will have a full height content.', 'craftowp'),
				'std'         => 'no',
				'type'        => 'radio',
				'class'       => '',
				'choices'     => array( 
					array(
						'value'       => 'yes',
						'label'       => __('Yes', 'craftowp'),
						'src'         => ''
					),
					array(
						'value'       => 'no',
						'label'       => __('No', 'craftowp'),
						'src'         => ''
					)
				)
			)
		)
	);

	$post_id = (isset($_GET['post'])) ? $_GET['post'] : ((isset($_POST['post_ID'])) ? $_POST['post_ID'] : false);
	if ($post_id) { 
		$template_file = get_post_meta($post_id, '_wp_page_template', true);
		if ($template_file !== 'template-builder.php') {
			ot_register_meta_box( $page_options );
		}
	}
}
add_action( 'admin_init', 'page_meta_boxes' );



/* =================================================================================
Meta boxes for blog posts (header options)
================================================================================== */
function blog_meta_boxes() {

$post_options = array(
	'id'        => 'custom_post_meta',
	'title'     => __('Post options', 'craftowp'),
	'desc'      => __('Using these options you can set the post title style. These styles will be visible only on blog loop page.', 'craftowp'),
	'pages'     => array( 'post' ),
	'context'   => 'normal',
	'priority'  => 'high',
	'fields'    => array(
		array(
			'id'          => 'activate_special_heading_post',
			'label'       => __('Activate special heading', 'craftowp'),
			'desc'        => __('Activate the special title on post.', 'craftowp'),
			'std'         => 'off',
			'type'        => 'on-off',
			'class'       => '',
			'choices'     => array()
		),
		array(
			'id'          => 'tagline_post',
			'label'       => __('Post tagline', 'craftowp'),
			'desc'        => __('This is the tagline/description of your post. If you fill this field will be displayed under post title.', 'craftowp'),
			'std'         => '',
			'type'        => 'text',
			'class'       => '',
			'choices'     => array()
		),
		array(
			'id'          => 'activate_title_background',
			'label'       => __('Title background', 'craftowp'),
			'desc'        => __('Add a color layer under the title and tagline. Default color is #444', 'craftowp'),
			'std'         => 'off',
			'type'        => 'on-off',
			'class'       => '',
			'choices'     => array()
		),
		array(
			'id'          => 'title_background_color',
			'label'       => __('Title background color', 'craftowp'),
			'desc'        => __('Set a custom color for title background', 'craftowp'),
			'std'         => '',
			'type'        => 'colorpicker',
			'class'       => '',
			'choices'     => array()
		)
	)
);

ot_register_meta_box( $post_options );
}
add_action( 'admin_init', 'blog_meta_boxes' );


/* =================================================================================
Meta boxes for blog posts (slider)
================================================================================== */
function blog_post_slider() {

	$blog_post_slider = array(
		'id'        => 'custom_post_metas',
		'title'     => __('Post slider', 'craftowp'),
		'desc'      => __('If you want to use a slider to show more images instead of post featured image, just add some images here.', 'craftowp'),
		'pages'     => array( 'post' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'blog_post_slides',
				'label'       => __('Blog post slider images', 'craftowp'),
				'desc'        => __('Just add images to your slider. The Title field will be visible only for you.', 'craftowp'),
				'std'         => '',
				'type'        => 'list-item',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'class'       => '',
				'settings'    => array( 
					array(
						'id'          => 'upload_blog_image',
						'label'       => __('Upload image', 'craftowp'),
						'desc'        => '',
						'std'         => '',
						'type'        => 'upload',
						'rows'        => '',
						'post_type'   => '',
						'taxonomy'    => '',
						'class'       => ''
					)
				)
			),
			array(
				'id'          => 'activate_lightbox_blog_post',
				'label'       => __('Activate lightbox', 'craftowp'),
				'desc'        => __('This will activate the lightbox on your slider.', 'craftowp'),
				'std'         => 'off',
				'type'        => 'on-off',
				'class'       => '',
				'choices'     => array()
			)
		)
	);

ot_register_meta_box( $blog_post_slider );
}
add_action( 'admin_init', 'blog_post_slider' );



/* =================================================================================
Meta Boxes for Generic Template page
The options will not appear until after the first post save.
================================================================================== */
function builder_template_options() {

	$builder_template_options = array(
		'id'        => 'generic_template_options',
		'title'     => __('Add sections to your layout', 'craftowp'),
		'desc'      => __('Use these options only on Builder Page Template', 'craftowp'),
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
				'id'          => 'deactivate_builder',
				'label'       => __( 'Deactivate Page Builder', 'craftowp' ),
				'desc'        => __( 'Choose to deactivate de Page Builder and build the page by shortcodes', 'craftowp' ),
				'std'         => 'active',
				'type'        => 'radio',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and',
				'choices'     => array( 
					array(
						'value'       => 'active',
						'label'       => __( 'Active', 'craftowp' ),
						'src'         => ''
					),
					array(
						'value'       => 'inactive',
						'label'       => __( 'Inactive', 'craftowp' ),
						'src'         => ''
					)
				)
			),
			array(
				'id'          => 'builder_sections',
				'label'       => __( 'Pages on Home', 'craftowp' ),
				'desc'        => __( 'Choose the pages that you want to show on home page as section. These options will create a one-page layout.', 'craftowp' ),
				'std'         => '',
				'type'        => 'list-item',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and',
				'settings'    => array( 
					array(
						'id'          => 'builder_section_page',
						'label'       => __( 'Choose page', 'craftowp' ),
						'desc'        => __( 'Choose the already created page you want to show on home page.', 'craftowp' ),
						'std'         => '',
						'type'        => 'page-select',
						'min_max_step'=> '',
						'class'       => '',
						'condition'   => '',
						'operator'    => 'and'
					),
					array(
						'id'          => 'builder_section_id',
						'label'       => __( 'Section ID', 'craftowp' ),
						'desc'        => __( 'Only if you need it. A unique lower case alphanumeric string, underscores allowed.', 'craftowp' ),
						'std'         => '',
						'type'        => 'text',
						'min_max_step'=> '',
						'class'       => '',
						'condition'   => '',
						'operator'    => 'and'
					)
				)
			)
		)
	);

	$post_id = (isset($_GET['post'])) ? $_GET['post'] : ((isset($_POST['post_ID'])) ? $_POST['post_ID'] : false);
	if ($post_id) { 
		$template_file = get_post_meta($post_id, '_wp_page_template', true);
		if ($template_file == 'template-builder.php') {
			ot_register_meta_box( $builder_template_options );
		}
	}
}
add_action( 'admin_init', 'builder_template_options' );

?>