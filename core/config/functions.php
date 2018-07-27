<?php
/**
 * HTMLの特殊文字をエスケープして結果を出力します。
 */
function h($str) {
    return htmlspecialchars(mb_convert_encoding($str, 'UTF-8'), ENT_QUOTES, 'UTF-8');
}

/**
 * HTMLの特殊文字をエスケープして改行の前にbrタグを追加し、結果を出力します。
 */
function hbr($str) {
    return nl2br(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));
}

// ログイン状態かどうか
function isLogin() {
  return isset($_SESSION["USER"]);
}

// ログイン状態をチェックし、非ログインであればログインページヘリダイレクト
function loginCheck($page = null) {

  // トップページアクセスの場合、ログイン時はリダイレクト
  if ($page == "index") {
    if (isLogin()) {
      header('Location: index.php');
      exit;
    } else {
      return;
    }
  }
  if (!isLogin()) {
    header('Location: login.php');
    exit;
  }

}

// ログアウト処理
function logout() {
  unset($_SESSION["USER"]);
  unset($_SESSION["process"]);
  return;
}
