<?php
function related_post_render($attr, $content) {
  // 投稿が選択されていれば（値が初期値の 0 より大きければ）
  if ($attr['selectedPostId'] > 0 || $attr['selectedPostUrl']) {
    $oja_post = get_post($attr['selectedPostId']);
    if (!$oja_post) {
      return;
    }

    // outputコンテンツ
    if ($attr['postDesign']) {
      $design_type = ' '.$attr['postDesign'];
    }
    $block_content = '<div class="oja-related-post-wraper'. $design_type. '">';
    // 投稿リンク
    $post_url = esc_url( get_permalink($oja_post) );
    $block_content .= '<a href="'.$post_url.'" class="related-post-content">';

    // サムネイル
    if (has_post_thumbnail($oja_post->ID)) {
      $block_content .= '<figure>'.get_the_post_thumbnail( $oja_post->ID, 'post-thumbnail').'</figure>';
    }

    $block_content .= '<div class="related-article">';
    // ラベル
    if( $attr['label'] ) {
      $block_content .= '<span>'. esc_html( $attr['label'] ).'</span>' ;
    }

    // 投稿タイトル
    $title = esc_html( get_the_title($oja_post) );
    $block_content .= '<h3 class="related-title">'. $title . '</h3>';

    // 投稿日時
    if($attr['isTimeStamp']) {
      $date = get_the_date("Y/m/d",$oja_post->ID);
      $block_content .= '<time class="post_date">'. $date . '</time>';
    }
    
    $block_content .= '</div></a></div>';
  }
  //ブロックの出力の文字列を返す
  return $block_content;
}