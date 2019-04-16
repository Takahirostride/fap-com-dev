<!DOCTYPE html>
<html class="no-js">
<head>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M9HK4V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- juicer -->
<script src="//kitchen.juicer.cc/?color=OJNPzT9GhME=" async></script>
<!-- //juicer -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
	

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	
	<?php if ( function_exists( 'ot_get_option' ) && ot_get_option('apple_touch_icon') != '' ) { ?>
		<link rel="apple-touch-icon" href="<?php echo stripslashes(ot_get_option('apple_touch_icon')) ?>">
	<?php } ?>
	<?php if ( function_exists( 'ot_get_option' ) && ot_get_option('favicon_png_upload') != '' ) { ?>
		<link rel="shortcut icon" href="<?php echo stripslashes(ot_get_option('favicon_png_upload')) ?>" />
	<?php } ?>
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo stripslashes(ot_get_option('favicon_ico_upload')) ?>">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>
	<?php if ( function_exists( 'ot_get_option' ) && ot_get_option('tile_color') != ' ') { ?>
		<meta name="msapplication-TileColor" content="<?php echo ot_get_option('tile_color') ?>">
	<?php } ?>
	<?php if ( function_exists( 'ot_get_option' ) &&  ot_get_option('tile_image') != '' ) { ?>
		<meta name="msapplication-TileImage" content="<?php echo ot_get_option('tile_image') ?>">
	<?php } ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php // wordpress head functions ?>
	<?php wp_head(); ?>
	<?php // end of wordpress head ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
	<link href='https://fonts.googleapis.com/css?family=Titillium+Web:600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">-->

<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="js/slick.js"></script>-->

</head>

<?php if ( function_exists( 'ot_get_option' ) ) {
	if (function_exists('icl_object_id') && ot_get_option('show_lang_switcher') == 'on') {
		$wpmlClass = ' wpml-active';
	} else {
		$wpmlClass = '';
	}
} ?>

<?php echo '<body data-spy="scroll" data-target="#home_nav" class="'.join(' ', get_body_class()).$wpmlClass.'">'.PHP_EOL; ?>

<?php
// Display the preloader splash screen
if ( function_exists( 'ot_get_option' ) ):
	if ( ot_get_option( 'activate_loader' ) == "on" ): ?>
<!-- Preloader -->
<div id="preloader" class="preloader">
	<div class="loading-icon">
	<?php if ( ot_get_option( 'spinner_type' ) == "spinner1" ): ?>
		<div class="spinner1"></div>
	<?php elseif ( ot_get_option( 'spinner_type' ) == "spinner2" ): ?>
		<div class="spinner2">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	<?php elseif ( ot_get_option( 'spinner_type' ) == "spinner3" ): ?>
		<div class="spinner3"></div>
	<?php else: ?>
		<div class="spinner4">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	<?php endif ?>
	</div>
</div>
	<?php endif ?>
<?php endif ?>

<!-- Navigation Bar -->

<?php if ( function_exists( 'ot_get_option' ) ) {
	$menu_style = ot_get_option( 'home_menu_style' );
	if (isset($menu_style) && $menu_style !== '') {
		$menu_class = ' '.$menu_style;
	} else {
		$menu_class = '';
	}
} ?>

<div class="navbar navbar-fixed-top<?php echo $menu_class; ?>">

	<div class="container">

		<div class="navbar-header">

			<?php if ( function_exists( 'ot_get_option' ) ) : ?>
				<?php $logo_normal = ot_get_option( 'logo_upload' );
					$logo_white = ot_get_option( 'white_logo_upload' );
					$logo_choice = ot_get_option( 'choose_logo' );
					$blog_title = get_bloginfo('name'); ?>

				<?php if ( ! empty( $logo_normal )) { 
					if ($logo_choice == "white_logo") {
						echo '<a class="navbar-brand" href="'.site_url().'"><img class="logo" src="'.$logo_white.'" alt="'.$blog_title.'"></a>';
					} else {
						echo '<a class="navbar-brand" href="'.site_url().'"><img class="logo" src="'.$logo_normal.'" alt="'.$blog_title.'"></a>';
					}
				 } else { ?>
					<h1 class="clearfix"><a class="navbar-brand navbar-brand-title" href="<?php echo site_url(); ?>"><?php echo $blog_title; ?></a></h1>
				<?php } ?>

			<?php endif; ?>

			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<?php if ( function_exists( 'ot_get_option' ) ) : ?>
			<?php
				$menuType = ot_get_option('home_menu_type');
				if (isset($menuType) && $menuType == 'manual') {

					$args = array(
						'theme_location'  => 'home_menu',
						'menu'            => '',
						'container'       => 'nav',
						'container_class' => 'navbar-collapse collapse',
						'container_id'    => 'home_nav',
						'menu_class'      => 'nav navbar-nav',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
					);

					if ( has_nav_menu( 'home_menu' ) ) {
						$menu = wp_nav_menu( $args );
					} else {
						echo '<p style="color:#fff; float:right;">'.__( 'Please add a menu to << home menu >> location', 'craftowp' ).'</p>';
					}
				} else {

					$home_array = ot_get_option( 'pages_on_home' );
					$menu = '<nav id="home_nav" class="navbar-collapse collapse" role="navigation">
						<ul class="nav navbar-nav">';

						$menu .= (ot_get_option('show_home') !== 'off') ? '<li><a href="#home">'.__( 'Home', 'craftowp' ).'</a></li>' : '' ;
					
					if ($home_array) {
						foreach ($home_array as $section) {
							if ($section['home_section_menu_choice'] !== 'off' && $section['home_section_label'] !== '') {
								$menu .= '<li><a href="#'.$section['home_section_id'].'">'.$section['home_section_label'].'</a></li>';
							} else {
								$menu .= '';
							}
						}
					}
					

					$menu .= '</ul>
					</nav><!--/.navbar-collapse -->';

					echo $menu;
				}
			
			?>
		<?php endif; ?>

			<?php if ( function_exists( 'ot_get_option' ) ) {
				if (function_exists('icl_object_id') && ot_get_option('show_lang_switcher') == 'on') {
					echo '<div class="language-selector">';
						echo language_selector_flags(ot_get_option('lang_switcher_type'));
					echo '</div>';
				}
			} ?>

	</div>
</div>
<!-- End of Navigation Bar -->