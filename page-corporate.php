<?php
/*
Template Name:FAProject CORPORATE
*/
?>
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

        <div class="entry-content mb-5">
        <section class="">

            <h2 class="sub-title">目次</h2>

            <?php
            $paged = (int) get_query_var('paged');
            $args = array(
                'posts_per_page' => 10,
                'paged' => $paged,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'corporate',
                //'category__not_in' => array(),
                'post_status' => 'publish'
            );
            $the_query = new WP_Query($args);
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>

            <div class="mb-5">
                <h3 class="rec-title"><?php the_title(); ?></h3>
                <div class="">
                    <div class="box-rec_left">
                        <?php
                        $image = get_field('image');
                        $size = 'full'; // (thumbnail, medium, large, full or custom size)
                        if( $image ) { echo wp_get_attachment_image( $image, $size );}
                        ?>
                    </div>

                    <div class="box-rec_right">
                        <?php //the_content(); ?>

                        <button class="btn-fa-brast text-white">
                            <a class="text-dark" href="<?php the_permalink();?>" target=”_blank”>詳細はこちら&nbsp;></a>
                        </button>

                    </div>
                </div>
            </div><!-- /.recruit_page_lists_wrap -->

            <?php endwhile; endif; ?>

        </section>

        </div><!-- .entry-content -->
    </article><!-- #post-## -->

    <?php endwhile; ?>
    </div><!-- End Container -->
</section>

<?php get_footer(); ?>