<?php get_header('page'); ?>
<!-- Begin Container -->
<style type="text/css">
.mpage_block {padding:50px 10px;}
.mbox-page {max-width:none;margin:0 auto;text-align:center;}
.mbox_left {display:inline-block;vertical-align:top;width:350px}
.mbox_center {display:inline-block;vertical-align:top;width:350px;}
.mbox_right {display:inline-block;vertical-align:top;width:350px;}
.mofficers {text-align:left;}
.mofficer_txt{font-size:12px;}
.mofficers_img {float:left;margin-right:5px;margin-bottom:10px;}
.mofficers dl dt {font-size:12px;color:#07a3fd;}
.mofficers dl dd {font-size:18px;font-weight:bold;}
.name_s {font-size:11px;padding-left:0px;font-weight:normal;}
.d-flex {display:flex;}

</style>
<section class="content page-content page-company-content">
    <div class="container">
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

                <section class="page_block bg_w page_block_top">
                    <h2 class="sub-title">FAプロダクツについて</h2>
                    <div class="box-page">
                        <div class="box-about_left">
                            <ul class="about">
                            <li><span class="about_catch">商号</span><span class="about_txt">株式会社 FAプロダクツ （読み：エフエープロダクツ）</span></li>
                            <li><span class="about_catch">英文表記</span><span class="about_txt">FA Products Inc.</span></li>
                            <li><span class="about_catch">所在地</span><span class="about_txt">〒105-0004<br/>東京都港区新橋5丁目35番10号 新橋アネックス2階</span></li>
                            <li><span class="about_catch">設立</span><span class="about_txt">2011年8月</span></li>
                            <li><span class="about_catch">代表取締役会長</span><span class="about_txt">天野　眞也</span></li>
                            <li><span class="about_catch">代表取締役社長</span><span class="about_txt">貴田　義和</span></li>
                            <li><span class="about_catch">資本金</span><span class="about_txt">7億 6,500万円（資本準備金含む）（2019年3月26日現在）</span></li>
                            <li><span class="about_catch">事業内容</span>
                            <ul class="about_txt">
                            <p><strong>【Smart Factory実現における総合支援】</strong></p>
                            <li>設備稼働監視・故障予知、生産シミュレータ、生産シミュレーター導入活用サービス</li>
                            <li>製造業向けロボットシステムなどスマートファクトリー化パッケージの企画・販売</li>
                            <li>スマートファクトリー構築プロデュース及びコンサルティング</li>
                            </ul>
                            <ul class="about_txt">
                            <p><strong>【Smart Energy実現における総合支援】</strong></p>
                            <li>再生可能エネルギー発電所の物件紹介、販売</li>
                            <li>再生可能エネルギー発電要素部品の販売</li>
                            <li>及びそれに伴うソリューションの提案、販売</li>
                            </ul>
                            </li></ul><!-- /.about -->
                        </div>
                        <div class="box-about_right">
                            <img src="<?php bloginfo('template_url');?>/images/company_img.jpg" />
                        </div>
                    </div>
                </section>


                <section>
                    <div class="container">
                        <div class="row">
                            <h2 class="sub-title">代表者メッセージ</h2>
                            <div class="wp-block-image">
                                <figure class="aligncenter"><img src="https://fa-products.jp/syst/wp-content/uploads/2019/03/company_img23-32.png" alt="" class="wp-image-939"><figcaption>代表取締役会長 天野 眞也　代表取締役社長 貴田 義和</figcaption></figure>
                            </div>
                            <p class="text-center">
                            日本の基幹産業である製造業。その製造業を再び活性化させたいというのが、FAプロダクツの想いです。<br><br>
                            かつて世界はMade in Japanの製品であふれかえっていましたが、現在では一部の業界を除き苦戦しているのが現状です。<br>
                            しかし、生産技術の領域では、日本が世界No.1の競争力を持っていると確信しています。<br>
                            その証拠にロボット、工作機械、FA機器の分野では日本メーカーが高いシェアを占め、IoT分野では世界が日本に期待しています。<br><br>
                            「カイゼン」という言葉も既にグローバルで使われ、多くのエンジニアが日本の生産技術を学びにきています。<br>
                            苦戦していると言われている製造業は、この「生産技術分野」を武器にし、作っている製品、サービスの価値を上げて戦っていく必要があります。<br><br>
                            「インダストリー4.0」「コネクテッド・インダストリーズ」の時代は、再び日本が世界をリードしていく責務があります。<br><br>
                            　製造業の文化を新しく創り変え、変革により新しい価値を世の中に提供したい。<br><br>
                            　製造業、生産技術を人気職種にしていきたい。<br><br>
                            　先輩たちが築き上げた日本を、FAプロダクツの力で製造業を再び活性化させることで、次世代に胸をはってバトンを渡したい。<br><br>
                            いまも創業時の想いは変わらず、コネクテッド・インダストリーズを実現する文化醸成のプロデューサーとして、<br>
                            各種サービスの強化、人材育成を加速し、製造業復活の一翼を担う、今後のFAプロダクツにご期待ください。</p>
                        </div>
                    </div>
                </section>

                <section class="page_block bg_g">
                    <h2 class="sub-title">主要取引先</h2>
                    <div class="box-page">
                        <p>エグチホールディングス株式会社、王子エンジニアリング株式会社、株式会社沖データ、川崎重工業株式会社、株式会社協和エクシオ、<br/>三晃金属工業株式会社、しげる工業株式会社、株式会社ジェイアイエヌ、
                        THK株式会社、株式会社電通国際情報サービス、<br/>田中商事株式会社、東亜工業株式会社、日新商事株式会社、株式会社不二越、ブラザー工業株式会社、森永乳業株式会社、<br/>森六テクノロジー株式会社、ヤマシンフィルタ株式会社、株式会社やまびこ、yh株式会社</p>
                    </div>
                </section>

                <section class="page_block bg_w partner_wrap">
                    <h2 class="sub-title">主要パートナー</h2>
                    <div class="box-page">
                        <div class="box_left">
                            <p class="partner_catch partner_catch_b">スマートファクトリー事業</p>
                            <p class="partner_txt"><a href="http://www.office-fa.com/ja/index.html" target=”_blank”>オフィス　エフエイ・コム、</a><a href="http://robotcom.jp/" target=”_blank”>ロボコム、</a><br><a href="http://www.jss1.jp/index.html" target=”_blank”>日本サポートシステム</a></p>
                            <!--<p class="partner_txt"><i class="fa fa-play-circle" aria-hidden="true"></i><a href="##">その他FA系パートナー企業</a></p>-->                       
                        </div>
                        <div class="box_right box_center">
                            <p class="partner_catch partner_catch_bk">IoTサーバー/ゲートウェイ事業</p>
                            <p class="partner_txt"><a href="https://www.weintek.com/globalw/" target=”_blank”>WEINTEK</a></p>
                            <!--<p class="partner_txt"><i class="fa fa-play-circle" aria-hidden="true"></i><a href="https://fa-products.jp/energy/product">その他環境、エネルギー系パートナー企業</a></p>-->
                        </div>
                        <div class="box_right">
                            <p class="partner_catch partner_catch_r">スマートエネルギー事業</p>
                            <p class="partner_txt">ワイドミュラー、リープトンエナジー</p>
                            <p class="partner_txt"><i class="fa fa-play-circle" aria-hidden="true"></i><a href="https://fa-products.jp/energy/product">その他環境、エネルギー系パートナー企業</a></p>
                        </div>
                    </div>
                </section>

                <section class="mpage_block bg_g">
                    <h2 class="sub-title">役員紹介</h2>
                    <div class="mbox-page">
                        <div class="mbox_left">
                            <div class="mofficers">
                                <dl>
                                <dt>代表取締役会長</dt>
                                <dd>天野 眞也　<br class="pcnone" /><span class="name_s">Shinya Amano</span></dd>
                                </dl>
                                <img src="https://fa-products.jp/syst/wp-content/uploads/2016/12/company_img2-1.jpg" alt="天野　眞也代表取締役会長" 
                                class="mofficers_img"/>
                                <p class="mofficer_txt">■株式会社キーエンス入社<br/>・海外営業・重点顧客チームに所属</p>
                                <p class="mofficer_txt">■株式会社FAナビ<br/>代表取締役社長就任</p>
                                <p class="mofficer_txt">■株式会社FAプロダクツ<br/>代表取締役会長就任</p>
                            </div>
                        </div>

                        <div class="mbox_center">
                            <div class="mofficers">
                                <dl>
                                <dt>代表取締役社長</dt>
                                <dd>貴田 義和　<br class="pcnone" /><span class="name_s">Yoshikazu Kida</span></dd>
                                </dl>
                                <img src="https://fa-products.jp/syst/wp-content/uploads/2016/12/company_img3-1.jpg" alt="貴田　義和代表取締役社長" 
                                class="mofficers_img"/>
                                <p class="mofficer_txt">■株式会社キーエンス入社<br/>・西日本統括マネージャー就任<br/>・海外営業・重点顧客チームに所属<br/>（自動車・2次電池業界大手攻略専任担当）</p>
                                <p class="mofficer_txt">■株式会社FAナビ　取締役就任</p>
                                <p class="mofficer_txt">■株式会社FAプロダクツ<br/>代表取締役就任</p>
                            </div>
                        </div>

                        <div class="mbox_right">
                            <div class="mofficers">
                                <dl>
                                <dt>取締役</dt>
                                <dd>飯野 英城　<br class="pcnone" /><span class="name_s">Hideki Iino</span></dd>
                                </dl>
                                <img src="https://fa-products.jp/syst/wp-content/uploads/2016/12/company_img4-2.jpg" alt="取締役　飯野英城" 
                                class="mofficers_img"/>
                                <p class="mofficer_txt">■株式会社オフィス エフエイ・コム設立<br />代表取締役就任</p>
                                <p class="mofficer_txt">■株式会社FAプロダクツ<br/>取締役CTO就任（兼務）</p>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="page_block bg_w">
                    <h2 class="sub-title">沿革</h2>
                    <div class="box-page">
                        <ul class="history-company">
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
                </section>

                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6"> </div>
                            <div class="col-12 col-md-6"> </div>
                            <div class="col-12 col-md-6"> </div>
                            <div class="col-12 col-md-6"> </div>
                        </div>
                    </div>
                </section>

                <div id="Access">
                    <section class="page_block bg_g">
                        <h2 class="sub-title">アクセス</h2>
                        <div class="box-page">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.5709100926633!2d139.7511406152583!3d35.66294208019861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188beaa48987c3%3A0xc986121c088fac27!2z44CSMTA1LTAwMDQg5p2x5Lqs6YO95riv5Yy65paw5qmL77yV5LiB55uu77yT77yV4oiS77yR77yQIOaWsOapi-OCouODjeODg-OCr-OCuQ!5e0!3m2!1sja!2sjp!4v1522624658754" width="880" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
                            <h3 class="access_catch">都営三田線　御成門駅からお越しの方へ<br class="pcnone" /><span class="access_txt_box">所要時間：4分程度</span></h3>
                            <p class="access_txt">アクセス：A4出口を出て、日比谷公園方向にまっすぐ進みます。左手に芝郵便局のある交差点を右に曲がります。二つ目の交差点を左に曲がると、左手に新橋アネックスビルがありますので、2階へお越しください。</p>
                            <h3 class="access_catch">JR線　新橋駅からお越しの方へ<br class="pcnone" /><span class="access_txt_box">所要時間：9分程度</span></h3>
                            <p class="access_txt">アクセス：烏森出口を出て、徒歩9分です。</p>
                            <h3 class="access_catch">東京メトロ銀座線/都営浅草線　新橋駅からお越しの方へ<br class="pcnone" /><span class="access_txt_box">所要時間：10分程度</span></h3>
                            <p class="access_txt">アクセス：A1出口を出て、徒歩10分です。</p>
                        </div>
                    </section>
                </div>

            </div><!-- .entry-content -->
        </article><!-- #post-## -->

        <?php endwhile; ?>
    </div><!-- End Container -->
</section>

<?php get_footer(); ?>