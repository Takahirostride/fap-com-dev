<?php
/*
Template Name:topics_page
*/
?>
<?php get_header('page'); ?>
<!-- Begin Container -->
<section class="content">
	<div class="container">
		<!--<div class="container container_two_column">　2カラム用-->

		<?php while ( have_posts() ) : the_post(); ?>

		<div class="breadcrumbs"><?php if(function_exists('bcn_display')){ bcn_display();}?></div>
	</div>

	<div>
		<header class="page-header"><h1 class="page-title">耳より情報</h1></header>
	</div>

<div class="container">
	<!--<div class="container container_two_column">　2カラム用-->
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'static-page' ); ?>>
	<div class="clearfix">
	<!--<div class="content_two_column clearfix">　2カラム用-->
		
	<div class="entry-content box-page"><!-- .box-pageで幅変更  -->
		<!--フルサイズで表示 -->
		<?php //the_post_thumbnail('full'); ?>

		<div class="cont_three_column_wrap clearfix">

<?php
/*
各ブログから記事取得「news」「knowledge」、「case_study」。
*/
$sql = '';
$blog_id_arr = array(2,3);//取得するブログIDの配列
$tmp = $blog_id_arr;
foreach($blog_id_arr as $b_id){
	$pg = get_query_var( 'page' );//現在何ページ目なのか取得
	if($pg == 0) $pg = 1;//1ページ目は「0」になってしまうのでそれを「1」とする
    next($tmp);
    switch_to_blog($b_id);
    $sql .= <<<HERE
(SELECT *, $b_id as blog_id
FROM $wpdb->posts
WHERE (post_type = 'news' OR post_type = 'knowledge' OR post_type = 'case_study')
AND post_status = 'publish')
HERE;

    if(current($tmp) !== false){
        $sql .= "UNION\n";
    }
    restore_current_blog();
}
$sql .= "ORDER BY post_date DESC\n";
$posts = $wpdb->get_results($sql);//記事のセットを取得
$total = ceil(count($posts)/10);//条件にマッチした記事の総数を取得
$sql .= "LIMIT " . ($pg-1) * 10 . ", 10";//記事を0番目から30個、30番目から30個、…という流れで取得する
$posts = $wpdb->get_results($sql);//改めて記事のセットを取得
?>


<table>
<?php
foreach ($posts as $post):
	switch_to_blog($post->blog_id);
	setup_postdata($post);
?>
</table>


<div class="entry-container">
	<h2 class="rec-title topics_single_title">
		<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
	</h2>
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

	<div class="row mb-5">
		<div class="col-md-4 mb-3 mb-md-0">
		<a href="<?php the_permalink();?>">
        <?php
            $attachment_id=get_field('image',$post->ID);
            echo wp_get_attachment_image(
                $attachment_id,
                'midium-thumb',
                false,
                array(
                    'class' => 'img-fluid'
                )
            );
        ?>
    </a>
		</div>
		<div class="col-md-8">
			<p>
				<?php echo mb_substr(strip_tags(get_the_content()), 0, 80); ?>
				<?php //echo mb_substr(get_the_excerpt(), 0, 80); ?>
				<span>...</span>
			</p>
			<button class="btn-fa-brast text-white mt-3">
				<a class="text-dark" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">続きはこちら&nbsp;></a>
			</button>
		</div>
	</div><!-- /.row-->
</div><!-- /.entry-container -->

<?php //get_template_part('loop', 'news-blog'); ?>
<?php endforeach;?>

<?php //endwhile; endif; ?>
</div><!-- /.cont_three_column_wrap -->

<!-- ページネーション -->
<?php
//ページャー引数設定
$main_blog_url = get_blogaddress_by_id(1);
$args = array(
	'base'         => $main_blog_url . 'topics.html%_%',
	'format'       => '?page=%#%',
	'total'        => $total,
	'current'      => $pg,
	'show_all'     => False,
	'end_size'     => 1,
	'mid_size'     => 5,
	'prev_next'    => true,
	'prev_text'    => __('«'),
	'next_text'    => __('»'),
	'type'         => 'plain',
	'add_args'     => False,
	'add_fragment' => ''
);
?>

<div class="pagination">
	<?php echo paginate_links( $args );//ページャー出力 ?>
</div>

<?php wp_reset_postdata(); ?>


<?php //restore_current_blog(); //子ブログ終了時に入れる?>
                <div class="sigle-btn-cont hover-opa">
                    <a href="<?php bloginfo('url'); ?>/contact.html"><span class="sigle-btn-cont-inner">お問い合わせはこちら</span></a>
                </div>


	</div><!-- .entry-content -->
	</div><!-- .content_two_column -->
	</article><!-- #post-## -->

	<?php endwhile; ?>
	<?php //get_sidebar( 'single' ); ?>
	</div><!-- End Container -->
</section>

<?php get_footer(); ?>