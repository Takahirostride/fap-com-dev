<div class="content_two_column_side clearfix">

    <h4 class="side_tit">カテゴリー</h4>


<?php
// カスタム分類名
$taxonomy = 'classification';

// パラメータ 
$args = array(
    // 子タームの投稿数を親タームに含める
    'pad_counts' => true,
  
    // 投稿記事がないタームも取得
    'hide_empty' => false
);

// カスタム分類のタームのリストを取得
$terms = get_terms( $taxonomy , $args );

if ( count( $terms ) != 0 ) {
    echo '<ul>';
     
    // タームのリスト $terms を $term に格納してループ
    foreach ( $terms as $term ) {
    
        // タームのURLを取得
        $term = sanitize_term( $term, $taxonomy );
        $term_link = get_term_link( $term, $taxonomy );
        if ( is_wp_error( $term_link ) ) {
            continue;
        }
        
        // 子タームの場合はCSSクラス付与
        if( $term->parent != 0 ) {
            echo '<li class="children">';
        } else {
            echo '<li>';
        }
        
        // タームのURLと名称を出力
        echo '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>(' . $term->count . ')';
        echo '</li>';
    }
   
echo '</ul>';
}
?>


    <div class="side_cat_link_wrap">
        <ul class="side_cat_link_ul">
        <?php wp_list_categories('title_li=&depth=0&exclude=1&hide_empty=0'); ?>
        	<!-- <li class="cat-top"><a href="http://fisland.info/omnist/category/colum/" >COLUM</a></li>
			<li class="cat-parent cat-parent-fist"><a href="http://fisland.info/omnist/category/cat01/" >&#9312;OMNISTの秘密</a></li>-->
        </ul>
    </div>
    <h4 class="side_tit">タグ一覧</h4>
		<?php
        $tags = get_tags('hide_empty=0');//記事のないタグも表示
        $html = '<div class="post_tags">';
        foreach ( $tags as $tag ) {
            $tag_link = get_tag_link( $tag->term_id );
                    
            /*$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";*/
            $html .= "<span class='side_date_tags'><a href='{$tag_link}' title='{$tag->name} Tag' class='tag-id{$tag->term_id}'>";
            $html .= "{$tag->name}</a></span>";
        }
        $html .= '</div>';
        echo $html;
        ?>

</div>