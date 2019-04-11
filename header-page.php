<!DOCTYPE html>
<html class="no-js">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M9HK4V');</script>
<!-- End Google Tag Manager -->
<!-- juicer -->
<script src="//kitchen.juicer.cc/?color=OJNPzT9GhME=" async></script>
<!-- //juicer -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <title>
    <?php if(is_search())://検索結果ページ ?>
    '<?php search_result(); ?>'の検索結果 ｜ <?php bloginfo('name'); ?>
    
    <?php else: //それ以外のページ ?>
    <?php wp_title(''); ?>｜<?php bloginfo('name'); ?>
    
    <?php endif; ?>
    </title>
	

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
    <!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">-->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/slick.js"></script>
<script>
$(function(){
	$('.voice-slide').slick({
		slidesToShow:2,
		slidesToScroll:1,
		autoplay:true,
		autoplaySpeed:3000,
		infinite: true,
		responsive:[{
			breakpoint: 1200,
			settings:{
				arrows: false,
				slidesToShow: 2,
				slidesToScroll:1
	  		}
		},
		{
			breakpoint: 640,
			settings:{
				slidesToShow: 1
			}
		}]
	});
});
</script>

<script type='text/javascript'>
jQuery(function(){
	var set = 300;//ウインドウ上部からどれぐらいの位置で変化させるか
	var boxTop = new Array;
	var current = -1;
	//各要素の位置
	jQuery('.box').each(function(i) {
		boxTop[i] = jQuery(this).offset().top-800;
	});
	//最初の要素にclass="on"をつける
	changeBox(0);
	//スクロールした時の処理
	jQuery(window).scroll(function(){
		scrollPosition = jQuery(window).scrollTop();
		for (var i = boxTop.length - 1 ; i >= 0; i--) {
			if (jQuery(window).scrollTop() > boxTop[i] - set) {
	            changeBox(i);
	        	break;
	        }
		};
	});
	//ナビの処理
	function changeBox(secNum) {
		if (secNum != current) {
			current = secNum;
			secNum2 = secNum + 1;//HTML順序用
			jQuery('#menu-omnist_menu li').removeClass('on');
			jQuery('#menu-omnist_menu li:nth-child(' + secNum2 +')').addClass('on');
			/* 位置によって個別に処理をしたい場合　
			if (current == 0) {
				// 現在地がsection1の場合の処理
			} else if (current == 1) {
				// 現在地がsection2の場合の処理
			} else if (current == 2) {
				// 現在地がsection3の場合の処理
			}*/
		}
	};
});
</script>

<script type='text/javascript'>
//スムーズスクロール
jQuery(function() {
 jQuery(".scroll").click(function(event){
  event.preventDefault();
			
  var url = this.href;

  var parts = url.split("#");
  var target = parts[1];
	 
  var target_offset = jQuery("#"+target).offset();
  var target_top = target_offset.top-120;
	 
  jQuery('html, body').animate({scrollTop:target_top}, 500);
  });
 });
</script>

<script>
    	jQuery(function(){
		jQuery("#reason dt").on("click", function() {
			jQuery(this).next().slideToggle();
			jQuery(this).toggleClass("active"); 
		});
	});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>

<style type="text/css">

/*body {
font-size: 100%; 
} */
p.example1 { font-size: large; }

p.example2 {
background-color: #000080
}

</style>
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
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M9HK4V"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
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
<div class="container-fluid">
	<div class="row">
		
		<div class="navbar navbar-fixed-top<?php echo $menu_class; ?>">
		<div class="navbar-relative-top">
			<div class="navbar-link">
		        <div class="navbar-link-inner">
		        	<!--<a href="#" target="_blank" class="navbar-link01">◇English Website≫</a>-->
		        	<span class="navbar-link01">もっと&sup3;Smartに</span>
		        </div>
		    </div><!-- .navbar-link -->
		
			<div class="container nav-container">
		
				<div class="navbar-header">
		
							<div class="navbar-hedad-logo">
		                        <div class="logo-wrap clearfix">
								  <?php if(is_page(home)) : ?>
		                          <a class="navbar-brand navbar-brand-title" href="<?php bloginfo('url'); ?>"><h1 class="logo">FA Products</h1></a>
								  <?php else: ?>
		                          <a class="navbar-brand navbar-brand-title" href="<?php bloginfo('url'); ?>"><div class="logo">FA Products</div></a>
								  <?php endif; ?>
		                        </div>
		
		                    </div>
		
		            <!-- スマホ時 Menu　-->
		            <div id="nav-bar-sp-wrap" class="nav-bar-sp">
		                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="nav-bar-sp-tit">Menu</span>
		                </button>
					</div><!-- .nav-bar-sp -->
		
				</div>
		        
		            <div class="nav-bar-navi01">
		                <ul class="nav-bar-navi01-ul">
		                    <li class="nav-bar-navi01-li nav-bar-navi01-li01"><a href="<?php bloginfo('url'); ?>/energy/"><i class="fa fa-play-circle" aria-hidden="true"></i>スマートエネルギー事業</a></li>
		                    <li class="nav-bar-navi01-li nav-bar-navi01-li02"><a href="<?php bloginfo('url'); ?>/factory/" ><i class="fa fa-play-circle" aria-hidden="true"></i>スマートファクトリー事業</a></li>
		                    <li class="nav-bar-navi01-li nav-bar-navi01-li05"><a href="http://smartfactorylabo.com/" target="_blank"><i class="fa fa-play-circle" aria-hidden="true"></i>スマラボ</a></li>
		<li class="nav-bar-navi01-li nav-bar-navi01-li05"><a href="https://connected-engineering.com/" target="_blank"><i class="fa fa-play-circle" aria-hidden="true"></i>Team Cross FA</a></li>
		                   <li class="nav-bar-navi01-li nav-bar-navi01-li03"><a href="https://fa-products.jp/" ><i class="fa fa-play-circle" aria-hidden="true"></i>企業サイト</a></li>
		<li class="nav-bar-navi01-li nav-bar-navi01-li04 hover-opa"><p class="example1"><strong>　Tel 03-6453-6761</strong></span></li>
		                </ul>
		            </div>
		            <div class="nav-bar-navi02">
		                <ul class="nav-bar-navi02-ul">
		                    <li class="nav-bar-navi02-li nav-bar-navi02-li01"><a href="<?php bloginfo('url'); ?>/about.html"><span class="nav-bar-navi02-li-txt-t">会社概要</span><span class="nav-bar-navi02-li-txt-u br">Company</span></a></li>
		                    <li class="nav-bar-navi02-li nav-bar-navi02-li02"><a href="<?php bloginfo('url'); ?>/vision.html"><span class="nav-bar-navi02-li-txt-t">ビジョン</span><span class="nav-bar-navi02-li-txt-u br">Vision</span></a></li>
		                    <li class="nav-bar-navi02-li nav-bar-navi02-li03"><a href="<?php bloginfo('url'); ?>/topics.html"><span class="nav-bar-navi02-li-txt-t">耳より情報</span><span class="nav-bar-navi02-li-txt-u br">Topics</span></a></li>
		                    <li class="nav-bar-navi02-li nav-bar-navi02-li04"><a href="<?php bloginfo('url'); ?>/newsrelease.html"><span class="nav-bar-navi02-li-txt-t">ニュース</span><span class="nav-bar-navi02-li-txt-u br">News</span></a></li>
		                    <li class="nav-bar-navi02-li nav-bar-navi02-li05"><a href="<?php bloginfo('url'); ?>/recruit.html"><span class="nav-bar-navi02-li-txt-t">採用情報</span><span class="nav-bar-navi02-li-txt-u br">Recruit</span></a></li>
		                    <li class="nav-bar-navi02-li nav-bar-navi02-li07"><a href="<?php bloginfo('url'); ?>/about.html#Access"><span class="nav-bar-navi02-li-txt-t">アクセス</span><span class="nav-bar-navi02-li-txt-u br">Access</span></a></li>
		                    <li class="nav-bar-navi02-li nav-bar-navi02-li06"><a href="<?php bloginfo('url'); ?>/contact.html"><span class="nav-bar-navi02-li-txt-t">お問い合わせ</span><span class="nav-bar-navi02-li-txt-u br">Contact</span></a></li>
		                </ul>
		                </ul>
		              </div>
		            
		
		        	<!--<nav id="home_nav" class="navbar-collapse collapse">
		    <ul id="menu-omnist_menu" class="nav navbar-nav">
		<li class="menu-item menu-item-home"><a href="#" class="scroll"><span class="menubar menubar-19">HOME</span></a></li>
		<li id="menu-item-1185" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1185">
		        <ul class="head_sns_wrap">
		            <li class="head_sns foot_sns_1">
		                <a href="#" class="fa-stack fa-lg" target="_blank"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x"></i></a>
		            </li>
		            <li class="head_sns foot_sns_2">
		                <a href="#" class="fa-stack fa-lg" target="_blank"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x"></i></a>
		            </li>
		            <li class="head_sns foot_sns_3">
		                <a href="#" class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-envelope-o fa-stack-1x"></i></a>
		            </li>
				</ul></li>
		</ul></nav>-->		
		
		
				<?php //endif; ?>
		
					<?php if ( function_exists( 'ot_get_option' ) ) {
						if (function_exists('icl_object_id') && ot_get_option('show_lang_switcher') == 'on') {
							echo '<div class="language-selector">';
								echo language_selector_flags(ot_get_option('lang_switcher_type'));
							echo '</div>';
						}
					} ?>
		
			</div>
		    
		        	<!-- スマホ時のナビ　-->
		        	<nav id="home_nav" class="navbar-collapse collapse">
		    <ul id="menu-sp_menu" class="nav navbar-nav">
		<li class="menu-item01 menu-item-home"><a href="<?php bloginfo('url'); ?>/about.html"><span class="menubar menubar-01">会社概要</span></a></li>
		<li class="menu-item02 menu-item-home"><a href="<?php bloginfo('url'); ?>/vision.html"><span class="menubar menubar-02">ビジョン</span></a></li>
		<li class="menu-item03 menu-item-home"><a href="<?php bloginfo('url'); ?>/topics.html"><span class="menubar menubar-03">耳より情報</span></a></li>
		<li class="menu-item04 menu-item-home"><a href="<?php bloginfo('url'); ?>/newsrelease.html"><span class="menubar menubar-04">ニュース</span></a></li>
		<li class="menu-item05 menu-item-home"><a href="<?php bloginfo('url'); ?>/recruit.html"><span class="menubar menubar-05">採用情報</span></a></li>
		<li class="menu-item10 menu-item-home"><a href="<?php bloginfo('url'); ?>/about.html#Access"><span class="menubar menubar-10">アクセス</span></a></li>
		<li class="menu-item06 menu-item-home"><a href="<?php bloginfo('url'); ?>/contact.html"><span class="menubar menubar-06">お問い合わせ</span></a></li>
		<li class="menu-item11 menu-item-home"><a><span class="menubar menubar-11">&nbsp;</span></a></li>
		
		<li id="menu-item-09" class="menu-item menu-item-type-custom menu-item-object-custom menu-item09">
		<ul class="head_sns_wrap">
		            <li class="head_sns_li head_sns foot_sns_1"><a href="<?php bloginfo('url'); ?>/factory/"><span class="menubar menubar-07">ｽﾏｰﾄﾌｧｸﾄﾘｰ事業</span></a></li>
		            <li class="head_sns_li head_sns foot_sns_2"><a href="<?php bloginfo('url'); ?>/energy/"><span class="menubar menubar-08">ｽﾏｰﾄｴﾈﾙｷﾞｰ事業</span></a></li>
		            <li class="head_sns_li head_sns foot_sns_5">
		                <a href="http://smartfactorylabo.com/" target="_blank">スマラボ</a>
		            </li>
		<li class="head_sns_li head_sns foot_sns_5">
		                <a href="https://connected-engineering.com/" target="_blank">Team Cross FA</a>
		            </li>
		            <li class="head_sns_li foot_sns_4"><button type="button" class="navbar-toggle navbar-toggle-02" data-toggle="collapse" data-target=".navbar-collapse"><span class="foot_sns_4_inner">閉じる</span></button>
		            </li>
		            
		</ul>
		</li>
		</ul></nav>		
		    
		
		</div><!-- .navbar-relative-top -->
	</div>
</div>

<div class="container">
		<?php if(is_page(home)) : ?>

<div class="pc_slider_wrap"><?php echo do_shortcode('[smartslider3 slider=2]'); ?></div>
<div class="sp_slider_wrap"><?php echo do_shortcode('[smartslider3 slider=3]'); ?></div>

	<?php endif; ?>
</div>


</div>
<!-- End of Navigation Bar -->