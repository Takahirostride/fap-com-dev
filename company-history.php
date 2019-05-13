<?php
/*
Template Name:FAProject /history
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

<section class="history bg-secondary">
    <div class="container py-5">
        <h2 class="sub-title text-white">沿革</h2>
        <div class="row">
            <ul class="history-company col-lg-8 offset-lg-2 text-white">
                <li><span class="history_date">2011年8月</span><span class="history_txt">株式会社FAプロダクツ設立</span></li>
                <li><span class="history_date">2013年4月</span><span class="history_txt">株式会社電通国際情報サービスとシーメンスプロダクトライフサイクルマネジメントのソフトウェアリセラー契約を締結</span></li>
                <li><span class="history_date">2014年6月</span><span class="history_txt">700万円の増資（資本金1,000万円）</span></li>
                <li><span class="history_date">2015年3月</span><span class="history_txt">株式会社3次元メディアとシステムインテグレーション領域における提携</span></li>
                <li><span class="history_date">2016年1月</span><span class="history_txt">ルネサスエレクトロニクス株式会社とR-inコンソーシアムを活用した新商品開発において提携</span></li>
                <li><span class="history_date">2016年3月</span><span class="history_txt">FAプロダクツとアドバンテックがIoT/インダストリ4.0分野でアライアンス提携</span></li>
                <li><span class="history_date">2016年8月</span><span class="history_txt">代表取締役会長に天野眞也が就任</span></li>
                <li><span class="history_date">2018年7月</span><span class="history_txt">FA・ロボットシステムインテグレータ協会に加盟</span></li>
                <li><span class="history_date">2018年8月</span><span class="history_txt">日本サポートシステム株式会社より株式譲渡、筆頭株主として協業体制構築</span></li>
                <li><span class="history_date">2019年3月</span><span class="history_txt">第三者割当増資により、スマートファクトリー分野で株式会社電通国際情報サービスと資本・業務提携</span></li>
                <li><span class="history_date">2019年3月</span><span class="history_txt">資本金を7億6.500万円（資本準備金含む）に増資</span></li>
            </ul>
        </div>
    </div>
</section>


        </div><!-- .entry-content -->
    </article><!-- #post-## -->

    <?php endwhile; ?>
<!-- End Container -->
</section>

<?php get_footer(); ?>