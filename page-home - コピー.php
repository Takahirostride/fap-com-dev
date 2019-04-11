<?php
/*
Template Name:FAProject HOME
*/
?>
<?php get_header('page'); ?>
<!-- Begin Container -->
<section class="content page-content">
	<div class="cont-container">
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'static-page' ); ?>>
				<?php
					// Page thumbnail and title.
					//the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header><!-- .entry-header -->' );
				?>

				<div class="entry-content">
					<?php the_content(); ?>
                    
					<div class="home-cont cont-center-wrap">
						<div class="container">
							<div class="cont-h2">
								<h2 class="cont-h2-txt">新着情報</h2>
								<div class="cont-h2-subtxt">NEWS</div>
							</div>

					<?php query_posts('post_type=news&posts_per_page=1'); ?>
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
            
							<ul class="cont_home_news_wrap clearfix">
								<li class="cont_home_news_left">
									<?php $attachment_id=get_field('image',$post->ID);
									echo wp_get_attachment_image($attachment_id,array(723, 534));?>
   									<span class="stitle"><h2><?php the_title(); ?></h2></span>
								</li>
								<li class="cont_home_news_right">
									<div class="cont_home_news_right01">
										<?php $attachment_id=get_field('image',$post->ID);
										echo wp_get_attachment_image($attachment_id,'midium-thumb');?>
									</div>
									<div class="cont_home_news_right02">
										<?php $attachment_id=get_field('image',$post->ID);
										echo wp_get_attachment_image($attachment_id,array(200, 200));?>
									</div>
									<div class="cont_home_news_right02">
										<?php $attachment_id=get_field('image',$post->ID);
										echo wp_get_attachment_image($attachment_id,array(200, 200));?>
									</div>
								</li>
							</ul>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					<div class="clear"></div>


						</div><!-- .cont_half_02_wrap -->
					</div><!-- .container -->

					<div class="bg_gray mgt50 mgb50">
						<div class="container pdb50">
							<div class="cont-h2">
							  	<h2 class="cont-h2-txt">オーナー、EPC事業者、メーカーの皆さまに向けたお役たち情報</h2>
							  	<div class="cont-h2-subtxt">HELPFUL INFORMATION</div>
							</div>

							<ul class="cont_three_column_wrap clearfix">
								<li class="cont_three_column_li">
									<div><img src="<?php bloginfo('template_url');?>/images/top_hi_image01.jpg" alt="" /></div>
									<h3>オーナー様向け</h3>
									<ul class="cont_three_column_li_lnk">
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />オーナー様必見、業界豆知識</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />選定コンサルティングのご相談</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />製品選定のポイント</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />ソリューション事例紹介</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />EPCのご紹介</a></li>
									</ul>
								</li>
								<li class="cont_three_column_li">
									<div><img src="<?php bloginfo('template_url');?>/images/top_hi_image02.jpg" alt="" /></div>
									<h3>EPC事業者様向け</h3>
									<ul class="cont_three_column_li_lnk">
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />EPC様必見、業界豆知識</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />お勧めメーカーのご紹介</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />製品選定のポイント</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />見積もり・図面のご要望</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />工事協力店のご紹介</a></li>
									</ul>
								</li>
								<li class="cont_three_column_li">
									<div><img src="<?php bloginfo('template_url');?>/images/top_hi_image03.jpg" alt="" /></div>
									<h3>メーカー様向け</h3>
									<ul class="cont_three_column_li_lnk">
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />販売のご相談</a></li>
										<li><a href="#"><img src="<?php bloginfo('template_url');?>/images/top_next.png" alt="" />FAプロダクツについて</a></li>
									</ul>
								</li>
							</ul><!-- .cont_half_02 -->
						</div><!-- .cont_half_02_wrap -->
					</div><!-- .container -->

                    	                      
					<!--<div class="cont-btn-wrap">
						<a class="cont-btn" href="<?php bloginfo('url'); ?>/contact/">
							<img src="<?php bloginfo('template_url');?>/images/contact_top.jpg" alt="お問い合わせ" />
						</a>
					</div>--><!-- .cont-btn-wrap -->
                    
                    <div class="sigle-btn-cont cont-btn-wrap02 hover-opa">
                        <a href="<?php bloginfo('url'); ?>/contact/"><span class="sigle-btn-cont-inner">お気軽にご相談ください</span></a>
                    </div>

				</div><!-- .entry-content -->
			</article><!-- #post-## -->

		<?php endwhile; ?>
	</div><!-- End Container -->
</section>

<?php get_footer(); ?>