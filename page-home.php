<?php
/*
Template Name:FAProject HOME
*/
?>
<?php get_header('page'); ?>

<!-- Begin Container -->
<section class="content page-home-content">
<div class="cont-container">
<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'static-page' ); ?>>
<?php
// Page thumbnail and title.
//the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header><!-- .entry-header -->' );
?>
<div class="entry-content">
<?php //the_content(); ?>


<section class="fap-enterprise">
<div class="container">
    <div class="cont-h2 mb-0">
        <h2 class="cont-h2-txt text-center mt-5">FAプロダクツ基幹事業</h2>
        <div class="cont-h2-subtxt bg-white text-center">ENTERPRISE</div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 cont_three_column_li_wrap">
            <a href="https://fa-products.jp/factory/">
            <h3 class="cont_three_column_catch py-4 text-info">
                スマートファクトリー 事業<i class="fas fa-industry ml-2"></i>
            </h3>
            <div class="cont_three_column_li-imgbox">
                <img src="<?php bloginfo('template_url');?>/images/com_img1.jpg" class="img-fluid rounded" alt="" />
                <div class="cont_three_column_li-txtbox px-2 pt-5">
                    <h4>Smart Factoryを実現するソリューション</h4>
                    <ul class="">
                        <li>自社運用できる稼働監視パッケージ</li>
                        <li>ＮＧデータが不要な予知保全システム</li>
                        <li>物流、生産を最適化する生産シミュレータ</li>
                        <li>パッケージ化されたロボットシステム&emsp;等</li>
                    </ul>
                </div>
            </div>
            </a>
        </div>
        <div class="col-12 col-md-4 cont_three_column_li_wrap">
            <a href="https://fa-products.jp/weintek/">
            <h3 class="cont_three_column_catch py-4 text-info">
                IoTサーバー/ゲートウェイ事業<i class="fas fa-server ml-2"></i>
            </h3>
            <div class="cont_three_column_li-imgbox">
                <img src="https://fa-products.jp/syst/wp-content/uploads/2016/12/IoT_image.jpg" class="img-fluid rounded" alt="">
                <div class="cont_three_column_li-txtbox px-2 pt-5">
                    <h4>Smart Factoryを実現するIoT化機器販売</h4>
                    <ul class="">
                        <li>産業用IoTサーバー</li>
                        <li>産業用IoTゲートウェイ</li>
                        <li>ＨＭＩ機能付きIoTサーバー</li><li>HDMI出力機能付きIoTサーバー&emsp;等</li>
                    </ul>
                </div>
            </div>
            </a>
        </div>
        <div class="col-12 col-md-4 cont_three_column_li_wrap">
            <a href="https://fa-products.jp/energy/">
            <h3 class="cont_three_column_catch py-4 text-info">
                スマートエネルギー事業<i class="fas fa-solar-panel ml-2"></i>
            </h3>
            <div class="cont_three_column_li-imgbox">
                <img src="<?php bloginfo('template_url');?>/images/com_img3.jpg" class="img-fluid rounded" alt="" />
                <div class="cont_three_column_li-txtbox px-2 pt-3">
                <h4>Smartエネルギー機器販売</h4>
                <ul class="">
                    <li>モジュール、架台、パワコン、接続箱</li>
                    <li>メンテナンス品、監視ソフトウェア&emsp;他</li>
                </ul>
                <h4>Smartエネルギー物件提案・販売</h4>
                <ul class="">
                    <li>太陽光発電所建設提案、サポート</li>
                    <li>太陽光発電所斡旋販売</li>
                </ul>
                </div>
            </div>
            </a>
        </div>
    </div><!-- /.row -->
</div>
</section>

<section class="mission_bg my-5 py-5">
    <div class="container trsp_black py-5 text-white text-left text-md-center">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h2 class="cont-h2-txt text-center">FAプロダクツの使命</h2>
                <div class="cont-h2-subtxt bg-white text-center mb-5">MISSION</div>
                <p>世界に名を響かせた「Made in Japan」、製造大国ニッポン。</p>
                <p>ところが、人気がある職業は金融、商社、ITなどで製造業は下降気味。<br/>とはいえ、日本のGDPの三割を占めるのはいまでも製造業。</p>
                <p>製造業で働くことの付加価値を高め、働きたい業種ナンバーワンにしたい。<br/>そのために必要なことは、モノづくりを「Smart」にすること。</p>
                <p>製品ライフサイクルが短命化しても、投資効果を出せるSmart Factoryをつくりたい。<br/>Smart Factoryに挑戦するエンジニアや企業の第１歩を後押ししていきたい。</p>
                <p>その一歩を束ねることで日本の製造業に大きな変化をおこして未来を創りだす。</p>
            </div>
        </div><!-- /.row -->
    </div>
</section>

<div class="home-cont cont-center-wrap">
<div class="example">

<section class="">
<div class="container">

<div class="cont-h2">
    <h2 class="cont-h2-txt">新着情報</h2>
    <div class="cont-h2-subtxt">NEWS</div>
</div>

<?php
/*
各ブログから記事取得「news」「knowledge」、「case_study」。
*/
$sql = '';
$blog_id_arr = array(2,3);//取得するブログIDの配列
$tmp = $blog_id_arr;
foreach($blog_id_arr as $b_id){
	$pg = get_query_var( 'page' );//現在何ページ目なのか取得
	if($pg == 0) $pg = 1;//1ページ目は「0」になってしまうのでそれを「1」とする
    next($tmp);
    switch_to_blog($b_id);
    $sql .= <<<HERE
(SELECT *, $b_id as blog_id
FROM $wpdb->posts
WHERE (post_type = 'news' OR post_type = 'knowledge' OR post_type = 'case_study')
AND post_status = 'publish')
HERE;

    if(current($tmp) !== false){
        $sql .= "UNION\n";
    }
    restore_current_blog();
}
$sql .= "ORDER BY post_date DESC\n";
$posts = $wpdb->get_results($sql);//記事のセットを取得
$total = ceil(count($posts)/1);//条件にマッチした記事の総数を取得
$sql .= "LIMIT " . ($pg-1) * 1 . ", 1";//記事を0番目から30個、30番目から30個、…という流れで取得する
$posts = $wpdb->get_results($sql);//改めて記事のセットを取得

?>

<?php
foreach ($posts as $post):
			switch_to_blog($post->blog_id);
			setup_postdata($post);
?>

<div class="row mb-3">
<div class="col-md-3 text-center mb-2 mb-md-0">
    <a href="<?php the_permalink();?>">
    <?php
        $attachment_id=get_field('image',$post->ID);
        echo wp_get_attachment_image(
            $attachment_id,
            'midium-thumb',
            false,
            array(
                'class' => 'img-fluid'
            )
        );
    ?>
    </a>
</div><!--/.col-->
<div class="col-md-9">
    <a class="text-dark" href="<?php the_permalink();?>">
        <h2 class="home_news_tit_link mb-3"><i class="fas fa-project-diagram aura"></i>
            <?php
                if(mb_strlen($post->post_title)>60) { $title= mb_substr($post->post_title,0,60) ; echo $title. ･･･ ;}
                else {echo $post->post_title;}
            ?>
        </h2>
    </a>
    <p class="px-2">
        <?php
            if ( mb_strlen( $post->post_content, 'UTF-8' ) > 150 ) {
            $content = str_replace( '\n', '', mb_substr( strip_tags( $post->post_content ), 0, 150, 'UTF-8' ) );
            echo $content . '…';
            } else {
            echo str_replace( '\n', '', strip_tags( $post->post_content ) );
            }
        ?>
    </p>
    <button class="btn-fa-cv">
        <a href="<?php the_permalink();?>">MORE ></a>
    </button>

    <span class="stitle_ymd text-dark"><?php the_time('Y.m.d'); ?></span>

    <span class="stitle_tags">
        <?php
            $terms = get_the_terms( $post->ID, 'class_tag' );
            if ($terms && ! is_wp_error($terms)): ?>
            <?php foreach($terms as $term): ?>
                <span class="home_news_tags home_news_tags_<?php echo $term->slug; ?>">
                    <a href="<?php echo get_term_link( $term->slug, 'class_tag'); ?>">
                        <?php echo $term->name; ?>
                    </a>
                </span>
            <?php endforeach; ?>
        <?php endif; ?>
    </span>

</div><!--/.col-->
</div><!-- /.row -->
<?php endforeach;?>

<hr>

<?php
$paged = (int) get_query_var('paged');
$args = array(
    'showposts' => 1,
    'offset' => 1,
    'paged' => $paged,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => array('news','knowledge','case_study'),
    //'post_type' => 'news',
    //'category__not_in' => array(),
    'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
?>

<div class="row flex-row-reverse mb-3">
<div class="col-md-3 text-center mb-2 mb-md-0">
    <a href="<?php the_permalink();?>">
        <?php
            $attachment_id=get_field('image',$post->ID);
            echo wp_get_attachment_image(
                $attachment_id,
                'midium-thumb',
                false,
                array(
                    'class' => 'img-fluid'
                )
            );
        ?>
    </a>
</div><!--/.col-->
<div class="col-md-9">
    <a class="text-dark" href="<?php the_permalink();?>">
        <h2 class="home_news_tit_link mb-3"><i class="fas fa-project-diagram aura aura2"></i>
            <?php
                if(mb_strlen($post->post_title)>60) { $title= mb_substr($post->post_title,0,60) ; echo $title. ･･･ ;}
                else {echo $post->post_title;}
            ?>
        </h2>
    </a>
    <p class="px-2">
        <?php
            if ( mb_strlen( $post->post_content, 'UTF-8' ) > 150 ) {
            $content = str_replace( '\n', '', mb_substr( strip_tags( $post->post_content ), 0, 150, 'UTF-8' ) );
            echo $content . '…';
            } else {
            echo str_replace( '\n', '', strip_tags( $post->post_content ) );
            }
        ?>
    </p>
    <button class="btn-fa-cv">
        <a href="<?php the_permalink();?>">MORE ></a>
    </button>

    <span class="stitle_ymd text-dark"><?php the_time('Y.m.d'); ?></span>

    <span class="stitle_tags">
        <?php
        $terms = get_the_terms( $post->ID, 'class_tag' );
        if ($terms && ! is_wp_error($terms)): ?>
            <?php foreach($terms as $term): ?>
            <span class="home_news_tags home_news_tags_<?php echo $term->slug; ?>">
                <a href="<?php echo get_term_link( $term->slug, 'class_tag'); ?>">
                    <?php echo $term->name; ?>
                </a>
                </span>
            <?php endforeach; ?>
        <?php endif; ?>
    </span>
</div><!--/.col-->
</div><!--/.row-->
<?php endwhile; endif; ?>

<hr>

<?php
$paged = (int) get_query_var('paged');
$args = array(
    'showposts' => 1,
    'offset' => 2,
    'paged' => $paged,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => array('news','knowledge','case_study'),
    //'post_type' => 'news',
    //'category__not_in' => array(),
    'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
?>

<div class="row mb-3">
<div class="col-md-3 text-center mb-2 mb-md-0">
    <a href="<?php the_permalink();?>">
        <?php
            $attachment_id=get_field('image',$post->ID);
            echo wp_get_attachment_image(
                $attachment_id,
                'midium-thumb',
                false,
                array(
                    'class' => 'img-fluid'
                )
            );
        ?>
    </a>
</div><!--/.col-->
<div class="col-md-9">
    <a class="text-dark" href="<?php the_permalink();?>">
        <h2 class="home_news_tit_link mb-3"><i class="fas fa-project-diagram aura"></i>
            <?php
                if(mb_strlen($post->post_title)>60) { $title= mb_substr($post->post_title,0,60) ; echo $title. ･･･ ;}
                else {echo $post->post_title;}
            ?>
        </h2>
    </a>
    <p class="px-2">
        <?php
            if ( mb_strlen( $post->post_content, 'UTF-8' ) > 150 ) {
            $content = str_replace( '\n', '', mb_substr( strip_tags( $post->post_content ), 0, 150, 'UTF-8' ) );
            echo $content . '…';
            } else {
            echo str_replace( '\n', '', strip_tags( $post->post_content ) );
            }
        ?>
    </p>
    <button class="btn-fa-cv">
        <a href="<?php the_permalink();?>">MORE ></a>
    </button>

    <span class="stitle_ymd text-dark"><?php the_time('Y.m.d'); ?></span>

    <!--<span class="stitle_tags">
        <?php
        $terms = get_the_terms( $post->ID, 'class_tag' );
        if ($terms && ! is_wp_error($terms)): ?>
            <?php foreach($terms as $term): ?>
            <span class="home_news_tags home_news_tags_<?php echo $term->slug; ?>">
                <a href="<?php echo get_term_link( $term->slug, 'class_tag'); ?>">
                    <?php echo $term->name; ?>
                </a>
                </span>
            <?php endforeach; ?>
        <?php endif; ?>
    </span>-->
</div><!--/.col-->
</div><!--/.row-->
<?php endwhile; endif; ?>

<hr>

<?php
$paged = (int) get_query_var('paged');
$args = array(
    'showposts' => 1,
    'offset' => 3,
    'paged' => $paged,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => array('news','knowledge','case_study'),
    //'post_type' => 'news',
    //'category__not_in' => array(),
    'post_status' => 'publish'
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post();
?>

<div class="row flex-row-reverse mb-3">
<div class="col-md-3 text-center mb-2 mb-md-0">
    <a href="<?php the_permalink();?>">
        <?php
            $attachment_id=get_field('image',$post->ID);
            echo wp_get_attachment_image(
                $attachment_id,
                'midium-thumb',
                false,
                array(
                    'class' => 'img-fluid'
                )
            );
        ?>
    </a>
</div><!--/.col-->
<div class="col-md-9">
    <a class="text-dark" href="<?php the_permalink();?>">
        <h2 class="home_news_tit_link mb-3"><i class="fas fa-project-diagram aura aura2"></i>
            <?php
                if(mb_strlen($post->post_title)>60) { $title= mb_substr($post->post_title,0,60) ; echo $title. ･･･ ;}
                else {echo $post->post_title;}
            ?>
        </h2>
    </a>
    <p class="px-2">
        <?php
            if ( mb_strlen( $post->post_content, 'UTF-8' ) > 150 ) {
            $content = str_replace( '\n', '', mb_substr( strip_tags( $post->post_content ), 0, 150, 'UTF-8' ) );
            echo $content . '…';
            } else {
            echo str_replace( '\n', '', strip_tags( $post->post_content ) );
            }
        ?>
    </p>
    <button class="btn-fa-cv">
        <a href="<?php the_permalink();?>">MORE ></a>
    </button>

    <span class="stitle_ymd text-dark"><?php the_time('Y.m.d'); ?></span>

    <!--<span class="stitle_tags">
        <?php
        $terms = get_the_terms( $post->ID, 'class_tag' );
        if ($terms && ! is_wp_error($terms)): ?>
            <?php foreach($terms as $term): ?>
            <span class="home_news_tags home_news_tags_<?php echo $term->slug; ?>">
                <a href="<?php echo get_term_link( $term->slug, 'class_tag'); ?>">
                    <?php echo $term->name; ?>
                </a>
                </span>
            <?php endforeach; ?>
        <?php endif; ?>
    </span>-->
</div><!--/.col-->
</div><!--/.row-->
<?php endwhile; endif; ?>

<hr>

<?php wp_reset_query(); ?>
<?php wp_reset_postdata(); ?>
<?php restore_current_blog(); //子ブログ終了時に入れる?>

</div><!-- .cont_half_02_wrap -->
</div><!-- .container -->
</section>


<section class="news_bg news_release my-5 py-md-5">
    <div class="container trsp_black py-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h2 class="cont-h2-txt text-white">ニュースリリース</h2>
                <div class="cont-h2-subtxt bg-white mb-5">NEWS RELEASE</div>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-10 pl-lg-5">

                    <?php
                            $paged = (int) get_query_var('paged');
                            $args = array(
                            'posts_per_page' => 6,
                            'paged' => $paged,
                            'orderby' => 'post_date',
                            'order' => 'DESC',
                            'post_type' => 'post',
                            //'category__not_in' => array(),
                            'post_status' => 'publish'
                            );
                            $the_query = new WP_Query($args);
                            if ( $the_query->have_posts() ) :
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                            ?>
                    <li class="text-white mb-3">
                        <span class="news_date"><?php the_time('Y/m/d'); ?></span><br class="br_sp" />
                        <a class="text-white" href="<?php the_permalink();?>">
                            <?php the_title(); ?><br>
                            <small class="pl-4">
                            <?php
                                if ( mb_strlen( $post->post_content, 'UTF-8' ) > 82 ) {
                                $content = str_replace( '\n', '', mb_substr( strip_tags( $post->post_content ), 0, 82, 'UTF-8' ) );
                                echo $content . '…';
                                } else {
                                echo str_replace( '\n', '', strip_tags( $post->post_content ) );
                                }
                            ?>
                            </small>
                        </a>
                    </li>

                    <?php endwhile; endif; ?>

                    </div><!-- /.box-page -->

                    <div class="col-lg-2 pt-5 pt-lg-0 text-center">
                        <button class="btn-fa-brast text-white">
                            <a class="text-white" href="<?php bloginfo('url'); ?>/newsrelease.html">MORE ></a>
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- .container -->
</section>

<section>


</section>


    <!--
    <div class="sigle-btn-cont cont-btn-wrap02 hover-opa">
        <a href="<?php bloginfo('url'); ?>/contact/"><span class="sigle-btn-cont-inner">お気軽にご相談ください</span></a>
    </div>-->
</div><!-- .entry-content -->
</article><!-- #post-## -->

    <?php endwhile; ?>
</div><!-- End Container/.cont-container -->
</section><!-- End of content/.page-home-content -->

<?php get_footer(); ?>