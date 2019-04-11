<?php get_header('page'); ?>

<section class="content">
	<div class="container container_two_column">
    	    	<div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
	</div>
	<div>
		<h1 class="h1_title"><?php echo esc_html(get_post_type_object(get_post_type())->label ); ?></h1>
	</div>

	<div class="container container_two_column">
           	<div class="content_two_column clearfix">

			<?php
				if ( is_post_type_archive('portfolio') ) :
					$archiveType = __( 'Archives for:', 'craftowp' );
					$theDate = __( 'Portfolio posts', 'craftowp' );
				elseif ( is_post_type_archive('testimonial') ) :
					$archiveType = __( 'Archives for:', 'craftowp' );
					$theDate = __( 'Testimonials', 'craftowp' );
				elseif ( is_day() ) :
					$archiveType = __( 'Daily Archives: %s', 'craftowp' );
					$theDate = get_the_date();
				elseif ( is_month() ) :
					$archiveType = __( 'Monthly Archives: %s', 'craftowp' );
					$theDate = get_the_date( _x( 'F Y', 'monthly archives date format', 'craftowp' ) );
				elseif ( is_year() ) :
					$archiveType = __( 'Yearly Archives: %s', 'craftowp' );
					$theDate = get_the_date( _x( 'Y', 'yearly archives date format', 'craftowp' ) );
				else :
					$archiveType = __( 'Archives', 'craftowp' );
				endif;
			?>				
			
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-loop' ); ?>>
				<div class="entry-content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="entry-container">
						<header class="entry-header">
							<h1 class="single_title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							<span class="entry-meta">公開日：<?php the_time('Y年n月j日'); ?></span>
							<?php
							$args = array('fields'=>'names'); // オプション
							$terms = wp_get_post_terms( $post->ID, 'knowledge', $args);
							?>
						</header><!-- .entry-header -->

						<ul class="cont_archive_column_wrap">
							<li class="cont_archive_column_left">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php 
								$image = get_field('image');
								$size = 'full'; // (thumbnail, medium, large, full or custom size)
								if( $image ) { echo wp_get_attachment_image( $image, $size );}
								?>
								<!--<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />--></a>
							</li>

							<li class="cont_archive_column_right">
			 					<?php echo mb_substr(get_the_excerpt(), 0, 164); ?>
								<div class="cont_archive_column_next"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php bloginfo('template_url');?>/images/mame_next.png" alt="続きはこちら" /></a></div>

							</li>
						</ul>
						<div class="clear"></div>
					</div><!-- .entry-container -->

						<?php endwhile;
						// Previous/next post navigation.
						craftowp_pagination();

						else :
						// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );

					endif; ?>

					</div><!-- .entry-content -->

					<div class="sigle-btn-cont hover-opa">
						<a href="<?php bloginfo('url'); ?>/contact.html"><span class="sigle-btn-cont-inner">お問い合わせはこちら</span></a>
					</div>
				</article><!-- #post-## -->
		</div>
		<?php get_sidebar( 'single' ); ?>
	</div>
</section>

<?php get_footer(); ?>