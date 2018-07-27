<?php
// 定義ファイルの自動読み込み
$dir = dirname(__FILE__) . '/';
// $dir = './';
if ( is_dir( $dir ) && $handle = opendir( $dir ) ) {
  while ( ($file = readdir($handle)) !== false ) {
    if ( filetype( $path = $dir . $file ) == 'file' ) {
      if ($file != basename(__FILE__)) {
        require_once($path);
      }      
    }
  }
}
