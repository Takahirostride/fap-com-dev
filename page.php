<?php get_header('page'); ?>
<!-- Begin Container -->
<section class="content page-content">
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
						the_content();
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

		<?php endwhile; ?>
	</div><!-- End Container -->
</section>

<?php get_footer(); ?>