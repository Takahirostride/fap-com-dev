<!-- Footer -->

<?php if (function_exists( 'ot_get_option' )) {
	$value = ot_get_option( 'footer_content_color' );
	$parallax = ot_get_option( 'activate_footer_parallax' );
	$parallax = (isset($parallax) && $parallax == 'on') ? ' parallax' : '' ;
	if ( $value == 'dark' ) {
		$content_class = 'dark-content';
		$icons_class = 'dark-icons';
	} elseif ( $value == 'light' ) {
		$content_class = 'light-content';
		$icons_class = 'light-icons';
	}
} ?>

<!-- Footer -->
<!--<footer class="footer<?php echo $parallax; ?> photo-section dark-section <?php echo $content_class; ?>">-->
<footer class="main_footer">
	<div class="">
    	<div class="main_footer_content clearfix">
            <div class="main_footer_cont_wrap main_footer_cont_wrap1">
                <ul class="main_footer_ul">
                    <li class="main_footer_li"><a href="<?php bloginfo('url'); ?>/about.html">会社概要</a></li>
                    <li class="main_footer_li"><a href="<?php bloginfo('url'); ?>/vision.html">ビジョン</a></li>
                    <li class="main_footer_li"><a href="<?php bloginfo('url'); ?>/topics.html">耳寄り情報</a></li>
                    <li class="main_footer_li"><a href="<?php bloginfo('url'); ?>/newsrelease.html">ニュース</a></li>
                    <li class="main_footer_li"><a href="<?php bloginfo('url'); ?>/recruit.html">採用情報</a></li>
                    <li class="main_footer_li"><a href="<?php bloginfo('url'); ?>/about.html#Access">アクセス</a></li>
                    <li class="main_footer_li"><a href="<?php bloginfo('url'); ?>/contact.html">お問い合わせ</a></li>
                    <li class="main_footer_li"><a href="<?php bloginfo('url'); ?>/about/policy.html">プライバシーポリシー</a></li>
                </ul>
                <div class="clear"></div>
            </div><!-- .main_footer_column01 -->

            <!-- <div class="main_footer_cont_wrap">
               <ul class="main_footer_ul">
                    <li class="main_footer_li main_footer_li_long"><a href="<?php bloginfo('url'); ?>/energy/case_study/">オーナー様向選定方法</a></li>
                    <li class="main_footer_li main_footer_li_long"><a href="<?php bloginfo('url'); ?>/energy/product/">推奨製品</span></a></li>
                    <li class="main_footer_li main_footer_li_long"><a href="<?php bloginfo('url'); ?>/#">オーナー様向事例</a></li>
                    <li class="main_footer_li main_footer_li_long"><a href="<?php bloginfo('url'); ?>/energy/knowledge/">豆知識一覧</a></li>
                    <li class="main_footer_li main_footer_li_long"><a href="<?php bloginfo('url'); ?>/energy/document_download/">資料一覧</a></li>
                </ul>
                <div class="clear"></div>
                <ul class="main_footer_ul">
                    <li class="main_footer_li main_footer_li_long"><a href="<?php bloginfo('url'); ?>/#">EPC業者様向選定方法</a></li>
                    <li class="main_footer_li main_footer_li_long"><a href="<?php bloginfo('url'); ?>/select/">取扱製品</span></a></li>
                    <li class="main_footer_li main_footer_li_long"><a href="<?php bloginfo('url'); ?>/#">EPC業者様向事例</a></li>
                </ul>
                <div class="clear"></div>
            </div> -->
            <!-- .main_footer_column02 -->
        </div>

    </div><!-- .main_footer_cont -->

    <div class="main_footer_cont_under">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="main_footer_cont_under_left_name">株式会社FAプロダクツ</div>
                    <div class="main_footer_cont_under_left_txt">〒105-0004 東京都港区新橋5丁目35番10号 <br class="d-block d-md-none">新橋アネックス2階</div>
                    <div class="main_footer_cont_under_left_txt">TEL:03-6453-6761  /  FAX:03-6453-6762</div>
                </div>
                <div class="col-md-4">
                    <p class="copy">Copyright &copy; <?php echo date("Y"); ?> FA Products All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="scrolltotop">
	<i class="fa fa-chevron-up"></i>
</div>
<!-- End of Footer -->


<!-- Javascript files -->
<!-- Placed at the end of the document so the pages load faster -->
<?php wp_footer(); ?>

</body>
</html>