<?php
/*
Template Name: Blog Page
*/
?>
<?php  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => 'post',
			'paged' => $paged
		);
		query_posts($args) ?>

<?php get_header('page'); ?>

<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

		<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>
			
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'static-page' ); ?>>
						<?php
							// Page thumbnail and title.
							the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header><!-- .entry-header -->' );
						?>

						<div class="page-content">
							<?php
								the_content();
							?>
						</div><!-- .entry-content -->
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
