<?php get_header( 'page' ); ?>

<section class="content">
	<div class="container container_two_column">
    	<div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
	</div>
		<div>
        <header class="page-header"><h2 class="page-title">ニュースリリース</h2></header>
        </div>
    <div class="container container_two_column clearfix"><!-- .clearfixは外側に -->
        <div class="content_two_column">

		<?php
			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>

				<?php
					$post_type = get_post_type( $post );
					$tax = get_object_taxonomies( $post );
				?>

				<?php if ( function_exists( 'ot_get_option' ) ) {
					if ($post_type == 'portfolio') {
						$portfolio_images = get_post_meta( $post->ID, 'portfolio_images', true );
						$portfolio_video_choice = get_post_meta( $post->ID, 'show_video', true );
						$portfolio_video = get_post_meta( $post->ID, 'portfolio_video', true );
						$post_class = 'portfolio-post-single';
					} elseif ($post_type == 'testimonial') {
						$post_class = 'testimonial-post-single';
					} elseif ($post_type == 'post') {
						$special_heading = get_post_meta( $post->ID, 'activate_special_heading_post', true );
						$tagline = get_post_meta( $post->ID, 'tagline_post', true );
						$slider_images = get_post_meta( $post->ID, 'blog_post_slides', true );
						$lightbox = get_post_meta( $post->ID, 'activate_lightbox_blog_post', true );
						$post_class = 'blog-post-single';
					}
				} ?>
					
					<!-- Start the article -->

					<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                        <h1 class="rec-title topics_single_title"><?php the_title(); ?></h1>
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
                        <?php //wp_social_bookmarking_light_output_e(null, get_permalink(), the_title("", "", false)); ?>

					<!-- Get the Slider or Post Thumbnail if exists -->
					<?php if($post_type == 'post'): ?>
						<?php //if ( $slider_images ) { ?>
							<!--<div class="blogpost-slider">
							<?php /*foreach ($slider_images as $slide) {
								$id = pixelglow_get_attachment_id( $slide['upload_blog_image'] );
								$large_src = wp_get_attachment_image_src( $id, 'large' );
								$src = wp_get_attachment_image_src( $id, 'blog' );
								if (isset($lightbox) && $lightbox == "on") {
									echo '<div class="bslide">
										<a href="'.$large_src[0].'"><img src="'.$src[0].'" alt="" ></a>
									</div>';
								} else {
									echo '<div class="bslide">
										<img src="'.$src[0].'" alt="" ></a>
									</div>';
								}
							}*/ ?>
							</div>-->
						<?php /*if ( empty($slider_images) && has_post_thumbnail($post->ID) ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
							echo '<div class="entry-image-single"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute( 'echo=0' ) . '">';
								the_post_thumbnail( 'full' );
							echo '</a></div>';
						} */?>
					<?php else: ?>
						<?php if (has_post_thumbnail($post->ID)): ?>
							<div class="entry-image-single">
								<?php the_post_thumbnail( 'full' ); ?>
							</div>;
						<?php endif ?>
					<?php endif ?>
						
						<!-- Entry Content -->
						<div class="entry-content">
							
							
							
							<?php the_post_thumbnail( 'full' ); ?>
							<?php the_content(); ?>
						</div><!-- Entry content end -->

					</article><!-- Article end -->

					<?php /*if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
						comments_template('', true);
					} */?>

				<?php endwhile;
				// Previous/next post navigation.
				craftowp_pagination();

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>


			<div class="single_page_navi_wrap clearfix">
				<?php //previous_post_link('<div class="single_page_navi_left">%link</div>','前の記事へ'); ?>
                <?php //next_post_link('<div class="single_page_navi_right">%link</div>','次の記事へ'); ?>
            </div>

<?php //related_posts(); ?>
<!-- yarpp 導入により一旦非表示へ
            <h3 class="single_under_tit"><span class="single_under_tit_inner"><?php //$cat = get_the_category(); $cat = $cat[0]; { echo $cat->cat_name; } ?>同じカテゴリーの関連記事</span></h3>
            
			<?php /**
			$post_id = get_the_ID();
			foreach((get_the_category()) as $cat) {
			$cat_id = $cat->cat_ID ;
			break ;
			}
			query_posts(
			array(
			'cat' => $cat_id,
			'showposts' => 2,
			'post__not_in' => array($post_id)
			)
			);
			if(have_posts()) :
			?>
			<ul class="cont_three_column_wrap cont_three_column_wrap_two clearfix">
			<?php while (have_posts()) : the_post(); ?>
			<li class="cont_three_column_li cont_three_column_li_news cont_three_column_li_news_two">

            	<div class="cont_three_column_li_news_inner01 hover-opa"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(357,224)); ?></a></div>
                    <div class="cont_three_column_li_news_inner02">
                        <span class="cont_home_news_txt01 news_txt01"><?php the_category(); ?></span>
                        <div class="news_txt02"><a href="<?php the_permalink();?>">
						<?php
						if(mb_strlen($post->post_title, 'UTF-8')>28){
						$title= mb_substr($post->post_title, 0, 28, 'UTF-8');
						echo $title.'…';
						}else{
						echo $post->post_title;
						}
						?>
						</a></div>
                        <span class="news_txt03"><?php the_time('Y-m-d'); ?></span>
                    </div>
                </li>
			<?php endwhile; ?>
			</ul>
			<?php endif; ?>
			<?php wp_reset_query(); **/?>
            -->
            
                     
            <div class="sigle-btn-cont hover-opa">
            	<a href="<?php bloginfo('url'); ?>/contact.html"><span class="sigle-btn-cont-inner">お問い合わせはこちら</span></a>
            </div>

            
		</div>
		<?php get_sidebar( 'single' ); ?>
      </div>
</section>

<?php get_footer(); ?>