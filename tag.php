<?php get_header('page'); ?>
<!-- Begin Container -->
<section class="content">
	<div class="container container_two_column">
	

				<div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
                </div>
				<div>
				<header class="page-header"><h1 class="page-title"><?php single_tag_title( '', true ); ?></h1></header>
				</div>
             	<div class="container container_two_column">   
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'static-page' ); ?>>
                <div class="content_two_column clearfix">
				<div class="entry-content">
					<div class="cont_three_column_wrap clearfix">

						<?php if ( have_posts() ) :
							while ( have_posts() ) : the_post(); ?>

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
								$size = 'full'; // (thumbnail, medium, large, full or custom size)
								if( $image ) { echo wp_get_attachment_image( $image, $size );}
								?>
								</a>
							</li>

							<li class="cont_archive_column_right">
                        <?php echo mb_substr(get_the_excerpt(), 0, 164); ?>
								<div class="cont_archive_column_next"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php bloginfo('template_url');?>/images/mame_next_corp.png" alt="続きはこちら" /></a></div>
</li>
						</ul>
						<div class="clear"></div>
                    </div>

                    <?php  endwhile; ?>
					</div>
                    
                    
                    
                    <!-- ページネーション -->
                    <div class="news_page_pagination">
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
                    </div>
                    <?php else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
                   
                    <?php wp_reset_postdata(); ?>

                <div class="sigle-btn-cont hover-opa">
                    <a href="<?php bloginfo('url'); ?>/contact.html"><span class="sigle-btn-cont-inner">お問い合わせはこちら</span></a>
                </div>


				</div><!-- .entry-content -->
                </div><!-- .content_two_column -->
			</article><!-- #post-## -->

		
		<?php get_sidebar( 'single' ); ?>
	</div><!-- End Container -->
</section>

<?php get_footer(); ?>