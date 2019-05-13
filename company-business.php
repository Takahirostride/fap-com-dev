<?php
/*
Template Name:FAProject /business
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

<section class="partnership my-5 py-5">
    <div class="container">
        <h2 class="sub-title">主要パートナー</h2>
        <div class="row">
            <div class="col-lg-4">
                <p class="partner_catch partner_catch_b">スマートファクトリー事業</p>
                <ul class="partner_txt text-left">
                    <li>
                        <a class="text-dark" href="http://www.office-fa.com/ja/index.html" target=”_blank”>オフィス　エフエイ・コム</a>
                    </li>
                    <li>
                        <a class="text-dark" href="http://robotcom.jp/" target=”_blank”>ロボコム</a>
                    </li>
                    <li>
                        <a class="text-dark" href="http://www.jss1.jp/index.html" target=”_blank”>日本サポートシステム</a>
                    </li>
                </ul>
                <!--<p class="partner_txt"><i class="fa fa-play-circle" aria-hidden="true"></i><a href="##">その他FA系パートナー企業</a></p>-->
            </div>
            <div class="col-lg-4">
                <p class="partner_catch partner_catch_bk">IoTサーバー/ゲートウェイ事業</p>
                <ul class="partner_txt text-left">
                    <li>
                        <a class="text-dark" href="https://www.weintek.com/globalw/" target=”_blank”>WEINTEK</a>
                    </li>
                </ul>
                <!--<p class="partner_txt"><i class="fa fa-play-circle" aria-hidden="true"></i><a href="https://fa-products.jp/energy/product">その他環境、エネルギー系パートナー企業</a></p>-->
            </div>
            <div class="col-lg-4">
                <p class="partner_catch partner_catch_r">スマートエネルギー事業</p>
                <ul class="partner_txt text-left">
                    <li>ワイドミュラー</li>
                    <li>リープトンエナジー</li>
                    <li>
                        <a class="text-dark" href="https://fa-products.jp/energy/product">その他環境、エネルギー系パートナー企業</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="client bg_g">
    <article class="container mb-5 py-5">
        <h2 class="sub-title">主要取引先</h2>
        <!--<p>エグチホールディングス株式会社、王子エンジニアリング株式会社、株式会社沖データ、川崎重工業株式会社、株式会社協和エクシオ、<br/>三晃金属工業株式会社、しげる工業株式会社、株式会社ジェイアイエヌ、
        THK株式会社、株式会社電通国際情報サービス、<br/>田中商事株式会社、東亜工業株式会社、日新商事株式会社、株式会社不二越、ブラザー工業株式会社、森永乳業株式会社、<br/>森六テクノロジー株式会社、ヤマシンフィルタ株式会社、株式会社やまびこ、yh株式会社</p>-->
        <ul class="list-inline">
            <li class="list-inline-item">エグチホールディングス株式会社</li>
            <li class="list-inline-item">王子エンジニアリング株式会社</li>
            <li class="list-inline-item">株式会社沖データ</li>
            <li class="list-inline-item">川崎重工業株式会社</li>
            <li class="list-inline-item">株式会社協和エクシオ</li>
            <li class="list-inline-item">三晃金属工業株式会社</li>
            <li class="list-inline-item">しげる工業株式会社</li>
            <li class="list-inline-item">株式会社ジェイアイエヌ</li>
            <li class="list-inline-item">THK株式会社</li>
            <li class="list-inline-item">株式会社電通国際情報サービス</li>
            <li class="list-inline-item">田中商事株式会社</li>
            <li class="list-inline-item">東亜工業株式会社</li>
            <li class="list-inline-item">日新商事株式会社</li>
            <li class="list-inline-item">株式会社不二越</li>
            <li class="list-inline-item">ブラザー工業株式会社</li>
            <li class="list-inline-item">森永乳業株式会社</li>
            <li class="list-inline-item">森六テクノロジー株式会社</li>
            <li class="list-inline-item">ヤマシンフィルタ株式会社</li>
            <li class="list-inline-item">株式会社やまびこ</li>
            <li class="list-inline-item">yh株式会社</li>
        </ul>
    </article>
</section>


        </div><!-- .entry-content -->
    </article><!-- #post-## -->

    <?php endwhile; ?>
<!-- End Container -->
</section>

<?php get_footer(); ?>