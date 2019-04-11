<?php
/*
Template Name:topics_page
*/
?>
<?php get_header('page'); ?>
<!-- Begin Container -->
<section class="content">
	<div class="container">
	<!--<div class="container container_two_column">　2カラム用-->

		<?php while ( have_posts() ) : the_post(); ?>

			

				<div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
                </div>
				<div>
				<header class="page-header"><h1 class="page-title">耳より情報</h1></header>
				</div>
             	<div class="container">
                <!--<div class="container container_two_column">　2カラム用-->
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'static-page' ); ?>>
                <div class="clearfix">
                <!--<div class="content_two_column clearfix">　2カラム用-->
				<div class="entry-content box-page"><!-- .box-pageで幅変更  -->
					<!--フルサイズで表示 -->
 					<?php //the_post_thumbnail('full'); ?>
					
					<?php
						the_content();
					?>
					<div class="cont_three_column_wrap clearfix">

					<?php
					switch_to_blog(2);//切り替える子ブログを選択
                    $paged = (int) get_query_var('paged');
                    $args = array(
                     'posts_per_page' => 12,
                     'paged' => $paged,
                     'orderby' => 'post_date',
                     'order' => 'DESC',
                     'post_type' => array('news','knowledge','case_study'),
					 //'category__not_in' => array(),
                     'post_status' => 'publish'
                    );
                    $the_query = new WP_Query($args);
                    if ( $the_query->have_posts() ) :
                     while ( $the_query->have_posts() ) : $the_query->the_post();
                    ?>

					<div class="entry-container">
                    <h2 class="rec-title topics_single_title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                    	<div class="single_date_wrap clearfix">
							<span class="single_date single_date_02">公開：<?php the_time('Y年m月d日'); ?></span>
                        	<span class="single_date single_date_01"><?php //the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
							<?php
                            $posttags = get_the_tags();
                            $homeurl = home_url();
                            if ($posttags) {
                                 foreach($posttags as $tag) {
                                      //echo '<a href="' . $homeurl . '/archives/tag/' . $tag->slug . '" class="' . $tag->slug . '">' . $tag->name . '</a>';
                                      echo '<span class="single_date_tags"><a href="' . $homeurl . '/archives/tag/' . $tag->slug . '" class="tag-id' . $tag->term_id . '">' . $tag->name . '</a></span>';
                            }} ?>
                            </span>                            
                        </div>

					<ul class="cont_archive_column_wrap">
							<li class="cont_archive_column_left">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php 
								$image = get_field('image');
								$size = 'archive-thumb'; // (thumbnail, medium, large, full or custom size)
								if( $image ) { echo wp_get_attachment_image( $image, $size );}
								?>
								</a>
							</li>

							<li class="cont_archive_column_right">
                            <?php echo mb_substr(strip_tags(get_the_content()), 0, 80); ?>
                        <?php //echo mb_substr(get_the_excerpt(), 0, 80); ?>
								<div class="cont_archive_column_next"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php bloginfo('template_url');?>/images/mame_next_corp.png" alt="続きはこちら" /></a></div>
</li>
						</ul>
						<div class="clear"></div>
                    </div>

                    <?php endwhile; endif; ?>
					</div>
                     
                    
                    
                    <!-- ページネーション -->
                 <!--   <div class="news_page_pagination">
						<?php
                        if ($the_query->max_num_pages > 1) {
                         echo paginate_links(array(
                         'base' => get_pagenum_link(1) . '%_%',
                         'format' => 'page/%#%/',
                         'current' => max(1, $paged),
                         'total' => $the_query->max_num_pages,
                         'mid_size' => 2,
                         'prev_next'    => True,
                         'prev_text'    => __('« 前のページ'),
                         'next_text'    => __('次のページ »')
                         ));
                        }
                        ?>
                    </div>-->
                   
                    <?php wp_reset_postdata(); ?>
<?php restore_current_blog(); //子ブログ終了時に入れる?>
                <div class="sigle-btn-cont hover-opa">
                    <a href="<?php bloginfo('url'); ?>/contact.html"><span class="sigle-btn-cont-inner">お問い合わせはこちら</span></a>
                </div>


				</div><!-- .entry-content -->
                </div><!-- .content_two_column -->
			</article><!-- #post-## -->

		<?php endwhile; ?>
		<?php //get_sidebar( 'single' ); ?>
	</div><!-- End Container -->
</section>

<?php get_footer(); ?>