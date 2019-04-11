<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general_settings',
        'title'       => __( 'General Settings', 'craftowp' )
      ),
      array(
        'id'          => 'loader_screen',
        'title'       => __( 'Loader Screen', 'craftowp' )
      ),
      array(
        'id'          => 'home_sections',
        'title'       => __( 'Home Sections', 'craftowp' )
      ),
      array(
        'id'          => 'menus',
        'title'       => __( 'Menus', 'craftowp' )
      ),
      array(
        'id'          => 'welcome_screen',
        'title'       => __( 'Welcome Screen', 'craftowp' )
      ),
      array(
        'id'          => 'footer_section',
        'title'       => __( 'Footer', 'craftowp' )
      ),
      array(
        'id'          => 'fonts',
        'title'       => __( 'Fonts', 'craftowp' )
      ),
      array(
        'id'          => 'social_links_general',
        'title'       => __( 'Social Links', 'craftowp' )
      ),
      array(
        'id'          => 'colors',
        'title'       => __( 'Colors', 'craftowp' )
      ),
      array(
        'id'          => 'custom_css',
        'title'       => __( 'Custom CSS', 'craftowp' )
      )
    ),
    'settings'        => array(
      array(
        'id'          => 'logo_upload',
        'label'       => __( 'Logo Upload', 'craftowp' ),
        'desc'        => __( 'This is the main logo of your website. Will be displayed on the left side of the menu bar on top.', 'craftowp' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'white_logo_upload',
        'label'       => __( 'White Logo Upload', 'craftowp' ),
        'desc'        => __( 'This is the version of the logo wich will be displayed on dark background. Yoo can choose bellow wich version to show.', 'craftowp' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'choose_logo',
        'label'       => __( 'Choose wich logo to display', 'craftowp' ),
        'desc'        => __( 'Please choose wich logo should be shown on your header. Please take in account your image choice for welcome screen background and menu style choice (white or black).', 'craftowp' ),
        'std'         => 'white_logo',
        'type'        => 'radio',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'normal_logo',
            'label'       => __( 'Normal logo', 'craftowp' ),
            'src'         => ''
          ),
          array(
            'value'       => 'white_logo',
            'label'       => __( 'White logo', 'craftowp' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'favicon_ico_upload',
        'label'       => __( 'Favicon upload (.ico)', 'craftowp' ),
        'desc'        => __( 'Use this field to upload your favicon in .ico format (16x16 px)', 'craftowp' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'favicon_png_upload',
        'label'       => __( 'Favicon upload (.png)', 'craftowp' ),
        'desc'        => __( 'Use this field to upload your favicon in .png format (16x16 px)', 'craftowp' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'apple_touch_icon',
        'label'       => __( 'Apple Touch Icon (.png)', 'craftowp' ),
        'desc'        => __( 'Use this field to upload the Apple touch icon in .png format (152x152 px)', 'craftowp' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tile_image',
        'label'       => __( 'Windows 8 Tile Image (.png)', 'craftowp' ),
        'desc'        => __( 'Use this field to upload the Windows 8 Tile Icon icon in .png format (144x144 px)', 'craftowp' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'tile_color',
        'label'       => __( 'Windows 8 Tile Color', 'craftowp' ),
        'desc'        => __( 'Use this field to choose the color for the Windows 8 Tile.', 'craftowp' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general_settings',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'activate_loader',
        'label'       => __( 'Activate loader screen', 'craftowp' ),
        'desc'        => __( 'Use this option to show/hide the splash screen shown while the website is loading.', 'craftowp' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'loader_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'spinner_type',
        'label'       => __( 'Spinner Type', 'craftowp' ),
        'desc'        => __( 'Choose the spinner', 'craftowp' ),
        'std'         => 'spinner1',
        'type'        => 'radio-image',
        'section'     => 'loader_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'activate_loader:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'loader_background',
        'label'       => __( 'Loader screen background', 'craftowp' ),
        'desc'        => __( 'Choose the background for your loading screen.', 'craftowp' ),
        'std'         => '#FFFFFF',
        'type'        => 'colorpicker',
        'section'     => 'loader_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'activate_loader:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'spinner_color',
        'label'       => __( 'Spinner color', 'craftowp' ),
        'desc'        => __( 'Choose the color for the choosen spinner.', 'craftowp' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'loader_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'activate_loader:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'activate_loader_inner',
        'label'       => __( 'Activate loader screen for inner pages', 'craftowp' ),
        'desc'        => __( 'This option will show/hide the loading screen on inner pages too.', 'craftowp' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'loader_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'activate_loader:is(on)',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'pages_on_home',
        'label'       => __( 'Pages on Home', 'craftowp' ),
        'desc'        => __( 'Choose the pages that you want to show on home page as section. These options will create a one-page layout.', 'craftowp' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'home_sections',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'home_section_page',
            'label'       => __( 'Choose page', 'craftowp' ),
            'desc'        => __( 'Choose the already created page you want to show on home page.', 'craftowp' ),
            'std'         => '',
            'type'        => 'page-select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'home_section_id',
            'label'       => __( 'Section ID', 'craftowp' ),
            'desc'        => __( 'Set the ID of your section. This ID will be used for one-page navigation on both automatic or manual mode.

A unique lower case alphanumeric string, underscores allowed.', 'craftowp' ),
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'home_section_menu_choice',
            'label'       => __( 'Show section on menu', 'craftowp' ),
            'desc'        => '',
            'std'         => 'true',
            'type'        => 'on-off',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          ),
          array(
            'id'          => 'home_section_label',
            'label'       => __( 'Menu label', 'craftowp' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'home_menu_type',
        'label'       => __( 'Home page menu type', 'craftowp' ),
        'desc'        => __( 'Choose to generate the menu automaticaly based on sections settings or create it manualy on Menus section under Appearance tab.', 'craftowp' ),
        'std'         => 'automatic',
        'type'        => 'radio',
        'section'     => 'menus',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'automatic',
            'label'       => __( 'Automatic', 'craftowp' ),
            'src'         => ''
          ),
          array(
            'value'       => 'manual',
            'label'       => __( 'Manual', 'craftowp' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'show_home',
        'label'       => __( 'Show < Home > on automatic mode', 'craftowp' ),
        'desc'        => __( 'Choose whether to show or not the < Home > link on Automtic Menu mode.', 'craftowp' ),
        'std'         => 'true',
        'type'        => 'on-off',
        'section'     => 'menus',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_menu_style',
        'label'       => __( 'Home page menu style', 'craftowp' ),
        'desc'        => __( 'Choose the style or your home page menu.', 'craftowp' ),
        'std'         => 'fademenu',
        'type'        => 'radio',
        'section'     => 'menus',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'whitemenu',
            'label'       => __( 'White menu', 'craftowp' ),
            'src'         => ''
          ),
          array(
            'value'       => 'blackmenu',
            'label'       => __( 'Black menu', 'craftowp' ),
            'src'         => ''
          ),
          array(
            'value'       => 'fademenu',
            'label'       => __( 'Black fade menu', 'craftowp' ),
            'src'         => ''
          ),
          array(
            'value'       => 'transparentmenulight',
            'label'       => __( 'Transparent menu - light content', 'craftowp' ),
            'src'         => ''
          ),
          array(
            'value'       => 'transparentmenudark',
            'label'       => __( 'Transparent menu - dark content', 'craftowp' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'home_tab1',
        'label'       => __( 'Main Settings', 'craftowp' ),
        'desc'        => __( 'These are the main settings for the home section. please follow the instructions from the right side of the screen and use ecah field carefully.', 'craftowp' ),
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_title',
        'label'       => __( 'Home Section Title', 'craftowp' ),
        'desc'        => __( 'This is the general title shown on the first section of your website. By default this text is replaced by your website title.', 'craftowp' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_main_text',
        'label'       => __( 'Home main text', 'craftowp' ),
        'desc'        => __( 'Please add here your main sentece(s) but try to keep it short.', 'craftowp' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_rotating_words',
        'label'       => __( 'Rotating words', 'craftowp' ),
        'desc'        => __( 'Add one sentence/word at a time. These options wich you\'ll be adding here will be rotated as on our demo version. You can add as meny sequences you need and you can change the order later.', 'craftowp' ),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'rotating_sequence',
            'label'       => __( 'Sequence', 'craftowp' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'scroll_down',
        'label'       => __( 'Scroll Down text', 'craftowp' ),
        'desc'        => __( 'Add the text for < Scroll Down > arrow from home screen. Default is "Scroll Down".', 'craftowp' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_content_color',
        'label'       => __( 'Content color', 'craftowp' ),
        'desc'        => '',
        'std'         => 'dark',
        'type'        => 'radio',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'light',
            'label'       => __( 'Light', 'craftowp' ),
            'src'         => ''
          ),
          array(
            'value'       => 'dark',
            'label'       => __( 'Dark', 'craftowp' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'home_tab2',
        'label'       => __( 'Background', 'craftowp' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'tab',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_background',
        'label'       => __( 'Home Background', 'craftowp' ),
        'desc'        => __( 'Set the background for Home section. Also you\'ll have to set bellow the type of the background used (dark or light).', 'craftowp' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_overlay_color',
        'label'       => __( 'Overlay color', 'craftowp' ),
        'desc'        => __( 'Choose wich color to overlay the main image. If you don\'t want any overlay, please leave this field empty.', 'craftowp' ),
        'std'         => '#32425a',
        'type'        => 'colorpicker',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'home_overlay_transparency',
        'label'       => __( 'Overlay transparency', 'craftowp' ),
        'desc'        => __( 'You can make the overlay layer transparent so please choose the transparency from this slider. Note that you need to add a color for the overlay in order to make it transparent', 'craftowp' ),
        'std'         => '0.7',
        'type'        => 'numeric-slider',
        'section'     => 'welcome_screen',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,1,0.1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_text',
        'label'       => __( 'Footer informations', 'craftowp' ),
        'desc'        => __( 'Use this field to write your disclaymer or copyrights on footer.', 'craftowp' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_background',
        'label'       => __( 'Footer Background', 'craftowp' ),
        'desc'        => __( 'Here you can set the background for footer. You can change also the style using all given controls.', 'craftowp' ),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'activate_footer_parallax',
        'label'       => __('Parallax effect on background image', 'craftowp'),
        'desc'        => __('Activate parallax effect on footer background.', 'craftowp'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'footer_section',
        'class'       => '',
        'choices'     => array()
      ),
      array(
        'id'          => 'footer_overlay_color',
        'label'       => __( 'Overlay color', 'craftowp' ),
        'desc'        => __( 'Choose the color for overlay. If you don\'t want any overlay, please leave this field empty.', 'craftowp' ),
        'std'         => '#32425a',
        'type'        => 'colorpicker',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_overlay_transparency',
        'label'       => __( 'Overlay transparency', 'craftowp' ),
        'desc'        => __( 'You can make the overlay layer transparent so please choose the transparency from this slider. Note that you need to add a color for the overlay in order to make it transparent', 'craftowp' ),
        'std'         => '0.7',
        'type'        => 'numeric-slider',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '0,1,0.1',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'footer_content_color',
        'label'       => __( 'Content color', 'craftowp' ),
        'desc'        => __( 'Please choose the contenet/text color according with the background from above. By default the content will be dark.', 'craftowp' ),
        'std'         => 'dark',
        'type'        => 'radio',
        'section'     => 'footer_section',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'dark',
            'label'       => __( 'Dark', 'craftowp' ),
            'src'         => ''
          ),
          array(
            'value'       => 'light',
            'label'       => __( 'Light', 'craftowp' ),
            'src'         => ''
          )
        )
      ),
       array(
        'id'          => 'fonts_api',
        'label'       => __( 'Google Fonts API', 'craftowp' ),
        'desc'        => __( 'In order to populate the Fonts dropdown with all Google fonts, you need get an API KEY from <a href="https://developers.google.com/fonts/docs/developer_api#Auth" target="_blank">here</a>. Create a project and get the API.', 'craftowp' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'body_font',
        'label'       => __( 'Body font', 'craftowp' ),
        'desc'        => __( 'Choose your typography settings for Body.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_font',
        'label'       => __( 'Menu font', 'craftowp' ),
        'desc'        => __( 'Choose your typography settings for top menus.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_one_font',
        'label'       => __( 'H1 font', 'craftowp' ),
        'desc'        => __( 'Choose your typography settings for Heading1.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_two_font',
        'label'       => __( 'H2 font', 'craftowp' ),
        'desc'        => __( 'Choose your typography settings for Heading2', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_three_font',
        'label'       => __( 'H3 font', 'craftowp' ),
        'desc'        => __( 'Choose your typography settings for Heading3.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_four_font',
        'label'       => __( 'H4 font', 'craftowp' ),
        'desc'        => __( 'Choose your typography settings for Heading4', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_five_font',
        'label'       => __( 'H5 font', 'craftowp' ),
        'desc'        => __( 'Choose your typography settings for Heading5.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'heading_six_font',
        'label'       => __( 'H6 font', 'craftowp' ),
        'desc'        => __( 'Choose your typography settings for Heading6.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'welcome_heading_one',
        'label'       => __( 'Welcome screen title', 'craftowp' ),
        'desc'        => __( 'Choose your font and text style for title from Welcome screen.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'welcome_description_font',
        'label'       => __( 'Welcome screen description', 'craftowp' ),
        'desc'        => __( 'Change the typography for description and rotating words for Welcome screen.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'page_tagline_font',
        'label'       => __( 'Page tagline font', 'craftowp' ),
        'desc'        => __( 'Change typography settings of page tagline. This is the featured text under the page/section title.', 'craftowp' ),
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      // array(
      //   'id'          => 'social_profiles',
      //   'label'       => __( 'Social Profiles', 'craftowp' ),
      //   'desc'        => '',
      //   'std'         => '',
      //   'type'        => 'social-links',
      //   'section'     => 'social_links_general',
      //   'rows'        => '',
      //   'post_type'   => '',
      //   'taxonomy'    => '',
      //   'min_max_step'=> '',
      //   'class'       => '',
      //   'condition'   => '',
      //   'operator'    => 'and'
      // ),
      array(
        'id'          => 'social_profiles',
        'label'       => __('Social Icons', 'craftowp'),
        'desc'        => __('Use the Add New button to add your social profiles.', 'craftowp'),
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'social_links_general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'settings'    => array( 
          array(
            'id'          => 'social_profile',
            'label'       => __('Social Profile', 'craftowp'),
            'desc'        => '',
            'std'         => '',
            'type'        => 'select',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'     => array( 
              array(
                'value'       => 'fa-facebook',
                'label'       => 'Facebook',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-twitter',
                'label'       => 'Twitter',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-google-plus',
                'label'       => 'Google Plus',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-linkedin',
                'label'       => 'Linkedin',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-skype',
                'label'       => 'Skype',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-dribbble',
                'label'       => 'Dribbble',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-flickr',
                'label'       => 'Flickr',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-pinterest',
                'label'       => 'Pinterest',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-stack-overflow',
                'label'       => 'Stack Overflow',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-youtube',
                'label'       => 'Youtube',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-vimeo-square',
                'label'       => 'Vimeo',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-dropbox',
                'label'       => 'Dropbox',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-foursquare',
                'label'       => 'Foursquare',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-instagram',
                'label'       => 'Instagram',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-github',
                'label'       => 'Github',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-tumblr',
                'label'       => 'Tumblr',
                'src'         => ''
              ),
              array(
                'value'       => 'fa-xing',
                'label'       => 'Xing',
                'src'         => ''
              )
            )
          ),
          array(
            'id'          => 'profile_url',
            'label'       => __('Profile URL', 'craftowp'),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
          )
        )
      ),
      array(
        'id'          => 'main_brand_color',
        'label'       => __( 'Main brand color', 'craftowp' ),
        'desc'        => __( 'This is the main color of your website. A lot of things all over the website will have this color.<br><strong>Hint:</strong> This should be a dark color. If the main color of your brand is a light one, then use the secondary color field for the light one. This oen should be dark.', 'craftowp' ),
        'std'         => '#32425A',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'secondary_brand_color',
        'label'       => __( 'Secondary brand color', 'craftowp' ),
        'desc'        => __( 'This is the secondary color of your website. A lot of things all over the website will have this color including all links.<br><strong>Hint:</strong> This should be a lighter color.', 'craftowp' ),
        'std'         => '#D9A13F',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'links_color',
        'label'       => __( 'Links color', 'craftowp' ),
        'desc'        => __( 'This is the color of all links from your website. some of the links will have other colors though.', 'craftowp' ),
        'std'         => '#D9A13F',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'links_rollover',
        'label'       => __( 'Links rollover color', 'craftowp' ),
        'desc'        => __( 'This is the rollover color of all links.', 'craftowp' ),
        'std'         => '#b98429',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'menu_rollover',
        'label'       => __( 'Menu rollover', 'craftowp' ),
        'desc'        => __( 'This is the color for the hover state of menu links.', 'craftowp' ),
        'std'         => '#D9A13F',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'rotating_words_color',
        'label'       => __( 'Rotating words', 'craftowp' ),
        'desc'        => __( 'This is the color for rotating words from Welcome screen.', 'craftowp' ),
        'std'         => '#D9A13F',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'scroll_down_color',
        'label'       => __( 'Scroll Down arrow', 'craftowp' ),
        'desc'        => __( 'This is the color for the < Scroll Down > arrow from Welcome screen.', 'craftowp' ),
        'std'         => '#D9A13F',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'portfolio_expander_color',
        'label'       => __( 'Portfolio expander', 'craftowp' ),
        'desc'        => __( 'This is the color for the portfolio post container. The one that slides down when you click on a portfolio thumbnail.<br><strong>Hint:</strong> This should be a light color', 'craftowp' ),
        'std'         => '#F6ECDA',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'team_hover_color',
        'label'       => __( 'Team Member rollover', 'craftowp' ),
        'desc'        => __( 'This is the color that is shown when you hover a team member photo.', 'craftowp' ),
        'std'         => '#D9A13F',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'selection_color',
        'label'       => __( 'Selection color', 'craftowp' ),
        'desc'        => __( 'This is the color for any selection on your website. If you leave it empty, will be used the theme\'s default color.', 'craftowp' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'colors',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'dynamic_css_field',
        'label'       => __( 'Dynamic CSS', 'craftowp' ),
        'desc'        => __( 'This field is hidden by default. The end-user should not have access to this field.', 'craftowp' ),
        'type'        => 'css',
        'section'     => 'custom_css',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'std'         => '#home {
  background-color: {{home_background|background-color}};
  background-image: url("{{home_background|background-image}}");
  background-repeat: {{home_background|background-repeat}};
}
#home .bg-overlay {
    background-color: {{home_overlay_color}};
    opacity: {{home_overlay_transparency}};
}

footer.footer {
  background-color: {{footer_background|background-color}};
  background-image: url("{{footer_background|background-image}}");
  background-repeat: {{footer_background|background-repeat}};
}

footer.footer .bg-overlay {
    background-color: {{footer_overlay_color}};
    opacity: {{footer_overlay_transparency}};
}

footer.footer {
  background-color: {{footer_background|background-color}};
  background-image: url("{{footer_background|background-image}}");
  background-repeat: {{footer_background|background-repeat}};
}

body { {{body_font}} }
h1 { {{heading_one_font}} }
h2 { {{heading_two_font}} }
h3 { {{heading_three_font}} }
h4 { {{heading_four_font}} }
h5 { {{heading_five_font}} }
h5 { {{heading_six_font}} }
.welcome-section .welcome-content h1 { {{welcome_heading_one}} }
.welcome-section .welcome-content p { {{welcome_description_font}} }
.section-description { {{page_tagline_font}} }
.btn-default {
    background-color: {{main_brand_color}};
    border-color: {{main_brand_color}};
}
.og-details .btn,
.pricing-button .btn, {
    color: {{main_brand_color}};
    border-color: {{main_brand_color}};
}
.social-icons.dark-icons a:hover,
.btn-default {
    border-color: {{main_brand_color}};
}
.portfolio-item > a .overlay-content h4,
.og-details h3,
.social-icons.dark-icons a,
.comments i.fa{
    color: {{main_brand_color}};
}
.portfolio-item > a {
    box-shadow: inset 0px 0px 0px 3px {{main_brand_color}};
}
.portfolio-item > a .overlay-content h4::after,
.og-details .btn:hover,
.pricing-button .btn:hover,
.recent-posts .post-col:before,
.contact-form .form-control:focus,
.contact-form input[type="submit"]:focus,
.contact-form input[type="submit"]:hover,
.comment-form .form-group input:focus,
.comment-form .form-group textarea:focus,
.comment-form input[type="submit"]:hover,
.iconbox .iconbox-icon {
    background-color: {{main_brand_color}};
}
.navbar-nav li ul:before {
  background: {{main_brand_color}};
}
.navbar-nav li ul:after {
  border-bottom-color: {{main_brand_color}};
}
.btn-default.btn-outline {
    background-color: transparent;
    color: {{main_brand_color}};
    border-color: {{main_brand_color}};
}
.btn-default.btn-outline:hover {
    background-color: {{main_brand_color}};
    border-color: {{main_brand_color}};
}
.og-expander {
    background-color: {{portfolio_expander_color}};
}
a,
.reveal-inner-menu:hover,
.reveal-inner-menu:hover span {color: {{links_color}};}
a:hover {color: {{links_rollover}};}
.rotating-words {color:{{rotating_words_color}};}
.scroll-more {color:{{scroll_down_color}};}
.team-member span {color: {{secondary_brand_color}};}
.team-member .profile-picture .profile-overlay { background-color: {{team_hover_color}};}
.recent-posts .read-more {color:{{secondary_brand_color}}; border-color:{{secondary_brand_color}}}
.recent-posts .read-more:hover {color:{{main_brand_color}}; border-color:{{main_brand_color}}}
.contact-form .form-control,
.comment-form .form-group input,
.comment-form .form-group textarea{border-color:{{main_brand_color}};}
.navbar-nav li a:hover, .navbar-nav li a:focus {color:{{menu_rollover}};}
.navbar-nav li a:after, .navbar-nav .active a, .navbar-nav .active a:hover {color:{{menu_rollover}};}
::selection {color:#fff;background:{{selection_color}};}
::-moz-selection {color:#fff;background:{{selection_color}};}
.comments li {border-left-color:{{main_brand_color}};}
.pricing-button .btn {
    color: {{main_brand_color}};
    border-color: {{main_brand_color}};
}
.spinner1, .spinner1::before, .spinner1::after {border-color:{{spinner_color}};}
.spinner2 .double-bounce1, .spinner2 .double-bounce2, .spinner3, .spinner4 > div {background-color:{{spinner_color}};}
.preloader {background-color:{{loader_background}};}'
      ),
      array(
        'id'          => 'custom_css_field',
        'label'       => __( 'Custom CSS', 'craftowp' ),
        'desc'        => __( 'If you want to apply the future update with ease you may need to use this field for any CSS customizations. Paste here your custom code and will be applied to your website.', 'craftowp' ),
        'std'         => '',
        'type'        => 'css',
        'section'     => 'custom_css',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}