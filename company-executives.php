<?php
/*
Template Name:FAProject /executives
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

<section class="executive-officer bg-secondary">
    <div class="container py-5">
        <h2 class="sub-title text-white">役員紹介</h2>
        <div class="row">

            <div class="col-lg-12 pb-3 px-0 bg-white text-center">
                <dl>
                    <dt class="bg-dark text-white px-3 py-2">代表取締役会長</dt>
                    <dd class="bg-dark text-white px-3 py-2">天野 眞也　<br class="pcnone" /><span class="name_s">Shinya Amano</span></dd>
                </dl>
                <div class="row m-0">
                    <div class="col-md-4 mb-3">
                        <img src="https://fa-products.jp/syst/wp-content/uploads/2016/12/company_img2-1.jpg" alt="天野　眞也代表取締役会長" 
                        class="mofficers_img img-fluid rounded mx-3"/>
                    </div>
                    <div class="col-md-8 text-md-left">
                        <p class="mofficer_txt">■株式会社キーエンス入社<br/>・海外営業・重点顧客チームに所属</p>
                        <p class="mofficer_txt">■株式会社FAナビ<br/>代表取締役社長就任</p>
                        <p class="mofficer_txt">■株式会社FAプロダクツ<br/>代表取締役会長就任</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 pb-3 px-0 bg-white text-center">
                <dl>
                    <dt class="bg-dark text-white px-3 py-2">代表取締役社長</dt>
                    <dd class="bg-dark text-white px-3 py-2">貴田 義和　<br class="pcnone" /><span class="name_s">Yoshikazu Kida</span></dd>
                </dl>
                <div class="row m-0">
                    <div class="col-md-4 mb-3">
                        <img src="https://fa-products.jp/syst/wp-content/uploads/2016/12/company_img3-1.jpg" alt="貴田　義和代表取締役社長" 
                        class="mofficers_img img-fluid rounded mx-3"/>
                    </div>
                    <div class="col-md-8 text-md-left">
                        <p class="mofficer_txt">■株式会社キーエンス入社<br/>・西日本統括マネージャー就任<br/>・海外営業・重点顧客チームに所属<br/>（自動車・2次電池業界大手攻略専任担当）</p>
                        <p class="mofficer_txt">■株式会社FAナビ　取締役就任</p>
                        <p class="mofficer_txt">■株式会社FAプロダクツ<br/>代表取締役就任</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 pb-3 px-0 bg-white text-center">
                <dl>
                    <dt class="bg-dark text-white px-3 py-2">取締役</dt>
                    <dd class="bg-dark text-white px-3 py-2">飯野 英城　<br class="pcnone" /><span class="name_s">Hideki Iino</span></dd>
                </dl>
                <div class="row m-0">
                    <div class="col-md-4 mb-3">
                        <img src="https://fa-products.jp/syst/wp-content/uploads/2016/12/company_img4-2.jpg" alt="取締役　飯野英城" 
                        class="mofficers_img img-fluid rounded mx-3"/>
                    </div>
                    <div class="col-md-8 text-md-left">
                        <p class="mofficer_txt">■株式会社オフィス エフエイ・コム設立<br />代表取締役就任</p>
                        <p class="mofficer_txt">■株式会社FAプロダクツ<br/>取締役CTO就任（兼務）</p>
                    </div>
                </div>
            </div>

        </div><!--/.row-->
    </div><!--/.container-->
</section>


        </div><!-- .entry-content -->
    </article><!-- #post-## -->

    <?php endwhile; ?>
<!-- End Container -->
</section>

<?php get_footer(); ?>