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
                    
					<div class="home-cont cont-center-wrap">
                    
                    <section class="">
                    <div class="mgt50 mgb50">
						<div class="container pdb50">
						  <ul class="cont_three_column_wrap clearfix">
								<li class="cont_three_column_li">
	                                <div class="cont_three_column_li_wrap">
                                    <a href="https://fa-products.jp/fa/plm/index.html">
									<h3 class="cont_three_column_catch">FAシステム事業　＞</h3>
                                    <div class="cont_three_column_li-imgbox">
                                    <img src="<?php bloginfo('template_url');?>/images/com_img1.jpg" alt="" />
                                    <div class="cont_three_column_li-txtbox">
                                    <h4>Smartシステム販売</h4>
									<ul class="cont_three_column_li_lnk">
										<li>IoTシステムの導入・コンサルティング</li>
										<li>データ解析・製造指示・製造データ収集システム</li>
                                        <li>工程設計・生産管理ソフト（生産シミュレーション）</li>
									</ul>
                                    </div>
                                    </div>
                                    </a>
                                    </div>
								</li>
								<li class="cont_three_column_li">
	                                <div class="cont_three_column_li_wrap">
                                    <a href="https://fa-products.jp/fa/seizosetsubi/index.html">
									<h3 class="cont_three_column_catch">FA機器販売事業　＞</h3>
                                    <div class="cont_three_column_li-imgbox">
                                    <img src="<?php bloginfo('template_url');?>/images/com_img2.jpg" alt="" />
                                    <div class="cont_three_column_li-txtbox">
									<h4>Smart機器販売</h4>
									<ul class="cont_three_column_li_lnk">
										<li>制御機器（産業用PC、HMI等）</li>
										<li>FA機器（ハイスピードカメラ、センサー、ロボット等）</li>
									</ul>
                                    </div>
                                    </div>
                                    </a>
                                    </div>
								</li>
								<li class="cont_three_column_li">
                                    <div class="cont_three_column_li_wrap">
                                	<a href="https://fa-products.jp/energy/">
									<h3 class="cont_three_column_catch">環境エネルギー事業　＞</h3>
									<div class="cont_three_column_li-imgbox">
                                    <img src="<?php bloginfo('template_url');?>/images/com_img3.jpg" alt="" />
                                    <div class="cont_three_column_li-txtbox">
                                    <h4>Smartエネルギー機器販売</h4>
									<ul class="cont_three_column_li_lnk">
										<li>モジュール、架台、パワコン、接続箱</li>
										<li>メンテナンス品</li>
                                        <li>監視ソフトウェア　等</li>
									</ul>
                                    </div>
                                    </div>
                                    </a>
                                    </div>
								</li>
							</ul>
						</div><!-- .container -->
					</div><!-- .mgt50 mgb50 -->
                    </section>
                    <section class="cont-home-mission">
	                    <div class="container pdb50">
		                    <div class="cont-h2">
								<h2 class="cont-h2-txt">FAプロダクツの使命</h2>
								<div class="cont-h2-subtxt">MISSION</div>
							</div>
    					<p>世界に名を響かせた「Made in Japan」、製造大国ニッポン</p>
						<p>ところが、人気がある職業は金融、商社、ITなどで製造業は下降気味。<br/>とはいえ、日本のGDPの三割を占めるのはいまでも製造業</p>
						<p>製造業で働くことの付加価値を高め、働きたい業種ナンバーワンにしたい<br/>そのために必要なことは、モノづくりを「Smart」にすること</p>
                        <p>製品ライフサイクルが短命化しても、投資効果を出せるSmart Factoryをつくりたい<br/>Smart Factoryに挑戦するエンジニアや企業の第１歩を後押ししていきたい</p>
                        <p>その一歩を束ねることで日本の製造業に大きな変化をおこして未来を創りだす</p>                       
						</div><!-- .container -->
					</section>
                    <section class="">
                        <div class="container">
							<div class="cont-h2">
								<h2 class="cont-h2-txt">新着情報</h2>
								<div class="cont-h2-subtxt">NEWS</div>
							</div>

					<ul class="cont_home_news_wrap clearfix">
                            
								<?php
								switch_to_blog(2);//切り替える子ブログを選択
								$paged = (int) get_query_var('paged');
								$args = array(
								'posts_per_page' => 1,
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

								<li class="cont_home_news_left">
									<a href="<?php the_permalink();?>"><?php $attachment_id=get_field('image',$post->ID);
										echo wp_get_attachment_image($attachment_id,array(723, 534));?>
									</a>
   									<span class="stitle">
									<a href="<?php the_permalink();?>">
										<h2 class="home_news_tit_link"><?php if(mb_strlen($post->post_title)>56) { $title= mb_substr($post->post_title,0,56) ; echo $title. ･･･ ;
} else {echo $post->post_title;}?></h2>
									</a>
									<span class="stitle_ymd"><?php the_time('Y.m.d'); ?></span>
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
								</li>

                            					<?php endwhile; endif; ?>


								<li class="cont_home_news_right">
                                
							<?php //query_posts('post_type=news&showposts=1&offset=1'); ?>
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
									<div class="cont_home_news_right01">
										<a href="<?php the_permalink();?>"><?php $attachment_id=get_field('image',$post->ID);
										echo wp_get_attachment_image($attachment_id,'midium-thumb');?></a>
										<!--<a href="<?php the_permalink();?>"><?php $attachment_id=get_field('image',$post->ID);
										echo wp_get_attachment_image($attachment_id,array(441, 296));?></a>-->
                                        <span class="stitle">
                                            <a href="<?php the_permalink();?>"><h2 class="home_news_tit_link"><?php if(mb_strlen($post->post_title)>38) { $title= mb_substr($post->post_title,0,38) ; echo $title. ･･･ ;
} else {echo $post->post_title;}?></h2></a>
                                            <span class="stitle_ymd"><?php the_time('Y.m.d'); ?></span>
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
                                        </span>
									</div>
                            <?php endwhile; endif; ?>

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
									<div class="cont_home_news_right02">
										<a href="<?php the_permalink();?>"><?php $attachment_id=get_field('image',$post->ID);
										echo wp_get_attachment_image($attachment_id,array(203, 203));?></a>
                                        <span class="stitle">
                                            <a href="<?php the_permalink();?>"><h2 class="home_news_tit_link"><?php if(mb_strlen($post->post_title)>15) { $title= mb_substr($post->post_title,0,15) ; echo $title. ･･･ ;
} else {echo $post->post_title;}?></h2></a>
                                            <span class="stitle_ymd"><?php the_time('Y.m.d'); ?></span>
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
                                        </span>
									</div>
                            <?php endwhile; endif; ?>

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
									<div class="cont_home_news_right02">
										<a href="<?php the_permalink();?>"><?php $attachment_id=get_field('image',$post->ID);
										echo wp_get_attachment_image($attachment_id,array(200, 200));?></a>
                                        <span class="stitle">
                                            <a href="<?php the_permalink();?>"><h2 class="home_news_tit_link"><?php if(mb_strlen($post->post_title)>15) { $title= mb_substr($post->post_title,0,15) ; echo $title. ･･･ ;
} else {echo $post->post_title;}?></h2></a>
                                            <span class="stitle_ymd"><?php the_time('Y.m.d'); ?></span>
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
                                        </span>
									</div>
                            <?php endwhile; endif; ?>
								</li>

							</ul>
					<?php wp_reset_query(); ?>
                    <?php restore_current_blog(); //子ブログ終了時に入れる?>																	
					<div class="clear"></div>


						</div><!-- .cont_half_02_wrap -->
					</div><!-- .container -->
                    </section>
					<section class="bg_g news_release">
					   <div class="container pdb50">
		                    <div class="cont-h2">
								<h2 class="cont-h2-txt">ニュースリリース</h2>
								<div class="cont-h2-subtxt">NEWS RELEASE</div>
							</div>
                        <div class="box-page">
    					<ul class="news_list">
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
                        <li><span class="news_date"><?php the_time('Y/m/d'); ?></span><br class="br_sp" /><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
                        <?php endwhile; endif; ?>         
                        </ul>
                        
                        <div class="sigle-btn-cont-more cont-btn-wrap02 hover-opa">
                        <a href="<?php bloginfo('url'); ?>/newsrelease.html">MORE ></a>
                        </div>
                        </div>
						</div><!-- .container -->
                     </section>

                   <!--
                    <div class="sigle-btn-cont cont-btn-wrap02 hover-opa">
                        <a href="<?php bloginfo('url'); ?>/contact/"><span class="sigle-btn-cont-inner">お気軽にご相談ください</span></a>
                    </div>-->
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

		<?php endwhile; ?>
	</div><!-- End Container -->
</section>

<?php get_footer(); ?>