<?php
/*
Template Name:FAProject /message
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

<section class="message">
    <div class="container mt-5 pt-5">
        <h2 class="sub-title">代表者メッセージ</h2>
        <div class="row">
            <div class="col-lg-6">
                <figure class="d-block mx-auto text-center">
                    <img src="<?php bloginfo('template_url');?>/images/fap-pesident-20190417_11.jpg" alt="" class="wp-image-939 w-100 image-fluid rounded">
                    <figcaption>
                        <div class="row">
                            <div class="col-6">代表取締役会長 <br class="d-block d-md-none">天野 眞也</div>
                            <div class="col-6">代表取締役社長 <br class="d-block d-md-none">貴田 義和</div>
                        </div><!-- /.row -->                        　
                    </figcaption>
                </figure>
            </div>
            <div class="col-lg-6">
                <p class="h6 mb-5">
            	日本の基幹産業である製造業。その製造業を再び活性化させたいというのが、FAプロダクツの想いです。<br><br>
            	かつて世界はMade in Japanの製品であふれかえっていましたが、現在では一部の業界を除き苦戦しているのが現状です。<br><br>
            	しかし、生産技術の領域では、日本が世界No.1の競争力を持っていると確信しています。<br><br>
            	その証拠にロボット、工作機械、FA機器の分野では日本メーカーが高いシェアを占め、IoT分野では世界が日本に期待しています。<br><br>
            	「カイゼン」という言葉も既にグローバルで使われ、多くのエンジニアが日本の生産技術を学びにきています。<br><br>
            	苦戦していると言われている製造業は、この「生産技術分野」を武器にし、作っている製品、サービスの価値を上げて戦っていく必要があります。<br><br>
                「インダストリー4.0」「コネクテッド・インダストリーズ」の時代は、再び日本が世界をリードしていく責務があります。</p>
            </div>
        </div><!-- /.row -->
    </div>
    <div class="container-fluid com_bg text-white py-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-1">
            	<p class="h5 bold my-5 mx-lg-5 p-lg-2 trsp_black">
                製造業の文化を新しく創り変え、変革により新しい価値を世の中に提供したい。<br><br><br>
                製造業、生産技術を人気職種にしていきたい。<br><br><br>
                先輩たちが築き上げた日本を、FAプロダクツの力で製造業を再び活性化させることで、<br><br>
                次世代に胸をはってバトンを渡したい。</p>
            </div>
            <div class="col-lg-10 offset-lg-1">
                <p class="h6 my-5 mx-lg-5">
                いまも創業時の想いは変わらず、コネクテッド・インダストリーズを実現する文化醸成のプロデューサーとして、
                各種サービスの強化、人材育成を加速し、製造業復活の一翼を担う、今後のFAプロダクツにご期待ください。</p>
            </div>
        </div><!-- /.row -->
    </div>
</section>


        </div><!-- .entry-content -->
    </article><!-- #post-## -->

    <?php endwhile; ?>
<!-- End Container -->
</section>

<?php get_footer(); ?>