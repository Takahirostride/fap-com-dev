<?php get_header('page'); ?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<section class="content loop-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				
				<div class="content-type">
					<i class="fa fa-folder-open-o"></i>
					<?php if (is_tax( 'portfoliocats' )) : ?>
						<p><?php _e( 'Works listed under category', 'craftowp' ); ?></p>
						<span><?php echo $term->name; ?></span>
					<?php endif ?>
					<?php if (is_tax( 'testimonials' )) : ?>
						<p><?php _e( 'Testimonials listed under category', 'craftowp' ); ?></p>
						<span><?php echo $term->name; ?></span>
					<?php endif ?>
					<div class="separator">
						<div class="sep-inner sep-long">
							<div class="sep-ornament"></div>
						</div>
					</div>
				</div>
				
		<?php if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-loop' ); ?>>

					<header class="entry-header">
						<div class="entry-title entry-title-no-thumbnail">
							<span class="entry-meta"><?php the_time('F j, Y'); ?></span>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<h1><?php the_title(); ?></h1>
							</a>
							<?php if (isset($tagline) && $tagline) : ?>
								<span class="entry-tagline"><?php echo $tagline; ?></span>
							<?php endif ?>
						</div>
					</header><!-- .entry-header -->

					<?php if ( has_post_thumbnail($post->ID) ) {
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
						echo '<div class="entry-image-loop"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="prettyPhoto">';
							the_post_thumbnail( 'blog' );
						echo '</a></div>';
					} ?>

					<div class="entry-content">
						<?php the_excerpt(); ?>
					</div><!-- .entry-content -->

					<div class="bottom-meta bottom-meta-no-thumbnail">
						<a href="<?php the_permalink(); ?>" class="btn btn-medium btn-gray btn-outline"><?php _e('Read More', 'craftowp') ?></a>
					</div>
				</article><!-- #post-## -->

				<?php endwhile;
				// Previous/next post navigation.
				craftowp_pagination();

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif; ?>

			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>