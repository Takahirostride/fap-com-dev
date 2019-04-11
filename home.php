<?php get_header('page'); ?>

<section class="content blog-content">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

		<?php
			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>

				<?php if ( function_exists( 'ot_get_option' ) ) {
					$special_heading = get_post_meta( $post->ID, 'activate_special_heading_post', true );
					$tagline = get_post_meta( $post->ID, 'tagline_post', true );
					$title_background = get_post_meta( $post->ID, 'activate_title_background', true );
					$title_background_color = get_post_meta( $post->ID, 'title_background_color', true );
				} ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-loop'); ?>>

						<header class="entry-header">

							<?php if ( has_post_thumbnail($post->ID) ) {
								echo '<div class="entry-image-loop">';
									the_post_thumbnail( 'blog' );
								echo '</div>';
								$titleClass = ' class="entry-title"';
							} else {
								$titleClass = ' class="entry-title entry-title-no-thumbnail"';
							} ?>

							<div<?php echo $titleClass; ?>>

								<?php if (isset($title_background) && $title_background == "on") {
									if (isset($title_background_color) && $title_background_color) {
										$color = ' style="background:'.$title_background_color.'"';
									}
									echo '<span class="title-overlay"'.( ! (empty($color) ) ? $color : '' ).'></span>';
								} ?>

								<span class="entry-meta"><?php the_time('F j, Y'); ?>  -  <?php the_category(', '); ?></span>
								
								<?php if (isset($special_heading) && $special_heading == "on") {
									$title_style = ' class="special-heading light-special"';
								} else {
									$title_style = '';
								} ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<h1<?php echo $title_style; ?>><?php the_title(); ?></h1>
								</a>

								<?php if (isset($tagline) && $tagline) : ?>
									<span class="entry-tagline"><?php echo $tagline; ?></span>
								<?php endif ?>

							</div>

						</header>

						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div><!-- .entry-content -->

						<?php $bottomClass = (has_post_thumbnail( $post->ID ) && !is_single( $post->ID )) ? ' class="bottom-meta"' : ' class="bottom-meta bottom-meta-no-thumbnail"' ; ?>
						<div<?php echo $bottomClass; ?>>
							<a href="<?php the_permalink(); ?>" class="btn btn-medium btn-gray btn-outline"><?php _e('Read More', 'craftowp') ?></a>
						</div>
					</article><!-- #post-## -->

				<?php endwhile;
				// Previous/next post navigation.
				craftowp_pagination();

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>

			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>