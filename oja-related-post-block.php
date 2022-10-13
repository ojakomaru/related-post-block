<?php
/**
 * Plugin Name:       Oja Related Post Block
 * Description:       関連記事を表示するブロックです
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       oja-related-post-block
 *
 * @package           oja
 */

new OjaRelatedPostBlock;
class OjaRelatedPostBlock {
  public function __construct() {
    // ブロック登録
    add_action( 'init', array($this, 'oja_related_block_init'));
  }

  public function oja_related_block_init() {
    if ( !function_exists('register_block_type')) {
      return;
    }
    $dir = dirname( __FILE__ );

    $script_asset_path = "$dir/build/index.asset.php";

    $index_js     = 'build/index.js';
    $script_asset = require( $script_asset_path );
    wp_register_script(
      'oja-related-post-script',
      plugins_url( $index_js, __FILE__ ),
      $script_asset['dependencies'],
      $script_asset['version']
    );
  
    $editor_css = 'build/index.css';
    wp_register_style(
      'oja-related-post-editor-style',
      plugins_url( $editor_css, __FILE__ ),
      array(),
      filemtime( "$dir/$editor_css" )
    );
  
    $style_css = 'build/style-index.css';
    wp_register_style(
      'oja-related-post-style',
      plugins_url( $style_css, __FILE__ ),
      array(),
      filemtime( "$dir/$style_css" )
    );
  
    register_block_type( 'oja/oja-related-post-block', array(
      'editor_script' => 'oja-related-post-script',
      'editor_style'  => 'oja-related-post-editor-style',
      'style'         => 'oja-related-post-style',
      'render_callback' => 'related_post_render_func',
      //属性を追加
      'attributes' => [
        // 投稿のIDを保存
        'selectedPostId' => [
          'type' => 'number',
          'default' => 0
        ],
        // 表示するラベル
        'label' => [
          'type' => 'string',
          'default' => '関連記事'
        ],
        // 日付の表示の有無
        'isTimeStamp' => [
          'type' => 'boolean',
          'default' => false
        ],
        // 表示設定
        'postDesign' => [
          'type' => 'string',
          'default' => 'sinple'
        ]
      ]
    ) );
  }

} // class OjaSliderBlock

//ダイナミックブロックによるレンダリング
function related_post_render_func($attributes, $content) {
    //画像ブロックレンダリング
    require_once dirname(__FILE__) . '/views/related_post_render.php';
    return related_post_render($attributes, $content);
}
