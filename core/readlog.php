<?php
require_once('config/index.php');

$Files = new Files();
echo $Files->read();

/*
$filename = 'mindlog-20180726.log';

// ログ・ファイルの取得（ログ生成より早く呼び出されることがある）
if (file_exists(DIR_LOGS . $filename)) {
  $log = file(DIR_LOGS . $filename);
  $text = '';
  foreach($log as $ln) {
    $text .= $ln;
  }
  echo $text;
}
*/