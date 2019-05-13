<?php
/*
Template Name:FAProject /about
*/
?>
<?php get_header('page'); ?>
<!-- Begin Container -->

<section class="content page-content page-company-content">

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'static-page' ); ?>>

    <div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
    <?php
    // Page thumbnail and title.
    the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header><!-- .entry-header -->' );
    ?>

    <div class="entry-content">
    <?php
    //the_content();
    ?>

<section class="about bg_g">
<div class="container my-5 py-5">
    <h2 class="sub-title">FAプロダクツについて</h2>
    <div class="row">
        <div class="col-lg-8">
            <ul class="about">
                <li><span class="about_catch">商号</span><span class="about_txt">株式会社 FAプロダクツ （読み：エフエープロダクツ）</span></li>
                <li><span class="about_catch">英文表記</span><span class="about_txt">FA Products Inc.</span></li>
                <li><span class="about_catch">所在地</span><span class="about_txt">〒105-0004<br/>東京都港区新橋5丁目35番10号 新橋アネックス2階</span></li>
                <li><span class="about_catch">設立</span><span class="about_txt">2011年8月</span></li>
                <li><span class="about_catch">代表取締役会長</span><span class="about_txt">天野　眞也</span></li>
                <li><span class="about_catch">代表取締役社長</span><span class="about_txt">貴田　義和</span></li>
                <li><span class="about_catch">資本金</span><span class="about_txt">7億 6,500万円（資本準備金含む）（2019年3月26日現在）</span></li>
                <li><span class="about_catch">事業内容</span></li>
            </ul><!-- /.about -->
            <div class="row">
                <div class="col-lg-6">
                    <p><strong>【Smart Factory実現における総合支援】</strong></p>
                    <ul>
                        <li>設備稼働監視・故障予知、生産シミュレータ、生産シミュレーター導入活用サービス</li>
                        <li>製造業向けロボットシステムなどスマートファクトリー化パッケージの企画・販売</li>
                        <li>スマートファクトリー構築プロデュース及びコンサルティング</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <p><strong>【Smart Energy実現における総合支援】</strong></p>
                    <ul>
                        <li>再生可能エネルギー発電所の物件紹介、販売</li>
                        <li>再生可能エネルギー発電要素部品の販売</li>
                        <li>及びそれに伴うソリューションの提案、販売</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <img src="<?php bloginfo('template_url');?>/images/company_img.jpg" />
        </div>
    </div><!-- /.row -->
</div>
</section>


<div id="Access">
    <section class="access bg_g">
        <div class="container py-5">
            <h2 class="sub-title">アクセス</h2>
            <div class="row">
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.5709100926633!2d139.7511406152583!3d35.66294208019861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188beaa48987c3%3A0xc986121c088fac27!2z44CSMTA1LTAwMDQg5p2x5Lqs6YO95riv5Yy65paw5qmL77yV5LiB55uu77yT77yV4oiS77yR77yQIOaWsOapi-OCouODjeODg-OCr-OCuQ!5e0!3m2!1sja!2sjp!4v1522624658754" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-md-6">
                    <h3 class="access_catch">都営三田線　御成門駅からお越しの方へ<br class="pcnone" /><br><span class="access_txt_box">所要時間：4分程度</span></h3>
                    <p class="access_txt">アクセス：A4出口を出て、日比谷公園方向にまっすぐ進みます。左手に芝郵便局のある交差点を右に曲がります。二つ目の交差点を左に曲がると、左手に新橋アネックスビルがありますので、2階へお越しください。</p>
                    <h3 class="access_catch">JR線　新橋駅からお越しの方へ<br class="pcnone" /><br><span class="access_txt_box">所要時間：9分程度</span></h3>
                    <p class="access_txt">アクセス：烏森出口を出て、徒歩9分です。</p>
                    <h3 class="access_catch">東京メトロ銀座線/都営浅草線　新橋駅からお越しの方へ<br class="pcnone" /><br><span class="access_txt_box">所要時間：10分程度</span></h3>
                    <p class="access_txt">アクセス：A1出口を出て、徒歩10分です。</p>
                </div>
            </div>
        </div>
    </section>
</div>


        </div><!-- .entry-content -->
    </article><!-- #post-## -->

    <?php endwhile; ?>
<!-- End Container -->
</section>

<?php get_footer(); ?>