<!DOCTYPE html>
<html class="no-js">

<head>
<!-- Google Tag Manager -->
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M9HK4V');
</script>
<!-- End Google Tag Manager -->

<!-- juicer -->
<script src="//kitchen.juicer.cc/?color=OJNPzT9GhME=" async></script>
<!-- //juicer -->

<meta charset="<?php bloginfo( 'charset' ); ?>">
<!-- viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<script>
    var contentWidth = 960; // コンテンツの幅に合わせて修正してください
    var ua = navigator.userAgent; // ユーザーエージェントの取得
    if((ua.indexOf('Android') > 0 && ua.indexOf('Mobile') == -1) || ua.indexOf('iPad') > 0 || ua.indexOf('Kindle') > 0 || ua.indexOf('Silk') > 0){
      // タブレット端末だった場合の処理
      document.write('<meta name="viewport" content="width=' + contentWidth + '">');
    } else {
      // タブレット端末ではない場合の処理
      document.write('<meta name="viewport" content="width=device-width">');
    }
</script>
<!-- //viewport -->

<title>
<?php if(is_search())://検索結果ページ ?>
'<?php search_result(); ?>'の検索結果 ｜ <?php bloginfo('name'); ?>

<?php else: //それ以外のページ ?>
<?php wp_title(''); ?>｜<?php bloginfo('name'); ?>

<?php endif; ?>
</title>

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

</head>

<?php if ( function_exists( 'ot_get_option' ) ) {
	if (function_exists('icl_object_id') && ot_get_option('show_lang_switcher') == 'on') {
		$wpmlClass = ' wpml-active';
	} else {
		$wpmlClass = '';
	}
} ?>

<?php echo '<body data-spy="scroll" data-target="#home_nav" class="'.join(' ', get_body_class()).$wpmlClass.'">'.PHP_EOL; ?>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M9HK4V" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

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
        </div><!-- /.Preloader -->
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

<!--<div class="navbar navbar-fixed-top<?php echo $menu_class; ?>">-->
<div class="container-fluid d-none d-lg-block">
    <div class="row">
        <div class="col-lg-2 logo-wrap clearfix px-lg-5 py-lg-2">

            <?php if(is_page(home)) : ?>
                <a class="navbar-brand navbar-brand-title" href="<?php bloginfo('url'); ?>"><h1 class="logo">FA Products</h1></a>
            <?php else: ?>
                <a class="navbar-brand navbar-brand-title" href="<?php bloginfo('url'); ?>"><h1 class="logo">FA Products</h1></a>
            <?php endif; ?>

        </div>
        <div class="col-lg-9 offset-lg-1 px-0 pt-2 d-none d-lg-block clearfix">
            <!-- //　スマホ時非表示> -->
            <ul class="mr-auto mt-2 mt-lg-0 d-inline-block float-right">
                <li class="nav-bar-navi01-li nav-bar-navi01-li01"><a href="<?php bloginfo('url'); ?>/energy/"><i class="fa fa-play-circle" aria-hidden="true"></i>スマートエネルギー事業</a></li>
                <li class="nav-bar-navi01-li nav-bar-navi01-li02"><a href="<?php bloginfo('url'); ?>/factory/" ><i class="fa fa-play-circle" aria-hidden="true"></i>スマートファクトリー事業</a></li>
                <li class="nav-bar-navi01-li nav-bar-navi01-li05"><a href="http://smartfactorylabo.com/" target="_blank"><i class="fa fa-play-circle" aria-hidden="true"></i>スマラボ</a></li>
                <li class="nav-bar-navi01-li nav-bar-navi01-li05"><a href="https://connected-engineering.com/" target="_blank"><i class="fa fa-play-circle" aria-hidden="true"></i>Team Cross FA</a></li>
                <li class="nav-bar-navi01-li nav-bar-navi01-li03"><a href="https://fa-products.jp/" ><i class="fa fa-play-circle" aria-hidden="true"></i>企業サイト</a></li>
                <li class="nav-bar-navi01-li nav-bar-navi01-li04 hover-opa"><p class="example1"><strong>　Tel 03-6453-6761</strong></span></li>
            </ul>
            <!-- //　<スマホ時非表示 -->
        </div><!-- /.navbar-link -->
    </div><!-- /.row -->
</div><!-- /.container -->


<nav id="navbar-fap" class="navbar-fap navbar navbar-expand-lg navbar-light whitemenu mb-1">

    <div class="logo-wrap d-inline-block d-lg-none pl-2 pt-2">
    <!-- //　スマホ時表示> -->
    <?php if(is_page(home)) : ?>
        <a class="navbar-brand navbar-brand-title" href="<?php bloginfo('url'); ?>"><h1 class="logo">FA Products</h1></a>
    <?php else: ?>
        <a class="navbar-brand navbar-brand-title" href="<?php bloginfo('url'); ?>"><h1 class="logo">FA Products</h1></a>
    <?php endif; ?>
    <!-- //　<スマホ時表示 -->
    </div>

    <button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#fa-navi-trigger01" aria-controls="fa-navi-trigger01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="fa-navi-trigger01">
    <!-- //　スマホ時表示> -->
    <ul class="mr-auto mt-2 mt-lg-0 d-inline-block d-lg-none menu__list">
        <li class="nav-bar-navi01-li nav-bar-navi01-li01"><a href="<?php bloginfo('url'); ?>/energy/"><i class="fa fa-play-circle" aria-hidden="true"></i>スマートエネルギー事業</a></li>
        <li class="nav-bar-navi01-li nav-bar-navi01-li02"><a href="<?php bloginfo('url'); ?>/factory/" ><i class="fa fa-play-circle" aria-hidden="true"></i>スマートファクトリー事業</a></li>
        <li class="nav-bar-navi01-li nav-bar-navi01-li05"><a href="http://smartfactorylabo.com/" target="_blank"><i class="fa fa-play-circle" aria-hidden="true"></i>スマラボ</a></li>
        <li class="nav-bar-navi01-li nav-bar-navi01-li05"><a href="https://connected-engineering.com/" target="_blank"><i class="fa fa-play-circle" aria-hidden="true"></i>Team Cross FA</a></li>
        <li class="nav-bar-navi01-li nav-bar-navi01-li03"><a href="https://fa-products.jp/" ><i class="fa fa-play-circle" aria-hidden="true"></i>企業サイト</a></li>
        <li class="nav-bar-navi01-li nav-bar-navi01-li04 hover-opa"><p class="example1"><strong>Tel 03-6453-6761</strong></span></li>
    </ul>
    <!-- //　<スマホ時表示 -->
    <ul class="navbar-nav mx-auto mt-2 mt-lg-0 d-inline-block d-lg-flex menu__list">
        <li class="nav-bar-navi02-li nav-bar-navi02-li00 py-2 py-md-0"><a href="<?php bloginfo('url'); ?>"><span class="nav-bar-navi02-li-txt-t">Top</span><span class="nav-bar-navi02-li-txt-u br"></span></a></li>
        <li class="nav-bar-navi02-li nav-bar-navi02-li01 py-2 py-md-0"><a href="<?php bloginfo('url'); ?>/corporate.html"><span class="nav-bar-navi02-li-txt-t">会社概要</span><span class="nav-bar-navi02-li-txt-u br">Corporate</span></a>
            <?php wp_nav_menu( array('theme_location'=>'fa-products-corp-menu-1') ) ?>
        </li>
        <li class="nav-bar-navi02-li nav-bar-navi02-li02 py-2 py-md-0"><a href="<?php bloginfo('url'); ?>/corporate/vision.html"><span class="nav-bar-navi02-li-txt-t">ビジョン</span><span class="nav-bar-navi02-li-txt-u br">Vision</span></a></li>
        <li class="nav-bar-navi02-li nav-bar-navi02-li03 py-2 py-md-0"><a href="<?php bloginfo('url'); ?>/topics.html"><span class="nav-bar-navi02-li-txt-t">耳より情報</span><span class="nav-bar-navi02-li-txt-u br">Topics</span></a></li>
        <li class="nav-bar-navi02-li nav-bar-navi02-li04 py-2 py-md-0"><a href="<?php bloginfo('url'); ?>/newsrelease.html"><span class="nav-bar-navi02-li-txt-t">ニュース</span><span class="nav-bar-navi02-li-txt-u br">News</span></a></li>
        <li class="nav-bar-navi02-li nav-bar-navi02-li05 py-2 py-md-0"><a href="<?php bloginfo('url'); ?>/recruit.html"><span class="nav-bar-navi02-li-txt-t">採用情報</span><span class="nav-bar-navi02-li-txt-u br">Recruit</span></a>
            <?php wp_nav_menu( array('theme_location'=>'fa-products-corp-menu-5') ) ?>
        </li>
        <li class="nav-bar-navi02-li nav-bar-navi02-li07 py-2 py-md-0"><a href="<?php bloginfo('url'); ?>/corporate/about.html#Access"><span class="nav-bar-navi02-li-txt-t">アクセス</span><span class="nav-bar-navi02-li-txt-u br">Access</span></a></li>
        <li class="nav-bar-navi02-li nav-bar-navi02-li06 py-2 py-md-0"><a href="<?php bloginfo('url'); ?>/contact.html"><span class="nav-bar-navi02-li-txt-t">お問い合わせ</span><span class="nav-bar-navi02-li-txt-u br">Contact</span></a></li>

    </ul>
    </div>
</nav>

<?php if ( function_exists( 'ot_get_option' ) ) {
    if (function_exists('icl_object_id') && ot_get_option('show_lang_switcher') == 'on') {
        echo '<div class="language-selector">';
            echo language_selector_flags(ot_get_option('lang_switcher_type'));
        echo '</div>';
    }
} ?>

<div class="container">
    <div class="row">

        <?php if(is_page(home)) : ?>

        <div class="pc_slider_wrap"><?php echo do_shortcode('[smartslider3 slider=2]'); ?></div>
        <div class="sp_slider_wrap"><?php echo do_shortcode('[smartslider3 slider=3]'); ?></div>

        <?php endif; ?>
    </div>
</div><!-- /.container -->

