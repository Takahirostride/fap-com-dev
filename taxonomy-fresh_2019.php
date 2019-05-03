<?php
/*
Template Name:FAProject TEST
*/
?>
<?php get_header('page'); ?>
<!-- Begin Container -->
<p><?php
$terms = get_terms( 'recruit_info_taxonomy');
foreach ( $terms as $term ){
echo $term->name; //名前
echo $term->slug; //スラッグ
echo $term->description; //説明
echo $term->term_id; //タームID
echo $term->parent; //直近の子ターム
echo get_term_link($term->slug, 'recruit_info_taxonomy'); //タームのリンク
}
?></p>

<?php $list = get_posts(array('posts_per_page' => 5, 'post_type' => 'recruit_info',)); //カスタム投稿タイプのスラッグを指定?>
<?php if(!empty($ints)) :?>
<div class="list">
<?php foreach ( $list as $post ) :
    setup_postdata( $post );
    $id = $post->ID;
?>
    <div class="item">
        <a href="<?php the_permalink();?>">
        <?php
            $terms = wp_get_object_terms($id, 'recruit_info_taxonomy'); //カスタムタクソノミーのスラッグ
            if ($terms) {
            foreach ($terms as $term) {
                echo '<span class="'.$term->slug.'">'.$term->name.'</span>' ;}
        };?>
            <h4><?php the_title();?></h4>
        </a>
    </div>
<?php endforeach; wp_reset_postdata(); ?>
</div>
<?php endif;?>

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
            <section class="page_block page_block_top">
            <h2 class="sub-title">経験者採用</h2>

            <?php
            $paged = (int) get_query_var('paged');
            $args = array(
                'posts_per_page' => 10,
                'paged' => $paged,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'recruit_info',
                //'category__not_in' => array(),
                'post_status' => 'publish'
            );
            $the_query = new WP_Query($args);
            if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>

            <div class="recruit_page_lists_wrap">
                <h3 class="rec-title"><?php the_title(); ?></h3>
                <div class="box-page_w">
                    <div class="box-rec_left">
                    <!--<img src="<?php bloginfo('template_url');?>/images/thum1.jpg" />-->
                        <?php
                        $image = get_field('image');
                        $size = 'full'; // (thumbnail, medium, large, full or custom size)
                        if( $image ) { echo wp_get_attachment_image( $image, $size );}
                        ?>
                    </div>

                    <div class="box-rec_right">
                        <!--<ul class="recruit_box">
                                <li><span class="recruit_catch">職務概要</span><span class="recruit_txt"><?php if( get_field('job_outline') ) { the_field('job_outline'); } ?></span></li>
                                <li><span class="recruit_catch">職務内容</span><span class="recruit_txt"><?php if( get_field('job') ) { the_field('job'); } ?></span></li>
                                <li><span class="recruit_catch">応募資格</span><span class="recruit_txt"><?php if( get_field('recruitment') ) { the_field('recruitment'); } ?></span></li>
                                <li><span class="recruit_catch">雇用形態</span><span class="recruit_txt"><?php if( get_field('employment') ) { the_field('employment'); } ?></span></li>
                                <li><span class="recruit_catch">勤務地</span><span class="recruit_txt"><?php if( get_field('location') ) { the_field('location'); } ?></span></li>
                                <li><span class="recruit_catch">給与</span><span class="recruit_txt"><?php if( get_field('payroll') ) { the_field('payroll'); } ?></span></li>
                                <li><span class="recruit_catch">募集背景</span><span class="recruit_txt"><?php if( get_field('message') ) { the_field('message'); } ?></span></li>
                                <?php if(post_custom('workinghours')): ?><li><span class="recruit_catch">勤務時間</span><span class="recruit_txt"><?php if( get_field('workinghours') ) { the_field('workinghours'); } ?></span></li><?php endif; ?>
                                <?php if(post_custom('holiday')): ?><li><span class="recruit_catch">休日・休暇</span><span class="recruit_txt"><?php if( get_field('holiday') ) { the_field('holiday'); } ?></span></li><?php endif; ?>
                                <?php if(post_custom('welfare')): ?><li><span class="recruit_catch">待遇・福利厚生</span><span class="recruit_txt"><?php if( get_field('welfare') ) { the_field('welfare'); } ?></span></li><?php endif; ?>
                                <?php if(post_custom('flow')): ?><li><span class="recruit_catch">入社までの流れ</span><span class="recruit_txt"><?php if( get_field('flow') ) { the_field('flow'); } ?></span></li><?php endif; ?>
                                <?php if(post_custom('method')): ?><li><span class="recruit_catch">応募方法</span><span class="recruit_txt"><?php if( get_field('method') ) { the_field('method'); } ?></span></li><?php endif; ?>
                        </ul>
                        <div class="sigle-btn-cont sigle-btn-cont-recruit hover-opa">
                        <a href="<?php bloginfo('url'); ?>/contact.html"><span class="sigle-btn-cont-inner">お問い合わせはこちら</span></a>
                        </div>-->
                            <?php //the_content(); ?>

                        <div>
                            <span class="recruit_catch"></span><span class="recruit_txt">
                                <?php if( get_field('job_outline') ) { the_field('job_outline'); } ?>
                            </span>
                        </div><br>

                        <div class="sigle-btn-cont sigle-btn-cont-recruit hover-opa">
                            <a href="<?php the_permalink();?>" target=”_blank”>詳細はこちら</a>
                        </div>

                    </div>
                </div>
            </div><!-- /.recruit_page_lists_wrap -->
            <?php endwhile; endif; ?>

            </section>

            <!--<div class="sigle-btn-cont hover-opa">
            <a href="<?php bloginfo('url'); ?>/contact.html"><span class="sigle-btn-cont-inner">お問い合わせはこちら</span></a>
            </div>-->

        </div><!-- .entry-content -->
    </article><!-- #post-## -->

    <?php endwhile; ?>
    </div><!-- End Container -->
</section>

<?php get_footer(); ?>