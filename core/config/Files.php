<?php
// システムのルートディレクトリ
define("DIR_ROOT", "/home/murai/www/mindlog/");
// ログファイルの場所
define("DIR_LOGS", DIR_ROOT . "logs/");
// 一時保存ファイルの名前
define("TMP_LOG", "tmp.log");

class Files {

  // 投稿を読み込む
  public function read($filename = null) {
    // ファイル名を指定しない場合は、当日の日付をもとに導出
    if (!$filename) {
      $filename = $this->filename();
    }

    // ログ・ファイルの取得（ログ生成より早く呼び出されることがある）
    if (file_exists(DIR_LOGS . $filename)) {
      $log = file(DIR_LOGS . $filename);
      $text = '';
      foreach($log as $ln) {
        $text .= $ln;
      }
      return $text;
    } else {
      return false;
    }
    // TODO:try-catchを仕込む

  }
  
  // 投稿を書き込む
  public function write($text, $filename = null) {
    // ファイル名を指定しない場合は、当日の日付をもとに導出
    if (!$filename) {
      $filename = $this->filename();
    }

    // 書き込みテキストを作成
    $timestamp = PHP_EOL . '[' . date('H:i:s') . ']' . PHP_EOL;
    $text = str_replace(array("\r\n","\r", "\n"), PHP_EOL, $text);
    $text .= PHP_EOL;

    // ファイルに書き込む：末尾から・ファイルが存在しない場合は作成
    $fp = fopen(DIR_LOGS . $filename, 'a+');
    fwrite($fp, $timestamp . $text); // エスケープしなきゃ
    fclose($fp);

    return true;
    // TODO:try-catchを仕込む

  }

  // 一時保存
  public function save_tmp($text) {

    // 書き込みテキストを作成
    $text = str_replace(array("\r\n","\r", "\n"), PHP_EOL, $text);

    // ファイルに書き込む：初期化・ファイルが存在しない場合は作成
    $fp = fopen(DIR_LOGS . TMP_LOG, 'w+');
    fwrite($fp, $text); // エスケープしなきゃ
    fclose($fp);

    return true;
    // TODO:try-catchを仕込む

  }

  // 一時保存ファイルをクリアにする
  public function clear_tmp() {

    // ファイルに書き込む：初期化・ファイルが存在しない場合は作成
    $fp = fopen(DIR_LOGS . TMP_LOG, 'w+');
    fclose($fp);

    return true;
    // TODO:try-catchを仕込む

  }

  // 命名則に基づいてファイル名の決定
  public function filename($date = null) {

    if (!$date) {
      $date = date('Ymd');
    }

    $prefix = 'mindlog-';
    $ext = '.log';

    return $prefix . $date . $ext;
  }


}