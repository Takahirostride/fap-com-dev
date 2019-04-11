<?php get_header('page'); ?>

<section class="content page-404">
	<div class="container">
		<div class="static-page">
			<header class="page-header">
				<div class="content-type">
					<i class="fa fa-unlink"></i>
				</div>
				<h1><?php _e( 'Page Not Found', 'craftowp' ); ?></h1>
				<div class="separator">
					<div class="sep-inner sep-long">
						<div class="sep-ornament"></div>
					</div>
				</div>
			</header>

			<div class="page-content">
				<p class="tagline-404"><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'craftowp' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</section>

<?php get_footer(); ?>